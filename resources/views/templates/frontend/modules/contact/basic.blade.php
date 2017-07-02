@if(session()->has('status'))
    <h4>{!! session('status') !!}</h4>
@endif

{!! Form::open(['url' => 'contact', 'class' => 'form']) !!}
<input type="hidden" name="method_name" value="main_contact">
<div class="form-group">
    {!! Html::decode(Form::label('Your Name <span>*</span>')) !!}
    {!! Form::text('name', null,
        array('required',
              'class'=>'form-control',
              'placeholder'=>'Your name')) !!}
</div>

<div class="form-group">
    {!! Html::decode(Form::label('Your E-mail Address <span>*</span>')) !!}
    {!! Form::text('email', null,
        array('required',
              'class'=>'form-control',
              'placeholder'=>'Your e-mail address')) !!}
</div>

<div class="form-group">
    {!! Html::decode(Form::label('Your Message <span>*</span>')) !!}
    {!! Form::textarea('message', null,
        array('required',
              'class'=>'form-control',
              'placeholder'=>'Your message')) !!}
</div>

<div class="form-group">
    {!! Form::submit('Contact Us!',
      array('class'=>'btn btn-primary')) !!}
</div>
{!! Form::close() !!}