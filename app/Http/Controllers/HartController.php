<?php

namespace App\Http\Controllers;

use App\Models\TempFile;
use Illuminate\Http\Request;
use App\Models\Hart;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class HartController extends Controller
{
    private $folder;

    public function __construct()
    {
        $this->folder = 'hart';
    }

    public function index()
    {
        $getAllHart = Hart::orderBy('id', 'DESC')->get();
        return view('pages.admin.hart.index', compact('getAllHart'));
    }

    public function load(Request $request)
    {
        $getAllHart = Hart::orderBy('id', 'DESC')->get();
        $html = view('pages.admin.hart.render', compact('getAllHart'))->render();
        return response()->json(array('success' => true, 'html' => $html));
    }

    public function getForm(Request $request)
    {
        if ($request->type == 'create') {
            $html = view('pages.admin.hart.create')->render();
        } else {
            $hart = Hart::findOrFail($request->id);
            $html = view('pages.admin.hart.edit', compact('hart'))->render();
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
                $hart = new Hart();
                $hart->hart_title = $request->hart_title;
                $hart->hart_title_en = $request->hart_title_en;
                $hart->hart_slug = Str::slug($request->hart_title);
                $hart->hart_text = $request->hart_text;
                $hart->hart_text_en = $request->hart_text_en;
                $file = TempFile::firstWhere('folder', $request->hart_image);
                if ($file) {
                    $hart->hart_image = moveFileSource($file->folder, $this->folder, $file->filename);
                    $file->delete();
                }
                $hart->save();
            } else {
                $hart = Hart::findOrFail($request->id);
                $hart->hart_title = $request->hart_title;
                $hart->hart_title_en = $request->hart_title_en;
                $hart->hart_slug = Str::slug($request->hart_title);
                $hart->hart_text = $request->hart_text;
                $hart->hart_text_en = $request->hart_text_en;
                $file = TempFile::firstWhere('folder', $request->hart_image);
                if ($file) {
                    if ($hart->hart_image) {
                        removeFileSource(getFolderForDestroyFile($hart->hart_image), true);
                    }
                    $hart->hart_image = moveFileSource($file->folder, $this->folder, $file->filename);
                    $file->delete();
                }
                $hart->save();
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
            $hart = Hart::findOrFail($request->id);
            if ($hart->hart_image) {
                removeFileSource(getFolderForDestroyFile($hart->hart_image), true);
            }
            $hart->delete();
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
