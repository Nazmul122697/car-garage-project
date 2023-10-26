@extends('backend.master')

@section('title')
 Blog Manage
@endsection

@push('css')
@endpush

@section('content')
    <div class="main-container">
        <div class="all-application-content">
            <h1 class="page-title">Blog Manage</h1>

            @if (Auth::user()->hasPermission('blogs.create'))
            <div>
                <a href="{{ route('blogs.create') }}" class="btn btn-application">
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
                        <th class="text-center">Image</th>
                        <th class="text-center">Title</th>
                        <th class="text-center">Status</th>
                        @if (Auth::user()->hasPermission('blogs.edit') || Auth::user()->hasPermission('blogs.destroy'))
                        <th class="text-center">Actions</th>
                        @endif
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach ($blogs as $blog)
                        <tr>
                            <td class="table-td">{{ $loop->iteration }}</td>
                            <td class="table-td">
                                <img src="{{ asset('upload/blogs/' . @$blog->image) }}" class="img-fluid img-thumbnail"
                                    alt="" style="width: 50px;">
                            </td>
                            <td class="table-td">{{ Str::limit($blog->title, 50, '...') }}</td>
                            <td class="table-td">
                                <span class="badge bg-{{ $blog->status == 1 ? 'success' : 'danger' }}">
                                    {{ $blog->status == 1 ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <!--Action btn start-->
                            @if (Auth::user()->hasPermission('blogs.edit') || Auth::user()->hasPermission('blogs.show') || Auth::user()->hasPermission('blogs.destroy'))
                            <td>
                                @if (Auth::user()->hasPermission('blogs.show'))
                                <button class="btn btn-action-view show" data-toggle="modal" data-target="#showModal"
                                    data-id="{{ $blog->id }}">
                                    <i class="fa fa-eye"></i>
                                    Show
                                </button>
                                @endif
                                <!--Show btn end-->

                                <!--Edit btn start-->
                                @if (Auth::user()->hasPermission('blogs.edit'))
                                <a href="{{ route('blogs.edit', $blog->id) }}"
                                    class="btn btn-action">
                                    <i class="fa fa-edit"></i>
                                    Edit
                                </a>
                                @endif
                                <!--Edit btn end-->

                                <!--Delete btn start-->
                                @if (Auth::user()->hasPermission('blogs.destroy'))
                                <button type="button" onclick="deleteData({{ $blog->id }})"
                                    class="btn btn-action-remark" title="Delete">
                                    <i class="fa fa-trash"></i>
                                    <span>Delete</span>
                                </button>
                                @endif

                                <form id="delete-form-{{ $blog->id }}" method="POST"
                                    action="{{ route('blogs.destroy', $blog->id) }}" style="display: none;">
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

    <!--Blog show modal end-->
    <div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="showModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="showModalLabel">Blog Details</h5>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
                <div class="modal-body">
                    <div class="card" style="width: 100%;" id="modal_body">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Blog show modal end-->
@endsection

@push('js')
    <script>
        //Blog model
        $(document).on('click', '.show', function() {
            $("#showModal").modal('show');
            let id = $(this).data('id');
            $.get("blogs/" + id, function(data) {
                $('#modal_body').html(data);
            });
        });
    </script>
@endpush
