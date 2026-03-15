<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Exports\ExcelExportVNReport;
use App\Exports\ExcelExportENReport;
use App\Exports\ExcelExportVnRegister;
use App\Exports\ExcelExportEnRegister;
use App\Exports\ExcelExportVipRegister;
use App\Mail\CertificateMail;
use App\Mail\RegisterMail;
use App\Models\EnRegister;
use App\Models\Payment;
use App\Models\Register;
use App\Mail\ReportMail;
use App\Models\Conference;
use App\Models\EnReport;
use App\Models\InvitationTemplates;
use App\Models\Report;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Blade;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Mail;

class TestController extends Controller
{
    //invitation
    public function vipInvitation()
    {
        $pdf = Pdf::setOptions(['isHtml5ParserEnabled' => true, 'defaultFont' => 'sans-serif'])->loadView('pages.test.invitation.vip', [
            "title" => 'Kỹ sư',
            'fullName' => 'Huỳnh Quốc Dương',
            'unit' => 'Medicen',
            'imgBackground' => parserImgPdf('defineTemplates/backGround/main.jpg'),
            "imgLogo" => parserImgPdf(choseLogoByConferenceType(2)),
            "imgSign" => parserImgPdf(choseSignatureByConferenceType(2)),
        ]);
        return $pdf->stream('invitation-letter-attendees.pdf');
    }   

    public function registerInvitation($type)
    {
        if ($type == 3) {
            $imgSign = ['hart' => parserImgPdf(choseSignatureByConferenceType(2)), 'hrtta' => parserImgPdf(choseSignatureByConferenceType(3))];
        } else {
            $imgSign = parserImgPdf(choseSignatureByConferenceType($type));
        }
        $pdf = Pdf::setOptions(['isHtml5ParserEnabled' => true, 'defaultFont' => 'sans-serif'])->loadView('pages.test.invitation.register', [
            "degree" => 'Kỹ sư',
            'fullName' => 'Huỳnh Quốc Dương',
            'unit' => 'Medicen',
            'imgBackground' => parserImgPdf('defineTemplates/backGround/main.jpg'),
            "imgLogo" => parserImgPdf(choseLogoByConferenceType(3)),
            "imgSign" => $imgSign,
        ]);
        return $pdf->stream('invitation-letter-attendees.pdf');
    }

    public function agencyInvitation()
    {
        $pdf = Pdf::setOptions(['isHtml5ParserEnabled' => true, 'defaultFont' => 'sans-serif'])->loadView('pages.test.invitation.agency', [
            "title" => 'Kỹ sư',
            'fullName' => 'Huỳnh Quốc Dương',
            'unit' => 'Medicen',
            'imgBackground' => parserImgPdf('defineTemplates/backGround/main.jpg'),
            "imgLogo" => parserImgPdf(choseLogoByConferenceType(4)),
            "imgSign" => parserImgPdf(choseSignatureByConferenceType(4)),
        ]);
        return $pdf->stream('invitation-letter-attendees.pdf');
    }

    public function Mail()
    {
        return view('mail.report.vart.international')->with([
            'title' => 'Mr.',
            'name' => 'Huỳnh Quốc Dương',
            'code' => 'LTCB0943705326',
            'conference_title' => 'Hội Thảo Khoa học ISRRT RT-RTT
                Kỹ Thuật Hình Ảnh Y Học và Kỹ Thuật Xạ Trị',

            // 'title' => 0,
            // 'name' => 'Huỳnh Quốc Dương',
            // 'code' => 'LTCB0943705326',
            // 'conference_title' => 'Hội Nghị Khoa Học Thường Niên Chi Hội Kỹ Thuật Xạ Trị Tp. Hồ Chí Minh Lần 3',
        ]);
    }

    public function invoice()
    {
        $pdf = Pdf::setOptions(['isHtml5ParserEnabled' => true, 'defaultFont' => 'sans-serif'])->loadView('pdf.invoice.hrtta', [
            'name' => 'Huỳnh Quốc Dương', 
            'phone' => '0943705326',
            'unit' => 'Medicen',
            'address' => '33,Phường 11,Thành phố Vũng Tàu,Tỉnh Bà Rịa - Vũng Tàu',
            'price' => '980.000₫',
            'conferenceTitle' => 'Hội nghị Khoa học Quốc tế kỹ thuật Điện quang, Y học hạt nhân và Xạ trị khu vực phía Bắc, lần thứ VIII',
            'conferenceFeeTitle' => 'Phí tham gia trực tuyến có cấp giấy chứng nhận CME',
            "imgSignature" => parserImgPdf(choseSignatureByConferenceType(2)),
            // 'imgLogo' => parserImgPdf('defineTemplates/logo/vart.png'), 
            'imgLogo' => [
                'hartLogo' => parserImgPdf('defineTemplates/logo/hart.png'), 
                'hrttaLogo' => parserImgPdf('defineTemplates/logo/hrtta.png'), 
            ],
        ])->setPaper('a4', 'landscape');
        return $pdf->stream('invitation-letter-attendees.pdf');
    }

    public function createCertificate($data)
    {
        $pdf = Pdf::setOptions(['isHtml5ParserEnabled' => true, 'defaultFont' => 'sans-serif'])->loadView('pdf.certificate', [
            'name' => $data->register_name,
            'birthday' => $data->register_date . '/' . $data->register_month . '/' . $data->register_year,
            'unit' => $data->register_work_unit,
            "imgBackground" => parserImgPdf('defineTemplates/backGround/certificate.jpg')
        ]);
        $filePath = storage_path('app/public/certificate/' . $data->register_code . '.pdf');
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
                    'child_conference',
                    'parent_title',
                )
                    ->firstWhere('conferences.id', $model->conference_id);

                $mail_conference_type = $conference->conference_type_name;
                $mail_conference_title = $conference->child_conference ? $conference->parent_title : $conference->conference_title;
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
                    'child_conference',
                    'parent_title', 
                )
                    ->firstWhere('conferences.id', $model->conference_id);
                $mail_conference_type = $conference->conference_type_name;
                $mail_conference_title = $conference->child_conference ? $conference->parent_title : $conference->conference_title;
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

    public function sendCertificate(Request $request)
    {
        $conference = Conference::join('conference_types', 'conference_types.id', 'conferences.conference_type_id')->select(
            'conference_type_name',
            'conferences.id',
            'conference_title',
            'conference_title_en',
        )
            ->where('conferences.id', $request->conference_id)
            ->first();
        $mail_conference_type = $conference->conference_type_name;
        $mail_conference_title = $conference->conference_title;
        $getAllConferenceRegister = Register::join('payments', 'payments.id', '=', 'registers.payment_id')
            ->join('conference_fees', 'payments.conference_fee_id', '=', 'conference_fees.id')
            ->select(
                'registers.conference_id',
                'payment_id',
                'registers.id',
                'register_code',
                'register_name',
                'register_gender',
                'register_date',
                'register_month',
                'register_year',
                'register_email',
                'register_work_unit',
                'registers.created_at',
                'payment_status'
            )
            ->where('registers.conference_id', $request->conference_id)
            ->orderBy('registers.id', 'DESC')
            ->paginate(10, ['*'], 'page', $request->current_page)->items();
        foreach ($getAllConferenceRegister as $register) {
            Mail::to($register->register_email)->send(new CertificateMail($mail_conference_type, $mail_conference_title, $register->register_name, $register->register_gender, $register->register_code, 'vn'));
            // $this->createCertificate($register);
        }
    }
}
