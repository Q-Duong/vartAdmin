<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Requests;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class ProfileController extends Controller
{
    public function formatDate($date){
		$format=explode("/",$date);
		$day = array_shift($format);
        $year = array_pop($format);
        $month = implode(" ", $format);
		$dateFormat= $year."-".$month."-".$day;
    	return $dateFormat;
    }
    public function profile(){
    	return view('pages.setting.index');
    }

    public function settings(){
    	return view('pages.setting.account');
    }
    public function update(Request $request){
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
        return Redirect::route('user.profile')->with('success','Cập nhật thông tin thành công');
       
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
