@extends( config('laradmin.layout') )

@section('content')
    <div class="card crudable shadow">
        <div class="card-header navbar navbar-light bg-light">
            <a class="navbar-brand">{{ $model::Crudable()->nav_title }} Index</a>

            <form class="form-inline" method="GET" action="{{ route('admin.' . $model::Crudable()->route . '.index') }}">
                <input class="form-control form-control-sm" type="search" placeholder="Search"
                       aria-label="Search" name="search" value="{{ request()->get('search') }}" {!! request()->has('search') ? 'style="background-color: #fffc83;"' : ''  !!}>
                <button class="btn btn-outline-success btn-sm" type="submit">Go</button>
            </form>

            <a href="{{ route('admin.' . $model::Crudable()->route . '.create') }}" class="nav-item btn btn-sm btn-success ">Create New {{ $model::Crudable()->singular }}</a>

        </div>

        <table class="table table-hover">
            <tr>
                @foreach($model::Crudable()->index as $field=>$label)
                    <th><a href="{{ route('admin.' . $model::Crudable()->route . '.index', ['sort'=>$field, 'dir'=>(request()->get('dir') == 'asc' ? 'desc' : 'asc')]+request()->all()) }}">{{ $label }}</a></th>
                @endforeach
                <th style="text-align: right; width:125px;">Actions</th>
            </tr>

            @foreach($entries as $entry)
                <tr>
                    @foreach($model::Crudable()->index as $field=>$label)
                        <td>{{ \App\Services\Crudable::FieldValue($entry, $field) }}</td>
                    @endforeach

                    <td style="text-align: right;">
                        <a href="{{ route('admin.' . $model::Crudable()->route . '.edit', $entry->id) }}"
                           class="btn btn-sm btn-warning">Edit</a>

                        <form class="delete-form" method="POST" style="display: inline"
                              action="{{ route('admin.' . $model::Crudable()->route . '.destroy', $entry->id) }}"
                              onsubmit="return confirm('Please confirm that you wish to delete this {{ $model::Crudable()->singular }}');">
                            @csrf
                            <input type="hidden" name="_method" value="DELETE" />
                            <input type="submit" class="btn btn-sm btn-danger" value="Delete" />
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>

        <div>
            {{ $entries->links() }}
        </div>

    </div>
@endsection


