<hr/>
<div class="form-field">
	<div class="form-group">
		{{ Form::label("fields[" . $fieldNumber . "][name]", "Field name") }}
		{{ Form::text("fields[" . $fieldNumber . "][name]") }}
		<span class="form-message"></span>
	</div>

	<div class="form-group">
		{{ Form::label("fields[" . $fieldNumber . "][type]", "Field type") }}
		{{ Form::select("fields[" . $fieldNumber . "][type]", Collection::$fields, NULL, ["class" => "collection-type"]) }}
		<span class="form-message"></span>
	</div>

	<div class="form-group">
		{{ Form::label("fields[" . $fieldNumber . "][label]", "Field label") }}
		{{ Form::text("fields[" . $fieldNumber . "][label]") }}
		<span class="form-message"></span>
	</div>

	<div class="form-group">
		{{ Form::label("fields[" . $fieldNumber . "][value]", "Default value") }}
		{{ Form::text("fields[" . $fieldNumber . "][value]") }}
		<span class="form-message"></span>
	</div>

	<div class="form-group">
		{{ Form::label("fields[" . $fieldNumber . "][required]", "Required") }}
		{{ Form::checkbox("fields[" . $fieldNumber . "][required]") }}
		<span class="form-message"></span>
	</div>

	<div class="form-group collection-options">
		{{ Form::label("fields[" . $fieldNumber . "][options]", "Options") }}
		{{ Form::text("fields[" . $fieldNumber . "][options]") }}
		<span class="form-message"></span>
	</div>
</div>
<hr/>