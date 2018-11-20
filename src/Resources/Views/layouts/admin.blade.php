<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('head_title') {{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap core CSS-->
    <link href="/vendor/laradmin/Theme/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="/vendor/laradmin/Theme/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="/vendor/laradmin/Theme/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="/vendor/laradmin/Theme/css/sb-admin.css" rel="stylesheet">

    <link href="/vendor/laradmin/Select2/select2.min.css" rel="stylesheet" />
    <link href="/vendor/laradmin/Summernote/summernote-bs4.css" rel="stylesheet"/>
    <link href="/vendor/laradmin/DateTimePicker/jquery.datetimepicker.min.css" rel="stylesheet"/>

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

    <!-- Bootstrap core JavaScript-->
    <script src="/vendor/laradmin/Theme/vendor/jquery/jquery.min.js"></script>
    <script src="/vendor/laradmin/Theme/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="/vendor/laradmin/Theme/vendor/jquery-easing/jquery.easing.min.js"></script>

    <script src="/vendor/laradmin/Theme/vendor/datatables/jquery.dataTables.js"></script>
    <script src="/vendor/laradmin/Theme/vendor/datatables/dataTables.bootstrap4.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="/vendor/laradmin/Theme/js/sb-admin.min.js"></script>

    <script src="/vendor/laradmin/Select2/select2.min.js"></script>
    <script src="/vendor/laradmin/Summernote/summernote-bs4.js"></script>
    <script src="/vendor/laradmin/DateTimePicker/jquery.datetimepicker.full.min.js"></script>

    @yield('scripts')

  </body>

</html>
