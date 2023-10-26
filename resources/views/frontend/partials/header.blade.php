<header class="">
    @php
        $route = Route::currentRouteName();
        // dd($route);
    @endphp
    <nav class="navbar navbar-expand-lg z-3 nav-fixed shadow bg-white nav-bg-curve">
        <div class="px-lg-0 container">
            <a href="{{ route('front.home') }}">
                <div class="logo-text">
                    <div class="home-page-logo">
                        <img src="{{ @$website->logo ? asset('upload/website/' . $website->logo) : asset('frontend/asset/logo/home-logo1.png') }}"
                            alt="logo" />
                    </div>
                    <div class="logo-name">
                        <p>{{ __('Bangladesh Food') }}</p>
                        <p class="safty-auth">{{ __('Safety Authority') }}</p>
                    </div>
                </div>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <div class="ms-auto nav-list">
                    <ul class="navbar-nav input-field-contentlg-0">
                        <div class="overlay"></div>
                        <li class="nav-item">
                            <a class="nav-link nav-text {{ $route == 'front.home' ? 'navText-active' : '' }}"
                                href="{{ route('front.home') }}">{{ __('Home') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nav-text {{ $route == 'front.about.index' ? 'navText-active' : '' }}"
                                {{-- href="{{ route('front.about.index') }}">{{ __('About BFSA') }}</a> --}}
                                href="{{ route('front.online-verification') }}">{{ __('Online Verification') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nav-text {{ $route == 'front.contact.index' ? 'navText-active' : '' }}"
                                href="{{ route('front.contact.index') }}">{{ __('Contact Us') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nav-text {{ $route == 'front.user-manual.index' ? 'navText-active' : '' }}"
                                href="{{ route('front.user-manual.index') }}">{{ __('User Manual') }}</a>
                        </li>
                    </ul>
                </div>

                {{-- <div class="d-flex justify-content-between">
                    <div class="ms-2">
                        <a href="{{ route('login') }}">
                            <button type="button" class="btn bg-success text-white btn-user btn-register">
                                {{ __('Login') }}
                            </button>
                        </a>
                    </div>
                    <!--Login btn end-->
                </div> --}}

                {{-- <div class="form-check form-switch d-flex align-items-center gap-2 languge-content">
                    <p class="language-text">English</p>
                    <div>
                        <input class="form-check-input language-btn ms-0 mt-0 languageChange" type="checkbox" {{ Session::get('locale') == 'bn' ? 'checked' : '' }} />
                    </div>
                    <p class="language-text">বাংলা</p>
                </div> --}}

                <div class="d-lg-flex align-items-center">
                    <div class="d-flex align-items-center gap-2 nav-btn">
                        <a href="{{route('register')}}">
                            <button type="button" class="btn text-white btn-user btn-register">
                                {{__('Register')}}
                            </button>
                        </a>
                        <a href="{{route('login')}}">
                            <button type="button" class="btn btn-user btn-login text-white">
                                {{__('Login')}}
                            </button>
                        </a>
                    </div>

                    <div class="form-check form-switch d-flex align-items-center gap-2 languge-content">
                        <p class="language-text">{{ Session::get('locale') == 'bn' ? 'বাংলা' : 'ENG' }}</p>
                        <div>
                            <input class="form-check-input language-btn ms-0 mt-0 languageChange" type="checkbox" role="switch"
                            {{ Session::get('locale') == 'bn' ? 'checked' : '' }} />
                        </div>
                    </div>
                </div>

            </div>
        </div>
        </div>
    </nav>
</header>
