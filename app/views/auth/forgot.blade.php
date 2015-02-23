@extends('layout')

@section('content')
	
	<div class="auth">
		<div class="auth-header">
			<span>Forgot password</span>
		</div>
		<div class="auth-body">
			{{ Form::open(['route' => 'auth.forgot.send', 'method' => 'POST', 'class' => 'ajax-form']) }}
				
				<div class="form-group form-float-label">
					{{ Form::label('email', 'Email') }}
					{{ Form::email('email', NULL, ['placeholder' => 'E-mail']) }}
					<span class="form-message"></span>
				</div>

				<span class="form-status"></span>
				
				{{ link_to('/', 'Cancel', ['class' => 'btn']) }}
				{{ Form::submit('Save'); }}

			{{ Form::close() }}
			<div class="clear-fix"></div>

			<span class="author">Desenvolvido por <a href="http://publibrand.com.br/">Publibrand</a>.</span>
		</div> 
	</div>

@stop