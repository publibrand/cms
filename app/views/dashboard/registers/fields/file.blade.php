	<div class="form-group form-float-label fixed-label">
		{{ Form::label('fields['.$field['label'].']', $field['name']) }}
		{{ Form::file('fields['.$field['label'].']') }}
		<span class="form-message"></span>
	</div>
