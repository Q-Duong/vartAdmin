<?php

namespace App\Http\Controllers;

use App\Models\Conference;
use App\Models\Slider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $getConferenceVart = Conference::where('conference_type_id', 1)->orderBy('conference_id', 'DESC')->first();
        return view('pages.home')->with(compact('getConferenceVart'));
    }

    public function notification()
    {
        return view('pages.notification');
    }


    //Admin
    public function edit()
    {
        return view('admin.HomePage.edit')->with(compact('getAllSlider'));
    }
    public function save()
    {
        $getAllSlider = Slider::orderBy('slider_id', 'ASC')->select(['slider_image',])->get();
        return view('pages.home')->with(compact('getAllSlider'));
    }
    public function update()
    {
        $getAllSlider = Slider::orderBy('slider_id', 'ASC')->select(['slider_image',])->get();
        return view('pages.home')->with(compact('getAllSlider'));
    }

    public function vart()
    {
        return view('pages.test');
    }
    public function hart()
    {
        return view('pages.test');
    }
    public function lesson()
    {
        return view('pages.test');
    }
    public function forum()
    {
        return view('pages.test');
    }
    public function conference()
    {
        return view('pages.test1');
    }
    public function albums()
    {
        return view('pages.test');
    }
}
