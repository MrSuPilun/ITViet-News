@if (!request()->is('user*'))
    <div class="container">
        <div class="bg0 flex-wr-sb-c p-rl-20 p-tb-8">
            <div class="f2-s-1 p-r-30 size-w-0 m-tb-6 flex-wr-s-c">
                @isset($posts)
                    <span class="text-uppercase cl2 p-r-8">
                        Bài viết nổi bật:
                    </span>

                    <span class="dis-inline-block cl6 slide100-txt pos-relative size-w-0" data-in="fadeInDown"
                        data-out="fadeOutDown">
                        @foreach ($posts as $item)
                            <span class="dis-inline-block slide100-txt-item animated visible-false">
                                <a style="color: #666;"
                                    href="{{ route('post', ['id' => $item->id]) }}">{{ $item->title }}</a>
                            </span>
                        @endforeach
                    </span>
                @endisset
            </div>

            <form action="{{ route('searchPostAndTag') }}" method="get">
                <div class="pos-relative size-a-2 bo-1-rad-22 of-hidden bocl11 m-tb-6">
                    <input class="f1-s-1 cl6 plh9 s-full p-l-25 p-r-45" type="text" name="search"
                        placeholder="Tìm kiếm">
                    <button type="submit" class="flex-c-c size-a-1 ab-t-r fs-20 cl2 hov-cl10 trans-03">
                        <i class="zmdi zmdi-search"></i>
                    </button>
                </div>
            </form>

        </div>
    </div>
@endif
