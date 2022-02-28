    <!-- Modal   edit สถานะ -->
    <div class="modal fade" id="order_detail{{ $item->id }}" tabindex="-1" aria-labelledby="editCateModal"
        aria-hidden="true">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCateModalLabel">แก้ไขสถานะ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('/order/edit/' . $item->id) }}" method="POST">
                        @csrf

                        <div class="mb-2">
                            <H4>เลขที่ใบเสร็จ : {{ $item->code }}</H4>
                            <input type="hidden" name="code" value="{{ $item->code }}">
                        </div>
                        <div class="mb-2">
                            <label for="Status" class="form-label">สถานะ</label>
                            <select class="form-select" aria-label="Status" name="Status">
                                <option value="1" {{ old('status', $item->status) === 1 ? 'selected' : '' }}>สำเร็จ
                                </option>
                                <option value="3" {{ old('status', $item->status) === 3 ? 'selected' : '' }}>รอดำเนินการ
                                </option>
                                <option value="0" {{ old('status', $item->status) === 0 ? 'selected' : '' }}>ไม่สำเร็จ
                                </option>
                            </select>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                    <input type="submit" value="แก้ไข" class="btn btn-primary add_cate">
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end Modal   edit สถานะ -->
