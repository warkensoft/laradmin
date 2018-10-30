<div class="form-group row">
    <label for="field-{{ $field }}" class="col-md-3 col-form-label text-md-right">{{ $label }}</label>

    <div class="col-md-9">

        @foreach($relation['model']::all() as $related)
            <input type="checkbox" name="{{ $field }}[]"
                   value="{{ $related->{$relation['key']} }}" {{ !empty($disabled) ? 'disabled' : '' }}
                   {{ $modelInstance->$field->keyBy($relation['key'])->has($related->{$relation['key']}) ? 'checked' : '' }} />
            {{ $related->{$relation['label']} }}<br/>
        @endforeach

    </div>
</div>