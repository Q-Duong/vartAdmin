<?php

namespace App\Http\Controllers\Conference;

use App\Http\Controllers\Controller;
use App\Models\ConferenceFee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConferenceFeeController extends Controller
{
    public function __construct()
    {
    }

    public function index(Request $request)
    {
        $getAllConferenceFee = ConferenceFee::where('conference_id', $request->host_id)->get();
        $html = view('pages.admin.conference.fee.index', compact('getAllConferenceFee'))->render();
        return response()->json(array('success' => true, 'html' => $html));
    }

    public function storeOrUpdate(Request $request)
    {
        DB::beginTransaction();
        try {
            if ($request->type == 'create') {
                $conferenceFee = new ConferenceFee();
                $conferenceFee->conference_id = $request->conference_id;
                $conferenceFee->conference_fee_type = $request->conference_fee_type;
                $conferenceFee->conference_fee_code = $request->conference_fee_code;
                $conferenceFee->conference_fee_title = $request->conference_fee_title;
                $conferenceFee->mail_type = $request->mail_type;
                $conferenceFee->conference_fee_price = $request->conference_fee_price;
                $conferenceFee->conference_fee_date = $request->conference_fee_date;
                $conferenceFee->conference_fee_content = $request->conference_fee_content;
                $conferenceFee->conference_fee_desc = $request->conference_fee_desc;
                $conferenceFee->save();
            } else {
                $conferenceFee = ConferenceFee::find($request->conference_fee_id);
                $conferenceFee->conference_fee_type = $request->conference_fee_type;
                $conferenceFee->conference_fee_code = $request->conference_fee_code;
                $conferenceFee->conference_fee_title = $request->conference_fee_title;
                $conferenceFee->mail_type = $request->mail_type;
                $conferenceFee->conference_fee_price = $request->conference_fee_price;
                $conferenceFee->conference_fee_date = $request->conference_fee_date;
                $conferenceFee->conference_fee_content = $request->conference_fee_content;
                $conferenceFee->conference_fee_desc = $request->conference_fee_desc;
                $conferenceFee->save();
            }
            DB::commit();

            return response()->json(array('success' => true, 'message' => 'Successfully created'));
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(array('success' => false, 'route' => '500'));
        }
    }

    public function destroy(Request $request)
    {
        DB::beginTransaction();
        try {
            $conferenceFee = ConferenceFee::find($request->id);
            $conferenceFee->delete();
            
            DB::commit();
            return response()->json(array('message' => __('alert.blog.successfulNotification'), 'success' => true));
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(array('success' => false, 'route' => '500'));
        }
    }
}
