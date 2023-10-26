@extends('frontend.master')

@section('title')
    Help desk
@endsection

@push('css')
    <style>
        .form-control:focus {
            box-shadow: none !important;
            outline: 0px !important;
            border-color: #198754 !important;
        }

        .error {
            color: red;
        }
    </style>
@endpush

@section('content')
    <main>
        <!-- banner start -->
        <div class="banner-container">
            <div class="container">
                <h1 class="banner-title">{{ __('Help Desk') }}</h1>
            </div>
        </div>
        <section class="about-container contact-container bg-white rounded shadow">
            <div>
                @if (Session::has('success'))
                    <div class="alert alert-success" role="alert">
                        {{ Session::get('success') }}
                    </div>
                @endif
                @if (Session::has('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ Session::get('error') }}
                    </div>
                @endif

                <form action="{{ route('front.help.desk.submit') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name <sup class="text-danger">*</sup></label>
                                <input type="text" name="name" id="name" class="form-control"
                                    placeholder="Enter your name" value="{{ old('name') }}" autocomplete="off">
                                @error('name')
                                    <span class="text-danger" role="alert">
                                        <small>{{ $message }}</small>
                                    </span>
                                @enderror

                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone <sup class="text-danger">*</sup></label>
                                <input type="tel" name="phone" id="phone" class="form-control"
                                    placeholder="Enter your phone number" value="{{ old('phone') }}" autocomplete="off">
                                @error('phone')
                                    <span class="text-danger" role="alert">
                                        <small>{{ $message }}</small>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email <sup class="text-danger">*</sup></label>
                                <input type="email" name="email" id="email" class="form-control"
                                    placeholder="Enter your email" value="{{ old('email') }}" autocomplete="off">
                                @error('email')
                                    <span class="text-danger" role="alert">
                                        <small>{{ $message }}</small>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="subject" class="form-label">Subject <sup class="text-danger">*</sup></label>
                                <input type="text" name="subject" id="subject" class="form-control"
                                    placeholder="Enter your subject" value="{{ old('subject') }}" autocomplete="off">
                                @error('subject')
                                    <span class="text-danger" role="alert">
                                        <small>{{ $message }}</small>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="message" class="form-label">Message <sup class="text-danger">*</sup></label>
                                <textarea name="message" id="message" class="form-control" cols="" rows="9"
                                    placeholder="Enter your message" autocomplete="off">
                                    {{ old('message') }}
                                </textarea>
                                @error('message')
                                    <span class="text-danger" role="alert">
                                        <small>{{ $message }}</small>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary form-control">
                                    <i class="fa fa-paper-plane"></i>
                                    Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </main>
@endsection
