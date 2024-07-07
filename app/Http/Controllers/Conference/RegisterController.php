<?php

namespace App\Http\Controllers\Conference;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Province;
use App\Models\Register;
use App\Models\Countries;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExcelExportVNReport;
use App\Exports\ExcelExportENReport;
use App\Exports\ExcelExportVnRegister;
use App\Exports\ExcelExportEnRegister;
use App\Mail\ReplyMail;
use App\Models\Academic;
use App\Models\EnRegister;
use App\Models\TempFile;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class RegisterController extends Controller
{
    public function __construct()
    {
    }

    public function indexRegister()
    {
        $getAllConferenceRegister = Register::join('payments', 'payments.id', '=', 'registers.payment_id')
            ->join('conference_fees', 'payments.conference_fee_id', '=', 'conference_fees.id')
            ->select(['registers.id', 'register_code', 'register_degree', 'register_name', 'register_gender', 'register_date', 'register_month', 'register_year', 'register_work_unit', 'register_place_of_birth', 'register_nation', 'register_email', 'register_phone', 'register_object_group', 'conference_fee_title', 'payment_price', 'register_receiving_address', 'registers.created_at', 'register_graduation_year', 'register_image', 'register_image_card', 'payment_image', 'payment_status'])
            ->orderBy('registers.id', 'ASC')->paginate(10);
        $conference_id = 1;
        return view('pages.admin.conferenceRegister.register.indexRegister', compact('getAllConferenceRegister', 'conference_id'));
    }

    public function editRegister($id)
    {
        $register = Register::join('payments', 'payments.id', '=', 'registers.payment_id')
            ->join('conference_fees', 'payments.conference_fee_id', '=', 'conference_fees.id')
            ->select(['registers.id', 'register_code', 'register_degree', 'register_name', 'register_gender', 'register_date', 'register_month', 'register_year', 'register_work_unit', 'register_place_of_birth', 'register_nation', 'register_email', 'register_phone', 'register_object_group', 'conference_fee_title', 'payment_price', 'register_receiving_address', 'registers.created_at', 'register_graduation_year', 'register_image', 'register_image_card', 'payment_image', 'payment_status'])->where('registers.id', $id)->first();
        $getAllAcademic = Academic::orderBy('academic_id', 'asc')->limit(10)->get();
        $getAllProvince = Province::orderby('sort', 'ASC')->orderByRaw("CONVERT(province_name USING utf8mb4) COLLATE utf8mb4_unicode_ci")->get();
        return view('pages.admin.conferenceRegister.register.editRegister', compact('register', 'getAllAcademic', 'getAllProvince'));
    }

    public function updateRegister(Request $request, $id)
    {
        $this->checkRegister($request);
        DB::beginTransaction();
        try {
            $data = $request->all();
            $register = Register::findOrFail($id);
            $register->register_name = mb_strtoupper($data['register_name'], 'UTF-8');
            $register->register_gender = $data['register_gender'];
            $register->register_date = $data['register_date'];
            $register->register_month = $data['register_month'];
            $register->register_year = $data['register_year'];
            $register->register_place_of_birth = $data['register_place_of_birth'];
            $register->register_nation = $data['register_nation'];
            $register->register_object_group = $data['register_object_group'];
            $register->register_work_unit = $data['register_work_unit'];
            $register->register_email = $data['register_email'];
            $register->register_phone = $data['register_phone'];
            $register->register_graduation_year = $data['register_graduation_year'];
            if (!empty($data['register_image'])) {
                $register->register_image = $data['register_image'];
                $tempFile = TempFile::where('folder', $data['register_image'])->first();
                $tempFile->delete();
            }
            if (!empty($data['register_image_card'])) {
                $register->register_image_card = $data['register_image_card'];
                $tempFile = TempFile::where('folder', $data['register_image_card'])->first();
                $tempFile->delete();
            }
            $register->save();
            $payment = Payment::findOrFail($register->payment_id);
            $payment->payment_status = $data['payment_status'];
            if (!empty($data['payment_image'])) {
                $payment->payment_image = $data['payment_image'];
                $tempFile = TempFile::where('folder', $data['payment_image'])->first();
                $tempFile->delete();
            }
            $payment->save();
            DB::commit();
            return redirect()->route('conference_register.index')->with('success', __('alert.conference.successMessage_update'));
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('conference_register.index')->with('error', __('alert.conference.errorMessage_update'));
        }
    }

    public function destroyRegister($id)
    {
        $register = Register::findOrFail($id);
        $payment = Payment::findOrFail($register->payment_id);
        if ($register->register_image) {
            deleteImageFileDrive($register->register_image);
        }
        if ($register->register_image_card) {
            deleteImageFileDrive($register->register_image_card);
        }
        if ($payment->payment_image) {
            deleteImageFileDrive($payment->payment_image);
        }
        $payment->delete();
        return Redirect()->back()->with('success',  __('alert.conference.successMessage_delete'));
    }

    public function indexRegisterInternational()
    {
        $getAllConferenceRegisterInternational = EnRegister::join('payments', 'payments.id', '=', 'en_registers.payment_id')
            ->join('conference_fees', 'payments.conference_fee_id', '=', 'conference_fees.id')
            ->select(['en_registers.id', 'en_register_code', 'en_register_title', 'en_register_firstname', 'en_register_lastname', 'en_register_gender', 'en_register_work_unit', 'en_register_nation', 'en_register_email', 'en_register_phone', 'conference_fee_title', 'payment_price', 'en_registers.created_at', 'payment_status'])
            ->orderBy('en_registers.id', 'ASC')->paginate(10);
        $conference_id = 1;
        return view('pages.admin.conferenceRegister.register.indexRegisterInternational', compact('getAllConferenceRegisterInternational', 'conference_id'));
    }

    public function editRegisterInternational($id)
    {
        $en_register = EnRegister::findOrFail($id);
        $getAllCountries = Countries::all();
        return view('pages.admin.conferenceRegister.register.editRegisterInternational', compact('en_register', 'getAllCountries'));
    }

    public function updateRegisterInternational(Request $request, $id)
    {
        $this->checkEnRegister($request);
        DB::beginTransaction();
        try {
            $data = $request->all();
            $en_register = EnRegister::findOrFail($id);
            $en_register->en_register_title = $data['en_register_title'];
            $en_register->en_register_firstname = mb_strtoupper($data['en_register_firstname'], 'UTF-8');
            $en_register->en_register_lastname = mb_strtoupper($data['en_register_lastname'], 'UTF-8');
            $en_register->en_register_gender = $data['en_register_gender'];
            $en_register->en_register_work_unit = $data['en_register_work_unit'];
            $en_register->en_register_nation = $data['en_register_nation'];
            $en_register->en_register_email = $data['en_register_email'];
            $en_register->en_register_phone = $data['en_register_phone'];
            $en_register->save();
            $payment = Payment::findOrFail($en_register->payment_id);
            $payment->payment_status = $data['payment_status'];
            $payment->save();
            DB::commit();
            return redirect()->route('conference_en_register.index')->with('success',  __('alert.conference.successMessage_update'));
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('conference_en_register.index')->with('error', __('alert.conference.errorMessage_update'));
        }
    }

    public function destroyRegisterInternational($id)
    {
        $en_register = EnRegister::findOrFail($id);
        $payment = Payment::findOrFail($en_register->payment_id);
        $payment->delete();
        return Redirect()->back()->with('success',  __('alert.conference.successMessage_delete'));
    }

    public function sendMailReply(Request $request, $id)
    {
        if ($request->type == 'register') {
            $model = Register::findOrFail($id);
        } else {
            $model = EnRegister::findOrFail($id);
        }
        $payment = Payment::findOrFail($model->payment_id);
        $payment->payment_status = 4;
        $payment->save();
        Mail::to($request->email)->send(new ReplyMail($model, $request->type));
        return Redirect()->back()->with('success', __('alert.mail.successMessage'));
    }

    public function export_excel(Request $request)
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

    //Validation

    public function checkReport(Request $request)
    {
        $this->validate(
            $request,
            [
                'report_name' => 'required|string|regex:/^([^0-9]*)$/',
                'report_phone' => 'required|numeric|digits_between:10,10',
                'report_email' => 'required|email|unique:users,email',
                'report_work_unit' => 'required',
            ],
            [
                'report_name.required' => __('validation.report.report_name_required'),
                'report_phone.required' => __('validation.report.report_phone_required'),
                'report_email.required' => __('validation.report.report_email_required'),
                'report_work_unit.required' => __('validation.report.report_work_unit_required'),
                'report_name.regex' => __('validation.report.report_name_regex'),
                'report_phone.numeric' => __('validation.report.report_phone_numeric'),
                'report_phone.digits_between' => __('validation.report.report_phone_digits_between'),
                'report_email.email' => __('validation.report.report_email_email'),
            ]
        );
    }

    public function checkEnReport(Request $request)
    {
        $this->validate(
            $request,
            [
                'en_report_firstname' => 'required|string|regex:/^([^0-9]*)$/',
                'en_report_lastname' => 'required|string|regex:/^([^0-9]*)$/',
                'en_report_email' => 'required|email|unique:users,email',
                'en_report_organization' => 'required',
                'en_report_department' => 'required',
                'en_report_file_title' => 'required',
            ],
            [
                'en_report_firstname.required' => __('validation.report.en_report_firstname_required'),
                'en_report_lastname.required' => __('validation.report.en_report_lastname_required'),
                'en_report_email.required' => __('validation.report.report_email_required'),
                'en_report_organization.required' => __('validation.report.en_report_organization_required'),
                'en_report_department.required' => __('validation.report.en_report_department_required'),
                'en_report_file_title.required' => __('validation.report.en_report_file_title_required'),
                'en_report_firstname.regex' => __('validation.report.en_report_firstname_regex'),
                'en_report_lastname.regex' => __('validation.report.en_report_lastname_regex'),
            ]
        );
    }

    public function checkRegister(Request $request)
    {
        $this->validate(
            $request,
            [
                'register_name' => 'required|string|regex:/^([^0-9]*)$/',
                'register_email' => 'required|email|unique:users,email',
                'register_phone' => 'required|numeric|digits_between:10,10',
                'register_nation' => 'required',
                'register_receiving_address' => 'required',
                'register_object_group' => 'required',
            ],
            [
                'register_name.required' => __('validation.register.register_name_required'),
                'register_phone.required' => __('validation.register.register_phone_required'),
                'register_email.required' => __('validation.register.register_email_required'),
                'register_object_group.required' => __('validation.register.register_object_group_required'),
                'register_receiving_address.required' => __('validation.register.register_receiving_address_required'),
                'register_nation.required' => __('validation.register.register_nation_required'),
                'register_name.regex' => __('validation.register.register_name_regex'),
                'register_email.email' => __('validation.register.register_email_email'),
                'register_phone.numeric' => __('validation.register.register_phone_numeric'),
                'register_phone.digits_between' => __('validation.register.register_phone_digits_between'),
            ]
        );
    }

    public function checkEnRegister(Request $request)
    {
        $this->validate(
            $request,
            [
                'en_register_firstname' => 'required|string|regex:/^([^0-9]*)$/',
                'en_register_lastname' => 'required|string|regex:/^([^0-9]*)$/',
                'en_register_email' => 'required|email|unique:users,email',
                'en_register_phone' => 'required|numeric',
                'en_register_work_unit' => 'required',
            ],
            [
                'en_register_firstname.required' => __('validation.register.en_register_firstname_required'),
                'en_register_lastname.required' => __('validation.register.en_register_lastname_required'),
                'en_register_email.required' => __('validation.register.en_register_email_required'),
                'en_register_phone.required' => __('validation.register.en_register_phone_required'),
                'en_register_work_unit.required' => __('validation.register.en_register_work_unit_required'),
                'en_register_email.email' => __('validation.register.en_register_email_email'),
                'en_register_phone.numeric' => __('validation.register.en_register_phone_numeric'),
                'en_register_firstname.regex' => __('validation.register.en_register_firstname_regex'),
                'en_register_lastname.regex' => __('validation.register.en_register_lastname_regex'),
            ]
        );
    }
}
