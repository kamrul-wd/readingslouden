@extends('layouts.frontend.master')

@section($template)
    @if(isset($banners) && $banners)
        <div class="row" style="padding-top: 0;">
            <div class="container">
                {!! $banners !!}
            </div><!-- /.container -->
        </div><!-- /.row -->
    @endif

    <div class="row">
        <div class="container">
            @if(isset($side_nav))
                <div class="col-4">
                    <div id="leftside">
                        {!! $side_nav !!}
                    </div><!-- /#leftside -->
                </div><!-- /.col-4 -->

                <div class="col-6">
                    {!! $content !!}
                </div><!-- /.col-6 -->
            @else
                <div class="col-9">
                    {!! $content !!}
                </div><!-- /.col-9 -->
            @endif
        </div><!-- /.container -->
    </div><!-- /.row -->
@stop