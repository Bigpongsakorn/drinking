<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.frontend.head')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Kanit&display=swap');

        .hero-area {
            height: 100vh;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            /* background-image: url(../../upload/water-background2.jpg); */
            background-image: url(/drinking/public/upload/water-background2.jpg);
            background-attachment: fixed;
        }

        #h1 {
            font-size: 85px;
            color: #ffffff;
            margin-bottom: 330px;
            font-weight: 600;
        }

        body,
        html {
            font-family: 'Kanit', sans-serif;
            background-color: #ffffff;
            text-rendering: optimizeLegibility;
            -webkit-font-smoothing: antialiased;
            -moz-font-smoothing: antialiased;
        }

        p,
        h1,
        h2,
        h3,
        h4,
        h5 {
            font-family: 'Kanit', sans-serif;
        }

        a {
            font-size: 16px;
        }

        .main_font {
            text-align: center;
            text-decoration: underline;
        }
        .nav-item{
          margin-right: 10px;
        }
        .box-bk{
            background-color: rgb(112, 165, 245);
        }
        #map {
        height: 450px;
        width: 100%;
    }
    </style>
</head>

<body>
  
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top">
      <div class="container">
        <a class="navbar-brand" href="{{ url('/index') }}">อัลดาน้ำดื่ม</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <ul class="navbar-nav mr-auto">
            </ul>
            <div class="navbar-nav">
                <a class="nav-item nav-link @if($page=='/') active @endif" href="{{ url('/index') }}">หน้าหลัก</a>
                <a class="nav-item nav-link @if($page=='/product_list') active @endif" href="{{ url('/product_list') }}">สินค้า</a>
                <a class="nav-item nav-link @if($page=='/news_list' || $page=='/news_detail') active @endif" href="{{ url('/news_list') }}">ข่าวประชาสัมพันธ์</a>
                <a class="nav-item nav-link @if($page=='/contact') active @endif" href="{{ url('/contact') }}">ติดต่อ</a>
                <a href="{{ url('/login') }}" class="form-inline">
                  <button class="btn btn-sm btn-outline-light">เข้าสู่ระบบ</button>
                </a>
            </div>
        </div>
      </div>
    </nav>
  
    {{-- ////////////////////////// --}}
    @yield('content')
    {{-- ////////////////////////// --}}

</body>

<section class="">
    <!-- Footer -->
    <footer class=" text-center text-white" style="background-color: #0a4275;">
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
