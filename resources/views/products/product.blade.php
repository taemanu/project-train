@extends('layouts.dashboard')


@section('content')


    <div class="home_content ">
        @if (session('success'))
            <div class="error-boxes alert alert-success" id="success_messages">
                {{ session('success') }}
            </div>
        @endif
        @error('cate_name')<div class="error-boxes alert alert-danger" id="success_messages">{{ $message }}</div>@enderror
        @error('pd_code')<div class="error-boxes alert alert-danger" id="success_messages">{{ $message }}</div>@enderror
        @error('pd_name')<div class="error-boxes alert alert-danger" id="success_messagess">{{ $message }}</div>@enderror
        @error('pd_image')<div class="error-boxes alert alert-danger" id="success_messagesss">{{ $message }}</div>@enderror

        <div class="table-boxes2">

            {{-- <div class="error-boxes alert alert-success" id="success_messagess" style='justify-content: center; text-align: center;'></div> --}}

            <div class="custom-tap">
                <ul class="nav nav-tabs">
                    <li class="nav-item d-flex justify-content-center">
                        <a class="nav-link {{ old('tab') == '' ? ' active' : null }}" data-bs-toggle="tab"
                            href="#product">สินค้า</a>
                    </li>
                    <li class="nav-item d-flex justify-content-center">
                        <a class="nav-link {{ old('tab') == 'category' ? 'active' : null }}" data-bs-toggle="tab"
                            href="#category">หมวดหมู่</a>
                    </li>
                </ul>
            </div>


            <div class="tab-content">

                {{-- สินค้า --}}
                <div class="tab-pane {{ old('tab') == '' ? ' active' : null }}" id="product">

                    <div class="d-flex justify-content-between" style='padding: 10px;'>
                        <h5 style='margin-top: 9px;'>ตารางสินค้า</h5>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AddProductModal">
                            เพิ่มสินค้า
                        </button>
                    </div>

                    <hr>

                    <table id="TablePd" class="table table-hover table-bordered ">
                        <thead>
                            <tr>
                                <th style='text-align:center' scope="col">#</th>
                                <th style='text-align:center' scope="col">รหัสสินค้า</th>
                                <th style='text-align:center' scope="col">ชื่อสินค้า</th>
                                <th style='text-align:center' scope="col">รูป</th>
                                <th style='text-align:center' scope="col">หมวดหมู่</th>
                                <th style='text-align:center' scope="col">จำนวนสินค้า</th>
                                <th style='text-align:center' scope="col">ราคา</th>
                                <th style='text-align:center' scope="col">สถานะ</th>
                                <th style='text-align:center' scope="col">จัดการ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($i = 1)

                            @foreach ($product as $item)
                                <tr>
                                    <td style='text-align:center'>{{ $i++ }}</td>
                                    <td style='text-align:center'>{{ $item->pd_code }}</td>
                                    <td style='text-align:center'>
                                        <img src="{{ asset($item->pd_image) }}" alt="" width="70px" height="100px">
                                    </td>
                                    <td style='text-align:center'>{{ $item->pd_name }}</td>
                                    <td style='text-align:center'>{{ $item->cates->cate_name }}</td>
                                    <td style='text-align:center'>{{ $item->pd_amount }}</td>
                                    <td style='text-align:center'>{{ number_format($item->pd_price, 2) }}</td>
                                    <td style='text-align:center'>
                                        @if ($item->status == true)
                                            <h5><span class="badge bg-success">ใช้งาน</span></h5>
                                        @else
                                            <h5><span class="badge bg-danger">ยกเลิก</span></h5>
                                        @endif
                                    </td>
                                    <td style='text-align:center'>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#editProductModal{{ $item->id }}">
                                            แก้ไขข้อมูล
                                        </button>
                                        {{-- <a href="#"  value="{{$item->id}}" class="delete_cate btn btn-danger">ลบ</a> --}}
                                        <button type="button" value="{{ $item->id }}"
                                            class="delete_pd btn btn-danger">ลบ</button>
                                    </td>
                                </tr>

                                <!-- Modal   edit สินค้า -->
                                <div class="modal fade" id="editProductModal{{ $item->id }}" tabindex="-1"
                                    aria-labelledby="editProductModal" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editProductModalLabel">แก้ไขสินค้า</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ url('/product/update/' . $item->id) }}" method="post" enctype="multipart/form-data">
                                                    @csrf

                                                    <div class="mb-2">
                                                        <label for="pd_code" class="form-label">รหัสสินค้า</label>
                                                        <input class="form-control" type="text" name="pd_code"
                                                            value="{{ $item->pd_code }}">
                                                        <span id="save_errlist"></span>
                                                    </div>

                                                    <div class="mb-2">
                                                        <label for="pd_name" class="form-label">ชื่อสินค้า</label>
                                                        <input class="form-control" type="text" name="pd_name"
                                                            value="{{ $item->pd_name }}">
                                                        <span id="save_errlist"></span>
                                                    </div>

                                                    <div class="mb-2">
                                                        <label for="pd_price" class="form-label">ราคาสินค้า</label>
                                                        <input class="form-control" type="text" name="pd_price"
                                                            value="{{ $item->pd_price }}">
                                                        <span id="save_errlist"></span>
                                                    </div>

                                                    <div class="mb-2">
                                                        <label for="pd_amount" class="form-label">จำนวนสินค้า</label>
                                                        <input class="form-control" type="text" name="pd_amount"
                                                            value="{{ $item->pd_amount }}" readonly>
                                                        <span id="save_errlist"></span>
                                                    </div>

                                                    <div class="mb-2">
                                                        <label for="pd_minimum"
                                                            class="form-label">จำนวนสินค้าขั้นต่ำ</label>
                                                        <input class="form-control" type="text" name="pd_minimum"
                                                            value="{{ $item->pd_minimum }}">
                                                        <span id="save_errlist"></span>
                                                    </div>

                                                    <div class="mb-2">
                                                        <label for="cate" class="form-label">หมวดสินค้า</label>
                                                        <select class="form-select" aria-label="cate" name="cate">
                                                            @foreach ($categories as $cate)
                                                            <option value="{{ $cate->id }}"
                                                                {{ $item->cates->id == $cate->id ? 'selected' : '' }}>
                                                                {{ $cate->cate_name }}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="mb-2">
                                                        <label for="Status" class="form-label">สถานะ</label>
                                                        <select class="form-select" aria-label="Status" name="Status">
                                                            <option value="1" {{ old('status', $item->status) === 1 ? 'selected' : '' }}>ใช้งาน
                                                            </option>
                                                            <option value="0" {{ old('status', $item->status) === 0 ? 'selected' : '' }}>ยกเลิก
                                                            </option>
                                                        </select>
                                                    </div>

                                                    <div class="form-group mb-3">
                                                        <label for="pd_image" class="form-label">รูปภาพสินค้า</label>
                                                        <input type="file" class="form-control" name="pd_image">
                                                    </div>
                                                    <input type="hidden" name="old_image" value="{{ $item->pd_image}}">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">ปิด</button>
                                                <input type="submit" value="แก้ไข" class="btn btn-primary">
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- end Modal   edit สินค้า -->

                                @include('layouts.modal.modal-product')
                            @endforeach
                        </tbody>
                    </table>
                </div>


                {{-- =========================================หมวดหมู่ ========================================================== --}}


                <div class="tab-pane {{ old('tab') == 'category' ? ' active' : null }}" id="category">
                    <div class="d-flex justify-content-between" style='padding: 10px;'>
                        <h5 style='margin-top: 9px;'>ตารางหมวดสินค้า</h5>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AddCateModal">
                            เพิ่มหมวดสินค้า
                        </button>
                    </div>
                    <hr>
                    <table id="Tablecate" class="table table-hover table-bordered ">
                        <thead>
                            <tr>
                                <th style='text-align:center' scope="col">#</th>
                                <th style='text-align:center' scope="col">ชื่อหมวดหมู่สินค้า</th>
                                <th style='text-align:center' scope="col">จำนวนรายการสินค้า</th>
                                <th style='text-align:center' scope="col">ใช้งานเมื่อ</th>
                                {{-- <th style='text-align:center' scope="col">อัพเดทเมื่อ</th> --}}
                                <th style='text-align:center' scope="col">สถานะ</th>
                                {{-- <th style='text-align:center' scope="col">จัดการ</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @php($j = 1)
                            @foreach ($categories as $item)
                                <tr>
                                    <td style='text-align:center'>{{ $j++ }}</td>
                                    <td style='text-align:center'>{{ $item->cate_name }}</td>
                                    <td style='text-align:center'>{{ $item->product->where('status', true)->count() }}</td>
                                    <td style='text-align:center'>
                                        {{ Carbon\Carbon::parse($item->created_at)->diffForHumans() }}
                                    </td>
                                    {{-- <td style='text-align:center'>
                                        {{ Carbon\Carbon::parse($item->updated_at)->diffForHumans() }}
                                    </td> --}}
                                    {{-- <td style='text-align:center'>
                                        @if ($item->status == true)
                                            <h5><span class="badge bg-success">ใช้งาน</span></h5>
                                        @else
                                            <h5><span class="badge bg-danger">ยกเลิก</span></h5>
                                        @endif
                                    </td> --}}
                                    <td style='text-align:center'>
                                        <a href="#" data-bs-toggle="modal"
                                            data-bs-target="#editCateModal{{ $item->id }}"
                                            class="btn btn-primary">แก้ไขข้อมูล</a>
                                        {{-- <a href="#"  value="{{$item->id}}" class="delete_cate btn btn-danger">ลบ</a> --}}
                                        <button type="button" value="{{ $item->id }}"
                                            class="delete_cate btn btn-danger">ลบ</button>
                                    </td>
                                </tr>
                                @include('layouts.modal.modal-cate')
                            @endforeach
                        </tbody>
                    </table>
                    {{-- <div class="d-flex justify-content-end">{{ $categories->fragment('category')->links() }}</div> --}}

                </div>

            </div>
        </div>
    </div>



    </div>

@section('scripts')
    <script>
        $(document).ready(function() {


            $('#tabMenu a[href="#{{ old('tab') }}"]').tab('show');

            $("body").click(function() {
                $("#success_messages").css("display", "none");
                $("#success_messagess").css("display", "none");
                $("#success_messagesss").css("display", "none");
            })

            $(document).on('click', '.delete_cate', function(e) {
                e.preventDefault();
                var cate_id = $(this).val();
                // alert(cate_id);
                $('#delete_cate_id').val(cate_id);
                $('#deleteCateModal').modal('show');
            });

            $(document).on('click', '.delete_pd', function(e) {
                e.preventDefault();
                var pd_id = $(this).val();
                // alert(pd_id);
                $('#delete_pd_id').val(pd_id);
                $('#deleteProductModal').modal('show');
            });

            // var url = document.location.toString();
            // if (url.match('#')) {
            //     $('.nav-tabs a[href="#' + url.split('#')[1] + '"]')[0].click();
            // }

            // //To make sure that the page always goes to the top
            // setTimeout(function() {
            //     window.scrollTo(0, 0);
            // }, 0);


        });

        $(document).ready(function() {
            $('#TablePd').DataTable({
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

            $('#Tablecate').DataTable({
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


{{-- $(document).on('click', '.delete_cate', function(e) {
e.preventDefault();
var cate_id = $(this).val();
// alert(cate_id);
$('#delete_cate_id').val(cate_id);
$('#deleteCateModal').modal('show');
});
$(document).on('click', '.cate_btn_d', function(e) {
e.preventDefault();

var cate_id = $('#delete_cate_id').val();

$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});

$.ajax({
type: "DELETE",
url: "/categories/update/"+cate_id,
success: function(response) {
// console.log(response);

$('#success_messagess').text(response.message);
$('#deleteCateModal').modal('hide');

}
});
}); --}}
