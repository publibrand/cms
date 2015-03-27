@if(isset($user))
	{{ Form::model($user, ['route' => array('users.update', $user->id), 'method' => 'PUT', 'class' => 'ajax-form bar-form']) }}
@else
	{{ Form::open(['route' => 'users.store', 'method' => 'POST', 'class' => 'ajax-form bar-form']) }}
@endif
	
	<div class="form-group form-float-label">
		{{ Form::label('first_name', 'First name') }}
		{{ Form::text('first_name') }}
		<span class="form-message"></span>
	</div>

	<div class="form-group form-float-label">
		{{ Form::label('last_name', 'Last name') }}
		{{ Form::text('last_name') }}
		<span class="form-message"></span>
	</div>

	<div class="form-group form-float-label">
		{{ Form::label('email', 'Email') }}
		{{ Form::email('email') }}
		<span class="form-message"></span>
	</div>

	@if(User::inGroup('Developer'))

		<div class="form-group form-float-label">
			{{ Form::label('group', 'Group') }}
			{{ Form::select('group', $groups, isset($userGroup) ? $userGroup->id : NULL ) }}
			<span class="form-message"></span>
		</div>

	<?php /* 	<div class="form-group">
			@foreach($permissions as $permission)
				<div>
					{{ Form::checkbox('permission[' . $permission . ']', $permission) }}
					{{ Form::label('permission[' . $permission . ']', $permission) }}
				</div>
			@endforeach
			<span class="form-message"></span>
		</div>
		 */ ?>
	@endif

	<span class="form-status"></span>
	
	<div class="clear-fix"></div>
	
	
	
	<div class="action-bar">
		<a href="{{ route('dashboard') }}">{{ Lang::get('messages.cancel') }}</a>
		{{ Form::submit(Lang::get('messages.save')); }}
	</div>

{{ Form::close() }}

