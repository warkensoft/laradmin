<div class="form-group row">
    <label for="field-{{ $field }}" class="col-md-3 col-form-label text-md-right">{{ $label }}</label>

    <div class="col-md-9">
        <input id="field-{{ $field }}" type="password" class="form-control{{ $errors->has($field) ? ' is-invalid' : '' }}"
               name="{{ $field }}" placeholder="{{ $placeholder }}" {{ !empty($required) ? 'required' : '' }}
               value="" {{ !empty($disabled) ? 'disabled' : '' }}>
        @if ($errors->has($field))
            <span class="invalid-feedback"><strong>{{ $errors->first($field) }}</strong></span>
        @endif
    </div>
</div>