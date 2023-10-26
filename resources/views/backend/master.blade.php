<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>BFSA Automation | @yield('title')</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('backend/asset/logo/favicon.ico') }}" />

    <!-- bootstrap css link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- bootstrap icon link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" />

    <!-- datatable cdn link  -->

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />

    <!-- font-awesome-icon cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />

    <!-- custom css -->
    <link rel="stylesheet" href="{{ asset('backend/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('backend/css/dashboard-style.css') }}" />

    <link href="{{ asset('css/iziToast.css') }}" rel="stylesheet">

    <style>
        .btn-save {
            background-color: #198754 !important;
            color: #fff !important;
            font-size: 12px !important;
            font-weight: 500;
            padding: 6px 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }

        .custom-dopdown-container {
            border: none;
            box-shadow: 0 0 20px #ccc;
            padding: 0;
        }

        .custom-dropdown-menu {
            width: 270px;
            height: auto !important;
            overflow-y: auto !important;
            max-height: 300px !important;
            min-height: 50px !important;
        }
        .custom-dropdown-menu li{
            margin-top: 3px !important;
        }

        .custom-dropdown-menu::-webkit-scrollbar {
            height: 8px;
            width: 8px;
            background: none;
            border-radius: 10px;
        }

        .custom-dropdown-menu::-webkit-scrollbar-thumb:vertical {
            background: #ccccccbd;
            border-radius: 10px;
        }

        .custom-noti-icon-btn {
            position: relative;
        }

        .custom-noti-icon-btn::after {
            display: none !important;
        }

        .custom-badge {
            position: absolute;
            top: 0;
            right: -7px;
            font-size: 10px;
            width: 14px;
            height: 14px;
            border-radius: 50%;
        }

        .dropdown-menu li :hover {
            background-color: #c8e1f5 !important;
        }

        .dropdown-item:active {
            color: #000000 !important;
        }

        .active-item {
            background-color: #c8e1f5 !important;
        }

        .dropdown-item-text {
            padding: 14px 12px !important;
            box-shadow: 0 10px 10px #e2e2e2;
            font-weight: 500;
            font-size: 13px;
            color: #212529;
        }

        .discription-title {
            max-width: 270px;
            font-weight: 500;
            font-size: 13px;
            color: #212529;
        }

        .view-all-section {
            padding: 14px 0;
            display: flex;
            justify-content: center;
            box-shadow: 0 -10px 10px #e2e2e2;
        }

        .view-all-section a {
            color: #30419b;
            font-size: 13px;
        }

        .noti-description {
            max-width: 270px;
            font-size: 12px;
            color: #9CA8B3;
        }

        .discription-time {
            font-size: 10px;
            color: #9CA8B3;
        }
    </style>

    @stack('css')
</head>

<body>
    @if (Session::has('customer_incomplete'))
        <script script>
            window.onload = function() {
                $('#profileModal').modal('show');
            };
        </script>
    @endif


    <div class="d-flex">
        @include('backend.partials.sidebar')

        <main id="main-container" class="dashboard-main">
            @include('backend.partials.header')

            @yield('content')
        </main>
        <!-- main-body end -->
    </div>

    @include('backend.partials.profile-modal')
    @include('backend.partials.modal')

    <!-- bootstrap js link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- jquery cdn -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!--Laravel share-->
    <script src="{{ asset('js/share.js') }}"></script>

    <!-- datatable cdn link -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

    <!-- custom js -->
    <script src="{{ asset('backend/js/app.js') }}"></script>
    <script src="{{ asset('backend/js/navbarToggle.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>

    <!-- sweetalert2 js -->
    <script type="text/javascript" src="{{ asset('js/sweetalert2@11.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/customSweetalert2.js') }}"></script>

    <script src="{{ asset('js/iziToast.js') }}"></script>
    <script src="{{ asset('js/helper.js') }}"></script>

    @include('vendor.lara-izitoast.toast')

    @stack('js')

    <script>


        $(document).ready(function() {

            $("#dataTable").DataTable({
                scrollX: true,
                className: "cell-border",
            });

            $('.select2').select2({
                width: '100%'
            });

            // if ({{ Session::has('customer_incomplete') }}) {
            //     window.onload = function() {
            //         $('#profileModal').modal('show');
            //         $('.select2').select2({
            //             width: '100%'
            //         });
            //     };
            // }

        });
    </script>
</body>

</html>
