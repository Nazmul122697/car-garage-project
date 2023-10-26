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
use Illuminate\Support\Facades\Notification;
use App\Notifications\ApplicationNotification;

class RfsoController extends Controller
{
    public function rfsoProcess(Request $request)
    {

        DB::beginTransaction();

        try {
            $application = Application::findOrFail($request->application_id);

            $firstProcess = ApplicationStep::where('application_id', $application->id)->where('step_name', 1)->orderBy('id', 'DESC')->first();
            $rfsoProcess  = ApplicationStep::where('application_id', $application->id)->where('step_name', 2)->orderBy('id', 'DESC')->first();
            $labProcess   = ApplicationStep::where('application_id', $application->id)->where('step_name', 3)->orderBy('id', 'DESC')->first();


            $docs = [];

            if ($request->hasFile('doc_file')) {
                foreach ($request->file('doc_file') as $key => $docF) {
                    $filename = 'FSODOC_'. time(). $key . '.' . $docF->getClientOriginalExtension();
                    $docF->move(public_path('upload/process'), $filename);
                    array_push($docs,$filename);
                }

                $all_docs = json_encode($docs);
            }

            if (!$rfsoProcess) {
                ApplicationStep::create([
                    'application_id' => $request->application_id,
                    'created_by' => Auth::user()->id,
                    // 'assign_user_id' => $request->assign_user,
                    'remark' => $request->remark,
                    'doc_file' => isset($all_docs) ? $all_docs : null,
                    'step_name' => 2,
                    'previous_step_name' => 1,
                    'application_status' => 3
                ]);

                $application->update([
                    'inspection_date' => Carbon::now(),
                    'application_status' => 3
                ]);

                #NOTIFICATION FOR CUSTOMER START HERE
                $notificationData = [
                    "title"         => "Sample Successfully Collected",
                    "description"   => "Your sample have been collected and sealed. Please take your sample to designated lab for testing.",
                    'route'         => route("application.index"),
                ];


                $notifiableUsers = User::where("id", $application->customer_id)->first();
                Notification::send($notifiableUsers, new ApplicationNotification($notificationData));
                #NOTIFICATION FOR CUSTOMER END HERE

                #NOTIFICATION FOR LAB START HERE
                $customer_details = CustomerDetails::where("customer_id", $application->customer_id)->orderBy("id","DESC")->first();
                $notificationData = [
                    "title"         => "New Application Request",
                    "description"   => "A new application of Applicant “".$customer_details->company_name ."” from FSO “".Auth::user()->name."” received.",
                    'route'         => route("application.process",$request->application_id),
                ];

                $notifiableUsers = User::where("id", $firstProcess->lab_user_id)->first();
                Notification::send($notifiableUsers, new ApplicationNotification($notificationData));
                #NOTIFICATION FOR LAB END HERE

                #NOTIFICATION FOR FA START HERE
                $customer_details = CustomerDetails::where("customer_id", $application->customer_id)->orderBy("id","DESC")->first();
                $notificationData = [
                    "title"         => "New Sample Collected",
                    "description"   => "Sample have been collected for Applicant “".$customer_details->company_name ."” application by FSO “".Auth::user()->name."”.",
                    'route'         => route("application.process",$request->application_id),
                ];

                $notifiableUsers = User::where("id", $firstProcess->created_by)->first();
                Notification::send($notifiableUsers, new ApplicationNotification($notificationData));
                #NOTIFICATION FOR FA END HERE

            } else {

                $rfsoProcess->update([
                    // 'assign_user_id' => $request->assign_user,
                    'remark' => $request->remark,
                    'doc_file' => isset($all_docs) ? $all_docs : null,
                    'step_name' => 2,
                    'previous_step_name' => 1,
                    'application_status' => 3,
                    'isResampling' => 0
                ]);

                $firstProcess->update([
                    'isResampling' => 0
                ]);

                $labProcess->update([
                    'helper_status' => 1 // for resampling modal button enable
                ]);
            }

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
