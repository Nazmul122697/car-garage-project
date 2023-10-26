@extends('backend.master')

@section('title')
    User Manual
@endsection

@section('content')
    <div class="main-container">
        <div class="all-application-content">
            <h1 class="page-title">User Manual Manage</h1>

            @if (Auth::user()->hasPermission('user-manuals.create'))
            <div>
                <a href="{{ route('user-manuals.create') }}" class="btn btn-application">
                    <i class="fa-solid fa-circle-plus puls-app"></i>
                    Create
                </a>
            </div>
            @endif
        </div>

        <!-- table -->
        <div class="table-contanier">
            <table id="dataTable" class="cell-border display table-content" style="width: 100%">
                <thead>
                    <tr class="table-th">
                        <th class="text-center">#SL</th>
                        <th class="text-center">Title</th>
                        <th class="text-center">File</th>
                        <th class="text-center">Status</th>
                        @if (Auth::user()->hasPermission('user-manuals.edit') || Auth::user()->hasPermission('user-manuals.destroy'))
                        <th class="text-center">Actions</th>
                        @endif
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach ($user_manuals as $user_manual)
                        <tr>
                            <td class="table-td">{{ $loop->iteration }}</td>
                            <td class="table-td">{{ Str::limit($user_manual->title, 60, '.....') }}</td>
                            <td class="table-td">
                                @if($user_manual->file)
                                <i class="bi bi-file-earmark-pdf-fill fs-3 text-danger"></i>
                                @endif
                            </td>
                            <td class="table-td">
                                <span class="badge bg-{{ $user_manual->status == 1 ? 'success' : 'danger' }}">
                                    {{ $user_manual->status == 1 ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <!--Action btn start-->
                            @if (Auth::user()->hasPermission('user-manuals.edit') || Auth::user()->hasPermission('user-manuals.show') || Auth::user()->hasPermission('user-manuals.destroy'))
                            <td>
                                <!--Show btn start-->

                                @if (Auth::user()->hasPermission('user-manuals.show'))
                                <a href="{{route('user-manuals.show',$user_manual->id)}}"
                                    class="btn btn-action-view">
                                    <i class="fa fa-eye"></i>
                                    Show
                                </a>
                                @endif
                                <!--Show btn end-->

                                <!--Edit btn start-->
                                @if (Auth::user()->hasPermission('user-manuals.edit'))
                                <a href="{{ route('user-manuals.edit', $user_manual->id) }}"
                                    class="btn btn-action">
                                    <i class="fa fa-edit"></i>
                                    Edit
                                </a>
                                @endif
                                <!--Edit btn end-->

                                <!--Delete btn start-->
                                @if (Auth::user()->hasPermission('user-manuals.destroy'))
                                <button type="button" onclick="deleteData({{ $user_manual->id }})"
                                    class="btn btn-action-remark" title="Delete">
                                    <i class="fa fa-trash"></i>
                                    <span>Delete</span>
                                </button>
                                @endif

                                <form id="delete-form-{{ $user_manual->id }}" method="POST"
                                    action="{{ route('user-manuals.destroy', $user_manual->id) }}" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                <!--Delete btn end-->
                            </td>
                            @endif
                            <!--Action btn end-->
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
