@extends('layouts.dashboard')

@section('content')
    <!-- Content Area -->
    <div class="home_content ">
        <div class="table-boxes2">

            <div class="d-flex bd-highlight back ">
                <div class="p-2 bd-highlight">
                    <a href="{{ URL('/pdf/show/'. $showorder->id) }}" target="_blank" class="btn btn-secondary float-end" method="GET">
                        <i class='bx bx-printer'></i> ใบเสร็จรับเงิน </a>
                </div>
                <div class="ms-auto p-2 bd-highlight p-2 bd-highlight"><a href="{{ URL::route('order') }}" class="btn btn-primary float-end"> ย้อนกลับไปหน้าออเดอร์ </a></div>
                {{-- <div class="p-2 bd-highlight"><button class="btn btn-secondary float-end"> <i class='bx bx-printer'></i> ใบแจ้งราคา </button></div> --}}
              </div>

            <div class="bill">
                  <div class="d-flex justify-content-center mb-2 mt-2  "><h1>ใบเสร็จรับเงิน</h1></div>
            <div class="d-flex bd-highlight ">
                <div class="me-auto p-2 bd-highlight"><h4>ร้าน อุปกรณ์การเกษตร</h4></div>
                <div class="p-2 bd-highlight"> <h5><b>เลขที่ใบเสร็จ : </b>{{ $showorder->code }}</h5></div>
            </div>
            <div class="d-flex bd-highlight">
                <div class="me-auto p-2 bd-highlight"><h5>99/9 หมู่ 9 ตำบล xxxxx</h5></div>
                <div class="p-2 bd-highlight"> <h5><b>ผู้ทำรายการ : </b>{{ $showorder->nameuser->first_name . ' ' . $showorder->nameuser->last_name  }}</h5></div>
            </div>
            <div class="d-flex bd-highlight ">
                <div class="me-auto p-2 bd-highlight"><h5>อำเภอ เมือง จังหวัด เชียงใหม่ 50100</h5></div>
                <div class="p-2 bd-highlight"><h5><b>วันที่ : </b>{{ \Carbon\Carbon::parse($showorder->date)->format('d/m/Y G:i:s')}}</h5></div>
            </div>
            <div class="d-flex bd-highlight ">
                <div class="me-auto p-2 bd-highlight"><h5>โทร 090-xxx-xxxx</h5></div>
                <div class="p-2 bd-highlight"><h5><b>จำนวนรายการ : </b>{{number_format($count)}} รายการ</h5></div>
            </div>
            <hr>


            <table class="table table-bordered border-dark" id="Tabledw">
                <thead>
                    <tr class="table-secondary border-dark">
                        <th style='text-align:center; width: 5%;' scope="col">ลำดับ</th>
                        <th style='text-align:center; width: 200px;' scoOpe="col">รายการ</th>
                        <th style='text-align:center; width: 10px;' scope="col">จำนวน</th>
                        <th style='text-align:center; width: 10px;' scope="col">หน่วยละ</th>
                        <th style='text-align:center; width: 10px;' scope="col">ราคาทั้งหมด</th>
                    </tr>
                </thead>

                <tbody>
                    @php($i = 1)

                    @foreach ($order_details as $item)
                        <tr>
                            <td style='text-align:center'>{{ $i++ }}</td>
                            <td style='text-align:center'>{{ $item->pd_name }}</td>
                            <td style='text-align:center'>{{ number_format($item->amount) }}</td>
                            <td style='text-align:center'>{{ number_format($item->pd_price) }}</td>
                            <td style='text-align:center'>{{ number_format($item->price) }}</td>
                        </tr>
                    @endforeach
                        <tr>
                            <td rowspan="4" colspan="3" class="bd"></td>
                            <td style='text-align:center; border-top:2px solid rgb(0, 0, 0);' class="table-secondary border-dark"> <b>จำนวน</b> </td>
                            <td style='text-align:center; border-top:2px solid rgb(0, 0, 0);'> <b>{{number_format($sumamount)}}</b> ชิ้น  </td>
                        </tr>
                        <tr>
                            <td style='text-align:center' class="table-secondary border-dark"> <b>ยอดรวมทั้งหมด</b> </td>
                            <td style='text-align:center'> <b>{{number_format($sumprice)}}</b> บาท </td>
                        </tr>
                        <tr>
                            <td style='text-align:center' class="table-secondary border-dark"> <b>จำนวนเงินที่ได้รับ</b> </td>
                            <td style='text-align:center'> <b>{{number_format($item->money_received)}}</b> บาท </td>
                        </tr>
                        <tr>
                            <td style='text-align:center' class="table-secondary border-dark"> <b>เงินทอน</b> </td>
                            <td style='text-align:center'> <b>{{number_format($item->change)}}</b> บาท </td>
                        </tr>
                </tbody>
            </table>
        </div>
        </div>
    </div>
    </div>
    <!-- End Content -->

@section('scripts')
    <script>

    </script>
@endsection
@endsection
