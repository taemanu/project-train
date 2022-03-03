@extends('layouts.dashboard')

@section('content')
    <!-- Content Area -->
    <div class="home_content">
        <div class="report-boxes-1">
            {{-- top_content --}}
            <div class="min-sales1 box">
                <div class="title mb-1">ยอดขายต่อเดือน </div>
                {{-- <div> <canvas id="chart1"height="85px"></canvas></div> --}}
                <canvas id="chart3" height="95px"></canvas>

            </div>

            {{-- right-side --}}
            <div class="cate-sales1 box">
                <div class="title">สถานะการชำระ</div>
                <div> <canvas id="chart2"></canvas></div>
                <div class="title" style='text-align: center; margin-top:20px'>
                    คำสั่งซื้อทั้งหมด {{ $Order }} รายการ
                </div>
            </div>
        </div>
        {{-- end top_content --}}

        <div class="report-boxes-2">

            <div class="all-sales1 box ">
                <div class="title mb-1">ยอดขายต่อวัน</div>
                <div> <canvas id="chart1"height="39%"></canvas></div>
                {{-- <canvas id="chart3" width="100%" height="14%"></canvas> --}}

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
        var perday = JSON.parse(`<?php echo $data; ?>`);

        // console.log(perday);

        // ยอดขายต่อวัน
        const labels1 = perday.label;

        const data1 = {
            labels: labels1,
            datasets: [{
                label: 'รายได้ต่อวัน',
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132,0.5)',

                data: perday.data,
            }]
        };

        const config1 = {
            type: 'line',
            data: data1,
            options: {
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        };

        const chart1 = new Chart(
            document.getElementById('chart1'),
            config1
        );
        // end ยอดขายต่อวัน


        // สถานะการชำระ
        window.count = '<?php echo $jsonResult; ?>';

        var myResult = JSON.parse(window.count);


        if (myResult.data.length <= 2) {
            myResult.data.unshift(0)
            myResult.data.push(0)
        }
        // console.log(myResult.data, myResult.status);

        if (myResult.status[0] == 0 && myResult.data.length == 4) {
            console.log('ไม่สำเร็จ');

            myResult.data.splice(0, 1, myResult.data[1]);
            myResult.data.splice(1, 1, myResult.data[2]);
            myResult.data.splice(2, 1, 0);
        }


        // console.log(myResult.data);


        const data2 = {
            labels: [
                'ไม่สำเร็จ',
                'สำเร็จ',
                'รอการชำระ'
            ],
            datasets: [{
                label: 'สถานะการชำระ',
                data: [
                    myResult.data[0],
                    myResult.data[1],
                    myResult.data[2]
                ],
                backgroundColor: [
                    'rgb(255, 99, 132,0.6)',
                    'rgb(61, 181, 99,0.6)',
                    'rgb(255, 205, 86,0.6)'
                ],
                hoverOffset: 5
            }]
        };

        const config2 = {
            type: 'pie',
            data: data2,
        };

        const chart2 = new Chart(
            document.getElementById('chart2'),
            config2
        );
        // end สถานะการชำระ

        // ยอดขายต่อเดือน

        window.count = '<?php echo $jsonResult1; ?>';

        var myResult1 = JSON.parse(window.count);

        // console.log(myResult1);
        const labels3 = [
            'ม.ค',
            'ก.พ',
            'มี.ค',
            'เม.ย',
            'พ.ค',
            'มิ.ย',
            'ก.ค',
            'ส.ค',
            'ก.ย',
            'ต.ค',
            'พ.ค',
            'ธ.ค',
        ];
        const data3 = {
            labels: labels3,
            datasets: [{
                label: 'รายได้ต่อเดือน',
                data: myResult1.data,
                backgroundColor: [
                    'rgb(255, 99, 132,0.4)',

                ],
                borderColor: [
                    'rgb(255, 99, 132)',
                ],
                borderWidth: 1
            }]
        };

        const config3 = {
            type: 'bar',
            data: data3,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }

            },
        };

        const chart3 = new Chart(
            document.getElementById('chart3'),
            config3
        );
        // end ยอดขายต่อเดือน

        // end
    </script>
@endsection
@endsection
