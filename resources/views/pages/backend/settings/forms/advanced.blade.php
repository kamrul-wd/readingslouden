<div class="card-block">
    @foreach($settings as $setting)
        <div class="form-group{{ ($errors->has($setting->name) ? ' has-danger' : '') }}">
            {!! Form::label('value['.$setting->id.']', $setting->label, ['class' => 'form-control-label']) !!}

            {!! Form::textarea('value['.$setting->id.']', (isset($setting->value) ? $setting->value : null), ['class' => 'form-control']) !!}
            {!! $errors->first($setting->name, '<div class="text-help">:message</div>') !!}
        </div><!-- /.form-group -->
    @endforeach
</div><!-- /.card-block -->