<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

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
        return view('pages.admin.dashboard')->with(compact('blog'));
    }
    public function login(){
        if(Auth::check()){
            return Redirect::route('dashboard.index');
        }else{
            return view('pages.login.index');
        }
    }
    public function logout(){
        Auth::logout();
        return Redirect::to('login');
    }
    public function information(){
    	return view('pages.setting.infomation.view');
    }

    public function settings(){
    	return view('pages.setting.infomation.edit');
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

    public function per(){
        // Role::create(['name'=>'writer']);
        // $permission = Permission::create(['name'=>'view report']);
        // $role = Role::findById(1);
        // $permission = Permission::findById(1);
        // $role->givePermissionTo($permission);
        // $role->revokePermissionTo($permission);

        return auth()->user()->permissions;
        return Redirect::route('dashboard');
    }
}
