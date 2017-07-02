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
                        @foreach($preset->media as $image)
                            <tr>
                                <td>
                                    <img src="{{ asset(config('app.uploads_url').'/'.$image->file_type.'/thumbnails/'.$image->filename) }}">
                                    {{ $image->label }} - <small class="text-muted">{{ $image->filename }}</small>
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