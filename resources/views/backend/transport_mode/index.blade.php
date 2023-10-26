@extends('backend.master')

@section('title')
    Mode of transport
@endsection


@section('content')
    <div class="main-container">
        <div class="all-application-content">
            <h1 class="page-title">Mode of transport manage</h1>

            {{-- @if (Auth::user()->hasPermission('transport-modes.create')) --}}
                <div>
                    <a href="{{ route('transport-modes.create') }}" class="btn btn-application">
                        <i class="fa-solid fa-circle-plus puls-app"></i>
                        Create
                    </a>
                </div>
            {{-- @endif --}}
        </div>

        <!-- table -->
        <div class="table-contanier">
            <table id="dataTable" class="cell-border display table-content" style="width: 100%">
                <thead>
                    <tr class="table-th">
                        <th class="text-center">#SL</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">Status</th>
                        @if (Auth::user()->hasPermission('transport-modes.edit') || Auth::user()->hasPermission('transport-modes.destroy'))
                            <th class="text-center">Actions</th>
                        @endif
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach ($modes as $mode)
                        <tr>
                            <td class="table-td">{{ $loop->iteration }}</td>
                            <td class="table-td">{{ $mode->name }}</td>
                            <td class="table-td">
                                @if ($mode->status == 1)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            </td>
                            <td class="table-td">
                                <!-- Edit Start -->
                                @if (Auth::user()->hasPermission('transport-modes.edit'))
                                    <a href="{{ route('transport-modes.edit', $mode->id) }}" class="btn btn-action"
                                        title="Edit">
                                        <i class="fa fa-edit"></i>
                                        <span>Edit</span>
                                    </a>
                                @endif
                                <!-- Edit End -->

                                <!-- Delete Start -->
                                @if (Auth::user()->hasPermission('transport-modes.destroy'))
                                    <button type="button" onclick="deleteData({{ $mode->id }})"
                                        class="btn btn-action-remark" title="Delete">
                                        <i class="fa fa-trash-alt"></i>
                                        <span>Delete</span>
                                    </button>

                                    <form id="delete-form-{{ $mode->id }}" method="POST"
                                        action="{{ route('transport-modes.destroy', $mode->id) }}" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                @endif
                                <!-- Delete End -->
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
