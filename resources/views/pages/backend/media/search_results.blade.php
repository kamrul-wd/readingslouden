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

                <div class="card" style="background-color: #fff;">
                    <nav class="navbar navbar-dark bg-inverse">
                        {!! Form::open(['route' => 'admin.media.search', 'method' => 'GET', 'class' => 'form-inline navbar-form']) !!}
                            {!! Form::text('q', $search_term, ['class' => 'form-control', 'placeholder' => 'Search Media']) !!}

                            {!! Form::button('Search', ['type' => 'submit', 'class' => 'btn btn-secondary-outline']) !!}
                        {!! Form::close() !!}
                    </nav><!-- /.navbar -->

                    <div class="card-block">
                        <h4 class="card-title">{{ $title }}</h4>
                        <h6 class="card-subtitle text-muted">Showing results of "{{ $search_term }}"</h6>
                    </div><!-- /.card-block -->

                    @foreach($results as $media)
                        <div class="card-block">
                            <div class="lead">{{ $media->label }}</div>
                            <h6 class="">Full Path: /{{ config('app.uploads_url').'/'.$media->file_type.'/'.$media->filename }}</h6>
                            <h6 class="">Thumbnail Path: /{{ config('app.uploads_url').'/'.$media->file_type.'/thumbnails/'.$media->filename }}</h6>
                        </div><!-- /.card-block -->

                        <div class="card-block">
                            @if($media->file_type == 'images')
                                <img src="{{ asset(config('app.uploads_url').'/'.$media->file_type.'/thumbnails/'.$media->filename) }}" height="200">
                            @else
                                <i class="fa {{ Pingala::extensionToIconClass($media->extension) }} fa-3x"></i> <kbd>/{{ config('app.uploads_url').'/'.$media->file_type.'/'.$media->filename }}</kbd>
                            @endif
                        </div><!-- /.card-block -->
                    @endforeach
                </div><!-- /.card -->

                {!! (new App\Pagination($results_pagination))->render() !!}
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
@endsection