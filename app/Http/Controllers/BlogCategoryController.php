<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlogCategory;
use Illuminate\Support\Facades\Redirect;

class BlogCategoryController extends Controller
{
    public function index()
    {
        $getAllBlogCategory = BlogCategory::orderBy('blog_category_id', 'ASC')->get();
        return view('pages.admin.blogCategory.index', compact('getAllBlogCategory'));
    }
    public function create()
    {
        return view('pages.admin.blogCategory.create');
    }
    public function store(Request $request)
    {
        $data = $request->all();
        $blog_category = new BlogCategory();
        $blog_category->blog_category_name = $data['blog_category_name'];
        $blog_category->blog_category_slug = $data['blog_category_slug'];
        $name = $blog_category->blog_category_name;
        if (BlogCategory::where('blog_category_name', $name)->exists()) {
            return Redirect()->back()->with('error', 'Danh mục đã tồn tại, Vui lòng kiểm tra lại.');
        }
        $get_image = $request->file('blog_category_image');
        if ($get_image) {
            $path = public_path('storeimages/blogcategory/');
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image =  $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move($path, $new_image);
            $blog_category->blog_category_image = $new_image;
        }
        $blog_category->save();

        return Redirect()->back()->with('success', 'Thêm danh mục bài viết thành công');
    }
    public function edit($blog_category_id)
    {
        $blogCategory = BlogCategory::find($blog_category_id);
        return view('pages.admin.blogCategory.edit', compact('blogCategory'));
    }
    public function update(Request $request, $blog_category_id)
    {
        $data = $request->all();
        $blog_category = BlogCategory::find($blog_category_id);
        $blog_category->blog_category_name = $data['blog_category_name'];
        $blog_category->blog_category_slug = $data['blog_category_slug'];
        $get_image = $request->file('blog_category_image');
        if ($get_image) {
            $path = public_path('storeimages/blogcategory/');
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image =  $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move($path, $new_image);
            $blog_category->blog_category_image = $new_image;
        }
        $blog_category->save();

        return Redirect::route('blog_category.index')->with('success', 'Cập nhật danh mục bài viết thành công');
    }
    public function destroy($blog_category_id)
    {
        $blog_category = BlogCategory::find($blog_category_id);
        $blog_category->delete();
        return Redirect()->back()->with('success', 'Xóa danh mục bài viết thành công');
    }
}
