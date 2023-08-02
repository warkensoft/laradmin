<div class="form-group row">
    <label for="field-{{ $field->name }}" class="col-md-2 col-form-label text-md-right">{{ $field->label }}</label>

    <div class="col-md-10">
        <select name="{{ $field->name }}" id="field-{{ $field->name }}" class="form-control">
            <option value="">Select...</option>
            @foreach($field->options as $option_key=>$option_value)
                <option value="{{ $option_key }}"
                        {{ (old($field->name) ?: (isset($value) ? $value : '')) == $option_key ? 'selected="selected"' : '' }}
                >{{ $option_value }}</option>
            @endforeach
        </select>
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
				if ($.fn.select2) {
                    $('#field-{{ $field->name }}').select2();
				}
			});
    </script>
@endsection