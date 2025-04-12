<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Conference;
use App\Models\EnReport;
use App\Models\Hart;
use App\Models\Hrtta;
use App\Models\Payment;
use App\Models\Register;
use App\Models\Report;
use App\Models\TempFile;
use App\Models\Vart;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function process(Request $request)
    {
        // Report
        if ($request->hasFile('report_image')) {
            $folder = saveImageFileDrive($request->file('report_image'), 'google');
        }
        if ($request->hasFile('report_image_card')) {
            $folder = saveImageFileDrive($request->file('report_image_card'), 'google');
        }
        if ($request->hasFile('report_file')) {
            $folder = saveImageFileDrive($request->file('report_file'), 'docs');
        }
        if ($request->hasFile('report_file_background')) {
            $folder = saveImageFileDrive($request->file('report_file_background'), 'background');
        }
        if ($request->hasFile('en_report_file')) {
            $folder = saveImageFileDrive($request->file('en_report_file'), 'docs');
        }
        // Register
        if ($request->hasFile('register_image')) {
            $folder = saveImageFileDrive($request->file('register_image'), 'google');
        }
        if ($request->hasFile('register_image_card')) {
            $folder = saveImageFileDrive($request->file('register_image_card'), 'google');
        }
        if ($request->hasFile('payment_image')) {
            $folder = saveImageFileDrive($request->file('payment_image'), 'payment');
        }
        // VART
        if ($request->hasFile('vart_image')) {
            $folder = saveFileSource($request->file('vart_image'));
        }
        //HART
        if ($request->hasFile('hart_image')) {
            $folder = saveFileSource($request->file('hart_image'));
        }
        //HRTTA
        if ($request->hasFile('hrtta_image')) {
            $folder = saveFileSource($request->file('hrtta_image'));
        }
        //Conference
        if ($request->hasFile('conference_category_image')) {
            $folder = saveFileSource($request->file('conference_category_image'));
        }
        if ($request->hasFile('conference_image')) {
            $folder = saveFileSource($request->file('conference_image'));
        }
        if ($request->hasFile('conference_image_en')) {
            $folder = saveFileSource($request->file('conference_image_en'));
        }
        if ($request->hasFile('album_path')) {
            foreach ($request->file('album_path') as $key => $file) {
                $folder = saveFileSource($file);
                TempFile::create([
                    'folder' => $folder['folder'],
                    'filename' => $folder['fileName'],
                ]);
            }
            return response($folder['folder'], 200)->withHeaders([
                'Content-Type' => 'application/json',
            ]);
        }
        //Blog Categories
        if ($request->hasFile('blog_category_image')) {
            $folder = saveFileSource($request->file('blog_category_image'));
        }
        //Blog
        if ($request->hasFile('blog_image')) {
            $folder = saveFileSource($request->file('blog_image'));
        }

        TempFile::create([
            'folder' => $folder['folder'],
            'filename' => $folder['fileName'],
        ]);

        return response($folder['folder'], 200)->withHeaders([
            'Content-Type' => 'application/json',
        ]);
    }

    public function upload_image_ck(Request $request)
    {
        if ($request->hasFile('upload')) {
            $file = saveImagesCK($request->file('upload'));
            return response()->json(['fileName' => $file['fileName'], 'uploaded' => 1, 'url' => $file['url']]);
        }
    }

    public function revert(Request $request)
    {
        $tempFile = TempFile::where('folder', $request->getContent())->first();
        if ($tempFile) {
            removeFileSource($request->getContent(), false);
            deleteImageFileDrive($request->getContent());
            $tempFile->delete();
            return response('Success delete', 200);
        }
        return response('Failed delete', 500);
    }

    public function destroy(Request $request)
    {
        deleteImageFileDrive($request->path);
        $reportTypes = ['report_image', 'report_image_card', 'report_file', 'report_file_background'];
        if (in_array($request->type, $reportTypes)) {
            $report = Report::findOrFail($request->id);
            switch ($request->type) {
                case ('report_image'):
                    $report->report_image = null;
                    $report->save();
                    break;
                case ('report_image_card'):
                    $report->report_image_card = null;
                    $report->save();
                    break;
                case ('report_file'):
                    $report->report_file = null;
                    $report->save();
                    break;
                case ('report_file_background'):
                    $report->report_file_background = null;
                    $report->save();
                    break;
            }
        }
        if ($request->type == 'en_report_file') {
            $en_report = EnReport::findOrFail($request->id);
            $en_report->en_report_file = null;
            $en_report->save();
        }
        $registerTypes = ['register_image', 'register_image_card', 'payment_image'];
        if (in_array($request->type, $registerTypes)) {
            $register = Register::findOrFail($request->id);
            switch ($request->type) {
                case ('register_image'):
                    $register->register_image = null;
                    $register->save();
                    break;
                case ('register_image_card'):
                    $register->register_image_card = null;
                    $register->save();
                    break;
                case ('payment_image'):
                    $payment = Payment::findOrFail($register->payment_id);
                    $payment->payment_image = null;
                    $payment->save();
                    break;
            }
        }
        return response()->json(array('message' =>  __('alert.conference.successMessage_delete')));
    }

    public function destroyContent(Request $request)
    {
        switch ($request->target) {
            case ('vart'):
                $vart = Vart::findOrFail($request->id);
                removeFileSource(getFolderForDestroyFile($vart->vart_image), true);
                $vart->vart_image = null;
                $vart->save();
                break;
            case ('hart'):
                $hart = Hart::findOrFail($request->id);
                removeFileSource(getFolderForDestroyFile($hart->hart_image), true);
                $hart->hart_image = null;
                $hart->save();
                break;
            case ('hrtta'):
                $hrtta = Hrtta::findOrFail($request->id);
                removeFileSource(getFolderForDestroyFile($hrtta->hrtta_image), true);
                $hrtta->hrtta_image = null;
                $hrtta->save();
                break;
            case ('blogCategory'):
                $blogCategory = BlogCategory::findOrFail($request->id);
                removeFileSource(getFolderForDestroyFile($blogCategory->blog_category_image), true);
                $blogCategory->blog_category_image = null;
                $blogCategory->save();
                break;
            case ('blog'):
                $blog = Blog::findOrFail($request->id);
                removeFileSource(getFolderForDestroyFile($blog->blog_image), true);
                $blog->blog_image = null;
                $blog->save();
                break;
            case ('conference'):
                $conference = Conference::findOrFail($request->id);
                if ($request->locale == 'en') {
                    removeFileSource(getFolderForDestroyFile($conference->conference_image_en), true);
                    $conference->conference_image_en = null;
                } else {
                    removeFileSource(getFolderForDestroyFile($conference->conference_image), true);
                    $conference->conference_image = null;
                }
                $conference->save();
                break;
            case ('about'):
                $about = About::findOrFail($request->id);
                removeFileSource(getFolderForDestroyFile($about->about_image), true);
                $about->about_image = null;
                $about->save();
                break;
            case ('support_content'):
                $supportContent = SupportContent::findOrFail($request->id);
                removeFileSource(getFolderForDestroyFile($supportContent->support_content_image), true);
                $supportContent->support_content_image = null;
                $supportContent->save();
                break;
        }

        return response('Success delete', 200);
    }
}
