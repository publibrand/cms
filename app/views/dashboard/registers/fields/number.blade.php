<div class="form-group form-float-label">
	{{ Form::label('fields['.$field['label'].']', $field['name']) }}
	{{ Form::text('fields['.$field['label'].']', !empty($metadatas[$field['label']]) ? $metadatas[$field['label']] : NULL, ['class' => 'field-number']) }}
	<span class="form-message"></span>
</div>
