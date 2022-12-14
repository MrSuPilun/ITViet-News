@extends('layouts.app_layout.app_layout')

@section('header')
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.6.16/sweetalert2.min.js"
        integrity="sha512-4aFcnPgoxsyUPgn8gNinplVIEoeBizjYPTpmOaUbC3VZQCsRnduAOch9v0Pn30yTeoWq1rIZByAE4/Gg79VPEA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <style>
        body,
        html,
        .card-profile {
            background: #F1F3FA;
        }

        /* Profile container */
        .profile {
            margin: 20px 0;
        }

        /* Profile sidebar */
        .profile-sidebar {
            padding: 20px 0 10px 0;
            background: #fff;
        }

        .profile-userpic img {
            float: none;
            margin: 0 auto;
            width: 50%;
            height: 50%;
            -webkit-border-radius: 50% !important;
            -moz-border-radius: 50% !important;
            border-radius: 50% !important;
        }

        .profile-usertitle {
            text-align: center;
            margin-top: 20px;
        }

        .profile-usertitle-name {
            color: #5a7391;
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 7px;
        }

        .profile-usertitle-job {
            text-transform: uppercase;
            color: #5b9bd1;
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 15px;
        }

        .profile-userbuttons {
            text-align: center;
            margin-top: 10px;
        }

        .profile-userbuttons .btn {
            text-transform: uppercase;
            font-size: 11px;
            font-weight: 600;
            padding: 6px 15px;
            margin-right: 5px;
        }

        .profile-userbuttons .btn:last-child {
            margin-right: 0px;
        }

        .profile-usermenu {
            margin-top: 30px;
        }

        .profile-usermenu ul li {
            border-bottom: 1px solid #f0f4f7;
            width: 100%;
        }

        .profile-usermenu ul li:last-child {
            border-bottom: none;
        }

        .profile-usermenu ul li a {
            color: #93a3b5;
            font-size: 14px;
            font-weight: 400;
        }

        .profile-usermenu ul li a i {
            margin-right: 8px;
            font-size: 14px;
        }

        .profile-usermenu ul li a:hover {
            background-color: #fafcfd;
            color: #5b9bd1;
        }

        .profile-usermenu ul li.active {
            border-bottom: none;
        }

        .profile-usermenu ul li.active a {
            color: #5b9bd1;
            background-color: #f6f9fb;
            border-left: 2px solid #5b9bd1;
            margin-left: -2px;
        }

        /* Profile Content */
        .profile-content {
            padding: 20px;
            background: #fff;
            min-height: 460px;
        }
    </style>
@endsection

@section('content')
    <div class="container card-profile">
        <div class="row profile">
            <div class="col-md-3">
                <div class="profile-sidebar">
                    <!-- SIDEBAR USERPIC -->
                    <div class="profile-userpic">
                        @if (auth('user')->user()->avatar)
                            <img src="{{ auth('user')->user()->avatar }}" class="img-responsive" alt="">
                        @else
                            <img src="{{ asset('assets/app/images/avatars/male.png') }}" class="img-responsive"
                                alt="">
                        @endif

                    </div>
                    <!-- END SIDEBAR USERPIC -->
                    <!-- SIDEBAR USER TITLE -->
                    <div class="profile-usertitle">
                        <div class="profile-usertitle-name">
                            {{ auth('user')->user()->name }}
                        </div>
                    </div>
                    <!-- END SIDEBAR USER TITLE -->
                    <!-- SIDEBAR BUTTONS -->
                    {{-- <div class="profile-userbuttons">
                        <button type="button" class="btn btn-success btn-sm">Follow</button>
                        <button type="button" class="btn btn-danger btn-sm">Message</button>
                    </div> --}}
                    <!-- END SIDEBAR BUTTONS -->
                    <!-- SIDEBAR MENU -->
                    <div class="profile-usermenu">
                        <ul class="nav">
                            <li>
                                <a href="{{ route('user.profile') }}">
                                    <i class="glyphicon glyphicon-home"></i>
                                    Th??ng tin ng?????i d??ng </a>
                            </li>
                            <li class="active">
                                <a href="{{ route('user.profileSetting') }}">
                                    <i class="glyphicon glyphicon-user"></i>
                                    C??i ?????t t??i kho???n </a>
                            </li>
                            <li>
                                <a href="{{ route('user.logout') }}" class="text-danger">
                                    <i class="glyphicon glyphicon-log-out"></i>
                                    ????ng xu???t </a>
                            </li>
                        </ul>
                    </div>
                    <!-- END MENU -->
                </div>
            </div>
            <div class="col-md-9">
                <div class="profile-content">
                    <form id="form-profile-user" class="form" action="{{ route('user.profileSetting') }}" method="post">
                        @csrf
                        <div class="form-group">

                            <div class="col-xs-12">
                                <label for="name">
                                    <h4>H??? v?? T??n</h4>
                                </label>
                                <input type="text" class="form-control" name="name" placeholder="H??? v?? t??n"
                                    value="{{ $user->name }}" title="Nh???p v??o t??n ?????y ????? c???a b???n.">
                                @error('name')
                                    <small class="form-text text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">

                            <div class="col-xs-6">
                                <label for="phone">
                                    <h4>S??? ??i???n tho???i</h4>
                                </label>
                                <input type="text" class="form-control" name="phone" placeholder="S??? ??i???n tho???i"
                                    value="{{ $user->phone }}" title="Nh???p v??o s??? ??i???n tho???i c???a b???n.">
                                @error('phone')
                                    <small class="form-text text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">

                            <div class="col-xs-6">
                                <label for="email">
                                    <h4>Email</h4>
                                </label>
                                <input type="email" class="form-control" name="email" placeholder="you@email.com"
                                    value="{{ $user->email }}" title="Nh???p v??o ?????a ch??? email c???a b???n.">
                                @error('email')
                                    <small class="form-text text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">

                            <div class="col-xs-12">
                                <label for="address">
                                    <h4>?????a ch???</h4>
                                </label>
                                <textarea maxlength="254" type="text" class="form-control" name="address" placeholder="?????a ch???"
                                    title="enter your password.">{{ $user->address }}</textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-12">
                                <br>
                                <button class="btn btn-lg btn-success" type="submit">
                                    <i class="glyphicon glyphicon-ok-sign"></i>
                                    C???p nh???p
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <!-- Sweet Alert -->
    @include('sweetalert::alert')
@endsection
