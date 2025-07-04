@extends( config('laradmin.layout') )

@section('content')

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route( config('laradmin.adminpath') . '.dashboard' ) }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route(config('laradmin.adminpath') . '.' . $crudable->route . '.index') }}">{{ $crudable->nav_title }}</a>
        </li>
        <li class="breadcrumb-item active">Create {{ $crudable->singular }}</li>
    </ol>

    <div class="card mb-3 crudable">
        <div class="card-header navbar navbar-light bg-light">
            <div class="navbar-brand">Create New {{ $crudable->singular }}</div>
            <a href="{{ route(config('laradmin.adminpath') . '.' . $crudable->route . '.index') }}" class="btn btn-sm btn-info float-right">Cancel</a>
        </div>

        <div class="card-body">

            <form method="POST"
                  action="{{ route(config('laradmin.adminpath') . '.' . $crudable->route . '.store') }}"
                  enctype="multipart/form-data">
                @csrf

                @foreach($crudable->fields() as $key=>$field)
                    @include($field->view(), ['field'=>$field, 'value'=>$crudable->findValueFor($field->name)])
                @endforeach

                <div class="form-group row mb-0 flex gap-8">
                    <label class="col-md-2">&nbsp;</label>
                    <div class="col-md-10 flex flex-row gap-8 items-center">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Save ' . $crudable->singular) }}
                        </button>
                        <label class="flex flex-row items-center gap-2 text-md">
                            <input type="checkbox" name="_return_after_save" value="true"
                                   {{ session()->get('should_return_after_save_' . $crudable->route, false) ? 'checked' : '' }}
                                   class="!h-6 !w-6"  />
                            Return after save
                        </label>
                    </div>
                </div>
            </form>

        </div>

    </div>
@endsection