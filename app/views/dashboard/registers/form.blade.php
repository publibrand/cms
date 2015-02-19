@if(isset($register))
	{{ Form::model($register, ['route' => array('registers.update', $collection->slug , $register->id ), 'method' => 'PUT', 'files' => TRUE, 'class' => 'ajax-form']) }}
@else
	{{ Form::open(['route' => ['registers.store',$collection->slug], 'method' => 'POST', 'files' => TRUE, 'class' => 'ajax-form register-form']) }}
@endif

	<div class="form-group">
		{{ Form::label('name', 'Name') }}
		{{ Form::text('name') }}
		<span class="form-message"></span>
	</div>

@foreach($fields as $field)

	@include('dashboard.registers.fields.'.$field['type'])
	{{ Form::hidden('field_type['.$field['label'].']',$field['type']) }}

@endforeach

	<span class="form-status"></span>
	
	
	{{ Form::hidden('collections_id', $collection->id) }}
	{{ Form::submit('Save'); }}

{{ Form::close() }}

