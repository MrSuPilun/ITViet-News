<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login ITViet</title>
    <link rel="stylesheet" href="{{ asset('assets/app/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/app/fonts/fontawesome-5.0.8/css/fontawesome-all.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <style>
        body {
            font-family: "Lato", Arial, sans-serif;
            font-size: 16px;
            line-height: 1.8;
            font-weight: normal;
            background: #f8f9fd;
            color: gray;
        }

        a {
            -webkit-transition: .3s all ease;
            -o-transition: .3s all ease;
            transition: .3s all ease;
            color: #1089ff;
        }

        a:hover,
        a:focus {
            text-decoration: none !important;
            outline: none !important;
            -webkit-box-shadow: none;
            box-shadow: none;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        .h1,
        .h2,
        .h3,
        .h4,
        .h5 {
            line-height: 1.5;
            font-weight: 400;
            font-family: "Lato", Arial, sans-serif;
            color: #000;
        }


        .ftco-section {
            padding: 7em 0;
        }

        .ftco-no-pt {
            padding-top: 0;
        }

        .ftco-no-pb {
            padding-bottom: 0;
        }

        .heading-section {
            font-size: 28px;
            color: #000;
        }

        .img {
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center center;
        }

        .login-wrap {
            position: relative;
            background: #fff;
            border-radius: 10px;
            -webkit-box-shadow: 0px 10px 34px -15px rgba(0, 0, 0, 0.24);
            -moz-box-shadow: 0px 10px 34px -15px rgba(0, 0, 0, 0.24);
            box-shadow: 0px 10px 34px -15px rgba(0, 0, 0, 0.24);
        }

        .login-wrap h3 {
            font-weight: 300;
        }

        .login-wrap .icon {
            width: 80px;
            height: 80px;
            /* background: #1089ff; */
            border-radius: 50%;
            font-size: 30px;
            margin: 0 auto;
            margin-bottom: 10px;
        }

        .login-wrap .icon span {
            color: #fff;
        }

        .form-control {
            height: 52px;
            background: #fff;
            color: #000;
            font-size: 16px;
            border-radius: 5px;
            -webkit-box-shadow: none;
            box-shadow: none;
            border: 1px solid rgba(0, 0, 0, 0.1);
        }

        .form-control:focus,
        .form-control:active {
            outline: none !important;
            -webkit-box-shadow: none;
            box-shadow: none;
            border: 1px solid #1089ff;
        }

        textarea.form-control {
            height: inherit !important;
        }

        .input-group-addon {
            background-color: none !important;
        }

        .btn {
            cursor: pointer;
            border-radius: 40px;
            -webkit-box-shadow: none !important;
            box-shadow: none !important;
            font-size: 15px;
        }

        .btn:hover,
        .btn:active,
        .btn:focus {
            outline: none;
        }

        .btn.btn-primary {
            background: #1089ff !important;
            border: 1px solid #1089ff !important;
            color: #fff !important;
        }

        .btn.btn-primary:hover {
            border: 1px solid #1089ff;
            background: transparent;
            color: #1089ff;
        }

        .btn.btn-primary.btn-outline-primary {
            border: 1px solid #1089ff;
            background: transparent;
            color: #1089ff;
        }

        .btn.btn-primary.btn-outline-primary:hover {
            border: 1px solid transparent;
            background: #1089ff;
            color: #fff;
        }
    </style>

    {{-- HEADER --}}
    @yield('header')
</head>

<body>
    {{-- CONTENT --}}
    @yield('content')

    {{-- SCRIPT --}}
    <script src="{{ asset('assets/app/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('assets/app/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/app/vendor/bootstrap/js/popper.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("#show_hide_password a").on('click', function(event) {
                event.preventDefault();
                if ($('#show_hide_password input').attr("type") == "text") {
                    $('#show_hide_password input').attr('type', 'password');
                    $('#show_hide_password i').addClass("fa-lock");
                    $('#show_hide_password i').removeClass("fa-unlock");
                } else if ($('#show_hide_password input').attr("type") == "password") {
                    $('#show_hide_password input').attr('type', 'text');
                    $('#show_hide_password i').removeClass("fa-lock");
                    $('#show_hide_password i').addClass("fa-unlock");
                }
            });
        });
    </script>

    {{-- FOOTER --}}
    @yield('footer')
</body>

</html>
