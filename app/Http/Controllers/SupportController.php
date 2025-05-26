<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Exports\ExcelExportVNReport;
use App\Exports\ExcelExportENReport;
use App\Exports\ExcelExportVnRegister;
use App\Exports\ExcelExportEnRegister;
use App\Exports\ExcelExportVipRegister;
use App\Mail\RegisterMail;
use App\Models\EnRegister;
use App\Models\Payment;
use App\Models\Register;
use App\Mail\ReplyMail;
use App\Mail\ReportMail;
use App\Models\Conference;
use App\Models\EnReport;
use App\Models\InvitationTemplates;
use App\Models\Report;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Blade;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Mail;

class SupportController extends Controller
{
    public function export(Request $request)
    {
        switch ($request->export_type) {
            case ('vnrp'):
                return Excel::download(new ExcelExportVNReport($request->conference_id), 'ReportVN.xlsx');
                break;
            case ('enrp'):
                return Excel::download(new ExcelExportENReport($request->conference_id), 'ReportEN.xlsx');
                break;
            case ('vnrt'):
                return Excel::download(new ExcelExportVnRegister($request->conference_id), 'RegisterVN.xlsx');
                break;
            case ('enrt'):
                return Excel::download(new ExcelExportEnRegister($request->conference_id), 'RegisterEN.xlsx');
                break;
            case ('viprt'):
                return Excel::download(new ExcelExportVipRegister($request->conference_id), 'RegisterVip.xlsx');
                break;
            default:
                return Redirect::back();
        }
    }

    public function createInvoice($id)
    {
        $register = Register::join('payments', 'payments.id', '=', 'registers.payment_id')
            ->join('conference_fees', 'payments.conference_fee_id', '=', 'conference_fees.id')
            ->select(
                'registers.conference_id',
                'registers.id',
                'register_code',
                'register_name',
                'register_work_unit',
                'register_phone',
                'conference_fee_title',
                'payment_price',
                'register_receiving_address',
            )
            ->firstWhere('registers.id', $id);
        $conference = Conference::select('id', 'conference_type_id')
            ->firstWhere('id', $register->conference_id);
        $pdf = Pdf::setOptions(['isHtml5ParserEnabled' => true, 'defaultFont' => 'sans-serif'])->loadView('pdf.receipt', [
            'name' => $register->register_name,
            'phone' => $register->register_phone,
            'unit' => $register->register_work_unit,
            'address' => $register->register_receiving_address,
            'price' => number_format($register->payment_price, 0, ',', '.') . '₫',
            'conferenceFeeTitle' => $register->conference_fee_title,
            "imgBackground" => parserImgPdf(choseInvoiceByConferenceType($conference->conference_type_id))
        ])->setPaper('a4', 'landscape');
        $filePath = storage_path('app/public/invoice/' . $register->register_code . '.pdf');
        $pdf->save($filePath);
    }

    public function createInvitation($id, $type)
    {
        if ($type == 'register') {
            $register = Register::select(
                'registers.id',
                'registers.conference_id',
                'register_code',
                'register_name',
                'register_work_unit',
                'register_degree',
            )
                ->firstWhere('id', $id);
            $conference = Conference::select('id', 'conference_type_id')
                ->firstWhere('id', $register->conference_id);
            $invitation_template = InvitationTemplates::where('conference_id', $conference->id)->where('type', 'vn_att')->first();
            $imgLogo = parserImgPdf(choseLogoByConferenceType($conference->conference_type_id));
            $imgSign = parserImgPdf(choseSignatureByConferenceType($conference->conference_type_id));
            $code = $register->register_code;
            $data = [
                "degree" => $register->register_degree == '' ? 'Sinh Viên' : $register->register_degree,
                'fullName' => $register->register_name,
                'unit' => $register->register_work_unit,
                'imgBackground' => parserImgPdf('defineTemplates/backGround/main.jpg'),
                'imgLogo' => $imgLogo,
                'imgSign' => $imgSign
            ];
        } else {
            $report = Report::select(
                'reports.id',
                'reports.conference_id',
                'report_code',
                'report_name',
                'report_work_unit',
                'report_degree',
            )
                ->firstWhere('id', $id);
            $conference = Conference::select('id', 'conference_type_id')
                ->firstWhere('id', $report->conference_id);
            $invitation_template = InvitationTemplates::where('conference_id', $conference->id)->where('type', 'vn_vs')->first();
            $imgLogo = parserImgPdf(choseLogoByConferenceType($conference->conference_type_id));
            $imgSign = parserImgPdf(choseSignatureByConferenceType($conference->conference_type_id));
            $code = $report->report_code;
            $data = [
                "title" => $report->report_degree == '' ? 'Sinh Viên' : $report->report_degree,
                'fullName' => $report->report_name,
                'unit' => $report->report_work_unit,
                'imgBackground' => parserImgPdf('defineTemplates/backGround/main.jpg'),
                'imgLogo' => $imgLogo,
                'imgSign' => $imgSign
            ];
        }
        $template = Blade::render(
            $invitation_template->content,
            $data
        );
        $pdf = Pdf::setOptions(['isHtml5ParserEnabled' => true])->loadHTML($template);
        $filePath = storage_path('app/public/invitation/' . $code . '.pdf');
        $pdf->save($filePath);
    }

