@extends('layouts.admin')

@section('content')
    <div class="card crudable shadow">
        <div class="card-header navbar navbar-light bg-light">
            <a class="navbar-brand">Edit {{ $modelName::Crudable()->singular }}
            <a href="{{ route('admin.' . $modelName::Crudable()->route . '.index') }}" class="btn btn-sm btn-info float-right">Cancel</a>
        </div>

        <div class="card-body">

            <form method="POST" action="{{ route('admin.' . $modelName::Crudable()->route . '.update', $modelInstance->id) }}">
                @csrf
                @method('PUT')

                @foreach($modelName::Crudable()->fields as $key=>$data)
                    @include('admin.partials.fields.' . $data['type'], $data+['value'=>$modelInstance->{$data['field']}])
                @endforeach

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-3">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Save ' . $modelName::Crudable()->singular) }}
                        </button>
                    </div>
                </div>
            </form>

        </div>

    </div>
@endsection


