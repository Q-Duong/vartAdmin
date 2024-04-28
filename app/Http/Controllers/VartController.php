<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vart;
use App\Models\VartContent;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class VartController extends Controller
{
    private $mainFolder;
    private $folder;

    public function __construct()
    {
        $this->mainFolder = 'vart';
        $this->folder = 'vart/vartcontent';
    }

    public function create()
    {
        return view('pages.admin.vart.create');
    }

    public function list()
    {
        $getAllVart = Vart::orderBy('vart_id', 'DESC')->get();
        return view('pages.admin.vart.list')->with(compact('getAllVart'));
    }

    public function save(Request $request)
    {
        // $this->checkPostAdd($request);
        $data = $request->all();
        $vart = new Vart();
        $vart->vart_title = $data['vart_title'];
        $vart->vart_slug = $data['vart_slug'];
        $get_image = $request->file('vart_image');
        if ($get_image) {
            $vart->vart_image = saveImageSource($this->mainFolder, $get_image);
        }
        $vart->save();
        return Redirect()->back()->with('success', 'Thêm dịch vụ thành công');
    }

    public function edit($vart_id)
    {
        $vart = Vart::find($vart_id);
        $getAllVartContent = VartContent::where('vart_id', $vart_id)->get();
        return view('pages.admin.vart.edit')->with(compact('vart', 'getAllVartContent'));
    }

    public function update(Request $request, $vart_id)
    {
        //$this->checkPostUpdate($request);
        $data = $request->all();
        $vart = Vart::find($vart_id);
        $vart->vart_title = $data['vart_title'];
        $vart->vart_slug = $data['vart_slug'];
        $get_image = $request->file('vart_image');
        if ($get_image) {
            if ($vart->vart_image) {
                removeImageSource($this->mainFolder, $vart->vart_image);
            }
            $vart->vart_image = saveImageSource($this->mainFolder, $get_image);
        }
        $vart->save();
        return redirect()->route('listVart')->with('success', 'Cập nhật dịch vụ thành công');
    }

    public function loadVartContent(Request $request)
    {
        $getAllVartContent = VartContent::where('vart_id', $request->host_id)->get();
        $html = view('pages.admin.vart.loadVartContent')->with(compact('getAllVartContent'))->render();
        return response()->json(array('success' => true, 'html' => $html));
    }

    public function saveOrUpdateVartContent(Request $request)
    {
        $validator = Validator::make($request->all(), $this->validateVartContent(), $this->messageVartContent());
        if ($validator->fails()) {
            return response()->json(array('errors' => true, 'validator' => $validator->errors()));
        }
        DB::beginTransaction();
        try {
            $data = $request->all();
            if($data['type'] == 'create'){
                $vartContent = new VartContent();
                $vartContent->vart_id = $data['vart_id'];
                $vartContent->vart_content_title = $data['vart_content_title'];
                $vartContent->vart_content_title_en = $data['vart_content_title_en'];
                $vartContent->vart_content_text = $data['vart_content_text'];
                $vartContent->vart_content_text_en = $data['vart_content_text_en'];
                $vartContent->vart_content_themes = 1;
                $get_image = $request->file('vart_content_image');
                if ($get_image) {
                    $vartContent->vart_content_image = saveImageSource($this->folder, $get_image);
                }
                $get_image_en = $request->file('vart_content_image_en');
                if ($get_image_en) {
                    $vartContent->vart_content_image_en = saveImageSource($this->folder, $get_image_en);
                }
                $vartContent->save();
            }else{
                $vartContent = VartContent::find($data['vart_content_id']);
                $vartContent->vart_content_title = $data['vart_content_title'];
                $vartContent->vart_content_title_en = $data['vart_content_title_en'];
                $vartContent->vart_content_text = $data['vart_content_text'];
                $vartContent->vart_content_text_en = $data['vart_content_text_en'];
                $get_image = $request->file('vart_content_image');
                if ($get_image) {
                    if ($vartContent->vart_content_image) {
                        removeImageSource($this->folder, $vartContent->vart_content_image);
                    }
                    $vartContent->vart_content_image = saveImageSource($this->folder, $get_image);
                }
                $get_image_en = $request->file('vart_content_image_en');
                if ($get_image_en) {
                    if ($vartContent->vart_content_image_en) {
                        removeImageSource($this->folder, $vartContent->vart_content_image_en);
                    }
                    $vartContent->vart_content_image_en = saveImageSource($this->folder, $get_image_en);
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

    public function deleteVartContent($vart_content_id)
    {
        $vartContent = VartContent::find($vart_content_id);
        if ($vartContent->vart_content_image) {
            removeImageSource($this->folder, $vartContent->vart_content_image);
        }
        if ($vartContent->vart_content_image_en) {
            removeImageSource($this->folder, $vartContent->vart_content_image_en);
        }
        $vartContent->delete();
        return response()->json(array('message' => __('alert.blog.successfulNotification'), 'success' => true));
    }

    public function delete($vart_id)
    {
        $vart = Vart::find($vart_id);
        if ($vart->vart_image) {
            removeImageSource($this->mainFolder, $vart->vart_image);
        }
        $vart->delete();
        return Redirect()->back()->with('success', 'Xóa dịch vụ thành công');
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

    public function checkPostUpdate(Request $request)
    {
        $this->validate(
            $request,
            [
                'post_title' => 'required',
                'post_slug' => 'required',
                //'post_desc' => 'required',
                'post_content' => 'required',
            ],
            [
                'post_title.required' => 'Vui lòng điền thông tin',
                'post_slug.required' => 'Vui lòng điền thông tin',
                'post_desc.required' => 'Vui lòng điền thông tin',
                'post_content.required' => 'Vui lòng điền thông tin',
            ]
        );
    }

    public function checkPostAdd(Request $request)
    {
        $this->validate(
            $request,
            [
                'post_title' => 'required',
                'post_slug' => 'required',
                'post_image' => 'required',
                // 'post_desc' => 'required',
                'post_content' => 'required',
            ],
            [
                'post_title.required' => 'Vui lòng điền thông tin',
                'post_slug.required' => 'Vui lòng điền thông tin',
                'post_image.required' => 'Vui lòng theem hình ảnh',
                'post_desc.required' => 'Vui lòng điền thông tin',
                'post_content.required' => 'Vui lòng điền thông tin',
            ]
        );
    }
}
