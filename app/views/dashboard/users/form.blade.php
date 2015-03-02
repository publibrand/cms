@if(isset($user))
	{{ Form::model($user, ['route' => array('users.update', $user->id), 'method' => 'PUT', 'class' => 'ajax-form']) }}
@else
	{{ Form::open(['route' => 'users.store', 'method' => 'POST', 'class' => 'ajax-form']) }}
@endif
	
	<div class="form-group">
		{{ Form::label('first_name', 'First name') }}
		{{ Form::text('first_name') }}
		<span class="form-message"></span>
	</div>

	<div class="form-group">
		{{ Form::label('last_name', 'Last name') }}
		{{ Form::text('last_name') }}
		<span class="form-message"></span>
	</div>

	<div class="form-group">
		{{ Form::label('email', 'Email') }}
		{{ Form::email('email') }}
		<span class="form-message"></span>
	</div>

	<div class="form-group">
		{{ Form::label('password', 'Password') }}
		{{ Form::password('password') }}
		<span class="form-message"></span>
	</div>

	<div class="form-group">
		{{ Form::label('password_confirmation', 'Password confirmation') }}
		{{ Form::password('password_confirmation') }}
		<span class="form-message"></span>
	</div>

	@if(User::inGroup('Developer'))

		<div class="form-group">
			{{ Form::label('group', 'Group') }}
			{{ Form::select('group', $groups, isset($userGroup) ? $userGroup->id : NULL ) }}
			<span class="form-message"></span>
		</div>

	<!-- 	<div class="form-group">
			@foreach($permissions as $permission)
				<div>
					{{ Form::checkbox('permission[' . $permission . ']', $permission) }}
					{{ Form::label('permission[' . $permission . ']', $permission) }}
				</div>
			@endforeach
			<span class="form-message"></span>
		</div>
		 -->
	@endif

	<span class="form-status"></span>
	
	{{ Form::submit('Save'); }}

{{ Form::close() }}

<a href="{{ route('dashboard') }}">Cancel</a>
