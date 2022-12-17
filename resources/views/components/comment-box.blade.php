<div class="bg-white p-2">
    <div class="d-flex flex-row user-info">
        <div>
            <img class="rounded-circle" src="{{ $item->user()->avatar }}" width="40">
        </div>
        <div class="d-flex flex-column justify-content-start ml-2 w-100">
            <p class="d-block font-weight-bold name">{{ $item->user()->name }}</p>
            <p class="date text-black-50">{{ $item->created_at }}</p>
            <div class="mt-2">
                <p class="comment-text">
                    @if ($level >= 3)
                        <b class="text-primary">{{ '@' . $item->getUserComment()->first()->name }}</b>
                    @endif
                    {{ $item->content }}
                    </b>
            </div>
            <div class="bg-white">
                <div class="d-flex flex-row fs-12">
                    <div class="like pr-2 pt-2 pb-2 cursor">
                        <i class="fa fa-thumbs-up"></i>
                        <span class="ml-1">{{ $item->like }} Thích</span>
                    </div>
                    <div class="like p-2 cursor reply-btn" data-reply-id="{{ $item->id }}">
                        <i class="fa fa-comment"></i>
                        <span class="ml-1">Trả lời</span>
                    </div>
                </div>
            </div>
            @if ($level < 3)
                @foreach ($item->getChildren()->get() as $i)
                    <x-comment-box :item="$i" :level="$level" />
                @endforeach
            @endif
        </div>
    </div>
</div>
@if ($level >= 3)
    @foreach ($item->getChildren()->get() as $i)
        <x-comment-box :item="$i" :level="$level" />
    @endforeach
@endif
