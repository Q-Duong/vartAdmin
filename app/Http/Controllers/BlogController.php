<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use App\Models\TempFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
    private $folder;

    public function __construct()
    {
        $this->folder = 'blog';
    }
    public function index()
    {
        $getAllBlog = Blog::join('blog_categories', 'blog_categories.id', '=', 'blogs.blog_category_id')
            ->select(
                'blog_categories.blog_category_name_en',
                'blogs.id',
                'blog_title',
                'blog_title_en',
                'blog_image',
            )
            ->orderBy('id', 'DESC')
            ->paginate(10);
        return view('pages.admin.blog.index', compact('getAllBlog'));
    }

    public function load(Request $request)
    {
        $getAllBlog = Blog::join('blog_categories', 'blog_categories.id', '=', 'blogs.blog_category_id')
            ->select(
                'blog_categories.blog_category_name_en',
                'blogs.id',
                'blog_title',
                'blog_title_en',
                'blog_image',
            )
            ->orderBy('id', 'DESC')
            ->paginate(10);
        $html = view('pages.admin.blog.render', compact('getAllBlog'))->render();
        return response()->json(array('success' => true, 'html' => $html));
    }

    public function getForm(Request $request)
    {
        $getAllBlogCategory = BlogCategory::orderBy('id', 'DESC')->get();
        if ($request->type == 'create') {
            $html = view('pages.admin.blog.create', compact('getAllBlogCategory'))->render();
        } else {
            $blog = Blog::findOrFail($request->id);
            $html = view('pages.admin.blog.edit', compact('getAllBlogCategory', 'blog'))->render();
        }
        return response()->json(array('success' => true, 'html' => $html));
    }

    public function storeOrUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), app(ValidateController::class)->validateBlog($request->type), app(ValidateController::class)->messageBlog());
        if ($validator->fails()) {
            return response()->json(array('errors' => true, 'validator' => $validator->errors()));
        }
        DB::beginTransaction();
        try {
            if ($request->type == 'create') {
                $blog = new Blog();
                $blog->blog_title = $request->blog_title;
                $blog->blog_title_en = $request->blog_title_en;
                $blog->blog_slug = Str::slug($request->blog_title);
                $blog->blog_text = $request->blog_text;
                $blog->blog_text_en = $request->blog_text_en;
                $blog->blog_category_id = $request->blog_category_id;
                $file = TempFile::firstWhere('folder', $request->blog_image);
                if ($file) {
                    $blog->blog_image = moveFileSource($file->folder, $this->folder, $file->filename);
                    $file->delete();
                }
                $blog->save();
            } else {
                $blog = Blog::findOrFail($request->id);
                $blog->blog_title = $request->blog_title;
                $blog->blog_title_en = $request->blog_title_en;
                $blog->blog_slug = Str::slug($request->blog_title);
                $blog->blog_text = $request->blog_text;
                $blog->blog_text_en = $request->blog_text_en;
                $blog->blog_category_id = $request->blog_category_id;
                $file = TempFile::firstWhere('folder', $request->blog_image);
                if ($file) {
                    if ($blog->blog_image) {
                        removeFileSource(getFolderForDestroyFile($blog->blog_image), true);
                    }
                    $blog->blog_image = moveFileSource($file->folder, $this->folder, $file->filename);
                    $file->delete();
                }
                $blog->save();
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
            $blog = Blog::findOrFail($request->id);
            if ($blog->blog_image) {
                removeFileSource(getFolderForDestroyFile($blog->blog_image), true);
            }
            $blog->delete();
            DB::commit();
            return response()->json(array('message' => __('alert.blog.successfulNotification'), 'success' => true));
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(array('success' => false, 'route' => '500'));
        }
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
