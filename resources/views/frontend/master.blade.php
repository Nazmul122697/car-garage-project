<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/x-icon" href="{{ asset('frontend/asset/logo/favicon.ico') }}" />

    <!-- bootstrap css link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- bootstrap icon link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" />

    <!-- datatable cdn link  -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />

    <!-- font-awesome-icon cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />



    <!-- custom css -->
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/dashboard-style.css') }}" />
    @stack('css')

    <title>BFSA Automation | @yield('title')</title>
</head>

<body class="body-container">
    @include('frontend.partials.header')
    @yield('content')
    @include('frontend.partials.footer')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <!-- Datatable cdn -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

    <!-- bootstrap js link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>



    <!-- custom js -->
    {{-- <script src="{{ asset('frontend/js/cient-side.js') }}"></script> --}}
    <script src="{{ asset('frontend/js/navActiveClient.js') }}"></script>

    @stack('js')

    <script>
        $('.languageChange').click(function() {
            var mode = $(this).prop('checked');
            if (mode == true) {
                var langVal = 'bn';
            } else {
                var langVal = 'en';
            }

            $.ajax({
                type: 'GET',
                url: '/lang/' + langVal,
                success: function(data) {
                    location.reload();
                },
                error: function(data) {
                    console.log('Something went wrong.');
                }
            });
        });
    </script>
</body>

</html>
