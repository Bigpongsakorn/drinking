<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.frontend.head')
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top" >
        <a class="navbar-brand" href="{{ url('/index') }}">อัลดาน้ำดื่ม</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav">
            <a class="nav-item nav-link active" href="{{ url('/index') }}">หน้าหลัก <span class="sr-only">(current)</span></a>
            <a class="nav-item nav-link" href="{{ url('/product_list') }}">สินค้า</a>
            <a class="nav-item nav-link" href="{{ url('/news_list') }}">ข่าวประชาสัมพันธ์</a>
            <a class="nav-item nav-link" href="#">ติดต่อ</a>
            {{-- <a class="nav-item nav-link disabled" href="#">Disabled</a> --}}
          </div>
        </div>
      </nav>

    {{-- ////////////////////////// --}}
    @yield('content')
    {{-- ////////////////////////// --}}
    
</body>

<section class="">
    <!-- Footer -->
    <footer class="text-center text-white" style="background-color: #0a4275;">
      <!-- Copyright -->
      <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
        © 2021 Copyright: 
        <small> Design and Developed By Team BIS Project</small>
      </div>
      <!-- Copyright -->
    </footer>
    <!-- Footer -->
  </section>

    @include('layouts.frontend.footer')
    
    <script>
        $(document).ready(function() {
            // App.init();
        });
    </script>
    @yield('js')

</html>
