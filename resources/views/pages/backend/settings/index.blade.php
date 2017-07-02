@extends('layouts.backend.master')

@section('content')

@include('partials.backend.header')

@include('partials.backend.sub_header', ['settings_nav' => true])

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
                    <div class="row">
                        <div class="col-lg-6">
                            <h4 class="card-title">{{ $title }}</h4>
                            <h6 class="card-subtitle text-muted">Viewing General Site Settings</h6>
                        </div><!-- /.col -->

                        <div class="col-lg-6">
                            <span class="pull-right"><a href="{{ route('admin.settings.create') }}" class="text-muted"><i class="fa fa-plus-circle"></i> Add Setting</a></span>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.card-block -->

                <div class="table-responsive">
                    <table class="table table-striped" id="settings-table" style="margin-bottom: 0;">
                        <thead>
                            <tr>
                                <th>Label</th>
                                <th>Name</th>
                                <th>Value</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($settings as $setting)
                                <tr>
                                    <td>{{ $setting->label }}</td>
                                    <td>{{ $setting->name }}</td>
                                    <td>{{ $setting->value }}</td>
                                    <td class="pull-right">
                                        <a href="{{ route('admin.settings.edit', $setting->id) }}" class="btn btn-link btn-sm text-muted"><i class="fa fa-pencil"></i> <span class="hidden-md-down">Edit</span></a>
                                        |
                                        @if($setting->protected)
                                            <span class="btn btn-sm btn-link text-danger" data-toggle="tooltip" data-placement="left" title="This setting is protected and cannot be deleted"><i class="fa fa-info-circle"></i> <span class="hidden-md-down">Delete</span></span>
                                        @else
                                            <a href="{{ route('admin.settings.destroy', $setting->id) }}" data-delete="" data-message="This will delete the setting." data-button-text="Yes, delete it" class="btn btn-sm btn-link text-danger delete-setting"><i class="fa fa-trash-o" title="Delete Setting"></i> <span class="hidden-md-down">Delete</span></a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table><!-- /.table /#settings-table -->
                </div><!-- /.table-responsive -->
            </div><!-- /.card -->
        </div><!-- /.col .page-content -->
    </div><!-- /.row -->
</div><!-- /.container-fluid -->
@endsection