<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\CategoryPost;
use App\Models\Customer;
use App\Models\Slider;
use App\Models\CarKTV;
use App\Models\Staff;
use Illuminate\Support\Facades\Http;

use DB;

class ZaloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getOrderId = CarKTV::orderBy('updated_at', 'DESC')->first();
        $carActive = CarKTV::orderBy('updated_at', 'DESC')->where('order_id',$getOrderId->order_id)->where('car_active',1)->get();

        // $response = Http
        // ::withHeaders([
        //     'Content-Type' => 'application/json',
        //     'access_token' => '9s0M45hDLWejOHSPLC9H1oze5nnItKX6U7HFCdgkR5823IuiOVapDMS61azC_WS3JpL2Mrd7H1z1CHjSUi0vFNLYVNnSe64RIcihI6B78J1k10LfO_a52KKB0rS--JPFAZC83YBU35OEBJ4y4z0xOHW0SI4Wxrn263fF1JF-JMCa4duv6VvXO1LTLZCYg61EALPM2LQdGsvVLqCoHRLIGq5zTI9xgN0yLcOpS5Ik119sSJDJQOqe2Nz10qqSZLmK2YD9MmdV3nii9Yvf9FiGDrun0sjovpOIHXGmJLhk62rkG0nFVujCEq8aS79wxpi-Kn4A9533Fq9BIKwRSYjTrLK2'
        // ])->post('https://business.openapi.zalo.me/message/template',
        // [
        //     'phone' => '84778821404',
        //     'template_id'=> '257154',
        //     'template_data' => [
        //         'order_code' => 'order_code211',
        //         'date'=> '01/08/2020',
        //         'price'=> 100000,
        //         'name'=> 'name333',
        //         'phone_number'=> '113',
        //         'status'=> 'activate'
        //     ],
        //     'tracking_id'=>'sadlkslfkdslkgldkgfdkjgfdjjjj'
        // ]);
    
        // $jsonData = $response->json();
       
        // foreach($order as $key => $staff){
        //     if($staff->car_active == 1){
        //         $name1[] = $staff->car_driver_name;
        //         $name2[] = $staff->car_ktv_name_1;
        //         $name3[] = $staff->car_ktv_name_2;
        //         //$car = Staff::where('staff_name', 'Liêu Thành Tâm')->get();
        //         // $car->order_id = $order->order_id;
        //         // $car->car_name = $request->car_name[$key];
        //         // $car->car_active = $request->car_active[$key];
        //         // $staff1[] = array(
        //         //     'car_driver_name' => $staff->car_driver_name,
        //         //     'car_driver_name1' => $staff->car_driver_name,    
        //         // );
        //     }
            // if($staff->car_active == 1){
            //     $staff2['car_ktv_name_1'] = $staff->car_ktv_name_1;
            // }
            // if($staff->car_active == 1){
            //     $staff3['car_ktv_name_2'] = $staff->car_ktv_name_2;
            // }
            // $staff2 = Staff::where('staff_name','=', $staff['car_ktv_name_2'])->get();
            // $staff3 = Staff::where('staff_name','=', $staff['car_driver_name'])->get();
        // }
        return $carActive;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
