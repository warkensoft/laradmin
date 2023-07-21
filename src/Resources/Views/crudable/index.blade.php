@extends( config('laradmin.layout') )

@section('content')

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route( config('laradmin.adminpath') . '.dashboard' ) }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">{{ $crudable->nav_title }}</li>
    </ol>


    <div class="card mb-3 crudable">
        <div class="card-header navbar navbar-light bg-light">

            <a class="navbar-brand"><i class="fas {{ $crudable->nav_icon ?: 'fa-file-alt' }}"></i> {{ $crudable->nav_title }} Index</a>

            <form class="form-inline" method="GET" action="{{ route(config('laradmin.adminpath') . '.' . $crudable->route . '.index') }}">
                <input class="form-control form-control-sm" type="search" placeholder="Search"
                       aria-label="Search" name="search" value="{{ request()->get('search') }}" {!! request()->has('search') ? 'style="background-color: #fffc83;"' : ''  !!}>
                <button class="btn btn-outline-success btn-sm" type="submit">Go</button>
            </form>

            <a href="{{ route(config('laradmin.adminpath') . '.' . $crudable->route . '.create') }}" class="nav-item btn btn-sm btn-success ">Create New {{ $crudable->singular }}</a>

        </div>

        <div class="table-responsive">
        <table class="table table-hover">
            <tr>
                @foreach($crudable->index as $field=>$label)
                    <th><a href="{{ route(config('laradmin.adminpath') . '.' . $crudable->route . '.index', ['sort'=>$field, 'dir'=>(request()->get('dir') == 'asc' ? 'desc' : 'asc')]+request()->all()) }}">{{ $label }}</a></th>
                @endforeach
                <th style="text-align: right; width:10rem;">Actions</th>
            </tr>

            @foreach($entries as $entry)
                <tr>
                    @foreach($crudable->index as $fieldname=>$label)
                        <td>
                            @if( $field = $crudable->field($fieldname) )
                                {{ $field->presentationValue($entry) }}
                            @else
                                {{ $entry->$fieldname }}
                            @endif
                        </td>
                    @endforeach

                    <td style="text-align: right;">
                        <a href="{{ route(config('laradmin.adminpath') . '.' . $crudable->route . '.edit', $entry->id) }}"
                           class="btn btn-sm btn-warning">Edit</a>

                        <form class="delete-form" method="POST" style="display: inline"
                              action="{{ route(config('laradmin.adminpath') . '.' . $crudable->route . '.destroy', $entry->id) }}"
                              onsubmit="return confirm('Please confirm that you wish to delete this {{ $crudable->singular }}');">
                            @csrf
                            <input type="hidden" name="_method" value="DELETE" />
                            <input type="submit" class="btn btn-sm btn-danger" value="Delete" />
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
        </div>

        <div class="text-center">
            {{ $entries->links('laradmin::partials.bootstrap-4-pagination') }}
        </div>

    </div>
@endsection

@section('head')
    <style>
        .text-center .pagination {
            justify-content: center;
        }
    </style>
@endsection
