<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  
    @include('admin.layouts.style')
    @stack('styles')
</head> 

<body id="page-top">
  <div id="wrapper">
    <!-- Sidebar -->
   @include('admin.layouts.menu')
    <!-- Sidebar -->
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <!-- TopBar -->
       @include('admin.layouts.header')
        <!-- Topbar -->

        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
            @yield('content')
            
        </div>
        
        <!---Container Fluid-->
      </div>
      <!-- Footer -->
        @include('admin.layouts.footer')
      <!-- Footer -->
    </div>
  </div>

  <!-- Scroll to top -->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
  @include('admin.layouts.script')
  @include('admin.product.summernote')
  @stack('scripts')
  
</body>

</html>