    public function sendMailReply(Request $request, $id)
    {
        switch ($request->type) {
            case ('register'):
                $this->createInvoice($id);
                $this->createInvitation($id, 'register');
                $model = Register::findOrFail($id);

                $payment = Payment::findOrFail($model->payment_id);
                $payment->payment_status = 4;
                $payment->save();
                $conference = Conference::join('conference_types', 'conference_types.id', 'conferences.conference_type_id')->select(
                    'conference_type_name',
                    'conferences.id',
                    'conference_title',
                    'conference_title_en',
                )
                    ->where('conferences.id', $model->conference_id)
                    ->first();
                $mail_conference_type = $conference->conference_type_name;
                $mail_conference_title = $conference->conference_title;
                $mail_email = $model->register_email;
                $mail_name = $model->register_name;
                $mail_title = $model->register_gender;
                $mail_code = $model->register_code;
                $mail_type = $model->payment->conferenceFee->mail_type;
                $locale = 'vn';
                Mail::to($mail_email)->send(new RegisterMail($mail_conference_type, $mail_conference_title, $mail_name, $mail_title, $mail_code, $mail_type, $locale));
                break;
            case ('en_register'):
                $model = EnRegister::findOrFail($id);
                $mail_email = $model->en_register_email;
                $mail_name = $model->en_register_firstname . ' ' . $model->en_register_lastname;
                $mail_title = $model->en_register_title;
                $mail_code = $model->en_register_code;
                $mail_type = $model->payment->conferenceFee->mail_type;
                $locale = 'en';
                $payment = Payment::findOrFail($model->payment_id);
                $payment->payment_status = 4;
                $payment->save();
                Mail::to($mail_email)->send(new RegisterMail($mail_name, $mail_title, $mail_code, $mail_type, $locale));
                break;
            case ('report'):
                $this->createInvitation($id, 'report');
                $model = Report::findOrFail($id);
                $model->report_status = 3;
                $model->save();
                $conference = Conference::join('conference_types', 'conference_types.id', 'conferences.conference_type_id')->select(
                    'conference_type_name',
                    'conferences.id',
                    'conference_title',
                    'conference_title_en',
                )
                    ->where('conferences.id', $model->conference_id)
                    ->first();
                $mail_conference_type = $conference->conference_type_name;
                $mail_conference_title = $conference->conference_title;
                $mail_email = $model->report_email;
                $mail_name = $model->report_name;
                $mail_title = $model->report_gender;
                $mail_code = $model->report_code;
                $status = $model->report_status;
                $locale = 'vn';
                Mail::to($mail_email)->send(new ReportMail($mail_conference_type, $mail_conference_title, $mail_name, $mail_title, $mail_code, null, null, $status, $locale));
                break;
            case ('en_report'):
                $model = EnReport::findOrFail($id);
                $model->en_report_status = 3;
                $model->save();
                $mail_email = $model->en_report_email;
                $mail_name = $model->en_report_firstname . ' ' . $model->en_report_lastname;
                $mail_title = $model->en_report_title;
                $mail_code = $model->en_report_code;
                $locale = 'en';
                Mail::to($mail_email)->send(new ReportMail($mail_name, $mail_title, $mail_code, $locale));
                break;
        }
        return Redirect()->back()->with('success', __('alert.mail.successMessage'));
    }
}
