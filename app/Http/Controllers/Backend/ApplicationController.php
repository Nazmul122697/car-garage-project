<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use App\Models\Order;
use App\Models\Country;
use App\Models\Invoice;
use App\Models\District;
use App\Models\Division;
use App\Models\TypeGood;
use App\Models\Application;
use App\Models\FeeStructure;
use Illuminate\Http\Request;
use App\Models\ChallanPayment;
use App\Models\CustomerDetails;
use App\Models\ModeOfTransport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\ChangeRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ApplicationNotification;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

class ApplicationController extends Controller
{
    public function index(Request $request)
    {
        Gate::authorize('application.index');

        if ($request->ajax()) {
            $data = '';
            $query = Application::query();

            $startDate = date('Y-m-d', strtotime($request->starting_date));
            $endDate = date('Y-m-d', strtotime($request->ending_date));

            if (Auth::user()->role_id != 2) {

                if ($request->application_id) {
                    $query->where('applied_id', $request->application_id);
                }

                if ($request->starting_date) {
                    $query->whereDate('created_at', '>=', $startDate);
                }

                if ($request->ending_date) {
                    $query->whereDate('created_at', '<=', $endDate);
                }
            } else {

                if ($request->application_id) {
                    $query->where('customer_id', Auth::user()->id)
                        ->where('applied_id', $request->application_id);
                }

                if ($request->starting_date) {
                    $query->where('customer_id', Auth::user()->id)
                        ->whereDate('created_at', '>=', $startDate);
                }

                if ($request->ending_date) {
                    $query->where('customer_id', Auth::user()->id)
                        ->whereDate('created_at', '<=', $endDate);
                }

                if ($request->status == '0') {
                    $query->where('customer_id', Auth::user()->id)
                        ->where('application_status', '0');
                }

                if ($request->status == '1') {
                    $query->where('customer_id', Auth::user()->id)
                        ->where('application_status', '1');
                }

                if ($request->status == '2') {
                    $query->where('customer_id', Auth::user()->id)
                        ->where('application_status', '2');
                }

                if ($request->status == '3') {
                    $query->where('customer_id', Auth::user()->id)
                        ->where('application_status', '2');
                }

                if ($request->status == '4') {
                    $query->where('customer_id', Auth::user()->id)
                        ->where('application_status', '4');
                }

                if ($request->status == '5') {
                    $query->where('customer_id', Auth::user()->id)
                        ->where('application_status', '5');
                }

                if ($request->status == '6') {
                    $query->where('customer_id', Auth::user()->id)
                        ->where('application_status', '6');
                }

                if ($request->status == '7') {
                    $query->where('customer_id', Auth::user()->id)
                        ->where('application_status', '7');
                }

                $query->where('customer_id', Auth::user()->id)->get();
            }



            $data = $query->orderBy('id', 'desc')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('application_id', function ($row) {
                    return $row->applied_id;
                })
                ->editColumn('application_date', function ($row) {
                    return isset($row->created_at) ? date('M d, Y', strtotime($row->created_at)) : 'N/A';
                })
                ->editColumn('sample_collect', function ($row) {
                    return isset($row->sample_collect) ? date('M d, Y', strtotime($row->sample_collect)) : 'N/A';
                })
                ->editColumn('completion_date', function ($row) {
                    return isset($row->completion_date) ? date('M d, Y', strtotime($row->completion_date)) : 'N/A';
                })
                ->editColumn('application_status', function ($row) {
                    if ($row->application_status == 0) {
                        $status = '<span class="badge bg-warning">Pending</span>';
                        return  $status;
                    }
                    if ($row->application_status == 1) {
                        $status = '<span class="badge bg-info">In Progress</span>';
                        return  $status;
                    }
                    if ($row->application_status == 2) {
                        $status = '<span class="badge bg-danger">Rejected</span>';
                        return  $status;
                    }
                    if ($row->application_status == 3) {
                        $status = '<span class="badge bg-secondary">Request Sample Collect</span>';
                        return  $status;
                    }
                    if ($row->application_status == 4) {
                        $status = '<span class="badge bg-primary">Sample Collected</span>';
                        return  $status;
                    }
                    if ($row->application_status == 5) {
                        $status = '<span class="badge bg-dark">Resampling</span>';
                        return  $status;
                    }
                    if ($row->application_status == 6) {
                        $status = '<span class="badge" style="background-color: #006400">On Hold</span>';
                        return  $status;
                    }
                    if ($row->application_status == 7) {
                        $status = '<span class="badge bg-success">Finalized	</span>';
                        return  $status;
                    }
                })
                ->rawColumns(['action', 'application_id', 'application_date', 'sample_collect', 'application_status'])
                ->addColumn('status',function($row){
                    return $row->application_status;
                })
                ->addColumn('action', function ($row) {
                    $actionbtn = '<a href="' . route('application.payment.invoice', ['app_id' => $row->id]) . '"
                                    class="btn btn-action-download me-2">
                                    <i class="bi bi-receipt"></i> Invoice</a>';


                    // return $actionbtn;


                    if (Auth::user()->role_id != 1 && Auth::user()->role_id != 2) {

                        if ($row->application_status == 6 || $row->application_status == 2) {
                            $actionbtn = '

                            <a href="' . route('application.payment.invoice', ['app_id' => $row->id]) . '"
                            class="btn btn-action-download me-2">
                            <i class="bi bi-receipt"></i> Invoice</a>

                            <a onclick = remarkData("' . $row->id . '") class="btn btn-action-remark d-inline-block remark_modal"
                                link="' . route('application.remark') . '"
                                data-bs-toggle="modal"
                                data-bs-target="#modal"
                                <i class="bi bi-card-list"></i> Remark</a>

                            <a href="' . route('application.process', $row->id) . '"
                                        class="btn btn-action-view">
                                        <i class="bi bi-eye"></i> View</a>';
                        } else {

                            $actionbtn = '

                            <a href="' . route('application.payment.invoice', ['app_id' => $row->id]) . '"
                            class="btn btn-action-download me-2">
                            <i class="bi bi-receipt"></i> Invoice</a>

                            <a href="' . route('application.process', $row->id) . '"
                                        class="btn btn-action-view">
                                        <i class="bi bi-eye"></i> View</a>';
                        }
                    }

                    if (Auth::user()->role_id == 2) {
                        if ($row->application_status == 6) {
                            $actionbtn = '
                                    <a href=" ' . route('application.payment.invoice', ['app_id' => $row->id]) . ' "
                                        class="btn btn-action-download me-2">
                                        <i class="bi bi-receipt"></i> Invoice</a>

                                    <a onclick = remarkData("' . $row->id . '") class="btn btn-action-remark d-inline-block remark_modal"
                                        link="' . route('application.remark') . '"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modal"
                                        <i class="bi bi-card-list"></i> Remark</a>

                                    <a href=" ' . route('application.edit', ['id' => $row->id]) . ' "
                                                class="btn btn-action d-inline-block">
                                                <i class="bi bi-pencil-square"></i> Edit</a>';
                            // return $actionbtn;
                        }

                        if ($row->application_status == 2) {
                            $actionbtn = '
                                    <a href=" ' . route('application.payment.invoice', ['app_id' => $row->id]) . ' "
                                        class="btn btn-action-download me-2">
                                        <i class="bi bi-receipt"></i> Invoice</a>

                                    <a onclick="remarkData(' . $row->id . ')" class="btn btn-action-remark d-inline-block remark-btn remarkBtn"
                                            link="' . route('application.remark') . '"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modal"
                                            <i class="bi bi-card-list"></i> Remark</a>';
                            // return $actionbtn;
                        }
                    }


                    return $actionbtn;
                })
                ->make(true);
        }


        return view('backend.customer.application');
    }

