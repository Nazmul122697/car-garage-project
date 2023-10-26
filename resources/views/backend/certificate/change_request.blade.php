@extends('backend.master')

@section('title')
    Certificate Change Request
@endsection

@push('css')
    <style>
        .error {
            color: #ff0000 !important;
        }
    </style>
@endpush

@section('content')
    <!-- main body content start -->
    <div class="main-container">

        <div class="mx-5 p-4 shadow">
            <h6 class="text-uppercase fw-semibold text-center">Certificate Change Request</h6>
            <form id="basic_form" action="" method="post" enctype="multipart/form-data">
                @csrf

                <!-- application id start-->
                <input type="hidden" name="application_id" value="{{ $application->id }}">
                <!-- application id end-->

                <div class="row">

                    <!--description start-->
                    <div class="col-12 mb-3 login-field">
                        <label for="remark" class="mb-2">Remark <abbr class="required text-danger">*</abbr></label>
                        <textarea class="form-control @error('remark') is-invalid @enderror" name="remark" rows="10" required>{{ old('remark') }}</textarea>
                        @error('remark')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!--description end-->

                    <!--upload documents start-->
                    <div class="col-12 mb-3 login-field">
                        <label  for="upload_document" class="mb-2">Upload documents <abbr
                                class="required text-danger">*</abbr></label>
                        <input id="upload_document" type="file" class="form-control" name="upload_document">
                        @error('upload_document')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!--upload documents end-->

                    <!-- Terms & Condistions Start-->
                    <div class="form-check mt-4 ms-2">
                        <input id="terms_condistion" class="form-check-input" type="checkbox" name="terms_condition"
                            value="" id="flexCheckChecked">
                        <label class="form-check-label" for="flexCheckChecked">
                            I agree to these
                            <a href="#" class="text-decoration-underline" data-bs-toggle="modal"
                                data-bs-target="#termsconditionModal">
                                Terms and Conditions</a>
                        </label>
                    </div>
                    <!-- Terms & Condistions End-->


                </div> <!-- row end -->

                <div class="row mx-2">
                    <!-- Payment Start -->
                    <div class="col-12 payment-container d-none">
                        <div class="d-flex align-items-center justify-content-center gap-3 title-2 mb-3">
                            <h1 class="page-title">Make payment</h1>
                        </div>
                        @php
                            $fee = $changeRequestFee->fee;
                            $vatAmount = 0;
                            $vatAmount = ($changeRequestFee->fee * $changeRequestFee->vat) / 100;

                            $taxAmount = 0;
                            $taxAmount = ($changeRequestFee->fee * $changeRequestFee->tax) / 100;
                        @endphp

                        <div class="mt-5">
                            <div class="account-sideNav d-flex align-items-baseline justify-content-center gap-3">
                                <p class="pay-with">Pay With:</p>
                                <ul class="nav nav-pills payment-contents">
                                    <li class="nav-item">
                                        <button class="nav-link payment-tap" data-bs-toggle="pill" href="#Challan"
                                            type="button" onclick="changeRoute('challan');">
                                            Bank
                                        </button>
                                    </li>

                                    <li class="nav-item">
                                        <button class="nav-link payment-tap" data-bs-toggle="pill" href="#Card"
                                            type="button" onclick="changeRoute('online');">
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
                                            Change Request Fee:
                                            <strong><span class="application_fee"> {{ @$fee }}</span>
                                                <span>BDT</span></strong>
                                        </p>
                                    </div>
                                    <div class="d-flex align-items-center gap-4 mb-3">
                                        <div class="w-100">
                                            <label class="form-label form-control-label">Bank Name</label>
                                            <input type="text" class="form-control form-control-input challan_input"
                                                name="bank_name" placeholder="Bank Name" value="Agrani Bank " required />
                                        </div>
                                        <div class="w-100">
                                            <label class="form-label form-control-label">Branch Name
                                            </label>
                                            <input type="text" class="form-control form-control-input challan_input"
                                                name="branch_name" placeholder="Branch Name" />
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center gap-4 mb-3">

                                        <div class="w-100">
                                            <label class="form-label form-control-label">Upload Bank Slip</label>
                                            <input type="file" name="bank_slip"
                                                class="form-control form-control input-style py-2 small-text-12 challan_input"
                                                required />
                                        </div>
                                        <div class="w-100">
                                            <label class="form-label form-control-label">Date </label>
                                            <input type="date" class="form-control form-control-input challan_input"
                                                name="date" required />
                                        </div>
                                    </div>



                                    <div class="d-flex align-items-center gap-4 mb-3">
                                        <div class="w-100">
                                            <label class="form-label form-control-label">Bank Amount</label>
                                            <input type="number" class="form-control form-control-input challan_input"
                                                name="bank_amount" placeholder="Bank Amount" value="{{ @$fee }}"
                                                required />
                                        </div>

                                        <div class="w-100">
                                            <input onclick="challan(this)" class="form-check-input" type="checkbox"
                                                id="flexCheckDefault" name="isEchallan" />
                                            <label class="form-check-label form-control-label challan_input"
                                                for="flexCheckDefault">Is it
                                                E-challan?</label>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center gap-4 mb-3">
                                        <div class="w-100">
                                            <label class="form-label form-control-label">Certificate VAT Challan
                                                No.</label>
                                            <input type="text" class="form-control form-control-input challan_input"
                                                placeholder="VAT challan no" name="certificate_vat_challan" required />
                                        </div>
                                        <div class="w-100">
                                            <label class="form-label form-control-label">BFSA VAT Challan No.
                                            </label>
                                            <input type="text" class="form-control form-control-input challan_input"
                                                name="bfsa_vat_challan" placeholder="VAT challan no" required />
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center gap-4 mb-3">
                                        <!-- Challan vat amount start -->
                                        <div class="w-100">
                                            <label class="form-label form-control-label">VAT Amount <span
                                                    class="text-danger"><sup>*[{{ @$changeRequestFee->vat }}%]</sup></span></label>
                                            <input type="number" class="form-control form-control-input challan_input"
                                                placeholder="VAT amount" name="vat_amount" value="{{ @$vatAmount }}"
                                                required />
                                        </div>
                                        <!-- Challan vat amount start -->

                                        <!-- Challan tax amount start -->
                                        <div class="w-100">
                                            <label class="form-label form-control-label">Tax Amount <span
                                                    class="text-danger"><sup>*[{{ @$changeRequestFee->tax }}%]</sup></span>
                                            </label>
                                            <input type="number" class="form-control form-control-input challan_input"
                                                name="tax_amount" placeholder="Tax amount" value="{{ @$taxAmount }}"
                                                required />
                                        </div>
                                        <!-- Challan tax amount end -->
                                    </div>

                                    <div id="bank-slip" class="d-block">
                                        <div class="d-flex align-items-center gap-4 mt-3">
                                            <div class="w-100">
                                                <label class="form-label form-control-label">Upload Certificate VAT
                                                    Challan</label>
                                                <input type="file" name="certificate_challan_file"
                                                    class="form-control form-control input-style py-2 small-text-12 challan_input"
                                                    required />
                                            </div>
                                            <div class="w-100">
                                                <label class="form-label form-control-label">Upload BFSA VAT
                                                    Challan</label>
                                                <input type="file" name="bfsa_challan_file"
                                                    class="form-control form-control input-style py-2 small-text-12 challan_input"
                                                    required />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-5 text-center">
                                        <button class="btn btn-continue">
                                            Pay Now
                                        </button>
                                    </div>
                                </div>
                                <!-- Challan info end -->

                                <!-- Online Payment start -->
                                <div class="tab-pane fade pt-5 text-center d-flex justify-content-center align-items-center flex-column"
                                    id="Card">

                                    <!-- Application fee -->
                                    <div class="col-md-6 mx-auto">
                                        <table class="table border">
                                            <tr>
                                                <td class="text-end"><strong>Change Request Fee</strong> </td>
                                                <td>:</td>
                                                <td>
                                                    {{ @$changeRequestFee->fee }} BDT
                                                    <input type="hidden" name="fee" class="online_input"
                                                        value="{{ $changeRequestFee->fee }}">
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="text-end"><strong>Vat({{ @$changeRequestFee->vat }}%)</strong>
                                                </td>
                                                <td>:</td>
                                                <td>
                                                    @php
                                                        $vatAmount = 0;
                                                        $vatAmount = ($changeRequestFee->fee * $changeRequestFee->vat) / 100;
                                                    @endphp
                                                    {{ $vatAmount }} BDT
                                                    <input type="hidden" name="vat" class="online_input"
                                                        value="{{ $changeRequestFee->vat }}">
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="text-end"><strong>Tax({{ $changeRequestFee->tax }}%)</strong>
                                                </td>
                                                <td>:</td>
                                                <td>
                                                    @php
                                                        $taxAmount = 0;
                                                        $taxAmount = ($changeRequestFee->fee * $changeRequestFee->tax) / 100;
                                                    @endphp
                                                    {{ $taxAmount }}
                                                    BDT
                                                    <input type="hidden" name="tax" class="online_input"
                                                        value="{{ $changeRequestFee->tax }}">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-end"><strong>Total</strong></td>
                                                <td>:</td>
                                                <td>
                                                    @php
                                                        $total = 0;
                                                        $total = $changeRequestFee->fee + $vatAmount + $taxAmount;
                                                    @endphp
                                                    {{ $total }}
                                                    BDT
                                                    <input type="hidden" name="total" class="online_input"
                                                        value="{{ $total }}">
                                                </td>
                                            </tr>
                                        </table>
                                    </div>

                                    <div>
                                        <button type="submit" class="btn btn-application px-4 fw-medium">
                                            <i class="bi bi-wallet-fill"></i> Pay Now BDT {{ $total }}
                                        </button>
                                    </div>

                                    <!-- payment image -->
                                    <div class="payment-img">
                                        <img src="{{ asset('backend/asset/image/sslcommerzPayment.png') }}"
                                            class="max-width: 100%" alt="" />
                                    </div>

                                </div>
                                <!-- Online Payment end -->
                            </div>


                        </div>
                    </div>
                    <!--Payment End -->
                </div><!-- row end -->
            </form>
        </div>
    </div>

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
    <script src="{{ asset('backend/js/payment.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script>
        $('#basic_form').validate();

        //___________TAB WISE ROUTE CHANGE__________//
        function changeRoute(params) {
            if (params == 'challan') {
                $('#basic_form').attr('action', '{{ route('changerequest.bank.payment') }}');
                $('.challan_input').prop('disabled', false);
                $('.online_input').prop('disabled', true);
            } else if (params == 'online') {
                $('#basic_form').attr('action', '{{ route('change_request.payment') }}');
                $('.challan_input').prop('disabled', true);
                $('.online_input').prop('disabled', false);
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
    </script>
@endpush
