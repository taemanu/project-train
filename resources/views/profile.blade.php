@extends('layouts.dashboard')
@section('content')

    <div class="home_content ">
        @if (session('success'))
            <div class="error-boxes alert alert-success" id="success_messages1">
                {{ session('success') }}
            </div>
        @endif
        @error('f_name')<div class="error-boxes alert alert-danger" id="success_messages1">{{ $message }}</div>@enderror
        @error('l_name')<div class="error-boxes alert alert-danger" id="success_messages2">{{ $message }}</div>@enderror
        @error('mail')<div class="error-boxes alert alert-danger" id="success_messages3">{{ $message }}</div>@enderror
        @error('phone')<div class="error-boxes alert alert-danger" id="success_messages4">{{ $message }}</div>@enderror
        @error('address')<div class="error-boxes alert alert-danger" id="success_messages5">{{ $message }}</div>
        @enderror
        <div class="form-boxes">
            <div class="d-flex justify-content-between" style='padding: 10px;'>
                <h4>แก้ไขข้อมูลผู้ใช้</h4>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editpass">
                    เปลี่ยนรหัสผ่าน
                </button>
            </div>
            <hr>
            <form action="{{ route('update_user') }}" method="POST" id="myForm">
                @csrf
                <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                <div class="row">
                    <div class="col m-2">
                        <label for="f_name" class="form-label">ชื่อ</label>
                        <input type="text" class="form-control" name="f_name" id="f_name"
                            value="{{ Auth::user()->first_name }}">
                    </div>
                    <div class="col m-2">
                        <label for="l_name" class="form-label">นามสกุล</label>
                        <input type="text" class="form-control" name="l_name" id="l_name"
                            value="{{ Auth::user()->last_name }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col m-2">
                        <fieldset disabled>
                            <label for="mail" class="form-label">อีเมล์</label>
                            <input type="email" name="mail" id="mail" class="form-control"
                                value="{{ Auth::user()->email }}">
                        </fieldset>
                    </div>
                    <div class="col m-2">
                        <label for="phone" class="form-label">เบอร์โทรศัพท์</label>
                        <input id="phone" type="text" class="form-control" name="phone"
                            value="{{ Auth::user()->phone }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col m-2">
                        <label for="phone" class="form-label">ที่อยู่</label>
                        <textarea class="form-control" id="phone" rows="3"
                            name="address">{{ Auth::user()->address }}</textarea>
                    </div>
                </div>
                <div class="col d-flex justify-content-end">
                    {{-- <button type="reset" class="btn btn-secondary m-1">ยกเลิก</button> --}}
                    <button type="submit" class="btn btn-primary m-1">ยืนยัน</button>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="editpass" tabindex="-1" aria-labelledby="editpass" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProductModalLabel">เปลี่ยนรหัสผ่าน</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('changPassword') }}" method="POST" id="changPasswordForm">
                        @csrf

                        <label for="oldpass" class="form-label">รหัสผ่านเดิม</label>
                        <div class="input-group mb-1">
                            <input type="password" class="form-control" aria-describedby="button-addon2" name="oldpass" id="password">
                            <button class="btn btn-light btn-outline-secondary" id="oldpass" type="button"><i class='bx bx-low-vision'></i></button>
                        </div>
                        <div><span class="text-danger error-text oldpass_error"></span></div>

                        <label for="newpass" class="form-label">รหัสผ่านใหม่</label>
                        <div class="input-group mb-1">
                            <input type="password" class="form-control" aria-describedby="button-addon2" name="newpass" id="password1">
                            <button class="btn btn-light btn-outline-secondary" id="newpass" type="button"><i class='bx bx-low-vision'></i></button>
                        </div>
                        <div><span class="text-danger error-text newpass_error"></span></div>

                        <label for="confirmpass" class="form-label">ยืนยันรหัสผ่านใหม่</label>
                        <div class="input-group mb-1">
                            <input type="password" class="form-control" aria-describedby="button-addon2" name="confirmpass" id="password2">
                            <button class="btn btn-light btn-outline-secondary" id="confirmpass" type="button"><i class='bx bx-low-vision'></i></button>
                        </div>
                        <div><span class="text-danger error-text confirmpass_error"></span></div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                    <button type="submit" class="btn btn-primary">แก้ไข</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    </div>

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#oldpass').on('click', function() {
                var input = $('#password').attr('type');
                if (input === 'password') {
                    $('#password').attr('type', 'text');
                } else {
                    $('#password').attr('type', 'password');
                }
            });
            $('#newpass').on('click', function() {
                var input = $('#password1').attr('type');
                if (input === 'password') {
                    $('#password1').attr('type', 'text');
                } else {
                    $('#password1').attr('type', 'password');
                }
            });
            $('#confirmpass').on('click', function() {
                var input = $('#password2').attr('type');
                if (input === 'password') {
                    $('#password2').attr('type', 'text');
                } else {
                    $('#password2').attr('type', 'password');
                }
            });

            $("body").click(function() {
                $("#success_messages1").css("display", "none");
                $("#success_messages2").css("display", "none");
                $("#success_messages3").css("display", "none");
                $("#success_messages4").css("display", "none");
                $("#success_messages5").css("display", "none");
            });


            $('#changPasswordForm').on('submit', function(e) {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: $(this).attr('action'),
                    method: $(this).attr('method'),
                    data: new FormData(this),
                    processData: false,
                    dataType: 'json',
                    contentType: false,
                    beforeSend: function() {
                        $(document).find('span.error-text').text('');
                    },
                    success: function(data) {
                        if (data.status == 0) {
                            $.each(data.error, function(prefix, val) {
                                $('span.' + prefix + '_error').text(val[0]);
                            });
                        } else {
                            $('#changPasswordForm')[0].reset();
                            alert(data.msg);
                        }
                    }
                });
            });

        });
    </script>
@endsection
@endsection
