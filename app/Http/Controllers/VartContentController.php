<?php

namespace App\Http\Controllers;

use App\Models\TempFile;
use Illuminate\Http\Request;
use App\Models\VartContent;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class VartContentController extends Controller
{
    private $folder;

    public function __construct()
    {
        $this->folder = 'vart';
    }

    public function index(Request $request)
    {
        $getAllVartContent = VartContent::where('vart_id', $request->host_id)->get();
        $html = view('pages.admin.vart.content.index', compact('getAllVartContent'))->render();
        return response()->json(array('success' => true, 'html' => $html));
    }

    public function getForm(Request $request, $vart_id)
    {
        if($request->type == 'create'){
            $html = view('pages.admin.vart.content.create', compact('vart_id'))->render();
        }else{
            $content = VartContent::findOrFail($request->id);
            $html = view('pages.admin.vart.content.edit', compact('content'))->render();
        }
        return response()->json(array('success' => true, 'html' => $html));
    }

    public function storeOrUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), $this->validateVartContent(), $this->messageVartContent());
        if ($validator->fails()) {
            return response()->json(array('errors' => true, 'validator' => $validator->errors()));
        }
        DB::beginTransaction();
        try {
            if ($request->type == 'create') {
                $vartContent = new VartContent();
                $vartContent->vart_id = $request->id;
                $vartContent->vart_content_title = $request->vart_content_title;
                $vartContent->vart_content_title_en = $request->vart_content_title_en;
                $vartContent->vart_content_text = $request->vart_content_text;
                $vartContent->vart_content_text_en = $request->vart_content_text_en;
                $vartContent->vart_content_themes = 1;
                $file = TempFile::where('folder', $request->vart_content_image)->first();
                if ($file) {
                    $vartContent->vart_content_image = moveFileSource($file->folder, $this->folder, $file->filename);
                    $file->delete();
                }
                $vartContent->save();
            } else {
                $vartContent = VartContent::findOrFail($request->content_id);
                $vartContent->vart_content_title = $request->vart_content_title;
                $vartContent->vart_content_title_en = $request->vart_content_title_en;
                $vartContent->vart_content_text = $request->vart_content_text;
                $vartContent->vart_content_text_en = $request->vart_content_text_en;

                $file = TempFile::where('folder', $request->vart_content_image)->first();
                if ($file) {
                    if ($vartContent->vart_content_image) {
                        removeFileSource(getFolderForDestroyFile($vartContent->vart_content_image), true);
                    }
                    $vartContent->vart_content_image = moveFileSource($file->folder, $this->folder, $file->filename);
                    $file->delete();
                }
                $vartContent->save();
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
            $vartContent = VartContent::findOrFail($request->id);
            if ($vartContent->vart_content_image) {
                removeFileSource(getFolderForDestroyFile($vartContent->vart_content_image), true);
            }
            $vartContent->delete();
            
            DB::commit();
            return response()->json(array('message' => __('alert.blog.successfulNotification'), 'success' => true));
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(array('success' => false, 'route' => '500'));
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
