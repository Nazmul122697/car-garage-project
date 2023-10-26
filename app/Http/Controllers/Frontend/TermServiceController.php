<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\TermService;
use Illuminate\Http\Request;

class TermServiceController extends Controller
{
    public function index()
    {
        $termService = TermService::first();
        return view('frontend.terms_service.index',compact('termService'));
    }
}
