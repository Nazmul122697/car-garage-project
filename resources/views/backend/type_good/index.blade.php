@extends('backend.master')

@push('css')
@endpush

@section('content')
    <div class="main-container">
        <div class="all-application-content">
            <h1 class="page-title">Type of Good Manage</h1>

            @if (Auth::user()->hasPermission('type-goods.create'))
            <div>
                <a href="{{ route('type-goods.create') }}" class="btn btn-application">
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
                        <th class="text-center">Name</th>
                        <th class="text-center">Status</th>
                        @if (Auth::user()->hasPermission('type-goods.edit') || Auth::user()->hasPermission('type-goods.destroy'))
                        <th class="text-center">Actions</th>
                        @endif
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach ($type_goods as $tgood)
                        <tr>
                            <td class="table-td">{{ $loop->iteration }}</td>
                            <td class="table-td">{{ $tgood->name }}</td>
                            <td class="table-td">
                                @if ($tgood->status == 1)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            </td>
                            <td class="table-td">
                                @if (Auth::user()->hasPermission('type-goods.edit'))
                                    <a href="{{ route('type-goods.edit', $tgood->id) }}"
                                        class="btn btn-action" title="Edit">
                                        <i class="fa fa-edit"></i>
                                        <span>Edit</span>
                                    </a>
                                @endif

                                @if (Auth::user()->hasPermission('type-goods.destroy'))
                                    <button type="button" onclick="deleteData({{ $tgood->id }})"
                                        class="btn btn-action-remark" title="Delete">
                                        <i class="fa fa-trash-alt"></i>
                                        <span>Delete</span>
                                    </button>

                                    <form id="delete-form-{{ $tgood->id }}" method="POST"
                                        action="{{ route('type-goods.destroy', $tgood->id) }}"
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
