@extends('backend.auth.master')

@section('title')
    Login
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
                        <a href="{{ route('front.home') }}">
                            <img src="{{ asset('/') }}backend/asset/logo/home-logo1.png" alt="logo" />
                        </a>
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

                <div class="dashboard-change-password-container shadow p-5 rounded-2 bg-white">
                    @if (Session::has('error'))
                    <div class="mb-4">
                        <span class="alert alert-danger" role="alert">
                            <i class="bi bi-exclamation-triangle-fill"></i>
                            {{ Session::get('error') }}</span>
                    </div>
                    @endif

                    <div class="text-center">
                        <p class="d-flex align-items-center justify-content-center mb-2">
                            <i class="fa-solid fa-unlock-keyhole"></i>
                        </p>
                        <h2 class="text-center change-passowrd-title">Login</h2>

                        <form action="{{ route('login') }}" method="POST" class="mt-4 text-start">
                            @csrf
                            <!--Email start-->
                            <div class="login-field mb-3">
                                <label for="uname" class="mb-2 fw-bold login-label">Email/phone</label>
                                <div class="input-group col-12 login-field">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-envelope"></i>
                                    </span>
                                    <input type="text" name="userName" value="{{old('userName')}}"
                                        class="form-control input-style py-2 small-text-12 @error('userName') is-invalid @enderror"
                                        placeholder="Enter your email or phone number" />
                                    @error('userName')
                                        <span class="invalid-feedback" role="alert">
                                            <small>{{ $message }}</small>
                                        </span>
                                    @enderror

                                </div>
                            </div>
                            <!--Email end-->

                            <!--Password start-->
                            <div class="login-field">
                                <label for="uname" class="mb-2 fw-bold login-label">Passowrd</label>
                                <div class="input-group col-12 login-field">
                                    <span class="input-group-text"><i class="fa-solid fa-unlock"></i></span>
                                    <input id="password" type="password" name="password"
                                        class="form-control input-style py-2 small-text-12 @error('password') is-invalid @enderror"
                                        placeholder="Enter your password" />
                                        <span class="input-group-text input-style">
                                            <i id="toggle-icon" class="fas fa-eye toggle-icon" onclick="togglePasswordVisibility()"></i>
                                        </span>
                                    {{-- <i id="toggle-icon" class="fas fa-eye toggle-icon" onclick="togglePasswordVisibility()"></i> --}}
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <small>{{ $message }}</small>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <!--Password start-->

                            <div class="d-flex justify-content-end mt-2">
                                <a href="{{ route('password.request') }}"
                                    class="small-text-12 forgot-pass fw-semibold">Forgot password?</a>
                            </div>

                            <div class="mt-4">
                                <button type="submit" class="btn register-btn w-100">
                                    Login
                                </button>
                            </div>
                        </form>
                        <div class="mt-2">
                            <p class="login-text">
                                Create a New account?
                                <a href="{{ route('register') }}" class="btn-label-text">
                                    Register
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js')
<script>
     function togglePasswordVisibility() {
      var passwordInput = document.getElementById("password");
      var toggleIcon = document.getElementById("toggle-icon");

      if (passwordInput.type === "password") {
        passwordInput.type = "text";
        toggleIcon.className = "fas fa-eye-slash toggle-icon";
      } else {
        passwordInput.type = "password";
        toggleIcon.className = "fas fa-eye toggle-icon";
      }
    }
</script>

@endpush
