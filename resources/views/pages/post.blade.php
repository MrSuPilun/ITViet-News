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
                                    <a class="f1-s-4 cl8 hov-cl10 trans-03">
                                        Tác giả: {{ $post->author()->first()->name }}
                                    </a>

                                    <span class="m-rl-3">-</span>
                                    {{-- Time --}}
                                    <span>
                                        {{ diffInTime($post->created_at) }}
                                    </span>
                                </span>
                                {{-- Views --}}
                                <span class="f1-s-3 cl8 m-r-15">
                                    {{ $post->view }} Lượt xem
                                </span>

                                <a href="#" class="f1-s-3 cl8 hov-cl10 trans-03 m-r-15">
                                    {{ $post->comments()->get()->count() }} Bình luận
                                </a>
                            </div>
                            {{-- Thumbnail --}}
                            {{-- <div class="wrap-pic-max-w p-b-30">
                                <img src="{{ $post->thumbnail }}" alt="IMG">
                            </div> --}}

                            {{-- CONTENT --}}
                            {!! $post->content !!}

                            <!-- Tag -->
                            <div class="flex-s-s p-t-12 p-b-15">
                                <span class="f1-s-12 cl5 m-r-8">
                                    Thẻ:
                                </span>

                                <div class="flex-wr-s-s size-w-0">
                                    @foreach ($post->tags()->get() as $tag)
                                        <a href="{{ route('searchPostsByTag', ['t' => $tag->title]) }}"
                                            class="f1-s-12 cl8 hov-link1 m-r-15">
                                            {{ $tag->title }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Share -->
                            {{-- <div class="flex-s-s">
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
                            </div> --}}
                        </div>

                        <!-- Leave a comment -->

                        <div>
                            <h4 class="f1-l-4 cl3 p-b-12">
                                Bình Luận
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
                                        Vui lòng <a href="{{ route('login') }}">đăng nhập</a> trước khi bình luận
                                    </p>
                                @endauth
                            </div>

                        </div>
                    </div>
                </div>

                {{-- SideBar --}}
                @include('layouts.app_layout.app_sidebar')

            </div>
        </div>
    </section>
@endsection

@section('footer')
    @auth('user')
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
    @endauth
@endsection
