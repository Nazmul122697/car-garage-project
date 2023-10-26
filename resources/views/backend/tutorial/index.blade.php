@extends('backend.master')

@push('css')
@endpush

@section('content')
    <div class="main-container">
        <div class="all-application-content">
            <h1 class="page-title">Tutorial Manage</h1>

            @if (Auth::user()->hasPermission('tutorials.create'))
            <div>
                <a href="{{ route('tutorials.create') }}" class="btn btn-application">
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
                        <th class="text-center">Url</th>
                        <th class="text-center">Status</th>
                        @if (Auth::user()->hasPermission('tutorials.edit') || Auth::user()->hasPermission('tutorials.destroy'))
                        <th class="text-center">Actions</th>
                        @endif
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach ($tutorials as $tutorial)
                        <tr>
                            <td class="table-td">{{ $loop->iteration }}</td>
                            <td class="table-td">{{ Str::limit($tutorial->title, 40, '...') }}</td>
                            <td class="table-td">{{ Str::limit($tutorial->url, 20, '...') }}</td>
                            <td class="table-td">
                                <span class="badge bg-{{ $tutorial->status == 1 ? 'success' : 'danger' }}">
                                    {{ $tutorial->status == 1 ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <!--Action btn start-->
                            @if (Auth::user()->hasPermission('tutorials.edit') || Auth::user()->hasPermission('tutorials.show') || Auth::user()->hasPermission('tutorials.destroy'))
                            <td>
                                @if (Auth::user()->hasPermission('tutorials.show'))
                                <a href="{{ route('tutorials.show', $tutorial->id) }}"
                                    class="btn btn-action-view"
                                    data-toggle="modal" data-target="#showModal"
                                    data-id="{{ $tutorial->id }}">
                                    <i class="fa fa-eye"></i>
                                    Show
                                </a>
                                @endif

                                @if (Auth::user()->hasPermission('tutorials.edit'))
                                <a href="{{ route('tutorials.edit', $tutorial->id) }}"
                                    class="btn btn-action">
                                    <i class="fa fa-edit"></i>
                                    Edit
                                </a>
                                @endif

                                @if (Auth::user()->hasPermission('tutorials.destroy'))
                                <button type="button" onclick="deleteData({{ $tutorial->id }})"
                                    class="btn btn-action-remark" title="Delete">
                                    <i class="fa fa-trash"></i>
                                    <span>Delete</span>
                                </button>
                                @endif

                                <form id="delete-form-{{ $tutorial->id }}" method="POST"
                                    action="{{ route('tutorials.destroy', $tutorial->id) }}" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                            @endif
                            <!--Action btn end-->
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!--tutorial show modal end-->
    <div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="showModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="showModalLabel">tutorial Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card" style="width: 100%;" id="modal_body">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--tutorial show modal end-->
@endsection

@push('js')
    <script>
        $(document).on('click', '.show', function() {
            // $("#showModal").modal('show');
            let id = $(this).data('id');
            $.get("tutorials/" + id, function(data) {
                $('#modal_body').html(data);
            });
        });
    </script>
@endpush
