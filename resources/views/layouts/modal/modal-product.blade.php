    <!-- Modal   add หมวดสินค้า -->

    <div class="modal fade" id="AddProductModal" tabindex="-1" aria-labelledby="AddProductModal" aria-hidden="true">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="AddProductModalLabel">เพิ่มสินค้า</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('/addproduct') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-2">
                            <label for="pd_code" class="form-label">รหัสสินค้า</label>
                            <input class="form-control" type="text" name="pd_code" placeholder="กรอกรหัสสินค้า">
                            <span id="save_errlist"></span>
                        </div>

                        <div class="mb-2">
                            <label for="pd_name" class="form-label">ชื่อสินค้า</label>
                            <input class="form-control" type="text" name="pd_name"
                                placeholder="กรอกชื่อหมวดหมู่สินค้า">
                            <span id="save_errlist"></span>
                        </div>

                        <div class="mb-2">
                            <label for="pd_price" class="form-label">ราคาสินค้า</label>
                            <input class="form-control" type="number" name="pd_price" placeholder="กรอกราคาสินค้า">
                            <span id="save_errlist"></span>
                        </div>

                        <div class="mb-2">
                            <label for="pd_amount" class="form-label">จำนวนสินค้า</label>
                            <input class="form-control" type="number" name="pd_amount" placeholder="กรอกจำนวนสินค้า">
                            <span id="save_errlist"></span>
                        </div>

                        <div class="mb-2">
                            <label for="pd_minimum" class="form-label">จำนวนสินค้าขั้นต่ำ</label>
                            <input class="form-control" type="number" name="pd_minimum"
                                placeholder="กรอกจำนวนสินค้าขั้นต่ำ">
                            <span id="save_errlist"></span>
                        </div>

                        <div class="mb-2">
                            <label for="cate" class="form-label">หมวดสินค้า</label>
                            <select class="form-select" aria-label="cate" name="cate">
                                @foreach ($categories as $item)
                                <option value="{{ $item->id }}"> {{ $item->cate_name }} </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-2">
                            <label for="Status" class="form-label">สถานะ</label>
                            <select class="form-select" aria-label="Status" name="Status">
                                <option value="1">ใช้งาน</option>
                                <option value="0">ยกเลิก</option>
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="pd_image" class="form-label">รูปภาพสินค้า</label>
                            <input type="file" class="form-control" name="pd_image">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                    <input type="submit" value="บันทึก" class="btn btn-primary add_cate">
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end Modal   add หมวดสินค้า -->


    {{-- Modal   ลบ สินค้า --}}
    <div class="modal fade" id="deleteProductModal" tabindex="-1" aria-labelledby="deleteProductModal" aria-hidden="true">

        <div class="modal-dialog modal-confirm">
            <div class="modal-content">
                <div class="modal-header flex-column">
                    <div class="icon-box">
                        <i class='bx bx-x'></i>
                    </div>
                    <h4 class="modal-title w-100">ยืนยันการลบข้อมูล?</h4>
                </div>
                <div class="modal-body">
                    <form action="{{ url('/Product/delete/' . $item->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="delete_pd_id" name="idpd">
                        <input type="hidden" name="old_image" value="{{ $item->pd_image}}">
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                    <input type="submit" value="ยืนยัน" class="btn btn-danger">
                </div>
                </form>
            </div>
        </div>
    </div>
    {{-- end Modal   ลบ สินค้า --}}
