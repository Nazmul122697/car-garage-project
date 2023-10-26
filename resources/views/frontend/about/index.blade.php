@extends('frontend.master')

<<<<<<< HEAD
@section('title')
    About us
@endsection
=======
@push('css')
    <style>
        .about-card{
            padding: 0 !important;
        }
    </style>
@endpush
>>>>>>> development

@section('content')
    <main>
        <!-- banner start -->
        <div class="banner-container">
            <div class="container">
                <h1 class="banner-title">{{ __('About Us') }}</h1>
            </div>
        </div>

        <div class="container about-container">
            <!-- about history us -->
            <div class="d-lg-flex gap-5">
                <div class="about-right">
                    <h2 class="ourHistory-title text-start">
                        {{ __('Our') }} <span class="title-color">{{ __('History') }}</span>
                    </h2>
                    <p class="about-text">
                        {{ Session::get('locale') == 'bn' ? @$about->history_bn : @$about->history }}
                    </p>
                </div>
                <div class="about-left">
                    <img src="{{ asset('upload/about/' . @$about->image) ?? asset('backend/asset/image/about.jpg') }}"
                        alt="" />
                </div>
            </div>


            <div class="about-mission">
                <!-- mission -->
                <div class="about-card shadow-sm">
                    <h2 class="ourHistory-title text-start d-flex align-items-center gap-2">
                        <i class="fa-solid fa-bullseye"></i>
                        <span>{{ __('Our') }} <span class="title-color"> {{ __('Mission') }}</span></span>
                    </h2>
                    <p class="about-text">
                        {{ Session::get('locale') == 'bn' ? @$about->mission_bn : @$about->mission }}
                    </p>
                </div>

                <!-- vission -->
                <div class="about-card shadow-sm">
                    <h2 class="ourHistory-title text-start d-flex align-items-center gap-2">
                        <i class="fa fa-low-vision" aria-hidden="true"></i>
                        <span>{{ __('Our') }} <span class="title-color">{{ __('Vision') }}</span></span>
                    </h2>
                    <p class="about-text">
                        {{ Session::get('locale') == 'bn' ? @$about->vision_bn : @$about->vision }}
                    </p>
                </div>

                <!-- stategy -->
                <div class="about-card shadow-sm">
                    <h2 class="ourHistory-title text-start d-flex align-items-center gap-2">
                        <i class="fa-solid fa-users-gear"></i>
                        <span>{{ __('Our') }} <span class="title-color">{{ __('Strategy') }}</span></span>
                    </h2>
                    <p class="about-text">
                        {{ Session::get('locale') == 'bn' ? $about->strategy_bn : $about->strategy }}
                    </p>
                </div>

                <!-- goals -->
                <div class="about-card shadow-sm">
                    <h2 class="ourHistory-title text-start d-flex align-items-center gap-2">
                        <i class="fa-solid fa-users-gear"></i>
                        <span> {{ __('Our') }} <span class="title-color">{{ __('Goals') }}</span> </span>
                    </h2>
                    <p class="about-text">
                        {{ Session::get('locale') == 'bn' ? @$about->goals_bn : @$about->goals }}
                    </p>
                </div>
            </div>
        </div>
    </main>
@endsection
