<?php

namespace App\Http\Controllers;

use App\Models\Register;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\App;

class SupportController extends Controller
{
    //Invitation Letter
    public function invitationLetter()
    {
        return view('pages.support.invitation');
    }

    public function invitationLetterVip()
    {
        return view('pages.support.invitation_vip');
    }

    public function printInvitation(Request $request)
    {
        switch ($request->_type) {
            case ('en_v'):
                $this->checkFullname($request);
                $title = $request->title;
                $fullName = $request->full_name;
                $time = Carbon::now()->isoFormat('MMMM D, Y');
                $imgLogo = parserImgPdf('vart-logo.png');
                $imgSign = parserImgPdf('Signature.png');
                $pdf = Pdf::setOptions(['isHtml5ParserEnabled' => true])->loadView('pages.support.invitation_letter_vip',  compact('title', 'fullName', 'time', 'imgLogo', 'imgSign'));
                return $pdf->stream('invitation-letter-vip.pdf');
                break;
            case ('vn_v'):
                    $this->checkFullname($request);
                    $title = $request->title;
                    $fullName = $request->full_name;
                    $time = Carbon::now()->isoFormat('MMMM D, Y');
                    $imgLogo = parserImgPdf('vart-logo.png');
                    $imgSign = parserImgPdf('Signature.png');
                    $pdf = Pdf::setOptions(['isHtml5ParserEnabled' => true])->loadView('pages.support.invitation_letter_vip_vn',  compact('title', 'fullName', 'time', 'imgLogo', 'imgSign'));
                    return $pdf->stream('thư-mời-vip.pdf');
                    break;
            case ('en_n'):
                $this->checkFullname($request);
                $title = $request->title;
                $fullName = $request->full_name;
                $time = Carbon::now()->isoFormat('MMMM D, Y');
                $imgLogo = parserImgPdf('vart-logo.png');
                $imgSign = parserImgPdf('Signature.png');
                $pdf = Pdf::setOptions(['isHtml5ParserEnabled' => true])->loadView('pages.support.invitation_letter',  compact('title', 'fullName', 'time', 'imgLogo', 'imgSign'));
                return $pdf->stream('invitation-letter.pdf');
                break;
            case ('vn_n'):
                $this->checkCode($request);
                $register = Register::where('register_code', $request->register_code)->first();
                if($register){
                    $imgBackground = parserImgPdf('backGround.png');
                    $pdf = Pdf::setOptions(['isHtml5ParserEnabled' => true, 'defaultFont' => 'sans-serif'])->loadView('pages.support.invitation_letter_vn',  ["degree" => $register->register_degree == '' ? 'Sinh Viên' : $register->register_degree, "fullName" => $register->register_name, "imgBackground" => $imgBackground])->setPaper('a4', 'landscape');
                    return $pdf->stream('thư-mời.pdf');
                }else{
                    return Redirect::back()->with('error', __('alert.invitation.errorMessage'));
                }
                break;
            default:
                return Redirect::back();
        }
    }
    //Validation
    public function checkFullname(Request $request)
    {
        $this->validate(
            $request,
            [
                'full_name' => 'required|string|regex:/^([^0-9]*)$/',
            ],
            [
                'full_name.required' => __('validation.register.register_name_required'),
                'full_name.regex' => __('validation.register.register_name_regex'),
            ]
        );
    }

    public function checkCode(Request $request)
    {
        $this->validate(
            $request,
            [
                'register_code' => 'required',
            ],
            [
                'register_code.required' => __('validation.register.register_code_required'),
            ]
        );
    }
}
