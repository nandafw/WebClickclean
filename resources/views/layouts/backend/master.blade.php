<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <link rel="stylesheet" href="{{ asset('assets/css/main/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/app-dark.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/logo/favicon.svg') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('assets/images/logo/favicon.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('assets/css/shared/iconly.css') }}">
    @yield('styles')
</head>

<body>
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header position-relative">
                    <div class="d-flex justify-content-between align-items-center">

                        <div class="logo">
                            <a href="/">
                                <img id="logo-theme"
                                    src="{{ asset('images/Logo2.png') }}"
                                    alt="Logo"
                                    width="110">
                            </a>
                        </div>

                        {{-- TOGGLE --}}
                        <div class="theme-toggle d-flex gap-2 align-items-center mt-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 21 21">
                                <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="10.5" cy="10.5" r="4"></circle>
                                </g>
                            </svg>

                            <div class="form-check form-switch fs-6">
                                <input class="form-check-input me-0" type="checkbox" id="toggle-dark">
                            </div>

                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="M17.75 4.09l-2.53 1.94l.91 3.06l-2.63-1.81l-2.63 1.81l.91-3.06l-2.53-1.94L12.44 4l1.06-3l1.06 3l3.19.09Z">
                                </path>
                            </svg>
                        </div>

                        <div class="sidebar-toggler x">
                            <a href="#" class="sidebar-hide d-xl-none d-block">
                                <i class="bi bi-x"></i>
                            </a>
                        </div>
                    </div>
                </div>

                @include('layouts.backend.sidebar')
            </div>
        </div>

        <div id="main">
            <header class="mb-0">
                <div class="page-heading">
                    <div class="d-flex justify-content-between">

                        <div class="title">
                            <a href="#" class="burger-btn d-block d-xl-none">
                                <i class="bi bi-justify fs-3"></i>
                            </a>
                            <div class="d-none d-xxl-block">
                                <h3 class="mb-0">@yield('title')</h3>
                            </div>
                        </div>

                        <div class="header-top-right">
                            <div class="dropdown">
                                <a href="#" class="d-flex align-items-center dropdown-toggle"
                                    data-bs-toggle="dropdown">

                                    <div class="avatar avatar-md2">
                                        <img src="{{ asset('assets/images/faces/1.jpg') }}">
                                    </div>

                                    <div class="text ms-2">
                                        <h6 class="mb-0">{{ auth()->user()->name }}</h6>
                                        <p class="text-sm text-muted mb-0">Admin</p>
                                    </div>
                                </a>

                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="#"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>
                                    </li>
                                </ul>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </header>

            <div class="page-content">
                @yield('content')
            </div>

            <footer>
                <div class="text-muted p-3">
                    2026 &copy; Clickclean 
                </div>
            </footer>
        </div>
    </div>

    {{-- JS --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ asset('assets/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>

    <script src="{{ asset('assets/extensions/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/dashboard.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- ALERT --}}
    @if (session('success'))
        <script>
            Swal.fire('Terima Kasih', '{{ session('success') }}', 'success')
        </script>
    @endif

    @if (session('galat'))
        <script>
            Swal.fire('Maaf', '{{ session('galat') }}', 'error')
        </script>
    @endif

    <script>
        function updateLogo() {
            let isDark = document.getElementById('logo-theme');
            let logo = document.body.classList.contains('dark');

            if (isDark) {
                logo.src = "{{ asset('images/Logo2.png') }}";
            } else {
                logo.src = "{{ asset('images/LogoBlue.png') }}";
            }
        }
        document.addEventListener("DOMContentLoaded", function () {
            updateLogo();
        });
        document.getElementById('toggle-dark').addEventListener('change', function () {
            setTimeout(updateLogo, 100);
        });
    </script>

    @yield('scripts')
</body>

</html>