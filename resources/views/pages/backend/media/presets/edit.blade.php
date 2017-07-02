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
                    {!! Form::open(['route' => ['admin.presets.update', $preset->id], 'method' => 'PUT']) !!}
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade show active" id="page-content-tab">
                            <div class="card-block">
                                <h4 class="card-title">{{ $preset->name }}</h4>
                                <h6 class="card-subtitle text-muted">Edit Preset</h6>
                            </div><!-- /.card-block -->

                            <div class="card-block">
                                <div class="form-group{{ ($errors->has('name') ? ' has-danger' : '') }}">
                                    {!! Form::label('name', 'Name', ['class' => 'form-control-label']) !!}

                                    {!! Form::text('name', (isset($preset->name) ? $preset->name : null), ['class' => 'form-control', 'placeholder' => 'Name for the preset']) !!}
                                    {!! $errors->first('name', '<div class="text-help">:message</div>') !!}
                                </div><!-- /.form-group -->

                                <div class="form-group{{ ($errors->has('width') ? ' has-danger' : '') }}">
                                    {!! Form::label('width', 'Width', ['class' => 'form-control-label']) !!}

                                    {!! Form::number('width', (isset($preset->width) ? $preset->width : null), ['class' => 'form-control', 'placeholder' => 'Width for the image']) !!}
                                    {!! $errors->first('width', '<div class="text-help">:message</div>') !!}
                                </div><!-- /.form-group -->

                                <div class="form-group{{ ($errors->has('height') ? ' has-danger' : '') }}">
                                    {!! Form::label('height', 'Height', ['class' => 'form-control-label']) !!}

                                    {!! Form::number('height', (isset($preset->height) ? $preset->height : null), ['class' => 'form-control', 'placeholder' => 'Height for the image']) !!}
                                    {!! $errors->first('height', '<div class="text-help">:message</div>') !!}
                                </div><!-- /.form-group -->
                            </div><!-- /.card-block -->
                        </div><!-- /#page-content-tab -->
                    </div><!-- /.tab-content -->

                    <div class="card-block">
                        <div class="form-group">
                            <button type="submit" class="btn btn-pingala">Submit</button>
                        </div><!-- /.form-group -->
                    </div><!-- /.card-block -->
                    {!! Form::close() !!}
                </div><!-- /.card -->
            </div><!-- /.page-content .col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
@endsection