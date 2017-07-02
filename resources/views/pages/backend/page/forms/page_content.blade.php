<div class="card-block">
    <div class="form-group{{ ($errors->has('heading') ? ' has-danger' : '') }}">
        {!! Form::label('heading', 'Heading', ['class' => 'form-control-label']) !!}

        {!! Form::text('heading', (isset($page->heading) ? $page->heading : null), ['class' => 'slug-source form-control', 'placeholder' => 'Heading for the page. Also used for URI slug']) !!}
        {!! $errors->first('heading', '<div class="text-help">:message</div>') !!}
    </div><!-- /.form-group -->

    @if(isset($page->depth) && $page->depth < 3)
        <div class="form-group{{ ($errors->has('excerpt') ? ' has-danger' : '') }}">
            {!! Form::label('excerpt', 'Intro Text (Max 500 chars)', ['class' => 'form-control-label']) !!}
            <span class="char-warning text-danger"></span>

            {!! Form::textarea('excerpt', (isset($page->excerpt) ? $page->excerpt : null), ['data-max-length-warning' => 'Character limit exceeded!', 'data-max-length' => '500', 'data-max-length-warning-container' => 'char-warning', 'class' => 'form-control', 'placeholder' => 'Excerpt for intro to page. Plain text only']) !!}
            {!! $errors->first('excerpt', '<div class="text-help">:message</div>') !!}
        </div><!-- /.form-group -->
    @endif

    <div class="form-group{{ ($errors->has('content') ? ' has-danger' : '') }}">
        {!! Form::label('content', 'Main Content', ['class' => 'form-control-label']) !!}

        {{--{!! Form::textarea('content', (isset($page->content) ? $page->content : null), ['class' => 'form-control grideditor', 'id' => 'content-html']) !!}--}}
        {{--<div id="content-full"></div>--}}


        {!! Form::textarea('content', (isset($page->content) ? $page->content : null), ['class' => 'form-control content_grid', 'id' => 'content_grid']) !!}

        {{--{!! Form::textarea('content', (isset($page->content) ? $page->content : null), ['class' => 'form-control', 'id' => 'content-full']) !!}--}}
        {!! $errors->first('content', '<div class="text-help">:message</div>') !!}
    </div><!-- /.form-group -->
</div><!-- /.card-block -->

@if(isset($page->template) && $page->template == 'home')
    @include('pages.backend.page.forms.extra.home')
@endif



<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
{{--<textarea name="content" class="form-control my-editor">{!! old('content', $content) !!}</textarea>--}}
<script>
    var editor_config = {
        path_absolute : "/",
        height:450,
        selector: ".content_grid",
        plugins: [
            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime media nonbreaking save table contextmenu directionality",
            "emoticons template paste textcolor colorpicker textpattern"
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image  code",
        relative_urls: false,
        file_browser_callback : function(field_name, url, type, win){
                         if (type == 'file') {
                             var filebrowser = "/admin/media/doc-inline/";
                         }

                         // Provide image and alt text for the image dialog
                         if (type == 'image') {
                             var filebrowser = "/admin/media/image-inline/";
                         }

                         tinymce.activeEditor.windowManager.open({
                             title : "File Browser",
                             width : 800,
                             height : 400,
                             url : filebrowser
                         }, {
                             window : win,
                             input : field_name
                         });

                         return false;
                     }
    };

    tinymce.init(editor_config);
</script>