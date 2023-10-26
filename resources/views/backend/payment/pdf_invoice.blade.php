<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        @media print {
            body {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }

            @page {
                size: A4;
                margin: 0;
            }

            html,
            body {
                width: 210mm;
                height: 297mm;
                margin: 0;
                padding: 0;
            }
        }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <div id="invoice">
        <section class="receipt-main-container" style="border: 1px solid #595757;">
            <!--Header start-->
            <div class="receipt-header"
                style="display: flex;justify-content: space-between;text-align: center;padding: 30px;border-bottom: 1px solid #595757 !important;">
                <div class="receipt-gov-logo">
                    <img src="{{ asset('backend/asset/logo/Government-of-Bangladesh.png') }}" alt="bd-gov-logo" style="width: 80px;">
                </div>
                <div class="receipt-header-text" style="display: flex;flex-direction: column;align-items: center;">
                    <h2 class="mb-3 text-lg-start dashboard-title">Government of the People’s Republic of Bangladesh</h2>
                    <div class="receipt-subtitle"
                        style="display: flex;flex-direction: column;align-items: center;gap: 6px;font-weight: 600;font-size: 12px;color: #222222;">
                        <p>Bangladesh Food Safety Authority</p>
                        <p class="website" style="color: #262161;">www.bfsa.gov.bd</p>
                        <p>Telephone NO.: <span>+8802-222223459</span>, Email:
                            <span>info@bfsa.gov.bd</span>
                        </p>
                    </div>
                </div>
                <div class="receipt-lab-logo">
                    <img src="{{ asset('backend/asset/logo/logo.png') }}" alt="lab-logo" style="width: 80px;">
                </div>
            </div>
            <!--Header end-->

            <!--invoice body start-->
            <div class="receipt-body" style="padding: 30px 30px 60px;">
                <p class="receipt-invoice-title"
                    style="color: #222222;border: 1px solid #222222;font-weight: 700;padding: 10px;text-align: center;width: 150px;margin: 0 auto !important;">
                    Invoice</p>
                <div class="invoice-body-top-items"
                    style="margin: 20px 0;display: flex !important;justify-content: space-between !important;align-items: center !important;">
                    <p class="receipt-body-text" style="color: #222222;font-weight: 700;font-size: 12px;">Lab Code:

                        {{-- <span>{{ $item->laboratory->code }}</span> --}}
                    </p>
                    <p class="receipt-body-text" style="color: #222222;font-weight: 700;font-size: 12px;">Applicant
                        ID:
                        {{-- <span>{{ $item->applicant->code }}</span> --}}
                    </p>
                    <p class="receipt-body-text" style="color: #222222;font-weight: 700;font-size: 12px;">Date:
                        {{-- <span>{{ $item->created_at->format('d/m/Y') }}</span> --}}
                    </p>
                    {{-- <div class="invoice-barcode-area"
                            style="display: flex;flex-direction: column;align-items: center;gap: 4px;">
                            <p class="receipt-body-invoice-text"
                                style="color: #222222;font-weight: 700;font-size: 10px;">
                                Invoice No. <span>{{ $item->invoice->invoice_no }}</span></p>
                                <div class="mb-3">{!! DNS1D::getBarcodeHTML($item->invoice->invoice_no, 'C128') !!}</div>
                            <p class="receipt-body-invoice-no" style="color: #595757;font-weight: 500;font-size: 12px;">{{ implode(' ', str_split($item->invoice->invoice_no)) }}</p>
                        </div> --}}
                </div>
                <div>
                    <div class="invoice-details-area"
                        style="font-weight: 600;font-size: 12px;display: grid;grid-template-columns: repeat(12, 1fr);margin-bottom: 0.5rem;">
                        <p style="grid-column: 1 / span 2;">Applicant Name</p>
                        <p style="grid-column: 3 / 4;">:</p>
                        {{-- <p class="invoice-details-data" style="font-weight: 400;grid-column: 4 / -1;">
                                {{ $item->applicant->name }}</p> --}}
                    </div>
                    <div class="invoice-details-area"
                        style="font-weight: 600;font-size: 12px;display: grid;grid-template-columns: repeat(12, 1fr);margin-bottom: 0.5rem;">
                        <p style="grid-column: 1 / span 2;">Mobile No.</p>
                        <p style="grid-column: 3 / 4;">:</p>
                        {{-- <p class="invoice-details-data" style="font-weight: 400;grid-column: 4 / -1;">
                                {{ $item->mobile }}</p> --}}
                    </div>
                    <div class="invoice-details-area"
                        style="font-weight: 600;font-size: 12px;display: grid;grid-template-columns: repeat(12, 1fr);margin-bottom: 0.5rem;">
                        <p style="grid-column: 1 / span 2;">Email Address</p>
                        <p style="grid-column: 3 / 4;">:</p>
                        {{-- <p class="invoice-details-data" style="font-weight: 400;grid-column: 4 / -1;">
                                {{ $item->email }}
                            </p> --}}
                    </div>
                    <div class="invoice-details-area"
                        style="font-weight: 600;font-size: 12px;display: grid;grid-template-columns: repeat(12, 1fr);margin-bottom: 0.5rem;">
                        <p style="grid-column: 1 / span 2;">Applicant Address</p>
                        <p style="grid-column: 3 / 4;">:</p>
                        {{-- <p class="invoice-details-data" style="font-weight: 400;grid-column: 4 / -1;">
                                {{ $item->address }}</p> --}}
                    </div>
                    <div class="invoice-details-area"
                        style="font-weight: 600;font-size: 12px;display: grid;grid-template-columns: repeat(12, 1fr);margin-bottom: 0.5rem;">
                        <p style="grid-column: 1 / span 2;">Test Name</p>
                        <p style="grid-column: 3 / 4;">:</p>
                        {{-- <p class="invoice-details-data" style="font-weight: 400;grid-column: 4 / -1;">
                                {{ $metaData['testTypeName'] }}</p> --}}
                    </div>
                    <div class="invoice-details-area"
                        style="font-weight: 600;font-size: 12px;display: grid;grid-template-columns: repeat(12, 1fr);margin-bottom: 0.5rem;">
                        <p style="grid-column: 1 / span 2;">Sample Type</p>
                        <p style="grid-column: 3 / 4;">:</p>
                        {{-- <p class="invoice-details-data" style="font-weight: 400;grid-column: 4 / -1;">
                                {{  $metaData['sampleTypeName'] }}</p> --}}
                    </div>
                    <div class="invoice-details-area"
                        style="font-weight: 600;font-size: 12px;display: grid;grid-template-columns: repeat(12, 1fr);margin-bottom: 0.5rem;">
                        <p style="grid-column: 1 / span 2;">Parameters</p>
                        <p style="grid-column: 3 / 4;">:</p>
                        {{-- <p class="invoice-details-data" style="font-weight: 400;grid-column: 4 / -1;">

                                {{ implode(' | ', array_column($metaData['parameters'], 'name')) }}

                                </p> --}}
                    </div>
                </div>
                <div class="invoice-price-table" style="margin: 20px 0;">
                    <table style="width: 100%;font-size: 12px;">
                        <thead style="background-color: rgba(220, 218, 240, 0.6);">
                            <tr>
                                <th style="border: 1px solid;text-align: center;padding: 10px;">Test Parameter</th>
                                <th style="border: 1px solid;text-align: center;padding: 10px;">Qty</th>
                                <th style="border: 1px solid;text-align: center;padding: 10px;">Unit Price</th>
                                <th style="border: 1px solid;text-align: center;padding: 10px;">Sub Total</th>
                            </tr>
                        </thead>
                        {{-- <tbody>
                                @foreach ($metaData['parameters'] as $data)
                                    <tr>
                                        <td style="border: 1px solid;text-align: center;padding: 10px;">{{ $data['name'] }}</td>
                                        <td style="border: 1px solid;text-align: center;padding: 10px;"><span
                                                class="ordered-product-qty">1</span></td>
                                        <td style="border: 1px solid;text-align: center;padding: 10px;">৳ <span
                                                class="ordered-product-unit-price">{{ $data['price'] }}</span></td>
                                        <td style="border: 1px solid;text-align: center;padding: 10px;">৳ <span
                                                class="ordered-product-subtotal-price">{{ $data['price']  }}</span></td>
                                    </tr>
                                @endforeach
                            </tbody> --}}
                        {{-- <tfoot>
                                <tr>
                                    <th colspan="3" style="padding: 10px;border: 1px solid;text-align: end;">Total
                                        :
                                    </th>
                                    <th style="padding: 10px;border: 1px solid;text-align: center;">৳ <span
                                            class="ordered-product-total-price">{{ $metaData['total'] }}</span></th>
                                </tr>
                                <tr>
                                    <th colspan="3" style="padding: 10px;border: 1px solid;text-align: end;">VAT
                                        (15%)
                                        :</th>
                                    <th style="padding: 10px;border: 1px solid;text-align: center;">৳ <span
                                            class="product-vats">{{ $metaData['totalPriceWithVat'] }}</span></th>
                                </tr>
                                <tr>
                                    <th colspan="3" style="padding: 10px;border: 1px solid;text-align: end;">Grand
                                        Total :</th>
                                    <th style="padding: 10px;border: 1px solid;text-align: center;">৳ <span
                                            class="ordered-product-grandtotal-price">{{ $metaData['grandTotal'] }}</span></th>
                                </tr>
                            </tfoot> --}}
                    </table>
                </div>

                <!-- <div>
                        <p class="fw-bold small-text-12">Paid via: <span>Card</span></p>
                    </div> -->
            </div>
            <!--invoice body start-->

            <div class="invoice-footer"
                style="padding: 30px;display: flex;justify-content: space-between;align-items: end;color: #222222;">
                <div class="invoice-footer-direction"
                    style="font-weight: 700;font-size: 12px;display: flex;flex-direction: column;gap: 5px;">
                    <p>বিশেষ নির্দেশনাঃ</p>
                    <p>স্যাম্পেল জমা দেওয়ার সময় অবশ্যই মানি রিসিটটি সঙ্গে নিয়ে আসবেন।</p>
                </div>
                <div class="invoice-footer-time" style="font-size: 12px;">
                    {{-- <p>Receipt generated on <span>{{ $item->created_at->format('d/m/Y') }}</span> at <span>{{ date('h:i a', strtotime($item->created_at)) }}
                </span></p> --}}
                </div>
            </div>
        </section>
    </div>
</body>

</html>
