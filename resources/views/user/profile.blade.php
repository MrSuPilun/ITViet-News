@extends('layouts.app_layout.app_layout')

@section('header')
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
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
                            <img src="{{ asset('assets/app/images/avatars/user.png') }}" class="img-responsive"
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
                            <li class="active">
                                <a href="{{ route('user.profile') }}">
                                    <i class="glyphicon glyphicon-home"></i>
                                    Thông tin người dùng </a>
                            </li>
                            <li>
                                <a href="{{ route('user.profileSetting') }}">
                                    <i class="glyphicon glyphicon-user"></i>
                                    Cài đặt tài khoản </a>
                            </li>
                            <li>
                                <a href="{{ route('user.logout') }}" class="text-danger">
                                    <i class="glyphicon glyphicon-log-out"></i>
                                    Đăng xuất </a>
                            </li>
                        </ul>
                    </div>
                    <!-- END MENU -->
                </div>
            </div>
            <div class="col-md-9">
                <div class="profile-content">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Tên</label>
                        </div>
                        <div class="col-md-8">
                            <p>{{ auth('user')->user()->name }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Số điện thoại</label>
                        </div>
                        <div class="col-md-8">
                            <p>{{ auth('user')->user()->phone }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Email</label>
                        </div>
                        <div class="col-md-8">
                            <p>{{ auth('user')->user()->email }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Địa chỉ</label>
                        </div>
                        <div class="col-md-8">
                            <p>{{ auth('user')->user()->address }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
