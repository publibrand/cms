@extends('layout')

@section('content')
	
	<div class="auth">
		<div class="auth-header">
			<span>{{ Lang::get('messages.forgot_password') }}</span>
		</div>
		<div class="auth-body">
			{{ Form::open(['route' => 'auth.forgot.send', 'method' => 'POST', 'class' => 'ajax-form']) }}
				
				<div class="form-group form-float-label">
					{{ Form::label('email', Lang::get('messages.email')) }}
					{{ Form::email('email', NULL, ['placeholder' => Lang::get('messages.email')]) }}
					<span class="form-message"></span>
				</div>

				<span class="form-status"></span>
				
				{{ link_to('/', Lang::get('messages.cancel'), ['class' => 'btn']) }}
				{{ Form::submit(Lang::get('messages.send')); }}

			{{ Form::close() }}
			<div class="clear-fix"></div>

			<span class="author">{{ Lang::get('messages.developed_by') }} <a href="http://publibrand.com.br/">Publibrand</a>.</span>
		</div> 
	</div>

@stop