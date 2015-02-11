@extends('layout')

@section('content')
	
	@foreach($forms as $form)
		{{{ $form }}}
	@endforeach

@stop