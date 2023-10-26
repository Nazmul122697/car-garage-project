@extends('backend.master')

@section('title')
    Certificates
@endsection

@push('css')
@endpush

@section('content')
    <div class="main-container">
        <div class="all-application-content">
            <h1 class="page-title">Certificate Manage</h1>

        </div>

        <!-- table -->
        <div class="table-contanier">
            <table id="dataTable" class="cell-border display table-content" style="width: 100%">
                <thead>
                    <tr class="table-th">
                        <th class="text-center">#SL</th>
                        <th class="text-center">Application ID</th>
                        <th class="text-center">Application Date</th>
                        <th class="text-center">Sample Collect</th>
                        <th class="text-center">Completion Date</th>
                        <th class="text-center">Status</th>
                        {{-- @if (Auth::user()->hasPermission('blogs.edit') || Auth::user()->hasPermission('blogs.destroy')) --}}
                        <th class="text-center">Actions</th>
                        {{-- @endif --}}
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach ($applications as $application)
                        <tr>
                            <td class="table-td">{{ $loop->iteration }}</td>
                            <td class="table-td">{{ $application->applied_id }}</td>
                            <td class="table-td">{{ date('M d, Y', strtotime($application->created_at)) }}</td>
                            <td class="table-td">{{ $application->sample_collect }}</td>
                            <td class="table-td">{{ $application->completion_date }}</td>
                            @php
                                    $changeRequest = \App\Models\ChangeRequest::where('application_id', $application->id)->first();
                                    // dd($changeRequest)
                                @endphp
                            <td class="">
                                @if (@$changeRequest->status == 1)
                                <span class="badge bg-success">Updated</span>
                                @endif

                                @if (@$changeRequest->status == 0)
                                <span class="badge bg-warning">Re-issued</span>
                                @endif
                            </td>
                            <td class="table-td d-flex justify-content-evenly">


                                @if ($changeRequest)
                                    @if ($changeRequest->status != 1)
                                        <!--view btn start-->
                                        @if (Auth::user()->hasPermission('certificate.view'))
                                            <a href="{{ route('certificate.view', $application->id) }}"
                                                class="btn btn-action-view"><i class="bi bi-eye"></i> View</a>
                                        @endif
                                        <!--view btn end-->
                                    @else
                                        <!--view btn start-->
                                        <a href="{{ route('certificate.view', $application->id) }}"
                                            class="btn btn-action-view"><i class="bi bi-pencil-square"></i>
                                            Amended Certificate</a>
                                        <!--view btn end-->
                                    @endif
                                @else
                                    <!--view btn start-->
                                    @if (Auth::user()->hasPermission('certificate.view'))
                                        <a href="{{ route('certificate.view', $application->id) }}"
                                            class="btn btn-action-view"><i class="bi bi-eye"></i> View</a>
                                    @endif
                                    <!--view btn end-->
                                @endif

                                @if (empty($changeRequest) || $changeRequest->status != 0)
                                    <!--change request btn start-->
                                    @if (Auth::user()->hasPermission('certificate.change.request'))
                                        <form class="d-none" id="change-form"
                                            action="{{ route('certificate.change.request') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="application_id" value="{{ $application->id }}">

                                        </form>
                                        <button onclick="document.getElementById('change-form').submit()"
                                            class="btn btn-action">
                                            <i class="bi bi-pencil-square"></i>
                                            Re-issue</button>
                                    @endif
                                    <!--change request btn end-->
                                @endif


                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
