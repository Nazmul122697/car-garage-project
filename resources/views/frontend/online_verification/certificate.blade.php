@extends('frontend.master')

@push('css')
    <style>
        .customers td,
        .customers th {
            text-align: left !important;
        }

        .btn_share {
            background: #467bce;
            box-shadow: 0px 12.1167px 24.2334px rgba(1, 11, 253, 0.12);
            color: #fff !important;
            font-size: 14px !important;
            font-weight: 500;
            padding: 8px 80px;
            border: 1px solid #467bce;
            margin-left: 50px;
        }

        .btn_share:hover,
        .btn_share:active {
            background: #467bce;
        }

        .btn_share.btn-check:checked+.btn_share.btn,
        .btn_share.btn.active,
        .btn_share.btn.show,
        .btn_share.btn:first-child:active,
        :not(.btn-check)+.btn:active {
            color: var(--bs-btn-active-color);
            background-color: #467bce;
            border-color: #467bce;
        }

        #preloader {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 9999;
        }

        #preloader .spinner-grow {
            position: relative;
        }
    </style>
@endpush

@section('content')
    <div class="main-container">
        {{-- @include('backend.certificate.certificate_view') --}}
        @include('frontend.online_verification.certificate_view')
    </div>
@endsection

@push('js')
    <script>


        function printDiv(divId) {
            var printContents = document.getElementById(divId).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;
            window.print();

            document.body.innerHTML = originalContents;

        }
    </script>
@endpush
