@extends('layout')

@section('content')
	
	<div class="container">
		@foreach($collections as $collection)
			{{ $collection }}
		@endforeach
	</div>

@stop