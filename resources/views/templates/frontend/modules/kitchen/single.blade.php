<div class="inner">
    <span class="close">&times;</span>
    <div class="js-carousel-1 owl-carousel owl-theme">
        @if(count($page->images) > 0)
            @foreach ($page->images as $image)
                <div class="item" style="background-image:url('{{ asset(config('app.uploads_url').'/'.$image->file_type.'/'.$image->filename) }}')"></div>
            @endforeach
        @else
            <div class="item" style="background-image:url('{{ asset('assets/img/frontend/default.jpg') }}')"></div>
        @endif
    </div>

    <div class="js-carousel-2 owl-carousel owl-theme">
        @if(count($page->images) > 0)
            @foreach ($page->images as $image)
                <div class="item" style="background-image:url('{{ asset(config('app.uploads_url').'/'.$image->file_type.'/thumbnails/'.$image->filename) }}')"></div>
            @endforeach
        @else
            <div class="item" style="background-image:url('{{ asset('assets/img/frontend/default.jpg') }}')"></div>
        @endif
    </div>

    <div class="modal-text">
        <h2>{{ $page->heading }}</h2>
        {!! $page->content !!}
    </div>
</div>
