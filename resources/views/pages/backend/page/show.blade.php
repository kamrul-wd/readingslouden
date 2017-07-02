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
                        <h4 class="card-title">List Pages</h4>
                        <h6 class="card-subtitle text-muted">Viewing {{ $page->heading }}</h6>
                    </div>

                    <table class="table table-striped" id="page-table">
                        <tbody>
                            <tr data-page-id="{{ $page->id }}">
                                <td></td>
                                <td>{{ $page->heading }}</td>
                                <td><i class="toggle-active fa fa-lg fa-toggle{{ ($page->active ? '-on text-success' : '-off') }}"></i></td>
                                <td class="pull-right">
                                    <a href="{{ route('admin.pages.edit', $page->id) }}" class="btn btn-sm btn-link text-muted"><i class="fa fa-pencil" title="Edit Page"></i> <span class="hidden-md-down">Edit</span></a>

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
                                                            {!! Form::select('new_parent', $root_pages, $page->parent_id, ['class' => 'form-control c-select']) !!}
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
                                    <a href="{{ route('admin.pages.destroy', $page->id) }}" data-delete="" data-message="This will delete the page and all sub pages." data-button-text="Yes, delete them" class="btn btn-sm btn-link text-danger delete-page"><i class="fa fa-trash-o" title="Delete Page"></i> <span class="hidden-md-down">Delete</span></a>
                                </td>
                            </tr>
                        </tbody>
                        <tbody id="is_sortable">
                            @foreach($descendants as $descendant)
                                <tr data-page-id="{{ $descendant->id }}">
                                    <td class="re-order"><i class="fa fa-bars"></i></td>
                                    <td>{{ $descendant->heading }}</td>
                                    <td><i class="toggle-active fa fa-lg fa-toggle{{ ($descendant->active ? '-on text-success' : '-off') }}"></i></td>
                                    <td class="pull-right">
                                        @if(! $descendant->isLeaf())
                                            <a href="{{ route('admin.pages.show', [$descendant->id]) }}" class="btn btn-link btn-sm text-muted"><i class="fa fa-list-alt" title="View Subs"></i> <span class="hidden-md-down">View Subs</span></a>
                                        @endif

                                        <a href="{{ route('admin.pages.add', $descendant->id) }}" class="btn btn-sm btn-link text-muted"><i class="fa fa-plus" title="Add Sub"></i> <span class="hidden-md-down">Add Sub</span></a>

                                        <a href="{{ route('admin.pages.edit', $descendant->id) }}" class="btn btn-sm btn-link text-muted"><i class="fa fa-pencil" title="Edit Page"></i> <span class="hidden-md-down">Edit</span></a>

                                        <a href="{{ route('admin.pages.copy', $descendant->id) }}" data-copy="" data-message="This will copy this page in the same location." data-button-text="Yes, copy it" class="btn btn-sm btn-link text-muted copy-page"><i class="fa fa-files-o" title="Copy Page"></i> <span class="hidden-md-down">Copy</span></a>

                                        {!! Form::button(
                                            '<i class="fa fa-exchange" title="Move Page"></i> <span class="hidden-md-down">Move</span>',
                                            ['type' => 'button', 'data-toggle' => 'modal', 'data-target' => '#move-page-'.$descendant->id, 'class' => 'btn btn-sm btn-link text-muted']
                                        ) !!}
                                        <div class="modal fade" id="move-page-{{ $descendant->id }}" tabindex="-1" role="dialog" aria-labelledby="move-page" aria-hidden="true">
                                            <div class="modal-dialog modal-sm" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                            <span class="sr-only">Close</span>
                                                        </button>
                                                        <h4 class="modal-title">Move Page</h4>
                                                    </div>

                                                    {!! Form::open(['route' => ['admin.pages.move', $descendant->id], 'method' => 'post']) !!}
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label class="form-control-label">Pick new parent page</label>
                                                            {!! Form::select('new_parent', $root_pages, $descendant->parent_id, ['class' => 'form-control c-select']) !!}
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
                                        <a href="{{ route('admin.pages.destroy', $descendant->id) }}" data-delete="" data-message="This will delete the page and all sub pages." data-button-text="Yes, delete them" class="btn btn-sm btn-link text-danger delete-page"><i class="fa fa-trash-o" title="Delete Page"></i> <span class="hidden-md-down">Delete</span></a>
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