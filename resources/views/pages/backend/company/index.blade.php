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
                    <h6 class="card-subtitle text-muted">Viewing Company Entries</h6>
                </div>

                <table class="table table-striped" id="company-table" style="margin-bottom: 0;">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Postcode</th>
                            <th>Telephone 1</th>
                            <th>Telephone 2</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($companies as $company)
                            <tr>
                                <td>{{ $company->name }}</td>
                                <td>{{ $company->email }}</td>
                                <td>{{ $company->address }}</td>
                                <td>{{ $company->post_code }}</td>
                                <td>{{ $company->telephone_1 }}</td>
                                <td>{{ $company->telephone_2 }}</td>
                                <td class="pull-right">
                                    <a href="{{ route('admin.company.edit', $company->id) }}" class="btn btn-link btn-sm text-muted"><i class="fa fa-pencil"></i> <span class="hidden-md-down">Edit</span></a>
                                    |
                                    <a href="{{ route('admin.company.destroy', $company->id) }}" data-delete="" data-message="This will delete the company entry." data-button-text="Yes, delete it" class="btn btn-sm btn-link text-danger delete-company-details"><i class="fa fa-trash-o" title="Delete Company Details"></i> <span class="hidden-md-down">Delete</span></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table><!-- /.table /#company-table -->
            </div><!-- /.card -->
        </div><!-- /.col .page-content -->
    </div><!-- /.row -->
</div><!-- /.container-fluid -->
@endsection