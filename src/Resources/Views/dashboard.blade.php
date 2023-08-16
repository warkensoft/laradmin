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


    <div class="grid grid-cols-2 gap-4">

        @foreach(config('laradmin.crudable') as $model => $parameters)
            @if( !empty($parameters['dashboard-widget']) )

            <x-laradmin::dashboard-widget :model="$model" :parameters="$parameters" />

            @endif
        @endforeach

    </div>

@endsection