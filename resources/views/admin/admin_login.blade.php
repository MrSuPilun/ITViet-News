<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Fonts and icons -->
    <script src="{{ asset('assets/dashboard/js/plugin/webfont/webfont.min.js') }}"></script>
    <script>
        WebFont.load({
            google: {
                "families": ["Lato:300,400,700,900"]
            },
            custom: {
                "families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands",
                    "simple-line-icons"
                ],
                urls: [" {{ asset('assets/dashboard/css/fonts.min.css') }} "]
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/adminlte.min.css') }}">
</head>

<body class="hold-transition login-page">
    @auth('admin')
        <div class="login-box" style="text-align: center; width: 100%;">
            <h3>Please <a href="{{ route('admin.logout') }}"><u>log out</u></a> your account. Return <a
                    href="{{ route('admin.dashboard') }}"><u>dashboard</u></a>.</h3>
        </div>
    @else
        <div class="login-box">
            <div class="login-logo">
                <a href="#"><b>ITViet</b>News</a>
            </div>
            <!-- /.login-logo -->
            <div class="card">
                <div class="card-body login-card-body">
                    <p class="login-box-msg">Sign in to start your session</p>

                    <form action="{{ route('admin.login') }}" method="post">
                        @csrf
                        <div class="input-group mb-3">
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                id="exampleInputEmail1" placeholder="Email" aria-describedby="exampleInputEmail1-error"
                                aria-invalid="true">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                            @error('email')
                                <span id="exampleInputEmail1-error" class="error invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" name="password"
                                class="form-control @error('password') is-invalid @enderror" id="exampleInputPassword1"
                                placeholder="Password" aria-describedby="exampleInputPassword1-error">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                            @error('password')
                                <span id="exampleInputPassword1-error" class="error invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-8">
                                <div class="icheck-primary">
                                    <input type="checkbox" id="remember" name="remember">
                                    <label for="remember">
                                        Remember Me
                                    </label>
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-4">
                                <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>
                    <!-- /.login-card-body -->
                </div>
            </div>
        </div>
        <!-- /.login-box -->
    @endauth

    <!-- jQuery -->
    <script src="{{ asset('assets/dashboard/js/core/jquery.3.2.1.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/plugin/jquery-validation/jquery.validate.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('assets/dashboard/js/plugin/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('assets/dashboard/js/adminlte.min.js') }}"></script>
</body>

</html>
