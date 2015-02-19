@extends('layout')

@section('content')
	
	@foreach($registers as $register)
		{{ $register }}
	@endforeach

@stop