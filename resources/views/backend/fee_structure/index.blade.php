@extends('backend.master')

@push('css')
@endpush

@section('content')
    <div class="main-container">
        <div class="all-application-content">
            <h1 class="page-title">Fee Structure Manage</h1>

            @if (Auth::user()->hasPermission('fee-structures.create'))
            <div>
                <a href="{{ route('fee-structures.create') }}" class="btn btn-application">
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
                        <th class="text-center">Min</th>
                        <th class="text-center">Max</th>
                        <th class="text-center">Fee</th>
                        @if (Auth::user()->hasPermission('fee-structures.edit'))
                        <th class="text-center">Actions</th>
                        @endif
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach ($feeStructures as $feeStructure)
                        <tr>
                            <td class="table-td">{{ $loop->iteration }}</td>
                            <td class="table-td">{{@$feeStructure->min}} &#2547;</td>
                            <td class="table-td">{{@$feeStructure->max}} &#2547;</td>
                            <td class="table-td">{{@$feeStructure->fee}} &#2547;</td>
                            @if (Auth::user()->hasPermission('fee-structures.edit'))
                            <td>
                                @if (Auth::user()->hasPermission('fee-structures.edit'))
                                <a href="{{ route('fee-structures.edit', $feeStructure->id) }}" class="btn btn-action">
                                    <i class="fa fa-edit"></i>
                                    Edit
                                </a>
                                @endif
                            </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('js')
    <script>
        function deleteData(id) {
            if (confirm("Are you sure you want to delete this tutorial?")) {
                document.getElementById('delete-form-' + id).submit();
            }
        }


    </script>
@endpush
