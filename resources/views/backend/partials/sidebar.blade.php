@php
    $route = Route::currentRouteName();
    // dd($route);
@endphp
<!-- sidebar for desktop start -->
<aside id="asideNavbar" class="siderbars d-none d-lg-block">
    <nav class="dashboard-sidebar">
        <div class="db-sidebar-top-area">
            <div class="db-sidebar-logo">
                <img src="{{ asset('backend/asset/logo/logo.png') }}" alt="logo" />
            </div>
            <h1 class="db-sidebar-title">Bangladesh Food Safety Authority</h1>
        </div>

        <ul class="d-flex flex-column gap-1 menu-item">
            <p class="admin-title">Dashboard</p>
            <li>
                <div class="dashboard-sidebar-option">
                    <a href="{{ route('dashboard') }}" class="d-flex align-items-center gap-3">
                        <img src="{{ asset('backend/asset/icon/icon1.png') }}" alt="dashboard" />
                        <span>Dashboard</span>
                    </a>
                    <div class="sidebar-vertical-line"></div>
                </div>
            </li>

            @if (Auth::user()->hasPermission('roles.index') || Auth::user()->hasPermission('users.index'))
                <p class="admin-title mt-4">AUTHORIZATION</p>
            @endif

            @if (Auth::user()->hasPermission('roles.index'))
                <li>
                    <div class="dashboard-sidebar-option">
                        <a href="{{ route('roles.index') }}" class="d-flex align-items-center gap-3">
                            <i class="fa-regular fa-circle-check icons-admin"></i>
                            <span>Role Permission</span>
                        </a>
                        <div class="sidebar-vertical-line"></div>
                    </div>
                </li>
            @endif

            @if (Auth::user()->hasPermission('users.index'))
                <li>
                    <div class="dashboard-sidebar-option">
                        <a href="{{ route('users.index') }}" class="d-flex align-items-center gap-3">
                            <i class="fa-solid fa-user-plus icons-admin"></i>
                            <span>User</span>
                        </a>
                        <div class="sidebar-vertical-line"></div>
                    </div>
                </li>
            @endif

            @if (Auth::user()->hasPermission('customers.index'))
            <li>
                <div class="dashboard-sidebar-option">
                    <a href="{{ route('customers.index') }}" class="d-flex align-items-center gap-3">
                        <i class="fa-solid fa-users icons-admin"></i>
                        <span>Customer User</span>
                    </a>
                    <div class="sidebar-vertical-line"></div>
                </div>
            </li>
            @endif

            @if (Auth::user()->hasPermission('application.index') || Auth::user()->hasPermission('certificate.index'))
                <p class="admin-title mt-4">Main</p>
            @endif

            {{-- <li>
                <div class="dashboard-sidebar-option">
                    <a href="/" class="d-flex align-items-center gap-3">
                        <i class="fa-solid fa-flask-vial icons-admin"></i>
                        <span>Manage Lab</span>
                    </a>
                    <div class="sidebar-vertical-line"></div>
                </div>
            </li> --}}
            @if (Auth::user()->hasPermission('application.index'))
            <li>
                <div class="dashboard-sidebar-option">
                    <a href="{{ route('application.index') }}" class="d-flex align-items-center gap-3">
                        <img src="{{ asset('backend/asset/icon/icon6.svg') }}" alt="application" />

                        <span>Applications</span>
                    </a>
                    <div class="sidebar-vertical-line"></div>
                </div>
            </li>
            @endif




            @if (Auth::user()->hasPermission('help.line'))
            <li>
                <div onclick="sidebarSubmenuControl(this)" class="dashboard-sidebar-option position-relative {{ $route == 'help.line' ||  $route == 'help.line.complete'  ? 'db-active-link' : '' }} ">
                    <p class="border-0 bg-transparent d-flex align-items-center gap-3">
                        <i class="fa-solid fa-location-dot icons-admin"></i>
                        <span>Manage Help Line</span>
                    </p>
                    <div class="sidebar-vertical-line"></div>
                    <!-- arrow-icon-down -->
                    <div class="db-arrow-icon arrow-icon-down {{ $route == 'help.line' ||  $route == 'help.line.complete'  ? 'd-none' : 'd-block' }}">
                        <i class="fa-solid fa-chevron-right icon-drop-downs"></i>
                    </div>
                    <!-- arrow-icon-up -->
                    <div class="db-arrow-icon arrow-icon-up {{ $route == 'help.line' ||  $route == 'help.line.complete' ? 'd-block' : 'd-none' }}">
                        <i class="fa-solid fa-chevron-up icon-drop-downs"></i>
                    </div>
                </div>
                <!-- submenu start -->
                <ul class="mb-2 submenu-container {{ $route == 'help.line' || $route == 'help.line.complete' ? 'd-block' : 'd-none' }}">
                    <!--slider start-->

                    @if (Auth::user()->hasPermission('help.line'))
                    <li>
                        <div class="dashboard-sidebar-sub-option">
                            <a href="{{ route('help.line') }}" class="d-flex align-items-center gap-3 {{ $route == 'help.line' ? 'db-sidebar-sub-active-link' : '' }} ">
                                <i class="fa-sharp fa-solid fa-circle"></i>
                                <span>Help Line Request</span>
                            </a>
                        </div>
                    </li>
                    @endif

                    @if (Auth::user()->hasPermission('help.line.complete'))
                    <li>
                        <div class="dashboard-sidebar-sub-option">
                            <a href="{{ route('help.line.complete') }}" class="d-flex align-items-center gap-3  {{ $route == 'help.line.complete' ? 'db-sidebar-sub-active-link' : '' }}">
                                <i class="fa-sharp fa-solid fa-circle"></i>
                                <span>Help Line Completed</span>
                            </a>
                        </div>
                    </li>
                    @endif
                </ul>
                <!-- submenu end -->
            </li>
            @endif





            @if (Auth::user()->hasPermission('certificate.index'))
                @if (Auth::user()->role_id == 2)
                <li>
                    <div class="dashboard-sidebar-option {{$route == 'certificate.index' || $route == 'certificate.view' ? 'db-active-link' : ''}}">
                        <a href="{{ route('certificate.index') }}" class="d-flex align-items-center gap-3">
                            <img src="{{ asset('backend/asset/icon/icon6.svg') }}" alt="certificate" />
                            <span>My Certificates</span>
                        </a>
                        <div class="sidebar-vertical-line"></div>
                    </div>
                </li>
                @endif
            @endif

            @if (Auth::user()->role_id == 6)
            <li>
                <div class="dashboard-sidebar-option {{$route == 'change-request.index' ? 'db-active-link' : ''}}">
                    <a href="{{ route('change-request.index') }}" class="d-flex align-items-center gap-3">
                        <img src="{{ asset('backend/asset/icon/icon6.svg') }}" alt="certificate" />
                        <span>Change Request</span>
                    </a>
                    <div class="sidebar-vertical-line"></div>
                </div>
            </li>
            @endif


            @if (Auth::user()->hasPermission('countries.index') || Auth::user()->hasPermission('divisions.index') || Auth::user()->hasPermission('districts.index') || Auth::user()->hasPermission('type-goods.index') || Auth::user()->hasPermission('fee-structures.index'))
            <p class="admin-title mt-4">Lookup</p>
            @endif

            @if (Auth::user()->hasPermission('countries.index') || Auth::user()->hasPermission('divisions.index') || Auth::user()->hasPermission('districts.index'))
            <li>
                <div onclick="sidebarSubmenuControl(this)" class="dashboard-sidebar-option position-relative {{ Request::is('divisions') ||  Request::is('districts') || Request::is('countries') ? 'db-active-link' : '' }} ">
                    <p class="border-0 bg-transparent d-flex align-items-center gap-3">
                        <i class="fa-solid fa-location-dot icons-admin"></i>
                        <span>Area Setup</span>
                    </p>
                    <div class="sidebar-vertical-line"></div>
                    <!-- arrow-icon-down -->
                    <div class="db-arrow-icon arrow-icon-down {{ Request::is('divisions') ||  Request::is('districts') || Request::is('countries') ? 'd-none' : 'd-block' }}">
                        <i class="fa-solid fa-chevron-right icon-drop-downs"></i>
                    </div>
                    <!-- arrow-icon-up -->
                    <div class="db-arrow-icon arrow-icon-up {{ Request::is('divisions') ||  Request::is('districts') || Request::is('countries') ? 'd-block' : 'd-none' }}">
                        <i class="fa-solid fa-chevron-up icon-drop-downs"></i>
                    </div>
                </div>
                <!-- submenu start -->
                <ul class="mb-2 submenu-container {{ Request::is('divisions') || Request::is('districts') || Request::is('countries') ? 'd-block' : 'd-none' }}">
                    <!--slider start-->

                    @if (Auth::user()->hasPermission('countries.index'))
                    <li>
                        <div class="dashboard-sidebar-sub-option">
                            <a href="{{ route('countries.index') }}" class="d-flex align-items-center gap-3 {{ Request::is('countries') ? 'db-sidebar-sub-active-link' : '' }} ">
                                <i class="fa-sharp fa-solid fa-circle"></i>
                                <span>Country</span>
                            </a>
                        </div>
                    </li>
                    @endif

                    @if (Auth::user()->hasPermission('divisions.index'))
                    <li>
                        <div class="dashboard-sidebar-sub-option">
                            <a href="{{ route('divisions.index') }}" class="d-flex align-items-center gap-3 {{ Request::is('divisions') ? 'db-sidebar-sub-active-link' : '' }} ">
                                <i class="fa-sharp fa-solid fa-circle"></i>
                                <span>Division</span>
                            </a>
                        </div>
                    </li>
                    @endif

                    @if (Auth::user()->hasPermission('districts.index'))
                    <li>
                        <div class="dashboard-sidebar-sub-option">
                            <a href="{{ route('districts.index') }}" class="d-flex align-items-center gap-3 {{ Request::is('districts') ? 'db-sidebar-sub-active-link' : '' }} ">
                                <i class="fa-sharp fa-solid fa-circle"></i>
                                <span>District</span>
                            </a>
                        </div>
                    </li>
                    @endif
                </ul>
                <!-- submenu end -->
            </li>
            @endif


            @if (Auth::user()->hasPermission('type-goods.index'))
            <li>
                <div class="dashboard-sidebar-option">
                    <a href="{{ route('type-goods.index') }}" class="d-flex align-items-center gap-3">
                        <i class="fa-regular fa-gem text-white"></i>
                        <span>Type of Goods</span>
                    </a>
                    <div class="sidebar-vertical-line"></div>
                </div>
            </li>
            @endif

            <!--  Mode of Transport Start -->
            @if (Auth::user()->hasPermission('transport-modes.index'))
            <li>
                <div class="dashboard-sidebar-option">
                    <a href="{{ route('transport-modes.index') }}" class="d-flex align-items-center gap-3">
                        <i class="fa-regular fa-gem text-white"></i>
                        <span>Mode of Transport</span>
                    </a>
                    <div class="sidebar-vertical-line"></div>
                </div>
            </li>
            @endif
            <!--  Mode of Transport End -->


            <!--Fee Structure-->
            @if (Auth::user()->hasPermission('fee-structures.index'))
            <li>
                <div class="dashboard-sidebar-option">
                    <a href="{{route('fee-structures.index')}}" class="d-flex align-items-center gap-3">
                        <i class="fa-solid fa-bangladeshi-taka-sign text-white"></i>
                        <span>Fee Structure</span>
                    </a>
                    <div class="sidebar-vertical-line"></div>
                </div>
            </li>
            @endif

            <!--Fee Structure-->
            @if (Auth::user()->hasPermission('change-request-fees.index'))
            <li>
                <div class="dashboard-sidebar-option">
                    <a href="{{route('change-request-fees.index')}}" class="d-flex align-items-center gap-3">
                        <i class="fa-solid fa-bangladeshi-taka-sign text-white"></i>
                        <span>Change Request Fee</span>
                    </a>
                    <div class="sidebar-vertical-line"></div>
                </div>
            </li>
            @endif

            <!--Website setting start-->
            @if (Auth::user()->hasPermission('sliders.index') || Auth::user()->hasPermission('abouts.index') || Auth::user()->hasPermission('blogs.index') || Auth::user()->hasPermission('tutorials.index') || Auth::user()->hasPermission('user-manuals.index') || Auth::user()->hasPermission('term-services.index') || Auth::user()->hasPermission('websites.index'))
            <li>
                <div onclick="sidebarSubmenuControl(this)"
                    class="dashboard-sidebar-option position-relative
                    {{ Request::is('sliders') ||
                    Request::is('sliders/*') ||
                    Request::is('blogs') ||
                    Request::is('blogs/*') ||
                    Request::is('abouts') ||
                    Request::is('abouts/*') ||
                    Request::is('tutorials') ||
                    Request::is('tutorials/*') ||
                    Request::is('user-manuals') ||
                    Request::is('user-manuals/*') ||
                    Request::is('websites') ||
                    Request::is('websites/*') ||
                    Request::is('term-services') ||
                    Request::is('term-services/*')
                        ? 'db-active-link'
                        : '' }} ">

                    <p class="border-0 bg-transparent d-flex align-items-center gap-3">
                        <i class="bi bi-share icons-admin"></i>
                        <span>Website Setting</span>
                    </p>

                    <div class="sidebar-vertical-line"></div>

                    <!-- arrow-icon-down -->
                    <div
                        class="db-arrow-icon arrow-icon-down
                    {{ Request::is('sliders') ||
                    Request::is('sliders/*') ||
                    Request::is('blogs') ||
                    Request::is('blogs/*') ||
                    Request::is('abouts') ||
                    Request::is('abouts/*') ||
                    Request::is('tutorials') ||
                    Request::is('tutorials/*') ||
                    Request::is('user-manuals') ||
                    Request::is('user-manuals/*') ||
                    Request::is('websites') ||
                    Request::is('websites/*') ||
                    Request::is('term-services') ||
                    Request::is('term-services/*')
                        ? 'd-none'
                        : 'd-block' }}">
                        <i class="fa-solid fa-chevron-right icon-drop-downs"></i>
                    </div>
                    <!-- arrow-icon-up -->
                    <div
                        class="db-arrow-icon arrow-icon-up
                    {{ Request::is('sliders') ||
                    Request::is('sliders/*') ||
                    Request::is('blogs') ||
                    Request::is('blogs/*') ||
                    Request::is('abouts') ||
                    Request::is('abouts/*') ||
                    Request::is('tutorials') ||
                    Request::is('tutorials/*') ||
                    Request::is('user-manuals') ||
                    Request::is('user-manuals/*') ||
                    Request::is('websites') ||
                    Request::is('websites/*') ||
                    Request::is('term-services') ||
                    Request::is('term-services/*')
                        ? 'd-block'
                        : 'd-none' }}">
                        <i class="fa-solid fa-chevron-up icon-drop-downs"></i>
                    </div>
                </div>
                <!-- submenu start -->
                <ul
                    class="mb-2 submenu-container
                    {{ Request::is('sliders') ||
                    Request::is('sliders/*') ||
                    Request::is('blogs') ||
                    Request::is('blogs/*') ||
                    Request::is('abouts') ||
                    Request::is('abouts/*') ||
                    Request::is('tutorials') ||
                    Request::is('tutorials/*') ||
                    Request::is('user-manuals') ||
                    Request::is('user-manuals/*') ||
                    Request::is('websites') ||
                    Request::is('websites/*') ||
                    Request::is('term-services') ||
                    Request::is('faq') ||
                    Request::is('term-services/*')
                        ? 'd-block'
                        : 'd-none' }}">
                    <!--slider start-->
                    @if (Auth::user()->hasPermission('sliders.index'))
                    <li>
                        <div class="dashboard-sidebar-sub-option">
                            <a href="{{ route('sliders.index') }}"
                                class="d-flex align-items-center gap-3
                            {{ Request::is('sliders') || Request::is('sliders/*') ? 'db-sidebar-sub-active-link' : '' }}">
                                <i class="fa-sharp fa-solid fa-circle"></i>
                                <span>Slider</span>
                            </a>
                        </div>
                    </li>
                    @endif
                    <!--slider end-->

                    <!--about start-->
                    @if (Auth::user()->hasPermission('abouts.index'))
                    <li>
                        <div class="dashboard-sidebar-sub-option">
                            <a href="{{ route('abouts.index') }}"
                                class="d-flex align-items-center gap-3
                            {{ Request::is('abouts') || Request::is('abouts/*') ? 'db-sidebar-sub-active-link' : '' }}">
                                <i class="fa-sharp fa-solid fa-circle"></i>
                                <span>About</span>
                            </a>
                        </div>
                    </li>
                    @endif
                    <!--about end-->

                    <!--Blog start-->
                    @if (Auth::user()->hasPermission('blogs.index'))
                    <li>
                        <div class="dashboard-sidebar-sub-option">
                            <a href="{{ route('blogs.index') }}"
                                class="d-flex align-items-center gap-3
                            {{ Request::is('blogs') || Request::is('blogs/*') ? 'db-sidebar-sub-active-link' : '' }}">
                                <i class="fa-sharp fa-solid fa-circle"></i>
                                <span>Blog Manage</span>
                            </a>
                        </div>
                    </li>
                    @endif
                    <!--Blog end-->
                    <!--Tutorials start-->
                    @if (Auth::user()->hasPermission('tutorials.index'))
                    <li>
                        <div class="dashboard-sidebar-sub-option">
                            <a href="{{ route('tutorials.index') }}"
                                class="d-flex align-items-center gap-3
                            {{ Request::is('tutorials') || Request::is('tutorials/*') ? 'db-sidebar-sub-active-link' : '' }} ">
                                <i class="fa-sharp fa-solid fa-circle"></i>
                                <span>Tutorial Manage</span>
                            </a>
                        </div>
                    </li>
                    @endif
                    <!--Tutorials end-->

                    <!--User Manual Manage start-->
                    @if (Auth::user()->hasPermission('user-manuals.index'))
                    <li>
                        <div class="dashboard-sidebar-sub-option">
                            <a href="{{ route('user-manuals.index') }}"
                                class="d-flex align-items-center gap-3
                                {{ Request::is('user-manuals') || Request::is('user-manuals/*') ? 'db-sidebar-sub-active-link' : '' }} ">
                                <i class="fa-sharp fa-solid fa-circle"></i>
                                <span>User Manual Manage</span>
                            </a>
                        </div>
                    </li>
                    @endif
                    <!--User Manual Manage end-->

                    <!--FAQ start-->
                    {{-- @if (Auth::user()->hasPermission('faq.index')) --}}
                        <li>
                            <div class="dashboard-sidebar-sub-option">
                                <a href="{{route('faq.index')}}" class="d-flex align-items-center gap-3
                            {{ Request::is('faq') || Request::is('faq/*') ? 'db-sidebar-sub-active-link' : '' }}">
                                    <i class="fa-sharp fa-solid fa-circle"></i>
                                    <span>FAQ</span>
                                </a>
                            </div>
                        </li>
                    {{-- @endif --}}
                    <!--FAQ end-->

                    <!--Term of services start-->
                    @if (Auth::user()->hasPermission('term-services.index'))
                    <li>
                        <div class="dashboard-sidebar-sub-option">
                            <a href="{{route('term-services.index')}}" class="d-flex align-items-center gap-3
                            {{ Request::is('term-services') || Request::is('term-services/*') ? 'db-sidebar-sub-active-link' : '' }}">
                                <i class="fa-sharp fa-solid fa-circle"></i>
                                <span>Term of Service</span>
                            </a>
                        </div>
                    </li>
                    @endif
                    <!--Term of services end-->

                    <!--Website Manage start-->
                    @if (Auth::user()->hasPermission('websites.index'))
                    <li>
                        <div class="dashboard-sidebar-sub-option">
                            <a href="{{route('websites.index')}}" class="d-flex align-items-center gap-3
                                {{ Request::is('websites') || Request::is('websites/*') ? 'db-sidebar-sub-active-link' : '' }}">
                                <i class="fa-sharp fa-solid fa-circle"></i>
                                <span>Website Manage</span>
                            </a>
                        </div>
                    </li>
                    @endif
                    <!--Website Manage end-->
                </ul>
                <!-- submenu end -->
            </li>
            @endif
            <!--Website setting start-->
        </ul>
    </nav>
</aside>
<!-- sidebar for desktop end -->
