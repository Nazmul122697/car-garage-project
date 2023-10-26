<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/x-icon" href="{{asset('/')}}backend/asset/logo/favicon.ico" />
    <title>BFSA Automation</title>
    <style>

        *,
        *::before,
        *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Poppins", sans-serif;
            overflow-x: hidden;
        }

        ul,
        ol,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p,
        address {
            margin: 0;
            padding: 0;
        }

        li {
            list-style: none;
        }

        a {
            text-decoration: none;
            color: #000000;
        }


        .small-text-12 {
            font-size: 12px !important;
        }


        .main-container {
            padding: 3rem;
        }

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

        /* ============Download Invoice End============== */
    </style>
</head>

<body onload="window.print()">
    <div class="main-container">
        <!-- payment-receipt start -->
        <section class="receipt-main-container">
            <!-- receipt header start -->
            <div class="receipt-header" >
                <div class="receipt-gov-logo">
                    <img src="{{ asset('/') }}backend/asset/logo/Government-of-Bangladesh.png" alt="bd-gov-logo" />
                </div>
                <div class="receipt-header-text">
                    <h2 class="mb-3 text-lg-start dashboard-title">
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
                        Applicant ID: <span>0321</span>
                    </p>
                    <p class="receipt-body-text">Date: <span>10/01/2023</span></p>
                    <div class="invoice-barcode-area">
                        <p class="receipt-body-invoice-text">
                            Invoice No. <span>123456</span>
                        </p>
                        <img src="{{public_path('backend/asset/image/barcode.png')}}" alt="invoice-bar" class="bar-code-img" />
                        <p class="receipt-body-invoice-no">1 2 3 4 5 6</p>
                    </div>
                </div>
                <!-- invoice details -->
                <div>
                    <div class="invoice-details-area">
                        <p>Applicant Name</p>
                        <p>:</p>
                        <p class="invoice-details-data">Alamin Khan</p>
                    </div>
                    <div class="invoice-details-area">
                        <p>Mobile No.</p>
                        <p>:</p>
                        <p class="invoice-details-data">01744448822</p>
                    </div>
                    <div class="invoice-details-area">
                        <p>Email Address</p>
                        <p>:</p>
                        <p class="invoice-details-data">alamin@gmail.com</p>
                    </div>
                    <div class="invoice-details-area">
                        <p>Company Name</p>
                        <p>:</p>
                        <p class="invoice-details-data">
                            Nabisco Biscuit & Bread Factory Ltd.
                        </p>
                    </div>
                    <div class="invoice-details-area">
                        <p>Type Of Good</p>
                        <p>:</p>
                        <p class="invoice-details-data">Biscuit</p>
                    </div>
                    <div class="invoice-details-area">
                        <p>Quantity OF Good</p>
                        <p>:</p>
                        <p class="invoice-details-data">2 carton</p>
                    </div>
                    <div class="invoice-details-area">
                        <p>Country Of Consignment</p>
                        <p>:</p>
                        <p class="invoice-details-data">USA</p>
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
                                <td>Health Certificate</td>
                                <td>
                                    <span class="ordered-product-unit-price">500</span>
                                    BDT
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="1">Vat :</th>
                                <th>
                                    ৳
                                    <span>50</span>
                                </th>
                            </tr>
                            <tr>
                                <th colspan="1">Sub Total :</th>
                                <th>
                                    ৳
                                    <span>500</span>
                                </th>
                            </tr>
                            <tr>
                                <th colspan="1">Total :</th>
                                <th>
                                    ৳
                                    <span class="ordered-product-total-price">550</span>
                                </th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- paid via -->
                <div>
                    <p class="fw-bold small-text-12">
                        Paid via: <span>Card</span>
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
                        Receipt generated on <span>10/01/23</span> at
                        <span>11:00 am</span>
                    </p>
                </div>
            </div>
            <!-- receipt footer end -->
        </section>
        <!-- payment-receipt end -->
        <!-- sample-registration:Receipt end -->
    </div>
</body>


</html>
