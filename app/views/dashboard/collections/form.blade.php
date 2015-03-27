@if(isset($collection))
	{{ Form::model($collection, ['route' => array('collections.update', $collection->id), 'method' => 'PUT', 'class' => 'ajax-form bar-form collection-form']) }}
@else
	{{ Form::open(['route' => 'collections.store', 'method' => 'POST', 'class' => 'ajax-form bar-form collection-form']) }}
@endif
	
	<div class="form-line">
		<div class="form-group form-float-label form-field-long">
			{{ Form::label('name', Lang::get('messages.name')) }}
			{{ Form::text('name', NULL, ['id' => 'name']) }}
			<span class="form-message"></span>
		</div>

		<div class="form-group form-float-label form-field-long">
			{{ Form::label('slug', 'Slug') }}
			{{ Form::text('slug', NULL, ['id' => 'slug']) }}
			<span class="form-message"></span>
		</div>

		<div class="form-group form-float-label form-field-short">
			{{ Form::label('max', 'Max.') }}
			{{ Form::text('max', -1) }}
			<span class="form-message"></span>
		</div>
	</div>
	
	
	
	<div class="fields-header">
		<h2>{{ Lang::get('messages.my_fields') }}</h2>
		@if(!isset($collection))
			{{ Form::select('copy_collection', $options, NULL, ['placeholder'=>'copiar de outra coleção']) }}
		@endif
	</div>
	
	
	<div class="form-fieldset single" >
		<div class="form-group form-float-label">
			{{ Form::label('regname', Lang::get('messages.register_name')) }}
			{{ Form::text('regname', Lang::get('messages.name'),['disabled' => 'disabled']) }}
			<span class="form-message"></span>
		</div>
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
	
	<div class="form-group form-float-label">
		
	</div>
	
	{{ Form::button(Lang::get('messages.add_field'), ['class' => 'add-field', 'data-field-number' => isset($fields) ? count((array) $fields) + 1 : 2]); }}

	<span class="form-status"></span>

	<div class="clear-fix"></div>
	
	<div class="action-bar">
		<a href="{{ route('collections') }}">{{ Lang::get('messages.cancel') }}</a>
		{{ Form::submit(Lang::get('messages.save')); }}
	</div>

{{ Form::close() }}
