@extends('backend.master')

@section('title')
    Application
@endsection

@section('content')
    @php
        $user = Auth::user();
        $route = Route::currentRouteName();
    @endphp
    <!-- main body content start -->
    <div class="main-container">

        <!-- Tab start-->
        @if (Auth::user()->role_id != 2)
            <div class="application-tab mt-2">
                <ul class="nav-application">
                    <li>
                        <a id="pendingBtn" class="btn" class="">
                            Pending Application</a>
                    </li>
                    <li>
                        <a id="inProgressBtn" class="btn" {{-- href="{{ route('application.status',['name' => 'in-progress']) }}" --}} {{-- class="{{$statusName == 'in-progress' ? 'application-nav-active' : ''  }}" --}}>
                            In Progress</a>
                    </li>
                    <li>
                        <a id="rejected" class="btn" {{-- href="{{ route('application.status', ['name' => 'rejected']) }}" --}} {{-- class="{{$statusName == 'rejected' ? 'application-nav-active' : ''  }}" --}}>
                            Rejected </a>
                    </li>
                    <li>
                        <a id="sampleCollect" class="btn" {{-- href="{{ route('application.status', ['name' => 'sample-collect']) }}" --}} {{-- class="{{$statusName == 'sample-collect' ? 'application-nav-active' : ''  }}" --}}>
                            Sample Collect</a>
                    </li>

                    <li>
                        <a id="resampling" class="btn" {{-- href="{{ route('application.status', ['name' => 'resampling']) }}" --}} {{-- class="{{$statusName == 'resampling' ? 'application-nav-active' : ''  }}" --}}>
                            Resampling</a>
                    </li>

                    <li>
                        <a id="finalized" class="btn" {{-- href="{{ route('application.status', ['status' => 'finalized']) }}" --}} {{-- class="{{$statusName == 'finalized' ? 'application-nav-active' : ''  }}" --}}>
                            Finalized</a>
                    </li>
                </ul>
            </div>
        @endif
        <!-- Tab end-->

        <!--Titile -->
        <div class="all-application-content my-4">

            <h1 class="page-title">

            </h1>


            @if ($user->role_id == 2)
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
                <input id="search_app_id" type="text" class="submitable form-control search-input-field py-2"
                    value="" name="search-input-field" placeholder="Application ID" />
            </div>

            @if (Auth::user()->role_id == 2)
                <div>
                    <select id="status" class="form-select search-input-field py-2" name="status"
                        aria-label="Default select example" id="application_status">
                        <option selected disabled>Application Status</option>
                        <option value="0">Pending</option>
                        <option value="1">In progress</option>
                        <option value="2">Rejected</option>
                        <option value="3">Request sample collect</option>
                        <option value="4">Sample collected</option>
                        <option value="5">Resampling</option>
                        <option value="7">Finalized</option>
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
                <tbody class="text-center">

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
                        <label for="remarks" class="mb-2">Remarks for <span id="remarkTitle"></span>
                        </label>
                        <p name="remarks" id="remarks" rows="6" class="form-control small-text-12 text-start"
                            style="min-height: 200px" readonly>
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
        $(document).ready(function() {
            application();
            var text = 'All Application'
            $('.page-title').append(text);

        });

        function remarkData(id) {
            $.ajax({
                url: "{{ route('application.remark') }}",
                type: "get",
                data: {
                    id: id
                },
                beforeSend: function() {

                    //add spinner here
                },
                success: function(html) {
                    $("#modal_body").html(html);
                }
            });
        }




        $('#pendingBtn').click(function() {
            var text = 'Pending Application';
            $('.page-title').empty();
            $('.page-title').append(text);
            var data = $(this).parent().parent().children().children();
            data.each(function() {
                var id = $(this).attr('id');
                $('#' + id).removeClass('application-nav-active');
            });
            $(this).addClass('application-nav-active');

            $('.data-table').DataTable().column(5)
                .search('pending', true, false)
                .draw();
        });

        $('#inProgressBtn').click(function() {
            var text = 'In Progress Application';
            $('.page-title').empty();
            $('.page-title').append(text);
            var data = $(this).parent().parent().children().children();
            data.each(function() {
                var id = $(this).attr('id');
                $('#' + id).removeClass('application-nav-active');
            });
            $(this).addClass('application-nav-active');

            $('.data-table').DataTable().column(5)
                .search('in progress', true, false)
                .draw();
        });

        $('#rejected').click(function() {
            var text = 'Rejected Application';
            $('.page-title').empty();
            $('.page-title').append(text);
            var data = $(this).parent().parent().children().children();
            data.each(function() {
                var id = $(this).attr('id');
                $('#' + id).removeClass('application-nav-active');
            });
            $(this).addClass('application-nav-active');

            $('.data-table').DataTable().column(5)
                .search('rejected', true, false)
                .draw();
        });

        $('#sampleCollect').click(function() {
            var text = 'Sample Collect Application';
            $('.page-title').empty();
            $('.page-title').append(text);
            var data = $(this).parent().parent().children().children();
            data.each(function() {
                var id = $(this).attr('id');
                $('#' + id).removeClass('application-nav-active');
            });
            $(this).addClass('application-nav-active');

            $('.data-table').DataTable().column(5)
                .search('sample collect', true, false)
                .draw();
        });

        $('#resampling').click(function() {
            var text = 'Resampling Application';
            $('.page-title').empty();
            $('.page-title').append(text);
            var data = $(this).parent().parent().children().children();
            data.each(function() {
                var id = $(this).attr('id');
                $('#' + id).removeClass('application-nav-active');
            });
            $(this).addClass('application-nav-active');

            $('.data-table').DataTable().column(5)
                .search('resampling', true, false)
                .draw();
        });

        $('#finalized').click(function() {
            var text = 'Finalized Application';
            $('.page-title').empty();
            $('.page-title').append(text);
            var data = $(this).parent().parent().children().children();
            data.each(function() {
                var id = $(this).attr('id');
                $('#' + id).removeClass('application-nav-active');
            });
            $(this).addClass('application-nav-active');

            $('.data-table').DataTable().column(5)
                .search('finalized', true, false)
                .draw();
        });


        $(document).on('click', '#searchBtn', function() {
            $('.data-table').DataTable().ajax.reload();
        })

        function application() {
            $('.data-table').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: {
                    "url": "{{ route('application.index') }}",
                    "data": function(e) {
                        e.application_id = $("#search_app_id").val();
                        e.starting_date = $('#startingDate').val();
                        e.ending_date = $('#endingDate').val();
                        e.status = $('#status').val();
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
                aoColumns: [{
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
                ],
                createdRow: function(row, data, index) {
                    var currentDate = new Date();
                    var applicationDate = new Date(data['created_at']);

                    var timeDiff = Math.abs(currentDate.getTime() - applicationDate.getTime());

                    var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
                    var status = data.status;
                    // console.log(status);

                    if (status == 0 && diffDays >= 3)   {
                        // console.log(data['application_status']);
                        $(row).addClass('bg-warning');
                    }
                },
            });
            //$.fn.dataTable.ext.errMode = 'throw';

        };
    </script>
@endpush
