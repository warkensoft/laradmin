<div class="form-group row">
    <label for="field-{{ $field->name }}" class="col-md-2 col-form-label text-md-right">{{ $field->label }}</label>
    <div class="col-md-10">
        <input id="field-{{ $field->name }}" type="text" class="form-control{{ $errors->has($field->name) ? ' is-invalid' : '' }}"
               name="{{ $field->name }}" placeholder="{{ $field->placeholder ?: '' }}" {{ !empty($field->required) ? 'required' : '' }}
               value="{{ old($field->name) ?: (isset($value) ? $value : '') }}" {{ !empty($field->disabled) ? 'disabled' : '' }}>
        @if($field->help)
            <div class="help-text" style="padding: 6px 12px; color:#555;">{{ $field->help }}</div>
        @endif
        @if ($errors->has($field->name))
            <span class="invalid-feedback"><strong>{{ $errors->first($field->name) }}</strong></span>
        @endif
    </div>
</div>

@section('scripts')
    @parent
    <script>
        $(document).ready(function () {
            if ($.fn.datetimepicker) {
                jQuery('#field-{{ $field->name }}').datetimepicker({
                    format: 'Y-m-d H:i:s',
                });
            }
        });
    </script>
@endsection
