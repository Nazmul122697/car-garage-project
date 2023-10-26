@extends('backend.master')

@section('title')
    User Management
@endsection

@push('css')
    <style>
        .custom-user-img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }
    </style>
@endpush

@section('content')
    <div class="main-container">
        <div class="all-application-content">
            <h1 class="page-title">Users Manage</h1>
            <div>
                <a href="{{ route('users.create') }}" class="btn btn-application">
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
                        <th class="text-center">E-mail</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Joined At</th>
                        @if (Auth::user()->hasPermission('users.show') ||
                                Auth::user()->hasPermission('users.edit') ||
                                Auth::user()->hasPermission('users.destroy'))
                            <th class="text-center">Actions</th>
                        @endif
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach ($users as $key => $user)
                        <tr>
                            <td class="table-td text-muted">#{{ $loop->iteration }}</td>
                            <td class="table-td">
                                <div class="d-flex flex-column align-items-center">
                                    <img src="{{ $user->avatar != null ? asset('upload/profile/' . @$user->avatar) : asset('placeholder.png') }}"
                                        class="img-fluid custom-user-img" alt="User Avatar">
                                    <span>{{ $user->name }}</span>
                                    <span class="badge bg-info">{{ $user->role->name }}</span>
                                </div>
                            </td>
                            <td class="table-td">{{ $user->email }}</td>
                            <td class="table-td">
                                @if ($user->status == true)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            </td>
                            <td class="table-td">{{ $user->created_at->diffForHumans() }}</td>
                            <td class="table-td">
                                @if (Auth::user()->hasPermission('users.show'))
                                    @if ($user->role_id != 1)
                                        <a href="{{ route('users.show', $user->id) }}" class="btn btn-action-view"
                                            title="Edit">
                                            <i class="fa fa-eye"></i>
                                            <span>Show</span>
                                        </a>
                                    @endif
                                @endif

                                @if (Auth::user()->hasPermission('users.edit'))
                                    @if ($user->role_id != 1)
                                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-action" title="Edit">
                                            <i class="fa fa-edit"></i>
                                            <span>Edit</span>
                                        </a>
                                    @else
                                        <span>N/A</span>
                                    @endif
                                @endif

                                @if (Auth::user()->hasPermission('users.destroy'))
                                    @if ($user->deletable == true)
                                        <button type="button" onclick="deleteData({{ $user->id }})"
                                            class="btn btn-action-remark" title="Delete">
                                            <i class="fa fa-trash-alt"></i>
                                            <span>Delete</span>
                                        </button>
                                    @endif

                                    <form id="delete-form-{{ $user->id }}" method="POST"
                                        action="{{ route('users.destroy', $user->id) }}" style="display: none;">
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
