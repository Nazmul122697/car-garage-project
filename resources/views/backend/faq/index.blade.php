@extends('backend.master')

@push('css')
@endpush

@section('content')
    <div class="main-container">
        <div class="all-application-content">
            <h1 class="page-title">FAQ Manage</h1>

            {{-- @if (Auth::user()->hasPermission('faq.create')) --}}
            <div>
                <a href="{{ route('faq.create') }}" class="btn btn-application">
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
                        <th class="text-center">Title</th>
                        <th class="text-center">Description</th>
                        <th class="text-center">Status</th>
                        {{-- @if (Auth::user()->hasPermission('faq.edit') || Auth::user()->hasPermission('faq.destroy')) --}}
                        <th class="text-center">Actions</th>
                        {{-- @endif --}}
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach ($faqs as $faq)
                        <tr>
                            <td class="table-td">{{ $loop->iteration }}</td>
                            <td class="table-td">{{ Str::limit($faq->title, 40, '...') }}</td>
                            <td class="table-td">{{ Str::limit($faq->description, 20, '...') }}</td>
                            <td class="table-td">
                                <span class="badge bg-{{ $faq->status == 1 ? 'success' : 'danger' }}">
                                    {{ $faq->status == 1 ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <!--Action btn start-->
                            {{-- @if (Auth::user()->hasPermission('faq.edit') || Auth::user()->hasPermission('faq.show') || Auth::user()->hasPermission('faq.destroy')) --}}
                            <td>
                                {{-- @if (Auth::user()->hasPermission('faq.edit')) --}}
                                <a href="{{ route('faq.edit', $faq->id) }}"
                                    class="btn btn-action">
                                    <i class="fa fa-edit"></i>
                                    Edit
                                </a>
                                {{-- @endif --}}

                                {{-- @if (Auth::user()->hasPermission('faq.destroy')) --}}
                                <button type="button" onclick="deleteData({{ $faq->id }})"
                                    class="btn btn-action-remark" title="Delete">
                                    <i class="fa fa-trash"></i>
                                    <span>Delete</span>
                                </button>
                                {{-- @endif --}}

                                <form id="delete-form-{{ $faq->id }}" method="POST"
                                    action="{{ route('faq.destroy', $faq->id) }}" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                            {{-- @endif --}}
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
            $.get("faq/" + id, function(data) {
                $('#modal_body').html(data);
            });
        });
    </script>
@endpush
