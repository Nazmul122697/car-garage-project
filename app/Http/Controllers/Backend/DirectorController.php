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

class DirectorController extends Controller
{
    public function directorFirstProcess(Request $request)
    {
        DB::beginTransaction();

        try {
            $application = Application::findOrFail($request->application_id);

            ApplicationStep::create([
                'application_id' => $request->application_id,
                'created_by' => Auth::user()->id,
                'remark' => $request->remark,
                'step_name' => 6,
                'previous_step_name' => 5,
                'application_status' => 1
            ]);

            $application->update([
                'application_status' => 1
            ]);

            #NOTIFICATION FOR MEMBER START HERE
            $customer_details = CustomerDetails::where("customer_id", $application->customer_id)->orderBy("id","DESC")->first();
            $notificationData = [
                "title"         => "New Application Request",
                "description"   => "A new application of Applicant “".$customer_details->company_name ."” from Director “".Auth::user()->name."” received.",
                'route'         => route("application.process",$request->application_id),
            ];

            $notifiableUsers = User::where("role_id", 8)->get();
            Notification::send($notifiableUsers, new ApplicationNotification($notificationData));
            #NOTIFICATION FOR MEMBER END HERE

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

    public function directorSecondProcess(Request $request)
    {
        DB::beginTransaction();

        try {
            $application = Application::findOrFail($request->application_id);

            $application_step = ApplicationStep::where('application_id', $application->id)->where('step_name', 8)->orderBy('id', 'DESC')->first();

            if (!$application_step) {
                ApplicationStep::create([
                    'application_id' => $request->application_id,
                    'created_by' => Auth::user()->id,
                    'remark' => $request->remark,
                    'step_name' => 8,
                    'previous_step_name' => 7,
                    'application_status' => 1
                ]);
            } else {
                $application_step->update([
                    'remark' => $request->remark,
                    'step_name' => 8,
                    'previous_step_name' => 7,
                    'application_status' => 1
                ]);
            }

            $application->update([
                'application_status' => 1
            ]);


            #NOTIFICATION FOR SO START HERE
            $customer_details = CustomerDetails::where("customer_id", $application->customer_id)->orderBy("id","DESC")->first();
            $so_process       = ApplicationStep::where('application_id', $application->id)->where('step_name', 5)->orderBy('id', 'DESC')->first();

            $notificationData = [
                "title"         => "Verification from Director",
                "description"   => "Application of Applicant “".$customer_details->company_name ."” is verified by Director “".Auth::user()->name."” received.",
                'route'         => route("application.process",$request->application_id),
            ];

            $notifiableUsers = User::where("id", $so_process->created_by)->get();
            Notification::send($notifiableUsers, new ApplicationNotification($notificationData));
            #NOTIFICATION FOR SO END HERE

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

    public function directorForwardUser(Request $request)
    {
        DB::beginTransaction();

        try {
            $application = Application::findOrFail($request->application_id);

            ApplicationStep::create([
                'application_id' => $request->application_id,
                'created_by' => Auth::user()->id,
                'forward_user_id' => $request->forward_user_id,
                'step_name' => 8,
                'previous_step_name' => 7
            ]);


            #NOTIFICATION FOR FORWARD DIRECTOR START HERE
            $customer_details = CustomerDetails::where("customer_id", $application->customer_id)->orderBy("id","DESC")->first();

            $notificationData = [
                "title"         => "New Forwarded Application",
                "description"   => "An application of Applicant “".$customer_details->company_name ."” have been Forwarded by “".Auth::user()->name."” received.",
                'route'         => route("application.process",$request->application_id),
            ];

            $notifiableUsers = User::where("id", $request->forward_user_id)->get();
            Notification::send($notifiableUsers, new ApplicationNotification($notificationData));
            #NOTIFICATION FOR FORWARD DIRECTOR END HERE

            DB::commit();

            notify()->success('User Forward Successfully', 'Success');
            return redirect()->back();
        } catch (\Throwable $th) {
            DB::rollback();
            Log::error($th->getMessage());
            notify()->error('User Forward Failed', 'Error');
            return back();
        }
    }

    public function processSkip(Request $request)
    {
        DB::beginTransaction();

        try {
            $application = Application::findOrFail($request->application_id);
            $directorProcess  = ApplicationStep::where('application_id', $application->id)->where('step_name', 8)->orderBy('id', 'DESC')->first();

            if (!$directorProcess) {
                ApplicationStep::create([
                    'application_id' => $request->application_id,
                    'created_by' => Auth::user()->id,
                    'step_name' => 8,
                    'previous_step_name' => 7,
                    'application_status' => 1,
                    'isSkipped' => 1
                ]);
            } else {
                $directorProcess->update([
                    'step_name' => 8,
                    'previous_step_name' => 7,
                    'application_status' => 1,
                    'isSkipped' => 1
                ]);
            }


            $application->update([
                'application_status' => 1
            ]);


            #NOTIFICATION FOR SO START HERE
            $customer_details = CustomerDetails::where("customer_id", $application->customer_id)->orderBy("id","DESC")->first();
            $so_process       = ApplicationStep::where('application_id', $application->id)->where('step_name', 5)->orderBy('id', 'DESC')->first();

            $notificationData = [
                "title"         => "Step Skipped",
                "description"   => "Director “".Auth::user()->name."” have skipped a step of the application of Applicant “".$customer_details->company_name ."”.",
                'route'         => route("application.process",$request->application_id),
            ];

            $notifiableUsers = User::where("id", $so_process->created_by)->get();
            Notification::send($notifiableUsers, new ApplicationNotification($notificationData));
            #NOTIFICATION FOR SO END HERE

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
