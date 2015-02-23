@extends('layout')

@section('content')
	
	<div class="auth">
		<div class="auth-header">
			<span>Sign in to manage</span>
		</div> 
		<div class="auth-body">
			{{ Form::open(['route' => 'auth.check', 'method' => 'POST', 'class' => 'ajax-form']) }}
				
				<div class="form-group form-float-label">
					{{ Form::label('email', 'Email') }}
					{{ Form::email('email', NULL, ['placeholder' => 'E-mail']) }}
					<span class="form-message"></span>
				</div>

				<div class="form-group form-float-label">
					{{ Form::label('password', 'Password') }}
					{{ Form::password('password', ['placeholder' => 'Password']) }}
					<span class="form-message"></span>
				</div>

				<div class="form-group form-remember-me">
					{{ Form::checkbox('rememberMe', 1, NULL, ['id' => 'rememberMe']) }}
					{{ Form::label('rememberMe', 'Remember me') }}
					<span class="form-message"></span>
				</div>

				<span class="form-status"></span>
				
				{{ link_to_route('auth.forgot', 'Forgot', NULL, ['class' => 'btn']) }}
				
				{{ Form::submit('Enter'); }}

			{{ Form::close() }}
			<div class="clear-fix"></div>
			
			<span class="author">Desenvolvido por <a href="http://publibrand.com.br/">Publibrand</a>.</span> 
		</div>
	</div>

@stop