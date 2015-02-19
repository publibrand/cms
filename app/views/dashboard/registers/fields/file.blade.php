	<div class="form-group">
		{{ Form::label('fields['.$field['label'].']', $field['name']) }}
		{{ Form::file('fields['.$field['label'].']') }}
		<span class="form-message"></span>
	</div>
