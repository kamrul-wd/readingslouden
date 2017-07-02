@extends('layouts.backend.master')

@section('content')

@include('partials.backend.header')

@include('partials.backend.sub_header')

<div class="container-fluid">
    <div class="row">
        <div class="sidebar col-xs-12 col-sm-12 col-md-4 col-lg-2">
            @include('partials.backend.side_nav')
        </div><!-- /.sidebar .col -->

        <div class="page-content col-xs-12 col-sm-12 col-md-8 col-lg-10 p-3">
            {!! Breadcrumbs::renderIfExists() !!}

            @include('partials.backend.alerts')

            <div class="card">
                <div class="card-block" style="background: #fff;">
                    <h4>{{ $title }}</h4>

                    <div class="upload-area">
                        <div class="sub-lead">Max size per file: {{ Pingala::bytesToHuman(config()->get('cms.max_upload_size')) }}</div>

                        <form action="{{ route('admin.media.upload') }}" class="dropzone" id="media-dropzone">
                            {{ csrf_field() }}
                        </form>
                    </div><!-- /.upload -->

                    <nav class="navbar navbar-dark bg-inverse">
                        {!! Form::open(['route' => 'admin.media.search', 'method' => 'GET', 'class' => 'form-inline navbar-form']) !!}
                            {!! Form::text('q', null, ['class' => 'form-control', 'placeholder' => 'Search Media']) !!}

                            {!! Form::button('Search', ['type' => 'submit', 'class' => 'btn btn-secondary-outline']) !!}
                        {!! Form::close() !!}
                    </nav><!-- /.navbar -->

                    <ul class="nav nav-tabs mt-3">
                        <li class="nav-item">
                            <a class="nav-link{{ Menu::isActiveRoute('admin.media.index', ' active') }}" href="{{ route('admin.media.index') }}"><i class="fa fa-object-ungroup"></i> Only Presets</a>
                        </li><!-- /.nav-item -->

                        <li class="nav-item">
                            <a class="nav-link{{ Menu::isActiveRoute('admin.media.images', ' active') }}" href="{{ route('admin.media.images') }}"><i class="fa fa-picture-o"></i> Show Images</a>
                        </li><!-- /.nav-item -->

                        <li class="nav-item">
                            <a class="nav-link{{ Menu::isActiveRoute('admin.media.documents', ' active') }}" href="{{ route('admin.media.documents') }}"><i class="fa fa-files-o"></i> Show Documents</a>
                        </li><!-- /.nav-item -->

                        <li class="nav-item">
                            <a class="nav-link{{ Menu::isActiveRoute('admin.media.all', ' active') }}" href="{{ route('admin.media.all') }}"><i class="fa fa-object-group"></i> Show All</a>
                        </li><!-- /.nav-item -->
                    </ul><!-- /.nav nav-tabs -->

                    @if (Menu::areActiveRoutesCheck(['admin.media.images', 'admin.media.all']))
                        <div class="card p-2" style="border-top: none;">
                            <h4 class="">Images</h4>

                            <nav class="nav mb-4" style="">
                                <button type="button" id="delete-image" class="btn btn-danger ml-2"><i class="fa fa-trash-o"></i> Delete Selected</button>
                                <button type="button" id="crop-image" class="btn btn-pingala ml-2" data-toggle="modal" data-target="#cropperPopup"><i class="fa fa-crop"></i> Crop Image</button>
                                <button type="button" id="edit-image" class="btn btn-info ml-2" data-toggle="modal" data-target="#editPopupForImage"><i class="fa fa-pencil"></i> Edit Selected</button>
                            </nav><!-- /.navbar -->

                            {!! Form::open(['route' => 'admin.media.delete', 'method' => 'delete', 'id' => 'delete-form']) !!}
                                <select name="media_files[]" id="image-select" class="image-picker js-masonry" multiple>
                                    @foreach ($images as $image)
                                        <option
                                                data-full-src="{{ asset(config('app.uploads_url').'/'.$image->file_type.'/'.$image->filename) }}"
                                                data-img-id="{{ $image->id }}"
                                                data-img-src="{{ asset(config('app.uploads_url').'/'.$image->file_type.'/thumbnails/'.$image->filename) }}"
                                                data-image-label='{{ $image->label }}'
                                                value="{{ $image->id }}"
                                                data-img-label=""
                                        ></option>
                                    @endforeach
                                </select>
                            {!! Form::close() !!}
                        </div><!-- /.card -->
                    @endif

                    @if (Menu::areActiveRoutesCheck(['admin.media.documents', 'admin.media.all']))
                        <div class="card p-2" style="{{ (Menu::isActiveRouteCheck('admin.media.all') ? '' : 'border-top: none;') }}">
                            <h4 class="">Documents</h4>

                            {!! Form::open(['route' => 'admin.media.delete', 'method' => 'delete']) !!}
                                <div class="card-group">
                                    @foreach ($documents as $file)
                                        <div
                                                class="card thumbnail p-3"
                                                data-full-src="{{ asset(config('app.uploads_url').'/'.$file->file_type.'/'.$file->filename) }}"
                                                data-img-id="{{ $file->id }}"
                                        >
                                            <i class="fa {{ Pingala::extensionToIconClass($file->extension) }}"></i>
                                            <br>
                                            {{ $file->label }} | {{ $file->extension }}
                                            <br>
                                            {{ Pingala::bytesToHuman($file->size) }}
                                            <br>
                                            <a href="{{ asset(config('app.uploads_url').'/'.$file->file_type.'/'.$file->filename) }}" class="btn btn-sm btn-link text-muted"><i class="fa fa-eye" title="View"></i> View / Download</a>
                                            <button type="button" id="edit-media" class="btn btn-sm btn-link text-muted" data-img-id="{{ $file->id }}" data-img-label="{{ $file->label }}" data-toggle="modal" data-target="#editPopupForImage"><i class="fa fa-pencil" title="Edit"></i> Edit</button>
                                            <a href="{{ route('admin.media.destroy', $file->id) }}" data-delete="" data-message="This will permanently delete the document." data-button-text="Yes, delete it" class="btn btn-sm btn-link text-danger delete-file"><i class="fa fa-trash-o" title="Delete"></i> Delete</a>
                                        </div><!-- /.card .thumbnail -->
                                    @endforeach
                                </div><!-- /.card-group -->
                            {!! Form::close() !!}
                        </div><!-- /.card -->
                    @endif

                    @if (Menu::areActiveRoutesCheck(['admin.media.index', 'admin.media.all']))
                        <div class="m-2">
                            <h4 class="">Presets</h4>

                            <a href="{{ route('admin.presets.index') }}" class="btn btn-sm btn-success mb-3">Manage Presets</a>
                        </div>

                        <div class="card accordion-presets p-2" style="{{ (Menu::isActiveRouteCheck('admin.media.all') ? '' : 'border-top: none;') }}" id="accordion" role="tablist" aria-multiselectable="true">
                            @foreach ($presets as $preset)
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="{{ strtolower(str_slug($preset->name)) }}-heading">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#{{ strtolower(str_slug($preset->name)) }}-collapse" aria-expanded="false" aria-controls="{{ strtolower(str_slug($preset->name)) }}">
                                            <h4 class="panel-title">{{ $preset->name }} <span class="text-muted">({{ $preset->width }}x{{ $preset->height }}) - Images: {{ $preset->media->count() }}</span> <i class="accordion-icon fa fa-lg fa-caret-down pull-right"></i></h4>
                                        </a><!-- /.collapsed -->
                                    </div><!-- /.panel-heading -->

                                    <div class="panel-collapse collapse" id="{{ strtolower(str_slug($preset->name)) }}-collapse" role="tabpanel" aria-labelledby="{{ strtolower(str_slug($preset->name)) }}-heading">
                                        <div class="card-group">
                                            @forelse ($preset->media as $file)
                                                <div
                                                        class="card thumbnail p-3"
                                                        style="border: none;"
                                                        data-full-src="{{ asset(config('app.uploads_url').'/'.$file->file_type.'/'.$file->filename) }}"
                                                        data-img-id="{{ $file->id }}"
                                                        data-img-src="{{ asset(config('app.uploads_url').'/'.$file->file_type.'/thumbnails/'.$file->filename) }}"
                                                >
                                                    <img src="{{ asset(config('app.uploads_url').'/'.$file->file_type.'/thumbnails/'.$file->filename) }}">
                                                    <br>
                                                    @if($file->media_preset_id == 2)
                                                        <button type="button" id="view-media" class="btn btn-sm btn-link text-muted" data-img-id="{{ $file->id }}" data-img-label="{{ $file->label }}" data-img-filename="{{ $file->filename }}" data-img-size="{{ Pingala::bytesToHuman($file->size) }}" data-img-dimensions="{{ $file->dimensions }}" data-uploaded-date="{{ $file->created_at->diffForHumans() }} ({{ $file->created_at }})" data-is-banner="true" data-banner-heading="{{ $file->banner[0]->heading }}" data-banner-text="{{ $file->banner[0]->text }}" data-banner-link="{{ $file->banner[0]->link }}" data-toggle="modal" data-target="#viewPopupForImage"><i class="fa fa-eye" title="View"></i> View Info</button>
                                                        <button type="button" id="edit-media" class="btn btn-sm btn-link text-muted" data-img-id="{{ $file->id }}" data-img-label="{{ $file->label }}" data-banner-heading="{{ $file->banner[0]->heading }}" data-banner-text="{{ $file->banner[0]->text }}" data-banner-link="{{ $file->banner[0]->link }}" data-img-preset="{{ $file->media_preset_id }}" data-toggle="modal" data-target="#editPopupForBanner"><i class="fa fa-pencil" title="Edit"></i> Edit Banner</button>
                                                    @else
                                                        <button type="button" id="view-media" class="btn btn-sm btn-link text-muted" data-img-id="{{ $file->id }}" data-img-label="{{ $file->label }}" data-img-filename="{{ $file->filename }}" data-img-size="{{ Pingala::bytesToHuman($file->size) }}" data-img-dimensions="{{ $file->dimensions }}" data-uploaded-date="{{ $file->created_at->diffForHumans() }} ({{ $file->created_at }})" data-toggle="modal" data-target="#viewPopupForImage"><i class="fa fa-eye" title="View"></i> View Info</button>
                                                        <button type="button" id="edit-media" class="btn btn-sm btn-link text-muted" data-img-id="{{ $file->id }}" data-img-label="{{ $file->label }}" data-toggle="modal" data-target="#editPopupForImage"><i class="fa fa-pencil" title="Edit"></i> Edit Image</button>
                                                    @endif

                                                    <a href="{{ route('admin.media.destroy', $file->id) }}" data-delete="" data-message="This will permanently delete the image in this section." data-button-text="Yes, delete it" class="btn btn-sm btn-link text-danger delete-file"><i class="fa fa-trash-o" title="Delete"></i> <span class="">Delete</span></a>
                                                </div><!-- /.card .thumbnail -->
                                            @empty
                                                <div class="alert alert-info" role="alert">
                                                    <strong>Heads up!</strong> There's no images in this preset.
                                                </div><!-- /.alert -->
                                            @endforelse
                                        </div><!-- /.card-group -->
                                    </div><!-- /.panel-collapse -->
                                </div><!-- /.panel -->
                            @endforeach
                        </div><!-- /#accordion -->
                    @endif
                </div><!-- /.card-block -->
            </div><!-- /.card -->
        </div><!-- /.page-content .col -->
    </div><!-- /.row -->
