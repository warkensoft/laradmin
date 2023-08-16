<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('head_title') {{ config('app.name', 'Laravel') }}</title>

    <link href="{{ Laradmin::HashedPath('/vendor/laradmin/Theme/styles.css') }}" rel="stylesheet">
    @yield('head')

  </head>

  <body id="page-top" class="min-h-screen flex flex-col">

    @include('laradmin::partials.header')

    <div class="grow flex w-full">

      @include('laradmin::partials.sidebar')

      <div class="page-content grow relative">

        <div class="p-4 mb-12">

        @include('laradmin::partials.notifications')
        @yield('content')

        </div>
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        <footer class="absolute w-full bottom-0 text-center p-4 bg-gray-700 text-white">
          Copyright © {{ config('app.name', 'Laravel') }} {{ date('Y') }}
        </footer>

      </div>
      <!-- /.content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

    <script src="{{ Laradmin::HashedPath('/vendor/laradmin/Theme/scripts.js') }}"></script>
    @yield('scripts')

  </body>

</html>
