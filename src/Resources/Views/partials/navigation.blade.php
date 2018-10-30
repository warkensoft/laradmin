<div class="col-lg-3">
    <div class="card shadow">
        <div class="card-header">Navigation</div>
        <div class="card-body">
            <ul class="nav flex-column nav-pills">

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs(config('laradmin.adminpath') . '.dashboard') ? 'active' : '' }}" href="{{ route(config('laradmin.adminpath') . '.dashboard') }}">Dashboard</a>
                </li>

                @foreach(config('laradmin.crudable') as $model => $parameters)
                    <li class="nav-item">
                        <a class="nav-link" class="{{ Laradmin::IsCurrentRoute($parameters) ? 'active' : '' }}"
                           href="{{ route(config('laradmin.adminpath') . '.' . $parameters['route'] . '.index') }}">{{ $parameters['nav_title'] }}</a>
                    </li>
                @endforeach

            </ul>
        </div>
    </div>

</div>