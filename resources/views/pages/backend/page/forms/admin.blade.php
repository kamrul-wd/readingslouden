<div class="card-block">
    <div class="form-group{{ ($errors->has('template') ? ' has-danger' : '') }}">
        {!! Form::label('template', 'Template (layout which this page should use)', ['class' => 'form-control-label']) !!}

        {!! Form::select('template', $template_list, (isset($page->template) ? $page->template : null), ['class' => 'form-control form-control-lg']) !!}
        {!! $errors->first('template', '<div class="text-help">:message</div>') !!}
    </div><!-- /.form-group -->

    <div class="form-group{{ ($errors->has('child_template') ? ' has-danger' : '') }}">
        {!! Form::label('child_template', 'Child Template (layout which all immediate sub pages should use)', ['class' => 'form-control-label']) !!}

        {!! Form::select('child_template', $template_list, (isset($page->child_template) ? $page->child_template : null), ['class' => 'form-control form-control-lg']) !!}
        {!! $errors->first('child_template', '<div class="text-help">:message</div>') !!}
    </div><!-- /.form-group -->

    <div class="form-group{{ ($errors->has('protected') ? ' has-danger' : '') }}">
        <label class="c-input c-checkbox">
            {!! Form::checkbox('protected', 1, (isset($page->protected) ? $page->protected : null)) !!}
            <span class="c-indicator"></span>
            Protect page from being deleted
        </label>
        {!! $errors->first('protected', '<div class="text-help">:message</div>') !!}
    </div><!-- /.form-group -->
</div><!-- /.card-block -->

