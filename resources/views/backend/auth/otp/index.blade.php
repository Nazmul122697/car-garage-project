@extends('backend.auth.master')

@section('title')
    OTP Verification
@endsection

@push('css')
    <style>
        /* .password-toggle {
              position: relative;
              display: inline-block;
            }

            .password-toggle input[type="password"] {
              padding-right: 30px;
            }

            .password-toggle .toggle-icon {
              position: absolute;
              top: 50%;
              right: 5px;
              transform: translateY(-50%);
              cursor: pointer;
            } */
    </style>
@endpush

@section('content')
    <aside class="side-container">
        <div class="side-bg">
            <!-- <img src="./asset/image/side-reg.svg" alt="shape" /> -->
            <div class="side-content">
                <div class="d-flex flex-column align-items-center text-center">
                    <div class="side-logo">
                        <img src="{{ asset('/') }}backend/asset/logo/home-logo1.png" alt="logo" />
                    </div>
                    <div class="side-area-text">
                        <h5>Welcome to the</h5>
                        <p>E-Health Certification System</p>
                    </div>
                </div>
            </div>
        </div>
    </aside>

    <section class="register-container">
        <div class="container">
            <div class="registers-form">
                <div>
                    <h2 class="mb-4 text-center text-lg-start title">
                        OTP Verification
                    </h2>
                    <p class="mb-5 small-text-14 fw-semibold text-center text-lg-start">
                        Verification code sent to your phone number
                        <span class="ms-2">
                            {{ $formattedNumber }}
                        </span>

                        {{-- {{$user_id}} --}}
                    </p>
                    <p>Your otp code is <span>{{ $otp }}</span></p>
                    <p class="text-danger">
                        <small id="error-otp"></small>
                    </p>
                    <!--form start-->
                    {{-- <form action=""> --}}
                    <div class="d-flex flex-column gap-4">
                        <div class="d-flex gap-3 sign-up-OTP-input-field">
                            <input id="otp_digit" name="otp_digit" type="number" maxlength="4"
                                class="otp-field form-control input-style py-2 small-text-12 fw-semibold text-center"
                                required />
                        </div>
                        @if ($otp)
                            <div class="mt-4 verify_otp">
                                <button type="submit" id="verifyOtp" class="register-btn  d-flex justify-content-center">
                                    <div id="loader" class="d-none me-2">
                                        <span class="spinner-border spinner-border-sm" role="status"
                                            aria-hidden="true"></span>
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                    Verify
                                </button>
                            </div>
                        @endif

                    </div>
                    {{-- </form> --}}
                    <!--form end-->


                    <div class="form-button-area">
                        <div class="position-relative">
                            <hr class="sign-up-OTP-request-line" />
                            <!--otp time-->
                            <p id="otp-timer" class="sign-up-OTP-req-text">

                            </p>
                        </div>
                        <div class="resend_btn d-none">
                            <form action="{{ route('resend.otp') }}" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{ $userOtp->id }}">
                                <button type="submit" class="login-btn resent-otp">Resent OTP</button>
                            </form>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js')
    <script src="https://momentjs.com/downloads/moment.min.js"></script>
    <script>
        $(document).ready(function() {
            var expirationTime = '{{ $expirationTime }}';
            // console.log(expirationTime);
            var otpTimerElement = $('#otp-timer');

            function updateTimer() {
                var currentTime = moment();
                var remainingTime = moment(expirationTime).diff(currentTime);
                // console.log(expirationTime);

                if (remainingTime > 0) {
                    var duration = moment.duration(remainingTime);
                    var minutes = duration.minutes();
                    var seconds = duration.seconds();
                    var timerText = 'OTP expires in ' + minutes + ' minutes and ' + seconds + ' seconds';

                    otpTimerElement.text(timerText);
                    setTimeout(updateTimer, 1000); // Update the timer every second
                    $('.resent_otp').addClass('d-none')
                } else {
                    otpTimerElement.text('OTP has expired');
                    $('.resend_btn').removeClass('d-none')
                    $('.verify_otp').addClass('d-none');
                }
            }

            updateTimer();
        });

        $('#verifyOtp').click(function() {
            // var data = $('input[name="otp_digit"]')
            let otp_digit = $('#otp_digit').val();
            let id = {{ $userOtp->id }}
            // alert(otp_digit);

            if (otp_digit != null && otp_digit != '') {
                // console.log('not empty');
                $('#loader').removeClass('d-none');
                $('#verifyOtp').attr('disabled', true);

                $.ajax({
                    url: "{{ route('otp.verify') }}",
                    method: 'Post',
                    data: {
                        otp_digit: otp_digit,
                        id: id
                    },
                    // data: {otp_digit: otp_digit, user_id:user_id}
                    success: function(data) {
                        console.log(data);
                        window.location.href = '/register/verify_auth_email';
                        $('#loader').addClass('d-none');
                    },
                    error: function(error) {
                        let html = error.responseJSON.message;
                        $('#loader').addClass('d-none');
                        $('#verifyOtp').attr('disabled', false);
                        console.log('something went wrong', +error);
                        $('#error-otp').html('Please input your valid otp');
                    }
                });
            } else {
                $('#error-otp').html('Please input your valid otp');
            }

        });
    </script>
@endpush
