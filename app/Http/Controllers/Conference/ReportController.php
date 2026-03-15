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
        $conferences = Conference::select('id', 'conference_title', 'conference_code')->where('multi_conferences', 0)->orderBy('id', 'DESC')->get();
        return view('pages.admin.conferenceRegister.report.vn.list', compact('conferences'));
    }

    public function indexNational($code)
    {
        $conference = Conference::select('id', 'conference_title', 'conference_code')->firstWhere('conference_code', $code);
        $getAllConferenceReport = Report::join('members', 'members.id', 'reports.member_id')->join('topics', 'topics.id', 'reports.report_topics')
            ->select(
                'reports.conference_id',
                'reports.id',
                'reports.created_at',
                'report_code',
                'report_file_title',
                'report_file',
                'report_file_background',
                'report_share',
                'report_type',
                'report_status',
                'reports.locale',
                'topic_title_en',
                'member_degree',
                'member_full_name',
                'member_gender',
                'member_date',
                'member_month',
                'member_year',
                'member_place_of_birth',
                'member_nation',
                'member_object_group',
                'member_work_unit',
                'member_graduation_year',
                'member_email',
                'member_phone',
                'member_image',
                'member_image_card',
            )
            ->where('reports.conference_id', $conference->id)
            ->where('reports.locale', 'vn')
            ->orderBy('reports.id', 'DESC')
            ->paginate(10);
        return view('pages.admin.conferenceRegister.report.vn.index', compact('getAllConferenceReport', 'conference'));
    }

    public function edit($code, $id)
    {
        $report = Report::join('members', 'members.id', 'reports.member_id')->select(
            'reports.id',
            'reports.created_at',
            'report_code',
            'report_file_title',
            'report_file',
            'report_file_background',
            'report_topics',
            'report_share',
            'report_suggested_addition',
            'report_reason_rejection',
            'report_status',
            'reports.member_id',
            'member_degree',
            'member_full_name',
            'member_gender',
            'member_date',
            'member_month',
            'member_year',
            'member_place_of_birth',
            'member_nation',
            'member_object_group',
            'member_work_unit',
            'member_graduation_year',
            'member_email',
            'member_phone',
            'member_image',
            'member_image_card',
        )
            ->firstWhere('reports.id', $id);

        $getAllAcademic = Academic::select(['academic_title'])->get();
        $getAllProvince = Province::orderByRaw("CONVERT(name USING utf8mb4) COLLATE utf8mb4_unicode_ci")->get();
        $topics = Topic::get();
        $previous_url = url()->previous();
        return view('pages.admin.conferenceRegister.report.vn.edit', compact('code', 'report', 'getAllAcademic', 'getAllProvince', 'topics', 'previous_url'));
    }

    public function update(Request $request, $code)
    {
        $validator = Validator::make($request->all(), app(ValidateController::class)->validateReport('vn'), app(ValidateController::class)->messageReport());
        if ($validator->fails()) {
            return response()->json(array('errors' => true, 'validator' => $validator->errors()));
        }
        DB::beginTransaction();
        try {
            $report = Report::firstWhere('id', $request->report_id);
            // $report->member->member_full_name = mb_strtoupper($request->member_full_name, 'UTF-8');
            // $report->member->member_gender = $request->member_gender;
            // $report->member->member_date = $request->member_date;
            // $report->member->member_month = $request->member_month;
            // $report->member->member_year = $request->member_year;
            // $report->member->member_place_of_birth = $request->member_place_of_birth;
            $report->member->member_work_unit = $request->member_work_unit;
            // $report->member->member_graduation_year = $request->member_graduation_year;
            $report->member->member_email = $request->member_email;
            // $report->member->member_phone = $request->member_phone;
            $report->member->save();

            $report->report_file_title = $request->report_file_title;
            // $report->report_topics = $request->report_topics;
            $report->report_suggested_addition = $request->report_suggested_addition;
            $report->report_reason_rejection = $request->report_reason_rejection;
            $report->report_status = $request->report_status;
            $report->save();

            if (!empty($request->report_file)) {
                $report->report_file = $request->report_file;
                $tempFile = TempFile::firstWhere('folder', $request->report_file);
                !empty($tempFile) ? $tempFile->delete() : '';
            }

            if (!empty($request->report_file_background)) {
                $report->report_file_background = $request->report_file_background;
                $tempFile = TempFile::firstWhere('folder', $request->report_file_background);
                !empty($tempFile) ? $tempFile->delete() : '';
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
                Mail::to($report->member->member_email)->send(new ReportMail($conference->conference_type_name, $conference->conference_title, $report->member->member_full_name, $report->member->member_gender, $report->report_code, $report->report_suggested_addition, $report->report_reason_rejection, $report->report_status, 'vn'));
            }
            return response()->json(array('success' => true, 'message' => __('alert.conference.successMessage_update'), 'route' => $request->previous_url));
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(array('success' => false, 'message' => __('alert.conference.errorMessage_update'), 'route' => $request->previous_url));
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
        $getAllConferenceReportInternational = Report::join('members', 'members.id', 'reports.member_id')->join('topics', 'topics.id', 'reports.report_topics')
            ->select(
                'reports.conference_id',
                'reports.id',
                'reports.created_at',
                'report_code',
                'report_file_title',
                'report_file',
                'report_file_background',
                'report_share',
                'report_type',
                'report_status',
                'reports.locale',
                'topic_title_en',
                'member_title',
                'member_first_name',
                'member_last_name',
                'member_gender',
                'member_date',
                'member_month',
                'member_year',
                'member_country',
                'member_work_unit',
                'member_email',
                'member_phone',
            )
            ->where('reports.conference_id', $conference->id)
            ->where('reports.locale', 'en')
            ->orderBy('reports.id', 'DESC')
            ->paginate(10);
        return view('pages.admin.conferenceRegister.report.en.index', compact('getAllConferenceReportInternational', 'conference'));
    }

    public function editInternational($code, $id)
    {
        $report = Report::join('members', 'members.id', 'reports.member_id')->select(
            'reports.id',
            'reports.created_at',
            'report_code',
            'report_file_title',
            'report_file',
            'report_topics',
            'report_share',
            'report_status',
            'reports.member_id',
            'member_title',
            'member_first_name',
            'member_last_name',
            'member_gender',
            'member_date',
            'member_month',
            'member_year',
            'member_country',
            'member_work_unit',
            'member_email',
            'member_phone',
        )
            ->firstWhere('reports.id', $id);
        $getAllCountries = Countries::all();
        $topics = Topic::get();
        return view('pages.admin.conferenceRegister.report.en.edit', compact('code', 'report', 'getAllCountries', 'topics'));
    }

    public function updateInternational(Request $request, $code)
    {
        $validator = Validator::make($request->all(), app(ValidateController::class)->validateReport('en'), app(ValidateController::class)->messageReport());
        if ($validator->fails()) {
            return response()->json(array('errors' => true, 'validator' => $validator->errors()));
        }
        DB::beginTransaction();
        try {
            $report = Report::firstWhere('id', $request->report_id);
            // $report->member->member_title = $request->member_title;
            // $report->member->member_first_name = mb_strtoupper($request->member_first_name, 'UTF-8');
            // $report->member->member_last_name = mb_strtoupper($request->member_last_name, 'UTF-8');
            // $report->member->member_full_name =mb_strtoupper($request->member_last_name . ' ' . $request->member_first_name, 'UTF-8');
            // $report->member->member_gender = $request->member_gender;
            // $report->member->member_date = $request->member_date;
            // $report->member->member_month = $request->member_month;
            // $report->member->member_year = $request->member_year;
            // $report->member->member_country = $request->member_country;
            // $report->member->member_work_unit = $request->member_work_unit;
            // $report->member->member_email = $request->member_email;
            $report->member->member_phone = $request->member_phone;
            $report->member->save();

            $report->report_file_title = $request->report_file_title;
            // $report->report_topics = $request->report_topics;
            $report->report_status = $request->report_status;
            $report->save();

            if (!empty($request->report_file)) {
                $report->report_file = $request->report_file;
                $tempFile = TempFile::firstWhere('folder', $request->report_file);
                !empty($tempFile) ? $tempFile->delete() : '';
            }

            $report->save();
            DB::commit();
            return response()->json(array('success' => true, 'message' => __('alert.conference.successMessage_update'), 'route' => route('conference_en_report.index', $code)));
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(array('success' => false, 'message' => __('alert.conference.errorMessage_update'), 'route' => route('conference_en_report.index', $code)));
        }
    }

    public function destroyInternational($id)
    {
        $report = Report::findOrFail($id);
        // if ($en_report->en_report_file) {
        //     deleteImageFileDrive($en_report->en_report_file);
        // }
        $report->delete();
        return Redirect()->back()->with('success',  __('alert.conference.successMessage_update'));
    }
}
