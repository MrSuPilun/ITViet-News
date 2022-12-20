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
                            {{ auth('user')->user()->name }}
                        </a>
                    @else
                        <a href="{{ route('user.register') }}" class="left-topbar-item">
                            Sing up
                        </a>

                        <a href="{{ route('login') }}" class="left-topbar-item">
                            Log in
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
                    <span class="left-topbar-item flex-wr-s-c">
                        <span>
                            New York, NY
                        </span>

                        <img class="m-b-1 m-rl-8" src="{{ asset('assets/app/images/icons/icon-night.png') }}"
                            alt="IMG">

                        <span>
                            HI 58° LO 56°
                        </span>
                    </span>
                </li>

                <li class="left-topbar">
                    <a href="#" class="left-topbar-item">
                        About
                    </a>

                    <a href="#" class="left-topbar-item">
                        Contact
                    </a>

                    <a href="#" class="left-topbar-item">
                        Sing up
                    </a>

                    <a href="#" class="left-topbar-item">
                        Log in
                    </a>
                </li>

                <li class="right-topbar">
                    <a href="#">
                        <span class="fab fa-facebook-f"></span>
                    </a>

                    <a href="#">
                        <span class="fab fa-twitter"></span>
                    </a>

                    <a href="#">
                        <span class="fab fa-pinterest-p"></span>
                    </a>

                    <a href="#">
                        <span class="fab fa-vimeo-v"></span>
                    </a>

                    <a href="#">
                        <span class="fab fa-youtube"></span>
                    </a>
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
                    <a href="category-02.html">Entertainment </a>
                </li>

                <li>
                    <a href="category-01.html">Business</a>
                </li>

                <li>
                    <a href="category-02.html">Travel</a>
                </li>

                <li>
                    <a href="category-01.html">Life Style</a>
                </li>

                <li>
                    <a href="category-02.html">Video</a>
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
                        <li class="main-menu-active">
                            <a href="/">Trang chủ</a>
                        </li>

                        <li class="mega-menu-item">
                            <a href="category-01.html">Tin tức</a>
                        </li>

                        <li class="mega-menu-item">
                            <a href="category-02.html">Entertainment </a>
                        </li>

                        <li class="mega-menu-item">
                            <a href="category-01.html">Business</a>
                        </li>

                        <li class="mega-menu-item">
                            <a href="category-02.html">Travel</a>
                        </li>

                        <li class="mega-menu-item">
                            <a href="category-01.html">Life Style</a>
                        </li>

                        <li class="mega-menu-item">
                            <a href="category-02.html">Video</a>
                        </li>

                        <li class="mega-menu-item">
                            <a href="#">Liên hệ</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</header>
