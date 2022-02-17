@extends('layouts.dashboard')

@section('content')
    <!-- Content Area -->
    <div class="home_content">
        @if (session('success'))
            <div class="error-boxes alert alert-success" id="success_messages">
                {{ session('success') }}
            </div>
        @endif
        <div class="table-boxes2">
            <div class="d-flex justify-content-between" style='padding: 10px;'>
                <h5 style='margin-top: 9px;'>ตารางข้อมูลการขาย</h5>
                {{-- <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AddProductModal">
                    เพิ่มสินค้า
                </button> --}}
            </div>

            <hr>

            <table class="table table-hover table-bordered " id="Tableod">
                <thead>
                       <th style='text-align:center'  scope="col">#</th>
                        <th style='text-align:center ' scope="col">เลขที่ใบเสร็จ</th>
                        <th style='text-align:center ' scope="col">จำนวนสินค้าที่ขาย</th>
                        <th style='text-align:center ' scope="col">ราคาทั้งหมด</th>
                        <th style='text-align:center ' scope="col">วันที่</th>
                        <th style='text-align:center ' scope="col">ผู้ทำรายการ</th>
                        <th style='text-align:center ' scope="col">สถานะ</th>
                        <th style='text-align:center ' scope="col">จัดการ</th>

                </thead>
                <tbody>
                    @php($i = 1)
                    @foreach ($orders as $item)
                        <tr>
                            <td style='text-align:center'>{{ $i++ }}</td>
                            <td style='text-align:center'>{{ $item->code }}</td>
                            <td style='text-align:center'>{{ number_format($item->total_item) }} ชิ้น</td>
                            <td style='text-align:center'>{{ number_format($item->total_price) }} บาท</td>
                            <td style='text-align:center'>{{ $item->date }}</td>
                            <td style='text-align:center'>
                                {{ $item->nameuser->first_name . ' ' . $item->nameuser->last_name }}
                            </td>
                            <td style='text-align:center'>
                                @if ($item->status == true)
                                    <h5><span class="badge bg-success">สำเร็จ</span></h5>
                                @else
                                    <h5><span class="badge bg-danger">ไม่สำเร็จ</span></h5>
                                @endif
                            </td>
                            <td style='text-align:center'>

                                <a href="order_detail{{ $item->id }}"  class="btn btn-secondary"><i
                                        class='bx bx-search'></i>
                                </a>

                                <a href="#" data-bs-toggle="modal" data-bs-target="#order_detail{{ $item->id }}"
                                    class="btn btn-primary">สถานะ</a>
                            </td>
                        </tr>
        </div>
        @include('layouts.modal.modal-order')
        @endforeach
        </tbody>
        </table>
    </div>

    </div>
    </div>
    <!-- End Content -->

@section('scripts')
    <script>
        $(document).ready(function() {

            $('#Tableod').DataTable({
                "order": [
                    [0, "desc"]
                ],
                "language": {
                    "lengthMenu": "แสดง _MENU_ แถว",
                    "zeroRecords": "ไม่พบข้อมูล",
                    "info": "แสดง _START_ ถึง _END_ จาก _TOTAL_ แถว",
                    "infoEmpty": "ไม่พบข้อมูล",
                    "infoFiltered": "(กรองข้อมูล _MAX_ ทุกแถว)",
                    "paginate": {
                        "first": "หน้าแรก",
                        "previous": "ก่อนหน้า",
                        "next": "ถัดไป",
                        "last": "หน้าสุดท้าย"
                    },
                    "search": "ค้นหา :",
                },

            });

                $("body").click(function() {
                    $("#success_messages").css("display", "none");
                })

        });
    </script>
@endsection
@endsection
