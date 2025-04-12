<?php

namespace App\Http\Controllers\Conference;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ValidateController;
use App\Models\Conference;
use App\Models\ConferenceCategory;
use App\Models\ConferenceFee;
use App\Models\ConferenceType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\TempFile;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ConferenceController extends Controller
{
    private $folder;

    public function __construct()
    {
        $this->folder = 'conference';
    }

    public function index()
    {
        $getAllConference = Conference::orderBy('id', 'DESC')->paginate(10);
        return view('pages.admin.conference.index', compact('getAllConference'));
    }

    public function load(Request $request)
    {
        $getAllConference = Conference::orderBy('id', 'DESC')->paginate(10);
        $html = view('pages.admin.conference.render', compact('getAllConference'))->render();
        return response()->json(array('success' => true, 'html' => $html));
    }

    public function getForm(Request $request)
    {
        $getAllConferenceCategory = ConferenceCategory::orderBy('id', 'ASC')->get();
        $getAllConferenceType = ConferenceType::orderBy('id', 'ASC')->get();
        if ($request->type == 'create') {
            $html = view('pages.admin.conference.create', compact('getAllConferenceCategory', 'getAllConferenceType'))->render();
        } else {
            $conference = Conference::findOrFail($request->id);
            $getAllConferenceFee = ConferenceFee::where('conference_id', $request->id)->get();
            $html = view('pages.admin.conference.edit', compact('conference', 'getAllConferenceCategory', 'getAllConferenceType', 'getAllConferenceFee'))->render();
        }
        return response()->json(array('success' => true, 'html' => $html));
    }

    public function create()
    {
        $getAllConferenceCategory = ConferenceCategory::orderBy('id', 'ASC')->get();
        $getAllConferenceType = ConferenceType::orderBy('id', 'ASC')->get();
        return view('pages.admin.conference.create', compact('getAllConferenceCategory', 'getAllConferenceType'));
    }

    public function edit($id)
    {
        $getAllConferenceCategory = ConferenceCategory::orderBy('id', 'ASC')->get();
        $getAllConferenceType = ConferenceType::orderBy('id', 'ASC')->get();
        $conference = Conference::findOrFail($id);
        $getAllConferenceFee = ConferenceFee::where('conference_id', $id)->get();
        return view('pages.admin.conference.edit', compact('conference', 'getAllConferenceCategory', 'getAllConferenceType', 'getAllConferenceFee'));
    }

    public function store_or_update(Request $request)
    {
        $validator = Validator::make($request->all(), app(ValidateController::class)->validateConference($request->action));
        if ($validator->fails()) {
            return response()->json(array('errors' => true, 'validator' => $validator->errors()));
        }
        DB::beginTransaction();
        try {
            if($request->action == 'create'){
                if (Conference::where('conference_title', $request->conference_title)->exists()) {
                    return response()->json(array('errorsExists' => true, 'validator' => ['conference_title' => 'Title already exists.'], 'message' => 'Title already exists.'));
                }
                if (Conference::where('conference_code', $request->conference_code)->exists()) {
                    return response()->json(array('errorsExists' => true, 'validator' => ['conference_code' => 'Code already exists.'], 'message' => 'Code already exists.'));
                }
                $conference = new Conference();
                $conference->conference_category_id = $request->conference_category_id;
                $conference->conference_type_id = $request->conference_type_id;
                $conference->conference_code = $request->conference_code;
                $conference->conference_title = $request->conference_title;
                $conference->conference_title_en = $request->conference_title_en;
                $conference->conference_slug = Str::slug($request->conference_title);
                $conference->conference_content = $request->conference_content;
                $conference->conference_content_en = $request->conference_content_en;
                $conference->conference_form_type = 1;
                $conference->status = $request->status;
                $conference->display = $request->display;
                $file = TempFile::firstWhere('folder', $request->conference_image);
                if ($file) {
                    $conference->conference_image = moveFileSource($file->folder, $this->folder, $file->filename);
                    $file->delete();
                }
                $fileEn = TempFile::firstWhere('folder', $request->conference_image_en);
                if ($fileEn) {
                    $conference->conference_image_en = moveFileSource($fileEn->folder, $this->folder, $fileEn->filename);
                    $fileEn->delete();
                }
                $conference->save();
                $message = __('alert.conference.successMessage_create');
            }else{
                $conference = Conference::findOrFail($request->conference_id);
                $conference->conference_category_id = $request->conference_category_id;
                $conference->conference_type_id = $request->conference_type_id;
                $conference->conference_code = $request->conference_code;
                $conference->conference_title = $request->conference_title;
                $conference->conference_title_en = $request->conference_title_en;
                $conference->conference_slug = Str::slug($request->conference_title);
                $conference->conference_content = $request->conference_content;
                $conference->conference_content_en = $request->conference_content_en;
                $conference->status = $request->status;
                $conference->display = $request->display;
                $file = TempFile::firstWhere('folder', $request->conference_image);
                if ($file) {
                    if ($conference->conference_image) {
                        removeFileSource(getFolderForDestroyFile($conference->conference_image), true);
                    }
                    $conference->conference_image = moveFileSource($file->folder, $this->folder, $file->filename);
                    $file->delete();
                }
    
                $fileEn = TempFile::firstWhere('folder', $request->conference_image_en);
                if ($fileEn) {
                    if ($conference->conference_image_en) {
                        removeFileSource(getFolderForDestroyFile($conference->conference_image_en), true);
                    }
                    $conference->conference_image_en = moveFileSource($fileEn->folder, $this->folder, $fileEn->filename);
                    $fileEn->delete();
                }
                $conference->save();
                $message = __('alert.conference.successMessage_update');
            }
            DB::commit();
            return response()->json(array('success' => true, 'route' => route('conference.index')));
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(array('success' => false, 'route' => route('conference.index')));
        }
    }

    public function storeOrUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), app(ValidateController::class)->validateConference(), app(ValidateController::class)->validateConference());
        if ($validator->fails()) {
            return response()->json(array('errors' => true, 'validator' => $validator->errors()));
        }
        DB::beginTransaction();
        try {
            if ($request->type == 'create') {
                if (Conference::where('conference_title', $request->conference_title)->exists()) {
                    return response()->json(array('errorsExists' => true, 'validator' => ['conference_title' => 'Title already exists.'], 'message' => 'Title already exists.'));
                }
                if (Conference::where('conference_code', $request->conference_code)->exists()) {
                    return response()->json(array('errorsExists' => true, 'validator' => ['conference_code' => 'Code already exists.'], 'message' => 'Code already exists.'));
                }
                $conference = new Conference();
                $conference->conference_category_id = $request->conference_category_id;
                $conference->conference_type_id = $request->conference_type_id;
                $conference->conference_code = $request->conference_code;
                $conference->conference_title = $request->conference_title;
                $conference->conference_title_en = $request->conference_title_en;
                $conference->conference_slug = Str::slug($request->conference_title);
                $conference->conference_content = $request->conference_content;
                $conference->conference_content_en = $request->conference_content_en;
                $conference->conference_form_type = 1;
                $conference->status = $request->status;
                $conference->display = $request->display;
                $conference->prioritize = $request->prioritize;
                $file = TempFile::firstWhere('folder', $request->conference_image);
                if ($file) {
                    $conference->conference_image = moveFileSource($file->folder, $this->folder, $file->filename);
                    $file->delete();
                }
                $fileEn = TempFile::firstWhere('folder', $request->conference_image_en);
                if ($fileEn) {
                    $conference->conference_image_en = moveFileSource($fileEn->folder, $this->folder, $fileEn->filename);
                    $fileEn->delete();
                }
                $conference->save();
            } else {
                $conference = Conference::findOrFail($request->id);
                $conference->conference_category_id = $request->conference_category_id;
                $conference->conference_type_id = $request->conference_type_id;
                $conference->conference_code = $request->conference_code;
                $conference->conference_title = $request->conference_title;
                $conference->conference_title_en = $request->conference_title_en;
                $conference->conference_slug = Str::slug($request->conference_title);
                $conference->conference_content = $request->conference_content;
                $conference->conference_content_en = $request->conference_content_en;
                $conference->status = $request->status;
                $conference->display = $request->display;
                $conference->prioritize = $request->prioritize;
                $file = TempFile::firstWhere('folder', $request->conference_image);
                if ($file) {
                    if ($conference->conference_image) {
                        removeFileSource(getFolderForDestroyFile($conference->conference_image), true);
                    }
                    $conference->conference_image = moveFileSource($file->folder, $this->folder, $file->filename);
                    $file->delete();
                }
    
                $fileEn = TempFile::firstWhere('folder', $request->conference_image_en);
                if ($fileEn) {
                    if ($conference->conference_image_en) {
                        removeFileSource(getFolderForDestroyFile($conference->conference_image_en), true);
                    }
                    $conference->conference_image_en = moveFileSource($fileEn->folder, $this->folder, $fileEn->filename);
                    $fileEn->delete();
                }
                $conference->save();
            }
            DB::commit();
            return response()->json(array('success' => true, 'message' => __('alert.blog.successfulNotification')));
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(array('success' => false, 'route' => '500'));
        }
    }

    public function destroy(Request $request)
    {
        DB::beginTransaction();
        try {
            $conference = Conference::findOrFail($request->id);
            if ($conference->conference_image) {
                removeFileSource(getFolderForDestroyFile($conference->conference_image), true);
            }
            if ($conference->conference_image_en) {
                removeFileSource(getFolderForDestroyFile($conference->conference_image_en), true);
            }
            $conference->delete();

            DB::commit();
            return response()->json(array('message' => __('alert.blog.successfulNotification'), 'success' => true));
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(array('success' => false, 'route' => '500'));
        }
    }
}
