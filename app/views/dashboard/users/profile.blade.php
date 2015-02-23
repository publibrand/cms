@extends('layout')

@section('content')
	

<div class="container">
	<div class="box">
		<h2>Profile</h2>
		{{{ $user }}}
		<hr/>
		<a href="{{ route('users.edit', $user->id ) }}">Edit</a>
	</div>
</div>

@stop