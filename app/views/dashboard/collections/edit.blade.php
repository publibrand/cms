@extends('layout')

@section('content')
	
	<div class="container">
		<h1 class="general-title">
			{{ Lang::get('messages.col_edit') }}
		</h1>
		
		@include('dashboard.collections.form')	
	</div>
	
@stop