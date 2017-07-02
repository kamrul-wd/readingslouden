<input name="banner_order" id="banner_sort_order" type="hidden" value="{{ (isset($banner_order) ? $banner_order : '') }}">

<div class="selected-media row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
        <h4 class="lead">Available Banners</h4>

        <ul id="banner_sort_source" class="droppable">
            @foreach ($available_banners as $banner)
                <li data-id="{{ $banner->id }}">
                    <img src="{{ asset(config('app.uploads_url').'/'.$banner->media->file_type.'/thumbnails/'.$banner->media->filename) }}">
                </li>
            @endforeach
        </ul><!-- /#sort_source .droppable -->
    </div><!-- /.col -->

    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
        <h4 class="lead">Enabled Banners</h4>

        <ul id="banner_sort_dest" class="droppable">
            @foreach ($selected_banners as $banner)
                <li data-id="{{ $banner->banners->id }}">
                    <img src="{{ asset(config('app.uploads_url').'/'.$banner->banners->media->file_type.'/thumbnails/'.$banner->banners->media->filename) }}">
                </li>
            @endforeach
        </ul>
    </div><!-- /.col -->
</div><!-- /.row -->
