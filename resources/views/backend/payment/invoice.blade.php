@extends('backend.master')

@section('title')
    Invoice
@endsection

@push('css')
    <style>
        .receipt-main-container {
            border: 1px solid #595757;
        }

        .receipt-header {
            display: flex;
            justify-content: space-between;
            text-align: center;
            padding: 30px;
            border-bottom: 1px solid #595757;
        }

        .receipt-header-text {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .receipt-subtitle {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 6px;
            font-weight: 600;
            font-size: 12px;
            color: #222222;
        }

        .receipt-subtitle .website {
            color: #262161;
        }

        .receipt-gov-logo img {
            width: 80px;
        }

        .receipt-lab-logo img {
            width: 100px;
        }

        .receipt-body {
            padding: 30px 30px 60px;
        }

        .receipt-invoice-title {
            color: #222222;
            border: 1px solid #222222;
            font-weight: 700;
            padding: 10px;
            text-align: center;
            width: 150px;
            margin: 0 auto;
        }

        .invoice-body-top-items {
            margin: 20px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .receipt-body-text {
            color: #222222;
            font-weight: 700;
            font-size: 12px;
        }

        .receipt-body-invoice-text {
            color: #222222;
            font-weight: 700;
            font-size: 10px;
        }

        .receipt-body-invoice-no {
            color: #595757;
            font-weight: 500;
            font-size: 12px;
        }

        .invoice-barcode-area {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 4px;
        }

        .invoice-barcode-area img {
            width: 100px;
        }

        .invoice-details-area {
            font-weight: 600;
            font-size: 12px;
            display: grid;
            grid-template-columns: repeat(12, 1fr);
            margin-bottom: 0.5rem;
        }

        .invoice-details-area p:nth-child(1) {
            grid-column: 1 / span 2;
        }

        .invoice-details-area p:nth-child(2) {
            grid-column: 3 / 4;
        }

        .invoice-details-area p:nth-child(3) {
            grid-column: 4 / -1;
        }

        .invoice-price-table {
            margin: 20px 0;
        }

        .invoice-price-table table {
            width: 100%;
            font-size: 12px;
        }

        .invoice-price-table thead {
            background-color: rgba(220, 218, 240, 0.6);
        }

        .invoice-price-table thead th,
        .invoice-price-table tbody td {
            border: 1px solid;
            text-align: center;
            padding: 10px;
        }

        .invoice-price-table tfoot tr th {
            padding: 10px;
            border: 1px solid;
        }

        .invoice-price-table tfoot tr th:nth-child(1) {
            text-align: end;
        }

        .invoice-price-table tfoot tr th:nth-child(2) {
            text-align: center;
        }

        .invoice-details-data {
            font-weight: 400;
        }

        .invoice-footer {
            padding: 30px;
            display: flex;
            justify-content: space-between;
            align-items: end;
            color: #222222;
        }

        .invoice-footer-direction {
            font-weight: 700;
            font-size: 12px;
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .invoice-footer-time {
            font-size: 12px;
        }

        /* } */

        /* ============Download Invoice End============== */
    </style>
@endpush

@section('content')
    <!-- main body content start -->
    <div class="main-container">
        <!-- sample-registration:Receipt start -->
        <div>
            <h1 class="dashboard-payment-title mb-5 d-flex justify-content-center align-items-center gap-3">
                <span class="success-icon"><i class="fa-regular fa-circle-check"></i></span>
                <span>Payment Successful</span>
            </h1>

            <!-- payment-receipt start -->
            <section id="printableContent" class="receipt-main-container">
                <!-- receipt header start -->
                <div class="receipt-header">
                    <div class="receipt-gov-logo">
                        <img src="{{ asset('/') }}backend/asset/logo/Government-of-Bangladesh.png" alt="bd-gov-logo" />
                    </div>
                    <div class="receipt-header-text">
                        <h2 class="mb-3 text-lg-center dashboard-title" style="font-size:18px">
                            Government of the People’s Republic of Bangladesh
                        </h2>
                        <div class="receipt-subtitle">
                            <p>Bangladesh Food Safety Authority</p>
                            <p class="website">www.bfsa.gov.bd</p>
                            <p>
                                Telephone NO.: <span>+8802-222223459</span>, Email:
                                <span>info@bfsa.gov.bd</span>
                            </p>
                        </div>
                    </div>
                    <div class="receipt-lab-logo">
                        <img src="{{ asset('/') }}backend/asset/logo/logo.png" alt="bfsa-logo" />
                    </div>
                </div>
                <!-- receipt header end -->

                <!-- receipt body start -->
                <div class="receipt-body">
                    <p class="receipt-invoice-title">Invoice</p>
                    <div class="invoice-body-top-items">
                        <p class="receipt-body-text">
                            Applicantion ID: <span>{{ @$order->invoice->application->applied_id }}</span>
                        </p>
                        <p class="receipt-body-text">Date:
                            <span>{{ @$order->invoice->created_at ? $order->invoice->created_at->format('d/m/Y') : '' }}</span>
                        </p>
                        <div class="invoice-barcode-area">
                            <p class="receipt-body-invoice-text">
                                Invoice No. <span>{{ @$order->invoice->invoice_generate }}</span>
                            </p>
                            <div>
                                {{-- {!! DNS1D::getBarcodeHTML(@$order->invoice->invoice_generate, 'C128') !!} --}}
                                {!! DNS1D::getBarcodeSVG(@$order->invoice->invoice_generate, 'C128') !!}
                            </div>

                        </div>
                    </div>
                    <!-- invoice details -->
                    <div>
                        <div class="invoice-details-area">
                            <p>Applicant Name</p>
                            <p>:</p>
                            <p class="invoice-details-data">{{ @$order->customer->name }}</p>
                        </div>
                        <div class="invoice-details-area">
                            <p>Mobile No.</p>
                            <p>:</p>
                            <p class="invoice-details-data">{{ @$order->customer->phone }}</p>
                        </div>
                        <div class="invoice-details-area">
                            <p>Email Address</p>
                            <p>:</p>
                            <p class="invoice-details-data">{{ @$order->customer->email }}</p>
                        </div>
                        <div class="invoice-details-area">
                            <p>Company Name</p>
                            <p>:</p>
                            <p class="invoice-details-data">
                                {{ @$order->customer->customerDetail->company_name }}
                            </p>
                        </div>
                        <div class="invoice-details-area">
                            <p>Type Of Good</p>
                            <p>:</p>
                            <p class="invoice-details-data">
                                {{ @$order->invoice->application->typeGood->name }}
                            </p>
                        </div>
                        <div class="invoice-details-area">
                            <p>Quantity OF Good</p>
                            <p>:</p>
                            <p class="invoice-details-data">
                                {{ @$order->invoice->application->quantity }}
                            </p>
                        </div>
                        <div class="invoice-details-area">
                            <p>Country Of Consignment</p>
                            <p>:</p>
                            <p class="invoice-details-data">
                                {{ @$order->invoice->application->country->name }}
                            </p>
                        </div>
                    </div>
                    <!-- price table -->
                    <div class="invoice-price-table table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th>Service Name</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-end">
                                        <strong>{{@$serviceName ?? 'Health Certificate'}} :</strong>
                                    </td>
                                    <td>
                                        <span class="ordered-product-unit-price">{{ @$order->invoice->price }}</span>
                                        BDT
                                    </td>
                                </tr>

                                <tr>
                                    <td class="text-end">
                                        <strong>Vat(15%) :</strong>
                                    </td>
                                        @php
                                            $vatTaxAmount = $order->invoice->vat + $order->invoice->tax;
                                        @endphp


                                    <td>

                                        <span>{{ $order->invoice->vat }}</span>
                                        BDT
                                    </td>
                                </tr>

                                <tr>
                                    <td class="text-end">
                                        <strong>Tax(10%) :</strong>
                                    </td>


                                    <td>
                                        <span>{{ $order->invoice->tax }}</span>
                                        BDT
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-end">
                                        <strong>Total :</strong>
                                    </td>
                                    <td>
                                        <span class="ordered-product-total-price">{{ @$order->invoice->total }}</span>
                                        BDT
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                    <!-- paid via -->
                    <div>
                        <p class="fw-bold small-text-12">
                            Paid via: <span>
                                {{ $type == 'bank' ? 'Bank' : 'Online' }}
                            </span>
                        </p>
                    </div>
                </div>
                <!-- receipt body end -->

                <!-- receipt footer start -->
                <div class="invoice-footer">
                    <div class="invoice-footer-direction">
                        <p>বিশেষ নির্দেশনাঃ</p>
                        <p>
                            স্যাম্পেল জমা দেওয়ার সময় অবশ্যই মানি রিসিটটি সঙ্গে নিয়ে
                            আসবেন।
                        </p>
                    </div>
                    <div class="invoice-footer-time">
                        <p>
                            Receipt generated on <span>{{ @$order->invoice->created_at }}</span>
                        </p>
                    </div>
                </div>
                <!-- receipt footer end -->
            </section>
            <!-- payment-receipt end -->
        </div>
        <!-- sample-registration:Receipt end -->
        <div class="search-btn mt-5 w-100 text-center mx-auto">
            <a onclick="printDiv('printableContent')" class="btn btn-primary small-text-12 py-2">
                Print Money Receipt</a>
        </div>
        {{-- <div class="d-flex justify-content-center mt-3">
            <button onclick="printDiv('printableContent')"
                class="border-0 bg-transparent small-text-12 fw-semibold text-secondary">
                Print Receipt
            </button>
        </div> --}}
    </div>

    <!-- main body content end -->
@endsection

@push('js')
    <script>

        function printDiv(divId) {
            var printContents = document.getElementById(divId).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;
            window.print();

            document.body.innerHTML = originalContents;

        }
    </script>
@endpush
