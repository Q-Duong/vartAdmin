<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Exports\ExcelExportVNReport;
use App\Exports\ExcelExportENReport;
use App\Exports\ExcelExportVnRegister;
use App\Exports\ExcelExportEnRegister;
use App\Mail\RegisterMail;
use App\Models\EnRegister;
use App\Models\Payment;
use App\Models\Register;
use App\Mail\ReplyMail;
use App\Mail\ReportMail;
use App\Models\EnReport;
use App\Models\Report;
use Barryvdh\DomPDF\Facade\Pdf;
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
            default:
                return Redirect::back();
        }
    }

    public function print($id)
    {
        $register = Register::findOrFail($id);
        $pdf = Pdf::setOptions(['isHtml5ParserEnabled' => true, 'defaultFont' => 'sans-serif'])->loadView('pdf.receipt_hart', [
            'name' => $register->register_name,
            'phone' => $register->register_phone,
            'unit' => $register->register_work_unit,
            'address' => $register->register_receiving_address,
            'price' => number_format($register->payment->payment_price, 0, ',', '.') . '₫',
            "imgBackground" => parserImgPdf('receipt-hart.png')
        ])->setPaper('a4', 'landscape');
        $filePath = storage_path('app/public/receipt/hart/' . $register->register_code . '.pdf');
        $pdf->save($filePath);
    }

    public function sendMailReply(Request $request, $id)
    {
        switch ($request->type) {
            case ('register'):
                $this->print($id);
                $model = Register::findOrFail($id);
                $mail_email = $model->register_email;
                $mail_name = $model->register_name;
                $mail_title = $model->register_gender;
                $mail_code = $model->register_code;
                $mail_type = $model->payment->conferenceFee->mail_type;
                $locale = 'vn';
                $payment = Payment::findOrFail($model->payment_id);
                $payment->payment_status = 4;
                $payment->save();
                Mail::to($mail_email)->send(new RegisterMail($mail_name, $mail_title, $mail_code, $mail_type, $locale));
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
                $model = Report::findOrFail($id);
                $model->report_status = 3;
                $model->save();
                $mail_email = $model->report_email;
                $mail_name = $model->report_name;
                $mail_title = $model->report_gender;
                $mail_code = $model->report_code;
                $locale = 'vn';
                Mail::to($mail_email)->send(new ReportMail($mail_name, $mail_title, $mail_code, $locale));
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
