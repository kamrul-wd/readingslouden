<input name="document_order" id="document_sort_order" type="hidden" value="{{ (isset($document_order) ? $document_order : '') }}">

<div class="selected-media row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
        <h4 class="lead">Available Documents</h4>

        <ul id="document_sort_source" class="droppable">
            @foreach ($available_documents as $document)
                <li data-id="{{ $document->id }}">
                    <i class="fa {{ Pingala::extensionToIconClass($document->extension) }}"></i> {{ $document->label }}
                </li>
            @endforeach
        </ul><!-- /#document_sort_source .droppable -->
    </div><!-- /.col -->

    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
        <h4 class="lead">Enabled Documents</h4>

        <ul id="document_sort_dest" class="droppable">
            @foreach ($selected_documents as $document)
                <li data-id="{{ $document->media_id }}">
                    <i class="fa {{ Pingala::extensionToIconClass($document->media->extension) }}"></i> {{ $document->media->label }}
                </li>
            @endforeach
        </ul><!-- /#document_sort_dest .droppable -->
    </div><!-- /.col -->
</div><!-- /.row -->
