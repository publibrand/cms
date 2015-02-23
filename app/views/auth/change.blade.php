@extends('layout')

@section('content')
	
	<div class="login">
		{{ Form::open(['route' => ['auth.forgot.check', $token], 'method' => 'POST', 'class' => 'ajax-form']) }}
			
			<div class="form-group">
				{{ Form::label('password', 'Password') }}
				{{ Form::password('password') }}
				<span class="form-message"></span>
			</div>

			<div class="form-group">
				{{ Form::label('password_confirmation', 'Password confirmation') }}
				{{ Form::password('password_confirmation') }}
				<span class="form-message"></span>
			</div>

			<span class="form-status"></span>
			
			{{ Form::submit('Save'); }}

		{{ Form::close() }}
	</div>

@stop