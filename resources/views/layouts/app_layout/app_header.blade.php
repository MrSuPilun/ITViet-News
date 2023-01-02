<header>
    <!-- Header desktop -->
    <div class="container-menu-desktop">
        <div class="topbar">
            <div class="content-topbar container h-100">
                <div class="left-topbar">
                </div>

                <div class="right-topbar">
                    @auth('user')
                        <a href="{{ route('user.profile') }}" class="left-topbar-item">
                            <i class="fa fa-user mr-2" aria-hidden="true"></i>
                            {{ auth('user')->user()->name }}
                        </a>
                    @else
                        <a href="{{ route('user.register') }}" class="left-topbar-item">
                            Đăng ký
                        </a>

                        <a href="{{ route('login') }}" class="left-topbar-item">
                            Đăng nhập
                        </a>
                    @endauth
                </div>
            </div>
        </div>

        <!-- Header Mobile -->
        <div class="wrap-header-mobile">
            <!-- Logo moblie -->
            <div class="logo-mobile">
                <a href="/"><img src="{{ asset('assets/app/images/icons/logo-01.png') }}" alt="IMG-LOGO"></a>
            </div>

            <!-- Button show menu -->
            <div class="btn-show-menu-mobile hamburger hamburger--squeeze m-r--8">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </div>
        </div>

        <!-- Menu Mobile -->
        <div class="menu-mobile">
            <ul class="topbar-mobile">
                <li class="left-topbar">
                    @auth('user')
                        <a href="{{ route('user.profile') }}" class="left-topbar-item">
                            <i class="fa fa-user mr-2" aria-hidden="true"></i>
                            {{ auth('user')->user()->name }}
                        </a>
                    @else
                        <a href="{{ route('user.register') }}" class="left-topbar-item">
                            Đăng ký
                        </a>

                        <a href="{{ route('login') }}" class="left-topbar-item">
                            Đăng nhập
                        </a>
                    @endauth
                </li>
            </ul>

            <ul class="main-menu-m">
                <li>
                    <a href="/">Trang chủ</a>
                </li>

                <li>
                    <a href="category-01.html">Tin tức</a>
                </li>

                <li>
                    <a href="category-02.html">Sản phẩm</a>
                </li>

                <li>
                    <a href="category-01.html">Trò chơi</a>
                </li>

                <li>
                    <a href="category-02.html">Cuộc thi</a>
                </li>

                <li>
                    <a href="category-01.html">Blockchain</a>
                </li>

                <li>
                    <a href="category-02.html">AI</a>
                </li>

                <li>
                    <a href="#">Features</a>
                </li>
            </ul>
        </div>

        <!--  -->
        <div class="wrap-logo no-banner container">
            <!-- Logo desktop -->
            <div class="logo">
                <a href="/"><img src="{{ asset('assets/app/images/icons/logo-01.png') }}" alt="LOGO"></a>
            </div>
        </div>

        <!--  -->
        <div class="wrap-main-nav">
            <div class="main-nav">
                <!-- Menu desktop -->
                <nav class="menu-desktop">
                    <a class="logo-stick" href="/">
                        <img src="{{ asset('assets/app/images/icons/logo-01.png') }}" alt="LOGO">
                    </a>

                    <ul class="main-menu justify-content-center">
                        <li class="@if (request()->is('/')) main-menu-active @else mega-menu-item @endif">
                            <a href="/">
                                Trang chủ
                                <i class="fa-sharp fa-solid fa-house ml-2"></i>
                            </a>
                        </li>

                        <li class="@if (request()->is('news*')) main-menu-active @else mega-menu-item @endif">
                            <a href="{{ route('news') }}">
                                Tin tức
                                <i class="fa-sharp fa-solid fa-fire ml-2 text-danger"></i>
                            </a>
                        </li>

                        <li class="mega-menu-item">
                            <a href="category-02.html">Sản phẩm</a>
                        </li>

                        <li class="mega-menu-item">
                            <a href="category-01.html">Trò chơi</a>
                        </li>

                        <li class="mega-menu-item">
                            <a href="category-02.html">Cuộc thi</a>
                        </li>

                        <li class="mega-menu-item">
                            <a href="category-01.html">Blockchain</a>
                        </li>

                        <li class="mega-menu-item">
                            <a href="category-02.html">AI</a>
                        </li>

                        <li class="mega-menu-item">
                            <a href="#">Liên hệ <i class="fa-solid fa-phone-flip ml-1"></i></a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</header>
