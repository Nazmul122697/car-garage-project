@extends('backend.master')

@section('title')
    Divisions Management
@endsection

@section('content')
<div class="main-container">
    <div class="all-application-content">
        <h1 class="page-title">Division Manage</h1>
    </div>

    <!-- table -->
    <div class="table-contanier" style="margin-top:0rem !important">
        <table id="dataTable" class="cell-border display table-content" style="width: 100%">
            <thead>
                <tr class="table-th">
                    <th class="text-center">SL</th>
                    <th class="text-center">Name</th>
                    <th class="text-center">URL</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @foreach ($divisions as $division)
                    <tr>
                        <td class="table-td">{{ $loop->iteration }}</td>
                        <td class="table-td">{{ $division->name }}</td>
                        <td class="table-td">{{ $division->url }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('js')

@endpush
