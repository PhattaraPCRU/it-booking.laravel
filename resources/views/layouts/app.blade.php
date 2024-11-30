<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">



    <!-- Additional CSS/JS -->
    @include('cssjs.css')
    {{-- @include('cssjs.js') --}}

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.10.1/main.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.10.1/main.min.js"></script>

    {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> --}}

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.13.18/jquery.timepicker.min.css">

    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> --}}

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

    <!-- Bootstrap Select CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css"
        rel="stylesheet">


    <!-- jQuery -->
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}

</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        @guest
            <nav class="navbar navbar-expand-lg navbar-light shadow-sm fixed-top"
                style="height: 7%; padding: 0 10px; background: linear-gradient(-45deg, rgba(147, 26, 222, 0.83) 0%, rgba(28, 206, 234, 0.82) 100%);">
                <div class="container">
                    <!-- Logo or Brand Name -->
                    <a class="navbar-brand fw-bold text-white" href="{{ url('/') }}">IT-BOOKING</a>

                    <!-- Toggle button for mobile view -->
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <!-- Navbar Links centered -->
                    <div class="collapse navbar-collapse justify-content-center" id="navbarNav" style="margin-right:45px;">
                        <ul class="navbar-nav mb-1 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link text-white" href="{{ url('/') }}">ปฏิทินการจอง</a>
                            </li>
                            <!-- Dropdown Menu -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown"
                                    role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    รายงานข้อมูล
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item text-dark" href="{{ route('rooms.show') }}">ห้องบริการ</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>

                    <!-- Login Button -->
                    <div class="d-flex align-items-center">
                        <a class="btn btn-outline-light" href="{{ route('login') }}">
                            <i class="fas fa-sign-in-alt"></i> ล็อกอิน
                        </a>
                    </div>
                </div>
            </nav>

            <div class="content"
                style="margin-top: 55px; padding: 20px; background-color: #f8f9fa; border-radius: 8px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);">

                <section class="content">
                    <div class="container-fluid">
                        @yield('content')
                        {{-- @include('assettype.create') --}}
                    </div>
                </section>
            </div>
            {{-- <div class="content"
                style="margin-top: 55px; padding: 20px; background-color: #f8f9fa; border-radius: 8px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);">

                <section class="content">
                    <div class="container-fluid">
                        @include('assettype.create')
                    </div>
                </section>
            </div> --}}
            {{-- <div class="card"
                style="height: 50%; padding: 0 10px; background: linear-gradient(-45deg, rgba(147, 26, 222, 0.83) 0%, rgba(28, 206, 234, 0.82) 100%);">
                ss
            </div> --}}
            {{-- <div class="page-header header-filter clear-filter purple-filter" data-parallax="true"
                style=" transform: translate3d(0px, 0px, 0px);">
                <img src="{{ asset('img/pcru.png') }}" alt="Phetchabun Rajabhat University" class="logo-img">

                <div class="container">
                    <div class="row">
                        <div class="col-md-8 ml-auto mr-auto">
                            <div class="brand">
                                <h1>Material Kit.</h1>
                                <h3>A Badass Bootstrap 4 UI Kit based on Material Design.</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
            <style>
                .logo-img {
                    max-width: 100%;
                    /* Ensures the image scales responsively */
                    height: auto;
                    /* Keeps the aspect ratio */
                    border-radius: 8px;
                    /* Rounded corners */
                    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
                    /* Subtle shadow */
                    margin: 20px auto;
                    /* Centers the image */
                    display: block;
                    /* Ensures the image is block-level for centering */
                }

                .navbar {
                    border-bottom: 2px solid #ffffff;
                    border-radius: 5px;
                }

                .btn-outline-light {
                    color: #ffffff;
                    border-color: #ffffff;
                }

                .btn-outline-light:hover {
                    background-color: #ffffff;
                    color: #17a2b8;
                    border-color: #ffffff;
                }

                .content {
                    background-color: #f8f9fa;
                    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
                    padding: 30px;
                }

                .nav-item.dropdown:hover .dropdown-menu {
                    display: block;
                    opacity: 1;
                    visibility: visible;
                    transition: opacity 0.3s ease;
                }

                .dropdown-menu {
                    display: none;
                    opacity: 0;
                    visibility: hidden;
                    position: absolute;
                    z-index: 1000;
                    top: 100%;
                    left: 0;
                    min-width: 10rem;
                    padding: 0.5rem 0;
                    background-color: #fff;
                    border: 1px solid rgba(0, 0, 0, 0.15);
                    border-radius: 0.25rem;
                    box-shadow: 0 0.25rem 0.75rem rgba(0, 0, 0, 0.1);
                }
            </style>
        @endguest


        @if (Auth::guard('web')->check())
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                                class="fas fa-bars"></i></a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block">
                        <a class="nav-link" href="{{ url('/') }}">
                            หน้าหลัก
                        </a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block">
                        <s><a href="#" class="nav-link">คู่มือการใช้งาน</a></s>
                    </li>
                </ul>
            </nav>
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <h3 class="brand-link" align="center">
                    IT-BOOKING
                </h3>
                <div>
                    @guest
                        @if (Route::has('login'))
                            <a class="nav-link text-light" href="{{ route('login') }}" align="center"><i
                                    class="fas fa-sign-in-alt"></i> ล็อกอิน</a>
                        @endif
                    @else
                        <div class="dropdown" align="center">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle text-light" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                @if (Auth::guard('web')->check())
                                    <i class="fas fa-user-alt"></i> &nbsp;{{ Auth::guard('web')->user()->name }}
                                @else
                                    <i class="fas fa-user-cog"></i> &nbsp;{{ Auth::guard('staff')->user()->name }}
                                @endif
                            </a>
                            <div class="dropdown-menu">
                                @if (Auth::guard('web')->check())
                                    <a class="dropdown-item" href="#"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                @endif
                                @if (Auth::guard('staff')->check())
                                    <a class="dropdown-item" href="#"
                                        onclick="event.preventDefault(); document.getElementById('staff-logout-form').submit();">
                                        Logout
                                    </a>
                                    <form id="staff-logout-form" action="{{ route('staff.logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>
                                @endif
                            </div>
                        </div>
                    @endguest

                </div>
                <hr class="hr-white">
                <style>
                    .hr-white {
                        border-color: #4b545c;
                        border-style: solid;
                    }
                </style>

                @include('layouts.sidebar')


            </aside>
            <br>
            <!-- Content Wrapper -->
            <div class="content-wrapper">
                <section class="content">
                    <div class="container-fluids">
                        @yield('content')

                    </div>
                </section>
            </div>
        @endif
        @if (Auth::guard('staff')->check())
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                                class="fas fa-bars"></i></a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block">
                        <a class="nav-link" href="{{ route('staff.homestaff') }}">
                            หน้าหลัก
                        </a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block">
                        <s><a href="#" class="nav-link">คู่มือการใช้งาน</a></s>
                    </li>
                </ul>
            </nav>
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <h3 class="brand-link" align="center">
                    IT-BOOKING
                </h3>
                <div>
                    @guest
                        @if (Route::has('login'))
                            <a class="nav-link text-light" href="{{ route('login') }}" align="center"><i
                                    class="fas fa-sign-in-alt"></i> ล็อกอิน</a>
                        @endif
                    @else
                        <div class="dropdown" align="center">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle text-light" href="#"
                                role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                @if (Auth::guard('web')->check())
                                    <i class="fas fa-user-alt"></i> &nbsp;{{ Auth::guard('web')->user()->name }}
                                @else
                                    <i class="fas fa-user-cog"></i> &nbsp;{{ Auth::guard('staff')->user()->name }}
                                @endif
                            </a>
                            <div class="dropdown-menu">
                                @if (Auth::guard('web')->check())
                                    <a class="dropdown-item" href="#"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>
                                @endif
                                @if (Auth::guard('staff')->check())
                                    <a class="dropdown-item" href="#"
                                        onclick="event.preventDefault(); document.getElementById('staff-logout-form').submit();">
                                        Logout
                                    </a>
                                    <form id="staff-logout-form" action="{{ route('staff.logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>
                                @endif
                            </div>
                        </div>
                    @endguest

                </div>
                <hr class="hr-white">
                <style>
                    .hr-white {
                        border-color: #4b545c;
                        border-style: solid;
                    }
                </style>

                @include('layouts.sidebar')
            </aside>
            <br>
            <div class="content-wrapper">
                <section class="content">
                    <div class="container-fluids">
                        @yield('content')

                    </div>
                </section>
            </div>
        @endif

        {{-- <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <h3 class="brand-link" align="center">
                IT-BOOKING
            </h3>
            <div>
                @guest
                    @if (Route::has('login'))
                        <a class="nav-link text-light" href="{{ route('login') }}" align="center"><i
                                class="fas fa-sign-in-alt"></i> ล็อกอิน</a>
                    @endif
                @else
                    <div class="dropdown" align="center">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle text-light" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            @if (Auth::guard('web')->check())
                                <i class="fas fa-user-alt"></i> &nbsp;{{ Auth::guard('web')->user()->name }}
                            @else
                                <i class="fas fa-user-cog"></i> &nbsp;{{ Auth::guard('staff')->user()->name }}
                            @endif
                        </a>
                        <div class="dropdown-menu">
                            @if (Auth::guard('web')->check())
                                <a class="dropdown-item" href="#"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            @endif
                            @if (Auth::guard('staff')->check())
                                <a class="dropdown-item" href="#"
                                    onclick="event.preventDefault(); document.getElementById('staff-logout-form').submit();">
                                    Logout
                                </a>
                                <form id="staff-logout-form" action="{{ route('staff.logout') }}" method="POST"
                                    class="d-none">
                                    @csrf
                                </form>
                            @endif
                        </div>
                    </div>
                @endguest

            </div>
            <hr class="hr-white">
            <style>
                .hr-white {
                    border-color: #4b545c;
                    border-style: solid;
                }
            </style> --}}

        {{-- @include('layouts.sidebar') --}}
        {{-- </aside> --}}

        <!-- Content Wrapper -->
        {{-- <div class="content-wrapper">
            <section class="content">
                <div class="container-fluids">
                    @yield('content')

                </div>
            </section>
        </div> --}}

        {{-- <footer class="main-footer">
            <strong>Copyright © 2024 <a href="#">AdminLTE</a>.</strong>
            All rights reserved.
        </footer> --}}
    </div>


    @include('cssjs.js')



    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}

    {{-- <script src="https://cdn.jsdelivr.net/npm/lightgallery/lightgallery.min.js"></script> --}}
    {{-- <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.13.18/jquery.timepicker.min.js"></script>

    <!-- Bootstrap Select JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js"></script>
    {{-- <script src="{{ asset('plugins/select2-4.0.13/dist/js/select2.full.min.js') }}"></script> --}}
    @stack('scripts')
</body>

</html>
