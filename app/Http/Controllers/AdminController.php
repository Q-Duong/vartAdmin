<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Order;
use App\Models\Statistic;
use Carbon\Carbon;
use App\Http\Requests;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
    public function formatDate($date){
		$format=explode("/",$date);
		$day = array_shift($format);
        $year = array_pop($format);
        $month = implode(" ", $format);
		$dateFormat= $year."-".$month."-".$day;
    	return $dateFormat;
    }
    public function show_dashboard(Request $request){
        $blog = Blog::all()->count();
        return view('admin.dashboard')->with(compact('blog'));
    }
    public function login(){
        if(Auth::check()){
            return Redirect::route('dashboard');
        }else{
            return view('admin_login');
        }
    }
    public function logout(){
        Auth::logout();
        return Redirect::to('login');
    }
    public function information(){
    	return view('admin.AdminInfomation.view_infomation');
    }

    public function settings(){
    	return view('admin.AdminInfomation.edit_infomation');
    }
    public function save_information(Request $request){
        $data=$request->all();
        $profile= Profile::find(Auth::user()->profile_id);
        $profile->profile_firstname=$data['profile_firstname'];
        $profile->profile_lastname=$data['profile_lastname'];
        $profile->profile_phone=$data['profile_phone'];
        $profile->profile_email=$data['profile_email'];
        $profile->profile_gender=$data['profile_gender'];
        $profile->day_of_birth=$data['day_of_birth'];
        $profile->save();
        if($data['admin_password']!=null){
            $user=User::find(Auth::id());
            $user->password=bcrypt($data['admin_password']);
            $user->save();
        }
        return Redirect::route('information')->with('success','Cập nhật thông tin thành công');
       
    }
}
