
<div class="form-fieldset">
	<div class="form-group form-float-label">
		{{ Form::label("fields[" . $fieldNumber . "][name]", Lang::get('messages.field_name')) }}
		{{ Form::text("fields[" . $fieldNumber . "][name]", !empty($field->name) ? $field->name : NULL, ['class' => 'field-name']) }}
		<span class="form-message"></span>
	</div>

	<div class="form-group form-float-label">
		{{ Form::label("fields[" . $fieldNumber . "][type]", Lang::get('messages.field_type')) }}
		{{ Form::select("fields[" . $fieldNumber . "][type]", Collection::$fields, !empty($field->type) ? $field->type : NULL, ["class" => "collection-type"]) }}
		<span class="form-message"></span>
	</div>

	<div class="form-group form-float-label">
		{{ Form::label("fields[" . $fieldNumber . "][label]", Lang::get('messages.field_label')) }}
		{{ Form::text("fields[" . $fieldNumber . "][label]", !empty($field->label) ? $field->label : NULL, ['class' => 'field-label']) }}
		<span class="form-message"></span>
	</div>

	<div class="form-group form-float-label">
		{{ Form::label("fields[" . $fieldNumber . "][value]", Lang::get('messages.default_value')) }}
		{{ Form::text("fields[" . $fieldNumber . "][value]", !empty($field->value) ? $field->value : NULL) }}
		<span class="form-message"></span>
	</div>

	<div class="form-group form-float-label collection-options {{ !empty($field->options) ? 'show' : NULL }}">
		{{ Form::label("fields[" . $fieldNumber . "][options]", Lang::get('messages.options')) }}
		{{ Form::text("fields[" . $fieldNumber . "][options]", !empty($field->options) ? $field->options : NULL) }}
		<span class="form-message"></span>
	</div>

	<div class="form-group form-float-label field-boolean">
		{{ Form::label("fields[" . $fieldNumber . "][required]", Lang::get('messages.required')) }}
		{{ Form::checkbox("fields[" . $fieldNumber . "][required]", 1, !empty($field->required) ? $field->required : NULL) }}
		<span class="form-message"></span>
	</div>

	@if($fieldNumber > 1)
		<div class="form-group">
			{{ Form::button('Remove field', ['class' => 'remove-field', 'data-field-number' => $fieldNumber]); }}
		</div>
	@endif
</div>
