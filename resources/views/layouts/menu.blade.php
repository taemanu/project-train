<div id="app">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/') }}">
                Point
            </a>

            <div class="collapse navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav me-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('เข้าสู่ระบบ') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('สมัครสมาชิก') }}</a>
                            </li>
                        @endif

                    @endguest
                </ul>
                <ul class="navbar-nav ms-auto">
                    <div class="dropdown">
                        <div class="text-white">{{ Auth::user()->getFullname() }} <i class='bx bxs-down-arrow'></i></div>
                        <div class="dropdown-content">
                          <a href="{{ route('profile') }}">ข้อมูลผู้ใช้</a>
                          <a href="{{ route('logout') }}" onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();">
                              ออกจากระบบ
                          </a>
                          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                              @csrf
                          </form>
                        </div>
                      </div>

                </ul>
            </div>
        </div>
    </nav>

    <div class="sidebar">
        <div class="logo_content">
            <div class="logo">
                <i class='bx bx-store'></i>
                <div class="logo_name">Poin Of Sale</div>
            </div>
            <i class='bx bx-menu' id="btn"></i>
        </div>
        <ul class="nav_list">
            <li>
                <a href="{{ route('home') }}">
                    <i class='bx bx-home'></i>
                    <span class="link_name">หน้าแรก</span>
                </a>
                <span class="tooltips">หน้าแรก</span>
            </li>

            @if (Auth::user()->roles_id == 2)
                <li>
                    <a href="{{ route('employee') }}">
                        <i class='bx bx-user'></i>
                        <span class="link_name">จัดการข้อมูลผู้ใช้</span>
                    </a>
                    <span class="tooltips">จัดการข้อมูลผู้ใช้</span>
                </li>
                <li>
                    <a href="{{ route('product') }}">
                        <i class='bx bx-grid-alt'></i>
                        <span class="link_name">จัดการสินค้า</span>
                    </a>
                    <span class="tooltips">จัดการสินค้า</span>
                </li>
                <li>
                    <a href="{{Route('order')}}">
                        <i class='bx bxs-edit'></i>
                        <span class="link_name">ข้อมูลการขาย</span>
                    </a>
                    <span class="tooltips">ข้อมูลการขาย</span>
                </li>
                <li>
                    <a href="{{route('stock')}}">
                        <i class='bx bxs-edit'></i>
                        <span class="link_name">จัดการสินค้าคงคลัง</span>
                    </a>
                    <span class="tooltips">จัดการสินค้าคงคลัง</span>
                </li>
                <li>
                   <a href="{{route('ReportSale')}}">
                        <i class='bx bx-pie-chart-alt-2'></i>
                        <span class="link_name">รายงานยอดขาย</span>
                    </a>
                    <span class="tooltips">รายงานยอดขาย</span>
                </li>
                 <li>
                   <a href="{{route('ReportWarehouse')}}">
                        <i class='bx bx-pie-chart-alt-2'></i>
                        <span class="link_name">รายงานสินค้าคงคลัง</span>
                    </a>
                    <span class="tooltips">รายงานสินค้าคงคลัง</span>
                <li>
                    <a href="{{ route('cart')}}">
                        <i class='bx bx-cart-alt'></i>
                        <span class="link_name">ขายสินค้า</span>
                    </a>
                    <span class="tooltips">ขายสินค้า</span>
                </li>
            @else

                <li>
                    <a href="{{ route('product') }}">
                        <i class='bx bx-grid-alt'></i>
                        <span class="link_name">จัดการสินค้า</span>
                    </a>
                    <span class="tooltips">จัดการสินค้า</span>
                </li>
                <li>
                    <a href="{{Route('order')}}">
                        <i class='bx bxs-edit'></i>
                        <span class="link_name">ข้อมูลการขาย</span>
                    </a>
                    <span class="tooltips">ข้อมูลการขาย</span>
                </li>
                <li>
                     <a href="{{route('stock')}}">
                        <i class='bx bxs-edit'></i>
                        <span class="link_name">จัดการสินค้าคงคลัง</span>
                    </a>
                    <span class="tooltips">จัดการสินค้าคงคลัง</span>
                </li>
                <li>
                    <a href="{{route('ReportSale')}}">
                        <i class='bx bx-pie-chart-alt-2'></i>
                        <span class="link_name">รายงานยอดขาย</span>
                    </a>
                    <span class="tooltips">รายงานยอดขาย</span>
                </li>
                <li>
                    <a href="{{route('ReportWarehouse')}}">
                        <i class='bx bx-pie-chart-alt-2'></i>
                        <span class="link_name">รายงานสินค้าคงคลัง</span>
                    </a>
                    <span class="tooltips">รายงานสินค้าคงคลัง</span>
                <li>
                    <a href="{{ route('cart')}}">
                        <i class='bx bx-cart-alt'></i>
                        <span class="link_name">ขายสินค้า</span>
                    </a>
                    <span class="tooltips">ขายสินค้า</span>
                </li>
            @endif





        </ul>


        <div class="profile_content">
            <div class="profile">
                <div class="profile_detail">
                    <i class='bx bx-user'></i>
                    <div class="name_job">
                        <div class="name">{{ Auth::user()->getFullname() }}</div>
                        <div class="job">{{ Auth::user()->role->role_name }}</div>
                    </div>
                </div>
                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">

                    <i class='bx bx-log-out' id="logout"></i>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>

            </div>
        </div>
    </div>


