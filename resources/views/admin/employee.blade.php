@extends('layouts.dashboard')

@section('content')
    <!-- Content Area -->
    <div class="home_content">

        <div class="employee-boxes">
            <div class="box">
                <div class="left-side">
                    <div class="box_toppic">แอดมิน</div>
                    <div class="number">{{ $count['0'] }}</div>
                </div>
            </div>
            <div class="box sale">
                <div class="left-side">
                    <div class="box_toppic">พนักงานขาย</div>
                    <div class="number">{{ $count['1'] }}</div>
                </div>
            </div>
            <div class="box warehouse">
                <div class="left-side">
                    <div class="box_toppic">พนักงานคลังสินค้า</div>
                    <div class="number">{{ $count['2'] }}</div>
                </div>
            </div>

        </div>
        @if (session('success'))
            <div class="error-boxes alert alert-success" id="success_messages">
                {{ session('success') }}
            </div>
        @endif
        <div class="table-boxes">
            <table class="table table-hover table-bordered ">
                <thead>
                    <tr>
                        <th style='text-align:center' scope="col">#</th>
                        <th style='text-align:center' scope="col">ชื่อ</th>
                        <th style='text-align:center' scope="col">ตำแหน่ง</th>
                        <th style='text-align:center' scope="col">ใช้งานเมื่อ</th>
                        <th style='text-align:center' scope="col">อัพเดทเมื่อ</th>
                        <th style='text-align:center' scope="col">สถานะ</th>
                        <th style='text-align:center' scope="col">จัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($emp as $item)
                        <tr>
                            <td style='text-align:center'>{{ $item->id }}</td>
                            <td style='text-align:center'>{{ $item->first_name . ' ' . $item->last_name }}</td>
                            <td style='text-align:center'>

                                @if ($item->roles_id == 2)
                                    <h5><span
                                            class="badge rounded-pill bg-primary">{{ $item->role->role_name }}</span>
                                    </h5>
                                @elseif ($item->roles_id == 3)
                                    <h5><span
                                            class="badge rounded-pill bg-warning text-dark">{{ $item->role->role_name }}</span>
                                    </h5>
                                @elseif ($item->roles_id == 4)
                                    <h5><span
                                            class="badge rounded-pill bg-info text-dark">{{ $item->role->role_name }}</span>
                                    </h5>
                                @else
                                    <h5><span class="badge bg-danger">{{ $item->role->role_name }}</span></h5>
                                @endif


                            </td>
                            <td style='text-align:center'>{{ Carbon\Carbon::parse($item->created_at)->diffForHumans() }}
                            </td>
                            <td style='text-align:center'>{{ Carbon\Carbon::parse($item->updated_at)->diffForHumans() }}
                            </td>
                            <td style='text-align:center'>


                                @if ($item->status == true)
                                    <h5><span class="badge bg-success">ใช้งาน</span></h5>
                                @else
                                    <h5><span class="badge bg-danger">ยกเลิก</span></h5>
                                @endif

                            <td style='text-align:center'>
                                <a href="#" data-bs-toggle="modal"
                                data-bs-target="#employee{{ $item->id }}" class="btn btn-primary">แก้ไขข้อมูล</a>
                            </td>
                        </tr>
                </tbody>



                <!-- Modal -->
                <div class="modal fade" id="employee{{ $item->id }}" tabindex="-1" aria-labelledby="AddCateModal" aria-hidden="true"
                    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">

                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header" p>
                                <h5 class="modal-title" id="employeeLabel">จัดการพนักงาน</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <fieldset disabled>
                                        <div class="mb-3">
                                            <label for="disabledTextInput" class="form-label">ชื่อ - นามสกุล</label>
                                            <input type="text" id="disabledTextInput" class="form-control"
                                                placeholder="{{ $item->first_name . ' ' . $item->last_name }}">
                                        </div>

                                        <div class="mb-3">
                                            <label for="disabledTextInput" class="form-label">อีเมล์</label>
                                            <input type="text" id="disabledTextInput" class="form-control"
                                                placeholder="{{ $item->email }}">
                                        </div>

                                        <div class="mb-3">
                                            <label for="disabledTextInput" class="form-label">เบอร์โทรศัพท์</label>
                                            <input type="text" id="disabledTextInput" class="form-control"
                                                placeholder="{{ $item->phone }}">
                                        </div>

                                        <div class="mb-3">
                                            <label for="disabledTextInput" class="form-label">ที่อยู่</label>
                                            <input type="text" id="disabledTextInput" class="form-control"
                                                placeholder="{{ $item->address }}">
                                        </div>
                                    </fieldset>
                                </form>

                                <form action="{{ url('/employee/update/' . $item->id) }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="Roles" class="form-label">ตำแหน่ง</label>
                                        <select class="form-select" aria-label="Roles" Name="Roles">
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->id }}"
                                                    {{ $item->role->id == $role->id ? 'selected' : '' }}>
                                                    {{ $role->role_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="Status" class="form-label">สถานะ</label>
                                        <select class="form-select" aria-label="Status" name="Status">
                                            <option value="1" {{ old('status', $item->status) === 1 ? 'selected' : '' }}>
                                                ใช้งาน</option>
                                            <option value="0" {{ old('status', $item->status) === 0 ? 'selected' : '' }}>
                                                ยกเลิก</option>
                                        </select>
                                    </div>



                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                                <input type="submit" value="บันทึก" class="btn btn-primary">
                            </div>
                            </form>
                        </div>
                    </div>

                </div>

                @endforeach
            </table>
        </div>






    </div>
    </div>
    <!-- End Content -->
@section('scripts')
    <script>
        $(document).ready(function() {

            $("body").click(function() {
                $("#success_messages").css("display", "none");
            })
        });
    </script>
@endsection
@endsection
