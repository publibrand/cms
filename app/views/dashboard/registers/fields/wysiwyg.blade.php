<div class="form-group">
	{{ Form::label('fields['.$field['label'].']', $field['name']) }}
	{{ Form::textarea('fields['.$field['label'].']', !empty($metadatas[$field['label']]) ? $metadatas[$field['label']] : NULL, ['class' => 'field-wysiwyg']) }}
	<span class="form-message"></span>
</div>

