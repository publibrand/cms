@extends('layout')

@section('content')
	
	<div class="container">
		<h1 class="general-title">
			{{ Lang::get('messages.reg_edit') }}
		</h1>
		@include('dashboard.registers.form')
	</div>

@stop