    <!-- Modal   add หมวดสินค้า -->

    <div class="modal fade" id="AddCateModal" tabindex="-1" aria-labelledby="AddCateModal" aria-hidden="true">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="AddCateModalLabel">เพิ่มหมวดสินค้า</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('/addcategories') }}" method="POST">
                        @csrf
                        <div class="mb-2">
                            <label for="cate_name" class="form-label">ชื่อหมวดหมู่สินค้า</label>
                            <input class="form-control" type="text" name="cate_name"
                                placeholder="กรอกชื่อหมวดหมู่สินค้า">
                            <span id="save_errlist"></span>
                        </div>

                        {{-- <div class="mb-3">
                            <label for="Status" class="form-label">สถานะ</label>
                            <select class="form-select" aria-label="Status" name="Status">
                                <option value="1">ใช้งาน</option>
                                <option value="0">ยกเลิก</option>
                            </select>
                        </div> --}}
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


    <!-- Modal   edit หมวดสินค้า -->
    <div class="modal fade" id="editCateModal{{ $item->id }}" tabindex="-1" aria-labelledby="editCateModal"
        aria-hidden="true">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCateModalLabel">แก้ไขหมวดสินค้า</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('/categories/update/' . $item->id) }}" method="POST">
                        @csrf
                        <div class="mb-2">
                            <label for="cate_name" class="form-label">ชื่อหมวดหมู่สินค้า</label>
                            <input class="form-control" type="text" name="cate_name" value="{{ $item->cate_name }}">
                            <span id="save_errlist"></span>
                        </div>

                        {{-- <div class="mb-3">
                            <label for="Status" class="form-label">สถานะ</label>
                            <select class="form-select" aria-label="Status" name="Status">
                                <option value="1" {{ old('status', $item->status) === 1 ? 'selected' : '' }}>ใช้งาน
                                </option>
                                <option value="0" {{ old('status', $item->status) === 0 ? 'selected' : '' }}>ยกเลิก
                                </option>
                            </select>
                        </div> --}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                    <input type="submit" value="แก้ไข" class="btn btn-primary add_cate">
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end Modal   edit หมวดสินค้า -->


    {{-- Modal   ลบ หมวดสินค้า --}}
    <div class="modal fade" id="deleteCateModal" tabindex="-1" aria-labelledby="deleteCateModal" aria-hidden="true">

        <div class="modal-dialog modal-confirm">
            <div class="modal-content">
                <div class="modal-header flex-column">
                    <div class="icon-box">
                        <i class='bx bx-x'></i>
                    </div>
                    <h4 class="modal-title w-100">ยืนยันการลบข้อมูล?</h4>
                </div>
                <div class="modal-body">
                    <form action="{{ url('/categories/delete/' . $item->id) }}" method="POST">
                        @csrf
                        <input type="hidden" id="delete_cate_id" name="idcate">
                        <h5>หากทำการลบข้อมูล "หมวดสินค้า" ข้อมูล "สินค้า" จะถูกลบไปด้วย !</h5>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                    <input type="submit" value="ยืนยัน" class="btn btn-danger">
                </div>
                </form>
            </div>
        </div>
    </div>
    {{-- end Modal   ลบ หมวดสินค้า --}}






