@extends('layout')

@section('content')

	<div class="container">
		<h1 class="general-title">
			{{ Lang::get('messages.collections') }}
			<span class="legend">{{ Lang::get('messages.col_new') }}</span>
		</h1>
		
		
		@include('dashboard.collections.form')	
	</div>

@stop