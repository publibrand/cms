@extends('layout')

@section('content')

	<div class="login">
		@include('auth.form')
		{{ link_to_route('auth.lost', 'Lost password') }}
	</div>

@stop