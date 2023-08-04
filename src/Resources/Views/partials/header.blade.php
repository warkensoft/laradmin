
    <nav class="flex pl-4 pr-8 py-4 bg-gray-700 sticky top-0 justify-between gap-4 z-50">

      <a class="text-white text-xl mr-1" href="{{ route( config('laradmin.adminpath') . '.dashboard' ) }}"><i class="fa-solid fa-screwdriver-wrench"></i> {{ config('app.name', 'Laravel') }}</a>

        <div class="flex gap-6 text-gray-300">
            <a href="/" class="hover:text-white" target="_blank"><em class="fa fa-home"></em> View Site</a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="cursor-pointer hover:text-white"
                        type="submit"><em class="fa fa-right-from-bracket"></em> Logout</button>
            </form>
        </div>

    </nav>