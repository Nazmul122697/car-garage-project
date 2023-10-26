<?php

namespace App\Http\Controllers;

use DB;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Invoice;
use App\Models\Application;
use App\Models\FeeStructure;
use Illuminate\Http\Request;
use App\Models\ChangeRequest;
use App\Models\CustomerDetails;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ApplicationNotification;
use App\Library\SslCommerz\SslCommerzNotification;

class SslCommerzPaymentController extends Controller
{

    public function exampleEasyCheckout()
    {
        return view('exampleEasycheckout');
    }

    public function exampleHostedCheckout()
    {
        return view('exampleHosted');
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

    public function index(Request $request)
    {
        // dd($request->all());

        # Here you have to receive all the order data to initate the payment.
        # Let's say, your oder transaction informations are saving in a table called "orders"
        # In "orders" table, order unique identity is "transaction_id". "status" field contain status of the transaction, "amount" is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.


        /*************** APPLICATION PART START HERE ***************/
          // upload proforma_invoice
          if ($request->hasFile('proforma_invoice')) {
            $file = $request->file('proforma_invoice');
            $proformaInvoiceFilename = 'proforma_invoice_' .rand(0,9999). time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/customer'), $proformaInvoiceFilename);
        }

        // upload packing_list
        if ($request->hasFile('packing_list')) {
            $file = $request->file('packing_list');
            $packingListFilename = 'packing_list_' .rand(0,9999). time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/customer'), $packingListFilename);
        }

        // upload test_parameter
        if ($request->hasFile('test_parameter')) {
            $file = $request->file('test_parameter');
            $testParameterFilename = 'test_parameter_' .rand(0,9999). time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/customer'), $testParameterFilename);
        }


        // upload declaration
        if ($request->hasFile('declaration')) {
            $file = $request->file('declaration');
            $declarationFilename = 'declaration_' .rand(0,9999). time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/customer'), $declarationFilename);
        }

        // upload upload_document
        if ($request->hasFile('upload_document')) {
            $file = $request->file('upload_document');
            $filename = 'upload_document_'.rand(0,9999) . time() . '.' . $file->getClientOriginalExtension();
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
            "payment_type" => "online",
            "application_status" => 0
        ]);

        $invoice = Invoice::create([
            'customer_id' => Auth::user()->id,
            'application_id' => $application->id,
            'invoice_generate' => $this->unique_digit(),
            'name' => $request->exporter_name,
            'email' =>  Auth::user()->email,
            'phone' => Auth::user()->phone,
            'price' => $request->online_fee,
            'sub_total' => $request->online_fee,
            'vat' => $request->online_vat,
            'tax' => $request->online_tax,
            'total' => $request->online_total,
            'payment_status' => 1      // '0 = unpaid & 1 = paid'
        ]);



        $post_data = array();
        $post_data['total_amount'] = $request->online_total; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = uniqid(); // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['customer_id'] = Auth::user()->id;
        $post_data['cus_name'] = Auth::user()->name;
        $post_data['cus_email'] = Auth::user()->email;
        $post_data['cus_add1'] = $request->exporter_address;
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = "";
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = Auth::user()->phone;
        $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "Store Test";
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_phone'] = "";
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = $request->product_name;
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = "ref001";
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";


        #Before  going to initiate the payment order status need to insert or update as Pending.
        $update_product = DB::table('orders')
            ->where('transaction_id', $post_data['tran_id'])
            ->updateOrInsert([
                'customer_id' => $post_data['customer_id'],
                'invoice_id' => $invoice->id,
                'product_name' => $post_data['product_name'],
                'name' => $post_data['cus_name'],
                'email' => $post_data['cus_email'],
                'phone' => $post_data['cus_phone'],
                'amount' => $post_data['total_amount'],
                'status' => 'Pending',
                'address' => $post_data['cus_add1'],
                'transaction_id' => $post_data['tran_id'],
                'currency' => $post_data['currency'],
                'created_at' => Carbon::now()
            ]);

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

        $sslc = new SslCommerzNotification();
        // dd($sslc);
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'hosted');
        // dd($payment_options);
        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }
    }

    public function changeRequestPay(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'remark' => 'required',
        ]);

        // upload upload_document
        if ($request->hasFile('upload_document')) {
            $file = $request->file('upload_document');
            $filename = 'upload_document_'.rand(0,9999) . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/customer'), $filename);
        }

        $application = Application::findOrFail($request->application_id);
        // dd($application);


        $invoiceId = Invoice::insertGetId([
            'customer_id' => $application->customer_id,
            'application_id' => $application->id,
            'invoice_generate' => $this->unique_digit(),
            'name' => $application->exporter_name,
            'email' =>  Auth::user()->email,
            'phone' => Auth::user()->phone,
            'price' => $request->fee,
            'sub_total' => $request->fee,
            'vat' => $request->vat,
            'tax' => $request->tax,
            'total' => $request->total,
            'payment_status' => 1,      // '0 = unpaid & 1 = paid'
            'created_at' => Carbon::now(),
        ]);


        $changeRequestId = ChangeRequest::insertGetId([
            'application_id' => $request->application_id,
            'customer_id' => Auth::user()->id,
            'remark' => $request->remark,
            'document' => $request->hasFile('upload_document') ? $filename : null,
            'invoice_id' => $invoiceId,
            'isChallan' => 0,
            'request_created_at' => Carbon::now(),
            'status' => 0,

        ]);

        $totalAmount = $request->total;

        $post_data = array();
        $post_data['total_amount'] = $totalAmount; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = uniqid(); // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['customer_id'] = Auth::user()->id;
        $post_data['cus_name'] = Auth::user()->name;
        $post_data['cus_email'] = Auth::user()->email;
        $post_data['cus_add1'] = $application->exporter_address;
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = "";
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = Auth::user()->phone;
        $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "Store Test";
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_phone'] = "";
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = $application->product_name;
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = "ref001";
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";



         #Before  going to initiate the payment order status need to insert or update as Pending.
         $update_product = DB::table('orders')
         ->where('transaction_id', $post_data['tran_id'])
         ->updateOrInsert([
             'customer_id' => $post_data['customer_id'],
             'invoice_id' => $invoiceId,
             'product_name' => $post_data['product_name'],
             'name' => $post_data['cus_name'],
             'email' => $post_data['cus_email'],
             'phone' => $post_data['cus_phone'],
             'amount' => $post_data['total_amount'],
             'status' => 'Pending',
             'address' => $post_data['cus_add1'],
             'transaction_id' => $post_data['tran_id'],
             'currency' => $post_data['currency'],
             'created_at' => Carbon::now()
         ]);





        #NOTIFICATION FOR SO START HERE
        $customer_details = CustomerDetails::where("customer_id", $application->customer_id)->orderBy("id","DESC")->first();

        $notificationData = [
            "title"         => "New Change Request",
            "description"   => "A new change request from  Applicant “".$customer_details->company_name ."” received",
            'route'         => route("change-request.index"),
        ];

        $notifiableUsers = User::where("role_id", 6)->get();
        Notification::send($notifiableUsers, new ApplicationNotification($notificationData));
        #NOTIFICATION FOR SO END HERE

        $batpar= $changeRequestId;
        $data = $request->session()->put('changeRequestIdok',$batpar);
        // dd($request->session()->has('changeRequestIdok'));

        $sslc = new SslCommerzNotification();
        // dd($sslc);
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'hosted');
        // dd($payment_options);
        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }

        // dd('hello');
    }

    public function payViaAjax(Request $request)
    {
        // dd($request->all());

        # Here you have to receive all the order data to initate the payment.
        # Lets your oder trnsaction informations are saving in a table called "orders"
        # In orders table order uniq identity is "transaction_id","status" field contain status of the transaction, "amount" is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.
        $post_data = array();
        $post_data['total_amount'] = '10'; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = uniqid(); // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = 'Customer Name';
        $post_data['cus_email'] = 'customer@mail.com';
        $post_data['cus_add1'] = 'Customer Address';
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = "";
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = '8801XXXXXXXXX';
        $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "Store Test";
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_phone'] = "";
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Computer";
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = "ref001";
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";


        #Before  going to initiate the payment order status need to update as Pending.
        $update_product = DB::table('orders')
            ->where('transaction_id', $post_data['tran_id'])
            ->updateOrInsert([
                'name' => $post_data['cus_name'],
                'email' => $post_data['cus_email'],
                'phone' => $post_data['cus_phone'],
                'amount' => $post_data['total_amount'],
                'status' => 'Pending',
                'address' => $post_data['cus_add1'],
                'transaction_id' => $post_data['tran_id'],
                'currency' => $post_data['currency']
            ]);

        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'checkout', 'json');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }


    }

    public function success(Request $request)
    {
        // dd($request->session()->has('changeRequestId'));
        // echo "Transaction is Successful";
        $tran_id = $request->input('tran_id');
        $amount = $request->input('amount');
        $currency = $request->input('currency');

        $sslc = new SslCommerzNotification();

        #Check order status in order tabel against the transaction id or order id.
        $order_details = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        Session::put('tran_id', $tran_id);
        if (Session::has('challan_id')) {
            Session::forget('challan_id');
        }

        if ($order_details->status == 'Pending') {
            $validation = $sslc->orderValidate($request->all(), $tran_id, $amount, $currency);

            if ($validation) {
                /*
                That means IPN did not work or IPN URL was not set in your merchant panel. Here you need to update order status
                in order table as Processing or Complete.
                Here you can also sent sms or email for successfull transaction to customer
                */
                $update_product = DB::table('orders')
                    ->where('transaction_id', $tran_id)
                    ->update(['status' => 'Processing']);

                // echo "<br >Transaction is successfully Completed";
                return redirect()->route('application.payment.invoice');
            }
        } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {
            /*
             That means through IPN Order status already updated. Now you can just show the customer that transaction is completed. No need to udate database.
             */
            // echo "Transaction is successfully Completed";
            return redirect()->route('application.payment.invoice');
        } else {
            #That means something wrong happened. You can redirect customer to your product page.
            echo "Invalid Transaction";
        }
    }

    public function fail(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_details = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_details->status == 'Pending') {
            $update_product = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Failed']);
            echo "Transaction is Falied";
        } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {
            echo "Transaction is already Successful";
        } else {
            echo "Transaction is Invalid";
        }
    }

    public function cancel(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_details = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_details->status == 'Pending') {
            $update_product = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Canceled']);
            echo "Transaction is Cancel";
        } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {
            echo "Transaction is already Successful";
        } else {
            echo "Transaction is Invalid";
        }
    }

    public function ipn(Request $request)
    {
        #Received all the payement information from the gateway
        if ($request->input('tran_id')) #Check transation id is posted or not.
        {

            $tran_id = $request->input('tran_id');

            #Check order status in order tabel against the transaction id or order id.
            $order_details = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->select('transaction_id', 'status', 'currency', 'amount')->first();

            if ($order_details->status == 'Pending') {
                $sslc = new SslCommerzNotification();
                $validation = $sslc->orderValidate($request->all(), $tran_id, $order_details->amount, $order_details->currency);
                if ($validation == TRUE) {
                    /*
                    That means IPN worked. Here you need to update order status
                    in order table as Processing or Complete.
                    Here you can also sent sms or email for successful transaction to customer
                    */
                    $update_product = DB::table('orders')
                        ->where('transaction_id', $tran_id)
                        ->update(['status' => 'Processing']);

                    echo "Transaction is successfully Completed";
                }
            } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {

                #That means Order status already updated. No need to udate database.

                echo "Transaction is already successfully Completed";
            } else {
                #That means something wrong happened. You can redirect customer to your product page.

                echo "Invalid Transaction";
            }
        } else {
            echo "Invalid Data";
        }
    }
}
