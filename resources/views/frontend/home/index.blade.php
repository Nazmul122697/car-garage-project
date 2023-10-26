@extends('frontend.master')

@section('title')
    Home
@endsection

@push('css')
    <style>
        /* .banner-container {
                            background-image: url('{{ asset('frontend/asset/image/homeBanner1.png') }}');
                            background-position: right;
                            background-repeat: no-repeat;
                            background-size: cover;
                            height: 70vh;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                        } */

        .banner-title {
            color: #1d4943 !important;
            font-size: 28px;
            font-weight: 700;
            line-height: 45px;
            text-align: center;
            margin-top: -3rem;
        }

        .banner-text-content {
            position: absolute;
            top: 43%;
            left: 0;
            right: 0;
            margin-left: auto;
            margin-right: auto;
        }

        .banner-title-info {
            width: 75%;
            margin-left: auto;
            margin-right: auto;
            /* padding-left: 10px;
                  padding-left: 10px; */
        }

        @media only screen and (max-width: 767px) {

            /* new css added start  */
            .banner-title-info {
                width: 95%;
                padding-left: 10px;
                padding-left: 10px;
            }

            .banner-title {
                font-size: 20px;
                line-height: 20px;
                margin-top: -1rem;
            }

            /* new css added end  */
        }

        @media only screen and (min-width: 768px) and (max-width: 991px) {

            /* new css added start */
            .banner-title-info {
                width: 75%;
                padding-left: 10px;
                padding-left: 10px;
            }
        }
    </style>
@endpush

