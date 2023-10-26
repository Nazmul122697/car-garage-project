@extends('backend.master')

@section('title')
    Change Password
@endsection

@section('content')
    <!-- main body content start -->
    <div class="main-container">
        <div class="dashboard-change-password-container shadow p-5 rounded-2">
            <div class="text-center">
                <p class="d-flex align-items-center justify-content-center mb-2">
                    <i class="fa-solid fa-unlock-keyhole"></i>
                </p>
                <h2 class="text-center change-passowrd-title">Change Passowrd</h2>

                <form action="{{ route('password.change.update') }}" class="mt-4" method="post">
                    @csrf
                    <p class="make-password">
                        Make Sure you remember your Password
                    </p>

                    <!--current password start-->
                    <div class="input-group col-12 login-field mb-3">
                        <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                        <input type="password" name="current_password"
                            class="form-control input-style py-2 small-text-12 @error('current_password') is-invalid @enderror"
                            placeholder="Your current passowrd" />
                        @error('current_password')
                            <span class="invalid-feedback" role="alert">
                                <span>{{ $message }}</span>
                            </span>
                        @enderror
                    </div>
                    <!--current password end-->

                    <!--new password end-->
                    <div class="input-group col-12 login-field mb-3">
                        <span class="input-group-text"><i class="fa-solid fa-unlock"></i></span>
                        <input type="password" name="password"
                            class="form-control input-style py-2 small-text-12  @error('password') is-invalid @enderror"
                            placeholder="Your New passowrd" />
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <span>{{ $message }}</span>
                            </span>
                        @enderror
                    </div>
                    <!--new password end-->

                    <!--confirm password start-->
                    <div class="input-group col-12 login-field mb-3">
                        <span class="input-group-text"><i class="fa-solid fa-unlock"></i></span>
                        <input type="password" name="password_confirmation"
                            class="form-control input-style py-2 small-text-12 @error('password_confirmation') is-invalid @enderror"
                            placeholder="Confirm passowrd" />
                        @error('password_confirmation')
                            <span class="invalid-feedback" role="alert">
                                <span>{{ $message }}</span>
                            </span>
                        @enderror
                    </div>
                    <!--confirm password end-->

                    <div>
                        <button type="submit" class="btn btn-application py-2 w-100">
                            Change Passowrd
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- main body content end -->
@endsection
