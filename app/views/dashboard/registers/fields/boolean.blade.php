<div class="form-group">
	<div>
		{{ $field['name'] }}
	</div>

	{{ Form::hidden('fields['.$field['label'].']', 0) }}
	{{ Form::checkbox('fields['.$field['label'].']', 1, !empty($metadatas[$field['label']]) && $metadatas[$field['label']] == 1 ? TRUE : FALSE, ['id' => 'fields['.$field['label'].']']) }}
	{{ Form::label('fields['.$field['label'].']', "Yes") }}

	<span class="form-message"></span>
</div>
