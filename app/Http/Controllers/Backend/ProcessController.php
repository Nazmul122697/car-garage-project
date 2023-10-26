<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use App\Models\Application;
use Illuminate\Http\Request;
use App\Models\ApplicationStep;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class ProcessController extends Controller
{
    public function applicationProcess($id)
    {
        $user = Auth::user();

        if ($user->role_id !=1 && $user->role_id != 2){
            $application = Application::findOrFail($id);

            /*______________________@FA 1 PANEL______________________*/
            $rfso_users = User::where('role_id', 4)->orderBy('id', 'DESC')->get();
            $lab_users  = User::where('role_id', 5)->orderBy('id', 'DESC')->get();
            $faFirstProcess = ApplicationStep::with(['assignUser','forwardUser'])->where('application_id', $id)->where('step_name', 1)->orderBy('id', 'DESC')->first();

            /*______________________@FSO PANEL______________________*/
            // $lab_users = User::where('role_id', 5)->orderBy('id', 'DESC')->get();
            $rfsoProcess = ApplicationStep::with(['assignUser','forwardUser'])->where('application_id', $id)->where('step_name', 2)->orderBy('id', 'DESC')->first();

            /*______________________@Lab PANEL______________________*/
            $labProcess    = ApplicationStep::where('application_id', $id)->where('step_name', 3)->orderBy('id', 'DESC')->first();

            /*______________________@FA 2 PANEL______________________*/
            $faForwardUsers = User::where('role_id', 3)->where('id', '<>', Auth::id())->orderBy('id', 'DESC')->get();
            $fa2Process     = ApplicationStep::where('application_id', $id)->where('step_name', 4)->orderBy('id', 'DESC')->first();

            /*______________________@SO 1 PANEL______________________*/
            $so1Process     = ApplicationStep::where('application_id', $id)->where('step_name', 5)->orderBy('id', 'DESC')->first();

            /*______________________@Director 1 PANEL______________________*/
            $director1Process    = ApplicationStep::where('application_id', $id)->where('step_name', 6)->orderBy('id', 'DESC')->first();

            /*______________________@Member 1 PANEL______________________*/
            $member1Process    = ApplicationStep::where('application_id', $id)->where('step_name', 7)->orderBy('id', 'DESC')->first();

            /*______________________@Director 1 PANEL______________________*/
            $directorForwardUsers = User::where('role_id', 7)->where('id', '<>', Auth::id())->orderBy('id', 'DESC')->get();
            $director2Process     = ApplicationStep::where('application_id', $id)->where('step_name', 8)->orderBy('id', 'DESC')->first();

            /*______________________@SO 1 PANEL______________________*/
            $soForwardUsers  = User::where('role_id', 6)->where('id', '<>', Auth::id())->orderBy('id', 'DESC')->get();
            $finalProcess    = ApplicationStep::where('application_id', $id)->where('step_name', 9)->orderBy('id', 'DESC')->first();

            return view('backend.process.application-process', compact('application','rfso_users','faFirstProcess','lab_users','rfsoProcess','labProcess','faForwardUsers','fa2Process','so1Process','director1Process','member1Process','directorForwardUsers','director2Process','soForwardUsers','finalProcess'));
        } else {
            return redirect()->back();
        }
    }

    public function viewRemark($id)
    {
        $data = ApplicationStep::findOrFail($id);
        return response()->json($data);
    }

    public function remark(Request $request)
    {
        $application = Application::findOrFail($request->id);

        // dd($application);
        // return response()->json($application);
        // $data = Application::findOrFail($request->id);
        // return response()->json($data);
        return view('backend.customer.application_remark',compact('application'));
    }



}
