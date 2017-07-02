@extends('layouts.backend.master')

@section('content')

@include('partials.backend.header')

@include('partials.backend.sub_header', ['controls_nav' => true])

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
                    <h6 class="card-subtitle text-muted">Viewing Top Level</h6>
                </div>

                <table class="table table-striped" id="page-table" style="margin-bottom: 0;">
                    <tbody>
                        <tr data-page-id="{{ $root->id }}">
                            <td></td>
                            <td>{{ $root->heading }}</td>
                            <td></td>
                            <td class="pull-right">
                                <div class="btn-group" role="group" aria-label="Action buttons">
                                    <a href="{{ route('admin.pages.edit', $root->id) }}" class="btn btn-link btn-sm text-muted"><i class="fa fa-pencil"></i> <span class="hidden-md-down">Edit</span></a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                    <tbody id="is_sortable">
                        @foreach($pages as $page)
                            <tr data-page-id="{{ $page->id }}">
                                <td class="re-order"><i class="fa fa-bars"></i></td>
                                <td>{{ $page->heading }}</td>
                                <td><i class="toggle-active fa fa-lg fa-toggle{{ ($page->active ? '-on text-success' : '-off') }}"></i></td>
                                <td class="pull-right">
                                    @if(! $page->isLeaf())
                                        <a href="{{ route('admin.pages.show', [$page->id]) }}" class="btn btn-link btn-sm"><i class="fa fa-list-alt" title="View Subs"></i> <span class="hidden-md-down">View Subs</span></a>
                                    @endif

                                    <a href="{{ route('admin.pages.add', $page->id) }}" class="btn btn-link btn-sm text-muted"><i class="fa fa-plus" title="Add Sub"></i> <span class="hidden-md-down">Add Sub</span></a>

                                    <a href="{{ route('admin.pages.edit', $page->id) }}" class="btn btn-link btn-sm text-muted"><i class="fa fa-pencil" title="Edit Page"></i> <span class="hidden-md-down">Edit</span></a>

                                    <a href="{{ route('admin.pages.copy', $page->id) }}" data-copy="" data-message="This will copy this page in the same location." data-button-text="Yes, copy it" class="btn btn-sm btn-link text-muted copy-page"><i class="fa fa-files-o" title="Copy Page"></i> <span class="hidden-md-down">Copy</span></a>

                                    {!! Form::button(
                                        '<i class="fa fa-exchange" title="Move Page"></i> <span class="hidden-md-down">Move</span>',
                                        ['type' => 'button', 'data-toggle' => 'modal', 'data-target' => '#move-page-'.$page->id, 'class' => 'btn btn-sm btn-link text-muted']
                                    ) !!}
                                    <div class="modal fade" id="move-page-{{ $page->id }}" tabindex="-1" role="dialog" aria-labelledby="move-page" aria-hidden="true">
                                        <div class="modal-dialog modal-sm" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        <span class="sr-only">Close</span>
                                                    </button>
                                                    <h4 class="modal-title">Move Page</h4>
                                                </div>

                                                {!! Form::open(['route' => ['admin.pages.move', $page->id], 'method' => 'post']) !!}
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label class="form-control-label">Pick new parent page</label>
                                                            {!! Form::select('new_parent', $root_pages, null, ['class' => 'form-control c-select', 'required']) !!}
                                                        </div><!-- /.form-group -->
                                                    </div><!-- /.modal-body -->

                                                    <div class="modal-footer">
                                                        <a class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</a>
                                                        {!! Form::button('<i class="fa fa-exchange"></i> Move Page', ['type' => 'submit', 'class' => 'btn btn-success btn-sm']) !!}
                                                    </div><!-- /.modal-footer -->
                                                {!! Form::close() !!}
                                            </div>
                                        </div>
                                    </div>
                                    |
                                    @if($page->protected)
                                        <span class="btn btn-sm btn-link text-danger" data-toggle="tooltip" data-placement="left" title="This page is protected and cannot be deleted"><i class="fa fa-info-circle"></i> <span class="hidden-md-down">Delete</span></span>
                                    @else
                                        <a href="{{ route('admin.pages.destroy', $page->id) }}" data-delete="" data-message="This will delete the page and all sub pages." data-button-text="Yes, delete them" class="btn btn-sm btn-link text-danger delete-page"><i class="fa fa-trash-o" title="Delete Page"></i> <span class="hidden-md-down">Delete</span></a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        <tr style="border-top: 12px solid #eee;">
                            <th scope="row" width="1">Hidden</th>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        @foreach($hidden as $key => $hidden_page)
                            <tr data-page-id="{{ $hidden_page->id }}">
                                <td data-toggle="tooltip" data-placement="right" title="This page is not shown on the main menu, re-ordering is disabled for this item"><i class="fa fa-times-circle"></i></td>
                                <td>{{ $hidden_page->heading }}</td>
                                <td><i class="toggle-active fa fa-lg fa-toggle{{ ($hidden_page->active ? '-on text-success' : '-off') }}"></i></td>
                                <td class="pull-right">
                                    @if(! $hidden_page->isLeaf())
                                        <a href="{{ route('admin.pages.show', [$hidden_page->id]) }}" class="btn btn-link btn-sm"><i class="fa fa-list-alt" title="View Subs"></i> <span class="hidden-md-down">View Subs</span></a>
                                    @endif

                                    <a href="{{ route('admin.pages.add', $hidden_page->id) }}" class="btn btn-link btn-sm text-muted"><i class="fa fa-plus" title="Add Sub"></i> <span class="hidden-md-down">Add Sub</span></a>

                                    <a href="{{ route('admin.pages.edit', $hidden_page->id) }}" class="btn btn-link btn-sm text-muted"><i class="fa fa-pencil" title="Edit Page"></i> <span class="hidden-md-down">Edit</span></a>

                                    <a href="{{ route('admin.pages.copy', $hidden_page->id) }}" data-copy="" data-message="This will copy this page in the same location." data-button-text="Yes, copy it" class="btn btn-sm btn-link text-muted copy-page"><i class="fa fa-files-o" title="Copy Page"></i> <span class="hidden-md-down">Copy</span></a>

                                    {!! Form::button(
                                        '<i class="fa fa-exchange" title="Move Page"></i> <span class="hidden-md-down">Move</span>',
                                        ['type' => 'button', 'data-toggle' => 'modal', 'data-target' => '#move-page-'.$hidden_page->id, 'class' => 'btn btn-sm btn-link text-muted']
                                    ) !!}
                                    <div class="modal fade" id="move-page-{{ $hidden_page->id }}" tabindex="-1" role="dialog" aria-labelledby="move-page" aria-hidden="true">
                                        <div class="modal-dialog modal-sm" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        <span class="sr-only">Close</span>
                                                    </button>
                                                    <h4 class="modal-title">Move Page</h4>
                                                </div>

                                                {!! Form::open(['route' => ['admin.pages.move', $hidden_page->id], 'method' => 'post']) !!}
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label class="form-control-label">Pick new parent page</label>
                                                        {!! Form::select('new_parent', $root_pages, null, ['class' => 'form-control c-select']) !!}
                                                    </div><!-- /.form-group -->
                                                </div><!-- /.modal-body -->

                                                <div class="modal-footer">
                                                    <a class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</a>
                                                    {!! Form::button('<i class="fa fa-exchange"></i> Move Page', ['type' => 'submit', 'class' => 'btn btn-success btn-sm']) !!}
                                                </div><!-- /.modal-footer -->
                                                {!! Form::close() !!}
                                            </div>
                                        </div>
                                    </div>
                                    |
                                    @if($hidden_page->protected)
                                        <span class="btn btn-sm btn-link text-danger" data-toggle="tooltip" data-placement="left" title="This page is protected and cannot be deleted"><i class="fa fa-info-circle"></i> <span class="hidden-md-down">Delete</span></span>
                                    @else
                                        <a href="{{ route('admin.pages.destroy', $hidden_page->id) }}" data-delete="" data-message="This will delete the page and all sub pages." data-button-text="Yes, delete them" class="btn btn-sm btn-link text-danger delete-page"><i class="fa fa-trash-o" title="Delete Page"></i> <span class="hidden-md-down">Delete</span></a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table><!-- /.table /#page-table -->
            </div><!-- /.card -->
        </div><!-- /.col .page-content -->
    </div><!-- /.row -->
</div><!-- /.container-fluid -->
@endsection