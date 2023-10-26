<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Application;
use Illuminate\Http\Request;
use App\Models\ApplicationStep;
use App\Models\CustomerDetails;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ApplicationNotification;

class SoController extends Controller
{
    public function soFirstProcess(Request $request)
    {
        DB::beginTransaction();

        try {
            $application = Application::findOrFail($request->application_id);

            ApplicationStep::create([
                'application_id' => $request->application_id,
                'created_by' => Auth::user()->id,
                'remark' => $request->remark,
                'step_name' => 5,
                'previous_step_name' => 4,
                'application_status' => 1
            ]);

            $application->update([
                'application_status' => 1
            ]);

            #NOTIFICATION FOR DIRECTOR START HERE
            $customer_details = CustomerDetails::where("customer_id", $application->customer_id)->orderBy("id","DESC")->first();
            $notificationData = [
                "title"         => "New Application Request",
                "description"   => "A new application of Applicant “".$customer_details->company_name ."” from SO “".Auth::user()->name."” received.",
                'route'         => route("application.process",$request->application_id),
            ];

            $notifiableUsers = User::where("role_id", 7)->get();
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


    public function soFirstReject(Request $request)
    {
        // dd($request->all());
        DB::beginTransaction();

        try {
            $application = Application::findOrFail($request->application_id);

            ApplicationStep::create([
                'application_id' => $request->application_id,
                'created_by' => Auth::user()->id,
                'remark' => $request->remark,
                'step_name' => 5,
                'previous_step_name' => 4,
                'application_status' => 2,
                'isRejected' => 1
            ]);

            $application->update([
                'remark' => $request->remark,
                'application_status' => 2,
                'isRejected' => 1
            ]);

            #NOTIFICATION FOR CUSTOMER START HERE
            $notificationData = [
                "title"         => "Application Rejected",
                "description"   => "Your application have been rejected. Please check Remarks for reason.",
                'route'         => route("application.index"),
            ];

            $notifiableUsers = User::where("id", $application->customer_id)->first();
            Notification::send($notifiableUsers, new ApplicationNotification($notificationData));
            #NOTIFICATION FOR CUSTOMER END HERE

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

    public function soFinalizedProcess(Request $request)
    {

        DB::beginTransaction();

        try {
            $application = Application::findOrFail($request->application_id);

            $application_step = ApplicationStep::where('application_id', $application->id)->where('step_name', 9)->orderBy('id', 'DESC')->first();

            if (!$application_step) {
                ApplicationStep::create([
                    'application_id'     => $request->application_id,
                    'created_by'         => Auth::user()->id,
                    'step_name'          => 9,
                    'previous_step_name' => 8,
                    'application_status' => 7,
                    'isFinalized'        => 1
                ]);
            } else {
                $application_step->update([
                    'step_name'          => 9,
                    'previous_step_name' => 8,
                    'application_status' => 7,
                    'isFinalized'        => 1
                ]);
            }


            $application->update([
                'issued_date'        => Carbon::now(),
                'completion_date'    => Carbon::now(),
                'application_status' => 7,
                'isFinalized'        => 1
            ]);

            #NOTIFICATION FOR CUSTOMER FINALIZED START HERE
            $notificationData = [
                "title"         => "Certificate is Ready",
                "description"   => "Your certificate is ready to download.",
                'route'         => route("certificate.view",$request->application_id),
            ];

            $notifiableUsers = User::where("id", $application->customer_id)->first();
            Notification::send($notifiableUsers, new ApplicationNotification($notificationData));
            #NOTIFICATION FOR CUSTOMER FINALIZED END HERE

            #send notification via mail
            $data = array(
                'name'  => $notifiableUsers->name,
                'title' => "e-Health Certificate is created!",
                'description' => "e-Health Certificate is created! ",
                'email' => $notifiableUsers->email
            );

            Mail::send('backend.mail.notification_mail', $data, function ($message) use ($data) {
                $message->from(env('MAIL_FROM_ADDRESS'), 'Bangladesh Food Safety Authority');
                $message->to($data['email']);
                $message->subject('Bangladesh Food Safety Authority Help Desk!');
            });

            DB::commit();

            notify()->success('Process Finalized Successfully', 'Success');
            return redirect()->back();
        } catch (\Throwable $th) {
            DB::rollback();
            Log::error($th->getMessage());
            notify()->error('Process Finalize Failed', 'Error');
            return back();
        }
    }


    public function soForwardUser(Request $request)
    {
        DB::beginTransaction();

        try {
            ApplicationStep::create([
                'application_id' => $request->application_id,
                'created_by' => Auth::user()->id,
                'forward_user_id' => $request->forward_user_id,
                'step_name' => 9,
                'previous_step_name' => 8,
            ]);


            #NOTIFICATION FOR FORWARD SO START HERE
            $application = Application::findOrFail($request->application_id);
            $customer_details = CustomerDetails::where("customer_id", $application->customer_id)->orderBy("id","DESC")->first();

            $notificationData = [
                "title"         => "New Forwarded Application",
                "description"   => "An application of Applicant “".$customer_details->company_name ."” have been Forwarded by “".Auth::user()->name."” received.",
                'route'         => route("application.process",$request->application_id),
            ];

            $notifiableUsers = User::where("id", $request->forward_user_id)->get();
            Notification::send($notifiableUsers, new ApplicationNotification($notificationData));
            #NOTIFICATION FOR FORWARD SO END HERE

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


    public function soFinalReject(Request $request)
    {
        DB::beginTransaction();

        try {
            $application = Application::findOrFail($request->application_id);
            $so2Process  = ApplicationStep::where('application_id', $application->id)->where('step_name', 9)->orderBy('id', 'DESC')->first();

            if (!$so2Process) {
                ApplicationStep::create([
                    'application_id' => $request->application_id,
                    'created_by' => Auth::user()->id,
                    'remark' => $request->remark,
                    'step_name' => 9,
                    'previous_step_name' => 8,
                    'application_status' => 2,
                    'isRejected' => 1
                ]);
            } else {
                $so2Process->update([
                    'remark' => $request->remark,
                    'step_name' => 9,
                    'previous_step_name' => 8,
                    'application_status' => 2,
                    'isRejected' => 1
                ]);
            }


            $application->update([
                'remark' => $request->remark,
                'application_status' => 2,
                'isRejected' => 1
            ]);

            #NOTIFICATION FOR CUSTOMER START HERE
            $notificationData = [
                "title"         => "Application Rejected",
                "description"   => "Your application have been rejected. Please check Remarks for reason.",
                'route'         => route("application.index"),
            ];

            $notifiableUsers = User::where("id", $application->customer_id)->first();
            Notification::send($notifiableUsers, new ApplicationNotification($notificationData));
            #NOTIFICATION FOR CUSTOMER END HERE

            DB::commit();

            notify()->success('Process Finalized Successfully', 'Success');
            return redirect()->back();
        } catch (\Throwable $th) {
            DB::rollback();
            Log::error($th->getMessage());
            notify()->error('Process Finalize Failed', 'Error');
            return back();
        }
    }
}
