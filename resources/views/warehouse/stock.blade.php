@extends('layouts.dashboard')
@section('content')

    <div class="home_content ">
        @if (session('success'))
            <div class="error-boxes alert alert-success" id="success_messages">
                {{ session('success') }}
            </div>
        @endif
        @error('product')<div class="error-boxes alert alert-danger" id="success_messages">{{ $message }}</div>@enderror
        <div class="form-boxes">
            <form action="/stock/update" method="POST" id="myForm">
                @csrf
                <div class="row">
                    <div class="col m-2">
                        <label for="cate" class="form-label">หมวดหมู่สินค้า</label>
                        <select class="form-select" aria-label="cate" Name="cate" id="cate">
                            <option value="" selected>เลือกหมวดหมู่สินค้า</option>
                            @foreach ($cate as $cate)
                                <option value="{{ $cate->id }}">{{ $cate->cate_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col m-2">
                        <label for="product" class="form-label">ชื่อสินค้า</label>
                        <select class="form-select" aria-label="product" Name="product" id="product">
                            <option value="" selected>กรุณาเลือกหมวดหมู่สินค้าก่อน</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col m-2">
                        <label for="status" class="form-label">จัดการ</label>
                        <select class="form-select" aria-label="status" Name="status">
                            <option value="1"> + เพิ่มจำนวนสินค้า</option>
                            <option value="0"> - ลดจำนวนสินค้า</option>
                        </select>
                    </div>
                    <div class="col m-2">
                        <label for="amount" class="form-label">จำนวน</label>
                        <input type="number" id="amount" class="form-control" name="amount" required>
                    </div>
                </div>
                <div class="col d-flex justify-content-end">
                    {{-- <button type="reset" class="btn btn-secondary m-1">ยกเลิก</button> --}}
                    <button type="submit" class="btn btn-primary m-1">ยืนยัน</button>
                </div>
            </form>
        </div>


        <div class="table-boxes2">
            <table class="table table-hover table-bordered" id="Tabledw">
                <thead>
                    <tr>
                        <th style='text-align:center' scope="col">#</th>
                        <th style='text-align:center' scope="col">ชื่อสินค้า</th>
                        <th style='text-align:center' scope="col">จำนวนคงเดิม</th>
                        <th style='text-align:center' scope="col">จัดการ</th>
                        <th style='text-align:center' scope="col">จำนวนใหม่</th>
                        <th style='text-align:center' scope="col">จัดการเมื่อ</th>
                        <th style='text-align:center' scope="col">ผู้ทำรายการ</th>
                    </tr>
                </thead>

                <tbody>
                    @php($i = 1)

                    @foreach ($stock as $item)
                        <tr>
                            <td style='text-align:center' scope="col">{{ $i++ }}</td>
                            <td style='text-align:center' scope="col">{{ $item->product->pd_name }}</td>
                            <td style='text-align:center' scope="col">{{ $item->before_amount }}</td>
                            <td style='text-align:center' scope="col">

                                @if ($item->status_status == true)

                                <span class="text text-success"><i class='bx bxs-up-arrow' style='font-size:12px'></i> {{ $item->stock_amount }}</span>
                                @else
                                    <span class="text text-danger"><i class='bx bxs-down-arrow' style='font-size:12px'></i> {{ $item->stock_amount }}</span>
                                @endif

                            </td>
                            <td style='text-align:center' scope="col">{{ $item->after_amount }}</td>
                            <td style='text-align:center' scope="col">{{ $item->created_at->format('d-m-Y') }}</td>
                            <td style='text-align:center' scope="col">
                                {{ $item->nameuser->first_name . ' ' . $item->nameuser->last_name }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

    </div>
@section('scripts')
    <script>
        $('#cate').change(function(e) {
            e.preventDefault();
            if ($(this).val() != '') {
                var cate_id = $(this).val();
                // console.log(cate_id);
                var _token = $('input[name="_token"]').val();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "{{ route('droupdown.fetch') }}",
                    data: {
                        cate_id: cate_id,
                        _token: _token
                    },
                    success: function(result) {
                        $('#product').html(result);


                    }
                });
            }
        });

        $(document).ready(function() {
            $("body").click(function() {
                $("#success_messages").css("display", "none");
            })

            $('#selectVote').on('change', function() {
                $('#myForm').attr('action', '/stock/update/' + $(this).val());
            });

            $('#Tabledw').DataTable({
                "order": [[ 0, "desc" ]],
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
        });
    </script>
@endsection
@endsection
