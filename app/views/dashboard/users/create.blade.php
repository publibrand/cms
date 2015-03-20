@extends('layout')

@section('content')
	
	<div class="container">
		<h1 class="general-title">
			{{ Lang::get('messages.user_new') }}
		</h1>
		@include('dashboard.users.form')
	</div>
	
@stop