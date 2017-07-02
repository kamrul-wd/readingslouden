Hello {{ $user->name }},
<br>
<br>
Please follow the link to reset password : <a href="{{ route('admin.password.reset.token', [$token]) }}">reset password</a>