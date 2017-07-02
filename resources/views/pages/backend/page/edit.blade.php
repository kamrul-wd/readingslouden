@extends('layouts.backend.master')

@section('content')

@include('partials.backend.header')

@include('partials.backend.sub_header', ['option_nav' => true])

<div class="container-fluid">
    <div class="row">
        <div class="sidebar col-xs-12 col-sm-12 col-md-4 col-lg-2">
            @include('partials.backend.side_nav')
        </div><!-- /.sidebar .col -->

        <div class="page-content col-xs-12 col-sm-12 col-md-8 col-lg-10 p-3">
            {!! Breadcrumbs::renderIfExists() !!}

            @include('partials.backend.alerts')

            <div class="card" style="background-color: #fff;">
                {!! Form::open(['route' => ['admin.pages.update', $page->id], 'method' => 'PUT','id' =>'submit-form-page']) !!}
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade show active" id="page-content-tab">
                            <div class="card-block">
                                <h4 class="card-title">{{ $page->heading }}</h4>
                                <h6 class="card-subtitle text-muted">Edit Page</h6>
                            </div><!-- /.card-block -->

                            @include('pages.backend.page.forms.page_content')
                        </div><!-- /#page-content-tab -->

                        <div role="tabpanel" class="tab-pane fade" id="media-tab">
                            <div class="card-block">
                                <h4 class="card-title">Images</h4>
                                <h6 class="card-subtitle text-muted">Images attached on the page</h6>
                            </div><!-- /.card-block -->

                            @include('pages.backend.page.forms.images')
                        </div><!-- /#media-tab -->

                        <div role="tabpanel" class="tab-pane fade" id="documents-tab">
                            <div class="card-block">
                                <h4 class="card-title">Documents</h4>
                                <h6 class="card-subtitle text-muted">Documents for this page</h6>
                            </div><!-- /.card-block -->

                            @include('pages.backend.page.forms.documents')
                        </div><!-- /#documents-tab -->

                        <div role="tabpanel" class="tab-pane fade" id="banners-tab">
                            <div class="card-block">
                                <h4 class="card-title">Banners</h4>
                                <h6 class="card-subtitle text-muted">Banners for this page</h6>
                            </div><!-- /.card-block -->

                            @include('pages.backend.page.forms.banners')
                        </div><!-- /#banners-tab -->

                        <div role="tabpanel" class="tab-pane fade" id="seo-tab">
                            <div class="card-block">
                                <h4 class="card-title">SEO</h4>
                                <h6 class="card-subtitle text-muted">Options to help you optimise your website</h6>
                            </div><!-- /.card-block -->

                            @include('pages.backend.page.forms.seo')
                        </div><!-- /#seo-tab -->

                        @if(auth()->user()->containsRoles('master'))
                            <div role="tabpanel" class="tab-pane fade" id="admin-tab">
                                <div class="card-block">
                                    <h4 class="card-title">Admin</h4>
                                    <h6 class="card-subtitle text-muted">Secure admin section</h6>
                                </div><!-- /.card-block -->
                                @include('pages.backend.page.forms.admin')
                            </div><!-- /#admin-tab -->
                        @endif
                    </div><!-- /.tab-content -->

                    <div class="card-block">
                        <div class="form-group{{ ($errors->has('active') ? ' has-danger' : '') }}">
                            <label class="c-input c-checkbox">
                                {!! Form::checkbox('active', 1, (isset($page->active) ? $page->active : null)) !!}
                                <span class="c-indicator"></span>
                                Active
                            </label>
                            {!! $errors->first('active', '<div class="text-help">:message</div>') !!}
                        </div><!-- /.form-group -->

                        @if(isset($page->depth) && $page->depth < 3)
                            <div class="form-group{{ ($errors->has('on_main_nav') ? ' has-danger' : '') }}">
                                <label class="c-input c-checkbox">
                                    {!! Form::checkbox('on_main_nav', 1, (isset($page->on_main_nav) ? $page->on_main_nav : null)) !!}
                                    <span class="c-indicator"></span>
                                    Show on Main Navigation
                                </label>
                                {!! $errors->first('on_main_nav', '<div class="text-help">:message</div>') !!}
                            </div><!-- /.form-group -->
                        @endif
                    </div>

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