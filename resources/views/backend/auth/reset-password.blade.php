@extends('backend.auth.master')

@section('title')
    Reset Password
@endsection

@section('content')
    <aside class="side-container">
        <div class="side-bg">
            <!-- <img src="./asset/image/side-reg.svg" alt="shape" /> -->
            <div class="side-content">
                <div class="d-flex flex-column align-items-center text-center">
                    <div class="side-logo">
                        <img src="{{asset('/')}}backend/asset/logo/home-logo1.png" alt="logo" />
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
            <div class="dashboard-change-password-container shadow p-5 rounded-2 bg-white">
                <div class="text-center">
                    <p class="d-flex align-items-center justify-content-center mb-2">
                        <i class="fa-solid fa-unlock-keyhole"></i>
                    </p>
                    <h2 class="text-center change-passowrd-title">Reset Your Passowrd</h2>

                    <form action="{{ route('password.store') }}" method="post" class="mt-4">
                        @csrf

                        <!-- Password Reset Token -->
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">

                        <!--Email start-->
                        <div class="input-group col-12 login-field mb-3">
                            <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                            <input type="email" name="email"
                                class="form-control input-style py-2 small-text-12  @error('email') is-invalid @enderror"
                                placeholder="Your reset email" value="{{$request->email ?? old('email')}}"/>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <!--Email password end-->

                        <!--new password start-->
                        <div class="input-group col-12 login-field mb-3">
                            <span class="input-group-text"><i class="fa-solid fa-unlock"></i></span>
                            <input type="password" name="password"
                                class="form-control input-style py-2 small-text-12 @error('password') is-invalid @enderror"
                                placeholder="Your New passowrd" />
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <!--new password end-->

                        <!--confirm password start-->
                        <div class="input-group col-12 login-field mb-3">
                            <span class="input-group-text"><i class="fa-solid fa-unlock"></i></span>
                            <input type="password" name="password_confirmation"
                                class="form-control input-style py-2 small-text-12  @error('password_confirmation') is-invalid @enderror"
                                placeholder="Confirm passowrd" />

                            @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <!--confirm password end-->

                        <div>
                            <button type="submit" class="btn register-btn py-2 w-100">
                                Change Passowrd
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
