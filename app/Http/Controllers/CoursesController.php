<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Courses;
use App\Models\CoursesContent;
use Google\Service\Classroom\Course;

class CoursesController extends Controller
{
    public function addCourses()
    {
        return view('admin.Courses.addCourses');
    }

    public function listCourses()
    {
        $getAllCourses = Courses::orderBy('courses_id', 'DESC')->get();
        return view('admin.Courses.listCourses')->with(compact('getAllCourses'));
    }

    public function saveCourses(Request $request)
    {
        // $this->checkPostAdd($request);
        $data = $request->all();
        $courses = new Courses();
        $courses->courses_themes = $data['courses_themes'];
        $courses->courses_title = $data['courses_title'];
        $courses->courses_slug = $data['courses_slug'];
        $courses->courses_content = $data['courses_content'];
        $courses->courses_programs = $data['courses_programs'];
        $get_image = $request->file('courses_image');
        $name = $courses->courses_title;

        $check = Courses::where('courses_title', $name)->exists();
        if ($check) {
            return Redirect()->back()->with('error', 'Dịch vụ đã tồn tại, Vui lòng kiểm tra lại.')->withInput();
        }

        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image =  $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move(public_path('storeimages/courses/'), $new_image);
            $courses->courses_image = $new_image;
            $courses->save();
            return Redirect()->back()->with('success', 'Thêm dịch vụ thành công');
        } else {
            return Redirect()->back()->with('error', 'Vui lòng thêm hình ảnh');
        }
    }

    public function editCourses($courses_id)
    {
        $courses = Courses::find($courses_id);
        $getAllCoursesContent = CoursesContent::where('courses_id', $courses_id)->get();
        return view('admin.Courses.editCourses')->with(compact('courses', 'getAllCoursesContent'));
    }

    public function updateCourses(Request $request, $courses_id)
    {
        //$this->checkPostUpdate($request);
        $data = $request->all();
        $courses = Courses::find($courses_id);
        $courses->courses_themes = $data['courses_themes'];
        $courses->courses_title = $data['courses_title'];
        $courses->courses_slug = $data['courses_slug'];
        $courses->courses_content = $data['courses_content'];
        $courses->courses_programs = $data['courses_programs'];
        $courses_image = $courses->courses_image;
        $get_image = $request->file('courses_image');

        if ($get_image) {
            $path = public_path('storeimages/courses/');
            unlink($path . $courses_image);

            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image =  $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move($path, $new_image);
            $courses->courses_image = $new_image;
        }
        $courses->save();
        return redirect()->route('listCourses')->with('success', 'Cập nhật dịch vụ thành công');
    }

    public function loadCoursesContent(Request $request)
    {
        $getAllCoursesContent = CoursesContent::where('courses_id', $request->courses_id)->get();
        $html = view('admin.Courses.loadCoursesContent')->with(compact('getAllCoursesContent'))->render();
        return response()->json(array('success' => true, 'html' => $html));
    }

    public function addCoursesContent(Request $request)
    {
        // $this->checkPostAdd($request);
        $data = $request->all();
        $coursesContent = new CoursesContent();
        $coursesContent->courses_id = $data['courses_id'];
        $coursesContent->courses_content_title = $data['courses_content_title'];
        $coursesContent->courses_content_text = $data['courses_content_text'];
        $coursesContent->courses_content_type = $data['courses_content_type'];
        $get_image = $request->file('courses_content_image');
        if ($get_image) {
            $path = public_path('storeimages/coursescontent/');
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image =  $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move($path, $new_image);
            $coursesContent->courses_content_image = $new_image;
        }
        $coursesContent->save();
        return response()->json(array('message' => __('alert.blog.successfulNotification'), 'success' => true));
    }

    public function updateCoursesContent(Request $request)
    {
        // $this->checkPostAdd($request);
        $data = $request->all();
        $coursesContent = CoursesContent::find($data['courses_content_id']);
        $coursesContent->courses_content_title = $data['courses_content_title'];
        $coursesContent->courses_content_text = $data['courses_content_text'];
        $coursesContent->courses_content_type = $data['courses_content_type'];
        $get_image = $request->file('courses_content_image');
        $path = public_path('storeimages/coursescontent/');
        if($data['courses_content_type'] == 3){
            if ($coursesContent->courses_content_image != null) {
                unlink($path . $coursesContent->courses_content_image);
                $coursesContent->courses_content_image = '';
            }
        }
        
        if ($get_image && $data['courses_content_type'] != 3) {
            if ($coursesContent->courses_content_image != null) {
                unlink($path . $coursesContent->courses_content_image);
            }
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image =  $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move($path, $new_image);
            $coursesContent->courses_content_image = $new_image;
        }
        $coursesContent->save();
        return response()->json(array('message' => __('alert.blog.successfulNotification'), 'success' => true));
    }

    public function deleteCoursesContent($courses_content_id)
    {
        $coursesContent = CoursesContent::find($courses_content_id);
        if ($coursesContent->courses_content_image) {
            unlink(public_path('storeimages/coursescontent/') . $coursesContent->courses_content_image);
        }
        $coursesContent->delete();
        return response()->json(array('message' => __('alert.blog.successfulNotification'), 'success' => true));
    }

    public function deleteCourses($courses_id)
    {
        $courses = Courses::find($courses_id);
        $courses_image = $courses->courses_image;
        if ($courses_image) {
            unlink(public_path('storeimages/courses/') . $courses_image);
        }
        $courses->delete();
        return Redirect()->back()->with('success', 'Xóa dịch vụ thành công');
    }

    public function showCoursesMain()
    {
        $getAllCourses = Courses::get();
        return view('pages.courses.courses_main')->with(compact('getAllCourses'));
    }

    public function showCourses(Request $request, $courses_slug)
    {
        $courses = Courses::where('courses_slug', $courses_slug)->first();
        $getAllCoursesContent = CoursesContent::where('courses_id', $courses->courses_id)->orderBy('courses_content_type', 'ASC')->get();
        return view('pages.courses.courses_details')->with(compact('courses', 'getAllCoursesContent'));
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
