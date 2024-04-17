<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hart;
use App\Models\HartContent;

class HartController extends Controller
{
    public function add()
    {
        return view('admin.Hart.add');
    }

    public function list()
    {
        $getAllHart = Hart::orderBy('hart_id', 'DESC')->get();
        return view('admin.Hart.list')->with(compact('getAllHart'));
    }

    public function save(Request $request)
    {
        // $this->checkPostAdd($request);
        $data = $request->all();
        $hart = new Hart();
        $hart->hart_title = $data['hart_title'];
        $hart->hart_slug = $data['hart_slug'];
        $get_image = $request->file('hart_image');
        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image =  $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move(public_path('storeimages/hart/'), $new_image);
            $hart->hart_image = $new_image;
        }
        $hart->save();

        return Redirect()->back()->with('success', 'Thêm dịch vụ thành công');
    }

    public function edit($hart_id)
    {
        $hart = Hart::find($hart_id);
        $getAllHartContent = HartContent::where('hart_id', $hart_id)->get();
        return view('admin.Hart.edit')->with(compact('hart', 'getAllHartContent'));
    }

    public function update(Request $request, $hart_id)
    {
        //$this->checkPostUpdate($request);
        $data = $request->all();
        $hart = Hart::find($hart_id);
        $hart->hart_title = $data['hart_title'];
        $hart->hart_slug = $data['hart_slug'];
        $get_image = $request->file('hart_image');
        if ($get_image) {
            $path = public_path('storeimages/hart/');
            unlink($path . $hart->hart_image);

            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image =  $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move($path, $new_image);
            $hart->hart_image = $new_image;
        }
        $hart->save();
        return redirect()->route('listHart')->with('success', 'Cập nhật dịch vụ thành công');
    }

    public function loadHartContent(Request $request)
    {
        $getAllHartContent = HartContent::where('hart_id', $request->hart_id)->get();
        $html = view('admin.Hart.loadHartContent')->with(compact('getAllHartContent'))->render();
        return response()->json(array('success' => true, 'html' => $html));
    }

    public function addHartContent(Request $request)
    {
        // $this->checkPostAdd($request);
        $data = $request->all();
        $hartContent = new HartContent();
        $hartContent->hart_id = $data['hart_id'];
        $hartContent->hart_content_title = $data['hart_content_title'];
        $hartContent->hart_content_text = $data['hart_content_text'];
        $hartContent->hart_content_themes = 1;
        $get_image = $request->file('hart_content_image');
        if ($get_image) {
            $path = public_path('storeimages/hart/hartcontent');
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image =  $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move($path, $new_image);
            $hartContent->hart_content_image = $new_image;
        }
        $hartContent->save();
        return response()->json(array('message' => __('alert.blog.successfulNotification'), 'success' => true));
    }

    public function updateHartContent(Request $request)
    {
        // $this->checkPostAdd($request);
        $data = $request->all();
        $hartContent = HartContent::find($data['hart_content_id']);
        $hartContent->hart_content_title = $data['hart_content_title'];
        $hartContent->hart_content_text = $data['hart_content_text'];
        // $vartContent->vart_content_themes = $data['vart_content_themes'];
        $get_image = $request->file('hart_content_image');
        $path = public_path('storeimages/hart/hartcontent');
        // if($data['courses_content_type'] == 3){
        //     if ($coursesContent->courses_content_image != null) {
        //         unlink($path . $coursesContent->courses_content_image);
        //         $coursesContent->courses_content_image = '';
        //     }
        // }

        if ($get_image) {
            if ($hartContent->hart_content_image != null) {
                unlink($path . $hartContent->hart_content_image);
            }
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image =  $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move($path, $new_image);
            $hartContent->hart_content_image = $new_image;
        }
        $hartContent->save();
        return response()->json(array('message' => __('alert.blog.successfulNotification'), 'success' => true));
    }

    public function deleteHartContent($hart_content_id)
    {
        $hartContent = HartContent::find($hart_content_id);
        if ($hartContent->hart_content_image != null) {
            unlink(public_path('storeimages/hart/hartcontent/') . $hartContent->hart_content_image);
        }
        $hartContent->delete();
        return response()->json(array('message' => __('alert.blog.successfulNotification'), 'success' => true));
    }

    public function delete($hart_id)
    {
        $hart = Hart::find($hart_id);
        if ($hart->hart_image) {
            unlink(public_path('storeimages/hart/') . $hart->hart_image);
        }
        $hart->delete();
        return Redirect()->back()->with('success', 'Xóa dịch vụ thành công');
    }

    public function showHartMain()
    {
        $getAllHart = Hart::get();
        return view('pages.hart.hart_main')->with(compact('getAllHart'));
    }

    public function showHartDetails(Request $request, $hart_slug)
    {
        $hart = Hart::where('hart_slug', $hart_slug)->first();
        $getAllHartContent = HartContent::where('hart_id', $hart->hart_id)->get();
        return view('pages.hart.hart_details')->with(compact('hart', 'getAllHartContent'));
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
