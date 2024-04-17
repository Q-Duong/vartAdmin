<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Redirect;

class BlogController extends Controller
{
    public function add()
    {
        $getAllBlogCategory = BlogCategory::orderBy('blog_category_id', 'ASC')->get();
        return view('admin.Blog.add')->with(compact('getAllBlogCategory'));
    }

    public function list()
    {
        $getAllBlog = Blog::orderBy('blog_id', 'DESC')->get();
        return view('admin.Blog.list')->with(compact('getAllBlog'));
    }

    public function upload_image_ck(Request $request)
    {
        if ($request->hasFile('upload')) {
            $get_image = $request->file('upload');
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image =  $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move(public_path('storeimages/content/'), $new_image);
            $url = asset('storeimages/content/' . $new_image);
            return response()->json(['fileName' => $new_image, 'uploaded' => 1, 'url' => $url]);
        }
    }

    public function save(Request $request)
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

    public function edit($blog_id)
    {
        $getAllBlogCategory = BlogCategory::orderBy('blog_category_id', 'ASC')->get();
        $blog = Blog::find($blog_id);
        return view('admin.Blog.edit')->with(compact('getAllBlogCategory', 'blog'));
    }

    public function update(Request $request, $blog_id)
    {
        $this->checkUpdateBlog($request);
        $data = $request->all();
        $blog = Blog::find($blog_id);
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
        return Redirect::to('admin/blog/list')->with('success', 'Cập nhật bài viết thành công');
    }

    public function delete($blog_id)
    {
        $blog = Blog::find($blog_id);
        $blog_image = $blog->blog_image;
        if ($blog_image) {
            unlink(public_path('storeimages/blog/') . $blog_image);
        }
        $blog->delete();
        return Redirect()->back()->with('success', 'Xóa bài viết thành công');
    }
    //Front End

    public function show_blog_categories()
    {
        return view('pages.blog.blog_categories');
    }

    public function show_blog_categories_slug(Request $request, $blog_category_slug)
    {
        $blogCategory = BlogCategory::where('blog_category_slug', $blog_category_slug)->first();
        $getAllBlog = Blog::where('blog_category_id', $blogCategory->blog_category_id)->orderBy('blog_id', 'DESC')->paginate(12);
        return view('pages.blog.blog_categories_slug')->with(compact('getAllBlog', 'blogCategory'));
    }

    public function show_blog_in_categories(Request $request, $blog_category_slug, $blog_slug)
    {
        $blogCategory = BlogCategory::where('blog_category_slug', $blog_category_slug)->first();
        $blog = Blog::where('blog_slug', $blog_slug)->first();
        $Comment = Comment::where('blog_id', $blog->blog_id);
        $totalComment = count($Comment->get());
        $getPaginateComment = $Comment->paginate(2);
        $remaining = $totalComment - count($getPaginateComment);
        $getAllRelatedBlog = Blog::where('blog_category_id', $blogCategory->blog_category_id)->whereNotIn('blog_slug', [$blog_slug]);
        $totalBlog = count($getAllRelatedBlog->get());
        $relatedBlog = $getAllRelatedBlog->take($totalBlog % 2 == 0 || $totalBlog > 6 ? 6 : $totalBlog - 1)->orderBy('blog_id', 'DESC')->get();
        return view('pages.blog.blog_details')->with(compact('blogCategory', 'blog', 'getPaginateComment', 'remaining', 'totalComment', 'relatedBlog'));
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
