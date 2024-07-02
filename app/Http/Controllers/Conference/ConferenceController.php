<?php

namespace App\Http\Controllers\Conference;

use App\Http\Controllers\Controller;
use App\Models\Conference;
use App\Models\ConferenceCategory;
use App\Models\ConferenceFee;
use App\Models\ConferenceType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\TempFile;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;

class ConferenceController extends Controller
{
    private $folder;

    public function __construct()
    {
        $this->folder = 'conference';
    }

    public function index()
    {
        $getAllConference = Conference::orderBy('id', 'DESC')->get();
        return view('pages.admin.conference.index', compact('getAllConference'));
    }

    public function create()
    {
        $getAllConferenceCategory = ConferenceCategory::orderBy('id', 'ASC')->get();
        $getAllConferenceType = ConferenceType::orderBy('id', 'ASC')->get();
        return view('pages.admin.conference.create', compact('getAllConferenceCategory', 'getAllConferenceType'));
    }


    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $conference = new Conference();
            $conference->conference_code = $request->conference_code;
            $conference->conference_title = $request->conference_title;
            $conference->conference_title_en = $request->conference_title_en;
            $conference->conference_slug = Str::slug($request->conference_title);
            $conference->conference_content = $request->conference_content;
            $conference->conference_content_en = $request->conference_content_en;
            $conference->conference_category_id = $request->conference_category_id;
            $conference->conference_type_id = $request->conference_type_id;
            $conference->conference_form_type = 1;
            if (Conference::where('conference_title', $request->conference_image)->exists()) {
                return Redirect()->back()->with('error', 'Danh mục đã tồn tại, Vui lòng kiểm tra lại.');
            }
            if (Conference::where('conference_code', $request->conference_code)->exists()) {
                return Redirect()->back()->with('error', 'Danh mục đã tồn tại, Vui lòng kiểm tra lại.');
            }
            $file = TempFile::where('folder', $request->conference_image)->first();
            if ($file) {
                $conference->conference_image = moveFileSource($file->folder, $this->folder, $file->filename);
                $file->delete();
            }
            $fileEn = TempFile::where('folder', $request->conference_image_en)->first();
            if ($fileEn) {
                $conference->conference_image_en = moveFileSource($fileEn->folder, $this->folder, $fileEn->filename);
                $fileEn->delete();
            }
            $conference->save();
            DB::commit();

            return Redirect()->back()->with('success', 'Successfully created');
        } catch (\Exception $e) {
            DB::rollback();
            return Redirect::route('conference.index')->with('error', __('alert.conference.errorMessage_update'));
        }
    }

    public function edit($id)
    {
        $getAllConferenceCategory = ConferenceCategory::orderBy('id', 'ASC')->get();
        $getAllConferenceType = ConferenceType::orderBy('id', 'ASC')->get();
        $conference = Conference::findOrFail($id);
        $getAllConferenceFee = ConferenceFee::where('conference_id', $id)->get();
        return view('pages.admin.conference.edit', compact('conference', 'getAllConferenceCategory', 'getAllConferenceType', 'getAllConferenceFee'));
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $conference = Conference::findOrFail($id);
            $conference->conference_code = $request->conference_code;
            $conference->conference_title = $request->conference_title;
            $conference->conference_title_en = $request->conference_title_en;
            $conference->conference_slug = Str::slug($request->conference_title);
            $conference->conference_content = $request->conference_content;
            $conference->conference_content_en = $request->conference_content_en;
            $conference->conference_category_id = $request->conference_category_id;
            $conference->conference_type_id = $request->conference_type_id;
            $file = TempFile::where('folder', $request->conference_image)->first();
            if ($file) {
                if ($conference->conference_image) {
                    removeFileSource(getFolderForDestroyFile($conference->conference_image), true);
                }
                $conference->conference_image = moveFileSource($file->folder, $this->folder, $file->filename);
                $file->delete();
            }

            $fileEn = TempFile::where('folder', $request->conference_image_en)->first();
            if ($fileEn) {
                if ($conference->conference_image_en) {
                    removeFileSource(getFolderForDestroyFile($conference->conference_image_en), true);
                }
                $conference->conference_image_en = moveFileSource($fileEn->folder, $this->folder, $fileEn->filename);
                $fileEn->delete();
            }
            $conference->save();
            DB::commit();

            return Redirect::route('conference.index')->with('success', 'Successfully created');
        } catch (\Exception $e) {
            DB::rollback();
            return Redirect::route('conference.index')->with('error', __('alert.conference.errorMessage_update'));
        }
    }
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $conference = Conference::findOrFail($id);
            if ($conference->conference_image) {
                removeFileSource(getFolderForDestroyFile($conference->conference_image), true);
            }
            if ($conference->conference_image_en) {
                removeFileSource(getFolderForDestroyFile($conference->conference_image_en), true);
            }
            $conference->delete();
            
            DB::commit();
            return Redirect()->back()->with('success', 'Successfully deleted');
        } catch (\Exception $e) {
            DB::rollback();
            return Redirect::route('conference.index')->with('error', __('alert.conference.errorMessage_update'));
        }
    }
}
