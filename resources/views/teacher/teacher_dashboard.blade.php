<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>Tawana Techonology Center</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="" name="keywords" />
    <meta content="" name="description" />
<!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <!-- my style  -->
    <link rel="stylesheet" href="{{ asset('backend/assets/css/mystyle.css') }}" />
    <!-- Favicon -->
    <link href="{{ asset('backend/assets/img/fav4.png') }}" rel="icon" />

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap"
        rel="stylesheet" />

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet" />

    {{-- <link href="{{ asset('backend/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style" /> --}}


    <!-- Libraries Stylesheet -->
    <link href="{{ asset('backend/assets/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/assets/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}"
        rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('backend/assets/css/bootstrap.min.css') }}" rel="stylesheet" />

    <!-- Template Stylesheet -->
    <link href="{{ asset('backend/assets/css/style.css') }}" rel="stylesheet" />

    {{-- {{asset('backend/assets/')}} --}}
  </head>

  <body>
    <div class="dashboard-wrapper">
      <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        <div
          id="spinner"
          class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center"
        >
          <div
            class="spinner-border text-primary"
            style="width: 3rem; height: 3rem"
            role="status"
          >
            <span class="sr-only">Loading...</span>
          </div>
        </div>
        <!-- Spinner End -->

        <!-- Sidebar Start -->
        @include('teacher.body.sidebar')
        <!-- Sidebar End -->

        <!-- Content Start -->
        <div class="content">
          <!-- Navbar Start -->
          @include('teacher.body.header') 
          <!-- Navbar End -->

          <!-- Sale & Revenue Start -->
          @yield('teacher')
         
          <!-- Sale & Revenue End -->

          <!-- Sales Chart Start -->
          {{-- @yield('teacher') --}}
         
          <!-- Sales Chart End -->

          <!-- Recent Sales Start -->
          {{-- @yield('teacher') --}}
      
          <!-- Recent Sales End -->

          <!-- Widgets Start -->
          {{-- @yield('teacher') --}}
   
          <!-- Widgets End -->
        </div>
        <!-- Content End -->

        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"
          ><i class="bi bi-arrow-up"></i
        ></a>
      </div>
    </div>
    <!-- Footer Start -->
    @include('teacher.body.footer')
    <!-- Footer End -->
     <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('backend/assets/lib/chart/chart.min.js') }}"></script>
    <script src="{{ asset('backend/assets/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('backend/assets/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('backend/assets/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('backend/assets/lib/tempusdominus/js/moment.min.js') }}"></script>
    <script src="{{ asset('backend/assets/lib/tempusdominus/js/moment-timezone.min.js') }}"></script>
    <script src="{{ asset('backend/assets/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>

    <!-- Include Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="{{ asset('backend/assets/js/code.js') }}"></script>

    <script type="text/javascript">
        @if (Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}";
            switch (type) {
                case 'info':
                    toastr.info("{{ Session::get('message') }}");
                    break;
                case 'success':
                    toastr.success("{{ Session::get('message') }}");
                    break;
                case 'warning':
                    toastr.warning("{{ Session::get('message') }}");
                    break;
                case 'error':
                    toastr.error("{{ Session::get('message') }}");
                    break;
            }
        @endif
    </script>
    <!-- Template Javascript -->
    <script src="{{ asset('backend/assets/js/main.js') }}"></script>
    <script src="{{ asset('backend/assets/js/myjs.js') }}"></script>
  </body>
</html>
