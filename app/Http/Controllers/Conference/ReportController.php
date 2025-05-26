<?php

namespace App\Http\Controllers\Conference;

use App\Http\Controllers\Controller;
use App\Http\Controllers\SupportController;
use App\Models\EnReport;
use App\Models\Province;
use App\Models\Report;
use App\Models\Countries;
use App\Http\Controllers\ValidateController;
use App\Models\Academic;
use App\Models\Conference;
use App\Models\TempFile;
use App\Models\Topic;
use App\Mail\ReportMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;


class ReportController extends Controller
{
    public function __construct() {}

    public function index()
    {
        $conferences = Conference::select('id', 'conference_title', 'conference_code')->orderBy('id', 'DESC')->get();
        return view('pages.admin.conferenceRegister.report.vn.list', compact('conferences'));
    }

    public function indexNational($code)
    {
        $conference = Conference::select('id', 'conference_title', 'conference_code')->firstWhere('conference_code', $code);
        $getAllConferenceReport = Report::join('topics', 'topics.id', 'reports.report_topics')
            ->select(
                'reports.conference_id',
                'reports.id',
                'reports.created_at',
                'report_code',
                'report_degree',
                'report_name',
                'report_gender',
                'report_date',
                'report_month',
                'report_year',
                'report_phone',
                'report_email',
                'report_work_unit',
                'report_place_of_birth',
                'report_graduation_year',
                'report_file_title',
                'report_image',
                'report_image_card',
                'report_file',
                'report_policy',
                'report_file_background',
                'report_share',
                'report_status',
                'topic_title_en'
            )
            ->where('reports.conference_id', $conference->id)
            ->orderBy('reports.id', 'DESC')
            ->paginate(10);
        return view('pages.admin.conferenceRegister.report.vn.index', compact('getAllConferenceReport', 'conference'));
    }

    public function edit($code, $id)
    {
        $report = Report::findOrFail($id);
        $getAllAcademic = Academic::select(['academic_title'])->get();
        $getAllProvince = Province::orderby('sort', 'ASC')->orderByRaw("CONVERT(province_name USING utf8mb4) COLLATE utf8mb4_unicode_ci")->get();
        $topics = Topic::get();
        return view('pages.admin.conferenceRegister.report.vn.edit', compact('code', 'report', 'getAllAcademic', 'getAllProvince', 'topics'));
    }

    public function update(Request $request, $code)
    {
        $validator = Validator::make($request->all(), app(ValidateController::class)->validateReport('vn'), app(ValidateController::class)->messageReport());
        if ($validator->fails()) {
            return response()->json(array('errors' => true, 'validator' => $validator->errors()));
        }
        DB::beginTransaction();
        try {
            $report = Report::findOrFail($request->report_id);
            $report->report_name = mb_strtoupper($request->report_name, 'UTF-8');
            $report->report_degree = $request->report_degree;
            $report->report_gender = $request->report_gender;
            $report->report_date = $request->report_date;
            $report->report_month = $request->report_month;
            $report->report_year = $request->report_year;
            $report->report_work_unit = $request->report_work_unit;
            $report->report_place_of_birth = $request->report_place_of_birth;
            $report->report_email = $request->report_email;
            $report->report_phone = $request->report_phone;
            $report->report_graduation_year = $request->report_graduation_year;
            $report->report_file_title = $request->report_file_title;
            $report->report_suggested_addition = $request->report_suggested_addition;
            $report->report_reason_rejection = $request->report_reason_rejection;
            $report->report_status = $request->report_status;
            if (!empty($request->report_file)) {
                $report->report_file = $request->report_file;
                $tempFile = TempFile::firstWhere('folder', $request->report_file);
                $tempFile->delete();
            }
            if (!empty($request->report_image)) {
                $report->report_image = $request->report_image;
                $tempFile = TempFile::firstWhere('folder', $request->report_image);
                $tempFile->delete();
            }
            if (!empty($request->report_image_card)) {
                $report->report_image_card = $request->report_image_card;
                $tempFile = TempFile::firstWhere('folder', $request->report_image_card);
                $tempFile->delete();
            }
            if (!empty($request->report_file_background)) {
                $report->report_file_background = $request->report_file_background;
                $tempFile = TempFile::firstWhere('folder', $request->report_file_background);
                $tempFile->delete();
            }

            $report->save();
            $conference = Conference::join('conference_types', 'conference_types.id', 'conferences.conference_type_id')->select(
                'conference_type_name',
                'conferences.id',
                'conference_title',
                'conference_title_en',
            )
                ->where('conferences.id', $report->conference_id)
                ->first();
            DB::commit();
            if ($request->report_status == 3 || $request->report_status == 4) {
                if ($request->report_status == 3) {
                    app(SupportController::class)->createInvitation($report->id, 'report');
                }
                Mail::to($report->report_email)->send(new ReportMail($conference->conference_type_name, $conference->conference_title, $report->report_name, $report->report_gender, $report->report_code, $report->report_suggested_addition, $report->report_reason_rejection, $report->report_status, 'vn'));
            }
            return response()->json(array('success' => true, 'message' => __('alert.conference.successMessage_update'), 'route' => route('conference_report.index', $code)));
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(array('success' => false, 'message' => __('alert.conference.errorMessage_update'), 'route' => route('conference_report.index', $code)));
        }
    }