</div><!-- /.container-fluid -->

@if (Menu::areActiveRoutesCheck(['admin.media.images', 'admin.media.all']))
    <div class="modal fade" id="cropperPopup" tabindex="-1" role="dialog" aria-labelledby="cropperPopupLabel" aria-hidden="true">
        <div class="modal-dialog" role="document" style="width: 90%">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="cropperPopupLabel">Crop This Image</h4>
                </div><!-- /.modal-header -->

                <div class="modal-body">
                    {!! Form::open(['route' => 'admin.media.crop', 'method' => 'post', 'id' => 'crop-image-form']) !!}
                        <select name="media_preset_id" id="change-cropper">
                            @foreach ($presets as $preset)
                                <option value="{{ $preset->id }}" data-cropper="{{ $preset->cropper }}" data-width="{{ $preset->width }}" data-height="{{ $preset->height }}">{{ $preset->name }} - {{ $preset->width }}x{{ $preset->height }}</option>
                            @endforeach
                        </select>

                        <div id="crop-img-wrapper"></div>

                        <input type="hidden" id="crop-image-id" name="crop_image_id" value="">

                        <input type="hidden" id="crop-x-axis" name="crop_x_axis" value="">
                        <input type="hidden" id="crop-y-axis" name="crop_y_axis" value="">
                        <input type="hidden" id="crop-width" name="crop_width" value="">
                        <input type="hidden" id="crop-height" name="crop_height" value="">
                    {!! Form::close() !!}
                </div><!-- /.modal-body -->

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="crop-image-button" class="btn btn-primary">Crop Image</button>
                </div><!-- /.modal-footer -->
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal /#cropperPopup -->
@endif

    <div class="modal fade" id="editPopupForBanner" tabindex="-1" role="dialog" aria-labelledby="editPopupLabel" aria-hidden="true">
        <div class="modal-dialog" role="edit">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="editPopupLabel">Edit This Item</h4>
                </div><!-- /.modal-header -->

                <div class="modal-body">
                    {!! Form::open(['route' => ['admin.media.update', 'update'], 'method' => 'PUT', 'id' => 'edit-banner-form']) !!}
                        <input type="hidden" id="edit-banner-id" name="media_id" value="">

                        <input type="hidden" class="form-control" name="preset" id="edit-banner-preset" value="">

                        <div class="form-group">
                            <label for="edit-banner-label" class="form-control-label">Image Label</label>
                            <input type="text" class="form-control" name="label" id="edit-banner-label" value="">
                        </div><!-- /.form-group -->

                        <div class="form-group">
                            <label for="edit-banner-heading" class="form-control-label">Banner Heading</label>
                            <input type="text" class="form-control" name="heading" id="edit-banner-heading" value="">
                        </div><!-- /.form-group -->

                        <div class="form-group">
                            <label for="edit-banner-text" class="form-control-label">Banner Text</label>
                            <input type="text" class="form-control" name="text" id="edit-banner-text" value="">
                        </div><!-- /.form-group -->

                        <div class="form-group">
                            <label for="edit-banner-link" class="form-control-label">Banner Link</label>
                            <input type="text" class="form-control" name="link" id="edit-banner-link" value="">
                        </div><!-- /.form-group -->
                    {!! Form::close() !!}
                </div><!-- /.modal-body -->

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="edit-banner-button" class="btn btn-pingala">Submit</button>
                </div><!-- /.modal-footer -->
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal /#editPopup -->

    <div class="modal fade" id="editPopupForImage" tabindex="-1" role="dialog" aria-labelledby="editPopupLabel" aria-hidden="true">
        <div class="modal-dialog" role="edit">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="editPopupLabel">Edit This Item</h4>
                </div><!-- /.modal-header -->

                <div class="modal-body">
                    {!! Form::open(['route' => ['admin.media.update', 'update'], 'method' => 'PUT', 'id' => 'edit-media-form']) !!}
                    <div id="edit-img-wrapper"><hr></div>

                    <input type="hidden" id="edit-media-id" name="media_id" value="">

                    <fieldset class="form-group">
                        <label for="edit-image-label" class="form-control-label">Item Label</label>
                        <input type="text" class="form-control" name="label" id="edit-media-label" value="">
                    </fieldset><!-- /.form-group -->
                    {!! Form::close() !!}
                </div><!-- /.modal-body -->

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="edit-media-button" class="btn btn-pingala">Submit</button>
                </div><!-- /.modal-footer -->
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal /#editPopupForImage -->

    <div class="modal fade" id="viewPopupForImage" tabindex="-1" role="dialog" aria-labelledby="viewPopupLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="viewPopupLabel">View Item</h4>
                </div><!-- /.modal-header -->

                <div class="modal-body">
                    <div id="view-img-wrapper"></div>
                    <div id="view-img-label"></div>
                    <div id="view-img-filename"></div>
                    <div id="view-img-size"></div>
                    <div id="view-img-dimensions"></div>
                    <div id="view-uploaded-date"></div>

                    <div id="view-banner-heading"></div>
                    <div id="view-banner-text"></div>
                    <div id="view-banner-link"></div>
                    <hr>
                    <input type="hidden" id="view-media-id" name="media_id" value="">
                </div><!-- /.modal-body -->

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div><!-- /.modal-footer -->
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal /#viewPopupForImage -->
@endsection