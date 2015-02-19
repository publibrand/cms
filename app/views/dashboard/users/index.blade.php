@extends('layout')

@section('content')
	
	<div class="container">
		@foreach($users as $user)
			{{{ $user }}}
		@endforeach
	</div>

@stop