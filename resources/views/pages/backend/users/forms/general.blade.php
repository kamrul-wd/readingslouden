<div class="card-block">
    <div class="form-group{{ ($errors->has('name') ? ' has-danger' : '') }}">
        {!! Form::label('name', 'Name', ['class' => 'form-control-label']) !!}

        {!! Form::text('name', (isset($user->name) ? $user->name : null), ['class' => 'form-control', 'placeholder' => 'Name of user']) !!}
        {!! $errors->first('name', '<div class="text-help">:message</div>') !!}
    </div><!-- /.form-group -->

    <div class="form-group{{ ($errors->has('email') ? ' has-danger' : '') }}">
        {!! Form::label('email', 'Email', ['class' => 'form-control-label']) !!}

        {!! Form::email('email', (isset($user->email) ? $user->email : null), ['class' => 'form-control', 'placeholder' => 'Email']) !!}
        {!! $errors->first('email', '<div class="text-help">:message</div>') !!}
    </div><!-- /.form-group -->

    <div class="form-group{{ ($errors->has('password') ? ' has-danger' : '') }}">
        {!! Form::label('password', 'New Password', ['class' => 'form-control-label']) !!}

        {!! Form::password('password', ['class' => 'form-control']) !!}
        {!! $errors->first('password', '<div class="text-help">:message</div>') !!}
    </div><!-- /.form-group -->

    <div class="form-group{{ ($errors->has('user_roles') ? ' has-danger' : '') }}">
        {!! Form::label('user_roles', 'Roles', ['class' => 'form-control-label']) !!}

        {!! Form::select('user_roles[]', $available_roles, (isset($user) ? $selected_roles : ''), ['class' => 'form-control', 'multiple']) !!}
        {!! $errors->first('user_roles', '<div class="text-help">:message</div>') !!}
    </div><!-- /.form-group -->

    <div class="form-group{{ ($errors->has('active') ? ' has-danger' : '') }}">
        <label class="c-input c-checkbox">
            {!! Form::checkbox('active', 1, (isset($user->active) ? $user->active : null)) !!}
            <span class="c-indicator"></span>
            Active
        </label>
        {!! $errors->first('active', '<div class="text-help">:message</div>') !!}
    </div><!-- /.form-group -->
</div><!-- /.card-block -->