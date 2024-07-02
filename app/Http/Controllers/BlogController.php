<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class BlogController extends Controller
{
    public function index()
    {
        $getAllBlog = Blog::orderBy('id', 'DESC')->get();
        return view('pages.admin.blog.index', compact('getAllBlog'));
    }
    public function create()
    {
        $getAllBlogCategory = BlogCategory::orderBy('id', 'ASC')->get();
        return view('pages.admin.blog.create', compact('getAllBlogCategory'));
    }

    public function store(Request $request)
    {
        $this->checkAddBlog($request);
        $data = $request->all();
        $blog = new Blog();
        $blog->blog_title = $data['blog_title'];
        $blog->blog_slug = $data['blog_slug'];
        $blog->blog_content = $data['blog_content'];
        $blog->blog_category_id = $data['blog_category_id'];
        $get_image = $request->file('blog_image');
        if (Blog::where('blog_title', $blog->blog_title)->exists()) {
            return Redirect()->back()->with('error', 'Bài đã tồn tại, Vui lòng kiểm tra lại.')->withInput();
        }

        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image =  $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move(public_path('storeimages/blog/'), $new_image);
            $blog->blog_image = $new_image;
            $blog->save();
            return Redirect()->back()->with('success', 'Thêm bài viết thành công');
        } else {
            return Redirect()->back()->with('error', 'Vui lòng thêm hình ảnh');
        }
    }
    public function edit($id)
    {
        $getAllBlogCategory = BlogCategory::orderBy('id', 'ASC')->get();
        $blog = Blog::find($id);
        return view('pages.admin.blog.edit', compact('getAllBlogCategory', 'blog'));
    }
    public function update(Request $request, $id)
    {
        $this->checkUpdateBlog($request);
        $data = $request->all();
        $blog = Blog::find($id);
        $blog->blog_title = $data['blog_title'];
        $blog->blog_slug = $data['blog_slug'];
        $blog->blog_content = $data['blog_content'];
        $blog->blog_category_id = $data['blog_category_id'];
        $get_image = $request->file('blog_image');

        if ($get_image) {
            $blog_image_old = $blog->blog_image;
            $path = public_path('storeimages/blog/');
            unlink($path . $blog_image_old);
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image =  $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move($path, $new_image);
            $blog->blog_image = $new_image;
        }
        $blog->save();
        return Redirect::route('blog.index')->with('success', 'Cập nhật bài viết thành công');
    }
    public function destroy($id)
    {
        $blog = Blog::find($id);
        $blog_image = $blog->blog_image;
        if ($blog_image) {
            unlink(public_path('storeimages/blog/') . $blog_image);
        }
        $blog->delete();
        return Redirect()->back()->with('success', 'Xóa bài viết thành công');
    }

    //Validation
    public function checkUpdateBlog(Request $request)
    {
        $this->validate(
            $request,
            [
                'blog_title' => 'required',
                'blog_slug' => 'required',
                'blog_content' => 'required',
            ],
            [
                'blog_title.required' => 'Vui lòng điền thông tin',
                'blog_slug.required' => 'Vui lòng điền thông tin',
                'blog_content.required' => 'Vui lòng điền thông tin',
            ]
        );
    }

    public function checkAddBlog(Request $request)
    {
        $this->validate(
            $request,
            [
                'blog_title' => 'required',
                'blog_slug' => 'required',
                'blog_image' => 'required',
                'blog_content' => 'required',
            ],
            [
                'blog_title.required' => 'Vui lòng điền thông tin',
                'blog_slug.required' => 'Vui lòng điền thông tin',
                'blog_image.required' => 'Vui lòng theem hình ảnh',
                'blog_content.required' => 'Vui lòng điền thông tin',
            ]
        );
    }
}
