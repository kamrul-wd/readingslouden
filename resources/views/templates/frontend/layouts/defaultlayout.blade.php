@extends('layouts.frontend.master')
@section($template)
    @if(isset($banners) && $banners)
        {!! $banners !!}
    @endif

    <!-- Content -->
    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    {!! $content !!}
                </div>
            </div>
        </div>
    </section>


@stop