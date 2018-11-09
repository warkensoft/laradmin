<div class="form-group row">
    <label for="field-{{ $field->name }}" class="col-md-3 col-form-label text-md-right">{{ $field->label }}</label>

    <div class="col-md-9">
        <select name="{{ $field->name }}" id="field-{{ $field->name }}" class="form-control">
            <option value="">Select...</option>
            @foreach($field->related() as $relatedModel)
                <option value="{{ $relatedModel->{$field->relation['key']} }}"
                        {{ (old($field->name) ?: (isset($value) ? $value : '')) == $relatedModel->{$field->relation['key']} ? 'selected="selected"' : '' }}
                >{{ $relatedModel->{$field->relation['label']} }}</option>
            @endforeach
        </select>
        @if ($errors->has($field->name))
            <span class="invalid-feedback"><strong>{{ $errors->first($field->name) }}</strong></span>
        @endif
    </div>
</div>

@section('scripts')
    @parent
    <script>
			$(function () {
				$('#field-{{ $field->name }}').select2();
			});
    </script>
@endsection