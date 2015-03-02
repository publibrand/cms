<div class="form-group">
	{{ Form::label('fields['.$field['label'].']', $field['name']) }}
	{{ Form::text('fields['.$field['label'].']', !empty($metadatas[$field['label']]) ? $metadatas[$field['label']] : NULL, ['class' => 'field-time']) }}
	<span class="form-message"></span>
</div>
