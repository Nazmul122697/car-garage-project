@extends('frontend.master')

@push('css')
    <style>
        /* .faq-left {
                        width: 100%;
                    }

                    .faq-right {
                        width: 60%;
                        margin: 0 auto;
                    }

                    .faq-right img {
                        width: 100%;
                    } */

        /* home faq */
        .faq-content {
            display: flex;
            align-items: center;
            gap: 3.2rem;
            flex-direction: column-reverse;
        }

        .faq-left {
            width: 100%;
        }

        .faq-right {
            width: 60%;
            margin: 0 auto;
        }

        .faq-right img {
            width: 100%;
        }

        .faq-btn {
            font-size: 0.875rem !important;
            font-weight: 600;
            color: var(--secondary-color) !important;
            background-color: transparent !important;
        }

        .faq-btn:focus {
            outline: none !important;
            box-shadow: none;
            border-color: rgba(0, 0, 0, 0.125);
        }


        /* medium device */
        /* @media only screen and (min-width: 768px) and (max-width: 991px) {
                .home-service-container {
                    grid-template-columns: repeat(2, 1fr);
                }

                .home-service-icon {
                    width: 70px;
                }

                .hero-banner img {
                    height: 65vh;
                }

                .hero-banner-text h1 {
                    font-size: 1.5rem;
                }

                .hero-banner-text h2 {
                    font-size: 0.875em;
                }

                .home-how-service-work-container {
                    grid-template-columns: repeat(2, 1fr);
                }

                .main-container {
                    flex-direction: row;
                }

                .side-container {
                    width: 30%;
                }

                .register-container {
                    width: 65%;
                    margin: 100px auto;
                    padding: 0 80px;
                }

                .side-content {
                    width: 100%;
                    padding: 0 20px 60px;
                }

                .service-banner-title {
                    font-size: 30px;
                }

                .all-notice-search {
                    width: 220px;
                    margin-top: 0;
                }

                .our-service-sub-title {
                    font-size: 16px;
                }

                .about-banner-text h1 {
                    font-size: 1.5rem;
                }

                .service-container {
                    max-width: 720px;
                }
            } */

        /* large device */
        @media only screen and (min-width: 992px) and (max-width: 1199px) {
            .faq-content {
                flex-direction: row;
            }

            .faq-left {
                width: 60%;
            }

            .faq-right {
                width: 40%;
            }
        }

        /* extra large device */
        @media only screen and (min-width: 1200px) {
            .faq-content {
                flex-direction: row;
            }

            .faq-left {
                width: 60%;
            }

            .faq-right {
                width: 40%;
            }
        }
    </style>
@endpush

@section('content')
    <main>
        <!-- banner start -->
        <div class="banner-container">
            <div class="container">
                <h1 class="banner-title">{{ __('FAQ') }}</h1>
            </div>
        </div>

        <div class="container">
            <!-- Description start -->
            <div class="row mb-4">
                <div class="col-10 m-auto faq-content">
                    {{-- <p class="about-text">
                    </p> --}}
                    <div class="faq-left">
                        <div class="accordion" id="accordionFAQ">
                            @foreach($faqs as $faq)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="faqHeading1">
                                        <button
                                            class="accordion-button faq-btn d-flex align-item-center justify-content-between"
                                            type="button" data-bs-toggle="collapse" data-bs-target="#collapseFaq1"
                                            aria-expanded="true" aria-controls="collapseFaq1">
                                            {{ $faq->title }}
                                        </button>
                                    </h2>
                                    <div id="collapseFaq1" class="accordion-collapse collapse show"
                                         aria-labelledby="faqHeading1" data-bs-parent="#accordionFAQ">
                                        <div class="accordion-body">
                                            <p class="small-text-12">
                                                {{ $faq->description }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="faq-right">
                        <div>
                            <img src="{{ asset('frontend/asset/home-faq.svg') }}" alt="faq" />
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>
@endsection