    public function destroy($id)
    {
        $report = Report::findOrFail($id);
        // if ($report->report_image) {
        //     deleteImageFileDrive($report->report_image);
        // }
        // if ($report->report_image_card) {
        //     deleteImageFileDrive($report->report_image_card);
        // }
        // if ($report->report_file) {
        //     deleteImageFileDrive($report->report_file);
        // }
        // if ($report->report_file_background) {
        //     deleteImageFileDrive($report->report_file_background);
        // }
        $report->delete();
        return Redirect()->back()->with('success',  __('alert.conference.successMessage_delete'));
    }

    public function indexEn()
    {
        $conferences = Conference::select('id', 'conference_title_en', 'conference_code')->orderBy('id', 'DESC')->get();
        return view('pages.admin.conferenceRegister.report.en.list', compact('conferences'));
    }

    public function indexInternational($code)
    {
        $conference = Conference::select('id', 'conference_title_en', 'conference_code')->firstWhere('conference_code', $code);
        $getAllConferenceReportInternational = EnReport::join('topics', 'topics.id', 'en_reports.en_report_topics')
            ->select(
                'en_reports.conference_id',
                'en_reports.id',
                'en_reports.created_at',
                'en_report_code',
                'en_report_firstname',
                'en_report_lastname',
                'en_report_title',
                'en_report_date',
                'en_report_month',
                'en_report_year',
                'en_report_email',
                'en_report_profession',
                'en_report_organization',
                'en_report_department',
                'en_report_nationality',
                'en_report_topics',
                'en_report_file',
                'en_report_file_title',
                'en_report_share',
                'en_report_status',
                'topic_title_en'
            )
            ->where('en_reports.conference_id', $conference->id)
            ->orderBy('en_reports.id', 'DESC')
            ->paginate(10);
        return view('pages.admin.conferenceRegister.report.en.index', compact('getAllConferenceReportInternational', 'conference'));
    }

    public function editInternational($code, $id)
    {
        $en_report = EnReport::findOrFail($id);
        $getAllCountries = Countries::all();
        $topics = Topic::get();
        return view('pages.admin.conferenceRegister.report.en.edit', compact('code', 'en_report', 'getAllCountries', 'topics'));
    }

    public function updateInternational(Request $request, $code)
    {
        $validator = Validator::make($request->all(), app(ValidateController::class)->validateReport('en'), app(ValidateController::class)->messageReport());
        if ($validator->fails()) {
            return response()->json(array('errors' => true, 'validator' => $validator->errors()));
        }
        DB::beginTransaction();
        try {
            $en_report = EnReport::findOrFail($request->en_report_id);
            $en_report->en_report_title = $request->en_report_title;
            $en_report->en_report_firstname = mb_strtoupper($request->en_report_firstname, 'UTF-8');
            $en_report->en_report_lastname = mb_strtoupper($request->en_report_lastname, 'UTF-8');
            $en_report->en_report_date = $request->en_report_date;
            $en_report->en_report_month = $request->en_report_month;
            $en_report->en_report_year = $request->en_report_year;
            $en_report->en_report_email = $request->en_report_email;
            $en_report->en_report_profession = $request->en_report_profession;
            $en_report->en_report_organization = $request->en_report_organization;
            $en_report->en_report_department = $request->en_report_department;
            $en_report->en_report_nationality = $request->en_report_nationality;
            $en_report->en_report_file_title = $request->en_report_file_title;
            $en_report->en_report_status = $request->en_report_status;
            if (!empty($request->en_report_file)) {
                $en_report->en_report_file = $request->en_report_file;
                $tempFile = TempFile::firstWhere('folder', $request->en_report_file);
                $tempFile->delete();
            }
            $en_report->save();
            DB::commit();
            return response()->json(array('success' => true, 'message' => __('alert.conference.successMessage_update'), 'route' => route('conference_en_report.index', $code)));
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(array('success' => false, 'message' => __('alert.conference.errorMessage_update'), 'route' => route('conference_en_report.index', $code)));
        }
    }

    public function destroyInternational($id)
    {
        $en_report = EnReport::findOrFail($id);
        // if ($en_report->en_report_file) {
        //     deleteImageFileDrive($en_report->en_report_file);
        // }
        $en_report->delete();
        return Redirect()->back()->with('success',  __('alert.conference.successMessage_update'));
    }
}
