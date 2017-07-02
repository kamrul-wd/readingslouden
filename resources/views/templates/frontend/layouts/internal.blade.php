@extends('layouts.frontend.master')
@section($template)
    @if(isset($banners) && $banners)
        {!! $banners !!}
    @endif

    {!! $content !!}
@stop