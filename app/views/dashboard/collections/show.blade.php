@extends('layout')

@section('content')
	
	<div class="container">
		{{ dd(json_decode($collection->fields, true)) }}
	</div>

@stop