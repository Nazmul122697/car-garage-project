@extends('frontend.master')

@section('content')
<div class="d-flex align-items-center justify-content-center vh-100">
    <div class="text-center">
        {{-- <h1 class="display-1 fw-bold">404</h1> --}}
        <p class="fs-3"> <span class="text-danger">Opps!</span> Cerificate not found.</p>
        <p class="lead">
           Please, try with a valid certificate number.
          </p>
        <a href="{{ route('front.home')}}" class="btn btn-primary">Go Home</a>
    </div>
</div>

@endsection
