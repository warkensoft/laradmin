<div class="col-lg-3">
    <div class="card shadow">
        <div class="card-header">Navigation</div>
        <div class="card-body">
            <ul class="nav flex-column nav-pills">

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">Dashboard</a>
                </li>

                @foreach(config('cms.crudable') as $model)
                    <li class="nav-item">
                        <a class="nav-link {{ $model::Crudable()->IsCurrentRoute() ? 'active' : '' }}"
                           href="{{ route('admin.' . $model::Crudable()->route . '.index') }}">{{ $model::Crudable()->nav_title }}</a>
                    </li>
                @endforeach

            </ul>
        </div>
    </div>

</div>