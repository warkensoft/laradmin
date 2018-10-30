<div class="form-group row">
    <label for="field-{{ $field }}" class="col-md-3 col-form-label text-md-right">{{ $label }}</label>

    <div class="col-md-9">

        <select id="field-{{ $field }}" name="{{ $field }}" class="form-control{{ $errors->has($field) ? ' is-invalid' : '' }}" {{ !empty($disabled) ? 'disabled' : '' }}>
            <option value="">Select...</option>
            @foreach($relation['model']::all() as $related)
                <option value="{{ $related->{$relation['key']} }}"
                        {{ $modelInstance->$field == $related->{$relation['key']} ? 'selected="selected"' : '' }}>{{ $related->{$relation['label']} }}</option>
            @endforeach
        </select>

    </div>
</div>