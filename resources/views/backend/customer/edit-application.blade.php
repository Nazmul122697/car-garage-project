@extends('backend.master')

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
    </style>
@endpush

@section('content')
    <!-- main body content start -->
    <div class="main-container">
        <form action="{{route('application.update',['app_id' => $application->id])}}" method="POST" id="basic-form" enctype="multipart/form-data">
            @csrf

            {{-- HIDDEN ITEMS START HERE --}}
            <input type="hidden" name="total_amount" value="500">


            <div class="customer-information-content">
                <!-- customer-information-left start -->
                <div class="customer-information-left">
                    <!-- Exporter’s Information start-->
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
                                <input type="text" class="form-control form-control-input" placeholder="ERC No."
                                    name="erc_no" value="{{ @Auth::user()->customerDetail->erc_no }}" readonly required />
                            </div>
                            <!--ERC no end-->

                            <!--Exporter's name start-->
                            <div class="w-100">
                                <label class="form-label form-control-label">Exporter’s Name <sup
                                        class="text-danger">*</sup></label>
                                <input type="text" class="form-control form-control-input" placeholder="Exporter’s Name"
                                    name="exporter_name" value="{{ @Auth::user()->name }}" readonly required />
                            </div>
                            <!--Exporter's name end-->

                        </div>


                        <div class="d-flex align-items-center gap-3 mb-3">
                            <!--NID no strat-->
                            <div class="w-100">
                                <label class="form-label form-control-label">National ID</label>
                                <input type="text" class="form-control form-control-input" placeholder="National ID"
                                    name="nid" value="{{ @Auth::user()->customerDetail->nid_no }}" readonly required />
                            </div>
                            <!--NID no end-->

                            <!--Company name start-->
                            <div class="w-100">
                                <label class="form-label form-control-label">Company Name
                                </label>
                                <input type="text" class="form-control form-control-input" placeholder="Company Name"
                                    name="company_name" readonly required
                                    value="{{ @Auth::user()->customerDetail->company_name }}" />
                            </div>
                            <!--Company name end-->
                        </div>

                        <!--Exporter address start-->
                        <div class="w-100 mb-3">
                            <label class="form-label form-control-label">Exporter Address <sup
                                    class="text-danger">*</sup></label>
                            <input type="text" class="form-control form-control-input" placeholder="Street address"
                                value="{{@$application->exporter_address}}" name="exporter_address" required />
                        </div>
                        <!--Exporter address end-->

                        <div class="d-flex align-items-center gap-3 mb-3">
                            <!--Division start-->
                            <div class="w-100">
                                <label class="form-label form-control-label">Division<sup
                                        class="text-danger">*</sup></label>
                                <input type="text" name="division"
                                    class="form-control form-control-input" readonly required
                                    value="{{ @Auth::user()->divisionName->name }} ({{ @Auth::user()->divisionName->bn_name }})">
                            </div>
                            <!--Division end-->

                            <!--District start-->
                            <div class="w-100">
                                <label class="form-label form-control-label">District<sup
                                        class="text-danger">*</sup></label>
                                <input type="text" name="district" class="form-control form-control-input" readonly
                                    required value="{{ @Auth::user()->districtName->name }} ({{ @Auth::user()->districtName->bn_name }})">
                            </div>
                            <!--District end-->
                        </div>


                        <div class="d-flex align-items-center gap-3 mb-3">
                            <!--Invoice No. start-->
                            <div class="w-100">
                                <label class="form-label form-control-label">Invoice No. <sup
                                        class="text-danger">*</sup></label>
                                <input type="text" class="form-control form-control-input" placeholder="Invoice No."
                                    value="{{@$application->invoice_no}}" name="invoice_no" required />
                            </div>
                            <!--Invoice No. end-->

                            <!--Invoice Date start-->
                            <div class="w-100">
                                <label class="form-label form-control-label">Invoice Date <sup
                                        class="text-danger">*</sup></label>
                                <input type="date" class="form-control form-control-input" placeholder="Select date"
                                    value="{{@$application->invoice_date}}" name="invoice_date" required />
                            </div>
                            <!--Invoice Date end-->
                        </div>

                        <div class="d-flex align-items-center gap-3 mb-3">
                            <!-- Contract/LC No. start-->
                            <div class="w-100">
                                <label class="form-label form-control-label">Contract/LC No. <sup
                                        class="text-danger">*</sup></label>
                                <input type="text" class="form-control form-control-input" placeholder="Contract/LC No."
                                    value="{{@$application->lc_no}}" name="lc_no" required />
                            </div>
                            <!-- Contract/LC No. end-->

                            <!-- Contract/LC No. Date start-->
                            <div class="w-100">
                                <label class="form-label form-control-label">Contract/LC No. Date <sup
                                        class="text-danger">*</sup></label>
                                <input type="date" class="form-control form-control-input" placeholder="Select date"
                                    value="{{@$application->lc_date}}" name="lc_date" required />
                            </div>
                            <!-- Contract/LC No. Date end-->
                        </div>
                    </div>
                    <!-- Exporter’s Information end-->

                    <!-- Manufacturer’s Information start-->
                    <div class="mb-5">
                        <div class="d-flex align-items-center gap-3 title-2">
                            <div class="serial-number">2</div>
                            <h1 class="page-title">Manufacturer’s Information</h1>
                        </div>
                        <div>
                            <div class="w-100 mb-3">
                                <label class="form-label form-control-label">Manufacturers Name <sup
                                        class="text-danger">*</sup></label>
                                <input type="text" class="form-control form-control-input"
                                    placeholder="Manufacturers Name"
                                    value="{{@$application->manufacturer_name}}"
                                    name="manufacturer_name" required />
                            </div>
                            <div class="w-100 mb-3">
                                <label class="form-label form-control-label">Manufacturers Address <sup
                                        class="text-danger">*</sup></label>
                                <input type="text" class="form-control form-control-input"
                                    placeholder="Manufacturers Address"
                                    value="{{@$application->manufacturer_address}}"
                                    name="manufacturer_address" required />
                            </div>
                        </div>
                    </div>
                    <!-- Manufacturer’s Information end-->

                    <!-- Buyer’s Information start-->
                    <div class="mb-5">
                        <div class="d-flex align-items-center gap-3 title-2">
                            <div class="serial-number">3</div>
                            <h1 class="page-title">Buyer’s Information</h1>
                        </div>
                        <div>
                            <!-- Buyer Name start-->
                            <div class="w-100 mb-3">
                                <label class="form-label form-control-label">Buyer’s Name <sup
                                        class="text-danger">*</sup></label>
                                <input type="text" class="form-control form-control-input" placeholder="Buyer’s Name"
                                    value="{{@$application->buyer_name}}"
                                    name="buyer_name" required />
                            </div>
                            <!-- Buyer Name end-->

                            <!-- Buyer Address start-->
                            <div class="w-100 mb-3">
                                <label class="form-label form-control-label">Buyer’s Address <sup
                                        class="text-danger">*</sup></label>
                                <input type="text" class="form-control form-control-input"
                                    placeholder="Buyer’s Address"
                                    value="{{@$application->buyer_address}}"
                                    name="buyer_address" required />
                            </div>
                            <!-- Buyer Address end-->

                            <div class="w-100 mb-3">
                                <label class="form-label form-control-label">Buyer’s Email
                                </label>
                                <input type="text" class="form-control form-control-input"
                                    placeholder="Buyer’s Email"
                                    value="{{@$application->buyer_email}}"
                                    name="buyer_email" required />
                            </div>
                        </div>
                    </div>
                    <!-- Buyer’s Information end-->

                </div>
                <!-- customer-information-left end -->

                <div class="divider-hr"></div>

                <!-- customer-information-right start -->
                <div class="customer-information-right">
                    <!--Product Information start-->
                    <div class="mb-5">
                        <div class="d-flex align-items-center gap-3 title-2">
                            <div class="serial-number">4</div>
                            <h1 class="page-title">Product Information</h1>
                        </div>
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <!-- Product Name start-->
                            <div class="w-100">
                                <label class="form-label form-control-label">Product Name</label>
                                <input type="text" class="form-control form-control-input"
                                    placeholder="Product Name"
                                    value="{{@$application->product_name}}"
                                    name="product_name" required />
                            </div>
                            <!--Product Name end -->

                            <!-- Probable Date of Loadinge start-->
                            <div class="w-100">
                                <label class="form-label form-control-label">Probable Date of Loading <sup
                                        class="text-danger">*</sup></label>
                                <input type="date" class="form-control form-control-input"
                                    value="{{@$application->probable_date}}"
                                    name="probable_date"
                                    required />
                            </div>
                            <!-- Probable Date of Loading end -->

                        </div>

                        <div class="d-flex align-items-center gap-3 mb-3">
                            <!-- Port of Loading start -->
                            <div class="w-100">
                                <label class="form-label form-control-label">Port of Loading <sup
                                        class="text-danger">*</sup></label>
                                <input type="text" class="form-control form-control-input"
                                    placeholder="Port of Loading"
                                    value="{{@$application->port_loading}}"
                                    name="port_loading" required />
                            </div>
                            <!-- Port of Loading end -->

                            <!-- Port of Loading start -->
                            <div class="w-100">
                                <label class="form-label form-control-label">Port of Discharge <sup
                                        class="text-danger">*</sup></label>
                                <input type="text" class="form-control form-control-input"
                                    placeholder="Port of Discharge"
                                    value="{{@$application->port_discharge}}"
                                    name="port_discharge" required />
                            </div>
                            <!-- Port of Loading start -->
                        </div>
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <!-- Address of consignment start -->
                            <div class="w-100">
                                <label class="form-label form-control-label">Address of consignment<sup
                                        class="text-danger">*</sup></label>
                                <input type="text" class="form-control form-control-input"
                                    placeholder="Store Address"
                                    value="{{@$application->address_consignment}}"
                                    name="address_consignment" required />
                            </div>
                            <!-- Address of consignment end -->

                            <!-- Country of Consignment start-->
                            <div class="w-100 login-field">
                                <label for="form-label form-control-label" class="mb-2">Country of Consignment</label>
                                <select class="select2" name="consignment_country" required placeholder="Country of Consignment">
                                    <option value="">Country of Consignment</option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->id }}" {{@$application->consignment_country == $country->id ? 'selected' : ''}}>{{ $country->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- Country of Consignment end -->
                        </div>
                    </div>
                    <!--Product Information start-->

                    <!-- Shipping Information start -->
                    <div class="mb-5">
                        <div class="d-flex align-items-center gap-3 title-2">
                            <div class="serial-number">5</div>
                            <h1 class="page-title">Shipping Information</h1>
                        </div>
                        <div>
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <!-- Shipping mark start -->
                                <div class="w-100">
                                    <label class="form-label form-control-label">Shipping Mark <sup
                                            class="text-danger">*</sup></label>
                                    <input type="text" class="form-control form-control-input"
                                        placeholder="Shipping Mark"
                                        name="shipping_mark"
                                        value="{{@$application->shipping_mark}}" required />
                                </div>
                                <!-- Shipping mark end -->

                                <!-- No. of Packing start -->
                                <div class="w-100">
                                    <label class="form-label form-control-label">No. of Packing <sup
                                            class="text-danger">*</sup></label>
                                    <input type="text" class="form-control form-control-input"
                                        placeholder="No. of Packing"
                                        value="{{@$application->no_packing}}"
                                        name="no_packing" required />
                                </div>
                                <!-- No. of Packing end -->
                            </div>
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <!-- Kind of packaging start-->
                                <div class="w-100">
                                    <label class="form-label form-control-label">Kind of Packing <sup
                                            class="text-danger">*</sup></label>
                                    <input type="text" class="form-control form-control-input"
                                        placeholder="Kind of Packing"
                                        value="{{@$application->kind_packing}}"
                                        name="kind_packing" required />
                                </div>
                                <!-- Kind of packaging end-->

                                <!-- HS Code start-->
                                <div class="w-100">
                                    <label class="form-label form-control-label">HS Code <sup
                                            class="text-danger">*</sup></label>
                                    <input type="text" class="form-control form-control-input"
                                        placeholder="HS Code"
                                        value="{{@$application->hs_code}}"
                                        name="hs_code" required />
                                </div>
                                <!-- Hs code end-->

                            </div>

                            <!-- Type of goods start -->
                            <div class="w-100 mb-3">
                                <label class="form-label form-control-label">Type of Goods <sup
                                        class="text-danger">*</sup></label>
                                <select class="select2 select2-hidden-accessible" name="type_good" required>
                                    <option value="" selected disabled>Type of Goods</option>
                                    @foreach ($type_goods as $type_good)
                                        <option value="{{ $type_good->id }}" {{@$application->type_good_id == $type_good->id ? 'selected' : ''}}>
                                            {{ $type_good->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- Type of Type of goods end -->

                            <!-- Description of Goods start -->
                            <div class="w-100 mb-3">
                                <label class="form-label form-control-label">Description of Goods <sup
                                        class="text-danger">*</sup></label>
                                <input type="text" class="form-control form-control-input"
                                    placeholder="Description of Goods"
                                    value="{{@$application->description_goods}}"
                                    name="description_goods" required />
                            </div>
                            <!-- Description of Goods end -->

                            <div class="d-flex align-items-center gap-3 mb-3">
                                <!-- Quantity start -->
                                <div class="w-100">
                                    <label class="form-label form-control-label">Quantity <sup
                                            class="text-danger">*</sup></label>
                                    <input type="text" class="form-control form-control-input"
                                        placeholder="Quantity"
                                        value="{{@$application->quantity}}"
                                        name="quantity" required />
                                </div>
                                <!-- Quantity end -->

                                <!-- FOB/CFR Value start -->
                                <div class="w-100">
                                    <label for="fob_cfr_value" class="form-label form-control-label">FOB/CFR Value <sup
                                            class="text-danger">*</sup></label>
                                    <input id="fob_cfr_value" type="number" class="form-control form-control-input"
                                        placeholder="FOB/CFR Value"
                                        value="{{@$application->fob_cfr_value}}"
                                        name="fob_cfr_value" min="1" required readonly/>
                                </div>
                                <!-- FOB/CFR Value end -->
                            </div>
                        </div>
                    </div>
                    <!-- Shipping Information end -->

                    {{-- <div class="mb-5">
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
                                            @if (@Auth::user()->customerDetail->tin_file)
                                                <tr>
                                                    <td>Tin</td>
                                                    <td>
                                                        <a href="{{ route('customer.details.download', ['type' => 'tin']) }}"
                                                            class="file__btn">
                                                            <span>{{ @Auth::user()->customerDetail->tin_file }}</span>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endif

                                            @if (@Auth::user()->customerDetail->bin_file)
                                                <tr>
                                                    <td>Bin</td>
                                                    <td>
                                                        <a href="{{ route('customer.details.download', ['type' => 'bin']) }}"
                                                            class="file__btn">
                                                            <span>{{ @Auth::user()->customerDetail->bin_file }}</span>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endif

                                            @if (@Auth::user()->customerDetail->trade_file)
                                                <tr>
                                                    <td>Trade</td>
                                                    <td>
                                                        <a href="{{ route('customer.details.download', ['type' => 'trade_license']) }}"
                                                            class="file__btn">
                                                            <span>{{ @Auth::user()->customerDetail->trade_file }}</span>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                                <h4 class="up__title">Click to upload more document</h4>

                                <div class="w-100">
                                    <input type="file" name="upload_document"
                                        class="form-control form-control input-style py-2 small-text-12" required />
                                </div>
                                <div class="muti__file__box">
                                    <a href="#"><span>tin.pdf</span></a>
                                    <a href="#"><span>bin.pdf</span></a>
                                    <a href="#"><span>trade.pdf</span></a>
                                </div>
                            </div>
                        </div>
                    </div> --}}

                    {{-- <div class="mb-5">
                        <div class="d-flex align-items-center gap-3 title-2">
                            <div class="serial-number">6</div>
                            <h1 class="page-title">Upload Document</h1>
                        </div>
                        <div>
                            <div class="w-100 mb-3">
                                <label class="form-label form-control-label">Upload NOC <sup
                                        class="text-danger">*</sup></label>
                                <div onclick="uploadPhoto('input1','display1')">
                                    <input onchange="uploadDocField(this)" type="file" id="input1" name="noc"
                                        class="d-none" required />
                                    <label for="input1" id="display1"
                                        class="upload-signature form-control input-style py-2 small-text-12">
                                        <i class="fa-solid fa-arrow-up-from-bracket"></i>
                                        <span class="ms-2">Upload document</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div> --}}

                    <button type="submit" class="btn btn-continue">
                        Update Application
                    </button>
                </div>
                <!-- customer-information-right end -->

            </div>


        </form>
    </div>
    <!-- main body content end -->
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

                    // father_phone : {
                    //     required: true,
                    //     minlength: 11,
                    //     maxlength: 11,
                    //     number: true
                    //     // minlength:11,
                    //     // maxlength:11
                    // }
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


        $('#fob_cfr_value').keyup(function() {
            var fobValue = $('#fob_cfr_value').val();
            // console.log(fobValue);
            if (fobValue) {
                $.ajax({
                    url: "{{ route('application.fee') }}/",
                    type: 'get',
                    data: {
                        fobValue: fobValue
                    },
                    success: function(data) {
                        // console.log(data);
                        $('#application_fee').html(data.fee);
                    }
                })
            } else {
                $('#application_fee').html('00')
            }


        })
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
