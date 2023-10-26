@extends('backend.auth.master')

@section('title')
    Forgot Password
@endsection

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
            <div class="login-reset-email">
                <div>
                    <h2 class="mb-3 text-center text-lg-start title">
                        Reset Password
                    </h2>
                    <p class="text-success"><small>{{ session('status') ? session('status') : '' }}</small></p>
                    <div class="d-flex flex-column gap-4">
                        <form action="{{ route('password.email') }}" method="post">
                            @csrf
                            <div class="login-field">
                                <label for="uname" class="mb-2">Email</label>
                                <div class="position-relative">
                                    <input type="text" id="uname" name="email"
                                        placeholder="Enter your email here"
                                        value="{{old('email')}}"
                                        class="form-control input-style py-2 pe-5 small-text-12 @error('email') is-invalid @enderror" />
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <div class="email-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="mt-5">
                                    <button type="submit" class="register-btn">
                                        Send email
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
