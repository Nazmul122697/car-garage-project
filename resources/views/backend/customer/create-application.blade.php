@extends('backend.master')

@section('title')
    Application
@endsection

@push('css')
    <style>
        .upload__btn {
            display: inline-block;
            padding: 8px 28px;
            background: #198754;
            border-radius: 5px;
            color: #fff;
            font-weight: 500;
            border: 0;
        }

        .up__title {
            font-size: 16px;
            margin-bottom: 10px;
            font-weight: 600;
            color: #1e2772;
        }

        .file__btn {
            text-decoration: underline;
            color: #0d6efd;
        }

        .submit__btn {
            background: #1e2772;
            box-shadow: 0px 12.1167px 24.2334px rgba(1, 11, 253, 0.12);
            border-radius: 8.07781px;
            padding: 8px 30px;
            color: #fff;
        }

        .muti__file__box a {
            text-decoration: underline;
            color: #1a2787;
        }

        .muti__file__box a span {
            margin-right: 10px;
            font-size: 12px;
        }

        .error {
            color: red !important;
            font-size: small;
        }

        .pdf-preview {
            display: inline-block;
            margin: 10px;
            text-align: center;
        }

        .pdf-preview i {
            color: #f00;
        }

        .close-button {
            cursor: pointer;
            color: #f00;
            font-weight: bold;
        }
    </style>
@endpush

