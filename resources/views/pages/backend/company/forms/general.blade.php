<div class="card-block">
    <div class="form-group{{ ($errors->has('name') ? ' has-danger' : '') }}">
        {!! Form::label('name', 'Label', ['class' => 'form-control-label']) !!}

        {!! Form::text('name', (isset($company->name) ? $company->name : null), ['class' => 'form-control']) !!}
        {!! $errors->first('name', '<div class="text-help">:message</div>') !!}
    </div><!-- /.form-group -->

    <div class="form-group{{ ($errors->has('email') ? ' has-danger' : '') }}">
        {!! Form::label('email', 'Email', ['class' => 'form-control-label']) !!}

        {!! Form::email('email', (isset($company->email) ? $company->email : null), ['class' => 'form-control']) !!}
        {!! $errors->first('email', '<div class="text-help">:message</div>') !!}
    </div><!-- /.form-group -->

    <div class="form-group{{ ($errors->has('address') ? ' has-danger' : '') }}">
        {!! Form::label('address', 'Address', ['class' => 'form-control-label']) !!}

        {!! Form::textarea('address', (isset($company->address) ? $company->address : null), ['class' => 'form-control']) !!}
        {!! $errors->first('address', '<div class="text-help">:message</div>') !!}
    </div><!-- /.form-group -->

    <div class="form-group{{ ($errors->has('post_code') ? ' has-danger' : '') }}">
        {!! Form::label('post_code', 'Postcode', ['class' => 'form-control-label']) !!}

        {!! Form::text('post_code', (isset($company->post_code) ? $company->post_code : null), ['class' => 'form-control']) !!}
        {!! $errors->first('post_code', '<div class="text-help">:message</div>') !!}
    </div><!-- /.form-group -->

    <div class="form-group{{ ($errors->has('telephone_1') ? ' has-danger' : '') }}">
        {!! Form::label('telephone_1', 'Telephone 1', ['class' => 'form-control-label']) !!}

        {!! Form::text('telephone_1', (isset($company->telephone_1) ? $company->telephone_1 : null), ['class' => 'form-control']) !!}
        {!! $errors->first('telephone_1', '<div class="text-help">:message</div>') !!}
    </div><!-- /.form-group -->

    <div class="form-group{{ ($errors->has('telephone_2') ? ' has-danger' : '') }}">
        {!! Form::label('telephone_2', 'Telephone 2', ['class' => 'form-control-label']) !!}

        {!! Form::text('telephone_2', (isset($company->telephone_2) ? $company->telephone_2 : null), ['class' => 'form-control']) !!}
        {!! $errors->first('telephone_2', '<div class="text-help">:message</div>') !!}
    </div><!-- /.form-group -->
</div><!-- /.card-block -->