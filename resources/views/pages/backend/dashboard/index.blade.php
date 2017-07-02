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
                    <h6 class="card-subtitle text-muted">Pingala Media CMS</h6>
                </div><!-- /.card-block -->

                <div class="card-block">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-8">
                            @forelse($cards as $card)
                                <div class="card card-inverse " style="background-image: url('{{$card->image}}'); border-color: #fff;">
                                    <div class="card-block card-overlay">
                                        <h3 class="card-title">{{ $card->heading }}</h3>
                                        <p class="card-text">{{ $card->text }}</p>
                                        <a href="{{ $card->button_link }}" target="_blank" class="btn btn-secondary-outline">{{ $card->button_text }}</a>
                                    </div><!-- /.card-block -->
                                </div><!-- /.card -->
                            @empty
                            @endforelse
                        </div><!-- /.col -->

                        <div class="col-sm-12 col-md-12 col-lg-4">
                            <div class="support">
                                <h3 class="lead">Need Help?</h3>

                                {!! Form::open(['route' => 'admin.contact.post', 'method' => 'post']) !!}
                                    <fieldset class="form-group">
                                        {!! Form::label('message', 'Message') !!}
                                        {!! Form::textarea('message', null, ['class' => 'form-control', 'id' => 'message', 'placeholder' => 'Please enter your message here. If it\'s an issue, please explain in as much detail as possible']) !!}
                                    </fieldset><!-- /.form-group -->

                                    {!! Form::button('Send Message', ['type' => 'submit', 'class' => 'btn btn-outline-primary btn-block']) !!}
                                {!! Form::close() !!}
                            </div><!-- /.support -->
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.card-block -->
            </div><!-- /.card -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.container-fluid -->

@endsection