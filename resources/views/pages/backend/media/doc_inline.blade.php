@extends('layouts.backend.plain')

<header class="main-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-8 col-lg-8">
                <h2 class="text-muted">Page Media</h2>
            </div><!-- /.col -->

            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 p-t">
                {!! Form::open(['route' => 'admin.search', 'method' => 'GET']) !!}
                    <div class="input-group">
                        <input type="text" name="q" class="form-control btn-default-outline" placeholder="Search Media...">

                        <span class="input-group-btn">
                            <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                        </span><!-- /.input-group-btn -->
                    </div><!-- /.input-group -->
                {!! Form::close() !!}
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</header><!-- /.main-header -->

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="sidebar col-xs-12 col-sm-12 col-md-12 col-lg-12 p-3">
                <h4 class="lead text-muted">Documents</h4>

                <ul class="nav nav-pills nav-stacked">
                    @foreach($documents as $document)
                        <?php
                        if ($document->extension == 'pdf') :
                            $type = 'pdf';
                        elseif ($document->extension == 'doc') :
                            $type = 'word';
                        else :
                            $type = 'code';
                        endif;
                        ?>
                        <li class="nav-item">
                            <a href="#" class="nav-link" onclick="window.opener.CKEDITOR.tools.callFunction({{ Input::get('CKEditorFuncNum') }},'/uploads/documents/{{ $document->filename }}'); window.close()">
                                <i class="fa fa-file-{{ $type }}-o"></i> {{ $document->label }}
                                <span class="label label-default pull-xs-right">{{ Pingala::bytesToHuman($document->size) }}</span>
                            </a>
                        </li><!-- /.list-group-item -->
                    @endforeach
                </ul><!-- /.list-group -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
@endsection
