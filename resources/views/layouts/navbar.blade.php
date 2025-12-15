@php
    $routeName = Route::currentRouteName();
@endphp

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="{{ asset('/assets/images/logo.png') }}" type="image/png" />
    <!--plugins-->
    <link href="{{ asset('assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/toastr/css/toastr.min.css') }}" rel="stylesheet">
    <!-- loader-->
    <link href="{{ asset('assets/css/pace.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('assets/js/pace.min.js') }}"></script>
    <!-- Bootstrap CSS -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/bootstrap-extended.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
    <!-- Theme Style CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/dark-theme.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/semi-dark.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/header-colors.css') }}" />
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700;900&display=swap" rel="stylesheet">
    <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet">
    <style>
        @media only screen and (max-width: 530px) {
            #detail-footer {
                display: none;
                background: crimson;
            }
        }

        body {
            font-family: 'Lato', sans-serif;
            height: 100vh;
            margin: 0;
            padding: 0;
            background: url('{{ asset('assets/images/background.webp') }}') no-repeat center center fixed;
            background-size: cover;
            overflow-y: auto;
            overflow-x: hidden;
        }

        .topbar {
            z-index: 100 !important;
        }

        .sidebar-wrapper {
            z-index: 101 !important;
        }

        .overlay-lock {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.7);
            z-index: 9998;
            pointer-events: all;
            cursor: not-allowed;
        }

        .loader-app {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 9999;
        }

        .loader-app::after {
            content: '';
            display: block;
            width: 48px;
            height: 48px;
            border: 6px solid #3498db;
            border-radius: 50%;
            border-top-color: transparent;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        body.loading {
            overflow: hidden;
        }

        .toast-success {
            background-color: #28a745 !important;
            color: white !important;
        }

        .toast-error {
            background-color: #dc3545 !important;
            color: white !important;
        }

        .toast-warning {
            background-color: #ffc107 !important;
            color: black !important;
        }

        .toast-info {
            background-color: #17a2b8 !important;
            color: white !important;
        }

        @media (max-width: 767px) {
            .logo-header:first-child {
                display: none
            }
        }
    </style>

    @yield('style')
    <title>{{ config('app.name') }}</title>
</head>

<body>
    <div class="overlay-lock" style="display: none;"></div>
    <div class="loader-app" style="display: none;"></div>

    <div class="wrapper">
        @yield('sidebar')

        <header>
            <div class="topbar d-flex align-items-center">
                <nav class="navbar navbar-expand gap-3">
                    <div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
                    </div>

                    @if (auth()->user())
                        <div class="user-box dropdown px-3 ms-auto">
                            <a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret"
                                href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="{{ asset('/assets/images/default.webp') }}" class="user-img"
                                    alt="user avatar">
                                <div class="user-info ps-3">
                                    <p class="user-name mb-0 text-primary">
                                        {{ Illuminate\Support\Str::limit(auth()->user()->name, 18) }}
                                    </p>
                                    <p class="designattion mb-0 text-primary">{{ auth()->user()->role }}</p>
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <form id="form-logout" class="d-none" action="{{ route('logout') }}"
                                        method="POST">
                                        @csrf
                                    </form>
                                    <a class="dropdown-item btn-logout cursor-pointer" href="javascript:;">
                                        <i class="bx bx-log-out-circle"></i>
                                        <span>Logout</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    @endif
                </nav>
            </div>
        </header>

        <div class="page-wrapper">
            <div class="page-content">
                @yield('content')
            </div>
        </div>

        <div class="overlay toggle-icon"></div>
        <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>

        @yield('footer')
    </div>

    <!-- Bootstrap JS -->
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <!--plugins-->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/metismenu/js/metisMenu.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/plugins/toastr/js/toastr.js') }}"></script>
    <!--app JS-->
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script>
        $('.btn-logout').on('click', function() {
            $('#form-logout').submit();
        });

        function refreshCsrfToken() {
            $.ajax({
                type: 'GET',
                url: '/refresh-csrf',
                dataType: 'json',
                success: function(response) {
                    $('[name="_token"]').each(function() {
                        $(this).val(response.csrf_token);
                    });

                    console.log('Berhasil memuat ulang CSRF token. TOken baru : ', response.csrf_token);
                },
                error: function(xhr, _, _) {
                    console.error('Gagal refresh CSRF token : ', xhr.responseText);
                }
            });
        }

        setInterval(refreshCsrfToken, {{ config('session.lifetime') }} * 60000);
    </script>
    @include('components.toastr')
    @yield('script')
</body>

</html>
