<?php

namespace App\Http\Controllers;

use App\Models\Conference;
use App\Models\ConferenceCategory;
use App\Models\ConferenceFee;
use App\Models\ConferenceType;
use App\Models\District;
use App\Models\EnReport;
use App\Models\Payment;
use App\Models\Province;
use App\Models\Register;
use App\Models\Report;
use App\Models\Wards;
use App\Models\Countries;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExcelExportVNReport;
use App\Exports\ExcelExportENReport;
use App\Exports\ExcelExportVnRegister;
use App\Exports\ExcelExportEnRegister;
use App\Mail\MailAcceptanceEN;
use App\Mail\ReplyMail;
use App\Models\Academic;
use App\Models\EnRegister;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class ConferenceController extends Controller
{
    private $locale;
    private $folder;

    public function __construct()
    {
        $this->locale = App::getLocale();
        $this->folder = 'conference';
    }

    public function add()
    {
        $getAllConferenceCategory = ConferenceCategory::orderBy('conference_category_id', 'ASC')->get();
        $getAllConferenceType = ConferenceType::orderBy('conference_type_id', 'ASC')->get();
        return view('admin.Conference.add')->with(compact('getAllConferenceCategory', 'getAllConferenceType'));
    }

    public function list()
    {
        $getAllConference = Conference::orderBy('conference_id', 'ASC')->get();
        return view('admin.Conference.list')->with(compact('getAllConference'));
    }
    public function save(Request $request)
    {
        $data = $request->all();
        $conference = new Conference();
        $conference->conference_code = $data['conference_code'];
        $conference->conference_title = $data['conference_title'];
        $conference->conference_title_en = $data['conference_title_en'];
        $conference->conference_slug = $data['conference_slug'];
        $conference->conference_content = $data['conference_content'];
        $conference->conference_content_en = $data['conference_content_en'];
        $conference->conference_category_id = $data['conference_category_id'];
        $conference->conference_type_id = $data['conference_type_id'];
        $conference->conference_form_type = 1;
        if (Conference::where('conference_title', $conference->conference_image)->exists()) {
            return Redirect()->back()->with('error', 'Danh mục đã tồn tại, Vui lòng kiểm tra lại.');
        }
        if (Conference::where('conference_code', $data['conference_code'])->exists()) {
            return Redirect()->back()->with('error', 'Danh mục đã tồn tại, Vui lòng kiểm tra lại.');
        }
        $get_image = $request->file('conference_image');
        if ($get_image) {
            $conference->conference_image = saveImageSource($this->folder, $get_image);
        }
        $get_image_en = $request->file('conference_image_en');
        if ($get_image_en) {
            $conference->conference_image_en = saveImageSource($this->folder, $get_image_en);
        }
        $conference->save();

        return Redirect()->back()->with('success', 'Thêm danh mục bài viết thành công');
    }

    public function edit($conference_id)
    {
        $getAllConferenceCategory = ConferenceCategory::orderBy('conference_category_id', 'ASC')->get();
        $getAllConferenceType = ConferenceType::orderBy('conference_type_id', 'ASC')->get();
        $conference = Conference::find($conference_id);
        $getAllConferenceFee = ConferenceFee::where('conference_id', $conference_id)->get();
        return view('admin.Conference.edit')->with(compact('conference', 'getAllConferenceCategory', 'getAllConferenceType', 'getAllConferenceFee'));
    }
    public function update(Request $request, $conference_id)
    {
        $data = $request->all();
        $conference = Conference::findOrFail($conference_id);
        $conference->conference_code = $data['conference_code'];
        $conference->conference_title = $data['conference_title'];
        $conference->conference_title_en = $data['conference_title_en'];
        $conference->conference_slug = $data['conference_slug'];
        $conference->conference_content = $data['conference_content'];
        $conference->conference_content_en = $data['conference_content_en'];
        $conference->conference_category_id = $data['conference_category_id'];
        $conference->conference_type_id = $data['conference_type_id'];
        $get_image = $request->file('conference_image');
        if ($get_image) {
            if ($conference->conference_image) {
                removeImageSource($this->folder, $conference->conference_image);
            }
            $conference->conference_image = saveImageSource($this->folder, $get_image);
        }
        $get_image_en = $request->file('conference_image_en');
        if ($get_image_en) {
            if ($conference->conference_image_en) {
                removeImageSource($this->folder, $conference->conference_image_en);
            }
            $conference->conference_image_en = saveImageSource($this->folder, $get_image_en);
        }
        $conference->save();

        return Redirect()->Route('listConference')->with('success', 'Cập nhật danh mục bài viết thành công');
    }
    public function delete($conference_id)
    {
        $conference = Conference::findOrFail($conference_id);
        if ($conference->conference_image) {
            removeImageSource($this->folder, $conference->conference_image);
        }
        if ($conference->conference_image_en) {
            removeImageSource($this->folder, $conference->conference_image_en);
        }
        $conference->delete();
        return Redirect()->back()->with('success', 'Xóa danh mục bài viết thành công');
    }

    public function loadConferenceFee(Request $request)
    {
        $getAllConferenceFee = ConferenceFee::where('conference_id', $request->conference_id)->get();
        $html = view('admin.Conference.loadConferenceFee')->with(compact('getAllConferenceFee'))->render();
        return response()->json(array('success' => true, 'html' => $html));
    }

    public function addConferenceFee(Request $request)
    {
        // $this->checkPostAdd($request);
        $data = $request->all();
        // dd($data);
        $conferenceFee = new ConferenceFee();
        $conferenceFee->conference_id = $data['conference_id'];
        $conferenceFee->conference_fee_title = $data['conference_fee_title'];
        $conferenceFee->conference_fee_price = $data['conference_fee_price'];
        $conferenceFee->conference_fee_date = $data['conference_fee_date'];
        $conferenceFee->conference_fee_content = $data['conference_fee_content'];
        $conferenceFee->conference_fee_desc = $data['conference_fee_desc'];
        $conferenceFee->save();
        return response()->json(array('message' => __('alert.blog.successfulNotification'), 'success' => true));
    }

    public function updateConferenceFee(Request $request)
    {
        // $this->checkPostAdd($request);
        $data = $request->all();
        $conferenceFee = ConferenceFee::find($data['conference_fee_id']);
        $conferenceFee->conference_fee_title = $data['conference_fee_title'];
        $conferenceFee->conference_fee_price = $data['conference_fee_price'];
        $conferenceFee->conference_fee_date = $data['conference_fee_date'];
        $conferenceFee->conference_fee_content = $data['conference_fee_content'];
        $conferenceFee->conference_fee_desc = $data['conference_fee_desc'];
        $conferenceFee->save();
        return response()->json(array('message' => __('alert.blog.successfulNotification'), 'success' => true));
    }

    public function deleteConferenceFee($conference_fee_id)
    {
        $conferenceFee = ConferenceFee::find($conference_fee_id);
        $conferenceFee->delete();
        return response()->json(array('message' => __('alert.blog.successfulNotification'), 'success' => true));
    }

    public function listReport()
    {
        $getAllConferenceReport = Report::orderBy('report_id', 'ASC')->paginate(10);
        $conference_id = 1;
        return view('admin.Conference.Register.listReport')->with(compact('getAllConferenceReport', 'conference_id'));
    }

    public function editReport($report_id)
    {
        $report = Report::findOrFail($report_id);
        $getAllAcademic = Academic::select(['academic_title'])->get();
        $getAllProvince = Province::orderby('sort', 'ASC')->orderByRaw("CONVERT(province_name USING utf8mb4) COLLATE utf8mb4_unicode_ci")->get();
        return view('admin.Conference.Register.editReport', compact('report', 'getAllAcademic', 'getAllProvince'));
    }

    public function updateReport(Request $request, $report_id)
    {
        $this->checkReport($request);
        $data = $request->all();
        $report = Report::findOrFail($report_id);
        $report->report_name = mb_strtoupper($data['report_name'], 'UTF-8');
        $report->report_degree = $data['report_degree'];
        $report->report_gender = $data['report_gender'];
        $report->report_date = $data['report_date'];
        $report->report_month = $data['report_month'];
        $report->report_year = $data['report_year'];
        $report->report_work_unit = $data['report_work_unit'];
        $report->report_place_of_birth = $data['report_place_of_birth'];
        $report->report_email = $data['report_email'];
        $report->report_phone = $data['report_phone'];
        $report->report_graduation_year = $data['report_graduation_year'];
        $report->report_status = $data['report_status'];
        $report->save();
        return redirect()->route('listConferenceReport')->with('success', 'Update successful');
    }

    public function deleteReport($report_id)
    {
        $report = Report::findOrFail($report_id);
        if ($report->report_image) {
            deleteImageFileDrive($report->report_image);
        }
        if ($report->report_image_card) {
            deleteImageFileDrive($report->report_image_card);
        }
        if ($report->report_file) {
            deleteImageFileDrive($report->report_file);
        }
        $report->delete();
        return Redirect()->back()->with('success', 'Deleted successfully');
    }

    public function listReportInternational()
    {
        $getAllConferenceReportInternational = EnReport::orderBy('en_report_id', 'ASC')->paginate(10);
        $conference_id = 1;
        return view('admin.Conference.Register.listReportInternational')->with(compact('getAllConferenceReportInternational', 'conference_id'));
    }

    public function editReportInternational($en_report_id)
    {
        $en_report = EnReport::findOrFail($en_report_id);
        $getAllCountries = Countries::all();
        return view('admin.Conference.Register.editReportInternational', compact('en_report', 'getAllCountries'));
    }

    public function updateReportInternational(Request $request, $en_report_id)
    {
        $this->checkEnReport($request);
        $data = $request->all();
        $en_report = EnReport::findOrFail($en_report_id);
        $en_report->en_report_title = $data['en_report_title'];
        $en_report->en_report_firstname = mb_strtoupper($data['en_report_firstname'], 'UTF-8');
        $en_report->en_report_lastname = mb_strtoupper($data['en_report_lastname'], 'UTF-8');
        $en_report->en_report_date = $data['en_report_date'];
        $en_report->en_report_month = $data['en_report_month'];
        $en_report->en_report_year = $data['en_report_year'];
        $en_report->en_report_email = $data['en_report_email'];
        $en_report->en_report_profession = $data['en_report_profession'];
        $en_report->en_report_organization = $data['en_report_organization'];
        $en_report->en_report_department = $data['en_report_department'];
        $en_report->en_report_nationality = $data['en_report_nationality'];
        $en_report->en_report_file_title = $data['en_report_file_title'];
        $en_report->en_report_status = $data['en_report_status'];
        $en_report->save();
        return redirect()->route('listConferenceReportInternational')->with('success', 'Update successful');
    }

    public function deleteReportInternational($en_report_id)
    {
        $en_report = EnReport::findOrFail($en_report_id);
        if ($en_report->en_report_file) {
            deleteImageFileDrive($en_report->en_report_file);
        }
        $en_report->delete();
        return Redirect()->back()->with('success', 'Deleted successfully');
    }

    public function listRegister()
    {
        $getAllConferenceRegister = Register::join('payment', 'payment.payment_id', '=', 'register.payment_id')
            ->join('conference_fee', 'payment.conference_fee_id', '=', 'conference_fee.conference_fee_id')
            ->select(['register.register_id', 'register_code', 'register_degree', 'register_name', 'register_gender', 'register_date', 'register_month', 'register_year', 'register_work_unit', 'register_place_of_birth', 'register_nation', 'register_email', 'register_phone', 'register_object_group', 'conference_fee_title', 'payment_price', 'register_receiving_address', 'register.created_at', 'register_graduation_year', 'register_image', 'register_image_card', 'payment_image', 'payment_status'])
            ->orderBy('register.register_id', 'ASC')->paginate(10);
        $conference_id = 1;
        return view('admin.Conference.Register.listRegister')->with(compact('getAllConferenceRegister', 'conference_id'));
    }

    public function editRegister($register_id)
    {
        $register = Register::findOrFail($register_id);
        $getAllAcademic = Academic::orderBy('academic_id', 'asc')->limit(10)->get();
        $getAllProvince = Province::orderby('sort', 'ASC')->orderByRaw("CONVERT(province_name USING utf8mb4) COLLATE utf8mb4_unicode_ci")->get();
        return view('admin.Conference.Register.editRegister', compact('register', 'getAllAcademic', 'getAllProvince'));
    }

    public function updateRegister(Request $request, $register_id)
    {
        $this->checkRegister($request);
        $data = $request->all();
        $register = Register::findOrFail($register_id);
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
        $register->save();
        $payment = Payment::findOrFail($register->payment_id);
        $payment->payment_status = $data['payment_status'];
        $payment->save();
        return redirect()->route('listConferenceRegister')->with('success', 'Update successful');
    }

    public function deleteRegister($register_id)
    {
        $register = Register::findOrFail($register_id);
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
        return Redirect()->back()->with('success', 'Deleted successfully');
    }

    public function listRegisterInternational()
    {
        $getAllConferenceRegisterInternational = EnRegister::join('payment', 'payment.payment_id', '=', 'en_register.payment_id')
            ->join('conference_fee', 'payment.conference_fee_id', '=', 'conference_fee.conference_fee_id')
            ->select(['en_register.en_register_id', 'en_register_code', 'en_register_title', 'en_register_firstname', 'en_register_lastname', 'en_register_gender', 'en_register_work_unit', 'en_register_nation', 'en_register_email', 'en_register_phone', 'conference_fee_title', 'payment_price', 'en_register.created_at', 'payment_status'])
            ->orderBy('en_register.en_register_id', 'ASC')->paginate(10);
        $conference_id = 1;
        return view('admin.Conference.Register.listRegisterInternational')->with(compact('getAllConferenceRegisterInternational', 'conference_id'));
    }

    public function editRegisterInternational($en_register_id)
    {
        $en_register = EnRegister::findOrFail($en_register_id);
        $getAllCountries = Countries::all();
        return view('admin.Conference.Register.editRegisterInternational', compact('en_register', 'getAllCountries'));
    }

    public function updateRegisterInternational(Request $request, $en_register_id)
    {
        $this->checkEnRegister($request);
        $data = $request->all();
        $en_register = EnRegister::findOrFail($en_register_id);
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
        return redirect()->route('listConferenceRegisterInternational')->with('success', 'Update successful');
    }

    public function deleteRegisterInternational($en_register_id)
    {
        $en_register = EnRegister::findOrFail($en_register_id);
        $payment = Payment::findOrFail($en_register->payment_id);
        $payment->delete();
        return Redirect()->back()->with('success', 'Deleted successfully');
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
        return Redirect()->back()->with('success', 'Đã gửi mail thành công');
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

    //////
    public function showConferenceCategory(Request $request, $conference_category_slug)
    {
        $conferenceCategory = ConferenceCategory::where('conference_category_slug', $conference_category_slug)->first();
        $getAllConference = Conference::where('conference_category_id', $conferenceCategory->conference_category_id)->get();
        return view('pages.conference.conference_categories')->with(compact('conferenceCategory', 'getAllConference'));
    }

    public function showConferenceDetails(Request $request, $conference_category_slug, $conference_slug)
    {
        $conferenceCategory = ConferenceCategory::where('conference_category_slug', $conference_category_slug)->first();
        $conference = Conference::where('conference_category_id', $conferenceCategory->conference_category_id)->where('conference_slug', $conference_slug)->first();
        $getConferenceFee = ConferenceFee::where('conference_id', $conference->conference_id);
        $totalObjects = 0;
        if ($this->locale == 'en') {
            $getAllConferenceFee = $getConferenceFee->where('conference_fee_type', 2)->get();
            $totalObjects = count($getAllConferenceFee);
        } else {
            $getAllConferenceFee = $getConferenceFee->where('conference_fee_type', 1)->get();
            $totalObjects = count($getAllConferenceFee);
        }
        return view('pages.conference.conference_details')->with(compact('conferenceCategory', 'conference', 'getAllConferenceFee', 'totalObjects'));
    }

    public function showRegisterReport(Request $request, $conference_code)
    {
        $conference = Conference::where('conference_code', $conference_code)->first();
        $getAllAcademic = Academic::orderBy('academic_id', 'asc')->get();
        $province = Province::orderby('sort', 'ASC')->orderByRaw("CONVERT(province_name USING utf8mb4) COLLATE utf8mb4_unicode_ci")->get();
        return view('pages.conference.register_report', compact('conference', 'province', 'getAllAcademic'));
    }

    public function showRegisterReportInternational(Request $request, $conference_code)
    {
        $conference = Conference::where('conference_code', $conference_code)->first();
        $countries = Countries::all();
        return view('pages.conference.register_report_international', compact('conference', 'countries'));
    }

    public function showRegisterConference(Request $request, $conference_code, $conference_fee)
    {
        $conference = Conference::where('conference_code', $conference_code)->first();
        $conference_fee = ConferenceFee::where('conference_fee_id', $conference_fee)->first();
        $getAllAcademic = Academic::orderBy('academic_id', 'asc')->limit(10)->get();
        $province = Province::orderby('sort', 'ASC')->orderByRaw("CONVERT(province_name USING utf8mb4) COLLATE utf8mb4_unicode_ci")->get();
        return view('pages.conference.register_conference', compact('conference', 'province', 'conference_fee', 'getAllAcademic'));
    }

    public function showRegisterConferenceInternational(Request $request, $conference_code, $conference_fee)
    {
        $conference = Conference::where('conference_code', $conference_code)->first();
        $conference_fee = ConferenceFee::where('conference_fee_id', $conference_fee)->first();
        $countries = Countries::all();
        return view('pages.conference.register_conference_international')->with(compact('conference', 'countries', 'conference_fee'));
    }

    public function registerReportSubmit(Request $request)
    {
        $validator = Validator::make($request->all(), $this->validateRegisterReport($request->report_degree, $this->locale), $this->messageRegisterReport());
        if ($validator->fails()) {
            return response()->json(array('errors' => true, 'validator' => $validator->errors()));
        }
        DB::beginTransaction();
        try {
            $data = $request->all();
            if ($this->locale == 'en') {
                $en_report = new EnReport();
                $en_report->conference_id = $data['conference_id'];
                $en_report->en_report_title = $data['en_report_title'];
                $en_report->en_report_firstname = mb_strtoupper($data['en_report_firstname'], 'UTF-8');
                $en_report->en_report_lastname = mb_strtoupper($data['en_report_lastname'], 'UTF-8');
                $en_report->en_report_email = $data['en_report_email'];
                $en_report->en_report_date = $data['en_report_date'];
                $en_report->en_report_month = $data['en_report_month'];
                $en_report->en_report_year = $data['en_report_year'];
                $en_report->en_report_profession = $data['en_report_profession'];
                $en_report->en_report_organization = $data['en_report_organization'];
                $en_report->en_report_department = $data['en_report_department'];
                $en_report->en_report_nationality = $data['en_report_nationality'];
                $en_report->en_report_file_title = $data['en_report_file_title'];
                $en_report_file = $request->file('en_report_file');
                if ($en_report_file) {
                    $en_report->en_report_file = saveImageFileDrive($en_report_file);
                }
                $en_report->save();
            } else {
                $report = new Report();
                $report->conference_id = $data['conference_id'];
                $report->report_name = mb_strtoupper($data['report_name'], 'UTF-8');
                $report->report_degree = $data['report_degree'];
                $report->report_gender = $data['report_gender'];
                $report->report_date = $data['report_date'];
                $report->report_month = $data['report_month'];
                $report->report_year = $data['report_year'];
                $report->report_work_unit = $data['report_work_unit'];
                $report->report_place_of_birth = $data['report_place_of_birth'];
                $report->report_email = $data['report_email'];
                $report->report_phone = $data['report_phone'];
                $report->report_graduation_year = $data['report_graduation_year'];
                $report->report_policy = 1;

                $report_file = $request->file('report_file');
                if ($report_file) {
                    $report->report_file = saveImageFileDrive($report_file);
                }

                $report_image = $request->file('report_image');
                if ($report_image) {
                    $report->report_image = saveImageFileDrive($report_image);
                }

                $report_image_card = $request->file('report_image_card');
                if ($report_image_card) {
                    $report->report_image_card = saveImageFileDrive($report_image_card);
                }
                $report->save();
            }
            DB::commit();
            return response()->json(array('success' => true, 'route' => 'notification'));
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(array('success' => false, 'route' => '500'));
        }
    }

    public function selectAddress(Request $request)
    {
        $data = $request->all();
        if ($data['action']) {
            $result = '';
            if ($data['action'] == "province") {
                $select_district = District::where('province_id', $data['select_id'])->orderby('district_name', 'ASC')->get();
                $result .= '<option>--Chọn quận / huyện--</option>';
                foreach ($select_district as $key => $district) {
                    $result .= '<option value="' . $district->district_id . '">' . $district->district_name . '</option>';
                }
            } else {
                $select_ward = Wards::where('district_id', $data['select_id'])->orderby('wards_name', 'ASC')->get();
                $result .= '<option>--Chọn phường / xã--</option>';
                foreach ($select_ward as $key => $wards) {
                    $result .= '<option value="' . $wards->wards_id . '">' . $wards->wards_name . '</option>';
                }
            }
            return response()->json(array('result' => $result));
        }
    }

    public function convertAddress($address, $wards_id, $district_id, $province_id)
    {
        return $address . ',' . Wards::find($wards_id)->wards_name . ',' . District::find($district_id)->district_name . ',' . Province::find($province_id)->province_name;
    }

    public function randomRegisterCode()
    {
        $timestamp = Carbon::now()->timestamp;
        $random_string = Str::random(6);
        $combine = substr($timestamp . $random_string, 10);
        $unique_reference = uniqid($combine);
        return $unique_reference;
    }

    public function convertRegisterCode($cFCode, $cFId, $Obj, $regisId)
    {
        $date = Carbon::now()->format('dmY');
        if ($this->locale == 'vn') {
            if ($Obj == 'Sinh Viên') {
                $objFormat = 'SV';
            } else {
                $objFormat = 'CB';
            }
        } else {
            $objFormat = mb_strtoupper(str_replace('.', '', $Obj), 'UTF-8');
        }
        $code = $cFCode . $objFormat . $date . $cFId . $regisId;
        return $code;
    }

    public function registerSubmit(Request $request)
    {
        if (EnRegister::where('en_register_type', $request->conference_fee_id)
            ->where('en_register_email', $request->en_register_email)
            ->exists()
        ) {
            return response()->json(array('errorsExistsEmail' => true, 'en_register_email' => __('validation.register.en_register_email_exists')));
        }
        $register_phone = Register::where('register_type', $request->conference_fee_id)
            ->where('register_phone', $request->register_phone)->exists();
        $register_email = Register::where('register_type', $request->conference_fee_id)
            ->where('register_email', $request->register_email)->exists();
        if ($register_phone  && $register_email) {
            return response()->json(array('errorsExists' => true, 'validator' => ['register_email' => __('validation.register.errors_exists_email'), 'register_phone' => __('validation.register.errors_exists_phone')], 'message' => __('validation.register.errors_exists_both_message')));
        } elseif ($register_email) {
            return response()->json(array('errorsExists' => true,  'validator' => ['register_email' => __('validation.register.errors_exists_email')], 'message' => __('validation.register.errors_exists_email_message')));
        } else if ($register_phone) {
            return response()->json(array('errorsExists' => true, 'validator' => ['register_phone' => __('validation.register.errors_exists_phone')], 'message' => __('validation.register.errors_exists_phone_message')));
        }

        $validator = Validator::make($request->all(), $this->validateRegister($request->object_choses, $this->locale), $this->messageRegister());
        if ($validator->fails()) {
            return response()->json(array('errors' => true, 'validator' => $validator->errors()));
        }
        DB::beginTransaction();
        try {
            $data = $request->all();
            $conference_fee = ConferenceFee::where('conference_fee_id', $request->conference_fee_id)->first();
            $cFCode = $conference_fee->conference_fee_code;
            $cFId = $request->conference_fee_id;
            $payment = new Payment();
            $payment->conference_fee_id = $request->conference_fee_id;
            $payment->payment_price = $conference_fee->conference_fee_price;
            $payment->payment_method = 1;
            $payment->payment_status = 1;
            $payment_image = $request->file('payment_image');
            if ($payment_image) {
                $payment->payment_image = saveImageFileDrive($payment_image);
            }
            $payment->save();

            if ($this->locale == 'en') {
                $en_register = new EnRegister();
                $en_register->conference_id = $data['conference_id'];
                $en_register->payment_id = $payment->payment_id;
                $en_register->en_register_title = $data['en_register_title'];
                $en_register->en_register_firstname = mb_strtoupper($data['en_register_firstname'], 'UTF-8');
                $en_register->en_register_lastname = mb_strtoupper($data['en_register_lastname'], 'UTF-8');
                $en_register->en_register_gender = $data['en_register_gender'];
                $en_register->en_register_work_unit = $data['en_register_work_unit'];
                $en_register->en_register_nation = $data['en_register_nation'];
                $en_register->en_register_email = $data['en_register_email'];
                $en_register->en_register_phone = $data['en_register_phone'];
                $en_register->en_register_type = $request->conference_fee_id;
                $en_register->save();
                $en_register->en_register_code = $this->convertRegisterCode($cFCode, $cFId, $request->en_register_title, $en_register->en_register_id);
                $en_register->save();
            } else {
                $register = new Register();
                $register->conference_id = $data['conference_id'];
                $register->payment_id = $payment->payment_id;
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
                $register->register_type = $request->conference_fee_id;
                $register->register_receiving_address = $this->convertAddress($data['register_receiving_address'], $data['wards_id'], $data['district_id'], $data['province_id']);
                $register->register_policy = 1;
                $register->save();
                $register->register_code = $this->convertRegisterCode($cFCode, $cFId, $request->object_choses, $register->register_id);

                if ($request->object_choses == 'Sinh Viên') {
                    $register->register_degree = '';
                } else {
                    $register->register_degree = $data['register_degree'];
                }
                $register_image = $request->file('register_image');
                if ($register_image) {
                    $register->register_image = saveImageFileDrive($register_image);
                }

                $register_image_card = $request->file('register_image_card');
                if ($register_image_card) {

                    $register->register_image_card = saveImageFileDrive($register_image_card);
                }
                $register->save();
            }

            DB::commit();
            return response()->json(array('success' => true, 'route' => 'notification'));
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(array('success' => false, 'route' => '500'));
        }
    }

    //Validation
    public static function validateRegisterReport($report_degree, $locale)
    {
        if ($locale == 'en') {
            $rules = [
                'en_report_firstname' => 'required|string|regex:/^([^0-9]*)$/',
                'en_report_lastname' => 'required|string|regex:/^([^0-9]*)$/',
                'en_report_email' => 'required|email|unique:users,email',
                'en_report_organization' => 'required',
                'en_report_department' => 'required',
                'en_report_file_title' => 'required',
                'en_report_file' => 'required|file',
            ];
        } else {
            $rules = [
                'report_name' => 'required|string|regex:/^([^0-9]*)$/',
                'report_phone' => 'required|numeric|digits_between:10,10',
                'report_email' => 'required|email|unique:users,email',
                'report_place_of_birth' => 'required',
                'report_work_unit' => 'required',
                'report_file' => 'required|file',
                'report_policy' => 'accepted',
            ];
            if ($report_degree == 'Sinh viên') {
                $rules = array_merge($rules, [
                    'report_image_card' => 'required|file|image',
                ]);
            } else {
                $rules = array_merge($rules, [
                    'report_graduation_year' => 'required|numeric|digits_between:4,4',
                    'report_image' => 'required|file|image',
                ]);
            }
        }

        return $rules;
    }

    public static function validateRegister($object_choses, $locale)
    {
        if ($locale == 'vn') {
            $rules = [
                'register_name' => 'required|string|regex:/^([^0-9]*)$/',
                'register_email' => 'required|email|unique:users,email',
                'register_phone' => 'required|numeric|digits_between:10,10',
                'register_place_of_birth' => 'required',
                'register_nation' => 'required',
                'register_receiving_address' => 'required',
                'province_id' => 'required|numeric',
                'district_id' => 'required|numeric',
                'wards_id' => 'required|numeric',
                'payment_image' => 'required|file|image',
                'register_object_group' => 'required',
                'register_policy' => 'accepted',
            ];
            if ($object_choses == 'Sinh Viên') {
                $rules = array_merge($rules, [
                    'register_image_card' => 'required|file|image',
                ]);
            } else {
                $rules = array_merge($rules, [
                    'register_work_unit' => 'required',
                    'register_graduation_year' => 'required|numeric|digits_between:4,4',
                    'register_image' => 'required|file|image',
                ]);
            }
        } else {
            $rules = [
                'en_register_firstname' => 'required|string|regex:/^([^0-9]*)$/',
                'en_register_lastname' => 'required|string|regex:/^([^0-9]*)$/',
                'en_register_email' => 'required|email|unique:users,email',
                'en_register_phone' => 'required|numeric',
                'en_register_work_unit' => 'required',
            ];
        }
        return $rules;
    }

    public static function messageRegisterReport()
    {
        $message = [
            'report_name.required' => __('validation.report.report_name_required'),
            'report_phone.required' => __('validation.report.report_phone_required'),
            'report_email.required' => __('validation.report.report_email_required'),
            'report_place_of_birth.required' => __('validation.report.report_place_of_birth_required'),
            'report_work_unit.required' => __('validation.report.report_work_unit_required'),
            'report_graduation_year.required' => __('validation.report.report_graduation_year_required'),
            'report_image.required' => __('validation.report.report_image_required'),
            'report_image_card.required' => __('validation.report.report_image_card_required'),
            'report_file.required' => __('validation.report.report_file_required'),
            'report_policy.accepted' => __('validation.report.report_policy_accepted'),
            'report_phone.numeric' => __('validation.report.report_phone_numeric'),
            'report_phone.digits_between' => __('validation.report.report_phone_digits_between'),
            'report_email.email' => __('validation.report.report_email_email'),
            'report_graduation_year.numeric' => __('validation.report.report_graduation_year_numeric'),
            'report_graduation_year.digits_between' => __('validation.report.report_graduation_year_digits_between'),
            'report_image.file' => __('validation.report.report_image_file'),
            'report_image.image' => __('validation.report.report_image_image'),
            'report_image_card.file' => __('validation.report.report_image_card_file'),
            'report_image_card.image' => __('validation.report.report_image_card_image'),
            'report_file.file' => __('validation.report.report_file_file'),
            'report_name.regex' => __('validation.report.report_name_regex'),

            'en_report_firstname.required' => __('validation.report.en_report_firstname_required'),
            'en_report_lastname.required' => __('validation.report.en_report_lastname_required'),
            'en_report_email.required' => __('validation.report.report_email_required'),
            'en_report_organization.required' => __('validation.report.en_report_organization_required'),
            'en_report_department.required' => __('validation.report.en_report_department_required'),
            'en_report_file_title.required' => __('validation.report.en_report_file_title_required'),
            'en_report_file.required' => __('validation.report.en_report_file_required'),
            'en_report_file.file' => __('validation.report.report_file_file'),
            'en_report_firstname.regex' => __('validation.report.en_report_firstname_regex'),
            'en_report_lastname.regex' => __('validation.report.en_report_lastname_regex'),
        ];

        return $message;
    }

    public static function messageRegister()
    {
        $message = [
            'register_name.required' => __('validation.register.register_name_required'),
            'register_phone.required' => __('validation.register.register_phone_required'),
            'register_email.required' => __('validation.register.register_email_required'),
            'register_place_of_birth.required' => __('validation.register.register_place_of_birth_required'),
            'register_object_group.required' => __('validation.register.register_object_group_required'),
            'register_work_unit.required' => __('validation.register.register_work_unit_required'),
            'register_receiving_address.required' => __('validation.register.register_receiving_address_required'),
            'province_id.required' => __('validation.register.province_id_required'),
            'district_id.required' => __('validation.register.district_id_required'),
            'wards_id.required' => __('validation.register.wards_id_required'),
            'register_nation.required' => __('validation.register.register_nation_required'),
            'register_type.required' => __('validation.register.register_type_required'),
            'register_graduation_year.required' => __('validation.register.register_graduation_year_required'),
            'register_image.required' => __('validation.register.register_image_required'),
            'register_image_card.required' => __('validation.register.register_image_card_required'),
            'payment_image.required' => __('validation.register.payment_image_required'),
            'register_policy.accepted' => __('validation.register.register_policy_accepted'),
            'register_phone.numeric' => __('validation.register.register_phone_numeric'),
            'register_phone.digits_between' => __('validation.register.register_phone_digits_between'),
            'register_email.email' => __('validation.register.register_email_email'),
            'register_graduation_year.numeric' => __('validation.register.register_graduation_year_numeric'),
            'register_graduation_year.digits_between' => __('validation.register.register_graduation_year_between'),
            'register_image.file' => __('validation.register.register_image_file'),
            'register_image.image' => __('validation.register.register_image_image'),
            'register_image_card.file' => __('validation.register.register_image_card_file'),
            'register_image_card.image' => __('validation.register.register_image_card_image'),
            'payment_image.file' => __('validation.register.payment_image_file'),
            'payment_image.image' => __('validation.register.payment_image_image'),
            'province_id.numeric' => __('validation.register.province_id_required'),
            'district_id.numeric' => __('validation.register.district_id_required'),
            'wards_id.numeric' => __('validation.register.wards_id_required'),
            'register_name.regex' => __('validation.register.register_name_regex'),

            'en_register_firstname.required' => __('validation.register.en_register_firstname_required'),
            'en_register_lastname.required' => __('validation.register.en_register_lastname_required'),
            'en_register_email.required' => __('validation.register.en_register_email_required'),
            'en_register_phone.required' => __('validation.register.en_register_phone_required'),
            'en_register_work_unit.required' => __('validation.register.en_register_work_unit_required'),
            'en_register_email.email' => __('validation.register.en_register_email_email'),
            'en_register_phone.numeric' => __('validation.register.en_register_phone_numeric'),
            'en_register_firstname.regex' => __('validation.register.en_register_firstname_regex'),
            'en_register_lastname.regex' => __('validation.register.en_register_lastname_regex'),
        ];

        return $message;
    }

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
