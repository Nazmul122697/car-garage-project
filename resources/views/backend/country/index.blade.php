@extends('backend.master')

@section('title')
    Countries Management
@endsection

@section('content')
<div class="main-container">
    <div class="all-application-content">
        <h1 class="page-title">Country Manage</h1>
    </div>

    <!-- table -->
    <div class="table-contanier" style="margin-top:0rem !important">
        <table id="dataTable" class="cell-border display table-content" style="width: 100%">
            <thead>
                <tr class="table-th">
                    <th class="text-center">SL</th>
                    <th class="text-center">Name</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @foreach ($countries as $country)
                    <tr>
                        <td class="table-td">{{ $loop->iteration }}</td>
                        <td class="table-td">{{ $country->name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('js')

@endpush
