<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Models\CustomerDetails;
use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\NatureOfCompany;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Facades\Password;

class DashboardController extends Controller
{
    public function index()
    {

        //________CUSTOMER PROFILE MODAL________//
        if (Auth::user()->role_id == 2) {
            $cdetails = CustomerDetails::where('customer_id', Auth::user()->id)->first();
            if($cdetails == null){
                Session::put('customer_incomplete', true);
            }
        }



        if(Auth::user()->role_id == 2){
            $applications = Application::orderBy('id', 'DESC')
                                        ->where('customer_id',Auth::user()->id)->take(10)->get();

            $pendingApplications = Application::where('customer_id',Auth::user()->id)
                                                ->where('application_status',0)->get();
            $sampleCollectRequests = Application::where('customer_id',Auth::user()->id)
                                                ->where('application_status',3)->get();
            $rejectedApplications = Application::where('customer_id',Auth::user()->id)
                                                ->where('application_status',2)->get();
            $certificated = Application::where('customer_id',Auth::user()->id)
                                                ->where('application_status',7)->get();
        }else{
            $applications = Application::orderBy('id', 'DESC')->take(10)->get();
            $pendingApplications = Application::where('application_status',0)->get();
            $sampleCollectRequests = Application::where('application_status',3)->get();
            $rejectedApplications = Application::where('application_status',2)->get();
            $certificated = Application::where('application_status',7)->get();
        }


        return view('backend.dashboard.index',compact('applications','pendingApplications','sampleCollectRequests','rejectedApplications','certificated'));
    }
}
