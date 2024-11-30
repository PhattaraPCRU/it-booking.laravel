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

        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    @if (Auth::guard('staff')->check())
                        <a class="nav-link" href="{{ route('staff.homestaff') }}">
                            หน้าหลัก
                        </a>
                    @elseif (Auth::guard('web')->check())
                        <a class="nav-link" href="{{ url('/') }}">
                            หน้าหลัก
                        </a>
                    @else
                        <a class="nav-link" href="{{ url('/') }}">
                            หน้าหลัก
                        </a>
                    @endif
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <s><a href="#" class="nav-link">คู่มือการใช้งาน</a></s>
                </li>
            </ul>
        </nav>

        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            {{-- <img src="{{ route('image.show', ['filename' => 'pcru.png']) }}" alt="PCRU Logo"> --}}


            <h3 class="brand-link" align="center">
                IT-BOOKING
            </h3>
            <div>
                @guest
                    @if (Route::has('login'))
                        <a class="nav-link text-light" href="{{ route('login') }}" align="center"><i
                                class="fas fa-sign-in-alt"></i> Login</a>
                    @endif
                    {{-- @if (Route::has('register'))
                    <a class="nav-link text-light" href="{{ route('register') }}">{{ __('Register') }}</a>
                @endif --}}
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

        <!-- Content Wrapper -->
        <div class="content-wrapper">
            <section class="content">
                <div class="container-fluid py-3">
                    @yield('content')

                </div>
            </section>
        </div>

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

    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/lightgallery/lightgallery.min.js"></script> --}}
    {{-- <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.13.18/jquery.timepicker.min.js"></script>

    <!-- Bootstrap Select JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js"></script>
    {{-- <script src="{{ asset('plugins/select2-4.0.13/dist/js/select2.full.min.js') }}"></script> --}}
    @stack('scripts')
</body>

</html>
