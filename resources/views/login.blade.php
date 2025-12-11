<!doctype html>
<html lang="en">

<head>
    <title>Login | {{ config('app.name') }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="{{ asset('/assets/images/logo.png') }}" type="image/png" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link href="{{ asset('assets/plugins/toastr/css/toastr.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/login-phone.css') }}"
        media="only screen and (max-width: 767.98px)">
    <link rel="stylesheet" href="{{ asset('assets/css/login-dekstop.css') }}"
        media="only screen and (min-width: 767.99px)">

    <style>
        #loginForPhone {
            display: none;
        }

        .ftco-section {
            min-height: 100vh;
        }

        @media (max-width: 767.98px) {
            #loginForDekstop {
                display: none;
            }

            #loginForPhone {
                display: flex;
            }
        }
    </style>
</head>

<body>
    <section class="ftco-section d-flex align-items-center">
        <div class="container">
            <div class="row justify-content-center" id="loginForDekstop">
                <div class="col-md-12 col-lg-10">
                    <div class="wrap d-md-flex">
                        <div class="img"
                            style="background-image: url({{ asset('assets/images/bg-login.png') }}); background-size: cover; background-position: top; background-repeat: no-repeat;">
                        </div>
                        <div class="login-wrap p-4 p-md-5">
                            <div class="d-flex">
                                <div class="w-100 mb-4 text-center">
                                    <img src="{{ asset('assets/images/logo.png') }}" alt="Foto Logo"
                                        style="width: 200px;">
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="w-100">
                                    <h3 class="mb-4">Login</h3>
                                </div>
                            </div>
                            <form action="{{ route('login') }}" method="POST" class="signin-form">
                                @csrf
                                <div class="form-group mb-3">
                                    <label class="label" for="username">Username</label>
                                    <input type="text" id="username" name="username" class="form-control"
                                        placeholder="Email/Phone" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="label" for="password">Password</label>
                                    <input type="password" id="password" name="password" class="form-control"
                                        placeholder="Password" required>
                                </div>
                                <div class="form-group mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                        <label class="form-check-label" for="remember">
                                            Remember Me
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group mb-0">
                                    <button type="submit"
                                        class="form-control btn btn-primary rounded submit px-3">Login</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center" id="loginForPhone">
                <div class="col-md-6 col-lg-4">
                    <div class="login-wrap d-flex flex-column justify-content-end px-4">
                        <div class="d-flex flex-column rounded py-4 px-3"
                            style="margin-bottom: 100px; background-color: rgba(0, 0, 0, 0.3);">
                            <h3 class="text-center mb-3" style="font-size: 40px;">Login</h3>
                            <form action="{{ route('login') }}" method="POST" class="login-form">
                                @csrf
                                <div class="form-group">
                                    <div class="icon d-flex align-items-center justify-content-center"><span
                                            class="fa fa-user"></span></div>
                                    <input type="text" name="username" id="username" class="form-control"
                                        placeholder="Email/Phone" required>
                                </div>
                                <div class="form-group">
                                    <div class="icon d-flex align-items-center justify-content-center"><span
                                            class="fa fa-lock"></span></div>
                                    <input type="password" name="password" id="password" class="form-control"
                                        placeholder="Password" required>
                                </div>
                                <div class="form-group d-md-flex mb-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember"
                                            id="remember_mobile">
                                        <label class="form-check-label text-white" for="remember_mobile">
                                            Remember Me
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit"
                                        class="btn form-control btn-primary rounded submit px-3">Login</button>
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/popper.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/views/apps/auth/login.js') }}"></script>
    <script src="{{ asset('assets/plugins/toastr/js/toastr.js') }}"></script>
    @include('components.toastr')
</body>

</html>
