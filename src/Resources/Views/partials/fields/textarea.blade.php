<div class="form-group row">
    <label for="field-{{ $field }}" class="col-md-3 col-form-label text-md-right">{{ $label }}</label>

    <div class="col-md-9">
        <textarea id="field-{{ $field }}" type="text" class="form-control{{ $errors->has($field) ? ' is-invalid' : '' }}" {{ !empty($disabled) ? 'disabled' : '' }}
                  name="{{ $field }}" placeholder="{{ $placeholder }}" rows="{{ !empty($rows) ? $rows : 6 }}"
                {{ !empty($required) ? 'required' : '' }}>{{ old($field) ?: !empty($value) ? $value : $default }}</textarea>

        @if ($errors->has($field))
            <span class="invalid-feedback"><strong>{{ $errors->first($field) }}</strong></span>
        @endif
    </div>
</div>