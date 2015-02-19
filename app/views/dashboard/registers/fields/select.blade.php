	<div class="form-group">
		{{ Form::label('fields['.$field['label'].']', $field['name']) }}
		{{ Form::select('fields['.$field['label'].']', array_combine(explode(';',$field['options']), explode(';',$field['options'])), NULL) }}
		<span class="form-message"></span>
	</div>
