<?php

namespace App\Http\Controllers;

use App\Models\TempFile;
use Illuminate\Http\Request;
use App\Models\Hrtta;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class HrttaController extends Controller
{
    private $folder;

    public function __construct()
    {
        $this->folder = 'hrtta';
    }

    public function index()
    {
        $getAllHrtta = Hrtta::orderBy('id', 'DESC')->get();
        return view('pages.admin.hrtta.index', compact('getAllHrtta'));
    }

    public function load(Request $request)
    {
        $getAllHrtta = Hrtta::orderBy('id', 'DESC')->get();
        $html = view('pages.admin.hrtta.render', compact('getAllHrtta'))->render();
        return response()->json(array('success' => true, 'html' => $html));
    }

    public function getForm(Request $request)
    {
        if ($request->type == 'create') {
            $html = view('pages.admin.hrtta.create')->render();
        } else {
            $hrtta = Hrtta::findOrFail($request->id);
            $html = view('pages.admin.hrtta.edit', compact('hrtta'))->render();
        }
        return response()->json(array('success' => true, 'html' => $html));
    }

    public function storeOrUpdate(Request $request)
    {
        // $validator = Validator::make($request->all(), $this->validateVartContent(), $this->messageVartContent());
        // if ($validator->fails()) {
        //     return response()->json(array('errors' => true, 'validator' => $validator->errors()));
        // }
        DB::beginTransaction();
        try {
            if ($request->type == 'create') {
                $hrtta = new Hrtta();
                $hrtta->hrtta_title = $request->hrtta_title;
                $hrtta->hrtta_title_en = $request->hrtta_title_en;
                $hrtta->hrtta_slug = Str::slug($request->hrtta_title);
                $hrtta->hrtta_text = $request->hrtta_text;
                $hrtta->hrtta_text_en = $request->hrtta_text_en;
                $file = TempFile::firstWhere('folder', $request->hrtta_image);
                if ($file) {
                    $hrtta->hrtta_image = moveFileSource($file->folder, $this->folder, $file->filename);
                    $file->delete();
                }
                $hrtta->save();
            } else {
                $hrtta = Hrtta::findOrFail($request->id);
                $hrtta->hrtta_title = $request->hrtta_title;
                $hrtta->hrtta_title_en = $request->hrtta_title_en;
                $hrtta->hrtta_slug = Str::slug($request->hrtta_title);
                $hrtta->hrtta_text = $request->hrtta_text;
                $hrtta->hrtta_text_en = $request->hrtta_text_en;
                $file = TempFile::firstWhere('folder', $request->hrtta_image);
                if ($file) {
                    if ($hrtta->hrtta_image) {
                        removeFileSource(getFolderForDestroyFile($hrtta->hrtta_image), true);
                    }
                    $hrtta->hrtta_image = moveFileSource($file->folder, $this->folder, $file->filename);
                    $file->delete();
                }
                $hrtta->save();
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
            $hrtta = Hrtta::findOrFail($request->id);
            if ($hrtta->hrtta_image) {
                removeFileSource(getFolderForDestroyFile($hrtta->hrtta_image), true);
            }
            $hrtta->delete();
            DB::commit();

            // return Redirect::route('vart.index')->with('success', 'Successfully deleted');
            return response()->json(array('message' => __('alert.blog.successfulNotification'), 'success' => true));
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(array('success' => false, 'route' => '500'));
            // return Redirect::route('vart.index')->with('error', __('alert.conference.errorMessage_update'));
        }
    }
}
