	<div class="form-group">
		{{ Form::label('fields['.$field['label'].']', $field['name']) }}
		{{ Form::text('fields['.$field['label'].']') }}
		<span class="form-message"></span>
	</div>
