@extends( config('laradmin.layout') )

@section('content')
    <div class="card crudable shadow">
        <div class="card-header navbar navbar-light bg-light">
            <a class="navbar-brand">Create New {{ $crudable->singular }}</a>
            <a href="{{ route(config('laradmin.adminpath') . '.' . $crudable->route . '.index') }}" class="btn btn-sm btn-info float-right">Cancel</a>
        </div>

        <div class="card-body">

            <form method="POST"
                  action="{{ route(config('laradmin.adminpath') . '.' . $crudable->route . '.store') }}"
                  enctype="multipart/form-data">
                @csrf

                @foreach($crudable->fields() as $key=>$field)
                    @include($field->view(), compact('field'))
                @endforeach

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-3">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Save ' . $crudable->singular) }}
                        </button>
                    </div>
                </div>
            </form>

        </div>

    </div>
@endsection

@section('head')
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
@endsection

@section('scripts')
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>
@endsection
