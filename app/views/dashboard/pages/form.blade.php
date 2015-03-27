@if(isset($collection))
	{{ Form::model($collection, ['route' => array('pages.update', $collection->id), 'method' => 'PUT', 'class' => 'ajax-form bar-form collection-form']) }}
@else
	{{ Form::open(['route' => 'pages.store', 'method' => 'POST', 'class' => 'ajax-form bar-form collection-form']) }}
@endif
	
	<div class="form-line">
		<div class="form-group form-float-label form-field-half">
			{{ Form::label('name', Lang::get('messages.name')) }}
			{{ Form::text('name', NULL, ['id' => 'name']) }}
			<span class="form-message"></span>
		</div>

		<div class="form-group form-float-label form-field-half">
			{{ Form::label('slug', 'Slug') }}
			{{ Form::text('slug', NULL, ['id' => 'slug']) }}
			<span class="form-message"></span>
		</div>

	</div>
	{{ Form::hidden('max', 1) }}
	
	
	
	<div class="fields-header">
		<h2>{{ Lang::get('messages.my_fields') }}</h2>
	</div>
	
	
	<div class="form-fieldset single" >
		<div class="form-group form-float-label fixed-label">
			{{ Form::label('bind_collections[]', 'Vínculo de Coleções') }}
			{{ Form::select('bind_collections[]', $options, (!empty($selected))?$selected:null, ['multiple'=>'multiple']) }}
			<span class="form-message"></span>
		</div>
	</div>

	<div class="form-fields">
		@if(isset($collection))
			@foreach($fields as $fieldNumber => $field)
				@include('dashboard.pages.field')
			@endforeach
		@else
			@include('dashboard.pages.field', ['fieldNumber' => 1])
		@endif
	</div>
	
	<div class="form-group form-float-label">
	</div>
	
	<div class="">
		{{ Form::button(Lang::get('messages.add_field'), ['class' => 'add-field', 'data-field-number' => isset($fields) ? count((array) $fields) + 1 : 2]); }}
	</div>
	

	<span class="form-status"></span>

	<div class="clear-fix"></div>
	
	<div class="action-bar">
		<a href="{{ route('pages') }}">{{ Lang::get('messages.cancel') }}</a>
		{{ Form::submit(Lang::get('messages.save')); }}
	</div>

{{ Form::close() }}
