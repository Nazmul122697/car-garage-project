<footer class="bg-white">
    <div class="container">
        <div class="footer-grid">
            <div>
                <div>
                    <h3 class="footer-title text-center">{{__('Quick Links')}}</h3>
                    <ul class="footer-nav-link">
                        <li><a href="http://www.bfsa.gov.bd/" target="_blank">{{__('BFSA')}}</a></li>
                        <li>
                            <a href="{{ route('front.faq.index') }}">{{__('FAQ')}}</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div>
                <div>
                    <h3 class="footer-title text-center">{{__('LEGAL')}}</h3>
                    <ul class="footer-nav-link">
                        <li><a href="{{route('front.terms-service.index')}}">{{__('Privacy Policy')}}</a></li>
                    </ul>
                </div>
            </div>
            <div>
                <div>
                    <h3 class="footer-title text-center">{{__('COMMUNICATION')}}</h3>
                    <ul class="footer-nav-link">
                        {{-- <li>
                            <a href="mailto:{{@$website->email}}">{{@$website->email}}</a>
                        </li> --}}
                        <li><a href="{{route('front.help.desk')}}">{{__('Help Desk')}}</a></li>
                        {{-- <li><a>{{@$website->phone}}</a></li> --}}
                    </ul>
                    {{-- <div class="text-center social-icon d-flex align-items-center gap-3 justify-content-center">
                        <a href="{{@$website->facebook}}"> <i class="fa-brands fa-square-facebook"></i></a>
                        <a href="{{@$website->linkedin}}"><i class="fa-brands fa-linkedin"></i></a>
                        <a href="{{@$website->youtube}}"> <i class="fa-brands fa-youtube"></i></a>
                    </div> --}}
                </div>
            </div>
        </div>
        <hr class="mb-0" />
        <div class="footer-grid-two">
            <div class="d-flex align-items-center justify-content-center gap-1 footer-planning">
                <a href="" class="palning-text">
                    <p class="text-center">{{__('Implementation and Supported by')}}</p>
                </a>
                <div class="footer-img">
                    <a href="">
                        <img src="{{ asset('frontend/asset/logo/logo_usda.png') }}" alt="" />
                    </a>
                </div>
                {{-- <div class="footer-img">
                    <a href="">
                        <img src="{{ asset('frontend/asset/logo/logo_venture.png') }}" alt="" />
                    </a>
                </div> --}}
                <div class="footer-img">
                    <a href="">
                        <img src="{{ asset('frontend/asset/logo/footer_logo_2.png') }}" alt="" />
                    </a>
                </div>
            </div>
            <div>
                <p class="copy-right">
                    {{@$website->copy_right}}
                </p>
            </div>
            <div>
                <a href="https://nextgenitltd.com/" class="palning-text" target="_blank">
                    <div class="technical">
                        <div>
                            <p>{{__('Design & Developed by')}}:</p>
                        </div>
                        <div class="footer-img">
                            <img src="{{ asset('frontend/asset/logo/nextgen-log.png') }}" alt="" />
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</footer>
