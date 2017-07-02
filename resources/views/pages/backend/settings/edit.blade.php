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
                <div class="card-block">
                    <h4 class="card-title">{{ $title }}</h4>
                    <h6 class="card-subtitle text-muted">Modify Setting</h6>
                </div>

                {!! Form::open(['route' => ['admin.settings.update', $setting->id], 'method' => 'PUT']) !!}
                    @include('pages.backend.settings.forms.general')

                    <div class="card-block">
                        <div class="form-group">
                            <a href="{{ route('admin.settings.index') }}" class="btn btn-secondary">Go Back</a>
                            <button type="submit" class="btn btn-pingala">Submit</button>
                        </div><!-- /.form-group -->
                    </div><!-- /.card-block -->
                {!! Form::close() !!}
            </div><!-- /.card -->
        </div><!-- /.col .page-content -->
    </div><!-- /.row -->
</div><!-- /.container-fluid -->
@endsection