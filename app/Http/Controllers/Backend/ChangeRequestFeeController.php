<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Models\ChangeRequestFee;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\ChallanPayment;
use App\Models\ChangeRequest;
use App\Models\Invoice;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class ChangeRequestFeeController extends Controller
{

    public function index()
    {
        Gate::authorize('change-request-fees.index');

        $changeRequestFee = ChangeRequestFee::first();
        return view('backend.change_request.fee',compact('changeRequestFee'));
    }

    public function store(Request $request)
    {
        Gate::authorize('change-request-fees.index');

        $request->validate([
            'fee' => 'required',
            'vat' => 'required',
            'tax' => 'required',
        ]);

        try {
            $changeRequestFee = ChangeRequestFee::first();
            $changeRequestFee->update([
                'fee' => $request->fee,
                'vat' => $request->vat,
                'tax' => $request->tax,
            ]);

            notify()->success("Fee updated successfully.", "Success");
            return redirect()->back();

        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            notify()->error('Fee Update Failed', 'Error');
            return redirect()->back();
        }
    }




}
