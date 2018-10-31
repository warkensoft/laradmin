<div class="form-group row">
    <label for="field-{{ $field->name }}" class="col-md-3 col-form-label text-md-right">{{ $field->label }}</label>

    <div class="col-md-9">
        <input id="field-{{ $field->name }}" type="text" class="form-control{{ $errors->has($field->name) ? ' is-invalid' : '' }}"
               name="{{ $field->name }}" placeholder="{{ !empty($field->placeholder) ? $field->placeholder : '' }}" {{ !empty($field->required) ? 'required' : '' }}
               value="{{ old($field->name) ?: (!empty($field->value) ? $field->value : $field->default) }}" {{ !empty($field->disabled) ? 'disabled' : '' }}>
        @if ($errors->has($field->name))
            <span class="invalid-feedback"><strong>{{ $errors->first($field->name) }}</strong></span>
        @endif
    </div>
</div>