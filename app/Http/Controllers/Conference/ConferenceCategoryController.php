<?php

namespace App\Http\Controllers\Conference;

use App\Http\Controllers\Controller;

use App\Models\Conference;
use Illuminate\Http\Request;
use App\Models\ConferenceCategory;
use App\Models\TempFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;

class ConferenceCategoryController extends Controller
{
    private $folder;

    public function __construct()
    {
        $this->folder = 'conference';
    }

    public function index()
    {
        $getAllConferenceCategory = ConferenceCategory::orderBy('id', 'DESC')->get();
        return view('pages.admin.conferenceCategory.index', compact('getAllConferenceCategory'));
    }

    public function create()
    {
        return view('pages.admin.conferenceCategory.create');
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $conferenceCategory = new ConferenceCategory();
            $conferenceCategory->conference_category_name = $request->conference_category_name;
            $conferenceCategory->conference_category_name_en = $request->conference_category_name_en;
            $conferenceCategory->conference_category_slug = Str::slug($request->conference_category_name);
            if (ConferenceCategory::where('conference_category_name', $conferenceCategory->conference_category_name)->exists()) {
                return Redirect()->back()->with('error', 'Danh mục đã tồn tại, Vui lòng kiểm tra lại.');
            }
            $file = TempFile::where('folder', $request->conference_category_image)->first();
            if ($file) {
                $conferenceCategory->conference_category_image = moveFileSource($file->folder, $this->folder, $file->filename);
                $file->delete();
            }
            $conferenceCategory->save();
            DB::commit();

            return Redirect()->back()->with('success', 'Successfully created');
        } catch (\Exception $e) {
            DB::rollback();
            return Redirect::route('conference_category.index')->with('error', __('alert.conference.errorMessage_update'));
        }
    }

    public function edit($id)
    {
        $conferenceCategory = ConferenceCategory::findOrFail($id);
        return view('pages.admin.conferenceCategory.edit', compact('conferenceCategory'));
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $conferenceCategory = ConferenceCategory::findOrFail($id);
            $conferenceCategory->conference_category_name = $request->conference_category_name;
            $conferenceCategory->conference_category_name_en = $request->conference_category_name_en;
            $conferenceCategory->conference_category_slug = Str::slug($request->conference_category_name);
            $file = TempFile::where('folder', $request->conference_category_image)->first();
            if ($file) {
                if ($conferenceCategory->conference_category_image) {
                    removeFileSource(getFolderForDestroyFile($conferenceCategory->conference_category_image), true);
                }
                $conferenceCategory->conference_category_image = moveFileSource($file->folder, $this->folder, $file->filename);
                $file->delete();
            }
            $conferenceCategory->save();
            DB::commit();

            Redirect::Route('conference_category.index')->with('success', 'Successfully updated');
        } catch (\Exception $e) {
            DB::rollback();
            return Redirect::route('conference_category.index')->with('error', __('alert.conference.errorMessage_update'));
        }
    }
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $conferenceCategory = ConferenceCategory::findOrFail($id);
            if ($conferenceCategory->conference_category_image) {
                removeFileSource(getFolderForDestroyFile($conferenceCategory->conference_category_image), true);
            }
            $conferenceCategory->delete();
            DB::commit();

            return Redirect::route('conference_category.index')->with('success', 'Successfully deleted');
        } catch (\Exception $e) {
            DB::rollback();
            return Redirect::route('conference_category.index')->with('error', __('alert.conference.errorMessage_update'));
        }
    }

    public function showConferenceCategoryMain()
    {
        $getAllConferenceCategory = ConferenceCategory::get();
        $getAllConference = Conference::orderBy('conference_id', 'DESC')->get();
        return view('pages.conference.conference_main')->with(compact('getAllConferenceCategory', 'getAllConference'));
    }
}
