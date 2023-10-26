@extends('backend.master')

@section('title')
    Certificate Change Request
@endsection


@section('content')
    <div class="main-container">
        <div class="all-application-content">
            <h1 class="page-title">Certificate Change Request</h1>

        </div>

        <!-- table -->
        <div class="table-contanier">
            <table id="dataTable" class="cell-border display table-content" style="width: 100%">
                <thead>
                    <tr class="table-th">
                        <th class="text-center">#SL</th>
                        <th class="text-center">Application ID</th>
                        <th class="text-center">Change Request Date</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">Status</th>
                        {{-- @if (Auth::user()->hasPermission('blogs.edit') || Auth::user()->hasPermission('blogs.destroy')) --}}
                        <th class="text-center">Actions</th>
                        {{-- @endif --}}
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach ($changeRequests as $changeRequest)
                        <tr>
                            <td class="table-td">{{ $loop->iteration }}</td>
                            <td class="table-td">{{ $changeRequest->application->applied_id }}</td>
                            <td class="table-td">{{ date('M d, Y', strtotime($changeRequest->request_created_at)) }}</td>
                            <td class="table-td">{{ $changeRequest->customer->name }}</td>
                            <td class="">
                                @if ($changeRequest->status == 0)
                                    <span class="badge bg-warning text-dark">Pending</span>
                                @endif

                                @if($changeRequest->status == 1)
                                    <span class="badge bg-success">Updated</span>
                                @endif
                            </td>
                            <td class="table-td d-flex justify-content-evenly">
                                <!--view btn start-->
                                <button id="viewRemarkBtn" class="btn btn-action-remark"
                                    data-bs-toggle="modal"
                                    data-bs-target="#remarkModal"
                                    data-url="{{ route('change-request.remark', $changeRequest->id) }}">
                                    <i class="bi bi-eye"></i>
                                    View Remark</button>

                                <!--view btn start-->
                                <a href="{{route('certificate.view',$changeRequest->application_id)}}" class="btn btn-action-view">
                                    <i class="bi bi-eye"></i>
                                    View</a>
                                <!--view btn end-->

                                <!--change request btn start-->
                                @if ($changeRequest->status == 0)
                                    <a href="{{route('change-request.edit',$changeRequest->id)}}" class="btn btn-action">
                                        <i class="bi bi-pencil-square"></i>
                                        edit</a>
                                @endif

                                <!--change request btn end-->
                            </td>
                        </tr>
                    @endforeach
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
                    <div class="login-field">
                        <label for="remarks" class="mb-2">Remarks for change request
                        </label>
                        <p id="remarks">

                        </p>

                    </div>
                </div>
            </div>
        </div>
        <!-- modal end -->
    @endsection

    @push('js')
        <script>
            $('body').on('click', '#viewRemarkBtn', function() {
                // alert('hello');
                var remarkURL = $(this).data('url');
                // console.log(remarkURL);

                $.get(remarkURL, function(data) {
                    // console.log(data);
                    $('#remarkModal').modal('show');
                    $('#remarks').html(data.remark);
                })
            });
        </script>
    @endpush
