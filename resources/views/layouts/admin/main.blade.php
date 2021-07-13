<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
    <title>อันดาน้ำดื่ม</title>
    @include('layouts.admin.head')
</head>

<body>
    <div class="loader-bg">
        <div class="loader-bar"></div>
    </div>
    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">

            <nav class="navbar header-navbar pcoded-header">
                <div class="navbar-wrapper">
                    <div class="navbar-logo">
                        <a href="{{ url('/') }}">
                            <img class="img-fluid" src="/png/logo.png" alt="Theme-Logo" />
                        </a>
                        <a class="mobile-menu" id="mobile-collapse" href="#!">
                            <i class="feather icon-menu icon-toggle-right"></i>
                        </a>
                        <a class="mobile-options waves-effect waves-light">
                            <i class="feather icon-more-horizontal"></i>
                        </a>
                    </div>
                    <div class="navbar-container container-fluid">
                        <ul class="nav-right">
                            <li class="user-profile header-notification">
                                <div class="dropdown-primary dropdown">
                                    <div class="dropdown-toggle" data-toggle="dropdown">
                                        <img src="{{ url('/jpg/avatar-4.jpg') }}" class="img-radius"
                                            alt="User-Profile-Image">
                                        <span>{{ Auth::user()->username }}</span>
                                        <i class="feather icon-chevron-down"></i>
                                    </div>
                                    <ul class="show-notification profile-notification dropdown-menu"
                                        data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                        <li>
                                            <a href="{{ url('/user/profile_index') }}">
                                                <i class="icon-user"></i> Profile
                                            </a>
                                        </li>
                                        <li>
                                            {{-- <a href="auth-sign-in-social.html">
                                                <i class="feather icon-log-out"></i> Logout
                                            </a> --}}
                                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                <i class="feather icon-log-out"></i> Logout
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                class="d-none">
                                                @csrf
                                            </form>

                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">

                    <nav class="pcoded-navbar">
                        <div class="nav-list">
                            <div class="pcoded-inner-navbar main-menu">

                                {{-- <div class="pcoded-navigation-label">ข้อมูลส่วนตัว</div>
                                <ul class="pcoded-item pcoded-left-item">
                                    <li class="pcoded-hasmenu @if ($page == '/profile' || $page == '/profile/edit') active
                                        pcoded-trigger @endif">
                                        <a href="javascript:void(0)" class="waves-effect waves-dark">
                                            <span class="pcoded-micon"><i class="feather icon-clipboard"></i></span>
                                            <span class="pcoded-mtext">ข้อมูลส่วนตัว</span>
                                        </a>
                                        <ul class="pcoded-submenu">
                                            <li class=" @if ($page == '/profile')  active pcoded-trigger @endif">
                                                <a href="{{url('/user/profile_index')}}" class="waves-effect
                                waves-dark">
                                <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                                <span class="pcoded-mtext">ข้อมูลส่วนตัว</span>
                                </a>
                                </li>
                                </ul>
                                <ul class="pcoded-submenu">
                                    <li class=" @if ($page == '/profile/edit')  active pcoded-trigger @endif">
                                        <a href="{{url('/user/profile_edit')}}" class="waves-effect waves-dark">
                                            <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                                            <span class="pcoded-mtext">แก้ไขข้อมูลส่วนตัว</span>
                                        </a>
                                    </li>
                                </ul>
                                </li>
                                </ul> --}}
                                <?php $id = Auth::user()->position_id; ?>
                                <div class="pcoded-navigation-label">Dashboard</div>
                                <ul class="pcoded-item pcoded-left-item">
                                    <li class="pcoded-hasmenu @if ($page=='/index' ||
                                        $page=='/news/create' || $page=='/news/list' ) active pcoded-trigger @endif">
                                        <a href="javascript:void(0)" class="waves-effect waves-dark">
                                            <span class="pcoded-micon"><i class="feather icon-clipboard"></i></span>
                                            <span class="pcoded-mtext">ข้อมูลข่าวประชาสัมพันธ์</span>
                                        </a>
                                        <ul class="pcoded-submenu">
                                            <li class=" @if ($page=='/index' ) active pcoded-trigger @endif">
                                                <a href="{{ url('/dashboard') }}" class="waves-effect waves-dark">
                                                    <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                                                    <span class="pcoded-mtext">Dashboard</span>
                                                </a>
                                            </li>
                                        </ul>
                                        @if ($id == 1)
                                            <ul class="pcoded-submenu">
                                                <li class=" @if ($page=='/news/list' ) active pcoded-trigger @endif">
                                                    <a href="{{ url('/dashboard/list_news') }}"
                                                        class="waves-effect waves-dark">
                                                        <span class="pcoded-micon"><i
                                                                class="feather icon-home"></i></span>
                                                        <span class="pcoded-mtext">ข่าวประชาสัมพันธ์</span>
                                                    </a>
                                                </li>
                                            </ul>
                                            <ul class="pcoded-submenu">
                                                <li class=" @if ($page=='/news/create' ) active pcoded-trigger @endif">
                                                    <a href="{{ url('/dashboard/create_news') }}"
                                                        class="waves-effect waves-dark">
                                                        <span class="pcoded-micon"><i
                                                                class="feather icon-home"></i></span>
                                                        <span class="pcoded-mtext">เพิ่มข้อมูลข่าวประชาสัมพันธ์</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        @endif
                                    </li>
                                </ul>
                                @if ($id == 1 || $id == 2)
                                    <div class="pcoded-navigation-label">จัดการข้อมูลผู้ใช้งาน</div>
                                    <ul class="pcoded-item pcoded-left-item">
                                        <li class="pcoded-hasmenu @if ($page=='/users' ||
                                            $page=='/users/create' ) active pcoded-trigger @endif">
                                            <a href="javascript:void(0)" class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="icon-user"></i></span>
                                                <span class="pcoded-mtext">ข้อมูลผู้ใช้งาน</span>
                                            </a>
                                            <ul class="pcoded-submenu">
                                                <li class="@if ($page=='/users' ) active pcoded-trigger @endif">
                                                    <a href="{{ url('/user/index') }}"
                                                        class="waves-effect waves-dark">
                                                        <span class="pcoded-micon">
                                                            <i class="feather icon-menu"></i>
                                                        </span>
                                                        <span class="pcoded-mtext">ข้อมูลผู้ใช้งาน</span>
                                                    </a>
                                                </li>
                                            </ul>
                                            <ul class="pcoded-submenu">
                                                <li class="@if ($page=='/users/create' ) active pcoded-trigger @endif">
                                                    <a href="{{ url('/user/create') }}"
                                                        class="waves-effect waves-dark">
                                                        <span class="pcoded-micon">
                                                            <i class="feather icon-menu"></i>
                                                        </span>
                                                        <span class="pcoded-mtext">เพิ่มข้อมูลพนักงาน</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                @endif
                                @if ($id == 2 || $id == 3 || $id == 4)
                                    <div class="pcoded-navigation-label">จัดการข้อมูลลูกค้า</div>
                                    <ul class="pcoded-item pcoded-left-item">
                                        <li class="pcoded-hasmenu @if ($page=='/customer' ||
                                            $page=='/customer/create' ) active
                                        pcoded-trigger @endif">
                                            <a href="javascript:void(0)" class="waves-effect waves-dark">
                                                <span class="pcoded-micon">
                                                    <i class=" icon-people"></i>
                                                </span>
                                                <span class="pcoded-mtext">ข้อมูลลูกค้า</span>
                                            </a>
                                            <ul class="pcoded-submenu">
                                                <li class="@if ($page=='/customer' ) active pcoded-trigger @endif">
                                                    <a href="{{ url('/customer/index') }}"
                                                        class="waves-effect waves-dark">
                                                        <span class="pcoded-mtext">ข้อมูลลูกค้า</span>
                                                    </a>
                                                </li>
                                                <li class="@if ($page=='/customer/create' ) active pcoded-trigger @endif">
                                                    <a href="{{ url('/customer/create') }}"
                                                        class="waves-effect waves-dark">
                                                        <span class="pcoded-mtext">เพิ่มข้อมูลลูกค้า</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="pcoded-hasmenu @if ($page=='/order' ||
                                            $page=='/order/create' ) active pcoded-trigger @endif">
                                            <a href="javascript:void(0)" class="waves-effect waves-dark">
                                                <span class="pcoded-micon">
                                                    <i class="fa fa-shopping-bag"></i>
                                                </span>
                                                <span class="pcoded-mtext">จัดการข้อมูลสั่งซื้อสินค้า</span>
                                            </a>
                                            <ul class="pcoded-submenu">
                                                <li class="@if ($page=='/order' ) active pcoded-trigger @endif">
                                                    <a href="{{ url('/order/order_index') }}"
                                                        class="waves-effect waves-dark">
                                                        <span class="pcoded-mtext">ข้อมูลการสั่งซื้อ</span>
                                                    </a>
                                                </li>
                                                <li class="@if ($page=='/order/create' ) active pcoded-trigger @endif">
                                                    <a href="{{ url('/order/order_create') }}"
                                                        class="waves-effect waves-dark">
                                                        <span class="pcoded-mtext">เพิ่มข้อมูลการสั่งซื้อ</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="pcoded-hasmenu @if ($page=='/event' ||
                                            $page=='/event/create' ) active
                                        pcoded-trigger @endif">
                                            <a href="javascript:void(0)" class="waves-effect waves-dark">
                                                <span class="pcoded-micon">
                                                    <i class="icon-notebook"></i>
                                                </span>
                                                <span class="pcoded-mtext">ข้อมูลการจัดส่ง</span>
                                            </a>
                                            <ul class="pcoded-submenu">
                                                <li class="@if ($page=='/event' ) active pcoded-trigger @endif">
                                                    <a href="{{ url('/customer/index_event') }}"
                                                        class="waves-effect waves-dark">
                                                        <span class="pcoded-mtext">ข้อมูลการจัดส่ง</span>
                                                    </a>
                                                </li>
                                                <li class="@if ($page=='/event/create' ) active pcoded-trigger @endif">
                                                    <a href="{{ url('/customer/create_event') }}"
                                                        class="waves-effect waves-dark">
                                                        <span class="pcoded-mtext">เพิ่มข้อมูลการจัดส่ง</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="pcoded-hasmenu @if ($page=='/event' ||
                                            $page=='/event/create' ) active
                                        pcoded-trigger @endif">
                                            <a href="javascript:void(0)" class="waves-effect waves-dark">
                                                <span class="pcoded-micon">
                                                    <i class="icon-notebook"></i>
                                                </span>
                                                <span class="pcoded-mtext">ข้อมูลจัดงาน</span>
                                            </a>
                                            <ul class="pcoded-submenu">
                                                <li class="@if ($page=='/event' ) active pcoded-trigger @endif">
                                                    <a href="{{ url('/customer/index_event') }}"
                                                        class="waves-effect waves-dark">
                                                        <span class="pcoded-mtext">ข้อมูลจัดงาน</span>
                                                    </a>
                                                </li>
                                                <li class="@if ($page=='/event/create' ) active pcoded-trigger @endif">
                                                    <a href="{{ url('/customer/create_event') }}"
                                                        class="waves-effect waves-dark">
                                                        <span class="pcoded-mtext">เพิ่มข้อมูลจัดงาน</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                @endif
                                @if ($id == 2 || $id == 3)
                                <div class="pcoded-navigation-label">จัดการข้อมูลสินค้า</div>
                                <ul class="pcoded-item pcoded-left-item">
                                    <li class="pcoded-hasmenu @if ($page=='/product' ||
                                        $page=='/product/create' ) active
                                        pcoded-trigger @endif">
                                        <a href="javascript:void(0)" class="waves-effect waves-dark">
                                            <span class="pcoded-micon">
                                                <i class="fa fa-shopping-basket"></i>
                                            </span>
                                            <span class="pcoded-mtext">ข้อมูลสินค้า</span>
                                        </a>
                                        <ul class="pcoded-submenu">
                                            <li class="@if ($page=='/product' ) active pcoded-trigger @endif">
                                                <a href="{{ url('/product/index') }}"
                                                    class="waves-effect waves-dark">
                                                    <span class="pcoded-mtext">ข้อมูลสินค้า</span>
                                                </a>
                                            </li>
                                            <li class="@if ($page=='/product/create' ) active pcoded-trigger @endif">
                                                <a href="{{ url('/product/create') }}"
                                                    class="waves-effect waves-dark">
                                                    <span class="pcoded-mtext">เพิ่มข้อมูลสินค้า</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="pcoded-hasmenu @if ($page=='/producttype' ||
                                        $page=='/producttype/create' ) active
                                        pcoded-trigger @endif">
                                        <a href="javascript:void(0)" class="waves-effect waves-dark">
                                            <span class="pcoded-micon">
                                                <i class="fa fa-shopping-bag"></i>
                                            </span>
                                            <span class="pcoded-mtext">ประเภทสินค้า</span>
                                        </a>
                                        <ul class="pcoded-submenu">
                                            <li class="@if ($page=='/producttype' ) active pcoded-trigger @endif">
                                                <a href="{{ url('/product/index_type') }}"
                                                    class="waves-effect waves-dark">
                                                    <span class="pcoded-mtext">ข้อมูลประเภทสินค้า</span>
                                                </a>
                                            </li>
                                            <li class="@if ($page=='/producttype/create' ) active pcoded-trigger @endif">
                                                <a href="{{ url('/product/create_type') }}"
                                                    class="waves-effect waves-dark">
                                                    <span class="pcoded-mtext">เพิ่มประเภทสินค้า</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="pcoded-hasmenu @if ($page=='/productunit' ||
                                        $page=='/productunit/create_unit' ) active
                                        pcoded-trigger @endif">
                                        <a href="javascript:void(0)" class="waves-effect waves-dark">
                                            <span class="pcoded-micon">
                                                <i class="fa fa-pause-circle"></i>
                                            </span>
                                            <span class="pcoded-mtext">ปริมาณหน่วยสินค้า</span>
                                        </a>
                                        <ul class="pcoded-submenu">
                                            <li class="@if ($page=='/productunit' ) active pcoded-trigger @endif">
                                                <a href="{{ url('/product/index_unit') }}"
                                                    class="waves-effect waves-dark">
                                                    <span class="pcoded-mtext">ข้อมูลปริมาณหน่วยสินค้า</span>
                                                </a>
                                            </li>
                                            <li class="@if ($page=='/productunit/create_unit' ) active pcoded-trigger @endif">
                                                <a href="{{ url('/product/create_unit') }}"
                                                    class="waves-effect waves-dark">
                                                    <span class="pcoded-mtext">เพิ่มปริมาณหน่วยสินค้า</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="pcoded-hasmenu @if ($page=='/material' ||
                                        $page=='/material/create' ) active
                                        pcoded-trigger @endif">
                                        <a href="javascript:void(0)" class="waves-effect waves-dark">
                                            <span class="pcoded-micon">
                                                <i class="fa fa-archive"></i>
                                            </span>
                                            <span class="pcoded-mtext">วัตถุดิบ</span>
                                        </a>
                                        <ul class="pcoded-submenu">
                                            <li class="@if ($page=='/material' ) active pcoded-trigger @endif">
                                                <a href="{{ url('/product/material_index') }}"
                                                    class="waves-effect waves-dark">
                                                    <span class="pcoded-mtext">ข้อมูลวัตถุดิบ</span>
                                                </a>
                                            </li>
                                            <li class="@if ($page=='/material/create' ) active pcoded-trigger @endif">
                                                <a href="{{ url('/product/material_create') }}"
                                                    class="waves-effect waves-dark">
                                                    <span class="pcoded-mtext">เพิ่มวัตถุดิบ</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                                <div class="pcoded-navigation-label">จัดการข้อมูลรายการผลิต</div>
                                <ul class="pcoded-item pcoded-left-item">
                                    <li class="pcoded-hasmenu @if ($page=='/production' ||
                                        $page=='/production/create' ) active
                                        pcoded-trigger @endif">
                                        <a href="javascript:void(0)" class="waves-effect waves-dark">
                                            <span class="pcoded-micon">
                                                <i class=" icon-layers"></i>
                                            </span>
                                            <span class="pcoded-mtext">รายการผลิต</span>
                                        </a>
                                        <ul class="pcoded-submenu">
                                            <li class="@if ($page=='/production' ) active pcoded-trigger @endif">
                                                <a href="{{ url('/production/production_index') }}"
                                                    class="waves-effect waves-dark">
                                                    <span class="pcoded-mtext">ข้อมูลรายการผลิต</span>
                                                </a>
                                            </li>
                                            <li class="@if ($page=='/production/create' ) active pcoded-trigger @endif">
                                                <a href="{{ url('/production/production_create') }}"
                                                    class="waves-effect waves-dark">
                                                    <span class="pcoded-mtext">เพิ่มข้อมูลรายการผลิต</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                                <div class="pcoded-navigation-label">จัดการข้อมูลรายการเบิก</div>
                                <ul class="pcoded-item pcoded-left-item">
                                    <li class="pcoded-hasmenu @if ($page=='/withdraw_product' ||
                                        $page=='/withdraw/withdraw_product_create' ) active
                                        pcoded-trigger @endif">
                                        <a href="javascript:void(0)" class="waves-effect waves-dark">
                                            <span class="pcoded-micon">
                                                <i class="fa fa-newspaper-o"></i>
                                            </span>
                                            <span class="pcoded-mtext">รายการเบิกสินค้า</span>
                                        </a>
                                        <ul class="pcoded-submenu">
                                            <li class="@if ($page=='/withdraw_product' ) active pcoded-trigger @endif">
                                                <a href="{{ url('/withdraw/withdraw_product') }}"
                                                    class="waves-effect waves-dark">
                                                    <span class="pcoded-mtext">ข้อมูลเบิกสินค้า</span>
                                                </a>
                                            </li>
                                            <li class="@if ($page=='/withdraw/withdraw_product_create' ) active pcoded-trigger @endif">
                                                <a href="{{ url('/withdraw/withdraw_product_create') }}"
                                                    class="waves-effect waves-dark">
                                                    <span class="pcoded-mtext">เพิ่มข้อมูลเบิกสินค้า</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="pcoded-hasmenu @if ($page=='/withdraw_material' ||
                                        $page=='/withdraw/withdraw_material_create' ) active
                                        pcoded-trigger @endif">
                                        <a href="javascript:void(0)" class="waves-effect waves-dark">
                                            <span class="pcoded-micon">
                                                <i class="icon-film"></i>
                                            </span>
                                            <span class="pcoded-mtext">รายการเบิกวัตถุดิบ</span>
                                        </a>
                                        <ul class="pcoded-submenu">
                                            <li class="@if ($page=='/withdraw_material' ) active pcoded-trigger @endif">
                                                <a href="{{ url('/withdraw/withdraw_material') }}"
                                                    class="waves-effect waves-dark">
                                                    <span class="pcoded-mtext">ข้อมูลเบิกวัตถุดิบ</span>
                                                </a>
                                            </li>
                                            <li class="@if ($page=='/withdraw/withdraw_material_create' ) active
                                                 pcoded-trigger @endif">
                                                <a href="{{ url('/withdraw/withdraw_material_create') }}"
                                                    class="waves-effect waves-dark">
                                                    <span class="pcoded-mtext">เพิ่มข้อมูลเบิกวัตถุดิบ</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                                @endif
                            </div>
                        </div>
                    </nav>

                    {{-- =============== --}}
                    @yield('content')
                    {{-- =============== --}}

                    <div id="styleSelector">
                    </div>

                </div>
            </div>
        </div>
    </div>
    @include('layouts.admin.footer')

    <script>
        $(document).ready(function() {
            // App.init();
        });
    </script>

    @yield('js')

</body>

</html>
