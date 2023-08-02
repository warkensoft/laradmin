<div class="form-group row">
    <label for="field-{{ $field->name }}" class="col-md-2 col-form-label text-md-right">{{ $field->label }}</label>

    <div class="col-md-10">
        <div class="row">
            <div class="col-md-8">
                <input id="field-{{ $field->name }}" type="text" class="form-control{{ $errors->has($field->name) ? ' is-invalid' : '' }}"
                       name="{{ $field->name }}" placeholder="{{ !empty($field->placeholder) ? $field->placeholder : '' }}" {{ !empty($field->required) ? 'required' : '' }}
                       value="{{ old($field->name) ?: (isset($value) ? $value : '') }}" {{ !empty($field->disabled) ? 'disabled' : '' }}>
            </div>
            <div class="col-md-4 text-right">
                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#uploadModal{{ $field->name }}">
                    Upload Image
                </button>
            </div>
                <div class="col-md-12 pt-2 preview-image-{{ $field->name }} {{ empty($value) ? 'd-none' : '' }}">
                    <img class="img-thumbnail" id="image-{{ $field->name }}" src='{{ empty($value) ? '' : $value }}' style="max-height: 250px; max-width:100%;" />
                </div>
        </div>
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
    <!-- Modal -->
    <div class="modal fade" id="uploadModal{{ $field->name }}" tabindex="-1" role="dialog" aria-labelledby="uploadModal{{ $field->name }}Label" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadModal{{ $field->name }}Label">Upload Image</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="fileinfo{{ $field->name }}" enctype="multipart/form-data" method="post" name="fileinfo{{ $field->name }}">
                        {{ csrf_field() }}
                        <input id="temp-field-{{ $field->name }}"
                               name="file" type="file"
                               class="form-control-file {{ $errors->has($field->name) ? ' is-invalid' : '' }}"
                               placeholder="{{ !empty($field->placeholder) ? $field->placeholder : '' }}"
                               {{ !empty($field->required) ? 'required' : '' }}
                               {{ !empty($field->disabled) ? 'disabled' : '' }} />
                    </form>
                    <div class="output" style="font-weight: bold; color: #dd0000;"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" data-fieldname="{{ $field->name }}">Upload</button>
                </div>
            </div>
        </div>
    </div>



    <script>
      $('#temp-field-{{ $field->name }}').change(function () {
				$('.output').html('');
      });
        $('#uploadModal{{ $field->name }} .btn-primary').click(function (element) {

        	var form =  $("#fileinfo{{ $field->name }}")[0];
            var fd = new FormData( form );
            var fieldname = $(this).data('fieldname');
            var has_image = {{ !empty($value) ? 'true' : 'false' }}
            $.ajax({
                url: '{{ route( config('laradmin.adminpath') . '.upload' ) }}',
                type: 'POST',
                data: fd,
                success:function(data)
                {
                	if( ! has_image )
                    {
                        has_image = true;
                        $('.preview-image-{{ $field->name }}').removeClass('d-none');
                    }

                    $('#field-' + fieldname).val(data);
                    $('#image-' + fieldname).attr('src', data);
                    $('#uploadModal{{ $field->name }}').modal('hide');
                },
                error:function(data)
                {
                	$('.output').html(data.responseJSON.errors.file[0]);
                },
                cache: false,
                contentType: false,
                processData: false
            });

        });
    </script>

@endsection