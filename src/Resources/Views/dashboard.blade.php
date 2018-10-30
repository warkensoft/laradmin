@extends( config('laradmin.layout') )

@section('content')
    <div class="card shadow">
        <div class="card-header">Dashboard</div>

        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            You are logged in!
        </div>
    </div>
@endsection
