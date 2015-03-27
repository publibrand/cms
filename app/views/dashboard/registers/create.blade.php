@extends('layout')

@section('content')
	
	<div class="container">
		<h1 class="general-title">
			{{ $collection->name }}
			<span class="legend">{{ Lang::get('messages.reg_new') }}</span>
		</h1>
		@include('dashboard.registers.form')
	</div>

@stop