@extends('backend.master')

@section('title')
    Help Desk
@endsection

@section('content')
    <div class="main-container">
        <div class="all-application-content">
            <h1 class="page-title">Help Line Request</h1>
        </div>

        <!-- table -->
        <div class="table-contanier">
            <table id="dataTable" class="cell-border display table-content"
            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                    <tr class="table-th">
                        <th class="text-center">#SL</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Phone</th>
                        <th class="text-center">Subject</th>
                        <th class="text-center">Message</th>
                        <th class="text-center">Date Time</th>
                        {{-- @if (Auth::user()->hasPermission('fee-structures.edit')) --}}
                        <th class="text-center">Actions</th>
                        {{-- @endif --}}
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach ($help_desks as $help_desk)
                        <tr>
                            <td class="table-td">{{ $loop->iteration }}</td>
                            <td class="table-td">{{ @$help_desk->name }}</td>
                            <td class="table-td">{{ @$help_desk->email }}</td>
                            <td class="table-td">{{ @$help_desk->phone }}</td>
                            <td class="table-td">{{ @$help_desk->subject }}</td>
                            <td class="table-td">{{ @$help_desk->message }}</td>
                            <td class="table-td">{{ @$help_desk->created_at->format('d/m/Y h:ia') }}</td>
                            {{-- @if (Auth::user()->hasPermission('fee-structures.edit')) --}}
                            <td>
                                <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal" onclick="idPass('{{ $help_desk->id }}')">
                                    Complete
                                </button>
                            </td>
                            {{-- @endif --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Remarks</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('help.line.submit') }}" method="POST">
                    @csrf

                    <input type="hidden" name="id" id="helpLineId" value="">

                    <div class="modal-body">
                        <textarea class="form-control" name="remark" id="" rows="10" placeholder="Type here..." required></textarea>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Complete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        function idPass(id) {
            $("#helpLineId").val(id)
        }
    </script>
@endpush
