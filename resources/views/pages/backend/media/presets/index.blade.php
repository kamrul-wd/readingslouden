@extends('layouts.backend.master')

@section('content')

    @include('partials.backend.header')

    @include('partials.backend.sub_header', ['controls_nav' => true])

    <div class="container-fluid">
        <div class="row">
            <div class="sidebar col-xs-12 col-sm-12 col-md-4 col-lg-2">
                @include('partials.backend.side_nav')
            </div><!-- /.sidebar .col -->

            <div class="page-content col-xs-12 col-sm-12 col-md-8 col-lg-10 p-3">
                {!! Breadcrumbs::renderIfExists() !!}

                @include('partials.backend.alerts')

                <div class="card" style="background-color: #fff;">
                    <div class="card-block">
                        <h4 class="card-title">{{ $title }}</h4>
                        <h6 class="card-subtitle text-muted">Presets For Media Cropping</h6>
                    </div>

                    <table class="table table-striped" id="page-table" style="margin-bottom: 0;">
                        <tbody>
                        @foreach($presets as $preset)
                            <tr>
                                <td>{{ $preset->name }} - <small class="text-muted">{{ $preset->width }}x{{ $preset->height }}</small></td>
                                <td class="pull-right">
                                    <a href="{{ route('admin.presets.show', $preset->id) }}" class="btn btn-link btn-sm text-muted"><i class="fa fa-picture-o" title="View Images"></i> <span class="hidden-md-down">View Images ({{ $preset->media->count() }})</span></a>
                                    <a href="{{ route('admin.presets.edit', $preset->id) }}" class="btn btn-link btn-sm text-muted"><i class="fa fa-pencil" title="Edit Preset"></i> <span class="hidden-md-down">Edit</span></a>
                                    |
                                    <a href="{{ route('admin.presets.destroy', $preset->id) }}" data-delete="" data-message="This will delete the preset and all images currently cropped in it." data-button-text="Yes, delete it" class="btn btn-sm btn-link text-danger delete-preset"><i class="fa fa-trash-o" title="Delete Preset"></i> <span class="hidden-md-down">Delete</span></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table><!-- /.table /#page-table -->
                </div><!-- /.card -->
            </div><!-- /.col .page-content -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
@endsection