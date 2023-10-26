@extends('backend.auth.master')

@section('title')
    Verify Email
@endsection

@section('content')
<aside class="side-container">
    <div class="side-bg">
      <!-- <img src="./asset/image/side-reg.svg" alt="shape" /> -->
      <div class="side-content">
        <div class="d-flex flex-column align-items-center text-center">
          <div class="side-logo">
            <a href="{{route('front.home')}}">
                <img src="{{asset('/')}}backend/asset/logo/home-logo1.png" alt="logo" />
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
      <div class="registers-form email-check-verify">
        <div class="d-flex flex-column align-items-center">
          <div class="email-address-confirmed">
            <i class="fa-solid fa-check"></i>
          </div>
          <p class="mt-5 small-text-12 fw-medium text-center">
            We have sent an email to your email address
            {{-- <span class="fw-semibold">alamin****@g***.com</span> --}}
            <span class="fw-semibold">{{@$maskedEmail}}</span>
          </p>
          <p class="mt-2 small-text-14 fw-semibold text-center">
            Please Check Your Email To Get Username & Password
          </p>
        </div>
      </div>
    </div>
  </section>

@endsection
