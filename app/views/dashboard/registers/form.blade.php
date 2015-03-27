@if(isset($register))
	{{ Form::model($register, ['route' => array('registers.update', $collection->slug , $register->id ), 'method' => 'PUT', 'files' => TRUE, 'class' => 'ajax-form bar-form register-form']) }}
@else
	{{ Form::open(['route' => ['registers.store',$collection->slug], 'method' => 'POST', 'files' => TRUE, 'class' => 'ajax-form bar-form register-form']) }}
@endif

@if($collection->max != 1)
	<div class="form-group form-float-label" >
		{{ Form::label('name', Lang::get('messages.name')) }}
		{{ Form::text('name') }}
		<span class="form-message"></span>
	</div>
@else
	{{ Form::hidden('name',$collection->name) }}
@endif

@foreach($fields as $field)

	@include('dashboard.registers.fields.'.$field['type'])
	{{ Form::hidden('field_type['.$field['label'].']',$field['type']) }}

@endforeach



	<span class="form-status"></span>
	{{ Form::hidden('collections_id', $collection->id) }}
	{{ Form::hidden('add_new', 0) }}
	
	<div class="clear-fix"></div>
	
	<div class="action-bar">

		@if($collection->max != 1)
			<a href="{{ route('registers', $collection->slug) }}">{{ Lang::get('messages.cancel') }}</a>
		@else
			<a href="{{ route('dashboard') }}">{{ Lang::get('messages.cancel') }}</a>
		@endif
		
		@if($collection->max != 1)
			<a href="javascript:;" class="save-create">{{ Lang::get('messages.save_create') }}</a>
		@endif
		
		{{ Form::submit(Lang::get('messages.save')); }}
	</div>

{{ Form::close() }}
