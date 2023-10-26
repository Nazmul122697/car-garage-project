@extends('backend.master')

@push('css')
    <style>
        .custom-title-box{
            padding: 20px 0 ;
        }

        .custom-user-manager{
            margin-bottom: 1rem;
            padding: 0 0 0 40px;
        }

        .btn{
            border-radius: 3px;
            font-size: 13px;
        }

        .content{
            padding: 0 15px 10px 15px !important;
        }

        .custom-table{
            font-size: 13px;
        }
    </style>
@endpush

@section('content')
    <div class="content">
        <div class="container-fluid shadow-lg" style="margin-top: 40px;">
            <div class="page-title-box custom-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-12">
                        <ol class="d-flex justify-content-between custom-user-manager">
                            <div style="font-size: 1.25rem;">User Manage</div>
                            <div class="float-right">
                                <a href="{{ route('users.edit', $user->id) }}" class="btn-shadow mr-3 btn btn-success">
                                    <i class="fa fa-edit"></i>
                                    <span>Edit user</span>
                                </a>
                                <a href="{{ route('users.index') }}" class="btn-shadow mr-3 btn btn-danger">
                                    <i class="fa fa-arrow-circle-left"></i>
                                    <span>Back to list</span>
                                </a>
                            </div>
                        </ol>
                    </div>
                </div> <!-- end row -->
            </div>
            <!-- end page-title -->

            <div class="row shadow">
                <div class="col-md-2">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <img src="{{ $user->avatar != null ? asset('upload/profile/' . @$user->avatar) : asset('placeholder.png') }}"
                                class="img-fluid img-thumbnail" alt="User Avatar">
                        </div>
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="main-card mb-3 card" style="padding: 10px;">
                        <div class="card-body p-0">
                            <table class="table table-hover mb-0 custom-table">
                                <tbody>
                                    <tr>
                                        <th scope="row">Name: </th>
                                        <td>{{ $user->name }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Email: </th>
                                        <td>{{ $user->email }}</td>
                                    </tr>

                                    <tr>
                                        <th scope="row">Phone: </th>
                                        <td>{{ $user->phone }}</td>
                                    </tr>

                                    <tr>
                                        <th scope="row">Role: </th>
                                        <td>
                                            @if ($user->role)
                                                <span class="badge bg-info">{{ $user->role->name }}</span>
                                            @else
                                                <span class="badge bg-warning">No role found :(</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Status: </th>
                                        <td>
                                            @if ($user->status == true)
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-danger">Inactive</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @if ($user->warehouse_id != null)
                                        <tr>
                                            <th scope="row">Warehouse: </th>
                                            <td>{{ $user->warehouse->name }}</td>
                                        </tr>
                                    @endif
                                    @if ($user->outlet_id != null)
                                        <tr>
                                            <th scope="row">Outlet: </th>
                                            <td>{{ $user->outlet->name }}</td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <th scope="row">Last Modify At: </th>
                                        <td>{{ @$user->update_at ? $user->update_at->diffForHumans() : 'No modify' }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Join At: </th>
                                        <td>{{ $user->created_at->diffForHumans() }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- container-fluid -->
    </div>
@endsection
