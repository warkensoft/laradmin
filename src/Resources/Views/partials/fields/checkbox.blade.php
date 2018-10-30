<div class="form-group row">
    <label for="field-{{ $field }}" class="col-md-3 col-form-label text-md-right">{{ $label }}</label>

    <div class="col-md-9">

        <input type="checkbox" name="{{ $field }}"
               value="true" {{ !empty($disabled) ? 'disabled' : '' }}
                {{ !empty($value) ? 'checked' : '' }} />

    </div>
</div>