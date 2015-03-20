@extends('layout')

@section('content')
	
	<div class="auth">
		<div class="auth-header">
			<span>{{ Lang::get('messages.sign_in') }}</span>
		</div> 
		<div class="auth-body">
			{{ Form::open(['route' => 'auth.check', 'method' => 'POST', 'class' => 'ajax-form']) }}
				
				<div class="form-group form-float-label">
					{{ Form::label('email', Lang::get('messages.email')) }}
					{{ Form::email('email') }}
					<span class="form-message"></span>
				</div>

				<div class="form-group form-float-label">
					{{ Form::label('password', Lang::get('messages.password')) }}
					{{ Form::password('password') }}
					<span class="form-message"></span>
				</div>

				<div class="form-group form-remember-me">
					{{ Form::checkbox('rememberMe', 1, NULL, ['id' => 'rememberMe']) }}
					{{ Form::label('rememberMe', Lang::get('messages.remember_me')) }}
					<span class="form-message"></span>
				</div>

				<span class="form-status"></span>
				
				{{ link_to_route('auth.forgot', Lang::get('messages.forgot'), NULL, ['class' => 'btn']) }}
				
				{{ Form::submit(Lang::get('messages.enter')); }}

			{{ Form::close() }}
			<div class="clear-fix"></div>
			
			<span class="author">{{ Lang::get('messages.developed_by') }} <a href="http://publibrand.com.br/">Publibrand</a>.</span> 
		</div>
	</div>

@stop