<?php

namespace App\Http\Controllers\Backend;

use App\Models\Application;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ApplicationStep;
use App\Models\ChangeRequestFee;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Jorenvh\Share\Share;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class CertificateController extends Controller
{
    public function index()
    {
        Gate::authorize('certificate.index');

        $applications = Application::where('customer_id', auth()->user()->id)->where('isFinalized', 1)->get();
        return view('backend.certificate.index', compact('applications'));
    }



    public function view($applicationId)
    {
        Gate::authorize('certificate.view');
        return view('backend.certificate.view', compact('applicationId'));
    }

    public function certificate(Request $request)
    {

        $text = route('customer.certificate.view',$request->application_id);

        if(Auth::user()){
            if(Auth::user()->role_id == 2){
                $application = Application::where('id', $request->application_id)
                ->where('customer_id', auth()->user()->id)
                ->where('isFinalized', 1)->first();
            }else{
                $application = Application::where('id', $request->application_id)
                ->where('isFinalized', 1)->first();
            }

        }

        $application = Application::where('id', $request->application_id)
                        ->where('isFinalized', 1)->first();

        $applicationStep = ApplicationStep::where('application_id',$application->id)
                                                ->where('isFinalized',1)->first();
        return view('backend.certificate.certificate_view', compact('application','text','applicationStep'));
    }


    public function changeRequest(Request $request)
    {
        // dd($request->all());
        $application = Application::where('id', $request->application_id)
                                ->where('customer_id', auth()->user()->id)
                                ->where('isFinalized', 1)->first();
        $changeRequestFee = ChangeRequestFee::first();
        // dd($application);
        return view('backend.certificate.change_request', compact('application','changeRequestFee'));
    }

    public function certificateView($applicationId)
    {
        // dd($applicationId);
        return view('backend.certificate.unauthorize-view', compact('applicationId'));
    }


}
