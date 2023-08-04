<div class="flex flex-col w-1/6 bg-gray-800 p-4 text-gray-400 text-lg gap-6">
    <a href="{{ route(config('laradmin.adminpath') . '.dashboard') }}"
       class="hover:text-white {{ request()->routeIs(config('laradmin.adminpath') . '.dashboard') ? 'text-white' : '' }}">
        <i class="fas fa-fw fa-tachometer-alt"></i> Dashboard</a>
    @foreach(config('laradmin.crudable') as $model => $parameters)
        <a href="{{ route(config('laradmin.adminpath') . '.' . $parameters['route'] . '.index') }}"
           class="hover:text-white {{ Laradmin::IsCurrentRoute($parameters['route']) ? 'text-white' : '' }}">
            <i class="fas fa-fw {{ !empty($parameters['nav_icon']) ? $parameters['nav_icon'] : 'fa-file-alt' }}"></i>
            {{ $parameters['nav_title'] }}
        </a>
    @endforeach
</div>