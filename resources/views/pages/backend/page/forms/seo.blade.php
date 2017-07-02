<div class="card-block">
    @if(URL::current() != route('admin.pages.edit', 1))
        <div class="form-group{{ ($errors->has('slug') ? ' has-danger' : '') }}">
            {!! Form::label('slug', 'Slug (URI Segment)', ['class' => 'form-control-label']) !!}

            {!! Form::text('slug', (isset($page->slug) ? $page->slug : null), ['class' => 'slug-gen form-control', 'placeholder' => 'Text for the end URI segment in the address bar']) !!}
            <div class="text-help">Pretty URL {{ route('index') }}{{ $rendered_slug }}/<span class="slug-gen">{{ (isset($page->slug) ? $page->slug : '') }}</span></div>
            {!! $errors->first('slug', '<div class="text-help">:message</div>') !!}
            <hr>
        </div><!-- /.form-group -->
    @else
        <input type="hidden" name="slug" value="home_do_not_set">
    @endif

    <div class="form-group{{ ($errors->has('browser_title') ? ' has-danger' : '') }}">
        {!! Form::label('browser_title', 'Browser Title', ['class' => 'form-control-label']) !!}

        {!! Form::text('browser_title', (isset($page->extra->browser_title) ? $page->extra->browser_title : null), ['class' => 'form-control', 'placeholder' => 'Title in the browser tab']) !!}
        {!! $errors->first('browser_title', '<div class="text-help">:message</div>') !!}
    </div><!-- /.form-group -->

    <div class="form-group{{ ($errors->has('description') ? ' has-danger' : '') }}">
        {!! Form::label('description', 'Meta Description', ['class' => 'form-control-label']) !!}

        {!! Form::text('description', (isset($page->meta->description) ? $page->meta->description : null), ['class' => 'form-control']) !!}
        {!! $errors->first('description', '<div class="text-help">:message</div>') !!}
    </div><!-- /.form-group -->

    <div class="form-group{{ ($errors->has('robots') ? ' has-danger' : '') }}">
        {!! Form::label('robots', 'Meta Robots', ['class' => 'form-control-label']) !!}

        {!! Form::text('robots', (isset($page->meta->robots) ? $page->meta->robots : null), ['class' => 'form-control', 'placeholder' => 'Example: index, follow']) !!}
        {!! $errors->first('robots', '<div class="text-help">:message</div>') !!}
    </div><!-- /.form-group -->

    <div class="form-group{{ ($errors->has('canonical') ? ' has-danger' : '') }}">
        {!! Form::label('canonical', 'Canonical URL', ['class' => 'form-control-label']) !!}

        {!! Form::text('canonical', (isset($page->extra->canonical) ? $page->extra->canonical : null), ['class' => 'form-control', 'placeholder' => 'Example: http://example.com/news/page-item']) !!}
        {!! $errors->first('canonical', '<div class="text-help">:message</div>') !!}
    </div><!-- /.form-group -->

    <div class="form-group{{ ($errors->has('footer_code') ? ' has-danger' : '') }}">
        {!! Form::label('footer_code', 'Extra Footer Code (before </body>)', ['class' => 'col-sm-1 form-control-label']) !!}

        {!! Form::textarea('footer_code', (isset($page->extra->footer_code) ? $page->extra->footer_code : null), ['class' => 'form-control', 'placeholder' => 'HTML/JS allowed']) !!}
        {!! $errors->first('footer_code', '<div class="text-help">:message</div>') !!}
    </div><!-- /.form-group -->


        <div class="form-group{{ ($errors->has('body_class') ? ' has-danger' : '') }}">
            {!! Form::label('body_class', 'Body Class', ['class' => 'form-control-label']) !!}

            {!! Form::text('body_class', (isset($page->extra->body_class) ? $page->extra->body_class : null), ['class' => 'form-control', 'placeholder' => '']) !!}
            {!! $errors->first('body_class', '<div class="text-help">:message</div>') !!}
        </div><!-- /.form-group -->
</div><!-- /.card-block -->