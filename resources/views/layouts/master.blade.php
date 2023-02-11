<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Simonas - Dashboard</title>

  <!-- Custom fonts for this template-->
  <link href="{{asset('assets/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="{{asset('assets/css/sb-admin-2.min.css')}}" rel="stylesheet">

  <!-- ICONS -->
  <link rel="apple-touch-icon" sizes="76x76" href="{{asset('assets/img/apple-icon.png')}}">
  <link rel="icon" type="image/png" sizes="96x96" href="{{asset('assets/img/Favicon.png')}}">

  <!-- Custom styles for this page -->
  <!-- <link href="{{asset('assets/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet"> -->
  <link href="{{asset('assets/vendor/DataTables-1.10.24/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet">


</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    @include('layouts.includes._sidebar')
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        @include('layouts.includes._topbar')
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
        @yield('content')
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; <a href="https://www.gorontalo.bps.go.id" target="_blank">BPS Kabupaten Gorontalo</a>, 2021</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  @include('layouts.modal')

  <!-- Bootstrap core JavaScript-->
  <script src="{{asset('assets/vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script> -->

  <!-- Core plugin JavaScript-->
  <script src="{{asset('assets/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{asset('assets/js/sb-admin-2.min.js')}}"></script>

  <!-- Page level plugins -->
  <script src="{{asset('assets/vendor/chart.js/Chart.min.js')}}"></script>

  <!-- Page level custom scripts -->
{{--   <script src="{{asset('assets/js/demo/chart-area-demo.js')}}"></script>
  <script src="{{asset('assets/js/demo/chart-pie-demo.js')}}"></script>
 --}}
  <!-- Page level plugins -->
  <!-- <script src="{{asset('assets/vendor/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('assets/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
 -->
  <script type="text/javascript" src="{{asset('assets/vendor/DataTables-1.10.24/js/jquery.dataTables.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('assets/vendor/DataTables-1.10.24/js/dataTables.bootstrap4.min.js')}}"></script>

  <!-- Page level custom scripts -->
  <script src="{{asset('assets/js/demo/datatables-demo.js')}}"></script>

  <!-- Page level Sweet Allert scripts -->
  @include('sweetalert::alert')

  @stack('scripts')

</body>

</html>
