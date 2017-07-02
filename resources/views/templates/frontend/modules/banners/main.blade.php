<!-- Carousel -->
<section class="carousel-container">
    <div id="heroCarousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner" role="listbox">
            <!-- Slide 1 -->
            @foreach($banners as $key => $banner)
                <div class="carousel-item @if($key == 0) active @endif" style="background-image: url('/uploads/images/{{ $banner->banners->media->filename }}');">

                </div>
            @endforeach
        </div>
    </div>
</section>