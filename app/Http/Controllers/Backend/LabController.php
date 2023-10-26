<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\ApplicationStep;
use App\Models\CustomerDetails;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ApplicationNotification;

class LabController extends Controller
{
    public function receivedSample(Request $request)
    {
        try {
            Application::findOrFail($request->application_id)->update([
                'sample_collect' => Carbon::now(),
            ]);

            notify()->success('Sample Received Successfully', 'Success');
            return redirect()->back();
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            notify()->error('Sample Receive Failed', 'Error');
            return back();
        }
    }

    public function labProcess(Request $request)
    {

        DB::beginTransaction();

        try {
            $application = Application::findOrFail($request->application_id);
            $fa1Process  = ApplicationStep::where('application_id', $application->id)->where('step_name', 1)->orderBy('id', 'DESC')->first();
            $labProcess  = ApplicationStep::where('application_id', $application->id)->where('step_name', 3)->orderBy('id', 'DESC')->first();
            $fa2Process  = ApplicationStep::where('application_id', $application->id)->where('step_name', 4)->orderBy('id', 'DESC')->first();


            $docs = [];

            if ($request->hasFile('doc_file')) {
                foreach ($request->file('doc_file') as $key => $docF) {
                    $filename = 'LABDOC_'. time(). $key . '.' . $docF->getClientOriginalExtension();
                    $docF->move(public_path('upload/process'), $filename);
                    array_push($docs,$filename);
                }

                $all_docs = json_encode($docs);
            }

            if (!$labProcess) {
                // if ($request->hasFile('doc_file')) {
                //     $file = $request->file('doc_file');
                //     $filename = 'LABDOC_' . time() . '.' . $file->getClientOriginalExtension();
                //     $file->move(public_path('upload/process'), $filename);
                // }

                ApplicationStep::create([
                    'application_id' => $request->application_id,
                    'created_by' => Auth::user()->id,
                    'remark' => $request->remark,
                    'doc_file' => isset($all_docs) ? $all_docs : null,
                    'step_name' => 3,
                    'previous_step_name' => 2,
                    'application_status' => 4,
                    'helper_status' => 0
                ]);

                $application->update([
                    'application_status' => 4,
                    'reference_no' => $request->reference_no
                ]);

            } else {
                // if ($request->hasFile('doc_file')) {
                //     $file = $request->file('doc_file');
                //     @unlink(public_path('upload/process/' . $labProcess->doc_file));
                //     $filename = 'LABDOC_' . time() . '.' . $file->getClientOriginalExtension();
                //     $file->move(public_path('upload/process'), $filename);
                // }

                $labProcess->update([
                    'assign_user_id' => $request->assign_user,
                    'remark' => $request->remark,
                    'doc_file' => isset($all_docs) ? $all_docs : null,
                    'step_name' => 3,
                    'previous_step_name' => 2,
                    'application_status' => 4,
                    'isResampling' => 0,
                    'helper_status' => 0
                ]);

                $fa2Process->update([
                    'helper_status' => 1
                ]);
            }

            #NOTIFICATION FOR FA START HERE
            $customer_details = CustomerDetails::where("customer_id", $application->customer_id)->orderBy("id","DESC")->first();
            $notificationData = [
                "title"         => "New Test Report Received",
                "description"   => "Received a test report of Applicant “".$customer_details->company_name ."” from lab “".Auth::user()->name."” received.",
                'route'         => route("application.process",$application->id),
            ];

            $notifiableUsers = User::where("id", $fa1Process->created_by)->first();
            Notification::send($notifiableUsers, new ApplicationNotification($notificationData));
            #NOTIFICATION FOR FA END HERE

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

    public function labResampling(Request $request)
    {
        DB::beginTransaction();

        try {
            $application = Application::findOrFail($request->application_id);
            $firstProcess = ApplicationStep::where('application_id', $application->id)->where('step_name', 1)->orderBy('id', 'DESC')->first();

            ApplicationStep::create([
                'application_id' => $request->application_id,
                'created_by' => Auth::user()->id,
                'remark' => $request->remark,
                'step_name' => 3,
                'previous_step_name' => 2,
                'isResampling' => 1,
                'application_status' => 5
            ]);

            $application->update([
                'application_status' => 5
            ]);

            #NOTIFICATION FOR FA START HERE
            $customer_details = CustomerDetails::where("customer_id", $application->customer_id)->orderBy("id","DESC")->first();
            $notificationData = [
                "title"         => "New Resampling Request",
                "description"   => "A new Resampling Request of Applicant “".$customer_details->company_name ."” from Lab “".Auth::user()->name."” received.",
                'route'         => route("application.process",$request->application_id),
            ];

            $notifiableUsers = User::where("id", $firstProcess->created_by)->first();
            Notification::send($notifiableUsers, new ApplicationNotification($notificationData));
            #NOTIFICATION FOR FA END HERE

            DB::commit();

            notify()->success('Resampling Submitted Successfully', 'Success');
            return redirect()->back();
        } catch (\Throwable $th) {
            DB::rollback();
            Log::error($th->getMessage());
            notify()->error('Resampling Submit Failed', 'Error');
            return back();
        }
    }
}
