<?php

namespace App\Http\Controllers\Conference;

use App\Http\Controllers\Controller;
use App\Models\EnReport;
use App\Models\Province;
use App\Models\Report;
use App\Models\Countries;
use App\Exports\ExcelExportVNReport;
use App\Exports\ExcelExportENReport;
use App\Exports\ExcelExportVnRegister;
use App\Exports\ExcelExportEnRegister;
use App\Models\Academic;
use App\Models\TempFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        $getAllConferenceReport = Report::orderBy('id', 'ASC')->paginate(10);
        $conference_id = 1;
        return view('pages.admin.conferenceRegister.report.index', compact('getAllConferenceReport', 'conference_id'));
    }

    public function editReport($id)
    {
        $report = Report::findOrFail($id);
        $getAllAcademic = Academic::select(['academic_title'])->get();
        $getAllProvince = Province::orderby('sort', 'ASC')->orderByRaw("CONVERT(province_name USING utf8mb4) COLLATE utf8mb4_unicode_ci")->get();
        return view('pages.admin.conferenceRegister.report.edit', compact('report', 'getAllAcademic', 'getAllProvince'));
    }

    public function updateReport(Request $request, $id)
    {
        $this->checkReport($request);
        DB::beginTransaction();
        try {
            $data = $request->all();
            $report = Report::findOrFail($id);
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
            if (!empty($data['report_file'])) {
                $report->report_file = $data['report_file'];
                $tempFile = TempFile::where('folder', $data['report_file'])->first();
                $tempFile->delete();
            }
            if (!empty($data['report_image'])) {
                $report->report_image = $data['report_image'];
                $tempFile = TempFile::where('folder', $data['report_image'])->first();
                $tempFile->delete();
            }
            if (!empty($data['report_image_card'])) {
                $report->report_image_card = $data['report_image_card'];
                $tempFile = TempFile::where('folder', $data['report_image_card'])->first();
                $tempFile->delete();
            }
            $report->save();
            DB::commit();
            return redirect()->route('conference_report.index')->with('success',  __('alert.conference.successMessage_update'));
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('conference_report.index')->with('error',  __('alert.conference.errorMessage_update'));
        }
    }

    public function destroyReport($id)
    {
        $report = Report::findOrFail($id);
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
        return Redirect()->back()->with('success',  __('alert.conference.successMessage_delete'));
    }

    public function indexInternational()
    {
        $getAllConferenceReportInternational = EnReport::orderBy('id', 'ASC')->paginate(10);
        $conference_id = 1;
        return view('pages.admin.conferenceRegister.report.indexInternational', compact('getAllConferenceReportInternational', 'conference_id'));
    }

    public function editInternational($id)
    {
        $en_report = EnReport::findOrFail($id);
        $getAllCountries = Countries::all();
        return view('pages.admin.conferenceRegister.report.editInternational', compact('en_report', 'getAllCountries'));
    }

    public function updateReportInternational(Request $request, $id)
    {
        $this->checkEnReport($request);
        DB::beginTransaction();
        try {
            $data = $request->all();
            $en_report = EnReport::findOrFail($id);
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
            if (!empty($data['en_report_file'])) {
                $en_report->en_report_file = $data['en_report_file'];
                $tempFile = TempFile::where('folder', $data['en_report_file'])->first();
                $tempFile->delete();
            }
            $en_report->save();
            DB::commit();
            return redirect()->route('conference_en_report.index')->with('success',  __('alert.conference.successMessage_update'));
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('conference_en_report.index')->with('error',  __('alert.conference.errorMessage_update'));
        }
    }

    public function destroyReportInternational($id)
    {
        $en_report = EnReport::findOrFail($id);
        if ($en_report->en_report_file) {
            deleteImageFileDrive($en_report->en_report_file);
        }
        $en_report->delete();
        return Redirect()->back()->with('success',  __('alert.conference.successMessage_update'));
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