    public function create()
    {
        Gate::authorize('application.create');

        $type_goods = TypeGood::where('status', 1)->get();
        $countries  = Country::orderBy('name', 'ASC')->get();
        $divisions  = Division::select(['id', 'name'])->orderBy('name', 'ASC')->get();
        $districts  = District::select(['id', 'division_id', 'name'])->orderBy('name', 'ASC')->get();
        $modeOfTransports = ModeOfTransport::orderBy('name', 'ASC')->get();

        return view('backend.customer.create-application', compact('type_goods', 'countries', 'divisions', 'modeOfTransports'));
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


    public function store(Request $request)
    {
        Gate::authorize('application.create');

        // dd($request->all());
        try {
            DB::beginTransaction();

            // upload proforma_invoice
            if ($request->hasFile('proforma_invoice')) {
                $file = $request->file('proforma_invoice');
                $proformaInvoiceFilename = 'proforma_invoice_' . rand(0, 9999) . time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('upload/customer'), $proformaInvoiceFilename);
            }

            // upload packing_list
            if ($request->hasFile('packing_list')) {
                $file = $request->file('packing_list');
                $packingListFilename = 'packing_list_' . rand(0, 9999) . time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('upload/customer'), $packingListFilename);
            }

            // upload test_parameter
            if ($request->hasFile('test_parameter')) {
                $file = $request->file('test_parameter');
                $testParameterFilename = 'test_parameter_' . rand(0, 9999) . time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('upload/customer'), $testParameterFilename);
            }


