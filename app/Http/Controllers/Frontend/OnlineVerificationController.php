<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Application;
use Illuminate\Http\Request;

class OnlineVerificationController extends Controller
{
    public function index()
    {
        return view('frontend.online_verification.index');
    }

    public function view(Request $request) {
        // dd($request->all());
        $application = Application::where('certificate_ref_no',$request->reference_no)->first();

        if($application){
            // dd($applicationId);
            $text = route('customer.certificate.view',$application->id);
            return view('frontend.online_verification.certificate', compact('application','text'));
        }else{
            return view('backend.certificate.error');
        }

    }
}
