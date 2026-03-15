<?php

namespace App\Http\Controllers\Conference;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ValidateController;
use App\Models\Payment;
use App\Models\Province;
use App\Models\Register;
use App\Models\Countries;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Academic;
use App\Models\Conference;
use App\Models\TempFile;
use App\Models\Vip;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function __construct() {}
    //VN
    public function index()
    {
        $conferences = Conference::select('id', 'conference_title', 'conference_code')->where('multi_conferences', 0)->orderBy('id', 'DESC')->get();
        return view('pages.admin.conferenceRegister.register.vn.list', compact('conferences'));
    }

    public function indexNational($code)
    {
        $conference = Conference::select('id', 'conference_title', 'conference_code')->firstWhere('conference_code', $code);
        $getAllConferenceRegister = Register::getAllRegisterWithPaginate($conference->id, 'vn');
        $totalAmount = Register::getAllRegisterAmount($conference->id, false, 'vn');
        $totalTheory = Register::getAllRegisterByParamCode($conference->id, 'LT', false);
        $totalPractice = Register::getAllRegisterByParamCode($conference->id, 'TH', false);
        $totalCME = Register::getAllRegisterByParamCode($conference->id, 'CE', false);
        $totalMulti = Register::getAllRegisterByParamCode($conference->id, 'PL', false);
        $totalStatus = Register::getAllRegisterAmountStatus($conference->id, 'vn');

        //Filter
        $getAllRegister = Register::getAllRegister($conference->id, 'vn');

        $idFilter = $getAllRegister->pluck('id')->unique()->sort()->values();
        $codeFilter = $getAllRegister->pluck('register_code')->unique()->sort()->values();
        $nameFilter = $getAllRegister->pluck('member.member_full_name')->unique()->sort()->values();
        $emailFilter = $getAllRegister->pluck('member.member_email')->unique()->sort()->values();
        $phoneFilter = $getAllRegister->pluck('member.member_phone')->unique()->sort()->values();
        $paymentStatusFilter = $getAllRegister->pluck('payment.payment_status')->unique()->sort()->values();

        //Tối ưu hiệu năng hơn
        // $idFilter = Register::where('conference_id', $conference_id)->orderBy('id')->pluck('id')->unique();
        // $codeFilter = Register::where('conference_id', $conference_id)->orderBy('register_code')->pluck('register_code')->unique();

        // // Lấy thông tin từ bảng Member thông qua Join hoặc whereHas
        // $nameFilter = Member::whereHas('registers', function ($q) use ($conference_id) {
        //     $q->where('conference_id', $conference_id);
        // })->orderBy('member_full_name')->pluck('member_full_name')->unique();

        // // Lấy Title từ bảng Fees (Bảng Many-to-Many)
        // $conferenceFeeTitleFilter = ConferenceFee::whereHas('registers', function ($q) use ($conference_id) {
        //     $q->where('conference_id', $conference_id);
        // })->pluck('conference_fee_title')->unique();

        return view('pages.admin.conferenceRegister.register.vn.index', compact('getAllConferenceRegister', 'conference', 'totalAmount', 'totalTheory', 'totalPractice', 'totalCME', 'totalMulti', 'totalStatus', 'idFilter', 'codeFilter', 'nameFilter', 'emailFilter', 'phoneFilter', 'paymentStatusFilter'));
    }

    function str_replace_last($search, $replace, $subject)
    {
        $pos = strrpos($subject, $search);

        if ($pos !== false) {
            $subject = substr_replace($subject, $replace, $pos, strlen($search));
        }

        return $subject;
    }

    public function copy($code, $id)
    {
        $findRegister = Register::findOrFail($id);
        if (!$findRegister) {
            return redirect()->route('conference_register.index')->with('error', 'Record not found !!!.');
        }
        $payment = new Payment();
        $payment->conference_fee_id = $findRegister->payment->conference_fee_id;
        $payment->payment_price = $findRegister->payment->payment_price;
        $payment->payment_method = $findRegister->payment->payment_method;
        $payment->payment_status = 1;
        $payment->save();

        $newRegister = $findRegister->replicate();
        $newRegister->payment_id = $payment->id;
        $newRegister->save();
        $newRegister->register_code = $this->str_replace_last($id, $newRegister->id, $newRegister->register_code);
        $newRegister->save();
        return  redirect()->route('conference_register.index', $code)->with('success', 'Copied Register Successfully');
    }

    public function edit($code, $id)
    {
        $register = Register::with(['fees', 'payment', 'member'])
        ->firstWhere('id', $id);
        $getAllProvince = Province::orderByRaw("CONVERT(name USING utf8mb4) COLLATE utf8mb4_unicode_ci")->get();

        return view('pages.admin.conferenceRegister.register.vn.edit', compact('code', 'register', 'getAllProvince'));
    }

    public function update(Request $request, $code)
    {
        $validator = Validator::make($request->all(), app(ValidateController::class)->validateRegister('vn'), app(ValidateController::class)->messageRegister());
        if ($validator->fails()) {
            return response()->json(array('errors' => true, 'validator' => $validator->errors()));
        }
        DB::beginTransaction();
        try {

            $register = Register::firstWhere('id', $request->register_id);
            // $register->member->member_full_name = mb_strtoupper($request->member_full_name, 'UTF-8');
            // $register->member->member_gender = $request->member_gender;
            // $register->member->member_date = $request->member_date;
            // $register->member->member_month = $request->member_month;
            // $register->member->member_year = $request->member_year;
            $register->member->member_work_unit = $request->member_work_unit;
            // $register->member->member_graduation_year = $request->member_graduation_year;
            $register->member->member_email = $request->member_email;
            // $register->member->member_phone = $request->member_phone;
            $register->member->save();

            $register->payment->payment_status = $request->payment_status;
            if (!empty($request->payment_image)) {
                $register->payment->payment_image = $request->payment_image;
                $tempFile = TempFile::firstWhere('folder', $request->payment_image);
                !empty($tempFile) ? $tempFile->delete() : '';
            }
            $register->payment->save();

            DB::commit();
            return response()->json(array('success' => true, 'message' => __('alert.conference.successMessage_update'), 'route' => route('conference_register.index', $code)));
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(array('success' => false, 'message' => __('alert.conference.errorMessage_update'), 'route' => route('conference_register.index', $code)));
        }
    }

    public function destroy($id)
    {
        $register = Register::findOrFail($id);
        $payment = Payment::findOrFail($register->payment_id);
        // if ($register->register_image) {
        //     deleteImageFileDrive($register->register_image);
        // }
        // if ($register->register_image_card) {
        //     deleteImageFileDrive($register->register_image_card);
        // }
        if ($payment->payment_image) {
            deleteImageFileDrive($payment->payment_image);
        }
        $payment->delete();
        return Redirect()->back()->with('success',  __('alert.conference.successMessage_delete'));
    }

    public function filter(Request $request)
    {
        $searchData = array_slice($request->all(), 2);
        $conference = Conference::select('id', 'conference_title', 'conference_code')->firstWhere('id', $request->conference_id);

        if (array_filter($searchData)) {
            $getAllRegisterFilter = Register::getRegisterQueryBuilderBySearchData($searchData, $request->conference_id, 'vn');
            $flagEmpty = false;
        } else {
            $getAllRegisterFilter = Register::getAllRegisterWithCurrentPage($request->conference_id, $request->current_page, 'vn');
            $flagEmpty = true;
        }

        $html = view('pages.admin.conferenceRegister.register.vn.filter.index')->with(compact('getAllRegisterFilter', 'conference'))->render();
        return response()->json(array('html' => $html, 'flagEmpty' => $flagEmpty));
    }
    //EN
    public function indexEn()
    {
        $conferences = Conference::select('id', 'conference_title_en', 'conference_code')->orderBy('id', 'DESC')->get();
        return view('pages.admin.conferenceRegister.register.en.list', compact('conferences'));
    }

    public function indexInternational($code)
    {
        $conference = Conference::select('id', 'conference_title_en', 'conference_code')->firstWhere('conference_code', $code);
        $getAllConferenceRegister = Register::getAllRegisterWithPaginate($conference->id, 'en');
        return view('pages.admin.conferenceRegister.register.en.index', compact('getAllConferenceRegister', 'conference'));
    }

    public function editInternational($code, $id)
    {
        $register = Register::with(['fees', 'payment', 'member'])
        ->firstWhere('id', $id);
        $getAllCountries = Countries::all();
        return view('pages.admin.conferenceRegister.register.en.edit', compact('code', 'register', 'getAllCountries'));
    }

    public function updateInternational(Request $request, $code)
    {
        $validator = Validator::make($request->all(), app(ValidateController::class)->validateRegister('en'), app(ValidateController::class)->messageRegister());
        if ($validator->fails()) {
            return response()->json(array('errors' => true, 'validator' => $validator->errors()));
        }
        DB::beginTransaction();
        try {
            $register = Register::firstWhere('id', $request->register_id);
            // $register->member->member_full_name = mb_strtoupper($request->member_full_name, 'UTF-8');
            // $register->member->member_gender = $request->member_gender;
            // $register->member->member_date = $request->member_date;
            // $register->member->member_month = $request->member_month;
            // $register->member->member_year = $request->member_year;
            $register->member->member_work_unit = $request->member_work_unit;
            // $register->member->member_graduation_year = $request->member_graduation_year;
            $register->member->member_email = $request->member_email;
            // $register->member->member_phone = $request->member_phone;
            $register->member->save();

            $register->payment->payment_status = $request->payment_status;
            $register->payment->save();

            DB::commit();
            return response()->json(array('success' => true, 'message' => __('alert.conference.successMessage_update'), 'route' => route('conference_en_register.index', $code)));
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(array('success' => false, 'message' => __('alert.conference.errorMessage_update'), 'route' => route('conference_en_register.index', $code)));
        }
    }

    public function destroyInternational($id)
    {
        $register = Register::findOrFail($id);
        $payment = Payment::findOrFail($register->payment_id);
        $payment->delete();
        return Redirect()->back()->with('success',  __('alert.conference.successMessage_delete'));
    }
    //VIP
    // public function indexV()
    // {
    //     $conferences = Conference::select('id', 'conference_title', 'conference_code')->orderBy('id', 'DESC')->get();
    //     return view('pages.admin.conferenceRegister.register.vip.list', compact('conferences'));
    // }

    // public function indexVip($code)
    // {
    //     $conference = Conference::select('id', 'conference_title', 'conference_code')->firstWhere('conference_code', $code);
    //     $getAllConferenceRegisterVip = Vip::where('conference_id', $conference->id)
    //         ->orderBy('id', 'DESC')
    //         ->paginate(10);
    //     return view('pages.admin.conferenceRegister.register.vip.index', compact('getAllConferenceRegisterVip', 'conference'));
    // }

    // public function editVip($code, $id)
    // {
    //     $register = Register::join('payments', 'payments.id', '=', 'registers.payment_id')
    //         ->join('conference_fees', 'payments.conference_fee_id', '=', 'conference_fees.id')
    //         ->select(
    //             'registers.conference_id',
    //             'payment_id',
    //             'registers.id',
    //             'register_code',
    //             'register_degree',
    //             'register_name',
    //             'register_gender',
    //             'register_date',
    //             'register_month',
    //             'register_year',
    //             'register_work_unit',
    //             'register_place_of_birth',
    //             'register_nation',
    //             'register_email',
    //             'register_phone',
    //             'register_object_group',
    //             'conference_fee_title',
    //             'payment_price',
    //             'register_receiving_address',
    //             'registers.created_at',
    //             'register_graduation_year',
    //             'register_image',
    //             'register_image_card',
    //             'payment_image',
    //             'payment_status'
    //         )->firstWhere('registers.id', $id);
    //     $getAllAcademic = Academic::orderBy('id', 'asc')->get();
    //     $getAllProvince = Province::orderby('sort', 'ASC')->orderByRaw("CONVERT(province_name USING utf8mb4) COLLATE utf8mb4_unicode_ci")->get();
    //     return view('pages.admin.conferenceRegister.register.vn.edit', compact('code', 'register', 'getAllAcademic', 'getAllProvince'));
    // }

    // public function updateVip(Request $request, $code)
    // {
    //     $validator = Validator::make($request->all(), app(ValidateController::class)->validateRegister('vn'), app(ValidateController::class)->messageRegister());
    //     if ($validator->fails()) {
    //         return response()->json(array('errors' => true, 'validator' => $validator->errors()));
    //     }
    //     DB::beginTransaction();
    //     try {
    //         $register = Register::findOrFail($request->register_id);
    //         $register->register_name = mb_strtoupper($request->register_name, 'UTF-8');
    //         $register->register_gender = $request->register_gender;
    //         $register->register_date = $request->register_date;
    //         $register->register_month = $request->register_month;
    //         $register->register_year = $request->register_year;
    //         $register->register_place_of_birth = $request->register_place_of_birth;
    //         $register->register_nation = $request->register_nation;
    //         $register->register_object_group = $request->register_object_group;
    //         $register->register_work_unit = $request->register_work_unit;
    //         $register->register_email = $request->register_email;
    //         $register->register_phone = $request->register_phone;
    //         $register->register_graduation_year = $request->register_graduation_year;
    //         if (!empty($request->register_image)) {
    //             $register->register_image = $request->register_image;
    //             $tempFile = TempFile::firstWhere('folder', $request->register_image);
    //             $tempFile->delete();
    //         }
    //         if (!empty($request->register_image_card)) {
    //             $register->register_image_card = $request->register_image_card;
    //             $tempFile = TempFile::firstWhere('folder', $request->register_image_card);
    //             $tempFile->delete();
    //         }
    //         $register->save();
    //         $payment = Payment::findOrFail($register->payment_id);
    //         $payment->payment_status = $request->payment_status;
    //         if (!empty($request->payment_image)) {
    //             $payment->payment_image = $request->payment_image;
    //             $tempFile = TempFile::firstWhere('folder', $request->payment_image);
    //             $tempFile->delete();
    //         }
    //         $payment->save();
    //         DB::commit();
    //         return response()->json(array('success' => true, 'message' => __('alert.conference.successMessage_update'), 'route' => route('conference_register.index', $code)));
    //     } catch (\Exception $e) {
    //         DB::rollback();
    //         return response()->json(array('success' => false, 'message' => __('alert.conference.errorMessage_update'), 'route' => route('conference_register.index', $code)));
    //     }
    // }

    // public function destroyVip($id)
    // {
    //     $register = Register::findOrFail($id);
    //     return Redirect()->back()->with('success',  __('alert.conference.successMessage_delete'));
    // }
}
