<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vart;
use App\Models\VartContent;

class VartController extends Controller
{
    public function add()
    {
        return view('admin.Vart.add');
    }

    public function list()
    {
        $getAllVart = Vart::orderBy('vart_id', 'DESC')->get();
        return view('admin.Vart.list')->with(compact('getAllVart'));
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
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image =  $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move(public_path('storeimages/vart/'), $new_image);
            $vart->vart_image = $new_image;
        }
        $vart->save();
        return Redirect()->back()->with('success', 'Thêm dịch vụ thành công');
    }

    public function edit($vart_id)
    {
        $vart = Vart::find($vart_id);
        $getAllVartContent = VartContent::where('vart_id', $vart_id)->get();
        return view('admin.Vart.edit')->with(compact('vart', 'getAllVartContent'));
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
            $path = public_path('storeimages/vart/');
            unlink($path . $vart->vart_image);

            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image =  $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move($path, $new_image);
            $vart->vart_image = $new_image;
        }
        $vart->save();
        return redirect()->route('listVart')->with('success', 'Cập nhật dịch vụ thành công');
    }

    public function loadVartContent(Request $request)
    {
        $getAllVartContent = VartContent::where('vart_id', $request->vart_id)->get();
        $html = view('admin.Vart.loadVartContent')->with(compact('getAllVartContent'))->render();
        return response()->json(array('success' => true, 'html' => $html));
    }

    public function addVartContent(Request $request)
    {
        // $this->checkPostAdd($request);
        $data = $request->all();
        $vartContent = new VartContent();
        $vartContent->vart_id = $data['vart_id'];
        $vartContent->vart_content_title = $data['vart_content_title'];
        $vartContent->vart_content_text = $data['vart_content_text'];
        $vartContent->vart_content_themes = 1;
        $get_image = $request->file('vart_content_image');
        if ($get_image) {
            $path = public_path('storeimages/vart/vartcontent');
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image =  $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move($path, $new_image);
            $vartContent->vart_content_image = $new_image;
        }
        $vartContent->save();
        return response()->json(array('message' => __('alert.blog.successfulNotification'), 'success' => true));
    }

    public function updateVartContent(Request $request)
    {
        // $this->checkPostAdd($request);
        $data = $request->all();
        $vartContent = VartContent::find($data['vart_content_id']);
        $vartContent->vart_content_title = $data['vart_content_title'];
        $vartContent->vart_content_text = $data['vart_content_text'];
        // $vartContent->vart_content_themes = $data['vart_content_themes'];
        $get_image = $request->file('vart_content_image');
        $path = public_path('storeimages/vart/vartcontent');
        // if($data['courses_content_type'] == 3){
        //     if ($coursesContent->courses_content_image != null) {
        //         unlink($path . $coursesContent->courses_content_image);
        //         $coursesContent->courses_content_image = '';
        //     }
        // }

        if ($get_image) {
            if ($vartContent->vart_content_image != null) {
                unlink($path . $vartContent->vart_content_image);
            }
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image =  $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move($path, $new_image);
            $vartContent->vart_content_image = $new_image;
        }
        $vartContent->save();
        return response()->json(array('message' => __('alert.blog.successfulNotification'), 'success' => true));
    }

    public function deleteVartContent($vart_content_id)
    {
        $vartContent = VartContent::find($vart_content_id);
        // if ($vartContent->vart_content_image != null) {
        //     unlink(public_path('storeimages/vart/vartcontent/') . $vartContent->vart_content_image);
        // }
        $vartContent->delete();
        return response()->json(array('message' => __('alert.blog.successfulNotification'), 'success' => true));
    }

    public function delete($vart_id)
    {
        $vart = Vart::find($vart_id);
        if ($vart->vart_image) {
            unlink(public_path('storeimages/vart/') . $vart->vart_image);
        }
        $vart->delete();
        return Redirect()->back()->with('success', 'Xóa dịch vụ thành công');
    }

    public function showVartMain()
    {
        $getAllVart = Vart::get();
        return view('pages.vart.vart_main')->with(compact('getAllVart'));
    }

    public function showVartDetails(Request $request, $vart_slug)
    {
        $vart = Vart::where('vart_slug', $vart_slug)->first();
        $getAllVartContent = VartContent::where('vart_id', $vart->vart_id)->get();
        return view('pages.vart.vart_details')->with(compact('vart', 'getAllVartContent'));
    }

    //Validation
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
