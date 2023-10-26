@extends('backend.master')

@section('title')
    Application
@endsection

@section('content')

    <!-- main body content start -->
    <div class="main-container">

        <!-- Tab start-->
        @if (Auth::user()->role_id != 2)
        <div class="application-tab mt-2">
            <ul class="nav-application">
                <li>
                  <a id="statusName" data-status="pending"
                    href="{{ route('application.status',['name' => 'pending']) }}"
                    class="{{$statusName == 'pending' ? 'application-nav-active' : ''  }}"
                    >Pending Application</a
                  >
                </li>
                <li>
                    <a href="{{ route('application.status',['name' => 'in-progress']) }}"
                        class="{{$statusName == 'in-progress' ? 'application-nav-active' : ''  }}"
                        >
                        In Progress</a></li>
                <li>
                    <a href="{{ route('application.status',['name' => 'rejected']) }}"
                        class="{{$statusName == 'rejected' ? 'application-nav-active' : ''  }}"
                        >
                        Rejected </a></li>
                <li>
                  <a href="{{ route('application.status',['name' => 'sample-collect']) }}"
                    class="{{$statusName == 'sample-collect' ? 'application-nav-active' : ''  }}"
                    >
                    Sample Collect</a>
                </li>

                <li>
                  <a href="{{ route('application.status',['name' => 'resampling']) }}"
                    class="{{$statusName == 'resampling' ? 'application-nav-active' : ''  }}"
                    >
                    Resampling</a>
                </li>

                <li>
                  <a href="{{ route('application.status',['name' => 'finalized']) }}"
                    class="{{$statusName == 'finalized' ? 'application-nav-active' : ''  }}"
                    >
                    Finalized</a>
                </li>
            </ul>
        </div>
        @endif
        <!-- Tab end-->

        <!--Titile -->
        <div class="all-application-content my-4">
            @if ($statusName == null)
                <h1 class="page-title">All Application</h1>
            @endif
            @if ($statusName == 'pending')
                <h1 class="page-title">Pending Application</h1>
            @endif

            @if ($statusName == 'in-progress')
                <h1 class="page-title">In Progress Application</h1>
            @endif

            @if ($statusName == 'rejected')
                <h1 class="page-title">Rejected Application</h1>
            @endif

            @if ($statusName == 'sample-collect')
                <h1 class="page-title">Sample Collected Application</h1>
            @endif

            @if ($statusName == 'resampling')
                <h1 class="page-title">Resampling Application</h1>
            @endif

            @if ($statusName == 'finalized')
                <h1 class="page-title">Finalized Application</h1>
            @endif


            @if (Auth::user()->role_id == 2)
                <div>
                    <a href="{{ route('application.create') }}" class="btn btn-application">
                        <i class="fa-solid fa-circle-plus puls-app"></i>
                        New Application
                    </a>
                </div>
            @endif
        </div>


        <!-- search field table start -->
        <div class="search-field-container">
            <div class="">
                <input id="search_app_id" type="text" class="form-control search-input-field py-2" value=""
                    name="search-input-field" placeholder="Application ID" />
            </div>

            @if (Auth::user()->role_id == 2)
            <div>
                <select class="form-select search-input-field py-2" name="search-input-field"
                    aria-label="Default select example" id="application_status">
                    <option selected disabled>Application Status</option>
                    <option value="Pending">Pending</option>
                    <option value="In progress">In progress</option>
                    <option value="Rejected">Rejected</option>
                    <option value="Request sample collect">Request sample collect</option>
                    <option value="Sample collected">Sample collected</option>
                    <option value="Resampling">Resampling</option>
                    <option value="Approved">Approved</option>
                </select>
            </div>
            @endif


            <div class="d-flex align-items-center gap-2">
                <label class="form-title">From</label>

                <input id="startingDate" type="Date" class="form-control search-input-field py-2" name="date" />
            </div>
            <div class="d-flex align-items-center gap-2">
                <label class="form-title">To</label>

                <input id="endingDate" type="Date" class="form-control search-input-field py-2"
                    placeholder="Application ID" />
            </div>
            <div>
                <button id="searchBtn" class="btn search-btns">
                    <i class="fa-solid fa-magnifying-glass"></i> <span>Search</span>
                </button>
            </div>
        </div>
        <!-- search field table end -->

        <!-- table -->
        <div class="table-contanier">
            {{-- <table id="dataTable" class="datatable cell-border display table-content ytable data-table" style="width: 100%"> --}}
            <table class="cell-border display table-content data-table" style="width: 100%">
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
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

    <!-- remark modal start -->
    <div class="modal fade" id="remarkModal" tabindex="-1" aria-labelledby="remarkModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header px-4">
                    <h2 class="modal-title fs-6 dashboard-title" id="remarkModalLabel">
                        Remarks
                    </h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="">
                        <label for="remarks" class="mb-2">Remarks for
                            {{ @$application->application_status == 6 ? 'on hold' : '' }}
                        </label>
                        <p name="remarks" id="remarks" rows="6" class="form-control small-text-12 text-start" style="min-height: 200px" readonly>
                            {{ @$application->remark }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- modal end -->

    <!-- main body content end -->
@endsection

@push('js')
    <script>
        // $(function application() {

        //     var day, month, year;

        //     $('#searchBtn').on('click', function() {
        //         //application id
        //         var searchApplicationId = $('#search_app_id').val();
        //         var searchApplicationStatus = $('#application_status').val();

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
        //                 // alert('ok2');
        //             $('#dataTable').DataTable().columns([1, 2, 5])
        //                 .search(searchApplicationId + '|' + searchApplicationStatus + '|' +
        //                     startFormattedDate, true, false)
        //                 .draw();

        //         }

        //         //searchApplicationId && searchApplicationStatus && endFormattedDate
        //         else if (searchApplicationId != null && searchApplicationId != '' && //ok
        //             searchApplicationStatus != null && searchApplicationStatus != '' &&
        //             endFormattedDate != null) {
        //                 // alert('ok3');
        //             $('#dataTable').DataTable().columns([1, 2, 5])
        //                 .search(searchApplicationId + '|' + searchApplicationStatus + '|' +
        //                     endFormattedDate, true, false)
        //                 .draw();

        //         }
        //         //searchApplicationId && startFormattedDate && endFormattedDate
        //         else if (searchApplicationId != null && searchApplicationId != '' && //ok
        //             startFormattedDate != null &&
        //             endFormattedDate != null) {
        //                 // alert('ok4');
        //             $('#dataTable').DataTable().columns([1, 2])
        //                 .search(searchApplicationId + '|' + startFormattedDate + '|' +
        //                     endFormattedDate, true, false)
        //                 .draw();

        //         }
        //         //searchApplicationStatus && startFormattedDate && endFormattedDate
        //         else if (searchApplicationStatus != null && searchApplicationStatus != '' && //ok
        //             startFormattedDate != null &&
        //             endFormattedDate != null) {
        //                 // alert('ok5');
        //             $('#dataTable').DataTable().columns([2, 5])
        //                 .search(searchApplicationStatus + '|' + startFormattedDate + '|' +
        //                     endFormattedDate, true, false)
        //                 .draw();

        //         }
        //         //searchApplicationId && searchApplicationStatus
        //         else if (searchApplicationId != null && searchApplicationId != ''  && //ok
        //             searchApplicationStatus != null &&  searchApplicationStatus != '') {
        //             // alert('ok6');
        //             $('#dataTable').DataTable().columns([1, 5])
        //                 .search(searchApplicationId + '|' + searchApplicationStatus, true, false)
        //                 .draw();

        //         }
        //         //searchApplicationId && startFormattedDate
        //         else if (searchApplicationId != null && searchApplicationId != ''  && //ok
        //             startFormattedDate != null) {
        //             // alert('ok7');
        //             $('#dataTable').DataTable().columns([1, 2])
        //                 .search(searchApplicationId + '|' + startFormattedDate, true, false)
        //                 .draw();

        //         }
        //         //searchApplicationId && endFormattedDate
        //         else if (searchApplicationId != null && searchApplicationId != '' && //ok
        //             endFormattedDate != null) {
        //         //    alert('ok8');
        //             $('#dataTable').DataTable().columns([1, 2])
        //                 .search(searchApplicationId + '|' + endFormattedDate, true, false)
        //                 .draw();

        //         }
        //         //searchApplicationStatus && startFormattedDate
        //         else if (searchApplicationStatus != null && searchApplicationStatus != '' && //ok
        //             startFormattedDate != null) {
        //             // alert('ok9');
        //             $('#dataTable').DataTable().columns([2,5]).search(searchApplicationStatus + '|' + startFormattedDate , true, false)
        //                 .draw();
        //         }
        //         //searchApplicationStatus && endFormattedDate
        //         else if (searchApplicationStatus != null && searchApplicationStatus != '' && //ok
        //             endFormattedDate != null) {
        //             // alert('ok10');
        //             $('#dataTable').DataTable().columns([2,5]).search(searchApplicationStatus + '|' + endFormattedDate , true, false)
        //                 .draw();
        //         }
        //         //startFormattedDate && endFormattedDate
        //         else if (startFormattedDate != null && endFormattedDate != null) { //ok
        //             // alert('ok11');
        //             $('#dataTable').DataTable().column(2).search(startFormattedDate + '|' + endFormattedDate , true, false)
        //                 .draw();
        //         }
        //         //startFormattedDate
        //         else if (startFormattedDate !=null) { //ok
        //             alert('ok11')
        //             $('#dataTable').DataTable().column(2).search(startFormattedDate, true, false)
        //                 .draw();
        //         }
        //         //endFormattedDate
        //         else if (endFormattedDate !=null) { //ok
        //             // alert('ok12')
        //             $('#dataTable').DataTable().column(2).search(endFormattedDate, true, false)
        //                 .draw();
        //         }
        //         // searchApplicationId
        //         else if (searchApplicationId !=null && searchApplicationId != '') { //ok
        //             // alert('oke13')
        //             $('#dataTable').DataTable().column(1).search(searchApplicationId, true, false)
        //                 .draw();
        //         }
        //         //searchApplicationStatus
        //         else if (searchApplicationStatus !=null && searchApplicationStatus != '') { //ok
        //             // alert('ok14')
        //             $('#dataTable').DataTable().column(5).search(searchApplicationStatus, true, false)
        //                 .draw();
        //         }
        //         else {
        //             // alert('ok15')
        //             $('#dataTable').DataTable().search('', true, false)
        //                 .draw();
        //         }

        //     });

        // });




        var status = '{{$statusName}}';

        $(function product() {
            var dataTable = $('.data-table').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: {
                    "url": "{{ route('application.status') }}",
                    data: function(data){
                        data.status = status;
                        data.application_id = $('#search_app_id').val();
                    }
                },
                lengthMenu: [
                    [30, 50, 100, 500],
                    [30, 50, 100, 500],
                ],
                dom: 'Bfrtip',
                buttons: [
                    'pageLength',
                    {
                        extend: 'excelHtml5',
                        exportOptions: {
                            columns: ':visible'

                            // columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10,
                            //     11, 12, 13, 14
                            // ] // Excludes the second column (index 1)
                        }
                    },
                    {
                        extend: 'csvHtml5',
                        exportOptions: {
                            columns: ':visible'

                            // columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10,
                            //     11, 12, 13, 14
                            // ] // Excludes the second column (index 1)
                        }
                    },
                    {
                        extend: 'colvis',
                        text: 'Column Selector',
                        // columns: ':not(:last-child)' // exclude last column
                    }

                ],
                aoColumns: [
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'application_id',
                        name: 'application_id'
                    },
                    {
                        data: 'application_date',
                        name: 'application_date'
                    },
                    {
                        data: 'sample_collect',
                        name: 'sample_collect'
                    },
                    {
                        data: 'completion_date',
                        name: 'completion_date'
                    },
                    {
                        data: 'application_status',
                        name: 'application_status'
                    },

                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },
                ]
            });

            $('#searchBtn').on('click', function() {
                dataTable.draw();
             });

        });





    </script>
@endpush
