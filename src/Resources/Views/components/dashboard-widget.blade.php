<div class="w-full border border-solid border-slate-700 rounded p-4">

    <div class="flex justify-between">
        <a class="block navbar-brand hover:underline"
           href="{{ route(config('laradmin.adminpath') . '.' . $parameters['route'] . '.index') }}">
            <em class="text-slate-500 fas fa-fw {{ !empty($parameters['nav_icon']) ? $parameters['nav_icon'] : 'fa-file-alt' }}"></em>
            {{ $model::count() }} {{ $parameters['nav_title'] }}</a>

        <a class="btn btn-sm border-slate-700 text-slate-700 hover:text-white hover:bg-green-800 hover:border-green-800"
           href="{{ route(config('laradmin.adminpath') . '.' . $parameters['route'] . '.create') }}">New {{ $parameters['singular'] }}</a>
    </div>

    <table class="table table-hover mt-4 text-sm">
        @foreach( $model::query()->orderBy($parameters['sort']['key'], $parameters['sort']['dir'])->take(5)->get() as $row )
        <tr class="hover:bg-gray-200">
            @foreach( $parameters['dashboard-widget'] as $fieldname )
                <td>
                    @if( is_a($row->$fieldname, \Carbon\Carbon::class) )
                        {{ $row->$fieldname->format('Y-m-d') }}
                    @else
                        {{ $row->$fieldname }}
                    @endif
                </td>
            @endforeach
            <td>
                <a href="{{ route(config('laradmin.adminpath') . '.' . $parameters['route'] . '.edit', $row->id) }}"
                   class="hover:text-yellow-700">
                    <em class="fa fa-edit"></em>
                </a>
            </td>
        </tr>
        @endforeach
    </table>

</div>