            // upload declaration
            if ($request->hasFile('declaration')) {
                $file = $request->file('declaration');
                $declarationFilename = 'declaration_' . rand(0, 9999) . time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('upload/customer'), $declarationFilename);
            }

            // upload upload_document
            if ($request->hasFile('upload_document')) {
                $file = $request->file('upload_document');
                $filename = 'upload_document_' . rand(0, 9999) . time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('upload/customer'), $filename);
            }

            $application = Application::create([
                "customer_id" => Auth::id(),
                "country_id" => $request->country_id,
                "type_good_id" => $request->type_good,
                "applied_id" => date('Ymd') . $this->applicationID(),
                "erc_no" => $request->erc_no,
                "exporter_name" => $request->exporter_name,
                "exporter_address" => $request->exporter_address,
                "invoice_no" => $request->invoice_no,
                "invoice_date" => date("Y-m-d", strtotime($request->invoice_date)),
                "lc_no" => $request->lc_no,
                "lc_date" => date("Y-m-d", strtotime($request->lc_date)),
                "manufacturer_name" => $request->manufacturer_name,
                "manufacturer_address" => $request->manufacturer_address,
                "manufacturer_country_id" => $request->manufacturer_country_id,
                "buyer_name" => $request->buyer_name,
                "buyer_address" => $request->buyer_address,
                "buyer_country_id" => $request->buyer_country_id,
                "buyer_email" => $request->buyer_email,
                "product_name" => $request->product_name,
                "manufacturing_date" => $request->manufacturing_date,
                "expired_date" => $request->expired_date,
                "probable_date" => date("Y-m-d", strtotime($request->probable_date)),
                "port_loading" => $request->port_loading,
                "port_discharge" => $request->port_discharge,
                "address_consignment" => $request->address_consignment,
                "consignment_country" => $request->consignment_country,
                "shipping_mark" => $request->shipping_mark,
                "no_packing" => $request->no_packing,
                "kind_packing" => $request->kind_packing,
                "hs_code" => $request->hs_code,
                "description_goods" => $request->description_goods,
                "mode_of_transport" => $request->mode_of_transport,
                "net_weight" => $request->net_weight,
                "weight" => $request->weight,
                "temperature" => $request->temperature,
                "quantity" => $request->quantity,
                "fob_cfr_value" => $request->fob_cfr_value,
                "proforma_invoice" => $proformaInvoiceFilename,
                "packing_list" => $packingListFilename,
                "test_parameter" => $testParameterFilename,
                "declaration" => $declarationFilename,
                "upload_document" => $request->hasFile('upload_document') ? $filename : null,
                "certificate_ref_no" => $this->generateReferenceNo(),
                "payment_type" => "bank",
                "application_status" => 0
            ]);

            $bankAmount = intval($request->bank_amount);
            $vatAmount =  floatval($request->vat_amount);
            $taxAmount =  floatval($request->tax_amount);
            $totalAmount = $bankAmount + $vatAmount + $taxAmount;

            $invoice = Invoice::create([
                'customer_id' => Auth::user()->id,
                'application_id' => $application->id,
                'invoice_generate' => $this->unique_digit(),
                'name' => $request->exporter_name,
                'email' =>  Auth::user()->email,
                'phone' => Auth::user()->phone,
                'price' => $bankAmount,
                'sub_total' => $bankAmount,
                'vat' => $vatAmount,
                'tax' => $taxAmount,
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
                'bank_amount' => $bankAmount,
                'isEchallan' => $request->filled('isEchallan'),
                'certificate_vat_challan' => $request->certificate_vat_challan,
                'bfsa_vat_challan' => $request->bfsa_vat_challan,
                'certificate_challan_file' => $request->certificate_challan_file,
                'bfsa_challan_file' => $request->bfsa_challan_file,
            ]);

            $request->session()->put('challan_id', $challanId);
            if ($request->session()->has('tran_id')) {
                $request->session()->forget('tran_id');
            }

            #Notification Start Here
            $notificationData = [
                "title"         => "Application Successfully Completed",
                "description"   => "Your application has been successfully completed.",
                'route'         => route("application.index"),
            ];

            $notifiableUsers = User::where("role_id", 3)->get();
            $notifiableUsers->push(auth()->user());

            Notification::send($notifiableUsers, new ApplicationNotification($notificationData));
            #Notification End Here

            DB::commit();

            notify()->success('Application Submited Successfully', 'Success');
            // return redirect()->route('application.index');
            return redirect()->route('application.payment.invoice');
        } catch (\Throwable $th) {
            DB::rollback();

            Log::error($th->getMessage());
            notify()->error('Application Submit Failed', 'Error');
            return back();
        }
    }

    public function edit(Request $request)
    {
        Gate::authorize('application.edit');

        $application = Application::where('id', $request->id)->first();
        $type_goods = TypeGood::where('status', 1)->get();
        $countries  = Country::orderBy('name', 'ASC')->get();
        $divisions  = Division::select(['id', 'name'])->orderBy('name', 'ASC')->get();
        $districts  = District::select(['id', 'division_id', 'name'])->orderBy('name', 'ASC')->get();

        return view('backend.customer.edit-application', compact('application', 'type_goods', 'countries', 'divisions', 'districts'));
    }

    public function update(Request $request)
    {

        Gate::authorize('application.edit');

        // dd($request->all());
        DB::beginTransaction();

        try {
            $application = Application::findOrFail($request->app_id);
            // dd($application);
            if ($request->hasFile('upload_document')) {
                $file = $request->file('upload_document');
                @unlink(public_path('upload/customer/' . $application->upload_document));
                $filename = 'Document_' . time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('upload/customer'), $filename);
                $application->update([
                    'upload_document' => $filename
                ]);
            }

            $application->update([
                "customer_id" => auth()->user()->id,
                "type_good_id" => $request->type_good,
                "applied_id" => date('Ymd') . $this->applicationID(),
                "erc_no" => $request->erc_no,
                "exporter_name" => $request->exporter_name,
                "exporter_address" => $request->exporter_address,
                "invoice_no" => $request->invoice_no,
                "invoice_date" => date("Y-m-d", strtotime($request->invoice_date)),
                "lc_no" => $request->lc_no,
                "lc_date" => date("Y-m-d", strtotime($request->lc_date)),
                "manufacturer_name" => $request->manufacturer_name,
                "manufacturer_address" => $request->manufacturer_address,
                "buyer_name" => $request->buyer_name,
                "buyer_address" => $request->buyer_address,
                "buyer_email" => $request->buyer_email,
                "product_name" => $request->product_name,
                "probable_date" => date("Y-m-d", strtotime($request->probable_date)),
                "port_loading" => $request->port_loading,
                "port_discharge" => $request->port_discharge,
                "address_consignment" => $request->address_consignment,
                "consignment_country" => $request->consignment_country,
                "shipping_mark" => $request->shipping_mark,
                "no_packing" => $request->no_packing,
                "kind_packing" => $request->kind_packing,
                "hs_code" => $request->hs_code,
                "description_goods" => $request->description_goods,
                "quantity" => $request->quantity,
                "fob_cfr_value" => $request->fob_cfr_value,
                "application_status" => 0,
                "remark" => null,
            ]);


            #NOTIFICATION FOR FA START HERE
            $customer_details = CustomerDetails::where("customer_id", $application->customer_id)->orderBy("id", "DESC")->first();
            $notificationData = [
                "title"         => "Corrected Application Received ",
                "description"   => "Received a corrected application of Applicant “" . $customer_details->company_name . "”",
                'route'         => route("application.process", $application->id),
            ];

            $notifiableUsers = User::where("id", $application->onhold_by)->first();
            Notification::send($notifiableUsers, new ApplicationNotification($notificationData));
            #NOTIFICATION FOR FA END HERE

            DB::commit();

            notify()->success('Application Updated Successfully', 'Success');
            // return redirect()->route('application.index');
            return redirect()->route('application.index');
        } catch (\Throwable $th) {
            DB::rollback();

            Log::error($th->getMessage());
            notify()->error('Application Submit Failed', 'Error');
            return back();
        }
    }



    public function applicationID()
    {
        $isUnique = false;
        $applicationID = '';
        while (!$isUnique) {
            $applicationID = (string)(mt_rand(10000000, 99999999));
            $isUnique = Application::where('applied_id', $applicationID)->first() ? false : true;
        }
        return $applicationID;
    }


    public function getDivision($id)
    {
        $data = District::where('division_id', $id)->get();
        return response()->json($data);
    }


    public function calculateFee(Request $request)
    {
        $feeStructure = FeeStructure::where('min', '<=', $request->fobValue)
            ->where('max', '>=', $request->fobValue)->first();
        $onlineAmount = intval($feeStructure->fee);
        $vatAmount =  ($onlineAmount * 15) / 100;
        $taxAmount =  ($onlineAmount * 10) / 100;
        $totalAmount = $onlineAmount + $vatAmount + $taxAmount;
        $data = [
            'fee' => $onlineAmount,
            'vat' => $vatAmount,
            'tax' => $taxAmount,
            'total_amount' => $totalAmount,
        ];
        return response()->json($data);
    }


    public function invoice(Request $request)
    {
        // dd($request->session()->all());
        // dd($request->session()->get('changeRequestIdok'));


        // dd($request->session()->all());
        if ($request->app_id) {
            $application = Application::findOrFail($request->app_id);
            $invoice = Invoice::where('application_id', $request->app_id)->first();
            // dd($application);
            if ($application->payment_type == 'online') {
                $type = 'online';
                $order = Order::where('invoice_id', $invoice->id)->first();
            } else {
                $type = 'bank';
                $order = ChallanPayment::where('invoice_id', $invoice->id)->first();
            }
            return view('backend.payment.invoice', compact('order', 'type'));
        } else {
            // dd($request->session()->has('changeRequest'));
            if ($request->session()->has('challan_id')) {
                $type = 'bank';

                if ($request->session()->has('changeRequest')) {
                    $changeRequest = $request->session()->get('changeRequest');
                    $changeRequestId = $changeRequest['changerequest_id'];
                    $challan_id = $changeRequest['challan_id'];

                    $order = ChallanPayment::where('id', $challan_id)->first();
                    $serviceName = 'Change Request Fee';
                    return view('backend.payment.invoice', compact('order', 'type', 'serviceName'));
                }

                $challan_id = Session::get('challan_id');
                $order = ChallanPayment::where('id', $challan_id)->first();

                return view('backend.payment.invoice', compact('order', 'type'));

            } elseif ($request->session()->has('tran_id')) {
                $tran_id = Session::get('tran_id');
                $order = Order::where('transaction_id', $tran_id)->first();
                $changeRequest = ChangeRequest::where('invoice_id',$order->invoice_id)->first();
                $type = 'online';
                if($changeRequest){
                    // dd($changeRequest);
                    $serviceName = 'Change Request Fee';
                    return view('backend.payment.invoice', compact('order', 'type', 'serviceName'));
                }

                return view('backend.payment.invoice', compact('order', 'type'));
            } else {
                return redirect()->route('application.create');
            }
        }
    }

    public function generateReferenceNo()
    {

        $prefix = 'BFSAHC';
        $year = date('Y');

        $lastSerialNumber = Application::latest()->value('reference_no');
        $lastSerialNumber = substr($lastSerialNumber, -8); // Get the last 8 digits

        $newSerialNumber = (int) $lastSerialNumber + 1;
        $newSerialNumber = str_pad($newSerialNumber, 8, '0', STR_PAD_LEFT); // Pad with zeros

        return $prefix . $year . $newSerialNumber;
    }


    public function nocDownload()
    {
        $filePath = public_path('backend/asset/file/noc.pdf');
        return response()->download($filePath, 'noc.pdf');
    }

    public function status(Request $request)
    {
        // dd($request->all());
        $statusName = $request->name;
        $status = $request->status;

        if ($request->ajax()) {
            $data = '';
            // if(Auth::user()->role_id != 2){

            $data = Application::orderBy('id', 'DESC');

            if ($request->has('application_id')) {
                $applicationId = $request->application_id;
                $data->where('id', $applicationId);
            }

            if ($status == 'pending') {
                $data->where('application_status', 0);
            } elseif ($status == 'in-progress') {
                $data->where('application_status', 1);
            } elseif ($status == 'rejected') {
                $data->where('application_status', 2);
            } elseif ($status == 'sample-collect') {
                $data->where('application_status', 4);
            } elseif ($status == 'resampling') {
                $data->where('application_status', 5);
            } elseif ($status == 'finalized') {
                $data->where('application_status', 7);
            }

            $data = $data->get();

            // }

            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('application_id', function ($row) {
                    return $row->applied_id;
                })
                ->editColumn('application_date', function ($row) {
                    return date('M d, Y', strtotime($row->created_at));
                })
                ->editColumn('sample_collect', function ($row) {
                    return date('M d, Y', strtotime($row->sample_collect));
                })
                ->editColumn('completion_date', function ($row) {
                    return date('M d, Y', strtotime($row->completion_date));
                })
                ->editColumn('application_status', function ($row) {
                    if ($row->application_status == 0) {
                        $status = '<span class="badge bg-warning">Pending</span>';
                        return  $status;
                    }
                    if ($row->application_status == 1) {
                        $status = '<span class="badge bg-info">In Progress</span>';
                        return  $status;
                    }
                    if ($row->application_status == 2) {
                        $status = '<span class="badge bg-danger">Rejected</span>';
                        return  $status;
                    }
                    if ($row->application_status == 3) {
                        $status = '<span class="badge bg-secondary">Request Sample Collect</span>';
                        return  $status;
                    }
                    if ($row->application_status == 4) {
                        $status = '<span class="badge bg-primary">Sample Collected</span>';
                        return  $status;
                    }
                    if ($row->application_status == 5) {
                        $status = '<span class="badge bg-dark">Resampling</span>';
                        return  $status;
                    }
                    if ($row->application_status == 6) {
                        $status = '<span class="badge bg-warning">On Hold</span>';
                        return  $status;
                    }
                    if ($row->application_status == 7) {
                        $status = '<span class="badge bg-warning">Finalized	</span>';
                        return  $status;
                    }
                })
                ->rawColumns(['action', 'application_id', 'application_date', 'sample_collect', 'application_status'])
                ->addColumn('action', function ($row) {
                    $actionbtn = '<a href="{{route(\'application.payment.invoice\',[\'app_id\' => $application->id])}}"
                            class="btn btn-action-download me-2">
                            <i class="bi bi-receipt"></i> Invoice</a>';

                    // return $actionbtn;


                    if (Auth::user()->role_id != 1 && Auth::user()->role_id != 2) {
                        $actionbtn = '

                                <a href="' . route('application.payment.invoice', ['app_id' => $row->id]) . '"
                                class="btn btn-action-download me-2">
                                <i class="bi bi-receipt"></i> Invoice</a>

                                <a href="' . route('application.process', $row->id) . '"
                                            class="btn btn-action-view">
                                            <i class="bi bi-eye"></i> View</a>';
                        return $actionbtn;
                    }

                    if (Auth::user()->role_id == 2 && @$row->application_status == 6) {
                        $actionbtn = '
                                <a href=" ' . route('application.payment.invoice', ['app_id' => $row->id]) . ' "
                                    class="btn btn-action-download me-2">
                                    <i class="bi bi-receipt"></i> Invoice</a>

                                <a href=" ' . route('application.edit', ['id' => $row->id]) . ' "
                                            class="btn btn-action d-inline-block">
                                            <i class="bi bi-pencil-square"></i> Edit</a>';
                        return $actionbtn;
                    }


                    if (Auth::user()->role_id == 2 && $row->application_status == 6 ||  $row->application_status == 2) {
                        $actionbtn = '
                                <a href=" ' . route('application.payment.invoice', ['app_id' => $row->id]) . ' "
                                    class="btn btn-action-download me-2">
                                    <i class="bi bi-receipt"></i> Invoice</a>

                                <a class="btn btn-action-remark d-inline-block remark-btn" data-bs-toggle="modal"
                                    data-bs-target="#remarkModal" data-id=" ' . $row->id . '">
                                    <i class="bi bi-card-list"></i> Remark</a>';
                        return $actionbtn;
                    }

                    return $actionbtn;
                })
                ->make(true);
        }

        $data = Application::orderBy('id', 'DESC')->get();

        return view('backend.customer.application_status', compact('statusName', 'data'));
    }
}
