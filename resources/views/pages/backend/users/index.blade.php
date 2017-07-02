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
                    <h6 class="card-subtitle text-muted">Viewing All Users</h6>
                </div>

                <table class="table table-striped" id="settings-table" style="margin-bottom: 0;">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Roles</th>
                            <th>Created</th>
                            <th>Active</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @foreach($user->roles as $role)
                                        <label class="label label-default">{{ $role->name }}</label>
                                    @endforeach
                                </td>
                                <td><time datetime="{{ $user->created_at }}">{{ $user->created_at->diffForHumans() }}</time></td>
                                <td>{!! ($user->active ? '<i class="fa fa-check text-success"></i>' : '<i class="fa fa-times text-danger"></i>') !!}</td>
                                <td class="pull-right">
                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-link btn-sm text-muted"><i class="fa fa-pencil"></i> <span class="hidden-md-down">Edit</span></a>
                                    |
                                    @if($user->id == 1)
                                        <span class="btn btn-sm btn-link text-danger" data-toggle="tooltip" data-placement="left" title="This user cannot be deleted"><i class="fa fa-info-circle"></i> <span class="hidden-md-down">Delete</span></span>
                                    @else
                                        <a href="{{ route('admin.users.destroy', $user->id) }}" data-delete="" data-message="This will delete the user." data-button-text="Yes, delete it" class="btn btn-sm btn-link text-danger delete-user"><i class="fa fa-trash-o" title="Delete User"></i> <span class="hidden-md-down">Delete</span></a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table><!-- /.table /#settings-table -->
            </div><!-- /.card -->
        </div><!-- /.col .page-content -->
    </div><!-- /.row -->
</div><!-- /.container-fluid -->
@endsection