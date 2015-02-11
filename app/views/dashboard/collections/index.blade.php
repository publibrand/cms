@extends('layout')

@section('content')
	
	@foreach($collections as $collection)
		{{{ $collection }}}
	@endforeach

@stop