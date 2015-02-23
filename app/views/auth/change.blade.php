@extends('layout')

@section('content')
	
	<div class="auth">
		<div class="auth-header">
			<span>Change password</span>
		</div> 
		<div class="auth-body">
			{{ Form::open(['route' => ['auth.forgot.check', $token], 'method' => 'POST', 'class' => 'ajax-form']) }}
				
				<div class="form-group form-float-label">
					{{ Form::label('password', 'Password') }}
					{{ Form::password('password', ['placeholder' => 'Password']) }}
					<span class="form-message"></span>
				</div>

				<div class="form-group form-float-label">
					{{ Form::label('password_confirmation', 'Password confirmation') }}
					{{ Form::password('password_confirmation', ['placeholder' => 'Password confirmation']) }}
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