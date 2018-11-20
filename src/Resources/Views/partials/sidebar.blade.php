
      <!-- Sidebar -->
      <ul class="sidebar navbar-nav">
        <li class="nav-item {{ request()->routeIs(config('laradmin.adminpath') . '.dashboard') ? 'active' : '' }}">
          <a class="nav-link"
             href="{{ route(config('laradmin.adminpath') . '.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
          </a>
        </li>

        @foreach(config('laradmin.crudable') as $model => $parameters)
        <li class="nav-item {{ Laradmin::IsCurrentRoute($parameters['route']) ? 'active' : '' }}">
          <a class="nav-link" href="{{ route(config('laradmin.adminpath') . '.' . $parameters['route'] . '.index') }}">
            <i class="fas fa-fw {{ !empty($parameters['nav_icon']) ? $parameters['nav_icon'] : 'fa-file-alt' }}"></i>
            <span>{{ $parameters['nav_title'] }}</span></a>
        </li>
        @endforeach
      </ul>