@extends('backend.master')

@section('title')
    Help Desk
@endsection

@section('content')
    <div class="main-container">
        <div class="all-application-content">
            <h1 class="page-title">Help Line Completed Request</h1>
        </div>

        <!-- table -->
        <div class="table-contanier">
            <table id="dataTable" class="cell-border display table-content" style="width: 100%">
                <thead>
                    <tr class="table-th">
                        <th class="text-center">#SL</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Phone</th>
                        <th class="text-center">Subject</th>
                        <th class="text-center">Message</th>
                        <th class="text-center">Date Time</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach ($help_desks as $help_desk)
                        <tr>
                            <td class="table-td">{{ $loop->iteration }}</td>
                            <td class="table-td">{{ @$help_desk->name }}</td>
                            <td class="table-td">{{ @$help_desk->email }}</td>
                            <td class="table-td">{{ @$help_desk->phone }}</td>
                            <td class="table-td">{{ @$help_desk->subject }}</td>
                            <td class="table-td">{{ @$help_desk->message }}</td>
                            <td class="table-td">{{ @$help_desk->created_at->format('d/m/Y h:ia') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
