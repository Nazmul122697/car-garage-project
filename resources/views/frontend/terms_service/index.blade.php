@extends('frontend.master')

@section('title')
    Terms of Service
@endsection

@section('content')
    <main>
        <!-- banner start -->
        <div class="banner-container">
            <div class="container">
                <h1 class="banner-title">{{ __('Privacy Policy') }}</h1>
            </div>
        </div>

        <div class="container">
            <!-- Description start -->
            <div class="row mb-4">
                <div class="col-10 m-auto">
                    <p class="about-text">
                        {{ Session::get('locale') == 'bn' ? @$termService->description_bn : @$termService->description }}
                    </p>
                </div>
            </div>

        </div>
    </main>
@endsection
