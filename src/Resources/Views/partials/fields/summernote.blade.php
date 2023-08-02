<div class="form-group row">
    <label for="field-{{ $field->name }}" class="col-md-2 col-form-label text-md-right">{{ $field->label }}</label>

    <div class="col-md-10">
        <textarea id="field-{{ $field->name }}" type="text" class="form-control summernote {{ $errors->has($field->name) ? 'is-invalid' : '' }} {{ !empty($field->class) ? $field->class : '' }}"
               name="{{ $field->name }}" placeholder="{{ $field->placeholder ?: '' }}" {{ !empty($field->required) ? 'required' : '' }}
                {{ !empty($field->disabled) ? 'disabled' : '' }} rows="{{ !empty($rows) ? $rows : 6 }}">{{ old($field->name) ?: (isset($value) ? $value : '') }}</textarea>
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
			$(document).ready(function() {
				if ($.fn.summernote) {
					$('#field-{{ $field->name }}').summernote({
						placeholder: '{{ $field->placeholder ? addslashes($field->placeholder) : '' }}',
						height: 300,
						callbacks: {
							onImageUpload: function(files)
							{
								var $editor = $(this);
								var data = new FormData();
								data.append('file', files[0]);
								data.append('_token', '{{ csrf_token() }}');
								$.ajax({
									url: "{{ route( config('laradmin.adminpath') . '.upload' ) }}",
									method: 'POST',
									data: data,
									processData: false,
									contentType: false,
									success: function(response) {
										$editor.summernote('insertImage', response);
									},
									error:function(data)
									{
										alert(data.responseJSON.errors.file[0]);
									},
								});
							},
							onImageUploadError: null
						}
					});
				}
			});
    </script>
@endsection
