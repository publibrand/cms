@extends('layout')

@section('content')
	
	@foreach($users as $user)
		{{{ $user }}}
	@endforeach

@stop