@extends('backend.master')

@section('title')
    Dashboard
@endsection

@push('css')
    <!-- Dropify css cdn link -->
    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css" rel="stylesheet" /> --}}
    <style>
        .custom-error-message {
            color: #ff0000 !important;
            /* Replace with your desired color */
        }

        /* .dropify-message p {
                                                font-size: 18px;
                                            } */
    </style>
@endpush

@section('content')
    @php
        $user = Auth::user();
    @endphp
    <!-- main body content start -->
    <div class="main-container">
        <div class="dashboard-content-count shadow rounded">
            <div class="dashboard-content-count-card">
                <div class="lab-img">
                    <img src="{{ asset('backend/asset/image/FlexIcon.png') }}" alt="" />
                </div>
                <div class="card-content">
                    <h1>{{ count(@$pendingApplications) }}</h1>
                    <p>Pending Application</p>
                </div>
            </div>
            <div class="dashboard-content-count-card">
                <div class="lab-img">
                    <img src="{{ asset('backend/asset/image/FlexIcon.png') }}" alt="" />
                </div>
                <div class="card-content">
                    <h1>{{ count(@$sampleCollectRequests) }}</h1>
                    <p>Sample Collect Request</p>
                </div>
            </div>
            <div class="dashboard-content-count-card">
                <div class="lab-img">
                    <img src="{{ asset('backend/asset/image/FlexIcon.png') }}" alt="" />
                </div>
                <div class="card-content">
                    <h1>{{ count(@$rejectedApplications) }}</h1>
                    <p>Rejected Application</p>
                </div>
            </div>
            <div class="dashboard-content-count-card">
                <div class="lab-img">
                    <img src="{{ asset('backend/asset/image/FlexIcon.png') }}" alt="" />
                </div>
                <div class="card-content">
                    <h1>{{ count(@$certificated) }}</h1>
                    <p>Certificated</p>
                </div>
            </div>
        </div>



        <!-- table -->
        <div class="table-contanier">
            <table id="dataTable" class="datatable cell-border display table-content ytable" style="width: 100%">
                <thead>
                    <tr class="table-th">
                        <th>SL</th>
                        <th>Application ID</th>
                        <th>Application Date</th>
                        <th>Sample Collect</th>
                        <th>Completion Date</th>
                        <th>Application Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach ($applications as $application)
                        <tr>
                            <td class="">{{ $loop->iteration }}</td>
                            <td class="">{{ $application->applied_id }}</td>
                            <td class="">{{ date('M d, Y', strtotime($application->created_at)) }}</td>
                            <td class="">
                                {{ $application->sample_collect ? date('M d, Y', strtotime($application->sample_collect)) : 'N/A' }}
                            </td>
                            <td class="">
                                {{ $application->completion_date ? date('M d, Y', strtotime($application->completion_date)) : 'N/A' }}
                            </td>
                            <td class="">
                                @if ($application->application_status == 0)
                                    <span class="badge bg-warning">Pending</span>
                                @endif
                                @if ($application->application_status == 1)
                                    <span class="badge bg-info">In Progress</span>
                                @endif
                                @if ($application->application_status == 2)
                                    <span class="badge bg-danger">Rejected</span>
                                @endif
                                @if ($application->application_status == 3)
                                    <span class="badge bg-secondary">Request Sample Collect</span>
                                @endif
                                @if ($application->application_status == 4)
                                    <span class="badge bg-primary">Sample Collected</span>
                                @endif
                                @if ($application->application_status == 5)
                                    <span class="badge bg-dark">Resampling</span>
                                @endif
                                @if ($application->application_status == 6)
                                    <span class="badge" style="background-color: #006400">On Hold</span>
                                @endif
                                @if ($application->application_status == 7)
                                    <span class="badge bg-success">Finalized</span>
                                @endif
                            </td>
                            <td class="">
                                <a href="{{ route('application.payment.invoice', ['app_id' => $application->id]) }}"
                                    class="btn btn-action-download me-2">
                                    <i class="bi bi-receipt"></i> Invoice</a>

                                @if ($user->role_id != 1 && $user->role_id != 2)
                                    <a href="{{ route('application.process', $application->id) }}"
                                        class="btn btn-action-view">
                                        <i class="bi bi-eye"></i> View</a>
                                @endif

                                @if ($user->role_id == 2 && @$application->application_status == 6)
                                    <a href="{{ route('application.edit', ['id' => $application->id]) }}"
                                        class="btn btn-action d-inline-block">
                                        <i class="bi bi-pencil-square"></i> Edit</a>
                                @endif

                                @if (@$application->application_status == 6 || @$application->application_status == 2)
                                    <a class="btn btn-action-remark d-inline-block remark-btn remark_modal"
                                        data-bs-toggle="modal" link="{{ route('application.remark') }}"
                                        data-id="{{ $application->id }}" data-title="Remark" data-bs-target="#modal">
                                        <i class="bi bi-card-list"></i> Remark</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- remark modal start -->
    {{-- <div class="modal fade" id="remarkModal" tabindex="-1" aria-labelledby="remarkModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header px-4">
                    <h2 class="modal-title fs-6 dashboard-title" id="remarkModalLabel">
                        Remarks
                    </h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="login-field">
                        <label for="remarks" class="mb-2">Remarks for
                            {{ @$application->application_status == 6 ? 'on hold' : '' }}
                        </label>
                        <textarea name="remarks" id="remarks" rows="6" class="form-control py-2 small-text-12" readonly>
                            {{ @$application->remark }}
                        </textarea>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- modal end -->

    <!-- main body content end -->
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="{{ asset('/') }}backend/js/uploadFile.js"></script>
    <script src="{{ asset('/') }}backend/js/uploadImg.js"></script>
    <script>
        $(document).ready(function() {
            $.validator.addMethod("nidLength", function(value, element, params) {
                var length = value.length;
                return (length === params[0] || length === params[1]);
            }, "NID number must be either {0} or {1} digits long.");

            $.validator.addMethod("ercLength", function(value, element, params) {
                var length = value.length;
                return (length === params[0] || length === params[1]);
            }, "ERC number must be either {0} or {1} characters long.");

            $.validator.addMethod("binlength", function(value, element, params) {
                var length = value.length;
                return (length === params[0] || length === params[1]);
            }, "Bin number must be either {0} or {1} characters long.");

            $("#customerDetailsForm").validate({
                rules: {
                    nid_no: {
                        required: true,
                        digits: true,
                        maxlength: 17,
                        nidLength: [10, 17],
                    },
                    erc_no: {
                        required: true,
                        digits: true,
                        ercLength: [10, 16] // Specify allowed file extensions
                    },
                    tin_no: {
                        required: true,
                        digits: true,
                        minlength: 12, // Specify allowed file extensions
                        maxlength: 12 // Specify allowed file extensions
                    },
                    bin_no: {
                        required: true,
                        digits: true,
                        binlength: [13, 17] // Specify allowed file extensions
                    },
                    trade_no: {
                        required: true,
                        digits: true,
                        minlength: 6, // Specify allowed file extensions
                        maxlength: 10, // Specify allowed file extensions
                    },
                },
                messages: {
                    nid_no: {
                        // required: "Please enter your nid no",
                        digits: "Please enter only digits",
                        maxlength: "NID number must not exceed 17 characters",
                    },
                },
                errorClass: "custom-error-message",
                submitHandler: function(form) {
                    // Form is valid, submit it
                    form.submit();
                }



            });


        });

        // $(function application() {

        //     var day, month, year;

        //     $('#searchBtn').on('click', function() {
        //         // alert('Hello!')
        //         //application id
        //         var searchApplicationId = $('#search_app_id').val();
        //         var searchApplicationStatus = $('#application_status').val();
        //         // alert(searchApplicationId);

        //         var startingDate = $('#startingDate').val().split("-");
        //         if (startingDate != null && startingDate != '') {
        //             // alert('not null')
        //             var day = startingDate[2];
        //             var month = startingDate[1];
        //             var year = startingDate[0];

        //             var startFormattedDate = new Date(year, month - 1, day).toLocaleDateString('en-US', {
        //                 day: '2-digit',
        //                 month: 'short',
        //                 year: 'numeric'
        //             });
        //         } else {
        //             startFormattedDate = null;
        //         }




        //         var endingDate = $('#endingDate').val().split("-");
        //         if (endingDate != null && endingDate != '') {
        //             var end_day = endingDate[2];
        //             var end_month = endingDate[1];
        //             var end_year = endingDate[0];

        //             var endFormattedDate = new Date(end_year, end_month - 1, end_day).toLocaleDateString(
        //                 'en-US', {
        //                     day: '2-digit',
        //                     month: 'short',
        //                     year: 'numeric'
        //                 });
        //         } else {
        //             endFormattedDate = null;
        //         }

        //         //searchApplicationId && searchApplicationStatus && startFormattedDate && endFormattedDate
        //         if (searchApplicationId != null && searchApplicationId != '' && //ok
        //             searchApplicationStatus != null && searchApplicationStatus != '' &&
        //             endFormattedDate != null && startFormattedDate != null) {
        //             // alert('ok1');
        //             $('#dataTable').DataTable().columns([1, 2, 5])
        //                 .search(searchApplicationId + '|' + searchApplicationStatus + '|' +
        //                     startFormattedDate + '|' + endFormattedDate, true, false)
        //                 .draw();

        //         }
        //         //searchApplicationId && searchApplicationStatus && startFormattedDate
        //         else if (searchApplicationId != null && searchApplicationId != '' && //ok
        //             searchApplicationStatus != null && searchApplicationStatus != '' &&
        //             startFormattedDate != null) {
        //             // alert('ok2');
        //             $('#dataTable').DataTable().columns([1, 2, 5])
        //                 .search(searchApplicationId + '|' + searchApplicationStatus + '|' +
        //                     startFormattedDate, true, false)
        //                 .draw();

        //         }

        //         //searchApplicationId && searchApplicationStatus && endFormattedDate
        //         else if (searchApplicationId != null && searchApplicationId != '' && //ok
        //             searchApplicationStatus != null && searchApplicationStatus != '' &&
        //             endFormattedDate != null) {
        //             // alert('ok3');
        //             $('#dataTable').DataTable().columns([1, 2, 5])
        //                 .search(searchApplicationId + '|' + searchApplicationStatus + '|' +
        //                     endFormattedDate, true, false)
        //                 .draw();

        //         }
        //         //searchApplicationId && startFormattedDate && endFormattedDate
        //         else if (searchApplicationId != null && searchApplicationId != '' && //ok
        //             startFormattedDate != null &&
        //             endFormattedDate != null) {
        //             // alert('ok4');
        //             $('#dataTable').DataTable().columns([1, 2])
        //                 .search(searchApplicationId + '|' + startFormattedDate + '|' +
        //                     endFormattedDate, true, false)
        //                 .draw();

        //         }
        //         //searchApplicationStatus && startFormattedDate && endFormattedDate
        //         else if (searchApplicationStatus != null && searchApplicationStatus != '' && //ok
        //             startFormattedDate != null &&
        //             endFormattedDate != null) {
        //             // alert('ok5');
        //             $('#dataTable').DataTable().columns([2, 5])
        //                 .search(searchApplicationStatus + '|' + startFormattedDate + '|' +
        //                     endFormattedDate, true, false)
        //                 .draw();

        //         }
        //         //searchApplicationId && searchApplicationStatus
        //         else if (searchApplicationId != null && searchApplicationId != '' && //ok
        //             searchApplicationStatus != null && searchApplicationStatus != '') {
        //             // alert('ok6');
        //             $('#dataTable').DataTable().columns([1, 5])
        //                 .search(searchApplicationId + '|' + searchApplicationStatus, true, false)
        //                 .draw();

        //         }
        //         //searchApplicationId && startFormattedDate
        //         else if (searchApplicationId != null && searchApplicationId != '' && //ok
        //             startFormattedDate != null) {
        //             // alert('ok7');
        //             $('#dataTable').DataTable().columns([1, 2])
        //                 .search(searchApplicationId + '|' + startFormattedDate, true, false)
        //                 .draw();

        //         }
        //         //searchApplicationId && endFormattedDate
        //         else if (searchApplicationId != null && searchApplicationId != '' && //ok
        //             endFormattedDate != null) {
        //             //    alert('ok8');
        //             $('#dataTable').DataTable().columns([1, 2])
        //                 .search(searchApplicationId + '|' + endFormattedDate, true, false)
        //                 .draw();

        //         }
        //         //searchApplicationStatus && startFormattedDate
        //         else if (searchApplicationStatus != null && searchApplicationStatus != '' && //ok
        //             startFormattedDate != null) {
        //             // alert('ok9');
        //             $('#dataTable').DataTable().columns([2, 5]).search(searchApplicationStatus + '|' +
        //                     startFormattedDate, true, false)
        //                 .draw();
        //         }
        //         //searchApplicationStatus && endFormattedDate
        //         else if (searchApplicationStatus != null && searchApplicationStatus != '' && //ok
        //             endFormattedDate != null) {
        //             // alert('ok10');
        //             $('#dataTable').DataTable().columns([2, 5]).search(searchApplicationStatus + '|' +
        //                     endFormattedDate, true, false)
        //                 .draw();
        //         }
        //         //startFormattedDate && endFormattedDate
        //         else if (startFormattedDate != null && endFormattedDate != null) {
        //             // alert('ok11')
        //             $('#dataTable').DataTable().column(2).search(startFormattedDate + '|' + endFormattedDate , true, false)
        //                 .draw();
        //         }
        //         //startFormattedDate
        //         else if (startFormattedDate != null) { //ok
        //             // alert('ok12')
        //             $('#dataTable').DataTable().column(2).search(startFormattedDate, true, false)
        //                 .draw();
        //         }
        //         //endFormattedDate
        //         else if (endFormattedDate != null) { //ok
        //             // alert('ok13')
        //             $('#dataTable').DataTable().column(2).search(endFormattedDate, true, false)
        //                 .draw();
        //         }
        //         // searchApplicationId
        //         else if (searchApplicationId != null && searchApplicationId != '') { //ok
        //             // alert('oke14')
        //             $('#dataTable').DataTable().column(1).search(searchApplicationId, true, false)
        //                 .draw();
        //         }
        //         //searchApplicationStatus
        //         else if (searchApplicationStatus != null && searchApplicationStatus != '') { //ok
        //             // alert('ok15')
        //             $('#dataTable').DataTable().column(5).search(searchApplicationStatus, true, false)
        //                 .draw();
        //         } else {
        //             // alert('ok16')
        //             $('#dataTable').DataTable().search('', true, false)
        //                 .draw();
        //         }

        //     });

        // });
    </script>
@endpush
