<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    function showLoginForm(){
        if(Auth::check()){
            $adminRoles = ['admin', 'subAdmin'];
            if (in_array(Auth::user()->role, $adminRoles)) {
                return Redirect::route('dashboard.index');
            }else if(Auth::user()->role == "staffReport"){
                return Redirect::route('report_management.index');
            }else if(Auth::user()->role == "staffRegister"){
                return Redirect::route('register_management.index');
            }else if(Auth::user()->role == "staffInter"){
                return Redirect::route('report_management_en.index');
            }
        }else{
            return view('pages.login.index');
        }
    }
    function login(Request $request){
        $data=$request->all();
        if(Auth::attempt([
                'email' => $data['account_username'],
                'password' => $data['account_password']
            ],true)){
                // dd(1);
                $adminRoles = ['admin', 'subAdmin'];
                if (in_array(Auth::user()->role, $adminRoles)) {
                    return Redirect::route('dashboard.index');
                }else if(Auth::user()->role == "staffReport"){
                    return Redirect::route('report_management.index');
                }else if(Auth::user()->role == "staffRegister"){
                    return Redirect::route('register_management.index');
                }else if(Auth::user()->role == "staffInter"){
                    return Redirect::route('report_management_en.index');
                }
        }else{
            return Redirect::route('login')->with('error','Tài khoản hoặc mật khẩu không đúng');
        }
   }
}
