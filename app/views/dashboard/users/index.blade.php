@extends('layout')

@section('content')
	

<div class="container">
	<h1 class="general-title">
		{{ Lang::get('messages.users') }}
		<a href="{{ route('users.create') }}" class="new-button">{{ Lang::get('messages.user_new') }}</a>
	</h1>
	
	<div class="box">
	
		<div class="list">
			@foreach($users as $user)
				<div class="list-line">
					<span class="drop"></span>
					<span class="actions">
						<a href="{{ route('users.edit', $user->id ) }}" title="{{ Lang::get('messages.edit') }}" alt="{{ Lang::get('messages.edit') }}" class="edit"></a>
					</span>
					<a href="{{ route('users.edit', $user->id ) }}" >{{ $user->first_name }}</a>
				</div>
			@endforeach
		</div>
	</div>
</div>

@stop