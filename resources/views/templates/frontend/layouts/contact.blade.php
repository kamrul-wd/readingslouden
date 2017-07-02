@extends('layouts.frontend.master')

@section($template)
    @if(isset($banners) && $banners)
        {!! $banners !!}
    @endif

    <div class="content">
        @if(isset($side_nav))
            <div class="col-4">
                <div id="leftside">
                    {!! $side_nav !!}
                </div><!-- /#leftside -->
            </div><!-- /.col-4 -->

            <div class="col-6">

            </div><!-- /.col-6 -->
        @else
            <div class="col-12">
                {!! $content !!}
            </div><!-- /.col-9 -->
        @endif
    </div><!-- /.container -->
@stop