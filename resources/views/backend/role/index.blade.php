@extends('backend.master')

@section('title')
    Roles Management
@endsection

@push('css')
@endpush

@section('content')
    <div class="main-container">
        <div class="all-application-content">
            <h1 class="page-title">Roles Manage</h1>
            <div>
                <a href="{{ route('roles.create') }}" class="btn btn-application">
                    <i class="fa-solid fa-circle-plus puls-app"></i>
                    Create
                </a>
            </div>
        </div>

        <!-- table -->
        <div class="table-contanier" style="margin-top:0rem !important">
            <table id="dataTable" class="cell-border display table-content" style="width: 100%">
                <thead>
                    <tr class="table-th">
                        <th class="text-center">#SL</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">Permissions</th>
                        <th class="text-center">Updated At</th>
                        @if (Auth::user()->hasPermission('roles.edit') || Auth::user()->hasPermission('roles.destroy'))
                            <th class="text-center">Actions</th>
                        @endif
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach ($roles as $key => $role)
                        <tr>
                            <td class="table-td text-muted">#{{ $loop->iteration}}</td>
                            <td class="table-td">{{ $role->name }}</td>
                            <td class="table-td">
                                @if ($role->permissions->count() > 0)
                                    <span class="badge bg-info text-dark">{{ $role->permissions->count() }}</span>
                                @else
                                    <span class="badge bg-warning text-dark">No permission found &#128546;</span>
                                @endif
                            </td>
                            <td class="table-td">{{ $role->updated_at->diffForHumans() }}</td>
                            <td class="table-td">

                                @if (Auth::user()->hasPermission('roles.edit'))
                                    <a href="{{ route('roles.edit', $role->id) }}"
                                        class="btn btn-action" title="Edit">
                                        <i class="fa fa-edit"></i>
                                        <span>Edit</span>
                                    </a>
                                @endif

                                @if (Auth::user()->hasPermission('roles.destroy'))
                                    @if ($role->deletable == true)
                                        <button type="button" onclick="deleteData({{ $role->id }})"
                                            class="btn btn-action-remark" title="Delete">
                                            <i class="fa fa-trash-alt"></i>
                                            <span>Delete</span>
                                        </button>
                                    @endif

                                    <form id="delete-form-{{ $role->id }}" method="POST"
                                        action="{{ route('roles.destroy', $role->id) }}"
                                        style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('js')
@endpush
