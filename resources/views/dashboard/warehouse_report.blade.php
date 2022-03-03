@extends('layouts.dashboard')

@section('content')
    <!-- Content Area -->
    <div class="home_content">
        <div class="report-boxes-1">
            {{-- top_content --}}
            <div class="min-sales box">
                <div class="title mb-1">10 จำนวนสินค้าขั้นต่ำ</div>

            <div class="min-pd">
                <ul class="details">
                    <li class="topic">สินค้า</li>
                        @foreach ($minimum as $item)
                        <li>
                            <a>
                                <img src="{{ asset($item->pd_image) }}"
                                    alt="">
                                <span class="product_name">{{$item->pd_name}}</span>
                            </a>
                        </li>
                        @endforeach
                </ul>

                <ul class="details">
                    <li class="topic">ราคา</li>
                    @foreach ($minimum as $price)
                    <li style='text-align:end'><a>{{ $price->pd_price }} บาท</a></li>
                @endforeach
                </ul>

                <ul class="details">
                    <li class="topic">หมวดสินค้า</li>
                    @foreach ($minimum as $cate)
                    <li><a>{{ $cate->cate_name }}</a></li>
                @endforeach
                </ul>

                <ul class="details">
                    <li class="topic">จำนวนคงเหลือ</li>
                    @foreach ($minimum as $amount)
                    <li  style='text-align:end'><a>{{ $amount->pd_amount }} ชิ้น</a></li>
                @endforeach
                </ul>
            </div>

            </div>

            {{-- right-side --}}
            <div class="cate-sales box">
                <div class="title mb-1">จำนวนสินค้าในหมวดหมู่</div>
                <div> <canvas id="chart1"></canvas></div>

            </div>
        </div>
        {{-- end top_content --}}

        <div class="report-boxes-2">

            <div class="all-sales box">
                <div class="title mb-1">25 สินค้าที่มีจำนวนน้อย</div>
                <canvas id="chart2" height="50%"></canvas>

                <hr>
                <div class="button" style='text-align: end;'>
                    ข้อมูลอัพเดทล่าสุด {{ date('d/m/Y G:i:s') }}
                </div>
            </div>
        </div>


    </div>
    </div>
    <!-- End Content -->

@section('scripts')
    <script>
        window.count = '<?php echo $jsonResult; ?>';

        var myResult1 = JSON.parse(window.count);

        console.log(myResult1.label);
        const data1 = {
            labels: myResult1.label,
            datasets: [{
                label: 'My First Dataset',
                data: myResult1.data,
                backgroundColor: [
                    'rgb(255, 99, 132,0.7)',
                    'rgb(54, 162, 235,0.7)',
                    'rgb(154, 162, 235,0.7)',
                    'rgb(54, 197, 235,0.7)',
                    'rgb(564, 162, 23,0.7)',
                    'rgb(94, 162, 135,0.7)',
                    'rgb(54, 162, 235,0.7)',
                    'rgb(64, 12, 325,0.7)',
                    'rgb(954, 192, 239,0.7)',
                    'rgb(64, 162, 23,0.7)',
                    'rgb(224, 62, 235,0.7)',
                    'rgb(24, 282, 25,0.7)',
                    'rgb(254, 164, 156,0.7)',
                    'rgb(54, 12, 235,0.7)',
                    'rgb(255, 205, 86,0.7)'
                ],
                hoverOffset: 4
            }]
        };
        const config1 = {
            type: 'doughnut',
            data: data1,
            options: {
                plugins: {
                    legend: {
                        position: 'bottom',
                    }
                }
            }
        };

        const Chart1 = new Chart(
            document.getElementById('chart1'),
            config1
        );

        // end chart1

        window.count = '<?php echo $jsonResult1; ?>';

        var myResult2 = JSON.parse(window.count);

        console.log(myResult2);

        const labels3 = myResult2.label;
        const data3 = {
            labels: labels3,
            datasets: [{
                label: 'จำนวน',
                data: myResult2.data,
                backgroundColor: [
                    '#32A7007a',

                ],
                borderColor: [
                    '#32A700',
                ],
                borderWidth: 1
            }]
        };

        const config3 = {
            type: 'bar',
            data: data3,
            options: {
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            },
        };

        const chart3 = new Chart(
            document.getElementById('chart2'),
            config3
        );
    </script>
@endsection
@endsection
