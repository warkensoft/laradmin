<input id="field-{{ $field->name }}" type="hidden" class="form-control{{ $errors->has($field->name) ? ' is-invalid' : '' }}"
       name="{{ $field->name }}" {{ !empty($field->required) ? 'required' : '' }}
       value="{{ old($field->name) ?: (isset($value) ? $value : '') }}" {{ !empty($field->disabled) ? 'disabled' : '' }}>
