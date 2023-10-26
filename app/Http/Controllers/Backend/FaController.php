<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use App\Models\Application;
use Illuminate\Http\Request;
use App\Models\ApplicationStep;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\CustomerDetails;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ApplicationNotification;

class FaController extends Controller
{
    public function faFirstProcess(Request $request)
    {
        DB::beginTransaction();

        try {
            $application = Application::findOrFail($request->application_id);

            // if ($request->hasFile('doc_file')) {
            //     $file = $request->file('doc_file');
            //     $filename = 'FADOC_' . time() . '.' . $file->getClientOriginalExtension();
            //     $file->move(public_path('upload/process'), $filename);
            // }

            $docs = [];

            if ($request->hasFile('doc_file')) {
                foreach ($request->file('doc_file') as $key => $docF) {
                    $filename = 'FADOC_'. time(). $key . '.' . $docF->getClientOriginalExtension();
                    $docF->move(public_path('upload/process'), $filename);
                    array_push($docs,$filename);
                }

                $all_docs = json_encode($docs);
            }

            // return $all_docs;

            ApplicationStep::create([
                'application_id' => $request->application_id,
                'created_by' => Auth::user()->id,
                'assign_user_id' => $request->assign_user,
                'lab_user_id' => $request->lab_user,
                'assign_date' => date('Y-m-d', strtotime($request->assign_date)),
                'remark' => $request->remark,
                'doc_file' => isset($all_docs) ? $all_docs : null,
                'step_name' => 1,
                'previous_step_name' => null,
                'application_status' => 1
            ]);

            $application->update([
                'application_status' => 1,
                'report_issued_by'   => $request->lab_user
            ]);


            #NOTIFICATION FOR CUSTOMER START HERE
            $notificationData = [
                "title"         => "Sample Collection Requested",
                "description"   => "The Regional Food Safety Officer will contact you shortly for sample collection.",
                'route'         => route("application.index"),
            ];

            $notifiableUsers = User::where("id", $application->customer_id)->first();
            Notification::send($notifiableUsers, new ApplicationNotification($notificationData));
            #NOTIFICATION FOR CUSTOMER END HERE


            #NOTIFICATION FOR FSO START HERE
            $customer_details = CustomerDetails::where("customer_id", $application->customer_id)->orderBy("id","DESC")->first();
            $notificationData = [
                "title"         => "New Application Request",
                "description"   => "A new application of Applicant “".$customer_details->company_name ."” from FA “".Auth::user()->name."” received.",
                'route'         => route("application.process",$request->application_id),
            ];

            $notifiableUsers = User::where("id", $request->assign_user)->first();
            Notification::send($notifiableUsers, new ApplicationNotification($notificationData));
            #NOTIFICATION FOR FSO END HERE

            $data = array(
                'name'  => $notifiableUsers->name,
                'title' => "New Application Request!",
                'description' => "You have a new application request",
                'email' => $notifiableUsers->email
            );

            Mail::send('backend.mail.notification_mail', $data, function ($message) use ($data) {
                $message->from(env('MAIL_FROM_ADDRESS'), 'Bangladesh Food Safety Authority');
                $message->to($data['email']);
                $message->subject('Bangladesh Food Safety Authority Help Desk!');
            });

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

    public function onholdProcess(Request $request)
    {
        try {
            $application = Application::findOrFail($request->application_id);
            $application->update([
                'application_status' => 6,
                'onhold_by' => Auth::id(),
                'remark' => $request->remark
            ]);

            #NOTIFICATION FOR CUSTOMER START HERE
            $notificationData = [
                "title"         => "Application Correction Needed",
                "description"   => "You have received a correction application. Please view remark and change accordingly.",
                'route'         => route("application.process",$request->application_id),
            ];

            $notifiableUsers = User::where("id", $application->customer_id)->get();
            Notification::send($notifiableUsers, new ApplicationNotification($notificationData));
            #NOTIFICATION FOR CUSTOMER END HERE

            notify()->success('Application On Hold Successfully', 'Success');
            return redirect()->back();
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            notify()->error('Application On Hold Failed', 'Error');
            return back();
        }
    }

    public function faSecondProcess(Request $request)
    {
        DB::beginTransaction();

        try {
            $application = Application::findOrFail($request->application_id);

            $application_step = ApplicationStep::where('application_id', $application->id)->where('step_name', 4)->orderBy('id', 'DESC')->first();

            $docs = [];

            if ($request->hasFile('doc_file')) {
                foreach ($request->file('doc_file') as $key => $docF) {
                    $filename = 'FADOC2_'. time(). $key . '.' . $docF->getClientOriginalExtension();
                    $docF->move(public_path('upload/process'), $filename);
                    array_push($docs,$filename);
                }

                $all_docs = json_encode($docs);
            }

            if (!$application_step) {
                // if ($request->hasFile('doc_file')) {
                //     $file = $request->file('doc_file');
                //     $filename = 'FADOC2_' . time() . '.' . $file->getClientOriginalExtension();
                //     $file->move(public_path('upload/process'), $filename);
                // }

                ApplicationStep::create([
                    'application_id' => $request->application_id,
                    'created_by' => Auth::user()->id,
                    'remark' => $request->remark,
                    'doc_file' => isset($all_docs) ? $all_docs : null,
                    'step_name' => 4,
                    'previous_step_name' => 3,
                    'application_status' => 1,
                    'isResampling' => 0
                ]);
            } else {

                // if ($request->hasFile('doc_file')) {
                //     $file = $request->file('doc_file');
                //     @unlink(public_path('upload/process/' . $application_step->doc_file));
                //     $filename = 'LABDOC_' . time() . '.' . $file->getClientOriginalExtension();
                //     $file->move(public_path('upload/process'), $filename);
                // }

                $application_step->update([
                    'remark' => $request->remark,
                    'doc_file' => isset($all_docs) ? $all_docs : null,
                    'step_name' => 4,
                    'previous_step_name' => 3,
                    'application_status' => 1,
                    'isResampling' => 0
                ]);
            }

            $application->update([
                'application_status' => 1
            ]);


            #NOTIFICATION FOR SO START HERE
            $customer_details = CustomerDetails::where("customer_id", $application->customer_id)->orderBy("id","DESC")->first();
            $notificationData = [
                "title"         => "New Application Request",
                "description"   => "A new application of Applicant “".$customer_details->company_name ."” from FA “".Auth::user()->name."” received.",
                'route'         => route("application.process",$request->application_id),
            ];

            $notifiableUsers = User::where("role_id", 6)->get();
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


    public function faForwardUser(Request $request)
    {

        DB::beginTransaction();

        try {
            $application = Application::findOrFail($request->application_id);

            ApplicationStep::create([
                'application_id' => $request->application_id,
                'created_by' => Auth::user()->id,
                'forward_user_id' => $request->forward_user_id,
                'step_name' => 4,
                'previous_step_name' => 3
            ]);

            #NOTIFICATION FOR FA FORWARD START HERE
            $customer_details = CustomerDetails::where("customer_id", $application->customer_id)->orderBy("id","DESC")->first();
            $notificationData = [
                "title"         => "New Forwarded Application",
                "description"   => "An application of Applicant “".$customer_details->company_name ."” have been Forwarded by “".Auth::user()->name."”.",
                'route'         => route("application.process",$request->application_id),
            ];

            $notifiableUsers = User::where("id", $request->forward_user_id)->first();
            Notification::send($notifiableUsers, new ApplicationNotification($notificationData));
            #NOTIFICATION FOR FA FORWARD END HERE

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

    public function faSecondReject(Request $request)
    {
        DB::beginTransaction();

        try {
            $application = Application::findOrFail($request->application_id);

            ApplicationStep::create([
                'application_id' => $request->application_id,
                'created_by' => Auth::user()->id,
                'remark' => $request->remark,
                'step_name' => 4,
                'previous_step_name' => 3,
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

            notify()->success('Application Rejected Successfully', 'Success');
            return redirect()->back();
        } catch (\Throwable $th) {
            DB::rollback();
            Log::error($th->getMessage());
            notify()->error('Application Rejecte Failed', 'Error');
            return back();
        }
    }

    public function faResampling(Request $request)
    {

        // dd($request->all());

        DB::beginTransaction();

        try {
            $application = Application::findOrFail($request->application_id);
            $first_application_step  = ApplicationStep::where('application_id', $application->id)->where('step_name', 1)->orderBy('id', 'DESC')->first();
            $second_application_step = ApplicationStep::where('application_id', $application->id)->where('step_name', 4)->orderBy('id', 'DESC')->first();

            $docs = [];

            if ($request->hasFile('doc_file')) {
                foreach ($request->file('doc_file') as $key => $docF) {
                    $filename = 'FADOC2_'. time(). $key . '.' . $docF->getClientOriginalExtension();
                    $docF->move(public_path('upload/process'), $filename);
                    array_push($docs,$filename);
                }

                $all_docs = json_encode($docs);
            }


            if (!$second_application_step) {
                ApplicationStep::create([
                    'application_id' => $request->application_id,
                    'created_by' => Auth::user()->id,
                    'remark' => $request->remark,
                    'doc_file' => isset($all_docs) ? $all_docs : null,
                    'step_name' => 4,
                    'previous_step_name' => 3,
                    'application_status' => 5,
                    'isResampling' => 1
                ]);
            } else {
                $second_application_step->update([
                    'remark' => $request->remark,
                    'doc_file' => isset($all_docs) ? $all_docs : null,
                    'step_name' => 4,
                    'previous_step_name' => 3,
                    'application_status' => 5,
                    'isResampling' => 1
                ]);
            }


            $first_application_step->update([   // change FSO isResampling status
                'assign_user_id' => $request->assign_user,
                'assign_date' => date('Y-m-d', strtotime($request->assign_date)),
                'isResampling' => 1
            ]);

            $application->update([
                'application_status' => 5
            ]);

            #NOTIFICATION FOR FSO FORWARD START HERE
            $customer_details = CustomerDetails::where("customer_id", $application->customer_id)->orderBy("id","DESC")->first();
            $notificationData = [
                "title"         => "New Resampling Request",
                "description"   => "A new Resampling Request of Applicant “".$customer_details->company_name ."” from FA “".Auth::user()->name."” received.",
                'route'         => route("application.process",$request->application_id),
            ];

            $notifiableUsers = User::where("id", $request->assign_user)->first();
            Notification::send($notifiableUsers, new ApplicationNotification($notificationData));
            #NOTIFICATION FOR FSO FORWARD END HERE

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
}
