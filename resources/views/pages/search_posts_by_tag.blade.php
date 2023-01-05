@extends('layouts.app_layout.app_layout')

@section('header')
    <style>
        .img-format {
            aspect-ratio: 4/3;
            object-fit: cover;
        }
    </style>
@endsection

@section('content')
    <section class="bg0 p-t-70">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-8">
                    <div class="p-b-20">

                        <!-- Posts Container -->
                        <div class="p-b-25 p-r-10 p-r-0-sr991">
                            <div class="how2 how2-cl3 flex-s-c">
                                <h3 class="f1-m-2 cl14 tab01-title">
                                    {{ $title }}
                                    @if (count($posts))
                                        ({{ count($posts) }})
                                    @endif
                                </h3>
                            </div>
                            {{-- Posts --}}
                            <div class="row p-t-35">
                                @if (!count($posts))
                                    <div class="col p-r-25 p-r-15-sr991">
                                        <div class="text-center">Không tìm thấy kết quả</div>
                                    </div>
                                @endif
                                <!-- Item -->
                                @foreach ($posts as $item)
                                    <div class="col-sm-6 p-r-25 p-r-15-sr991">
                                        <div class="m-b-45">
                                            <a href="{{ route('post') }}?id={{ $item->id }}"
                                                class="wrap-pic-w hov1 trans-03">
                                                <img class="img-format" src="{{ $item->thumbnail }}" alt="IMG">
                                            </a>

                                            <div class="p-t-16">
                                                <h5 class="p-b-5">
                                                    <a href="{{ route('post') }}?id={{ $item->id }}"
                                                        class="f1-m-3 cl2 hov-cl10 trans-03">
                                                        {{ $item->title }}
                                                    </a>
                                                </h5>

                                                <span class="cl8">
                                                    <span class="f1-s-4 cl8 hov-cl10 trans-03">
                                                        Tác giả: {{ $item->author()->first()->name }}
                                                        </>

                                                        <span class="f1-s-3 m-rl-3">
                                                            -
                                                        </span>

                                                        <span class="f1-s-3">
                                                            {{ diffInTime($item->created_at) }}
                                                        </span>
                                                    </span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>

                @include('layouts.app_layout.app_sidebar')
            </div>
        </div>
    </section>
@endsection
