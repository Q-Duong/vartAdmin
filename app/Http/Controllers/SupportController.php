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
use Illuminate\Support\Str;

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
        $register = Register::with([
            'fees' => function ($query) {
                $query->select('conference_fees.id', 'conference_fee_title');
            },
            'payment' => function ($query) {
                $query->select('payments.id', 'payment_price');
            },
            'member' => function ($query) {
                $query->select('members.id', 'member_full_name', 'member_work_unit', 'member_phone', 'member_full_address');
            },
            'conference' => function ($query) {
                $query->select('conferences.id', 'conference_title', 'conference_type_id');
            },
            'conference.conferenceType' => function ($query) {
                $query->select('conference_types.id', 'conference_type_name');
            }
        ])
            ->firstWhere('id', $id);

        if ($register->conference?->conference_type_id == 3) {
            $imgLogo = ['hart' => parserImgPdf(choseLogoByConferenceType(2)), 'hrtta' => parserImgPdf(choseLogoByConferenceType(3))];
            $imgSignature = parserImgPdf(choseSignatureByConferenceType(2));
        } else {
            $imgLogo = parserImgPdf(choseLogoByConferenceType($register->conference?->conference_type_id));
            $imgSignature = parserImgPdf(choseSignatureByConferenceType($register->conference?->conference_type_id));
        }

        $pdf = Pdf::setOptions(['isHtml5ParserEnabled' => true, 'defaultFont' => 'sans-serif'])
            ->loadView('pdf.invoice.' . Str::lower($register->conference->conferenceType->conference_type_name), [
                'name' => Str::title($register->member?->member_full_name),
                'phone' => $register->member?->member_phone,
                'unit' => $register->member?->member_work_unit,
                'address' => $register->member?->member_full_address,
                'price' => number_format($register->payment?->payment_price, 0, ',', '.') . '₫',
                'conferenceTitle' => $register->conference?->conference_title,
                'conferenceFeeTitle' => $register->fees?->implode('conference_fee_title', ', '),
                "imgSignature" => $imgSignature,
                'imgLogo' => $imgLogo,
            ])->setPaper('a4', 'landscape');

        $filePath = storage_path('app/public/invoice/' . $register->register_code . '.pdf');
        $pdf->save($filePath);
    }

    public function createInvitation($id, $type)
    {
        if ($type == 'register') {
            $register = Register::with([
                'member' => function ($query) {
                    $query->select('members.id', 'member_degree', 'member_full_name', 'member_work_unit');
                },
                'conference' => function ($query) {
                    $query->select('conferences.id', 'conference_type_id');
                }
            ])
                ->firstWhere('id', $id);

            $invitation_template = InvitationTemplates::where('conference_id', $register->conference?->id)->where('type', 'vn_att')->first();
            $imgLogo = parserImgPdf(choseLogoByConferenceType($register->conference?->conference_type_id));
            if ($register->conference?->conference_type_id == 3) {
                $imgSign = ['hart' => parserImgPdf(choseSignatureByConferenceType(2)), 'hrtta' => parserImgPdf(choseSignatureByConferenceType(3))];
            } else {
                $imgSign = parserImgPdf(choseSignatureByConferenceType($register->conference?->conference_type_id));
            }
            $code = $register->register_code;
            $data = [
                "degree" => $register->member?->member_degree == '' ? 'Sinh Viên' : $register->member?->member_degree,
                'fullName' => Str::title($register->member?->member_full_name),
                'unit' => $register->member?->member_work_unit,
                'imgBackground' => parserImgPdf('defineTemplates/backGround/main.jpg'),
                'imgLogo' => $imgLogo,
                'imgSign' => $imgSign
            ];
        } else {
            $report = Report::with([
                'member' => function ($query) {
                    $query->select('members.id', 'member_degree', 'member_title', 'member_full_name', 'member_work_unit');
                },
                'conference' => function ($query) {
                    $query->select('conferences.id', 'conference_type_id');
                }
            ])
                ->firstWhere('id', $id);

            $templateType = $report->locale === 'en' ? 'en_vs' : 'vn_vs';
            $invitation_template = InvitationTemplates::where('conference_id', $report->conference?->id)->where('type', $templateType)->first();
            $imgLogo = parserImgPdf(choseLogoByConferenceType($report->conference?->conference_type_id));

            if ($report->conference?->conference_type_id == 3) {
                $imgSign = ['hart' => parserImgPdf(choseSignatureByConferenceType(2)), 'hrtta' => parserImgPdf(choseSignatureByConferenceType(3))];
            } else {
                $imgSign = parserImgPdf(choseSignatureByConferenceType($report->conference?->conference_type_id));
            }

            $data = [
                'fullName'      => Str::title($report->member?->member_full_name),
                'unit'          => $report->member?->member_work_unit,
                'imgBackground' => parserImgPdf('defineTemplates/backGround/main.jpg'),
                'imgLogo'       => $imgLogo,
                'imgSign'       => $imgSign,
            ];

            if ($report->locale === 'en') {
                $data['title'] = $report->member?->member_title;
            } else {
                $data['degree'] = $report->member?->member_degree ?: 'Sinh Viên';
            }

            $code = $report->report_code;
        }
        $template = Blade::render(
            $invitation_template->content,
            $data
        );
        $pdf = Pdf::setOptions(['isHtml5ParserEnabled' => true])->loadHTML($template);
        $filePath = storage_path('app/public/invitation/' . $code . '.pdf');
        $pdf->save($filePath);
    }

    public function createCertificate($data, $no)
    {
        // $title = $data->register_gender == 0 ? 'Ông' : 'Bà';

        $pdf = Pdf::setOptions(['isHtml5ParserEnabled' => true, 'defaultFont' => 'sans-serif'])->loadView('pdf.certificate.certificate', [
            // 'no' => $no + 187,
            // 'name' => $title . ' ' . $data->register_name,
            // 'birthday' => $data->register_date . '/' . $data->register_month . '/' . $data->register_year,
            // 'unit' => $data->register_work_unit,
            'name' => $data->en_register_firstname . ' ' . $data->en_register_lastname,
            'title' => $data->en_register_title,
            "imgBackground" => parserImgPdf('defineTemplates/backGround/certificate-nvart-2025.jpg')
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
                $model = Register::with([
                    'fees' => function ($query) {
                        $query->select('conference_fees.id', 'conference_fee_title');
                    },
                    'payment' => function ($query) {
                        $query->select('payments.id', 'payment_status');
                    },
                    'member' => function ($query) {
                        $query->select('members.id', 'member_gender', 'member_full_name', 'member_email', 'member_full_address');
                    },
                    'conference' => function ($query) {
                        $query->select('conferences.id', 'conference_title', 'conference_title_en', 'child_conference', 'parent_title', 'conference_type_id'); // BẮT BUỘC: Khóa ngoại để nối sang bảng conference_types
                    },
                    'conference.conferenceType' => function ($query) {
                        $query->select('conference_types.id', 'conference_type_name');
                    }
                ])
                    ->firstWhere('id', $id);

                $model->payment->payment_status = 4;
                $model->payment->save();

                $conference_type = $model->conference->conferenceType->conference_type_name;
                $conference_title = $model->conference?->child_conference ? $model->conference?->parent_title : $model->conference?->conference_title;
                $conference_fee_title = $model->fees?->implode('conference_fee_title', ', ');
                $name = $model->member->member_full_name;
                $title = $model->member->member_gender;
                $code = $model->register_code;
                $type = mb_substr($model->register_code, 0, 2);


                Mail::to($model->member->member_email)->send(new RegisterMail($conference_type, $conference_title, $conference_fee_title, $name, $title, $code, $type, 'vn'));
                break;
            case ('report'):
                $this->createInvitation($id, 'report');
                $model = Report::with([
                    'member' => function ($query) {
                        $query->select('members.id', 'member_gender', 'member_title', 'member_full_name', 'member_email', 'member_full_address');
                    },
                    'conference' => function ($query) {
                        $query->select('conferences.id', 'conference_title', 'conference_title_en', 'child_conference', 'parent_title', 'conference_type_id');
                    },
                    'conference.conferenceType' => function ($query) {
                        $query->select('conference_types.id', 'conference_type_name');
                    }
                ])->firstWhere('id', $id);

                $model->report_status = 3;
                $model->save();

                $conference_type = $model->conference->conferenceType->conference_type_name;

                if ($model->locale == 'en') {
                    $conference_title = $model->conference?->conference_title_en;
                    $title = $model->member->member_title;
                } else {
                    $conference_title = $model->conference?->child_conference ? $model->conference?->parent_title : $model->conference?->conference_title;
                    $title = $model->member->member_gender;
                }

                $name = $model->member->member_full_name;
                $code = $model->report_code;
                $status = $model->report_status;
                $locale = $model->locale;
                Mail::to($model->member->member_email)->send(new ReportMail($conference_type, $conference_title, $name, $title, $code, null, null, $status, $locale));
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
        $mail_conference_title = $conference->conference_title_en;
        // $registers = Register::join('payments', 'payments.id', '=', 'registers.payment_id')
        //     ->join('conference_fees', 'payments.conference_fee_id', '=', 'conference_fees.id')
        //     ->select(
        //         'registers.conference_id',
        //         'payment_id',
        //         'registers.id',
        //         'register_code',
        //         'register_name',
        //         'register_gender',
        //         'register_date',
        //         'register_month',
        //         'register_year',
        //         'register_email',
        //         'register_work_unit',
        //         'register_cme_type',
        //         'registers.created_at',
        //         'payment_status'
        //     )
        //     ->where('registers.conference_id', $request->conference_id)
        //     ->where('registers.register_cme_type', 'E_CME')
        //     ->orderBy('registers.id', 'DESC')
        //     ->paginate(10, ['*'], 'page', $request->current_page)->items();

        // Inter
        $getAllConferenceEnRegister = EnRegister::select(
            'en_registers.conference_id',
            'en_registers.id',
            'en_register_code',
            'en_register_firstname',
            'en_register_lastname',
            'en_register_title',
            'en_register_email',
            'en_registers.created_at',
        )
            ->where('en_registers.conference_id', $request->conference_id)
            ->orderBy('en_registers.id', 'DESC')
            ->paginate(10, ['*'], 'page', $request->current_page)->items();

        foreach ($getAllConferenceEnRegister as $key => $register) {
            // Mail::to($register->register_email)->send(new CertificateMail($mail_conference_type, $mail_conference_title, $register->register_name, $register->register_gender, $register->register_code, 'vn'));

            Mail::to($register->en_register_email)->send(new CertificateMail($mail_conference_type, $mail_conference_title, $register->en_register_firstname . ' ' . $register->en_register_lastname, $register->en_register_title, $register->en_register_code, 'en'));
            $this->createCertificate($register, $key);
        }
    }
}
