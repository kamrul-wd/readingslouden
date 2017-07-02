@extends('layouts.backend.master')

@section('content')

@include('partials.backend.header')

@include('partials.backend.sub_header', ['settings_nav' => true])

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
                    <h6 class="card-subtitle text-muted">Viewing Advanced Site Settings</h6>
                </div>

                {!! Form::open(['route' => ['admin.settings.advanced.update'], 'method' => 'POST']) !!}
                    @include('pages.backend.settings.forms.advanced')

                    <div class="card-block">
                        <div class="form-group">
                            <button type="submit" class="btn btn-pingala">Submit</button>
                        </div><!-- /.form-group -->
                    </div><!-- /.card-block -->
                {!! Form::close() !!}
            </div><!-- /.card -->
        </div><!-- /.col .page-content -->
    </div><!-- /.row -->
</div><!-- /.container-fluid -->
@endsection