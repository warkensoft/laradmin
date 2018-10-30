@extends( config('laradmin.layout') )

@section('content')
    <div class="card crudable shadow">
        <div class="card-header navbar navbar-light bg-light">
            <a class="navbar-brand">Create New {{ $crudable->singular }}</a>
            <a href="{{ route(config('laradmin.adminpath') . '.' . $crudable->route . '.index') }}" class="btn btn-sm btn-info float-right">Cancel</a>
        </div>

        <div class="card-body">

            <form method="POST" action="{{ route(config('laradmin.adminpath') . '.' . $crudable->route . '.store') }}">
                @csrf

                @foreach($crudable->fields as $key=>$data)
                    @include('laradmin::partials.fields.' . $data['type'], $data)
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


