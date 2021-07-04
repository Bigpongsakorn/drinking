@extends('layouts.admin.main')
@section('content')
<div class="pcoded-content">

    <div class="page-header card">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class=" icon-user bg-c-blue"></i>
                    <div class="d-inline">
                        <h5>จัดการข้อมูลผู้ใช้งาน</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="pcoded-inner-content">

        <div class="main-body">
            <div class="page-wrapper">

                <div class="page-body">
                    <div class="row">
                        <div class="col-sm-12">

                            <div class="card">
                                <div class="card-header">
                                    <h5>แก้ไขข้อมูลผู้ใช้งาน</h5>
                                </div>
                                <div class="card-block">
                                    {{-- <form> --}}
                                    <div class="form-group row">
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-10">
                                            <div class="form-group row">
                                                @if($user_d->user_d_image == null)
                                                <img src="{{url('/upload/users/user.png')}}" alt=""
                                                    style="margin: auto;"
                                                    width="25%">
                                                @else
                                                <img src="{{url('/upload/users/'.$user_d->user_d_image)}}" alt=""
                                                    style="margin: auto;" width="25%">
                                                @endif
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Upload File</label>
                                                <div class="col-sm-10">
                                                    <input type="file" class="form-control" name="input_file"
                                                        id="input_file">
                                                </div>
                                            </div>
                                            <input type="hidden" name="id" id="id" value="{{$user->user_id}}">
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <label class="col-form-label">ชื่อผู้ใช้งานระบบ</label>
                                                    <input type="text" class="form-control" name="username"
                                                        id="username" value="{{$user->username}}" readonly>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label class="col-form-label">รหัสผ่าน</label>
                                                    <input type="password" class="form-control" name="password"
                                                        id="password" value="********" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">ประเภทผู้ใช้งาน</label>
                                                <div class="col-sm-10">
                                                    <select name="select" class="form-control" name="type" id="type">
                                                        <option value="">ประเภทผู้ใช้งาน</option>
                                                        @foreach ($position as $value)
                                                        <option value="{{$value->position_id}}" @if($value->position_id
                                                            ==
                                                            $user->user_type) {{"selected"}} @endif>
                                                            {{$value->position_name}}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <label class="col-sm-2 col-form-label">เพศ : </label>
                                                    <div class="form-check form-check-inline">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" type="radio" name="gender"
                                                                @if($user_d->user_d_gender == 1 ) {{"checked"}} @endif
                                                            value="1"> ชาย
                                                        </label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" type="radio" name="gender"
                                                                @if($user_d->user_d_gender == 2 ) {{"checked"}} @endif
                                                            value="2">
                                                            หญิง
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label class="col-sm-3 col-form-label">คำนำหน้า : </label>
                                                    <div class="form-check form-check-inline">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" type="radio" name="title"
                                                                @if($user_d->user_d_title == 1 ) {{"checked"}} @endif
                                                            value="1"> นาย
                                                        </label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" type="radio" name="title"
                                                                @if($user_d->user_d_title == 2 ) {{"checked"}} @endif
                                                            value="2">
                                                            นาง
                                                        </label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" type="radio" name="title"
                                                                @if($user_d->user_d_title == 3 ) {{"checked"}} @endif
                                                            value="3">
                                                            นางสาว
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <label class="col-form-label">ชื่อจริง</label>
                                                    <input type="text" class="form-control" name="fname" id="fname"
                                                        value="{{$user_d->user_d_fname}}">
                                                </div>
                                                <div class="col-sm-6">
                                                    <label class="col-form-label">นามสกุล</label>
                                                    <input type="text" class="form-control" name="lname" id="lname"
                                                        value="{{$user_d->user_d_lanme}}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <label class="col-form-label">วันเกิด</label>
                                                    <input type="date" class="form-control" name="bday" id="bday"
                                                        value="{{$user_d->user_d_birthday}}">
                                                </div>
                                                <div class="col-sm-6">
                                                    <label class="col-form-label">หมายเลขบัตรประชาชน</label>
                                                    <input type="text" class="form-control" name="idcart" id="idcart"
                                                        value="{{$user_d->user_d_idcart}}" maxlength="13">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <label class="col-form-label">อีเมล์</label>
                                                    <input type="text" class="form-control" name="email" id="email"
                                                        value="{{$user_d->user_d_email}}">
                                                </div>
                                                <div class="col-sm-6">
                                                    <label class="col-form-label">เบอร์โทรศัพท์</label>
                                                    <input type="text" class="form-control"
                                                        value="{{$user_d->user_d_tel}}" maxlength="10" name="tel"
                                                        id="tel">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">บ้านเลขที่/หมู่บ้าน</label>
                                                <div class="col-sm-10">
                                                    <textarea rows="5" cols="5" class="form-control" name="address"
                                                        id="address">{{$user_d->user_d_address}}</textarea>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <label class="col-form-label">จังหวัด</label>
                                                    <select name="select" class="form-control" name="province"
                                                        id="province">
                                                        <option value="">เลือกจังหวัด</option>
                                                        @foreach ($province as $item)

                                                        <option value="{{$item->province_id}}" @if($item->province_id ==
                                                            $user_d->user_d_province)
                                                            {{"selected"}} @endif >
                                                            {{$item->province_name}}
                                                        </option>

                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label class="col-form-label">อำเภอ</label>
                                                    <select name="select" class="form-control" name="district"
                                                        id="district" disabled>
                                                        <option value="">เลือกอำเภอ</option>
                                                        @foreach ($district as $item)
                                                        <option value="{{$item->district_id}}" @if($item->district_id ==
                                                            $user_d->user_d_district)
                                                            {{"selected"}}@endif>
                                                            {{$item->district_name}}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <label class="col-form-label">ตำบล</label>
                                                    <select name="select" class="form-control" name="subdistrict"
                                                        id="subdistrict" disabled>
                                                        <option value="">เลือกตำบล</option>
                                                        @foreach ($subistrict as $item)
                                                        <option value="{{$item->subdistrict_id}}" @if($item->
                                                            subdistrict_id ==
                                                            $user_d->user_d_subdistrict)
                                                            {{"selected"}}@endif>
                                                            {{$item->subdistrict_name}}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label class="col-form-label">รหัสไปรษณีย์</label>
                                                    <select name="select" class="form-control" name="zipcode"
                                                        id="zipcode" disabled>
                                                        <option value="">เลือกรหัสไปรษณีย์</option>
                                                        @foreach ($subistrict as $item)
                                                        <option value="{{$item->zip_code}}" @if($item->zip_code ==
                                                            $user_d->user_d_zipcode)
                                                            {{"selected"}}@endif>
                                                            {{$item->zip_code}}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div style="margin: auto">
                                                    <button type="submit" class="btn btn-sm btn-success"
                                                        id="create-user">แก้ไขข้อมูล</button>
                                                    <a href="{{url('/user/index')}}">
                                                        <button class="btn btn-sm btn-secondary btn-form" type="reset">
                                                            กลับไปหน้าก่อนหน้า
                                                        </button>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- </form> --}}
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>

        {{-- <div id="styleSelector">
        </div> --}}
    </div>
