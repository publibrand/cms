{{ Form::open(['route' => 'auth.check', 'method' => 'POST', 'class' => 'ajax-form']) }}
	
	<div class="form-group">
		{{ Form::label('email', 'Email') }}
		{{ Form::email('email') }}
		<span class="form-message"></span>
	</div>

	<div class="form-group">
		{{ Form::label('password', 'Password') }}
		{{ Form::password('password') }}
		<span class="form-message"></span>
	</div>

	<div class="form-group">
		{{ Form::label('rememberMe', 'Remember me') }}
		{{ Form::checkbox('rememberMe') }}
		<span class="form-message"></span>
	</div>

	<span class="form-status"></span>
	
	{{ Form::submit('Save'); }}

{{ Form::close() }}

