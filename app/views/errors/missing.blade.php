@extends('layout')

@section('content')
	
	<div class="container">
		<p>The requested URL <strong>/{{{ (Request::path()) }}}</strong> was not found on this server</strong>
	</div>
	
@stop