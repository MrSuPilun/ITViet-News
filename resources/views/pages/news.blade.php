@extends('layouts.app_layout.app_layout')

@section('header')
    <style>
        #post_content p {
            font-family: Roboto-Regular;
            font-size: 14px;
            line-height: 1.8;
            padding-bottom: 25px;
        }

        #post_content img {
            width: 100%;
        }

        .date {
            font-size: 11px
        }

        /* .comment-text {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                font-size: 12px
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            } */

        .fs-12 {
            font-size: 12px
        }

        .shadow-none {
            box-shadow: none
        }

        .name {
            color: #007bff
        }

        .cursor:hover {
            color: blue
        }

        .cursor {
            cursor: pointer
        }

        .textarea {
            resize: none
        }
    </style>
@endsection

@section('content')
    <section class="bg0 p-b-140 p-t-10">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-8">
                    <div class="p-r-10 p-r-0-sr991">
                        <!-- Post Detail -->
                        <div id="post_content" class="p-b-70">
                            {{-- Title --}}
                            <h3 class="f1-l-3 cl2 p-b-16 p-t-33 respon2">
                                {{ $post->title }}
                            </h3>
                            {{-- Details Post --}}
                            <div class="flex-wr-s-s p-b-40">
                                <span class="f1-s-3 cl8 m-r-15">
                                    {{-- Author --}}
                                    <a href="#" class="f1-s-4 cl8 hov-cl10 trans-03">
                                        by {{ $post->author()->first()->name }}
                                    </a>

                                    <span class="m-rl-3">-</span>
                                    {{-- Time --}}
                                    <span>
                                        {{ $post->created_at }}
                                    </span>
                                </span>
                                {{-- Views --}}
                                <span class="f1-s-3 cl8 m-r-15">
                                    {{ $post->view }} Views
                                </span>

                                <a href="#" class="f1-s-3 cl8 hov-cl10 trans-03 m-r-15">
                                    0 Comment
                                </a>
                            </div>
                            {{-- Thumbnail --}}
                            <div class="wrap-pic-max-w p-b-30">
                                <img src="{{ $post->thumbnail }}" alt="IMG">
                            </div>

                            {{-- CONTENT --}}
                            {!! $post->content !!}

                            <!-- Tag -->
                            <div class="flex-s-s p-t-12 p-b-15">
                                <span class="f1-s-12 cl5 m-r-8">
                                    Tags:
                                </span>

                                <div class="flex-wr-s-s size-w-0">
                                    <a href="#" class="f1-s-12 cl8 hov-link1 m-r-15">
                                        Streetstyle
                                    </a>

                                    <a href="#" class="f1-s-12 cl8 hov-link1 m-r-15">
                                        Crafts
                                    </a>
                                </div>
                            </div>

                            <!-- Share -->
                            <div class="flex-s-s">
                                <span class="f1-s-12 cl5 p-t-1 m-r-15">
                                    Share:
                                </span>

                                <div class="flex-wr-s-s size-w-0">
                                    <a href="#"
                                        class="dis-block f1-s-13 cl0 bg-facebook borad-3 p-tb-4 p-rl-18 hov-btn1 m-r-3 m-b-3 trans-03">
                                        <i class="fab fa-facebook-f m-r-7"></i>
                                        Facebook
                                    </a>

                                    <a href="#"
                                        class="dis-block f1-s-13 cl0 bg-twitter borad-3 p-tb-4 p-rl-18 hov-btn1 m-r-3 m-b-3 trans-03">
                                        <i class="fab fa-twitter m-r-7"></i>
                                        Twitter
                                    </a>

                                    <a href="#"
                                        class="dis-block f1-s-13 cl0 bg-google borad-3 p-tb-4 p-rl-18 hov-btn1 m-r-3 m-b-3 trans-03">
                                        <i class="fab fa-google-plus-g m-r-7"></i>
                                        Google+
                                    </a>

                                    <a href="#"
                                        class="dis-block f1-s-13 cl0 bg-pinterest borad-3 p-tb-4 p-rl-18 hov-btn1 m-r-3 m-b-3 trans-03">
                                        <i class="fab fa-pinterest-p m-r-7"></i>
                                        Pinterest
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Leave a comment -->

                        <div>
                            <h4 class="f1-l-4 cl3 p-b-12">
                                Leave a Comment
                            </h4>

                            {{-- Comment --}}
                            <div class="d-flex flex-column comment-section">
                                @foreach ($post->getFirstComments()->get() as $item)
                                    <x-comment-box :item="$item" level="0" />
                                @endforeach
                                @auth('user')
                                    <div class="bg-light p-2">
                                        <form action="{{ route('user.comment') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                                            <div class="d-flex flex-row align-items-start">
                                                <div>
                                                    <img class="rounded-circle" src="{{ auth('user')->user()->avatar }}"
                                                        width="40">
                                                </div>
                                                <div class="d-flex flex-column justify-content-start ml-2 w-100">
                                                    <p class="d-block font-weight-bold name">{{ auth()->user()->name }}</p>
                                                    <textarea class="form-control shadow-none textarea" name="content" placeholder="...Nhập bình luận..."></textarea>
                                                </div>
                                            </div>
                                            <div class="mt-2 text-right">
                                                <button type="submit" class="btn btn-primary btn-sm shadow-none"
                                                    type="button">
                                                    Bình luận
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                @else
                                    <p class="f1-s-13 cl8 p-b-40">
                                        Please <a href="{{ route('login') }}">login</a> before commenting
                                    </p>
                                @endauth
                            </div>

                        </div>
                    </div>
                </div>

                {{-- SideBar --}}
                <div class="col-md-10 col-lg-4 p-b-30">
                    <div class="p-l-10 p-rl-0-sr991 p-t-33">
                        <!-- Most Popular -->
                        <div class="p-b-30">
                            <div class="how2 how2-cl4 flex-s-c">
                                <h3 class="f1-m-2 cl3 tab01-title">
                                    Most Popular
                                </h3>
                            </div>

                            <ul class="p-t-35">
                                <li class="flex-wr-sb-s p-b-22">
                                    <div class="size-a-8 flex-c-c borad-3 size-a-8 bg9 f1-m-4 cl0 m-b-6">
                                        1
                                    </div>

                                    <a href="#" class="size-w-3 f1-s-7 cl3 hov-cl10 trans-03">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit
                                    </a>
                                </li>

                                <li class="flex-wr-sb-s p-b-22">
                                    <div class="size-a-8 flex-c-c borad-3 size-a-8 bg9 f1-m-4 cl0 m-b-6">
                                        2
                                    </div>

                                    <a href="#" class="size-w-3 f1-s-7 cl3 hov-cl10 trans-03">
                                        Proin velit consectetur non neque
                                    </a>
                                </li>

                                <li class="flex-wr-sb-s p-b-22">
                                    <div class="size-a-8 flex-c-c borad-3 size-a-8 bg9 f1-m-4 cl0 m-b-6">
                                        3
                                    </div>

                                    <a href="#" class="size-w-3 f1-s-7 cl3 hov-cl10 trans-03">
                                        Nunc vestibulum, enim vitae condimentum volutpat lobortis ante
                                    </a>
                                </li>

                                <li class="flex-wr-sb-s p-b-22">
                                    <div class="size-a-8 flex-c-c borad-3 size-a-8 bg9 f1-m-4 cl0 m-b-6">
                                        4
                                    </div>

                                    <a href="#" class="size-w-3 f1-s-7 cl3 hov-cl10 trans-03">
                                        Proin velit justo consectetur non neque elementum
                                    </a>
                                </li>

                                <li class="flex-wr-sb-s p-b-22">
                                    <div class="size-a-8 flex-c-c borad-3 size-a-8 bg9 f1-m-4 cl0">
                                        5
                                    </div>

                                    <a href="#" class="size-w-3 f1-s-7 cl3 hov-cl10 trans-03">
                                        Proin velit consectetur non neque
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <!--  -->
                        <div class="flex-c-s p-t-8 p-b-65">
                            <a href="#">
                                <img class="max-w-full" src="{{ asset('assets/app/images/banner-02.jpg') }}"
                                    alt="IMG">
                            </a>
                        </div>

                        <!-- Video -->
                        <div class="p-b-55">
                            <div class="how2 how2-cl4 flex-s-c m-b-35">
                                <h3 class="f1-m-2 cl3 tab01-title">
                                    Featured Video
                                </h3>
                            </div>

                            <div>
                                <div class="wrap-pic-w pos-relative">
                                    <img src="{{ asset('assets/app/images/video-01.jpg') }}" alt="IMG">

                                    <button class="s-full ab-t-l flex-c-c fs-32 cl0 hov-cl10 trans-03" data-toggle="modal"
                                        data-target="#modal-video-01">
                                        <span class="fab fa-youtube"></span>
                                    </button>
                                </div>

                                <div class="p-tb-16 p-rl-25 bg3">
                                    <h5 class="p-b-5">
                                        <a href="#" class="f1-m-3 cl0 hov-cl10 trans-03">
                                            Music lorem ipsum dolor sit amet consectetur
                                        </a>
                                    </h5>

                                    <span class="cl15">
                                        <a href="#" class="f1-s-4 cl8 hov-cl10 trans-03">
                                            by John Alvarado
                                        </a>

                                        <span class="f1-s-3 m-rl-3">
                                            -
                                        </span>

                                        <span class="f1-s-3">
                                            Feb 18
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Tag -->
                        <div class="p-b-55">
                            <div class="how2 how2-cl4 flex-s-c m-b-30">
                                <h3 class="f1-m-2 cl3 tab01-title">
                                    Tags
                                </h3>
                            </div>

                            <div class="flex-wr-s-s m-rl--5">
                                <a href="#"
                                    class="flex-c-c size-h-2 bo-1-rad-20 bocl12 f1-s-1 cl8 hov-btn2 trans-03 p-rl-20 p-tb-5 m-all-5">
                                    Fashion
                                </a>

                                <a href="#"
                                    class="flex-c-c size-h-2 bo-1-rad-20 bocl12 f1-s-1 cl8 hov-btn2 trans-03 p-rl-20 p-tb-5 m-all-5">
                                    Lifestyle
                                </a>

                                <a href="#"
                                    class="flex-c-c size-h-2 bo-1-rad-20 bocl12 f1-s-1 cl8 hov-btn2 trans-03 p-rl-20 p-tb-5 m-all-5">
                                    Denim
                                </a>

                                <a href="#"
                                    class="flex-c-c size-h-2 bo-1-rad-20 bocl12 f1-s-1 cl8 hov-btn2 trans-03 p-rl-20 p-tb-5 m-all-5">
                                    Streetstyle
                                </a>

                                <a href="#"
                                    class="flex-c-c size-h-2 bo-1-rad-20 bocl12 f1-s-1 cl8 hov-btn2 trans-03 p-rl-20 p-tb-5 m-all-5">
                                    Crafts
                                </a>

                                <a href="#"
                                    class="flex-c-c size-h-2 bo-1-rad-20 bocl12 f1-s-1 cl8 hov-btn2 trans-03 p-rl-20 p-tb-5 m-all-5">
                                    Magazine
                                </a>

                                <a href="#"
                                    class="flex-c-c size-h-2 bo-1-rad-20 bocl12 f1-s-1 cl8 hov-btn2 trans-03 p-rl-20 p-tb-5 m-all-5">
                                    News
                                </a>

                                <a href="#"
                                    class="flex-c-c size-h-2 bo-1-rad-20 bocl12 f1-s-1 cl8 hov-btn2 trans-03 p-rl-20 p-tb-5 m-all-5">
                                    Blogs
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('footer')
    <script>
        function removeComment(e) {
            $(e)?.parent()?.parent()?.parent()?.remove();
        }

        function formComment(id) {
            return "<div class='bg-light p-2 reply-form'>" +
                "<form action='{{ route('user.comment') }}' method='post'>" +
                `@csrf` +
                `<input type='hidden' name='parent_id' value='` + id + `'>` +
                `<input type='hidden' name='post_id' value='{{ $post->id }}'>` +
                "<div class='d-flex flex-row align-items-start'>" +
                "<div><img class='rounded-circle' src='{{ auth('user')->user()->avatar }}' width='40'></div>" +
                "<div class='d-flex flex-column justify-content-start ml-2 w-100'>" +
                "<p class='d-block font-weight-bold name'>{{ auth()->user()->name }}</p>" +
                "<textarea class='form-control shadow-none textarea' name='content' placeholder='...Nhập bình luận...'></textarea>" +
                "</div></div>" +
                "<div class='mt-2 text-right'>" +
                "<button type='submit' class='btn btn-primary btn-sm shadow-none' type='button'>Bình luận</button>" +
                "<div onClick='removeComment(this)' class='btn btn-danger btn-sm ml-1 shadow-none'>Cancel</div>" +
                "</div></form></div>";
        }


        $(document).ready(function() {
            $('.reply-btn').click(function() {
                let replyId = $(this).data('replyId');
                let parent = $(this).parent().parent();
                $('.comment-section').find("div.reply-form").remove();
                parent.append(formComment(replyId));
            });
        });
    </script>
@endsection
