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

class UploadController extends Controller
{
    public function store(Request $request)
    {
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
        if ($request->hasFile('register_image')) {
            $folder = saveImageFileDrive($request->file('register_image'));
        }
        if ($request->hasFile('register_image_card')) {
            $folder = saveImageFileDrive($request->file('register_image_card'));
        }
        if ($request->hasFile('payment_image')) {
            $folder = saveImageFileDrive($request->file('payment_image'));
        }
        TempFile::create([
            'folder' => $folder,
        ]);
        return response($folder, 200)->withHeaders([
            'Content-Type' => 'application/json',
        ]);
    }

    public function destroy(Request $request)
    {
        $data = $request->all();
        deleteImageFileDrive($data['path']);
        $reportTypes = ['report_image', 'report_image_card', 'report_file'];
        if(in_array($data['type'], $reportTypes)){
            $report = Report::findOrFail($data['id']);
            switch ($data['type']) {
                case ('report_image'):
                    $report->report_image = '';
                    $report->save();
                    break;
                case ('report_image_card'):
                    $report->report_image_card = '';
                    $report->save();
                    break;
                case ('report_file'):
                    $report->report_file = '';
                    $report->save();
                    break;
            }
        }
        if($data['type'] == 'en_report_file'){
            $en_report = EnReport::findOrFail($data['id']);
            $en_report->en_report_file = '';
            $en_report->save();
        }
        $registerTypes = ['register_image', 'register_image_card', 'payment_image'];
        if(in_array($data['type'], $registerTypes)){
            $register = Register::findOrFail($data['id']);
            switch ($data['type']) {
                case ('register_image'):
                    $register->register_image = '';
                    $register->save();
                    break;
                case ('register_image_card'):
                    $register->register_image_card = '';
                    $register->save();
                    break;
                case ('payment_image'):
                    $payment = Payment::findOrFail($register->payment_id);
                    $payment->payment_image = '';
                    $payment->save();
                    break;
            }
        }
        return response()->json(array('message' =>  __('alert.conference.successMessage_delete')));
    }
}
