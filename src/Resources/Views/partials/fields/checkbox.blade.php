<div class="form-group row">
    <label class="col-md-2 col-form-label text-md-right">&nbsp;</label>
    <div class="col-md-10 offset-md-2">
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
        @if($field->help)
            <div class="help-text" style="padding: 6px 12px; color:#555;">{{ $field->help }}</div>
        @endif

    </div>
</div>