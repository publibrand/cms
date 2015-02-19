@if(isset($collection))
	{{ Form::model($collection, ['route' => array('collections.update', $collection->id), 'method' => 'PUT', 'class' => 'ajax-form collection-form']) }}
@else
	{{ Form::open(['route' => 'collections.store', 'method' => 'POST', 'class' => 'ajax-form collection-form']) }}
@endif
	
	<div class="form-group">
		{{ Form::label('name', 'Name') }}
		{{ Form::text('name', NULL, ['id' => 'name']) }}
		<span class="form-message"></span>
	</div>

	<div class="form-group">
		{{ Form::label('slug', 'Slug') }}
		{{ Form::text('slug', NULL, ['id' => 'slug']) }}
		<span class="form-message"></span>
	</div>

	<div class="form-group">
		{{ Form::label('max', 'Max registers') }}
		{{ Form::text('max', -1) }}
		<span class="form-message"></span>
	</div>

	<div class="form-fields">
		@if(isset($collection))
			@foreach($fields as $fieldNumber => $field)
				@include('dashboard.collections.field')
			@endforeach
		@else
			@include('dashboard.collections.field', ['fieldNumber' => 1])
		@endif
	</div>
	
	<div class="form-group">
		{{ Form::button('Add field', ['class' => 'add-field', 'data-field-number' => isset($fields) ? count((array) $fields) + 1 : 2]); }}
	</div>

	<span class="form-status"></span>
	
	{{ Form::submit('Save'); }}

{{ Form::close() }}

