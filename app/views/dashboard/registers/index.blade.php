@extends('layout')

@section('content')
	

<div class="container">
	<div class="box">
		<h2>{{ $collection->name }}</h2>
		<ul class="list">
			@foreach($collection->registers()->get() as $register)
				<li>{{ $register->name }} - <a href="{{ route('registers.edit', [$collection->slug,$register->id]) }}">Edit</a> - <a href="{{ route('registers.destroy', [$collection->slug,$register->id]) }}" data-method="DELETE">Delete</a></li>
			@endforeach
		</ul>
		<a href="{{ route('registers.create', $collection->slug) }}">New Register</a>
	</div>
</div>


@stop