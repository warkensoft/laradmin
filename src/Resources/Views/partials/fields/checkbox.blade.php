<div class="form-group row">
    <div class="col-md-9 offset-md-3">

        <div class="form-check">
            <input type="hidden" name="{{ $field->name }}" value="0" />
            <input class="form-check-input" type="checkbox" id="checkbox-{{ $field->name }}"
                   name="{{ $field->name }}"
                   value="{{ !empty($field->default) ? $field->default : '1' }}"
                    {{ !empty($value) ? 'checked' : '' }}
            />
            <label class="form-check-label" for="checkbox-{{ $field->name }}">
                {{ $field->label }}
            </label>
        </div>

    </div>
</div>