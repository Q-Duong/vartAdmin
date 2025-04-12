<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlogCategory;
use App\Models\TempFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class BlogCategoryController extends Controller
{
    private $folder;

    public function __construct()
    {
        $this->folder = 'blogCategory';
    }
    public function index()
    {
        $getAllBlogCategory = BlogCategory::orderBy('id', 'DESC')->get();
        return view('pages.admin.blogCategory.index', compact('getAllBlogCategory'));
    }

    public function load(Request $request)
    {
        $getAllBlogCategory = BlogCategory::orderBy('id', 'DESC')->get();
        $html = view('pages.admin.blogCategory.render', compact('getAllBlogCategory'))->render();
        return response()->json(array('success' => true, 'html' => $html));
    }

    public function getForm(Request $request)
    {
        if ($request->type == 'create') {
            $html = view('pages.admin.blogCategory.create')->render();
        } else {
            $blogCategory = BlogCategory::findOrFail($request->id);
            $html = view('pages.admin.blogCategory.edit', compact('blogCategory'))->render();
        }
        return response()->json(array('success' => true, 'html' => $html));
    }

    public function storeOrUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), app(ValidateController::class)->validateBlogCategory($request->type), app(ValidateController::class)->messageBlogCategory());
        if ($validator->fails()) {
            return response()->json(array('errors' => true, 'validator' => $validator->errors()));
        }
        DB::beginTransaction();
        try {
            if ($request->type == 'create') {
                $blogCategory = new BlogCategory();
                $blogCategory->blog_category_name = $request->blog_category_name;
                $blogCategory->blog_category_name_en = $request->blog_category_name_en;
                $blogCategory->blog_category_slug = Str::slug($request->blog_category_name);
                $file = TempFile::firstWhere('folder', $request->blog_category_image);
                if ($file) {
                    $blogCategory->blog_category_image = moveFileSource($file->folder, $this->folder, $file->filename);
                    $file->delete();
                }
                $blogCategory->save();
                
            } else {
                $blogCategory = BlogCategory::findOrFail($request->id);
                $blogCategory->blog_category_name = $request->blog_category_name;
                $blogCategory->blog_category_name_en = $request->blog_category_name_en;
                $blogCategory->blog_category_slug = Str::slug($request->blog_category_name);
                $file = TempFile::firstWhere('folder', $request->blog_category_image);
                if ($file) {
                    if ($blogCategory->blog_category_image) {
                        removeFileSource(getFolderForDestroyFile($blogCategory->blog_category_image), true);
                    }
                    $blogCategory->blog_category_image = moveFileSource($file->folder, $this->folder, $file->filename);
                    $file->delete();
                }
                $blogCategory->save();
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
            $blogCategory = BlogCategory::findOrFail($request->id);
            if ($blogCategory->blog_category_image) {
                removeFileSource(getFolderForDestroyFile($blogCategory->blog_category_image), true);
            }
            $blogCategory->delete();
            DB::commit();
            return response()->json(array('message' => __('alert.blog.successfulNotification'), 'success' => true));
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(array('success' => false, 'route' => '500'));
        }
    }
}
