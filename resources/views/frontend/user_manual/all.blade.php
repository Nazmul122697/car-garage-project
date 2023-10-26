@extends('frontend.master')

@section('title')
    User Manual
@endsection

@push('css')
    <style>
        .dataTables_paginate .paginate_button {
            border: 1px solid #ccc !important;
            padding: 5px 10px !important;
            /* margin: 0 5px !important; */
        }
    </style>
@endpush

@section('content')
    <main>
        <!-- banner start -->
        <div class="banner-container">
            <div class="container">
                <h1 class="banner-title">{{__('User Manual')}}</h1>
            </div>
        </div>
        <section class="about-container container">
            <div class="single-blog-container bg-white rounded shadow p-5">
                <h2 class="title">{{__('All User Manual')}}</h2>
                <div class="table-responsive">
                    <table id="dataTable" class="cell-border table-content" style="width: 100%">
                        <thead>
                            <tr class="table-th">
                                <th class="text-center"></th>
                                <th class="text-center"></th>
                            </tr>
                        </thead>

                        <tbody class="text-center">


                            @foreach ($userManuals as $userManual)
                                <tr>
                                    <td class="table-td">
                                        <span title="{{ Str::limit(@$userManual->title, 60, ' .....') }}">
                                            {{ Str::limit(@$userManual->title, 60, ' ...Pdf') }}
                                        </span>
                                        @if($userManual->title)
                                            <i class="bi bi-file-earmark-pdf-fill text-danger"></i>
                                        @endif
                                    </td>

                                    <td class="table-td">
                                        <form action="{{ route('front.user-manual.download') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ @$userManual->id }}">
                                            <button type="submit" class="btn rounded-5 btn-callNow">Download</button>
                                        </form>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </section>
    </main>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $("#dataTable").DataTable({
                scrollX: true,
                className: "cell-border",
                // paging: false,
                bLengthChange: false,
                ordering: false,
                info: false,
                // pagingType:"first_last_numbers",
                language: {
                    paginate: {
                        next: '<i class="fa-solid fa-angles-right">',
                        previous: '<i class="fa-solid fa-angles-left">'
                    }
                }
            });
        });
    </script>
@endpush
