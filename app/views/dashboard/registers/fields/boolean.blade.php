<div class="form-group form-float-label field-boolean">
	<span class="boolean-title">
		{{ $field['name'] }}
	</span>

	{{ Form::hidden('fields['.$field['label'].']', 0) }}
	{{ Form::checkbox('fields['.$field['label'].']', 1, !empty($metadatas[$field['label']]) && $metadatas[$field['label']] == 1 ? TRUE : FALSE, ['id' => 'fields['.$field['label'].']']) }}
	{{ Form::label('fields['.$field['label'].']', "Activate") }}

	<span class="form-message"></span>
</div>
