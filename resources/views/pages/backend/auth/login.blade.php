@extends('layouts.backend.auth')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-10 col-md-8 col-lg-8 offset-sm-1 offset-md-2 offset-lg-2 p-t-3">
            <div class="card" style="border: none;">
                <div class="card-header" style="background-color: #000;">
                    <img src="{{ asset('assets/img/backend/logo@x2.png') }}" height="80">
                </div><!-- /.card-header -->

                {!! Form::open(['route' => 'admin.auth.login', 'method' => 'post']) !!}
                    <div class="card-block" style="background-color: #fff;">
                        <h4 class="card-title">Admin Login</h4>
                        <p class="card-text">Please enter your email and password in the fields below.</p>

                        <hr>

                        <input type="hidden" name="remember" value="1">

                        <fieldset class="form-group{{ ($errors->has('email') ? ' has-danger' : '') }}">
                            {!! Form::label('email', 'Email', ['class' => 'form-control-label']) !!}
                            {!! Form::email('email', null, ['class' => 'form-control']) !!}
                            {!! $errors->first('email', '<span class="text-help">:message</span>') !!}
                        </fieldset><!-- /.form-group -->

                        <fieldset class="form-group{{ ($errors->has('password') ? ' has-danger' : '') }}">
                            {!! Form::label('password', 'Password', ['class' => 'form-control-label']) !!}
                            {!! Form::password('password', ['class' => 'form-control']) !!}
                            {!! $errors->first('password', '<span class="text-help">:message</span>') !!}
                            <br>

                            <small class="text-muted">
                                <a href="{{ route('admin.password.email') }}"><i class="fa fa-question-circle"></i> Need to reset your password?</a>
                            </small><!-- /.text-muted -->
                        </fieldset><!-- /.form-group -->
                    </div><!-- /.card-block -->

                    <div class="card-footer clearfix">
                        {!! Form::button('Login', ['type' => 'submit', 'class' => 'btn btn-pingala pull-right']) !!}
                    </div><!-- /.card-footer -->
                {!! Form::close() !!}
            </div><!-- /.card -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.container -->
@endsection