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
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 p-3">
                <h4 class="lead">Images from Media</h4>

                <div class="row">
                    @foreach ($images as $image)
                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 init-btn" data-url="/uploads/images/{{ $image->filename }}">
                            <div class="card">
                                <img class="card-img-top img-fluid" src="/uploads/images/thumbnails/{{ $image->filename }}" alt="{{ $image->label }}">
                                <div class="card-block">
                                    <h4 class="card-title">{{ $image->label }}</h4>
                                    <p class="card-text">
                                        <small class="text-muted">
                                            Dimensions: {{ str_replace(',', 'x', $image->dimensions) }}
                                            <br>
                                            Extension: {{ strtoupper($image->extension) }}
                                            <br>
                                            Size: {{ Pingala::bytesToHuman($image->size) }}
                                        </small><!-- /.text-muted -->
                                    </p><!-- /.card-text -->

                                    {{--<a href="#" data-url="/uploads/images/{{ $image->filename }}" class="btn btn-sm btn-block btn-pingala" onclick="window.opener.CKEDITOR.tools.callFunction({{ Input::get('CKEditorFuncNum') }},'/uploads/images/{{ $image->filename }}'); window.close()">Insert Image</a>--}}
                                </div><!-- /.card-block -->
                            </div><!-- /.card -->
                        </div><!-- /.col -->
                    @endforeach
                </div><!-- /.row -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
@endsection


@section('footer-script')
    <style>
        div.init-btn{
            cursor:pointer;
        }
    </style>
    <script>
        $(document).ready(function(){
//            $('div.init-btn').click(function(e){
//                var dataurl = $(this).data('url');
//                console.log(dataurl);
//                $(this).addClass('selected');
//            });


            $(document).on("click","div.init-btn",function(){
                item_url = $(this).data("url");
                var args = top.tinymce.activeEditor.windowManager.getParams();
                win = (args.window);
                input = (args.input);
                win.document.getElementById(input).value = item_url;
                top.tinymce.activeEditor.windowManager.close();
            });


        });

    </script>
@endsection