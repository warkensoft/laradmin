@extends( config('laradmin.layout') )

@section('content')

    @if ($message = session('status'))
        <x-laradmin::notification class="text-green-800 bg-green-100">
            {{ session('status') }}
        </x-laradmin::notification>
    @endif

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route( config('laradmin.adminpath') . '.dashboard' ) }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Overview</li>
    </ol>


    <div class="grid grid-cols-3 gap-4">

        @foreach(config('laradmin.crudable') as $model => $parameters)

            <a class="rounded-lg bg-indigo-200 p-8 relative overflow-hidden hover:underline hover:bg-indigo-800 hover:text-white"
               href="{{ route(config('laradmin.adminpath') . '.' . $parameters['route'] . '.index') }}">
                <i class="absolute right-[-5px] top-[-5px] text-6xl opacity-10 rotate-12 fas fa-fw {{ !empty($parameters['nav_icon']) ? $parameters['nav_icon'] : 'fa-file-alt' }}"></i>
                <p class="text-3xl">{{ $model::count() }} {{ $parameters['nav_title'] }}</p>
                <button>View List</button>
            </a>

        @endforeach

    </div>

@endsection