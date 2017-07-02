@extends('layouts.backend.auth')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-10 col-md-8 col-lg-8 col-sm-offset-1 col-md-offset-2 col-lg-offset-2 p-t-3">
            <div class="card" style="border: none;">
                <div class="card-header" style="background-color: #000;">
                    <a href="{{ route('index') }}"><img src="{{ asset('assets/img/backend/logo@x2.png') }}" height="80"></a>
                </div><!-- /.card-header -->

                {!! Form::open(['route' => 'admin.password.email', 'method' => 'post']) !!}
                    <div class="card-block" style="background-color: #fff;">
                        @include('partials.backend.alerts')

                        <h4 class="card-title">Admin Password Reset</h4>
                        <p class="card-text">Please enter your email below to reset your password.</p>

                        <hr>

                        <fieldset class="form-group{{ ($errors->has('email') ? ' has-danger' : '') }}">
                            {!! Form::label('email', 'Email', ['class' => 'form-control-label']) !!}

                            {!! Form::email('email', null, ['class' => 'form-control']) !!}
                            {!! $errors->first('email', '<span class="text-help">:message</span>') !!}
                        </fieldset><!-- /.form-group -->
                    </div><!-- /.card-block -->

                    <div class="card-footer text-muted">
                        {!! Form::button('Submit', ['type' => 'submit', 'class' => 'btn btn-pingala pull-right']) !!}
                        <a class="btn btn-secondary" href="{{ route('admin.auth.login') }}"><i class="fa fa-arrow-left"></i> Back to Login</a>
                    </div><!-- /.card-footer .text-muted -->
                {!! Form::close() !!}
            </div><!-- /.card -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.container -->
@endsection