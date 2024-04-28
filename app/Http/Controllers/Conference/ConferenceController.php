<?php

namespace App\Http\Controllers\Conference;

use App\Http\Controllers\Controller;
use App\Models\Conference;
use App\Models\ConferenceCategory;
use App\Models\ConferenceFee;
use App\Models\ConferenceType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExcelExportVNReport;
use App\Exports\ExcelExportENReport;
use App\Exports\ExcelExportVnRegister;
use App\Exports\ExcelExportEnRegister;
use App\Mail\MailAcceptanceEN;
use App\Mail\ReplyMail;
use App\Models\Academic;
use App\Models\EnRegister;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class ConferenceController extends Controller
{
    private $locale;
    private $folder;

    public function __construct()
    {
        $this->locale = App::getLocale();
        $this->folder = 'conference';
    }

    public function add()
    {
        $getAllConferenceCategory = ConferenceCategory::orderBy('conference_category_id', 'ASC')->get();
        $getAllConferenceType = ConferenceType::orderBy('conference_type_id', 'ASC')->get();
        return view('pages.admin.conference.add')->with(compact('getAllConferenceCategory', 'getAllConferenceType'));
    }

    public function list()
    {
        $getAllConference = Conference::orderBy('conference_id', 'ASC')->get();
        return view('admin.Conference.list')->with(compact('getAllConference'));
    }
    public function save(Request $request)
    {
        $data = $request->all();
        $conference = new Conference();
        $conference->conference_code = $data['conference_code'];
        $conference->conference_title = $data['conference_title'];
        $conference->conference_title_en = $data['conference_title_en'];
        $conference->conference_slug = $data['conference_slug'];
        $conference->conference_content = $data['conference_content'];
        $conference->conference_content_en = $data['conference_content_en'];
        $conference->conference_category_id = $data['conference_category_id'];
        $conference->conference_type_id = $data['conference_type_id'];
        $conference->conference_form_type = 1;
        if (Conference::where('conference_title', $conference->conference_image)->exists()) {
            return Redirect()->back()->with('error', 'Danh mục đã tồn tại, Vui lòng kiểm tra lại.');
        }
        if (Conference::where('conference_code', $data['conference_code'])->exists()) {
            return Redirect()->back()->with('error', 'Danh mục đã tồn tại, Vui lòng kiểm tra lại.');
        }
        $get_image = $request->file('conference_image');
        if ($get_image) {
            $conference->conference_image = saveImageSource($this->folder, $get_image);
        }
        $get_image_en = $request->file('conference_image_en');
        if ($get_image_en) {
            $conference->conference_image_en = saveImageSource($this->folder, $get_image_en);
        }
        $conference->save();

        return Redirect()->back()->with('success', 'Thêm danh mục bài viết thành công');
    }

    public function edit($conference_id)
    {
        $getAllConferenceCategory = ConferenceCategory::orderBy('conference_category_id', 'ASC')->get();
        $getAllConferenceType = ConferenceType::orderBy('conference_type_id', 'ASC')->get();
        $conference = Conference::find($conference_id);
        $getAllConferenceFee = ConferenceFee::where('conference_id', $conference_id)->get();
        return view('admin.Conference.edit')->with(compact('conference', 'getAllConferenceCategory', 'getAllConferenceType', 'getAllConferenceFee'));
    }
    public function update(Request $request, $conference_id)
    {
        $data = $request->all();
        $conference = Conference::findOrFail($conference_id);
        $conference->conference_code = $data['conference_code'];
        $conference->conference_title = $data['conference_title'];
        $conference->conference_title_en = $data['conference_title_en'];
        $conference->conference_slug = $data['conference_slug'];
        $conference->conference_content = $data['conference_content'];
        $conference->conference_content_en = $data['conference_content_en'];
        $conference->conference_category_id = $data['conference_category_id'];
        $conference->conference_type_id = $data['conference_type_id'];
        $get_image = $request->file('conference_image');
        if ($get_image) {
            if ($conference->conference_image) {
                removeImageSource($this->folder, $conference->conference_image);
            }
            $conference->conference_image = saveImageSource($this->folder, $get_image);
        }
        $get_image_en = $request->file('conference_image_en');
        if ($get_image_en) {
            if ($conference->conference_image_en) {
                removeImageSource($this->folder, $conference->conference_image_en);
            }
            $conference->conference_image_en = saveImageSource($this->folder, $get_image_en);
        }
        $conference->save();

        return Redirect()->Route('listConference')->with('success', 'Cập nhật danh mục bài viết thành công');
    }
    public function delete($conference_id)
    {
        $conference = Conference::findOrFail($conference_id);
        if ($conference->conference_image) {
            removeImageSource($this->folder, $conference->conference_image);
        }
        if ($conference->conference_image_en) {
            removeImageSource($this->folder, $conference->conference_image_en);
        }
        $conference->delete();
        return Redirect()->back()->with('success', 'Xóa danh mục bài viết thành công');
    }

    public function loadConferenceFee(Request $request)
    {
        $getAllConferenceFee = ConferenceFee::where('conference_id', $request->conference_id)->get();
        $html = view('admin.Conference.loadConferenceFee')->with(compact('getAllConferenceFee'))->render();
        return response()->json(array('success' => true, 'html' => $html));
    }

    public function addConferenceFee(Request $request)
    {
        // $this->checkPostAdd($request);
        $data = $request->all();
        // dd($data);
        $conferenceFee = new ConferenceFee();
        $conferenceFee->conference_id = $data['conference_id'];
        $conferenceFee->conference_fee_title = $data['conference_fee_title'];
        $conferenceFee->conference_fee_price = $data['conference_fee_price'];
        $conferenceFee->conference_fee_date = $data['conference_fee_date'];
        $conferenceFee->conference_fee_content = $data['conference_fee_content'];
        $conferenceFee->conference_fee_desc = $data['conference_fee_desc'];
        $conferenceFee->save();
        return response()->json(array('message' => __('alert.blog.successfulNotification'), 'success' => true));
    }

    public function updateConferenceFee(Request $request)
    {
        // $this->checkPostAdd($request);
        $data = $request->all();
        $conferenceFee = ConferenceFee::find($data['conference_fee_id']);
        $conferenceFee->conference_fee_title = $data['conference_fee_title'];
        $conferenceFee->conference_fee_price = $data['conference_fee_price'];
        $conferenceFee->conference_fee_date = $data['conference_fee_date'];
        $conferenceFee->conference_fee_content = $data['conference_fee_content'];
        $conferenceFee->conference_fee_desc = $data['conference_fee_desc'];
        $conferenceFee->save();
        return response()->json(array('message' => __('alert.blog.successfulNotification'), 'success' => true));
    }

    public function deleteConferenceFee($conference_fee_id)
    {
        $conferenceFee = ConferenceFee::find($conference_fee_id);
        $conferenceFee->delete();
        return response()->json(array('message' => __('alert.blog.successfulNotification'), 'success' => true));
    }

    public function export_excel(Request $request)
    {
        switch ($request->export_type) {
            case ('vnrp'):
                return Excel::download(new ExcelExportVNReport($request->conference_id), 'ReportVN.xlsx');
                break;
            case ('enrp'):
                return Excel::download(new ExcelExportENReport($request->conference_id), 'ReportEN.xlsx');
                break;
            case ('vnrt'):
                return Excel::download(new ExcelExportVnRegister($request->conference_id), 'RegisterVN.xlsx');
                break;
            case ('enrt'):
                return Excel::download(new ExcelExportEnRegister($request->conference_id), 'RegisterEN.xlsx');
                break;
            default:
                return Redirect::back();
        }
    }

    //Validation
    
}
