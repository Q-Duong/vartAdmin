<?php

namespace App\Http\Controllers;

use App\Models\Conference;
use Illuminate\Http\Request;
use App\Models\ConferenceCategory;
use Illuminate\Support\Facades\Redirect;

class ConferenceCategoryController extends Controller
{
    public function add(){
    	return view('admin.ConferenceCategory.add');
    }
    
    public function list(){
       $getAllConferenceCategory = ConferenceCategory::orderBy('conference_category_id','ASC')->get();
    	return view('admin.ConferenceCategory.list')->with(compact('getAllConferenceCategory'));
    }
    public function save(Request $request){
    	$data = $request->all();
        $conference_category = new ConferenceCategory();
    	$conference_category->conference_category_name = $data['conference_category_name'];
        $conference_category->conference_category_slug = $data['conference_category_slug'];
        $name = $conference_category->conference_category_name;
        if(ConferenceCategory::where('conference_category_name',$name)->exists())
        {
            return Redirect()->back()->with('error','Danh mục đã tồn tại, Vui lòng kiểm tra lại.');
        }
        $get_image = $request->file('conference_category_image');
        if($get_image){
            $path = public_path('storeimages/conferencecategory/');
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move($path,$new_image);
            $conference_category->conference_category_image=$new_image;
            
        }
        $conference_category->save();

    	return Redirect()->back()->with('success','Thêm danh mục bài viết thành công');
    }
    
    public function edit($conference_category_id){
        $conferenceCategory = ConferenceCategory::find($conference_category_id);
        return view('admin.ConferenceCategory.edit')->with(compact('conferenceCategory'));
    }
    public function update(Request $request,$conference_category_id){
        $data = $request->all();
        $conference_category = ConferenceCategory::find($conference_category_id);
        $conference_category->conference_category_name = $data['conference_category_name'];
        $conference_category->conference_category_slug = $data['conference_category_slug'];
        $get_image = $request->file('blog_category_image');
        if($get_image){
            $path = public_path('storeimages/conferencecategory/');
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move($path,$new_image);
            $conference_category->conference_category_image=$new_image;
            
        }
        $conference_category->save();

    	return Redirect()->Route('listConferenceCategory')->with('success','Cập nhật danh mục bài viết thành công');
    }
    public function delete($conference_category_id){
        $conference_category = ConferenceCategory::find($conference_category_id);
        $conference_category->delete();
        return Redirect()->back()->with('success','Xóa danh mục bài viết thành công');
    }

    public function showConferenceCategoryMain()
    {
        $getAllConferenceCategory = ConferenceCategory::get();
        $getAllConference = Conference::orderBy('conference_id','DESC')->get();
        return view('pages.conference.conference_main')->with(compact('getAllConferenceCategory','getAllConference'));
    }
}
