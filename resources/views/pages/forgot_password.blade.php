@extends('layouts.app_guard_layout.app_guard_layout')

@section('content')
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-7 col-lg-5">
                    <div class="login-wrap p-4 p-md-5">
                        <h3 class="text-center mb-4">
                            Quên Mật Khẩu
                        </h3>
                        <form action="{{ route('user.forgotPassword') }}" class="login-form" method="post">
                            @csrf
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
                            <div class="form-group">
                                <button type="submit" class="form-control btn btn-primary btn-block rounded submit px-3">
                                    Gửi liên kết đổi mật khẩu
                                </button>
                            </div>
                            <div class="form-group d-md-flex">
                                <div class="w-50 text-md-left">
                                    <a href="{{ route('user.register') }}">Đăng ký</a>
                                </div>
                                <div class="w-50 text-md-right">
                                    <a href="{{ route('login') }}">Đăng nhập</a>
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
    @include('sweetalert::alert')
@endsection
