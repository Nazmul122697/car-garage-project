@extends('backend.master')

@section('title')
    Customers Management
@endsection

@push('css')
    <style>
        .custom-user-img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }
    </style>
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endpush

@section('content')
    <div class="main-container">
        <div class="all-application-content">
            <h1 class="page-title">Customers Manage</h1>
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
                        {{-- @if (Auth::user()->hasPermission('users.show') ||
                                Auth::user()->hasPermission('users.edit') ||
                                Auth::user()->hasPermission('users.destroy')) --}}
                            <th class="text-center">Actions</th>
                        {{-- @endif --}}
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach ($users as $key => $user)
                        <tr>
                            <td class="table-td text-muted">#{{ $loop->iteration }}</td>
                            <td class="table-td">
                                <div class="d-flex flex-column align-items-center">
                                    <img src="{{ $user->avatar != null ? asset('upload/user_images/' . @$user->avatar) : asset('placeholder.png') }}"
                                        class="img-fluid custom-user-img" alt="User Avatar">
                                    <span>{{ $user->name }}</span>
                                    <span class="badge bg-info">{{ $user->role->name }}</span>
                                </div>
                            </td>
                            <td class="table-td">{{ $user->email }}</td>
                            <td class="table-td">
                                <input data-id="{{$user->id}}" class="toggle-class my_switch" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $user->status ? 'checked' : '' }}>
                            </td>
                            <td class="table-td">{{ $user->created_at->diffForHumans() }}</td>
                            <td class="table-td">
                                @if (Auth::user()->hasPermission('customers.show'))
                                    <a href="{{ route('customers.show', $user->id) }}" class="btn btn-action-view" title="Edit">
                                        <i class="fa fa-eye"></i>
                                        <span>Show</span>
                                    </a>
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
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script>
        $(function() {
            $('.toggle-class').change(function() {
                var status = $(this).prop('checked') == true ? 1 : 0;
                var user_id = $(this).data('id');

                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '{{ route('change.status') }}',
                    data: {'status': status, 'user_id': user_id},
                    success: function(data){
                        // console.log(data.success)
                        iziToast.success({
                            title: 'Success',
                            message: 'Status change successfully.',
                            position: 'topRight'
                        });
                    }
                });
            })
        })
    </script>
@endpush
