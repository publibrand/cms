@extends('layout')

@section('content')
	

<div class="container">
	<div class="box">
		<h2>Collections</h2>
		<ul class="list">
			@foreach($collections as $collection)
				<li>{{ $collection->name }} - <a href="{{ route('collections.edit', $collection->id ) }}">Edit</a> - <a href="{{ route('collections.destroy', $collection->id ) }}" data-method="DELETE">Delete</a></li>
			@endforeach
		</ul>
		<a href="{{ route('collections.create') }}">New Register</a>
	</div>
</div>

@stop