</div>
@endsection

@section('js')

<script>
    $(document).ready(function () {


        $('body').on('click', '#create-user', function () {
            // console.log('submit');
            var id = $('#id').val();
            var username = $('#username').val();
            var password = $('#password').val();
            var email = $('#email').val();
            var gender = $("input[name='gender']:checked").val();
            var title = $("input[name='title']:checked").val();
            var fname = $('#fname').val();
            var lname = $('#lname').val();
            var bday = $('#bday').val();
            var idcart = $('#idcart').val();
            var tel = $('#tel').val();
            var address = $('#address').val();
            var type = $('#type').val();
            var province = $('#province').val();
            var district = $('#district').val();
            var subdistrict = $('#subdistrict').val();
            var zipcode = $('#zipcode').val();
            var input_file = $('#input_file').prop('files');
            var fd = new FormData();

            if (username && password && email && type) {
                fd.append('_token', "{{ csrf_token() }}");
                fd.append('id', id);
                fd.append('username', username);
                fd.append('password', password);
                fd.append('email', email);
                fd.append('gender', gender);
                fd.append('title', title);
                fd.append('type', type);
                fd.append('fname', fname);
                fd.append('lname', lname);
                fd.append('bday', bday);
                fd.append('idcart', idcart);
                fd.append('tel', tel);
                fd.append('address', address);
                fd.append('province', province);
                fd.append('district', district);
                fd.append('subdistrict', subdistrict);
                fd.append('zipcode', zipcode);

                jQuery.each(jQuery('#input_file')[0].files, function (i, file) {
                    fd.append('input_file', file);
                });

                $.ajax({
                    method: "POST",
                    url: "/drinking/public/user/update",
                    dataType: 'json',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: fd,

                }).done(function (rec) {

                    if (rec.status == '1') {
                        swal({
                            title: 'บันทึกสำเร็จ!',
                            text: "กดปุ่ม ok เพื่อดำเนินการต่อ!",
                            type: 'success',
                            padding: '2em'
                        }).then(function (then) {
                            location.reload()
                        })
                    } else {
                        swal({
                            title: 'บันทึกไม่สำเร็จ!',
                            text: "กดปุ่ม ok เพื่อดำเนินการต่อ!",
                            type: 'error',
                            padding: '2em'
                        })
                    }
                }).fail(function () {
                    swal("Error!", "You clicked the button!", "error");
                })

            } else {
                swal({
                    title: 'กรุณากรอกข้อมูลให้ครบถ้วน!',
                    text: "กดปุ่ม ok เพื่อดำเนินการต่อ!",
                    type: 'error',
                    padding: '2em'
                })
            }

        });

        $('body').on('change', '#province', function () {
            var id = $(this).val();
            $('#district').attr('disabled', false)
            $.ajax({
                    method: "POST",
                    url: "/drinking/public/province",
                    data: {
                        "id": id,
                        "_token": $('meta[name="csrf-token"]').attr('content'),
                    }

                })
                .done(function (msg) {
                    var data = JSON.parse(msg);
                    data = data.data;
                    var distic = '<option value="">เลือกอำเภอ</option>';
                    data.forEach(element => {
                        distic += '<option value="' + element.district_id + '">' + element
                            .district_name + '</option>';
                    });
                    // console.log(distic);
                    $('#district').html('').append(distic)
                });
        });
        $('#district').change(function () {
            var id = $(this).val();
            $('#subdistrict').attr('disabled', false)
            $('#zipcode').attr('disabled', false)
            $.ajax({
                    method: "POST",
                    url: "/drinking/public/subdistrict",
                    data: {
                        "id": id,
                        "_token": $('meta[name="csrf-token"]').attr('content'),
                    }

                })
                .done(function (msg) {
                    var data = JSON.parse(msg);
                    data = data.data;
                    var subdistic = '<option value="">เลือกตำบล</option>';
                    var zipcode = '<option value="">เลือกรหัสไปรษณีย์</option>';
                    data.forEach(element => {
                        subdistic += '<option value="' + element.subdistrict_id + '">' +
                            element.subdistrict_name + ' </option>';
                    });
                    var b = 0;
                    data.forEach(element => {
                        if (!b)
                            zipcode += '<option value="' + element.zip_code + '">' + element
                            .zip_code + '</option>';
                        b++;
                    });
                    $('#subdistrict').html('').append(subdistic)
                    $('#zipcode').html('').append(zipcode)
                });
        });

    });

</script>

@endsection
