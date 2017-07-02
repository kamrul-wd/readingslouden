<div class="site-content">
    <div class="container">
        {!! $page->content !!}
    </div>
</div>
<div class="jumps bg-white" style="padding-top:0px;">
    <div class="container">
        @foreach ($gallary_main as $gallaryitem)
            <div class="row">
                @foreach($gallaryitem as $gallary)
                    <!-- Jump 1 -->
                    <div class="col-xs-12 col-sm-4 jump">
                        <div class="inner"
                             @if(isset($gallary->featureImage->media->file_type))
                                style="background-image:url('{!! asset(config('app.uploads_url').'/'.$gallary->featureImage->media->file_type.'/thumbnails/'.$gallary->featureImage->media->filename) !!}');"
                             @else
                                 style="background-image:url('{{asset('assets/img/frontend/default.jpg')}}')";
                             @endif
                            >
                            <a href="{{ $rendered_slug .'/'. $gallary->slug }}" class="fire-modal" data-service-id="{{ $gallary->id }}">
                                <h3>{{  $gallary->heading }}</h3>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
</div>


<div class="modal">
    <!-- Modal content -->
    <div class="modal-content container" id="kitchenModal">
    </div>
</div>