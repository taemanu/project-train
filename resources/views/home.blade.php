@extends('layouts.dashboard')

@section('content')
    <!-- Content Area -->
    <div class="home_content">
        <div class="overview-boxes">

            <div class="box one">
                <div class="left-side">
                    <div class="box_toppic">จำนวนคำสั่งซื้อ</div>
                    <div class="number">{{ number_format($order_count[0]) }} <span
                            class="text">รายการ</span></div>
                    <div class="indicator">
                        <i class='bx bx-time-five'></i>
                        <span
                            class="text">{{ \Carbon\Carbon::parse($order_count[6])->format('d/m/Y G:i:s') }}</span>
                    </div>
                </div>
                {{-- <i class='bx bxs-cart-add cart one' ></i> --}}
            </div>

            <div class="box two">
                <div class="left-side">
                    <div class="box_toppic">รายได้ทั้งหมด</div>
                    <div class="number">{{ number_format($order_count[2]) }} <span
                            class="text">บาท</span></div>
                    <div class="indicator">
                        <i class='bx bx-time-five'></i>
                        <span
                            class="text">{{ \Carbon\Carbon::parse($order_count[6])->format('d/m/Y G:i:s') }}</span>
                    </div>
                </div>
            </div>

            <div class="box three">
                <div class="left-side">
                    <div class="box_toppic">ตรวจสอบการชำระ</div>
                    <div class="number">{{ number_format($order_count[3]) }} <span
                            class="text">รายการ</span></div>
                    <div class="indicator">
                        <i class='bx bx-time-five'></i>
                        <span
                            class="text">{{ \Carbon\Carbon::parse($order_count[4])->format('d/m/Y G:i:s') }}</span>
                    </div>
                </div>
                {{-- <i class='bx bxs-cart-add cart one' ></i> --}}
            </div>

            <div class="box four">
                <div class="left-side">
                    <div class="box_toppic">จำนวนสินค้าที่ขาย</div>
                    <div class="number">{{ number_format($order_count[5]) }} <span
                            class="text">ชิ้น</span></div>
                    <div class="indicator">
                        <i class='bx bx-time-five'></i>
                        <span
                            class="text">{{ \Carbon\Carbon::parse($order_count[6])->format('d/m/Y G:i:s') }}</span>
                    </div>
                </div>
                {{-- <i class='bx bxs-cart-add cart one' ></i> --}}
            </div>

        </div>

        {{-- sale contenct --}}
        <div class="sales-boxes">
            <div class="recent-sale box">
                <div class="title">รายการขายล่าสุด</div>
                <div class="sales-details">
                    <ul class="details">
                        <li class="topic">วันที่</li>

                        @foreach ($recent as $date)
                            <li><a href="order_detail{{ $date->id }}">{{ \Carbon\Carbon::parse($date->date)->format('d M Y') }}</a></li>
                        @endforeach
                    </ul>

                    <ul class="details">
                        <li class="topic">เลขที่ใบเสร็จ</li>
                        @foreach ($recent as $code)
                            <li><a href="order_detail{{ $code->id }}">{{ $code->code }}</a></li>
                        @endforeach
                    </ul>

                    <ul class="details">
                        <li class="topic">ผู้ทำรายการ</li>
                        @foreach ($recent as $user)
                            <li><a href="order_detail{{ $user->id }}">{{ $user->nameuser->first_name . ' ' . $user->nameuser->last_name }}</a></li>
                        @endforeach
                    </ul>

                    <ul class="details">
                        <li class="topic">ยอดรวม</li>
                        @foreach ($recent as $total)
                            <li  style='text-align:end'><a href="order_detail{{ $total->id }}">{{ number_format($total->total_price) }} บาท</span></a></li>
                        @endforeach
                    </ul>

                    <ul class="details" style='line-height: 2;'>
                        <li class="topic">สถานะ</li>
                        @foreach ($recent as $status)
                            @if ($status->status == 1)
                                <li><h5><span class="badge bg-success">สำเร็จ</span></h5></li>
                            @elseif ($status->status == 0)
                                <li><h5><span class="badge bg-danger">ไม่สำเร็จ</span></h5></li>
                            @else
                                <li><h5><span class="badge bg-warning">ตรวจสอบ</span></h5></li>
                            @endif
                        @endforeach
                    </ul>
                </div>
                <hr style='margin-top:0rem'>
                <div class="button">
                    <a href="{{Route('order')}}">เพิ่มเติม</a>
                </div>
            </div>

            {{-- right-side --}}
            <div class="top-sales box">
                <div class="title">อันดับสินค้าขายดี</div>

                <ul>
                    @foreach ($top_pd as $item)
                    <li>
                        <a>
                            <img src="{{ asset($item->pd_image) }}"
                                alt="">
                            <span class="product_name">{{$item->pd_name}}</span>
                        </a>
                        <span style='font-size:18px;'>{{$item->count}} ชิ้น</span>
                    </li>
                    @endforeach
                </ul>
                <hr style='margin-top:-0.6rem '>
                <div class="button">
                   ข้อมูลอัพเดทล่าสุด {{date("d/m/Y G:i:s")}}
                </div>
            </div>
        </div>

    </div>
    </div>
    <!-- End Content -->
@endsection
