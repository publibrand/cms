@extends('layout')

@section('content')
	

<div class="container">
	<div class="box">
		<h2>Users</h2>
		<ul class="list">
			@foreach($users as $user)
				<li>{{ $user->first_name }} - <a href="{{ route('users.edit', $user->id ) }}">Edit</a> </li>
			@endforeach
		</ul>
		<a href="{{ route('users.create') }}">New Register</a>
	</div>
</div>

@stop