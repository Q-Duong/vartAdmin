<?php

namespace App\Http\Controllers;

use App\Models\TempFile;
use Illuminate\Http\Request;
use App\Models\Vart;
use App\Models\VartContent;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class VartController extends Controller
{
    private $folder;

    public function __construct()
    {
        $this->folder = 'vart';
    }

    public function index()
    {
        $getAllVart = Vart::orderBy('id', 'DESC')->get();
        return view('pages.admin.vart.index', compact('getAllVart'));
    }

    public function create()
    {
        return view('pages.admin.vart.create');
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $vart = new Vart();
            $vart->vart_title = $request->vart_title;
            $vart->vart_title_en = $request->vart_title_en;
            $vart->vart_slug = Str::slug($request->vart_title);
            $file = TempFile::where('folder', $request->vart_image)->first();
            if ($file) {
                $vart->vart_image = moveFileSource($file->folder, $this->folder, $file->filename);
                $file->delete();
            }
            $vart->save();
            DB::commit();

            return Redirect()->back()->with('success', 'Successfully created');
        } catch (\Exception $e) {
            DB::rollback();
            return Redirect::route('vart.index')->with('error', __('alert.conference.errorMessage_update'));
        }
    }

    public function edit($id)
    {
        $vart = Vart::findOrFail($id);
        $getAllVartContent = VartContent::where('vart_id', $id)->get();
        return view('pages.admin.vart.edit', compact('vart', 'getAllVartContent'));
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $vart = Vart::findOrFail($id);
            $vart->vart_title = $request->vart_title;
            $vart->vart_title_en = $request->vart_title_en;
            $vart->vart_slug = Str::slug($request->vart_title);
            $file = TempFile::where('folder', $request->vart_image)->first();
            if ($file) {
                if ($vart->vart_image) {
                    removeFileSource(getFolderForDestroyFile($vart->vart_image), true);
                }
                $vart->vart_image = moveFileSource($file->folder, $this->folder, $file->filename);
                $file->delete();
            }
            $vart->save();
            DB::commit();

            return Redirect::route('vart.index')->with('success', 'Successfully updated');
        } catch (\Exception $e) {
            DB::rollback();
            return Redirect::route('vart.index')->with('error', __('alert.conference.errorMessage_update'));
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $vart = Vart::findOrFail($id);
            if ($vart->vart_image) {
                removeFileSource(getFolderForDestroyFile($vart->vart_image), true);
            }
            $vart->delete();
            DB::commit();

            return Redirect::route('vart.index')->with('success', 'Successfully deleted');
        } catch (\Exception $e) {
            DB::rollback();
            return Redirect::route('vart.index')->with('error', __('alert.conference.errorMessage_update'));
        }
    }

    //Validation
    public static function validateVartContent()
    {
        $rules = [
            'vart_content_title' => 'required',
            'vart_content_title_en' => 'required',
            'vart_content_text' => 'required',
            'vart_content_text_en' => 'required',
        ];
        return $rules;
    }

    public static function messageVartContent()
    {
        $message = [
            'vart_content_title.required' => __('validation.report.report_name_required'),
            'vart_content_title_en.required' => __('validation.report.report_phone_required'),
            'report_email.required' => __('validation.report.report_email_required'),
            'vart_content_text.required' => __('validation.report.report_place_of_birth_required'),
            'vart_content_text_en.required' => __('validation.report.report_work_unit_required'),
        ];

        return $message;
    }
}
