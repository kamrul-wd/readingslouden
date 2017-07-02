<input name="image_order" id="image_sort_order" type="hidden" value="{{ (isset($image_order) ? $image_order : '') }}">

<div class="selected-media row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
        <h4 class="lead">Available Images</h4>

        <ul id="image_sort_source" class="droppable">
            @foreach ($available_images as $image)
                <li data-id="{{ $image->id }}">
                    <img src="{{ asset(config('app.uploads_url').'/'.$image->file_type.'/thumbnails/'.$image->filename) }}">
                </li>
            @endforeach
        </ul><!-- /#image_sort_source .droppable -->
    </div><!-- /.col -->

    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
        <h4 class="lead">Enabled Images</h4>

        <ul id="image_sort_dest" class="droppable">
            @foreach ($selected_images as $image)
                <li data-id="{{ $image->media_id }}">
                    <img src="{{ asset(config('app.uploads_url').'/'.$image->media->file_type.'/thumbnails/'.$image->media->filename) }}">
                </li>
            @endforeach
        </ul><!-- /#image_sort_dest .droppable -->
    </div><!-- /.col -->
</div><!-- /.row -->
