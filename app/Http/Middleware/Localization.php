<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

class Localization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $locale = $request->segment(1);
        // dd($locale);
        
        if ($locale == 'en' || $locale == 'vn') {
            App::setLocale($locale);
            URL::defaults(['locale' => $request->segment(1)]);
            return $next($request);
        }else{
            App::setLocale('vn');
            URL::defaults(['locale' => $request->segment(1)]);
            return $next($request);
        }

        

        // $locale = $request->segment(1);
        // App::setLocale($locale);
        // URL::defaults(['locale' => $request->segment(1)]);
        // if ($locale == 'en') {
        //     $url= url()->full();
        //     $nurl = str_replace('/en','',$url);
        //     return Redirect::to($nurl);
        // }else{
        //     return $next($request);
        // }
    }
}
