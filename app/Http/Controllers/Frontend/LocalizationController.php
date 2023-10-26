<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class LocalizationController extends Controller
{
    public function langChange($langVal)
    {
        Session::put("locale",$langVal);
        return response()->json(['success'=>'Language change successfully.']);
    }
}
