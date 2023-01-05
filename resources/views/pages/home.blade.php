@extends('layouts.app_layout.app_layout')

@section('header')
    <style>
        .img-format {
            aspect-ratio: 4/3;
            object-fit: cover;
        }

        .img-square-format {
            aspect-ratio: 1/1;
            object-fit: cover;
        }
    </style>
@endsection

@section('content')
    <!-- Feature post -->
    <x-home.feature-post-component :feature="$posts" />

    <!-- Post -->
    <section class="bg0 p-t-70">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-8">
                    <div class="p-b-20">
                        <!-- Sản phẩm  -->
                        <div class="p-b-20">
                            <div class="how2 how2-cl1 flex-sb-c m-r-10 m-r-0-sr991">
                                <h3 class="f1-m-2 cl12 tab01-title">
                                    {{ $featureTags[0] }}
                                </h3>


                                <a href="{{ route('searchPostsByTag', ['t' => $featureTags[0]]) }}"
                                    class="tab01-link f1-s-1 cl9 hov-cl10 trans-03">
                                    Xem tất cả
                                    <i class="fs-12 m-l-5 fa fa-caret-right"></i>
                                </a>
                            </div>

                            <div class="row p-t-35">
                                <div class="col-sm-6 p-r-25 p-r-15-sr991">
                                    @foreach (loadPostByTag($featureTags[0], 1) as $item)
                                        <!-- Item post -->
                                        <div class="m-b-30">
                                            <a href="{{ route('post', ['id' => $item->id]) }}"
                                                class="wrap-pic-w hov1 trans-03">
                                                <img class="img-format" src="{{ $item->thumbnail }}" alt="IMG">
                                            </a>

                                            <div class="p-t-20">
                                                <h5 class="p-b-5">
                                                    <a href="{{ route('post', ['id' => $item->id]) }}"
                                                        class="f1-m-3 cl2 hov-cl10 trans-03">
                                                        {{ $item->title }}
                                                    </a>
                                                </h5>

                                                <span class="cl8">
                                                    <a class="f1-s-4 cl8 hov-cl10 trans-03">
                                                        {{ $item->author->name }}
                                                    </a>

                                                    <span class="f1-s-3 m-rl-3">
                                                        -
                                                    </span>

                                                    <span class="f1-s-3">
                                                        {{ diffInTime($item->created_at) }}
                                                    </span>
                                                </span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="col-sm-6 p-r-25 p-r-15-sr991">
                                    @foreach (loadPostByTag($featureTags[0], 4) as $item)
                                        @if (!$loop->first)
                                            <!-- Item post -->
                                            <div class="flex-wr-sb-s m-b-30">
                                                <a href="{{ route('post', ['id' => $item->id]) }}"
                                                    class="size-w-1 wrap-pic-w hov1 trans-03">
                                                    <img class="img-format" src="{{ $item->thumbnail }}"
                                                        alt="IMG {{ $item->title }}">
                                                </a>

                                                <div class="size-w-2">
                                                    <h5 class="p-b-5">
                                                        <a href="{{ route('post', ['id' => $item->id]) }}"
                                                            class="f1-s-5 cl3 hov-cl10 trans-03">
                                                            {{ $item->title }}
                                                        </a>
                                                    </h5>

                                                    <span class="cl8">
                                                        <a class="f1-s-6 cl8 hov-cl10 trans-03">
                                                            {{ $item->author->name }}
                                                        </a>

                                                        <span class="f1-s-3 m-rl-3">
                                                            -
                                                        </span>

                                                        <span class="f1-s-3">
                                                            {{ diffInTime($item->created_at) }}
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- Khác -->
                        <div class="row">
                            <!-- Trò chơi -->
                            <div class="col-sm-6 p-r-25 p-r-15-sr991 p-b-25">
                                <div class="how2 how2-cl2 flex-sb-c m-b-35">
                                    <h3 class="f1-m-2 cl13 tab01-title">
                                        {{ $featureTags[1] }}
                                    </h3>


                                    <a href="{{ route('searchPostsByTag', ['t' => $featureTags[1]]) }}"
                                        class="tab01-link f1-s-1 cl9 hov-cl10 trans-03">
                                        Xem tất cả
                                        <i class="fs-12 m-l-5 fa fa-caret-right"></i>
                                    </a>
                                </div>

                                @foreach (loadPostByTag($featureTags[1], 3) as $item)
                                    @if ($loop->first)
                                        <!-- Main Item post -->
                                        <div class="m-b-30">
                                            <a href="{{ route('post', ['id' => $item->id]) }}"
                                                class="wrap-pic-w hov1 trans-03">
                                                <img class="img-format" src="{{ $item->thumbnail }}" alt="IMG">
                                            </a>

                                            <div class="p-t-20">
                                                <h5 class="p-b-5">
                                                    <a href="{{ route('post', ['id' => $item->id]) }}"
                                                        class="f1-m-3 cl2 hov-cl10 trans-03">
                                                        {{ $item->title }}
                                                    </a>
                                                </h5>

                                                <span class="cl8">
                                                    <a class="f1-s-4 cl8 hov-cl10 trans-03">
                                                        {{ $item->author->name }}
                                                    </a>

                                                    <span class="f1-s-3 m-rl-3">
                                                        -
                                                    </span>

                                                    <span class="f1-s-3">
                                                        {{ diffInTime($item->created_at) }}
                                                    </span>
                                                </span>
                                            </div>
                                        </div>
                                    @else
                                        <!-- Item post -->
                                        <div class="flex-wr-sb-s m-b-30">
                                            <a href="{{ route('post', ['id' => $item->id]) }}"
                                                class="size-w-1 wrap-pic-w hov1 trans-03">
                                                <img class="img-format" src="{{ $item->thumbnail }}" alt="IMG">
                                            </a>

                                            <div class="size-w-2">
                                                <h5 class="p-b-5">
                                                    <a href="{{ route('post', ['id' => $item->id]) }}"
                                                        class="f1-s-5 cl3 hov-cl10 trans-03">
                                                        {{ $item->title }}
                                                    </a>
                                                </h5>

                                                <span class="cl8">
                                                    <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                        {{ $item->author->name }}
                                                    </a>

                                                    <span class="f1-s-3 m-rl-3">
                                                        -
                                                    </span>

                                                    <span class="f1-s-3">
                                                        {{ diffInTime($item->created_at) }}
                                                    </span>
                                                </span>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>

                            <!-- Cuộc thi -->
                            <div class="col-sm-6 p-r-25 p-r-15-sr991 p-b-25">
                                <div class="how2 how2-cl6 flex-sb-c m-b-35">
                                    <h3 class="f1-m-2 cl18 tab01-title">
                                        {{ $featureTags[2] }}
                                    </h3>


                                    <a href="{{ route('searchPostsByTag', ['t' => $featureTags[2]]) }}"
                                        class="tab01-link f1-s-1 cl9 hov-cl10 trans-03">
                                        Xem tất cả
                                        <i class="fs-12 m-l-5 fa fa-caret-right"></i>
                                    </a>
                                </div>

                                @foreach (loadPostByTag($featureTags[2], 3) as $item)
                                    @if ($loop->first)
                                        <!-- Main Item post -->
                                        <div class="m-b-30">
                                            <a href="{{ route('post', ['id' => $item->id]) }}"
                                                class="wrap-pic-w hov1 trans-03">
                                                <img class="img-format" src="{{ $item->thumbnail }}" alt="IMG">
                                            </a>

                                            <div class="p-t-20">
                                                <h5 class="p-b-5">
                                                    <a href="{{ route('post', ['id' => $item->id]) }}"
                                                        class="f1-m-3 cl2 hov-cl10 trans-03">
                                                        {{ $item->title }}
                                                    </a>
                                                </h5>

                                                <span class="cl8">
                                                    <a class="f1-s-4 cl8 hov-cl10 trans-03">
                                                        {{ $item->author->name }}
                                                    </a>

                                                    <span class="f1-s-3 m-rl-3">
                                                        -
                                                    </span>

                                                    <span class="f1-s-3">
                                                        {{ diffInTime($item->created_at) }}
                                                    </span>
                                                </span>
                                            </div>
                                        </div>
                                    @else
                                        <!-- Item post -->
                                        <div class="flex-wr-sb-s m-b-30">
                                            <a href="{{ route('post', ['id' => $item->id]) }}"
                                                class="size-w-1 wrap-pic-w hov1 trans-03">
                                                <img class="img-format" src="{{ $item->thumbnail }}" alt="IMG">
                                            </a>

                                            <div class="size-w-2">
                                                <h5 class="p-b-5">
                                                    <a href="{{ route('post', ['id' => $item->id]) }}"
                                                        class="f1-s-5 cl3 hov-cl10 trans-03">
                                                        {{ $item->title }}
                                                    </a>
                                                </h5>

                                                <span class="cl8">
                                                    <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                        {{ $item->author->name }}
                                                    </a>

                                                    <span class="f1-s-3 m-rl-3">
                                                        -
                                                    </span>

                                                    <span class="f1-s-3">
                                                        {{ diffInTime($item->created_at) }}
                                                    </span>
                                                </span>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>

                            <!-- Blockchain -->
                            <div class="col-sm-6 p-r-25 p-r-15-sr991 p-b-25">
                                <div class="how2 how2-cl5 flex-sb-c m-b-35">
                                    <h3 class="f1-m-2 cl17 tab01-title">
                                        {{ $featureTags[3] }}
                                    </h3>


                                    <a href="{{ route('searchPostsByTag', ['t' => $featureTags[3]]) }}"
                                        class="tab01-link f1-s-1 cl9 hov-cl10 trans-03">
                                        Xem tất cả
                                        <i class="fs-12 m-l-5 fa fa-caret-right"></i>
                                    </a>
                                </div>

                                @foreach (loadPostByTag($featureTags[3], 3) as $item)
                                    @if ($loop->first)
                                        <!-- Main Item post -->
                                        <div class="m-b-30">
                                            <a href="{{ route('post', ['id' => $item->id]) }}"
                                                class="wrap-pic-w hov1 trans-03">
                                                <img class="img-format" src="{{ $item->thumbnail }}" alt="IMG">
                                            </a>

                                            <div class="p-t-20">
                                                <h5 class="p-b-5">
                                                    <a href="{{ route('post', ['id' => $item->id]) }}"
                                                        class="f1-m-3 cl2 hov-cl10 trans-03">
                                                        {{ $item->title }}
                                                    </a>
                                                </h5>

                                                <span class="cl8">
                                                    <a class="f1-s-4 cl8 hov-cl10 trans-03">
                                                        {{ $item->author->name }}
                                                    </a>

                                                    <span class="f1-s-3 m-rl-3">
                                                        -
                                                    </span>

                                                    <span class="f1-s-3">
                                                        {{ diffInTime($item->created_at) }}
                                                    </span>
                                                </span>
                                            </div>
                                        </div>
                                    @else
                                        <!-- Item post -->
                                        <div class="flex-wr-sb-s m-b-30">
                                            <a href="{{ route('post', ['id' => $item->id]) }}"
                                                class="size-w-1 wrap-pic-w hov1 trans-03">
                                                <img class="img-format" src="{{ $item->thumbnail }}" alt="IMG">
                                            </a>

                                            <div class="size-w-2">
                                                <h5 class="p-b-5">
                                                    <a href="{{ route('post', ['id' => $item->id]) }}"
                                                        class="f1-s-5 cl3 hov-cl10 trans-03">
                                                        {{ $item->title }}
                                                    </a>
                                                </h5>

                                                <span class="cl8">
                                                    <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                        {{ $item->author->name }}
                                                    </a>

                                                    <span class="f1-s-3 m-rl-3">
                                                        -
                                                    </span>

                                                    <span class="f1-s-3">
                                                        {{ diffInTime($item->created_at) }}
                                                    </span>
                                                </span>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>

                            <!-- AI -->
                            <div class="col-sm-6 p-r-25 p-r-15-sr991 p-b-25">
                                <div class="how2 how2-cl16 flex-sb-c m-b-35">
                                    <h3 class="f1-m-2 cl18 tab01-title">
                                        {{ $featureTags[4] }}
                                    </h3>


                                    <a href="{{ route('searchPostsByTag', ['t' => $featureTags[4]]) }}"
                                        class="tab01-link f1-s-1 cl9 hov-cl10 trans-03">
                                        Xem tất cả
                                        <i class="fs-12 m-l-5 fa fa-caret-right"></i>
                                    </a>
                                </div>

                                @foreach (loadPostByTag($featureTags[4], 3) as $item)
                                    @if ($loop->first)
                                        <!-- Main Item post -->
                                        <div class="m-b-30">
                                            <a href="{{ route('post', ['id' => $item->id]) }}"
                                                class="wrap-pic-w hov1 trans-03">
                                                <img class="img-format" src="{{ $item->thumbnail }}" alt="IMG">
                                            </a>

                                            <div class="p-t-20">
                                                <h5 class="p-b-5">
                                                    <a href="{{ route('post', ['id' => $item->id]) }}"
                                                        class="f1-m-3 cl2 hov-cl10 trans-03">
                                                        {{ $item->title }}
                                                    </a>
                                                </h5>

                                                <span class="cl8">
                                                    <a class="f1-s-4 cl8 hov-cl10 trans-03">
                                                        {{ $item->author->name }}
                                                    </a>

                                                    <span class="f1-s-3 m-rl-3">
                                                        -
                                                    </span>

                                                    <span class="f1-s-3">
                                                        {{ diffInTime($item->created_at) }}
                                                    </span>
                                                </span>
                                            </div>
                                        </div>
                                    @else
                                        <!-- Item post -->
                                        <div class="flex-wr-sb-s m-b-30">
                                            <a href="{{ route('post', ['id' => $item->id]) }}"
                                                class="size-w-1 wrap-pic-w hov1 trans-03">
                                                <img class="img-format" src="{{ $item->thumbnail }}" alt="IMG">
                                            </a>

                                            <div class="size-w-2">
                                                <h5 class="p-b-5">
                                                    <a href="{{ route('post', ['id' => $item->id]) }}"
                                                        class="f1-s-5 cl3 hov-cl10 trans-03">
                                                        {{ $item->title }}
                                                    </a>
                                                </h5>

                                                <span class="cl8">
                                                    <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                        {{ $item->author->name }}
                                                    </a>

                                                    <span class="f1-s-3 m-rl-3">
                                                        -
                                                    </span>

                                                    <span class="f1-s-3">
                                                        {{ diffInTime($item->created_at) }}
                                                    </span>
                                                </span>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>

                        <!-- Travel  -->
                        <div class="p-b-25 p-r-10 p-r-0-sr991">
                            <div class="how2 how2-cl3 flex-sb-c m-r-10 m-r-0-sr991">
                                <h3 class="f1-m-2 cl14 tab01-title">
                                    {{ $featureTags[5] }}
                                </h3>


                                <a href="{{ route('searchPostsByTag', ['t' => $featureTags[5]]) }}"
                                    class="tab01-link f1-s-1 cl9 hov-cl10 trans-03">
                                    Xem tất cả
                                    <i class="fs-12 m-l-5 fa fa-caret-right"></i>
                                </a>
                            </div>

                            <div class="flex-wr-sb-s p-t-35">
                                @foreach (loadPostByTag($featureTags[5], 1) as $item)
                                    <div class="size-w-6 w-full-sr575">
                                        <!-- Item post -->
                                        <div class="m-b-30">
                                            <a href="{{ route('post', ['id' => $item->id]) }}"
                                                class="wrap-pic-w hov1 trans-03">
                                                <img class="img-format" src="{{ $item->thumbnail }}" alt="IMG">
                                            </a>

                                            <div class="p-t-25">
                                                <h5 class="p-b-5">
                                                    <a href="{{ route('post', ['id' => $item->id]) }}"
                                                        class="f1-m-3 cl2 hov-cl10 trans-03">
                                                        {{ $item->title }}
                                                    </a>
                                                </h5>

                                                <span class="cl8">
                                                    <a class="f1-s-4 cl8 hov-cl10 trans-03">
                                                        {{ $item->author->name }}
                                                    </a>

                                                    <span class="f1-s-3 m-rl-3">
                                                        -
                                                    </span>

                                                    <span class="f1-s-3">
                                                        {{ diffInTime($item->created_at) }}
                                                    </span>
                                                </span>

                                                <p class="f1-s-1 cl6 p-t-18">
                                                    {{ $item->summary }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                <div class="size-w-7 w-full-sr575">
                                    @foreach (loadPostByTag($featureTags[5], 3) as $item)
                                        @if (!$loop->first)
                                            <!-- Item post -->
                                            <div class="m-b-30">
                                                <a href="{{ route('post', ['id' => $item->id]) }}"
                                                    class="wrap-pic-w hov1 trans-03">
                                                    <img class="img-format" src="{{ $item->thumbnail }}" alt="IMG">
                                                </a>

                                                <div class="p-t-10">
                                                    <h5 class="p-b-5">
                                                        <a href="{{ route('post', ['id' => $item->id]) }}"
                                                            class="f1-s-5 cl3 hov-cl10 trans-03">
                                                            {{ $item->title }}
                                                        </a>
                                                    </h5>

                                                    <span class="cl8">
                                                        <a class="f1-s-6 cl8 hov-cl10 trans-03">
                                                            {{ $item->author->name }}
                                                        </a>

                                                        <span class="f1-s-3 m-rl-3">
                                                            -
                                                        </span>

                                                        <span class="f1-s-3">
                                                            {{ diffInTime($item->created_at) }}
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- SideBar --}}
                @include('layouts.app_layout.app_sidebar')
            </div>
        </div>
    </section>

    <!-- Banner -->
    <div class="container m-b-15">
        <div class="flex-c-c">
            <a href="#">
                <img class="max-w-full" src="{{ asset('assets/app/images/banner-01.jpg') }}" alt="IMG">
            </a>
        </div>
    </div>

    <!-- Latest -->
    <section class="bg0 p-t-50 p-b-90">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-8 p-b-50">
                    <div class="p-r-10 p-r-0-sr991">
                        <div class="how2 how2-cl4 flex-s-c">
                            <h3 class="f1-m-2 cl3 tab01-title">
                                Bài viết mới nhất
                            </h3>
                        </div>

                        <div class="p-b-40">
                            @foreach (latestPosts() as $item)
                                <!-- Item post -->
                                <div class="flex-wr-sb-s p-t-40 p-b-15 how-bor2">
                                    <a href="{{ route('post', ['id' => $item->id]) }}"
                                        class="size-w-8 wrap-pic-w hov1 trans-03 w-full-sr575 m-b-25">
                                        <img class="img-square-format" src="{{ $item->thumbnail }}" alt="IMG">
                                    </a>

                                    <div class="size-w-9 w-full-sr575 m-b-25">
                                        <h5 class="p-b-12">
                                            <a href="{{ route('post', ['id' => $item->id]) }}"
                                                class="f1-l-1 cl2 hov-cl10 trans-03 respon2">
                                                {{ $item->title }}
                                            </a>
                                        </h5>

                                        <div class="cl8 p-b-18">
                                            <a class="f1-s-4 cl8 hov-cl10 trans-03">
                                                {{ $item->author->name }}
                                            </a>

                                            <span class="f1-s-3 m-rl-3">
                                                -
                                            </span>

                                            <span class="f1-s-3">
                                                {{ diffInTime($item->created_at) }}
                                            </span>
                                        </div>

                                        <p class="f1-s-1 cl6 p-b-24">
                                            {{ $item->summary }}
                                        </p>

                                        <a href="{{ route('post', ['id' => $item->id]) }}"
                                            class="f1-s-1 cl9 hov-cl10 trans-03">
                                            Đọc thêm
                                            <i class="m-l-2 fa fa-long-arrow-alt-right"></i>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <a href="{{ route('news') }}"
                            class="flex-c-c size-a-13 bo-all-1 bocl11 f1-m-6 cl6 hov-btn1 trans-03">
                            Hiển thị tất cả
                        </a>
                    </div>
                </div>

                <div class="col-md-10 col-lg-4 p-b-50">
                    <div class="p-l-10 p-rl-0-sr991">
                        <!-- Banner -->
                        <div class="flex-c-s">
                            <a href="#">
                                <img class="max-w-full" src="{{ asset('assets/app/images/banner-03.jpg') }}"
                                    alt="IMG">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