@section('content')
    <!-- main body content start -->
    <div class="main-container">
        <form action="" method="POST" id="basic-form" enctype="multipart/form-data">
            @csrf

            {{-- HIDDEN ITEMS START HERE --}}
            <input type="hidden" name="total_amount" value="500">




            {{-- <div class="alert alert-danger" role="alert">
                <i class="bi bi-info-circle-fill"></i> <span> Please Download and Fill up the Declaration Form and upload it with the Application form.</span>
                    <a href="{{route('download.noc')}}" class="text-decoration-underline ">
                        Download</a>
            </div> --}}




            <div class="customer-information-content">
                <!-- customer information left -->
                <div class="customer-information-left">
                    <!-- Exporter info start -->
                    <div class="mb-5">
                        <div class="d-flex align-items-center gap-3 title-2">
                            <div class="serial-number">1</div>
                            <h1 class="page-title">Exporter’s Information</h1>
                        </div>

                        <div class="d-flex align-items-center gap-3 mb-3">
                            <!--ERC no start-->
                            <div class="w-100">
                                <label class="form-label form-control-label">ERC No. <sup
                                        class="text-danger">*</sup></label>
                                <input type="text" id="erc_no" class="form-control form-control-input"
                                    placeholder="ERC No." name="erc_no" value="{{ @Auth::user()->customerDetail->erc_no }}"
                                    readonly required />
                            </div>
                            <!--ERC no end-->

                            <!--Exporter's name start-->
                            <div class="w-100">
                                <label class="form-label form-control-label">Exporter’s Name <sup
                                        class="text-danger">*</sup></label>
                                <input type="text" id="exporter_name" class="form-control form-control-input"
                                    placeholder="Exporter’s Name" name="exporter_name" value="{{ @Auth::user()->name }}"
                                    readonly required />
                            </div>
                            <!--Exporter's name end-->

                        </div>


                        <div class="d-flex align-items-center gap-3 mb-3">
                            <!--NID no strat-->
                            <div class="w-100">
                                <label class="form-label form-control-label">National ID <sup
                                        class="text-danger">*</sup></label>
                                <input type="text" id="nid" class="form-control form-control-input"
                                    placeholder="National ID" name="nid"
                                    value="{{ @Auth::user()->customerDetail->nid_no }}" readonly required />
                            </div>
                            <!--NID no end-->

                            <!--Company name start-->
                            <div class="w-100">
                                <label class="form-label form-control-label">Company Name <sup class="text-danger">*</sup>
                                </label>
                                <input type="text" id="company_name" class="form-control form-control-input"
                                    placeholder="Company Name" name="company_name" readonly required
                                    value="{{ @Auth::user()->customerDetail->company_name }}" />
                            </div>
                            <!--Company name end-->
                        </div>

                        <!--Exporter address start-->
                        <div class="w-100 mb-3">
                            <label class="form-label form-control-label">Exporter Address <sup
                                    class="text-danger">*</sup></label>
                            <input type="text" id="exporter_address" class="form-control form-control-input"
                                placeholder="Street address" name="exporter_address" value="{{ old('exporter_address') }}"
                                required />
                        </div>
                        <!--Exporter address end-->

                        <!--Exporter Country start-->
                        <input type="hidden" name="country_id" value="14"> <!-- Bangladesh-->
                        <!--Exporter Country end-->

                        <div class="d-flex align-items-center gap-3 mb-3">
                            <!--Division start-->
                            <div class="w-100">
                                <label class="form-label form-control-label">Division<sup
                                        class="text-danger">*</sup></label>
                                @if (Auth::user()->division)
                                    <input type="text" id="division" name="division"
                                        class="form-control form-control-input" readonly required
                                        value="{{ @Auth::user()->divisionName->name }} ({{ @Auth::user()->divisionName->bn_name }})">
                                @else
                                    <span>N/A</span>
                                @endif


                            </div>
                            <!--Division end-->

                            <!--District start-->
                            <div class="w-100">
                                <label class="form-label form-control-label">District<sup
                                        class="text-danger">*</sup></label>
                                @if (Auth::user()->district)
                                    <input type="text" id="district" name="district"
                                        class="form-control form-control-input" readonly required
                                        value="{{ @Auth::user()->districtName->name }} ({{ @Auth::user()->districtName->bn_name }}) ">
                                @else
                                    <span>N/A</span>
                                @endif
                            </div>
                            <!--District end-->
                        </div>

                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="w-100">
                                <label class="form-label form-control-label">Invoice No. <sup
                                        class="text-danger">*</sup></label>
                                <input type="text" id="invoice_no" class="form-control form-control-input"
                                    placeholder="Invoice No." name="invoice_no" value="{{ old('invoice_no') }}" required />
                            </div>

                            <div class="w-100">
                                <label class="form-label form-control-label">Invoice Date <sup
                                        class="text-danger">*</sup></label>
                                <input type="date" id="invoice_date" class="form-control form-control-input"
                                    placeholder="Select date" name="invoice_date" value="{{ old('invoice_date') }}"
                                    required />
                            </div>
                        </div>

                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="w-100">
                                <label class="form-label form-control-label">Contract/LC No. <sup
                                        class="text-danger">*</sup></label>
                                <input type="text" id="lc_no" class="form-control form-control-input"
                                    placeholder="Contract/LC No." name="lc_no" value="{{ old('lc_no') }}" required />
                            </div>

                            <div class="w-100">
                                <label class="form-label form-control-label">Contract/LC No. Date <sup
                                        class="text-danger">*</sup></label>
                                <input type="date" id="lc_date" class="form-control form-control-input"
                                    placeholder="Select date" name="lc_date" value="{{ old('lc_date') }}" required />
                            </div>
                        </div>
                    </div>
                    <!-- Exporter info end -->

                    <!-- Manufacturer’s Information start -->
                    <div class="mb-5">
                        <div class="d-flex align-items-center gap-3 title-2">
                            <div class="serial-number">2</div>
                            <h1 class="page-title">Manufacturer’s Information</h1>
                        </div>
                        <div>
                            <div class="w-100 mb-3">
                                <label class="form-label form-control-label">Manufacturers Name <sup
                                        class="text-danger">*</sup></label>
                                <input type="text" id="manufacturer_name" class="form-control form-control-input"
                                    placeholder="Manufacturers Name" name="manufacturer_name"
                                    value="{{ old('manufacturer_name') }}" required />
                            </div>
                            <div class="w-100 mb-3">
                                <label class="form-label form-control-label">Manufacturers Address <sup
                                        class="text-danger">*</sup></label>
                                <input type="text" id="manufacturer_address" class="form-control form-control-input"
                                    placeholder="Manufacturers Address" name="manufacturer_address"
                                    value="{{ old('manufacturer_address') }}" required />
                            </div>
                            <div class="w-100 mb-3">
                                <label for="manufacturer_country" class="form-label form-control-label">Manufacturers
                                    Country <sup class="text-danger">*</sup></label>
                                <select name="manufacturer_country_id" id="manufacturer_country"
                                    class="form-control form-control-input select2">
                                    <option value="" selected disabled>Select country...</option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->id }}" @selected(old('manufacturer_country_id') == $country->id)>
                                            {{ $country->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- Manufacturer’s Information end -->

                    <!-- Buyer info start -->
                    <div class="mb-5">
                        <div class="d-flex align-items-center gap-3 title-2">
                            <div class="serial-number">3</div>
                            <h1 class="page-title">Buyer’s Information</h1>
                        </div>
                        <div>
                            <div class="w-100 mb-3">
                                <label class="form-label form-control-label">Buyer’s Name <sup
                                        class="text-danger">*</sup></label>
                                <input type="text" id="buyer_name" class="form-control form-control-input"
                                    placeholder="Buyer’s Name" name="buyer_name" value="{{ old('buyer_name') }}"
                                    required />
                            </div>

                            <div class="w-100 mb-3">
                                <label class="form-label form-control-label">Buyer’s Address <sup
                                        class="text-danger">*</sup></label>
                                <input type="text" id="buyer_address" class="form-control form-control-input"
                                    placeholder="Buyer’s Address" name="buyer_address"
                                    value="{{ old('buyer_address') }}" required />
                            </div>

                            <div class="w-100 mb-3">
                                <label class="form-label form-control-label">Buyer’s Email <sup
                                        class="text-danger">*</sup>
                                </label>
                                <input type="text" id="buyer_email" class="form-control form-control-input"
                                    placeholder="Buyer’s Email" name="buyer_email" value="{{ old('buyer_email') }}"
                                    required />
                            </div>

                            <div class="w-100 mb-3">
                                <label for="buyer_country" class="form-label form-control-label">Buyer's
                                    Country <sup class="text-danger">*</sup></label>
                                <select id="buyer_country" class="select2" name="buyer_country_id" required
                                    placeholder="Buyer's Country">
                                    <option selected disabled>Select Country</option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->id }}" @selected(old('buyer_country_id') == $country->id)>
                                            {{ $country->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- Buyer info end -->

                    {{-- <div class="mb-5">
                        <div class="d-flex align-items-center gap-3 title-2">
                            <div class="serial-number">4</div>
                            <h1 class="page-title">NOC </h1>
                        </div>
                        <div>
                            <div class="w-100 mb-3">
                                <label class="form-label form-control-label">Click to upload noc <sup
                                        class="text-danger">*</sup></label>
                                        <input type="file" name="noc_file"
                                        class="form-control form-control input-style py-2 small-text-12" required />
                            </div>
                        </div>
                    </div> --}}

                </div>

                <!-- divider -->
                <div class="divider-hr"></div>

                <!-- customer information right -->
                <div class="customer-information-right">
                    <!-- Product information start -->
                    <div class="mb-5">
                        <div class="d-flex align-items-center gap-3 title-2">
                            <div class="serial-number">4</div>
                            <h1 class="page-title">Product Information</h1>
                        </div>

                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="w-100">
                                <label class="form-label form-control-label">Product Name <sup
                                        class="text-danger">*</sup></label>
                                <input type="text" id="product_name" class="form-control form-control-input"
                                    placeholder="Product Name" name="product_name" value="{{ old('product_name') }}"
                                    required />
                            </div>

                            <div class="w-100">
                                <label class="form-label form-control-label">Manufacturing Date <sup
                                        class="text-danger">*</sup></label>
                                <input type="date" id="manufacturing_date" class="form-control form-control-input"
                                    placeholder="Product Manufactureing Date" name="manufacturing_date"
                                    value="{{ old('manufacturing_date') }}" required />
                            </div>

                        </div>

                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="w-100">
                                <label for="expired_date" class="form-label form-control-label">Product Expired
                                    Date <sup class="text-danger">*</sup></label>
                                <input type="date" id="expired_date" class="form-control form-control-input"
                                    placeholder="Product Expired Date" name="expired_date"
                                    value="{{ old('expired_date') }}" required />
                            </div>

                            <div class="w-100">
                                <label class="form-label form-control-label">Probable Date of Loading <sup
                                        class="text-danger">*</sup></label>
                                <input type="date" id="probable_date" class="form-control form-control-input"
                                    name="probable_date" value="{{ old('probable_date') }}" required />
                            </div>

                        </div>
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="w-100">
                                <label class="form-label form-control-label">Port of Loading <sup
                                        class="text-danger">*</sup></label>
                                <input type="text" id="port_loading" class="form-control form-control-input"
                                    placeholder="Port of Loading" name="port_loading" value="{{ old('port_loading') }}"
                                    required />
                            </div>

                            <div class="w-100">
                                <label class="form-label form-control-label">Port of Discharge <sup
                                        class="text-danger">*</sup></label>
                                <input type="text" id="port_discharge" class="form-control form-control-input"
                                    placeholder="Port of Discharge" name="port_discharge"
                                    value="{{ old('port_discharge') }}" required />
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="w-100">
                                <label class="form-label form-control-label">Address of consignment<sup
                                        class="text-danger">*</sup></label>
                                <input type="text" id="address_consignment" class="form-control form-control-input"
                                    placeholder="Store Address" name="address_consignment"
                                    value="{{ old('address_consignment') }}" required />
                            </div>

                            <div class="w-100 login-field">
                                <label for="consignment_country" for="form-label form-control-label"
                                    class="mb-2">Country of Consignment <sup class="text-danger">*</sup></label>
                                <select id="consignment_country" class="select2" name="consignment_country" required
                                    placeholder="Country of Consignment">
                                    <option value="">Country of Consignment</option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->id }}" @selected(old('consignment_country') == $country->id)>
                                            {{ $country->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- Product information end -->

                    <!--Shipping information start -->
                    <div class="mb-5">
                        <div class="d-flex align-items-center gap-3 title-2">
                            <div class="serial-number">5</div>
                            <h1 class="page-title">Shipping Information</h1>
                        </div>
                        <div>
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <div class="w-100">
                                    <label class="form-label form-control-label">Shipping Mark <sup
                                            class="text-danger">*</sup></label>
                                    <input type="text" id="shipping_mark" class="form-control form-control-input"
                                        placeholder="Shipping Mark" name="shipping_mark"
                                        value="{{ old('shipping_mark') }}" required />
                                </div>
                                <div class="w-100">
                                    <label class="form-label form-control-label">No. of Packing <sup
                                            class="text-danger">*</sup></label>
                                    <input type="text" id="no_packing" class="form-control form-control-input"
                                        placeholder="No. of Packing" name="no_packing" value="{{ old('no_packing') }}"
                                        required />
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <div class="w-100">
                                    <label class="form-label form-control-label">Kind of Packing <sup
                                            class="text-danger">*</sup></label>
                                    <input type="text" id="kind_packing" class="form-control form-control-input"
                                        placeholder="Kind of Packing" name="kind_packing"
                                        value="{{ old('kind_packing') }}" required />
                                </div>
                                <div class="w-100">
                                    <label class="form-label form-control-label">HS Code <sup
                                            class="text-danger">*</sup></label>
                                    <input type="text" id="hs_code" class="form-control form-control-input"
                                        placeholder="HS Code" name="hs_code" value="{{ old('hs_code') }}" required />
                                </div>
                            </div>

                            <div class="w-100 mb-3">
                                <label class="form-label form-control-label">Type of Goods <sup
                                        class="text-danger">*</sup></label>
                                <select id="type_good" class="select2 select2-hidden-accessible" name="type_good"
                                    required>
                                    <option value="" selected disabled>Type of Goods</option>
                                    @foreach ($type_goods as $type_good)
                                        <option value="{{ $type_good->id }}" @selected(old('type_good') == $type_good->id)>
                                            {{ $type_good->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="w-100 mb-3">
                                <label for="	mode_of_transport" class="form-label form-control-label">Mode of
                                    transportation <sup class="text-danger">*</sup></label>
                                <select id="mode_of_transport" class="select2 select2-hidden-accessible"
                                    name="mode_of_transport" required>
                                    <option selected disabled>Select type</option>
                                    @foreach ($modeOfTransports as $mode)
                                        <option value="{{ $mode->id }}" @selected(old('mode_of_transport') == $mode->id)>
                                            {{ $mode->name }}</option>
                                    @endforeach

                                </select>
                            </div>

                            <div class="w-100 mb-3">
                                <label class="form-label form-control-label">Description of Goods <sup
                                        class="text-danger">*</sup></label>
                                <input type="text" id="description_goods" class="form-control form-control-input"
                                    placeholder="Description of Goods" name="description_goods"
                                    value="{{ old('description_goods') }}" required />
                            </div>

                            <div class="w-100 mb-3">
                                <label class="form-label form-control-label">Temperature During Storage and Transport <sup
                                        class="text-danger">*</sup></label>
                                <input type="text" id="temperature" class="form-control form-control-input"
                                    placeholder="Enter Temperature" name="temperature" value="{{ old('temperature') }}"
                                    required />
                            </div>

                            <div class="w-100 mb-3">
                                <label class="form-label form-control-label">Net and Gross or Others Quantity <sup
                                        class="text-danger">*</sup></label>
                                <div class="d-flex align-items-center gap-3 b-3">
                                    <div class="w-100">
                                        <input type="text" id="net_weight" class="form-control form-control-input"
                                            placeholder="Enter net weight" name="net_weight"
                                            value="{{ old('net_weight') }}" required />
                                    </div>
                                    <div class="w-100">
                                        <input type="text" id="weight" class="form-control form-control-input"
                                            placeholder="Enter weight" name="weight" value="{{ old('weight') }}"
                                            required />
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <div class="w-100">
                                    <label class="form-label form-control-label">Quantity <sup
                                            class="text-danger">*</sup></label>
                                    <input type="text" id="quantity" class="form-control form-control-input"
                                        placeholder="Quantity" name="quantity" value="{{ old('quantity') }}" required />
                                </div>
                                <div class="w-100">
                                    <label for="fob_cfr_value" class="form-label form-control-label">FOB/CFR Value <sup
                                            class="text-danger">*</sup></label>
                                    <input id="fob_cfr_value" type="number" class="form-control form-control-input"
                                        placeholder="FOB/CFR Value" name="fob_cfr_value" min="1"
                                        value="{{ old('fob_cfr_value') }}" required />
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Shipping information end -->

                    <!-- Upload documents start -->
                    <div class="mb-5">
                        <div class="d-flex align-items-center gap-3 title-2">
                            <div class="serial-number">6</div>
                            <h1 class="page-title">Upload Document</h1>
                        </div>
                        <div>
                            <div class="w-100 mb-3">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped text-center">
                                        <thead>
                                            <tr>
                                                <th>Document Name</th>
                                                <th>File</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!--Uploaded Nid File-->
                                            @if (@Auth::user()->customerDetail->nid_file)
                                                <tr>
                                                    <td>NID</td>
                                                    <td>
                                                        <a href="{{ asset('upload/nid/' . Auth::user()->customerDetail->nid_file) }}"
                                                            target="_blank" class="file__btn">
                                                            <span>{{ @Auth::user()->customerDetail->nid_file }}</span>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endif

                                            @if (@Auth::user()->customerDetail->tin_file)
                                                <tr>
                                                    <td>Tin</td>
                                                    <td>
                                                        <a href="{{ asset('upload/tin/' . Auth::user()->customerDetail->tin_file) }}"
                                                            target="_blank" class="file__btn">
                                                            <span>{{ @Auth::user()->customerDetail->tin_file }}</span>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endif

                                            @if (@Auth::user()->customerDetail->bin_file)
                                                <tr>
                                                    <td>Bin</td>
                                                    <td>
                                                        <a href="{{ asset('upload/bin/' . Auth::user()->customerDetail->bin_file) }}"
                                                            target="_blank" class="file__btn">
                                                            <span>{{ @Auth::user()->customerDetail->bin_file }}</span>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endif

                                            @if (@Auth::user()->customerDetail->trade_file)
                                                <tr>
                                                    <td>Trade License</td>
                                                    <td>
                                                        <a href="{{ asset('upload/trade_license/' . Auth::user()->customerDetail->trade_file) }}"
                                                            target="_blank" class="file__btn">
                                                            <span>{{ @Auth::user()->customerDetail->trade_file }}</span>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endif

                                            @if (@Auth::user()->customerDetail->erc_file)
                                                <tr>
                                                    <td>ERC</td>
                                                    <td>
                                                        <a href="{{ asset('upload/erc/' . Auth::user()->customerDetail->erc_file) }}"
                                                            class="file__btn">
                                                            <span>{{ @Auth::user()->customerDetail->erc_file }}</span>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endif

                                        </tbody>
                                    </table>
                                </div>

                                <!-- Others document start -->
                                <h4 class="up__title">Click to upload more document</h4>

                                <div class="col-12 col-md-12 login-field mb-4">
                                    <label class="mb-2">Proforma Invoice <sup class="text-danger">*</sup></label>
                                    <input type="file" name="proforma_invoice" id="proforma_invoice"
                                        class="form-control input-style py-2 small-text-12 @error('proforma_invoice') is-invalid @enderror"
                                        accept="application/pdf" required />
                                    @error('proforma_invoice')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-12 col-md-12 login-field mb-4">
                                    <label class="mb-2">Packing List <sup class="text-danger">*</sup></label>
                                    <input type="file" name="packing_list" id="packing_list"
                                        class="form-control input-style py-2 small-text-12 @error('packing_list') is-invalid @enderror"
                                        accept="application/pdf" required />
                                    @error('packing_list')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-12 col-md-12 login-field mb-4">
                                    <label class="mb-2">Test Parameters <sup class="text-danger">*</sup></label>
                                    <input type="file" name="test_parameter" id="test_parameter"
                                        class="form-control input-style py-2 small-text-12 @error('test_parameter') is-invalid @enderror"
                                        accept="application/pdf" required />
                                    @error('test_parameter')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-12 col-md-12 login-field mb-4">
                                    <label class="mb-2">Declaration <sup class="text-danger">*</sup></label>
                                    <input type="file" name="declaration" id="declaration"
                                        class="form-control input-style py-2 small-text-12 @error('declaration') is-invalid @enderror"
                                        accept="application/pdf" required />
                                    @error('declaration')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-12 col-md-12 login-field mb-4">
                                    <label class="mb-2">Others</label>
                                    <input type="file" name="upload_document" id="upload_document"
                                        class="form-control input-style py-2 small-text-12 @error('upload_document') is-invalid @enderror"
                                        accept="application/pdf" />
                                    @error('upload_document')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <!-- Others document end -->
                            </div>
                        </div>
                    </div>
                    <!-- Upload documents end -->




                </div>



            </div>

            <!-- Preview btn -->
            <div class="preview-application mt-5 text-center">
                <a class="btn btn-info text-light preview-btn" data-bs-toggle="modal" data-bs-target="#showModal">
                    <i class="bi bi-eye"></i> Preview application</a>
            </div>

            <!-- Terms & Condistions Start-->
            <div class="form-check mt-4">
                <input id="terms_condistion" class="form-check-input" type="checkbox" name="terms_condition" value="" id="flexCheckChecked">
                <label class="form-check-label" for="flexCheckChecked">
                    I agree to these
                    <a href="#" class="text-decoration-underline" data-bs-toggle="modal"
                        data-bs-target="#termsconditionModal">
                        Terms and Conditions</a>
                </label>
            </div>
            <!-- Terms & Condistions End-->



            <!-- Payment Start -->
            <div class="payment-container d-none">
                <div class="d-flex align-items-center justify-content-center gap-3 title-2 mb-3">
                    <div class="serial-number">7</div>
                    <h1 class="page-title">Make payment</h1>
                </div>
                <!-- <h1 class="page-title text-center mb-5">Make payment</h1> -->

                <div class="mt-5">
                    <div class="account-sideNav d-flex align-items-baseline justify-content-center gap-3">
                        <p class="pay-with">Pay With:</p>
                        <ul class="nav nav-pills payment-contents">
                            <li class="nav-item">
                                <button class="nav-link payment-tap" data-bs-toggle="pill" href="#Challan"
                                    type="button" onclick="changeRoute('Challan');">
                                    Bank
                                </button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link payment-tap" data-bs-toggle="pill" href="#Card" type="button"
                                    onclick="changeRoute('Card');">
                                    Online Payment
                                </button>
                            </li>
                        </ul>
                    </div>

                    <!-- tap panel -->
                    <div class="tab-content account-mainContent">
                        <!-- Challan info start -->
                        <div class="tab-pane pt-5" id="Challan">
                            <div class="text-center">
                                <p class="mb-4">
                                    Application Fee:
                                    <strong><span class="application_fee">00</span> <span>tk</span></strong>
                                </p>
                            </div>
                            <div class="d-flex align-items-center gap-4 mb-3">
                                <div class="w-100">
                                    <label class="form-label form-control-label">Bank Name <sup class="text-danger">*</sup></label>
                                    <input type="text" class="form-control form-control-input" name="bank_name"
                                        placeholder="Bank Name" value="Agrani Bank " required />
                                </div>
                                <div class="w-100">
                                    <label class="form-label form-control-label">Branch Name <sup class="text-danger">*</sup>
                                    </label>
                                    <input type="text" class="form-control form-control-input" name="branch_name"
                                        placeholder="Branch Name"  required/>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-4 mb-3">

                                <div class="w-100">
                                    <label class="form-label form-control-label">Upload Bank Slip <sup class="text-danger">*</sup></label>
                                    <input type="file" name="bank_slip"
                                        class="form-control form-control input-style py-2 small-text-12" required />
                                </div>
                                {{-- <div class="w-100">
                                    <label class="form-label form-control-label">Upload Bank Slip
                                    </label>
                                    <div onclick="uploadPhoto('input3','display3')">
                                        <input onchange="uploadDocField(this)" type="file" id="input3" name="bank_slip" class="d-none" required/>
                                        <label for="input3" id="display3"
                                            class="upload-signature form-control input-style py-2 small-text-12">
                                            <i class="fa-solid fa-arrow-up-from-bracket"></i>
                                            <span class="ms-2">Upload document</span>
                                        </label>
                                    </div>
                                </div> --}}
                                <div class="w-100">
                                    <label class="form-label form-control-label">Date <sup class="text-danger">*</sup></label>
                                    <input type="date" class="form-control form-control-input" name="date"
                                        required />
                                </div>
                            </div>

                            {{-- <div class="form-check mb-3 mt-4">
                                <input onclick="challan(this)" class="form-check-input" type="checkbox" value=""
                                    id="flexCheckDefault" />
                                <label class="form-check-label form-control-label" for="flexCheckDefault">
                                    Is it E-challan?
                                </label>
                            </div> --}}



                            <div class="d-flex align-items-center gap-4 mb-3">
                                <div class="w-100">
                                    <label class="form-label form-control-label">Bank Amount <sup class="text-danger">*</sup></label>
                                    <input type="number" class="form-control form-control-input" name="bank_amount"
                                        placeholder="Bank Amount" required />
                                </div>

                                <div class="w-100">
                                    <input onclick="challan(this)" class="form-check-input" type="checkbox"
                                        value="" id="flexCheckDefault" name="isEchallan" />
                                    <label class="form-check-label form-control-label" for="flexCheckDefault">Is it
                                        E-challan?</label>
                                </div>
                            </div>

                            <div class="d-flex align-items-center gap-4 mb-3">
                                <div class="w-100">
                                    <label class="form-label form-control-label">Certificate VAT Challan No. <sup class="text-danger">*</sup></label>
                                    <input type="text" class="form-control form-control-input"
                                        placeholder="VAT challan no" name="certificate_vat_challan" required />
                                </div>
                                <div class="w-100">
                                    <label class="form-label form-control-label">BFSA VAT Challan No. <sup class="text-danger">*</sup>
                                    </label>
                                    <input type="text" class="form-control form-control-input" name="bfsa_vat_challan"
                                        placeholder="VAT challan no" required />
                                </div>
                            </div>

                            <div class="d-flex align-items-center gap-4 mb-3">
                                <div class="w-100">
                                    <label class="form-label form-control-label">VAT Amount <span
                                            class="text-danger"><sup>*[15%]</sup></span></label>
                                    <input type="number" class="form-control form-control-input"
                                        placeholder="VAT amount" name="vat_amount" required />
                                </div>
                                <div class="w-100">
                                    <label class="form-label form-control-label">Tax Amount <span
                                            class="text-danger"><sup>*[10%]</sup></span>
                                    </label>
                                    <input type="number" class="form-control form-control-input" name="tax_amount"
                                        placeholder="Tax amount" required />
                                </div>
                            </div>

                            <div id="bank-slip" class="d-block">
                                <div class="d-flex align-items-center gap-4 mt-3">
                                    <div class="w-100">
                                        <label class="form-label form-control-label">Upload Certificate VAT Challan <sup class="text-danger">*</sup></label>
                                        <input type="file" name="certificate_challan_file"
                                            class="form-control form-control input-style py-2 small-text-12" required />
                                    </div>
                                    <div class="w-100">
                                        <label class="form-label form-control-label">Upload BFSA VAT Challan <sup class="text-danger">*</sup></label>
                                        <input type="file" name="bfsa_challan_file"
                                            class="form-control form-control input-style py-2 small-text-12" required />
                                    </div>
                                </div>
                            </div>

                            <!-- <div id="bank-slip" class="w-100 d-none">
                                                                                    <label class="form-label form-control-label"
                                                                                      >Upload Bank Slip
                                                                                    </label>
                                                                                    <div onclick="uploadPhoto('input3','display3')">
                                                                                      <input
                                                                                        onchange="uploadDocField(this)"
                                                                                        type="file"
                                                                                        id="input3"
                                                                                        name="description-plant"
                                                                                        class="d-none"
                                                                                      />
                                                                                      <label
                                                                                        for="input3"
                                                                                        id="display3"
                                                                                        class="upload-signature form-control input-style py-2 small-text-12"
                                                                                      >
                                                                                        <i class="fa-solid fa-arrow-up-from-bracket"></i>
                                                                                        <span class="ms-2">Upload document</span>
                                                                                      </label>
                                                                                    </div>
                                                                                  </div> -->

                            <div class="mt-5 text-center">
                                <button class="btn btn-continue">
                                    Pay and Download Application Form
                                </button>
                            </div>
                        </div>
                        <!-- Challan info end -->

                        <!-- Card start -->
                        <div class="tab-pane fade pt-5 text-center d-flex justify-content-center align-items-center flex-column"
                            id="Card">
                            {{-- <p class="mb-3">
                                Application Fee:
                                <strong><span class="application_fee">00</span> <span>tk</span></strong>
                            </p>
                            <p class="mb-3">
                                Payable amount:
                                <strong><span class="pay_now"></span> </strong>
                            </p> --}}

                            <!-- Application fee -->
                            <div class="col-md-6 mx-auto">
                                <table class="table border">
                                    <tr>
                                        <td class="text-end"><strong>Application Fee</strong> </td>
                                        <td>:</td>
                                        <td>
                                            <span class="application_fee"></span>
                                            BDT
                                            <input type="hidden" class="application_fee" name="online_fee"
                                                value="">
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="text-end"><strong>Vat(15%)</strong></td>
                                        <td>:</td>
                                        <td>
                                            <span class="vat_amount"></span>
                                            BDT
                                            <input type="hidden" class="vat_amount" name="online_vat" value="">
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="text-end"><strong>Tax(10%)</strong></td>
                                        <td>:</td>
                                        <td>
                                            <span class="tax_amount"></span>
                                            BDT
                                            <input type="hidden" class="tax_amount" name="online_tax" value="">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-end"><strong>Total</strong></td>
                                        <td>:</td>
                                        <td>
                                            <span class="total_amount"></span>
                                            BDT
                                            <input type="hidden" class="total_amount" name="online_total"
                                                value="">
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <div>
                                <button class="btn btn-application" type="submit" disabled>
                                    Pay Now
                                    <span class="pay_amount"></span>
                                </button>
                            </div>

                            <!-- payment image -->
                            <div class="payment-img">
                                <img src="{{ asset('backend/asset/image/sslcommerzPayment.png') }}"
                                    class="max-width: 100%" alt="" />
                            </div>

                        </div>
                        <!-- Card end -->
                    </div>


                </div>
            </div>
            <!--Payment End -->
        </form>
    </div>
    <!-- main body content end -->

    <!--Preview modal start-->
    <div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="showModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="showModalLabel">Preview</h5>
                    <button type="button" class="close px-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="fs-4" aria-hidden="true">&times;</span>
                    </button>

                </div>
                <div class="modal-body">
                    <div class="card" style="width: 100%;" id="modal_body">



                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Preview modal end-->

    <!--Terms condition modal end-->
    <div class="modal fade" id="termsconditionModal" tabindex="-1" role="dialog"
        aria-labelledby="termsconditionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="termsconditionModalLabel">Terms & conditions</h5>
                    <button type="button" class="btn" data-bs-dismiss="modal">Close</button>
                </div>
                <div class="modal-body">
                    {{-- <div class="card" style="width: 100%;" id="modal_body"> --}}
                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Accusantium accusamus enim modi, odit
                            laudantium eligendi recusandae a totam soluta dolores doloremque neque optio fuga, quod quasi
                            itaque labore, ex nulla.</p>
                    {{-- </div> --}}
                </div>
            </div>
        </div>
    </div>
    <!--Terms condition  modal end-->
@endsection

@push('js')
    <script src="{{ asset('backend/js/uploadFile.js') }}"></script>
    <script src="{{ asset('backend/js/payment.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>

    <script>
        $(document).ready(function() {
            /************* customer mobile number validation *************/
            $("#basic-form").validate({
                rules: {
                    // birth_reg_num : {
                    //     required: true,
                    //     number: true
                    //     // minlength: 11,
                    //     // maxlength: 11
                    // },

                    erc_no: {
                        required: true,
                    }
                }
            });
        });


        $("#division").change(function() {
            var id = $(this).val();
            $.ajax({
                url: "{{ url('get-division') }}/" + id,
                type: 'get',
                success: function(data) {
                    $('select[name="district"]').empty();
                    $.each(data, function(key, data) {
                        $('select[name="district"]').append('<option value="' + data.id + '">' +
                            data.name + '</option>');
                    })
                }
            })
        });

        //___________TAB WISE ROUTE CHANGE__________//
        function changeRoute(params) {
            if (params == 'Challan') {
                $('#basic-form').attr('action', '{{ route('application.store') }}');
            } else if (params == 'Card') {
                $('#basic-form').attr('action', '{{ url('/pay') }}');
            }
        }

        $('#terms_condistion').click(function(){
            if($(this).prop("checked") == true){
                // alert("Checkbox is checked.");
                $('.payment-container').removeClass('d-none');
            }
            else if($(this).prop("checked") == false){
                // alert("Checkbox is unchecked.");
                $('.payment-container').addClass('d-none');
            }
        });

        //Fee calculate

        //    console.log(fobValue);
        $('#fob_cfr_value').keyup(function() {
            var fobValue = $(this).val();
            // alert(fobValue);
            if (fobValue != 0 && fobValue != '') {
                // alert('not empty');
                $.ajax({
                    url: "{{ route('application.fee') }}",
                    type: 'get',
                    data: {
                        fobValue: fobValue
                    },
                    success: function(data) {
                        // console.log(data);
                        $('.application_fee').html(data.fee);
                        $('.application_fee').val(data.fee);

                        $('.vat_amount').html(data.vat);
                        $('.vat_amount').val(data.vat);

                        $('.tax_amount').html(data.tax);
                        $('.tax_amount').val(data.tax);

                        $('.total_amount').html(data.total_amount);
                        $('.total_amount').val(data.total_amount);

                        $('.pay_amount').html('BDT ' + data.total_amount);
                        $('.btn-application').removeAttr('disabled');

                    }
                })
            } else {
                // alert('empty');
                $('.application_fee').html('00');
                $('.vat_amount').html('00');
                $('.tax_amount').html('00');
                $('.total_amount').html('00');
                $('.btn-application').attr('disabled', true);
            }


        });



        //Preview
        var manufacturerCountryName, typeOfGoodsName, modeOfTransport, consignmentCountry;


        $('#manufacturer_country').change(function() {
            manufacturerCountryName = $(this).find("option:selected").text();
        });

        $('#type_good').change(function() {
            typeOfGoodsName = $(this).find("option:selected").text();
        });

        $('#mode_of_transport').change(function() {
            modeOfTransport = $(this).find("option:selected").text();
        });

        $('#consignment_country').change(function() {
            consignmentCountry = $(this).find("option:selected").text();
        });

        $('#buyer_country').change(function() {
            buyerCountry = $(this).find("option:selected").text();
        });

        $(".preview-btn").click(function() {
            let inputData = {
                erc_no: $('#erc_no').val(),
                exporter_name: $('#exporter_name').val(),
                nid_no: $('#nid').val(),
                company_name: $('#company_name').val(),
                exporter_address: $('#exporter_address').val(),
                division: $('#division').val(),
                district: $('#district').val(),
                invoice_no: $('#invoice_no').val(),
                invoice_date: $('#invoice_date').val(),
                lc_no: $('#lc_no').val(),
                lc_date: $('#lc_date').val(),
                manufacturer_name: $('#manufacturer_name').val(),
                manufacturer_address: $('#manufacturer_address').val(),
                manufacturer_country: manufacturerCountryName,
                buyer_name: $('#buyer_name').val(),
                buyer_address: $('#buyer_address').val(),
                buyer_email: $('#buyer_email').val(),
                buyer_country: buyerCountry,
                product_name: $('#product_name').val(),
                manufacturing_date: $('#manufacturing_date').val(),
                expired_date: $('#expired_date').val(),
                probable_date: $('#probable_date').val(),
                port_loading: $('#port_loading').val(),
                port_discharge: $('#port_discharge').val(),
                address_consignment: $('#address_consignment').val(),
                consignment_country: consignmentCountry,
                shipping_mark: $('#shipping_mark').val(),
                no_packing: $('#no_packing').val(),
                kind_packing: $('#kind_packing').val(),
                hs_code: $('#hs_code').val(),
                type_good: typeOfGoodsName,
                mode_of_transport: modeOfTransport,
                description_goods: $('#description_goods').val(),
                temperature: $('#temperature').val(),
                net_weight: $('#net_weight').val(),
                weight: $('#weight').val(),
                quantity: $('#quantity').val(),
                fob_cfr_value: $('#fob_cfr_value').val(),
            };
            let arrayString = JSON.stringify(inputData);

            sessionStorage.setItem("storedArray", arrayString);
            var storedArrayString = sessionStorage.getItem("storedArray");
            var storedArray = JSON.parse(storedArrayString);

            var html = `<div class="customer-information-content">
                        <!-- customer information left -->
                        <div class="customer-information-left">
                            <!-- Exporter info start -->
                            <div class="mb-5">
                                <div class="d-flex align-items-center gap-3 title-2">
                                    <div class="serial-number">1</div>
                                    <h1 class="page-title">Exporter’s Information</h1>
                                </div>

                                <div class="mb-3">
                                    <!--Exporter's name start-->
                                    <div class="w-100">
                                        <span><strong>Exporter’s Name:</strong> ` + (storedArray['exporter_name'] ?
                storedArray['exporter_name'] : 'N/A') + `</span>
                                    </div>
                                    <!--Exporter's name end-->

                                    <!--Company name start-->
                                    <div class="w-100">
                                        <span> <strong>Company Name:</strong> ` + (storedArray['company_name'] ?
                storedArray['company_name'] : 'N/A') + `</span>
                                    </div>
                                    <!--Company name end-->

                                    <!--NID no strat-->
                                    <div class="w-100">
                                        <span> <strong>National ID:</strong> ` + (storedArray['nid_no'] ? storedArray[
                'nid_no'] : 'N/A') + ` </span>
                                    </div>
                                    <!--NID no end-->

                                    <!--ERC no start-->
                                    <div class="w-100">
                                        <span> <strong>ERC No.:</strong> ` + (storedArray['erc_no'] ? storedArray[
                'erc_no'] : 'N/A') + `</span>
                                    </div>
                                    <!--ERC no end-->

                                    <!--Exporter address start-->
                                    <div class="w-100">
                                        <span> <strong>Exporter Address: </strong> ` + (storedArray[
                'exporter_address'] ? storedArray['exporter_address'] : 'N/A') + `</span>
                                    </div>
                                    <!--Exporter address end-->

                                    <!--Division start-->
                                    <div class="w-100">
                                        <span> <strong>Division:</strong> ` + (storedArray['division'] ? storedArray[
                'division'] : 'N/A') + `</span>
                                    </div>
                                    <!--Division end-->

                                    <!--District start-->
                                    <div class="w-100">
                                        <span> <strong>District:</strong> ` + (storedArray['district'] ? storedArray[
                'district'] : 'N/A') + `</span>
                                    </div>
                                    <!--District end-->

                                    <!-- Invoice No. Start-->
                                    <div class="w-100">
                                        <span> <strong>Invoice No.:</strong> ` + (storedArray['invoice_no'] ?
                storedArray['invoice_no'] : 'N/A') + `</span>
                                    </div>
                                    <!-- Invoice No. End-->

                                    <!-- Invoice Date Start-->
                                    <div class="w-100">
                                        <span> <strong>Invoice Date:</strong> ` + (storedArray['invoice_date'] ?
                storedArray['invoice_date'] : 'N/A') + `</span>
                                    </div>
                                    <!-- Invoice Date End-->

                                    <!-- Contract/LC No. Start -->
                                    <div class="w-100">
                                        <span> <strong>Contract/LC No.:</strong> ` + (storedArray['lc_no'] ?
                storedArray['lc_no'] : 'N/A') + `</span>
                                    </div>
                                    <!-- Contract/LC No. End -->

                                    <!-- Contract/LC No. Date Start -->
                                    <div class="w-100">
                                        <span> <strong>Contract/LC No. Date:</strong> ` + (storedArray['lc_date'] ?
                storedArray['lc_date'] : 'N/A') + `</span>
                                    </div>
                                    <!-- Contract/LC No. Date End -->

                                </div>
                            </div>
                            <!-- Exporter info end -->

                            <!-- Manufacturer’s Information start -->
                            <div class="mb-5">
                                <div class="d-flex align-items-center gap-3 title-2">
                                    <div class="serial-number">2</div>
                                    <h1 class="page-title">Manufacturer’s Information</h1>
                                </div>
                                <div>
                                    <!-- Manufacturer's Name Start -->
                                    <div class="w-100">
                                        <span><strong>Manufacturer's Name:</strong> ` + (storedArray[
                'manufacturer_name'] ? storedArray['manufacturer_name'] : 'N/A') + `</span>
                                    </div>
                                    <!-- Manufacturer's Name Start -->

                                    <!-- Manufacturers Address Start -->
                                    <div class="w-100">
                                        <span><strong>Manufacturers Address:</strong> ` + (storedArray[
                'manufacturer_address'] ? storedArray['manufacturer_address'] : 'N/A') + `</span>
                                    </div>
                                    <!-- Manufacturers Address End -->

                                    <!-- Manufacturers Country Start -->
                                    <div class="w-100">
                                        <span><strong>Manufacturers Country:</strong> ` + (storedArray[
                'manufacturer_country'] ? storedArray['manufacturer_country'] : 'N/A') + `</span>
                                    </div>
                                    <!-- Manufacturers Country End -->
                                </div>
                            </div>
                            <!-- Manufacturer’s Information end -->

                            <!-- Buyer info start -->
                            <div class="mb-5">
                                <div class="d-flex align-items-center gap-3 title-2">
                                    <div class="serial-number">3</div>
                                    <h1 class="page-title">Buyer’s Information</h1>
                                </div>
                                <div>
                                    <div class="w-100">
                                        <span><strong>Buyer’s Name:</strong> ` + (storedArray['buyer_name'] ?
                storedArray['buyer_name'] : 'N/A') + `</span>
                                    </div>

                                    <div class="w-100">
                                        <span><strong>Buyer’s Address:</strong> ` + (storedArray['buyer_address'] ?
                storedArray['buyer_address'] : 'N/A') + `</span>
                                    </div>

                                    <div class="w-100">
                                        <span><strong>Buyer’s Email:</strong> ` + (storedArray['buyer_email'] ?
                storedArray['buyer_email'] : 'N/A') + `</span>
                                    </div>

                                    <div class="w-100">
                                        <span><strong>Buyer’s Country:</strong> ` + (storedArray['buyer_country'] ?
                storedArray['buyer_country'] : 'N/A') + `</span>
                                    </div>
                                </div>
                            </div>
                            <!-- Buyer info end -->

                        </div>

                        <!-- divider -->
                        <div class="divider-hr"></div>

                        <!-- customer information right -->
                        <div class="customer-information-right">
                            <!-- Shipping information start -->
                            <div class="mb-5">
                                <div class="d-flex align-items-center gap-3 title-2">
                                    <div class="serial-number">4</div>
                                    <h1 class="page-title">Shipping Information</h1>
                                </div>

                                <div class="w-100">
                                    <span><strong>Product Name:</strong> ` + (storedArray['product_name'] ?
                storedArray['product_name'] : 'N/A') + `</span>
                                </div>

                                <div class="w-100">
                                    <span><strong>Manufacturing Date:</strong> ` + (storedArray['manufacturing_date'] ?
                storedArray['manufacturing_date'] : 'N/A') + `</span>
                                </div>

                                <div class="w-100">
                                    <span><strong>Product Expired Date:</strong> ` + (storedArray['expired_date'] ?
                storedArray['expired_date'] : 'N/A') + `</span>
                                </div>

                                <div class="w-100">
                                    <span><strong>Probable Date of Loading:</strong> ` + (storedArray[
                'probable_date'] ? storedArray['probable_date'] : 'N/A') + `</span>
                                </div>

                                <div class="w-100">
                                    <span><strong>Port of Loading:</strong> ` + (storedArray['port_loading'] ?
                storedArray['port_loading'] : 'N/A') + `</span>
                                </div>

                                <div class="w-100">
                                    <span><strong>Port of Discharge:</strong> ` + (storedArray['port_discharge'] ?
                storedArray['port_discharge'] : 'N/A') + `</span>
                                </div>

                                <div class="w-100">
                                    <span><strong>Address of consignment:</strong> ` + (storedArray[
                'address_consignment'] ? storedArray['address_consignment'] : 'N/A') + `</span>
                                </div>

                                <div class="w-100 login-field">
                                    <span><strong>Country of Consignment:</strong> ` + (storedArray[
                'consignment_country'] ? storedArray['consignment_country'] : 'N/A') + `</span>
                                </div>
                            </div>
                            <!-- Shipping information end -->

                            <!--Product information start -->
                            <div class="mb-5">
                                <div class="d-flex align-items-center gap-3 title-2">
                                    <div class="serial-number">5</div>
                                    <h1 class="page-title">Product Information</h1>
                                </div>
                                <div>
                                    <div class="w-100">
                                        <span><strong>Shipping Mark:</strong> ` + (storedArray['shipping_mark'] ?
                storedArray['shipping_mark'] : 'N/A') + `</span>
                                    </div>

                                    <div class="w-100">
                                        <span><strong>No. of Packing:</strong> ` + (storedArray['no_packing'] ?
                storedArray['no_packing'] : 'N/A') + `</span>
                                    </div>

                                    <div class="w-100">
                                        <span><strong>Kind of Packing:</strong> ` + (storedArray['kind_packing'] ?
                storedArray['kind_packing'] : 'N/A') + `</span>
                                    </div>

                                    <div class="w-100">
                                        <span><strong>HS Code:</strong> ` + (storedArray['hs_code'] ? storedArray[
                'hs_code'] : 'N/A') + `</span>
                                    </div>


                                    <div class="w-100">
                                        <span><strong>Type of Goods:</strong> ` + (storedArray['type_good'] ?
                storedArray['type_good'] : 'N/A') + `</span>
                                    </div>

                                    <div class="w-100">
                                        <span><strong>Mode of transportation:</strong> ` + (storedArray[
                'mode_of_transport'] ? storedArray['mode_of_transport'] : 'N/A') + `</span>
                                    </div>

                                    <div class="w-100">
                                        <span><strong>Description of Goods:</strong> ` + (storedArray[
                'description_goods'] ? storedArray['description_goods'] : 'N/A') + `</span>
                                    </div>

                                    <div class="w-100">
                                        <span><strong>Temperature During Storage and Transport:</strong> ` + (
                storedArray['temperature'] ? storedArray['temperature'] : 'N/A') + `</span>
                                    </div>

                                    <div class="w-100 mb-3">
                                       <span> <strong>Net and Gross or Others:</strong></span>
                                        <div class="d-flex align-items-center gap-3 b-3">
                                            <div class="w-100">
                                                <span> <strong>Net weight-</strong> ` + (storedArray['net_weight'] ?
                storedArray['net_weight'] : 'N/A') + `</span>
                                            </div>
                                            <div class="w-100">
                                                <span> <strong>Weight-</strong> ` + (storedArray['weight'] ?
                storedArray['weight'] : 'N/A') + `</span>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="w-100">
                                            <span><strong>Quantity:</strong> ` + (storedArray['quantity'] ?
                storedArray['quantity'] : 'N/A') + `</span>
                                        </div>
                                        <div class="w-100">
                                            <span><strong>FOB/CFR Value:</strong> ` + (storedArray['fob_cfr_value'] ?
                storedArray['fob_cfr_value'] + ' BDT' : 'N/A') + `</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--Product information end -->

                        </div>

                    </div>`
            $("#modal_body").html(html);
        });
    </script>

    {{-- <script>
        var obj = {};
        obj.cus_name = $('#customer_name').val();
        obj.cus_phone = $('#mobile').val();
        obj.cus_email = $('#email').val();
        obj.cus_addr1 = $('#address').val();
        obj.amount = $('#total_amount').val();

        $('#sslczPayBtn').prop('postdata', obj);
    </script>

    <script>
        (function (window, document) {
            var loader = function () {
                var script = document.createElement("script"), tag = document.getElementsByTagName("script")[0];
                script.src = "https://sandbox.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7);
                tag.parentNode.insertBefore(script, tag);
            };

            window.addEventListener ? window.addEventListener("load", loader, false) : window.attachEvent("onload", loader);
        })(window, document);
    </script> --}}
@endpush
