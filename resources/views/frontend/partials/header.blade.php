<!-- Main Header Nav -->
<header class="header-nav menu_style_home_one dashbord_pages navbar-scrolltofixed stricky main-menu">
    <div class="container-fluid">
        <!-- Ace Responsive Menu -->
        <nav>
            <!-- Menu Toggle btn-->
            <div class="menu-toggle">
                <img class="nav_logo_img img-fluid" src="{{ asset('/admin/images/header-logo.png') }}"
                    alt="header-logo.png">
                <button type="button" id="menu-btn">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <a href="#" class="navbar_brand float-left dn-smd">
                <img class="logo1 img-fluid" src="{{ asset('/admin/images/header-logo.png') }}" alt="header-logo.png">
                <img class="logo2 img-fluid" src="{{ asset('/admin/images/header-logo.png') }}" alt="header-logo.png">
                <span>Insam Tutorials</span>
            </a>
            <!-- Responsive Menu Structure-->
            <!--Note: declare the Menu style in the data-menu-style="horizontal" (options: horizontal, vertical, accordion) -->
            <ul id="respMenu" class="ace-responsive-menu" data-menu-style="horizontal">
                <li>
                    <a href="/"><span class="title">Accueil</span></a>
                </li>
                <li>
                    <a href="/courses"><span class="title">Formations</span></a>
                    <!-- Level Two-->
                    <ul>
                        <li>
                            <a href="{{ route('layout-frontend.lessons.index') }}">Formations</a>
                        </li>
                        <li><a href="{{ route('layout-frontend.categories.index') }}">Categories</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{ route('layout-frontend.book_categories.index') }}">Bibliotheque</a>
                </li>
                <li class="last">
                    <a href="/contact"><span class="title">Contact</span></a>
                </li>
            </ul>
            <ul class="header_user_notif pull-right dn-smd">
                <li class="user_setting">
                    <div class="dropdown">

                        @auth
                            <a class="btn dropdown-toggle" href="#" data-toggle="dropdown"><img
                                    alt="{{ Auth::user()->name }}" src="{{ Storage::url(Auth::user()->image) }}"
                                    class="rounded-circle" /></a>
                            <div class="dropdown-menu">
                                <div class="user_set_header">
                                    <img class="float-left" src="{{ Storage::url(Auth::user()->image) }}" alt="e1.png">
                                    <p>{{ Auth::user()->name }} <br><span class="address">{{ Auth::user()->email }}</span>
                                    </p>
                                </div>
                                <div class="user_setting_content">
                                    <a class="dropdown-item active"
                                        href="{{ route('layout-frontend.profile', ['user' => Auth::user()->id]) }}">My
                                        Profile</a>

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        {{ __('Se Deconnecter') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        @else
                            <a class="btn" href="{{ route('login') }}">
                                Se Connecter
                                {{-- <img alt="{{ $user->name }}" src="{{ Storage::url($user->image) }}" class="rounded-circle" /> --}}
                            </a>
                        @endauth


                    </div>
                </li>
            </ul>
        </nav>
    </div>
</header>
<!-- Main Header Nav For Mobile -->
<div id="page" class="stylehome1 h0">
    <div class="mobile-menu">

        <div class="header stylehome1 dashbord_mobile_logo dashbord_pages">
            <div class="main_logo_home2">
                <img class="nav_logo_img img-fluid float-left mt20" src="{{ asset('/admin/images/header-logo.png') }}"
                    alt="header-logo.png">
                <span>Insam Tutorials</span>
            </div>
            <ul class="menu_bar_home2">
                <li class="list-inline-item"></li>
                <li class="list-inline-item"><a href="#menu"><span></span></a></li>
            </ul>
        </div>
    </div><!-- /.mobile-menu -->
    <nav id="menu" class="stylehome1">
        <ul>
            <li><a href="/">Accueil</a>
            </li>
            <li><span>Courses</span>
                <ul>
                    <li><a href="{{ route('layout-frontend.lessons.index') }}">Courses List</a>

                    </li>
                </ul>
            </li>
            <li>
                <a href="{{ route('layout-frontend.book_categories.index') }}">Bibliotheque</a>
            </li>
            <li><a href="/contact">Contact</a></li>
            @auth
                <li><a class="" href="{{ route('layout-frontend.profile', ['user' => Auth::user()->id]) }}">Mon
                        Compte</a></li>
                <li><a class="" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                        {{ __('Se Deconnecter') }}
                    </a></li>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            @else
                <li><a href="{{ route('login') }}"><span class="flaticon-user"></span> Login</a></li>
            @endauth
        </ul>
    </nav>
</div>
