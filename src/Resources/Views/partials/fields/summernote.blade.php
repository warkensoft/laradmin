<div class="form-group row">
    <label for="field-{{ $field->name }}" class="col-md-3 col-form-label text-md-right">{{ $field->label }}</label>

    <div class="col-md-9">
        <textarea id="field-{{ $field->name }}" type="text" class="form-control summernote {{ $errors->has($field->name) ? 'is-invalid' : '' }} {{ !empty($field->class) ? $field->class : '' }}"
               name="{{ $field->name }}" placeholder="{{ !empty($field->placeholder) ? $field->placeholder : '' }}" {{ !empty($field->required) ? 'required' : '' }}
                {{ !empty($field->disabled) ? 'disabled' : '' }} rows="{{ !empty($rows) ? $rows : 6 }}">{{ old($field->name) ?: (isset($value) ? $value : '') }}</textarea>
        @if ($errors->has($field->name))
            <span class="invalid-feedback"><strong>{{ $errors->first($field->name) }}</strong></span>
        @endif
    </div>
</div>
@section('scripts')
    @parent
    <script>
        $(document).ready(function() {
            $('#field-{{ $field->name }}').summernote({
							placeholder: '{{ !empty($field->placeholder) ? addslashes($field->placeholder) : '' }}',
							height: 300
            });
        });
    </script>
@endsection