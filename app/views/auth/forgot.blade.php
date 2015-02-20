@extends('layout')

@section('content')
	
	<div class="login">
		{{ Form::open(['route' => 'auth.forgot.send', 'method' => 'POST', 'class' => 'ajax-form']) }}
			
			<div class="form-group">
				{{ Form::label('email', 'Email') }}
				{{ Form::email('email') }}
				<span class="form-message"></span>
			</div>

			<span class="form-status"></span>
			
			{{ Form::submit('Save'); }}

		{{ Form::close() }}
	</div>

@stop