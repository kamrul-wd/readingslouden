<div class="card-block">
    <div class="form-group{{ ($errors->has('label') ? ' has-danger' : '') }}">
        {!! Form::label('label', 'Label', ['class' => 'form-control-label']) !!}

        {!! Form::text('label', (isset($setting->label) ? $setting->label : null), ['class' => 'form-control', 'placeholder' => 'Descriptive label']) !!}
        {!! $errors->first('label', '<div class="text-help">:message</div>') !!}
    </div><!-- /.form-group -->

    <div class="form-group{{ ($errors->has('name') ? ' has-danger' : '') }}">
        {!! Form::label('name', 'Name', ['class' => 'form-control-label']) !!}

        @if (Route::currentRouteName() == 'admin.settings.edit')
            {!! Form::text('name', (isset($setting->name) ? $setting->name : null), ['class' => 'form-control', 'placeholder' => 'Named used to grab setting value', 'readonly']) !!}
        @else
            {!! Form::text('name', (isset($setting->name) ? $setting->name : null), ['class' => 'form-control', 'placeholder' => 'Named used to grab setting value']) !!}
        @endif
        {!! $errors->first('name', '<div class="text-help">:message</div>') !!}
    </div><!-- /.form-group -->

    <div class="form-group{{ ($errors->has('value') ? ' has-danger' : '') }}">
        {!! Form::label('value', 'Value', ['class' => 'form-control-label']) !!}

        {!! Form::text('value', (isset($setting->value) ? $setting->value : null), ['class' => 'form-control', 'placeholder' => 'Desired value']) !!}
        {!! $errors->first('value', '<div class="text-help">:message</div>') !!}
    </div><!-- /.form-group -->
</div><!-- /.card-block -->