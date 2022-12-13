<section class="bg0">
    <div class="container">
        <div class="row m-rl--1">
            @foreach ($feature as $item)
                <div class="col-sm-6 col-lg-4 p-rl-1 p-b-2">
                    <div class="bg-img1 size-a-12 how1 pos-relative"
                        style="background-image: url({{ asset('public/Image/' . $item->image) }});">
                        <a href="blog-detail-01.html" class="dis-block how1-child1 trans-03"></a>

                        <div class="flex-col-e-s s-full p-rl-25 p-tb-11">
                            <a href="#"
                                class="dis-block how1-child2 f1-s-2 cl0 bo-all-1 bocl0 hov-btn1 trans-03 p-rl-5 p-t-2">
                                Life Style
                            </a>

                            <h3 class="how1-child2 m-t-10">
                                <a href="blog-detail-01.html" class="f1-m-1 cl0 hov-cl10 trans-03">
                                    {{ $item->title }}
                                </a>
                            </h3>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
