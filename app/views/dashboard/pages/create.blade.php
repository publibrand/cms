@extends('layout')

@section('content')

	<div class="container">
		<h1 class="general-title">
			{{ Lang::get('messages.pages') }}
			<span class="legend">{{ Lang::get('messages.pag_new') }}</span>
		</h1>
		
		
		@include('dashboard.pages.form')	
	</div>

@stop