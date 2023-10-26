@extends('backend.master')
@section('title')
    Certificate
@endsection

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

    </div>

    <!--Preloader-->
    <div id="preloader" class="d-flex justify-content-center align-items-center">
        <div class="spinner-grow text-center bg-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>




    <!-- remark modal start -->
    <div class="modal fade" id="shareModal" tabindex="-1" aria-labelledby="shareModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header px-4">
                    <h2 class="modal-title fs-6 dashboard-title" id="shareModalLabel">
                        Share
                    </h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('share') }}" method="post">
                    @csrf
                    <div class="modal-body p-4">
                        <div class="login-field d-flex justify-content-center">
                            <div id="social-links ">

                                <button id="copy_btn" type="button" name="platform" value="copy"
                                    title="copy to clipboard" class="btn btn-dark">
                                    <i class="bi bi-clipboard"></i></button>

                                <button type="submit" name="platform" value="facebook" title="facebook"
                                    class="btn btn-primary">
                                    <i class="bi bi-facebook"></i></button>

                                <button type="submit" name="platform" value="linkedin" title="linkedin"
                                    class="btn btn-secondary">
                                    <i class="bi bi-linkedin"></i></button>

                                <button type="submit" name="platform" value="whatsapp" title="whatsapp"
                                    class="btn btn-info">
                                    <i class="bi bi-whatsapp"></i></button>

                                <button type="submit" name="platform" value="email" title="email" class="btn btn-danger">
                                    <i class="bi bi-envelope-at-fill"></i></button>
                            </div>
                            </textarea>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!-- modal end -->
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{ route('certificate') }}",
                type: "POST",
                data: {
                    application_id: "{{ $applicationId }}"
                },
                success: function(data) {
                    $('.main-container').append(data);
                    $('#preloader').addClass('d-none');
                },
                error: function(error) {
                    console.log('Something went wrong');
                }
            });
        });


        function printDiv(divId) {
            var printContents = document.getElementById(divId).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;
            window.print();

            document.body.innerHTML = originalContents;

        }

        document.getElementById("copy_btn").addEventListener("click", function() {
            var urlToCopy = "{{ route('customer.certificate.view', $applicationId) }}";
            $('#shareModal').modal('hide');
            navigator.clipboard.writeText(urlToCopy)
                .then(function() {
                    iziToast.success({
                        title: 'Copied',
                        message: 'URL copied to clipboard',
                        position: 'topRight',
                        fontSize: '14px',
                    });
                })
                .catch(function(error) {
                    iziToast.error({
                        title: 'Failed',
                        message: 'URL copied to clipboard',
                        position: 'topRight',
                        fontSize: '14px',
                    });
                });
        });
    </script>
@endpush
