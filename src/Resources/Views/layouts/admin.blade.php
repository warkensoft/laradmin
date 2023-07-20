<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('head_title') {{ config('app.name', 'Laravel') }}</title>

    <link href="/vendor/laradmin/Theme/styles.css" rel="stylesheet">
    @yield('head')

  </head>

  <body id="page-top">

    @include('laradmin::partials.header')

    <div id="wrapper">

      @include('laradmin::partials.sidebar')

      <div id="content-wrapper">

        <div class="container-fluid">

        @include('laradmin::partials.notifications')
        @yield('content')

          {{--<!-- Breadcrumbs-->--}}
          {{--<ol class="breadcrumb">--}}
            {{--<li class="breadcrumb-item">--}}
              {{--<a href="index.html">Dashboard</a>--}}
            {{--</li>--}}
            {{--<li class="breadcrumb-item active">Blank Page</li>--}}
          {{--</ol>--}}

          {{--<!-- Page Content -->--}}
          {{--<h1>Blank Page</h1>--}}
          {{--<hr>--}}
          {{--<p>This is a great starting point for new custom pages.</p>--}}

        </div>
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        <footer class="sticky-footer">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span>Copyright © {{ config('app.name', 'Laravel') }} {{ date('Y') }}</span>
            </div>
          </div>
        </footer>

      </div>
      <!-- /.content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

    <script src="/vendor/laradmin/Theme/scripts.js"></script>
    @yield('scripts')

  </body>

</html>
