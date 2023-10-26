<header>
    <!-- main navbar start -->
    <nav class="shadow-sm py-2 px-3 px-md-5">
        <ul class="main-navbar">
            <div>
                <button onclick="toggleSidebar()" class="bg-transparent border-0">
                    <i class="fa-solid fa-bars menu-icon-bars"></i>
                </button>
            </div>
            {{-- <div class="input-group search-field d-none d-lg-flex">
                <span class="input-group-text"><i class="fa-solid fa-magnifying-glass"></i></span>
                <input type="text" class="form-control search-input-field" placeholder="Search" />
            </div> --}}
            <li class="me-auto"></li>
            <li class="dropdown notification-list list-inline-item">
                <button class="border-0 bg-transparent dropdown-toggle custom-noti-icon-btn" type="button"
                    id="dropdownMenu" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="{{ asset('backend/asset/icon/notification.svg') }}" alt="notification" class="main-nav-icon" />

                    {{-- @if(auth()->user()->unreadNotifications()->count() > 0) --}}
                        <span class="custom-badge bg-danger text-white">{{ auth()->user()->unreadNotifications()->count() }}</span>
                    {{-- @else
                        <span class="custom-badge bg-danger text-white">0</span>
                    @endif --}}
                </button>

                <ul class="dropdown-menu custom-dopdown-container" aria-labelledby="dropdownMenu">
                    <div class="dropdown-item-text">
                        <h6>
                            Notifications
                        </h6>
                    </div>
                    <div class="custom-dropdown-menu">
                        @foreach(auth()->user()->notifications as $notification)
                        <li>
                            <a class="dropdown-item {{ $notification->unread() ? 'active-item' : null }}" href="{{ route('notifications.read', ['notification' => $notification->id]) }}">
                                <div class="d-flex flex-column">
                                    <span class="discription-title text-truncate">{{ $notification->data['title'] }}</span>
                                    <span class="d-inline-block text-truncate noti-description">{{ $notification->data['description'] }}</span>
                                    <span class="discription-time">{{ $notification->created_at->diffForHumans() }}</span>
                                </div>
                            </a>
                        </li>
                        @endforeach
                    </div>
                    <div class="view-all-section">
                        <a href="{{ route('all.notification') }}">
                            View All
                        </a>
                    </div>
                </ul>
            </li>

            <li>
                <div>
                    <div class="d-flex align-items-center gap-3 main-navbar-profile">
                        <p class="d-flex flex-column align-items-center">
                            <span class="small-text-12">
                                Hello,
                                <a class="fw-semibold navbar-user-name">{{ auth()->user()->name }}</a></span>
                            <span class="small-text-10">{{ auth()->user()->role->name }}</span>
                        </p>
                        <button class="border-0 bg-transparent" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <img src="{{Auth::user()->avatar ? asset('upload/profile/'.Auth::user()->avatar) : asset('backend/asset/icon/profile.png') }}" alt="avatar"
                                class="main-nav-avatar" />
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item sub-menu-items" href="{{ route('profile.index') }}">
                                    <i class="bi bi-person-circle"></i>
                                    <span> My Profile</span>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item sub-menu-items" href="{{ route('change.password') }}">
                                    <i class="fa-solid fa-lock"></i>
                                    <span> Change Passowrd</span>
                                </a>
                            </li>
                            <li>
                                <form action="{{ route('logout') }}" method="post">
                                    @csrf
                                    <button type="submit" class="dropdown-item sub-menu-items">
                                        <i class="fa-solid fa-power-off"></i>
                                        <span>Log Out</span>
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>
        </ul>
    </nav>
    <!-- main navbar end -->
</header>
