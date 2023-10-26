<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use App\Models\Application;
use Illuminate\Http\Request;
use App\Models\ApplicationStep;
use App\Models\CustomerDetails;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ApplicationNotification;

class MemberController extends Controller
{
    public function memberFirstProcess(Request $request)
    {
        DB::beginTransaction();

        try {
            $application = Application::findOrFail($request->application_id);

            ApplicationStep::create([
                'application_id' => $request->application_id,
                'created_by' => Auth::user()->id,
                'remark' => $request->remark,
                'step_name' => 7,
                'previous_step_name' => 6,
                'application_status' => 1
            ]);

            $application->update([
                'application_status' => 1
            ]);

            #NOTIFICATION FOR DIRECTOR START HERE
            $customer_details = CustomerDetails::where("customer_id", $application->customer_id)->orderBy("id","DESC")->first();
            $director_process = ApplicationStep::where('application_id', $application->id)->where('step_name', 6)->orderBy('id', 'DESC')->first();

            $notificationData = [
                "title"         => "Verification from Member",
                "description"   => "Application of Applicant “".$customer_details->company_name ."” is verified by Member “".Auth::user()->name."” received.",
                'route'         => route("application.process",$request->application_id),
            ];

            $notifiableUsers = User::where("id", $director_process->created_by)->get();
            Notification::send($notifiableUsers, new ApplicationNotification($notificationData));
            #NOTIFICATION FOR DIRECTOR END HERE

            DB::commit();

            notify()->success('Process Submitted Successfully', 'Success');
            return redirect()->back();
        } catch (\Throwable $th) {
            DB::rollback();
            Log::error($th->getMessage());
            notify()->error('Process Submit Failed', 'Error');
            return back();
        }
    }

    public function processSkip(Request $request)
    {
        DB::beginTransaction();

        try {
            $application = Application::findOrFail($request->application_id);
            $director_process = ApplicationStep::where('application_id', $application->id)->where('step_name', 6)->orderBy('id', 'DESC')->first();

            ApplicationStep::create([
                'application_id' => $request->application_id,
                'created_by' => Auth::user()->id,
                'step_name' => 7,
                'previous_step_name' => 6,
                'application_status' => 1,
                'isSkipped' => 1
            ]);

            $application->update([
                'application_status' => 1
            ]);

            #NOTIFICATION FOR DIRECTOR START HERE
            $customer_details = CustomerDetails::where("customer_id", $application->customer_id)->orderBy("id","DESC")->first();

            $notificationData = [
                "title"         => "Step Skipped",
                "description"   => "Member “".Auth::user()->name."” have skipped a step of the application of Applicant “".$customer_details->company_name ."”",
                'route'         => route("application.process",$request->application_id),
            ];

            $notifiableUsers = User::where("id", $director_process->created_by)->get();
            Notification::send($notifiableUsers, new ApplicationNotification($notificationData));
            #NOTIFICATION FOR DIRECTOR END HERE

            DB::commit();

            notify()->success('Process Skipped Successfully', 'Success');
            return redirect()->back();
        } catch (\Throwable $th) {
            DB::rollback();
            Log::error($th->getMessage());
            notify()->error('Process Skip Failed', 'Error');
            return back();
        }
    }
}
