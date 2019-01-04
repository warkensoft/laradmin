<div class="form-group row">
    <label for="field-{{ $field->name }}" class="col-md-2 col-form-label text-md-right">{{ $field->label }}</label>

    <div class="col-md-10">
        <select name="{{ $field->name }}[]" id="field-{{ $field->name }}" class="form-control" multiple="multiple">
            <option value="">Select...</option>
            @foreach($field->related() as $relatedModel)
                @if($relatedId = $relatedModel->{$field->relation['key']})
                <option value="{{ $relatedId }}"
                        {{ in_array($relatedId, (is_array($value) ? $value : [])) ? 'selected="selected"' : '' }}
                >{{ $relatedModel->{$field->relation['label']} }}</option>
                @endif
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
			$(document).ready(function () {
				if ($.fn.select2) {
					$('#field-{{ $field->name }}').select2();
				}
			});
    </script>
@endsection