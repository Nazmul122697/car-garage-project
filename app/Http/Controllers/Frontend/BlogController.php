<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::orderBy('id','desc')->get();
        return view('frontend.blog.index',compact('blogs'));
    }

    public function singleBlog($slug)
    {
        $blog = Blog::where('slug',$slug)->first();
        return view('frontend.blog.single',compact('blog'));
    }
}
