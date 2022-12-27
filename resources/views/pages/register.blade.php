@extends('layouts.app_guard_layout.app_guard_layout')

@section('content')
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-7 col-lg-5">
                    <div class="login-wrap p-4 p-md-5">
                        <h3 class="text-center mb-4">
                            Đăng Ký
                        </h3>
                        <form action="{{ route('user.register') }}" class="login-form" method="post">
                            @csrf
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" class="form-control rounded-left" placeholder="Họ và Tên"
                                        name="name" required>
                                    <div class="input-group-addon">
                                        <i class="fa fa-user" aria-hidden="true"></i>
                                    </div>
                                </div>
                                @error('name')
                                    <label class="text-danger small">{{ $message }}</label>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" class="form-control rounded-left" placeholder="Email"
                                        name="email" required>
                                    <div class="input-group-addon">
                                        <i class="fa fa-envelope" aria-hidden="true"></i>
                                    </div>
                                </div>
                                @error('email')
                                    <label class="text-danger small">{{ $message }}</label>
                                @enderror
                            </div>
                            <div class="form-group d-flex">
                                <div class="input-group" id="show_hide_password">
                                    <input type="password" class="form-control rounded-left" placeholder="Mật khẩu"
                                        name="password" required>
                                    <div class="input-group-addon">
                                        <a><i class="fa fa-lock" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                                @error('password')
                                    <label class="text-danger small">{{ $message }}</label>
                                @enderror
                            </div>
                            <div class="form-group d-flex">
                                <div class="input-group" id="confirm_password">
                                    <input type="password" class="form-control rounded-left" placeholder="Nhập lại mật khẩu"
                                        name="confirm_password" required>
                                    <div class="input-group-addon">
                                        <a><i class="fa fa-xmark" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                                @error('confirm_password')
                                    <label class="text-danger small">{{ $message }}</label>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button type="submit"
                                    class="form-control btn btn-primary btn-block rounded submit px-3 disabled">
                                    Đăng ký
                                </button>
                            </div>
                            <div class="form-group d-md-flex">
                                <div class="w-50 text-md-left">
                                    <a href="{{ route('login') }}">Đăng nhập</a>
                                </div>
                                <div class="w-50 text-md-right">
                                    <a href="#">Quên mật khẩu?</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


@section('footer')
    <script>
        $(document).ready(function() {
            $("#show_hide_password a").on('click', function(event) {
                event.preventDefault();
                if ($('#confirm_password input').attr("type") == "text") {
                    $('#confirm_password input').attr('type', 'password');
                } else if ($('#confirm_password input').attr("type") == "password") {
                    $('#confirm_password input').attr('type', 'text');
                }
            });

            function checkConfirmPwd() {
                let pwd = $("#show_hide_password input").val();
                let confirm_pwd = $("#confirm_password input").val();
                if (pwd === confirm_pwd && pwd.length > 5) {
                    $('#confirm_password i').removeClass("fa-xmark");
                    $('#confirm_password i').addClass("fa-check");
                    $('button[type=submit]').removeClass("disabled");
                } else {
                    $('#confirm_password i').removeClass("fa-check");
                    $('#confirm_password i').addClass("fa-xmark");
                    $('button[type=submit]').addClass("disabled");
                }
            }
            $("#confirm_password input").keyup(function() {
                checkConfirmPwd();
            });
            $("#show_hide_password input").keyup(function() {
                checkConfirmPwd();
            });
        });
    </script>
@endsection
