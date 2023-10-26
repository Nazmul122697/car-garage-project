<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use App\Models\Country;
use App\Models\TypeGood;
use App\Models\Application;
use Illuminate\Http\Request;
use App\Models\ChangeRequest;
use App\Models\CustomerDetails;
use App\Models\ModeOfTransport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\ChallanPayment;
use App\Models\Invoice;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ApplicationNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ChangeRequestController extends Controller
{
    public function index()
    {
        if(Auth::user()->role_id != 6){
            return redirect()->back();
        }
        $changeRequests = ChangeRequest::orderBy('id','desc')->get();
        return view('backend.change_request.index',compact('changeRequests'));
    }

    public function viewRemark($id)
    {
        $data = ChangeRequest::findOrFail($id);
        return response()->json($data);
    }

    public function edit($id)
    {
        $applicationId = ChangeRequest::findOrFail($id)->application_id;
        $application = Application::where('id',$applicationId)->first();
        $countries = Country::get();
        $type_goods = TypeGood::get();
        $transport_modes = ModeOfTransport::get();
        // dd($application);
        return view('backend.change_request.edit',compact('application','countries','type_goods','transport_modes'));
    }

    public function update(Request $request)
    {
        // dd($request->all());

        try {
            DB::beginTransaction();
            $changeRequest = ChangeRequest::where('application_id',$request->application_id)->first();
            $changeRequest->update([
                'status' => 1 //status => update
            ]);

            $customer = CustomerDetails::where('customer_id',$changeRequest->customer_id)->first();
            $customer->update([
                'company_name' => $request->company_name,
                'nid_no' => $request->nid,
            ]);

            $application = Application::where('id',$request->application_id)->first();
            $application->update([
                'nid' => $request->nid,
                'exporter_address' => $request->exporter_address,
                'invoice_no' => $request->invoice_no,
                'lc_no' => $request->lc_no,
                'lc_date' => $request->lc_date,
                'manufacturer_country' => $request->manufacturer_country,
                'buyer_name' => $request->buyer_name,
                'buyer_address' => $request->buyer_address,
                'product_name' => $request->product_name,
                'probable_date' => $request->probable_date,
                'port_loading' => $request->port_loading,
                'port_discharge' => $request->port_discharge,
                'consignment_country' => $request->consignment_country,
                'manufacturing_date' => $request->manufacturing_date,
                'no_packing' => $request->no_packing,
                'kind_packing' => $request->kind_packing,
                'type_good' => $request->type_good,
                'description_goods' => $request->description_goods,
                'temperature' => $request->temperature,
                'net_weight' => $request->net_weight,
                'weight' => $request->weight,
                'quantity' => $request->quantity,
                // 'fob_cfr_value' => $request->fob_cfr_value,
            ]);


            #NOTIFICATION FOR CUSTOMER START HERE
            $notificationData = [
                "title"         => "Certificate Updated",
                "description"   => "Your certificate has been updated.",
                'route'         => route("certificate.index"),
            ];

            $notifiableUsers = User::where("id", $changeRequest->customer_id)->first();
            Notification::send($notifiableUsers, new ApplicationNotification($notificationData));
            #NOTIFICATION FOR CUSTOMER END HERE

            DB::commit();
            notify()->success('success','Certificate change request updated successfully');
            return redirect()->route('change-request.index');

        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error($th->getMessage());
            notify()->error('error','Certificate change request update failed');
        }
    }


    public function payment(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'remark' => 'required',
        ]);

        try {
            DB::beginTransaction();

            $application = Application::findOrFail($request->application_id);
            $totalAmount = intval($request->vat_amount) + intval($request->tax_amount);

            $invoice = Invoice::create([
                'customer_id' => Auth::user()->id,
                'application_id' => $application->id,
                'invoice_generate' => $this->unique_digit(),
                'name' => $application->exporter_name,
                'email' =>  Auth::user()->email,
                'phone' => Auth::user()->phone,
                'price' => $request->bank_amount,
                'sub_total' => $request->bank_amount,
                'vat' => $request->vat_amount,
                'tax' => $request->tax_amount,
                'total' => $totalAmount,
                'payment_status' => 1      // '0 = unpaid & 1 = paid'
            ]);

            $challanId = ChallanPayment::insertGetId([
                'customer_id' => Auth::user()->id,
                'application_id' => $application->id,
                'invoice_id' => $invoice->id,
                'bank_name' => $request->bank_name,
                'branch_name' => $request->branch_name,
                'bank_slip' => $request->bank_slip,
                'date' => date('Y-m-d', strtotime($request->date)),
                'bank_amount' => $request->bank_amount,
                'isEchallan' => $request->filled('isEchallan'),
                'certificate_vat_challan' => $request->certificate_vat_challan,
                'bfsa_vat_challan' => $request->bfsa_vat_challan,
                'certificate_challan_file' => $request->certificate_challan_file,
                'bfsa_challan_file' => $request->bfsa_challan_file,
            ]);


            $ChangeRequestId = ChangeRequest::insertGetId([
                'application_id' => $request->application_id,
                'customer_id' => Auth::user()->id,
                'remark' => $request->remark,
                'invoice_id' => $invoice->id,
                'isChallan' => $request->filled('isEchallan'),
                'request_created_at' => Carbon::now(),
                'status' => 0,

            ]);

            $changeRequest = [
                'challan_id' => $challanId,
                'changerequest_id' => $ChangeRequestId,
            ];

            $request->session()->put('changeRequest',$changeRequest);

            if ($request->session()->has('tran_id')) {
                $request->session()->forget('tran_id');
            }

            #Notification Start Here
            $notificationData = [
                "title"         => "Change Request Successfully Completed",
                "description"   => "Your Change Request has been successfully completed.",
                'route'         => route("change-request.index"),
            ];

            $notifiableUsers = User::where("role_id", 3)->get();
            $notifiableUsers->push(auth()->user());

            Notification::send($notifiableUsers, new ApplicationNotification($notificationData));
            #Notification End Here

            DB::commit();

            notify()->success('Change Request Submited Successfully', 'Success');
            return redirect()->route('application.payment.invoice');
        } catch (\Throwable $th) {
            DB::rollback();

            Log::error($th->getMessage());
            notify()->error('changerequest Submit Failed', 'Error');
            return redirect()->back();
        }
    }

    public function unique_digit()
    {
        $isUnique = false;
        $result = '';
        while (!$isUnique) {
            $result = (string)(mt_rand(10000000, 99999999));
            $isUnique = Invoice::where('invoice_generate', $result)->first() ? false : true;
        }
        return $result;
    }

}
