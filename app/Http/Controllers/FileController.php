<?php

namespace App\Http\Controllers;

use App\Models\EnReport;
use App\Models\Payment;
use App\Models\Register;
use App\Models\Report;
use App\Models\TempFile;
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
            $folder = saveImageFileDrive($request->file('report_image'));
        }
        if ($request->hasFile('report_image_card')) {
            $folder = saveImageFileDrive($request->file('report_image_card'));
        }
        if ($request->hasFile('report_file')) {
            $folder = saveImageFileDrive($request->file('report_file'));
        }
        if ($request->hasFile('en_report_file')) {
            $folder = saveImageFileDrive($request->file('en_report_file'));
        }
         // Register
        if ($request->hasFile('register_image')) {
            $folder = saveImageFileDrive($request->file('register_image'));
        }
        if ($request->hasFile('register_image_card')) {
            $folder = saveImageFileDrive($request->file('register_image_card'));
        }
        if ($request->hasFile('payment_image')) {
            $folder = saveImageFileDrive($request->file('payment_image'));
        }
        // VART
        if ($request->hasFile('vart_image')) {
            $folder = saveFileSource($request->file('vart_image'));
        }
        if ($request->hasFile('vart_content_image')) {
            $folder = saveFileSource($request->file('vart_content_image'));
        }
        if ($request->hasFile('vart_content_image_en')) {
            $folder = saveFileSource($request->file('vart_content_image_en'));
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
        $reportTypes = ['report_image', 'report_image_card', 'report_file'];
        if(in_array($request->type, $reportTypes)){
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
            }
        }
        if($request->type == 'en_report_file'){
            $en_report = EnReport::findOrFail($request->id);
            $en_report->en_report_file = null;
            $en_report->save();
        }
        $registerTypes = ['register_image', 'register_image_card', 'payment_image'];
        if(in_array($request->type, $registerTypes)){
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
}