@section('content')
    <main>
        <!-- banner start -->
        <section>

            <div id="carouselSlider1" class="carousel slide carousel-fade" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <!-- slider-1 -->
                    {{-- @foreach ($sliders as $key => $slider) --}}
                    @if (Session::get('locale') == 'bn')
                        <img src="{{ $sliders[0]->image != '' ? asset('upload/slider/' . $sliders[0]->image) : asset('frontend/asset/image/homeBanner1.png') }}"
                            class="w-100" alt="..." />
                        <div class="text-center banner-text-content">
                            <div class="banner-title-info">
                                <h1 class="banner-title">{{ $sliders[0]->title }}</h1>
                            </div>
                        </div>
                    @else
                        <img src="{{ $sliders[1]->image != '' ? asset('upload/slider/' . $sliders[1]->image) : asset('frontend/asset/image/homeBanner2.png') }}"
                            class="w-100" alt="..." />
                        <div class="text-center banner-text-content">
                            <div class="banner-title-info">
                                <h1 class="banner-title">{{ $sliders[1]->title }}</h1>
                            </div>
                        </div>
                    @endif

                    {{-- <div class="sliders-img carousel-item {{ $key == 0 ? 'active' : '' }} carousel-item-list position-relative"> --}}
                    {{-- <img src="{{ $slider->image != "" ? asset('upload/slider/'.$slider->image) : asset('frontend/asset/image/homeBanner1.png') }}" class="w-100" alt="..." />
                            <div class="text-center banner-text-content">
                                <div class="banner-title-info">
                                    <h1 class="banner-title">{{ $slider->title }}</h1>
                                </div>
                            </div> --}}
                    {{-- </div> --}}
                    {{-- @endforeach --}}
                </div>
            </div>
        </section>

        <!-- banner end -->

        <!--Counter start-->
        {{-- <div class="container shadow rounded-4 searchLab-container bg-white">
            <div class="searchLab-grid">
                <div class="d-flex align-items-center justify-content-center gap-4">
                    <div><i class="fa-solid fa-microscope search-icon"></i></div>
                    <div class="search-content">
                        <h4>{{ @$website->lab ?? 0 }}</h4>
                        <p>{{ __('Labs') }}</p>
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-center gap-4">
                    <div>
                        <i class="fa-solid fa-flask-vial search-icon"></i>
                    </div>
                    <div class="search-content">
                        <h4>{{ @$website->parameter ?? 0 }}</h4>
                        <p>{{ __('Parameters') }}</p>
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-center gap-4">
                    <div><i class="fa-solid fa-bowl-food search-icon"></i></div>
                    <div class="search-content">
                        <h4>{{ @$website->food_type ?? 0 }}</h4>
                        <p>{{ __('Food Types') }}</p>
                    </div>
                </div>
            </div>
        </div> --}}
        <!--Counter end-->

        <!-- our service start -->
        <div class="section-container mt-5">
            <div class="title-content container">
                <h1 class="title">
                    {{ __('About the System') }}
                </h1>
                <p class="text service-text">
                    {{ __('The e-Health Certification System is a digital platform that manages export health certificate issuance process, including registration of exporters, inspection of products and laboratory testing, payment of fees and approval of health certificate. It enhances efficiency, transparency and accountability and ensures speedy issuance of certificate for exportable food products') }}
                </p>
            </div>
            <div class="bg-white">
                <div class="container">
                    <div class="service-grid">
                        <div class="d-flex align-items-center gap-4">
                            <div class="service-details position-relative">
                                <i class="fa-solid fa-desktop service-icon"></i>
                                <p class="service-step">1</p>
                            </div>
                            <div class="service-content">
                                <h3>{{ __('Register') }}</h3>
                                <p>{{ __('Sign up and create an account to use the system for e-Health Certification') }}
                                </p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-4">
                            <div class="service-details position-relative">
                                <i class="fa-solid fa-file-invoice service-icon"></i>
                                <p class="service-step">2</p>
                            </div>
                            <div class="service-content">
                                <h3>{{ __('Application for e-Health Certificate') }}</h3>
                                <p>{{ __('Fill out the prescribed application form along with required detailed information for health certificate') }}
                                </p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-4">
                            <div class="service-details position-relative">
                                <i class="fa-solid fa-credit-card service-icon"></i>
                                <p class="service-step">3</p>
                            </div>
                            <div class="service-content">
                                <h3>{{ __('Payment') }}</h3>
                                <p>{{ __('Pay fee/charges') }}</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-4">
                            <div class="service-details position-relative">
                                <i class="fa-solid fa-vials service-icon"></i>
                                <p class="service-step">4</p>
                            </div>
                            <div class="service-content">
                                <h3>{{ __('Sample Collection') }}</h3>
                                <p>{{ __('Collect sample(s) and send for laboratory test') }}</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-4">
                            <div class="service-details position-relative">
                                <i class="fa-solid fa-vial service-icon"></i>
                                <p class="service-step">5</p>
                            </div>
                            <div class="service-content">
                                <h3>{{ __('Test Report') }}</h3>
                                <p>{{ __('Test sample(s) at selected laboratory and send report') }}</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-4">
                            <div class="service-details position-relative">
                                <i class="fa-solid fa-certificate service-icon"></i>
                                <p class="service-step">5</p>
                            </div>
                            <div class="service-content">
                                <h3>{{ __('Certificate Issuance') }}</h3>
                                <p>{{ __('Verify laboratory test report and issue certificate') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- our service end -->


        <!-- blog start -->
        @if (count($blogs) > 0)
            <div class="container section-container">
                <div class="title-content container">
                    <h1 class="title">
                        @if (Session::get('locale') !== 'bn')
                            Read from Our <span class="title-color"> Blog</span>
                        @else
                            আমাদের <span class="title-color"> ব্লগ</span> থেকে পড়ুন
                        @endif
                    </h1>
                    <p class="text service-text">
                        {{ __("Discover how the Bangladesh Food Safety Authority Automation System revolutionizes food safety practices, streamlining processes and ensuring safe, high-quality food for all. Learn how this digital platform enhances efficiency, transparency, and accountability in Bangladesh's food industry") }}
                    </p>
                </div>
                <div class="blog-grid">
                    @foreach ($blogs as $blog)
                        <div class="blog-card shadow">
                            <div class="blog-img">
                                <img src="{{ asset('upload/blogs/' . @$blog->image) }}" alt="blog-image" />
                            </div>
                            <div class="date-time">
                                <p class="d-flex align-items-center gap-1">
                                    <i class="fa-regular fa-calendar"></i>
                                    <span>{{ @$blog->created_at->format('F d, Y') }}</span>
                                </p>
                                <p class="d-flex align-items-center gap-1">
                                    <i class="fa-regular fa-clock"></i>
                                    <span>{{ @$blog->created_at->diffForHumans() }}</span>
                                </p>
                            </div>
                            <hr />
                            <div class="blog-content">
                                <h4>{{ Str::limit(@$blog->title, 40, '....') }}</h4>

                                <p>
                                    {!! Str::substr(strip_tags(@$blog->description), 0, 180) !!}
                                    {{-- @if (strlen(strip_tags($blog->description)) > 50)...@endif --}}

                                </p>
                                <a href="{{ route('front.blog.single', @$blog->slug) }}"
                                    class="btn-view d-flex align-items-center gap-1">{{ __('Read More') }} <i
                                        class="fa-solid fa-arrow-right-long"></i></a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-5 text-center">
                    <a href="{{ route('front.blog.index') }}" type="button"
                        class="btn bg-success text-white btn-user btn-register">
                        {{ __('View More') }}
                    </a>
                </div>
            </div>
        @endif
        <!-- blog end -->
    </main>
@endsection

@push('js')
    <script></script>
@endpush
