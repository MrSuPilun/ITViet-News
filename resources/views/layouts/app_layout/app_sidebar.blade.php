<div class="col-md-10 col-lg-4 p-b-30">
    <div
        class="p-l-10 p-rl-0-sr991 @if (request()->is('p*')) p-t-33 @endif @if (request()->is('/')) p-b-20 @endif">
        <!-- Most Popular -->
        <div class="p-b-30">
            <div class="how2 how2-cl4 flex-s-c">
                <h3 class="f1-m-2 cl3 tab01-title">
                    Bài viết nhiều lượt xem nhất
                </h3>
            </div>

            <ul class="p-t-35">
                @foreach (getTopPosts(5) as $item)
                    <li class="flex-wr-sb-s p-b-22">
                        <div class="size-a-8 flex-c-c borad-3 size-a-8 bg9 f1-m-4 cl0 m-b-6">
                            {{ $loop->iteration }}
                        </div>

                        <a href="{{ route('post', ['id' => $item->id]) }}" class="size-w-3 f1-s-7 cl3 hov-cl10 trans-03">
                            {{ $item->title }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        <!--  -->
        <div class="flex-c-s p-t-8 p-b-65">
            <a href="#">
                <img class="max-w-full" src="{{ asset('assets/app/images/banner-02.jpg') }}" alt="IMG">
            </a>
        </div>

        {{-- <!-- Video -->
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
        </div> --}}

        <!-- Tag -->
        @isset($hotTags)
            <div class="p-b-55">
                <div class="how2 how2-cl4 flex-s-c m-b-30">
                    <h3 class="f1-m-2 cl3 tab01-title">
                        Truy Cập Nhiều Nhất
                    </h3>
                </div>
                <div class="flex-wr-s-s m-rl--5">
                    @foreach ($hotTags as $item)
                        <a href="{{ route('searchPostsByTag', ['t' => $item->tag->title]) }}"
                            class="flex-c-c size-h-2 bo-1-rad-20 bocl12 f1-s-1 cl8 hov-btn2 trans-03 p-rl-20 p-tb-5 m-all-5">
                            {{ $item->tag->title }}
                        </a>
                    @endforeach
                </div>
            </div>
        @endisset
    </div>
</div>
