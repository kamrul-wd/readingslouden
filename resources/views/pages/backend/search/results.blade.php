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

                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-8">
                        <div class="card" style="background-color: #fff;">
                            <div class="card-block">
                                <h4 class="card-title">{{ $title }}</h4>
                                <h6 class="card-subtitle text-muted">Showing results of "{{ $search_term }}"</h6>
                            </div><!-- /.card-block -->

                            @foreach($results as $page)
                                <div class="card-block">
                                    <h4 class="card-title">{{ $page->heading }}</h4>
                                    <div class="card-subtitle text-muted">{{ str_limit(strip_tags($page->content), 200) }}</div>
                                </div><!-- /.card-block -->

                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">URL: <span class="label label-success">{{ $page->rendered_slug }}</span></li>
                                    <li class="list-group-item">Images: {{ $page->images->count() }}</li>
                                    <li class="list-group-item">Banners: {{ $page->banners->count() }}</li>
                                </ul><!-- /.list-group -->

                                <div class="card-block">
                                    <a href="{{ route('admin.pages.edit', $page->id) }}" class="card-link">Edit Page</a>
                                    @if($page->active)
                                        <a href="{{ $page->rendered_slug }}" class="card-link">Visit Page</a>
                                    @else
                                        <span class="card-link">Page Not Active</span>
                                    @endif
                                </div><!-- /.card-block -->
                            @endforeach
                        </div><!-- /.card -->
                    </div><!-- /.col -->

                    <div class="col-sm-12 col-md-12 col-lg-4">
                        <div class="card" style="background-color: #fff;">
                            <div class="card-block">
                                <h4 class="card-title">{{ $title }}</h4>
                                <h6 class="card-subtitle text-muted">Showing results of "{{ $search_term }}"</h6>
                            </div><!-- /.card-block -->

                            <div class="card-block">
                                <h4>List of Pages Found</h4>

                                <ul class="list-group">
                                    @foreach($results as $page)
                                        <li class="list-group-item">
                                            <a href="{{ route('admin.pages.edit', $page->id) }}" class="label label-success pull-xs-right m-l-1">Edit</a>
                                            <a href="{{ $page->rendered_slug }}" class="label label-default pull-xs-right">View</a>
                                            {{ $page->heading }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div><!-- /.card-block -->
                        </div><!-- /.card -->
                    </div><!-- /.col -->

                    {!! (new App\Pagination($results_pagination))->render() !!}
                </div><!-- /.row -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
@endsection