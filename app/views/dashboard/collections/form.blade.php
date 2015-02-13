@if(isset($collection))
	{{ Form::model($collection, ['route' => array('collections.update', $collection->id), 'method' => 'PUT', 'class' => 'ajax-form']) }}
@else
	{{ Form::open(['route' => 'collections.store', 'method' => 'POST', 'class' => 'ajax-form collection-form']) }}
@endif
	
	<div class="form-group">
		{{ Form::label('name', 'Name') }}
		{{ Form::text('name') }}
		<span class="form-message"></span>
	</div>

	<div class="form-group">
		{{ Form::label('max', 'Max registers') }}
		{{ Form::text('max', -1) }}
		<span class="form-message"></span>
	</div>

	<div class="form-fields">
		@if(isset($collection))
			
		@endif
	</div>
	
	<div class="form-group">
		{{ Form::button('Add field', ['class' => 'add-field', 'data-field-number' => 1]); }}
	</div>

	<span class="form-status"></span>
	
	{{ Form::submit('Save'); }}

{{ Form::close() }}

