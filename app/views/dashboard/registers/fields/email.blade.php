<div class="form-group">
	{{ Form::label('fields['.$field['label'].']', $field['name']) }}
	{{ Form::email('fields['.$field['label'].']', !empty($metadatas[$field['label']]) ? $metadatas[$field['label']] : NULL) }}
	<span class="form-message"></span>
</div>