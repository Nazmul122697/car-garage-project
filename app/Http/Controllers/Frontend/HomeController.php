<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Counter;
use App\Models\Slider;
use App\Models\Website;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $blogs = Blog::orderBy('id','desc')->get()->take(3);
        $sliders = Slider::where('status', 1)->orderBy('id','desc')->get();

        return view('frontend.home.index',compact('blogs', 'sliders'));
    }
}
