@extends('layouts.admin.main')
@section('content')
<div class="pcoded-content">

    <div class="page-header card">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="icon-people bg-c-blue"></i>
                    <div class="d-inline">
                        <h5>จัดการข้อมูลลูกค้า</h5>
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
                                    <h5>เพิ่มข้อมูลลูกค้า</h5>
                                </div>
                                <div class="card-block">
                                    {{-- <form> --}}
                                    <div class="form-group row">
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-10">
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <label class="col-sm-2 col-form-label">เพศ : </label>
                                                    <div class="form-check form-check-inline">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" type="radio" name="gender"
                                                                id="radio1" value="1"> ชาย
                                                        </label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" type="radio" name="gender"
                                                                value="2"> หญิง
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label class="col-sm-3 col-form-label">คำนำหน้า : </label>
                                                    <div class="form-check form-check-inline">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" type="radio" name="title"
                                                                id="radio2" value="1"> นาย
                                                        </label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" type="radio" name="title"
                                                                value="2">
                                                            นาง
                                                        </label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" type="radio" name="title"
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
                                                        placeholder="ชื่อจริง">
                                                </div>
                                                <div class="col-sm-6">
                                                    <label class="col-form-label">นามสกุล</label>
                                                    <input type="text" class="form-control" name="lname" id="lname"
                                                        placeholder="นามสกุล">
                                                </div>
                                            </div>

                                            <div class="form-group row">

                                                <div class="col-sm-6">
                                                    <label class="col-form-label">วันที่จัดส่ง</label>
                                                    <select name="select" class="form-control" name="date" id="date">
                                                        <option value="">---วันที่จัดส่ง---</option>
                                                        <option value="จันทร์">จันทร์</option>
                                                        <option value="อังคาร">อังคาร</option>
                                                        <option value="พุธ">พุธ</option>
                                                        <option value="พฤหัสบดี">พฤหัสบดี</option>
                                                        <option value="ศุกร์">ศุกร์</option>
                                                        <option value="เสาร์">เสาร์</option>
                                                        <option value="อาทิตย์">อาทิตย์</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label class="col-form-label">เบอร์โทรศัพท์</label>
                                                    <input type="text" class="form-control" placeholder="เบอร์โทรศัพท์"
                                                        maxlength="10" name="tel" id="tel">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">บ้านเลขที่/หมู่บ้าน</label>
                                                <div class="col-sm-10">
                                                    <textarea rows="5" cols="5" class="form-control" name="address"
                                                        id="address" placeholder="กรุณากรอกรายละเอียด"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <label class="col-form-label">จังหวัด</label>
                                                    <select name="select" class="form-control" name="province"
                                                        id="province">
                                                        <option value="">เลือกจังหวัด</option>
                                                        @foreach ($province as $item)
                                                        <option value="{{$item->province_id}}">{{$item->province_name}}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label class="col-form-label">อำเภอ</label>
                                                    <select name="select" class="form-control" name="district"
                                                        id="district" disabled>
                                                        <option value="">เลือกอำเภอ</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <label class="col-form-label">ตำบล</label>
                                                    <select name="select" class="form-control" name="subdistrict"
                                                        id="subdistrict" disabled>
                                                        <option value="">เลือกตำบล</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label class="col-form-label">รหัสไปรษณีย์</label>
                                                    <select name="select" class="form-control" name="zipcode"
                                                        id="zipcode" disabled>
                                                        <option value="">เลือกรหัสไปรษณีย์</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div style="margin: auto">
                                                    <button type="submit" class="btn btn-sm btn-success"
                                                        id="create-user">เพิ่มข้อมูล</button>
                                                    <a href="{{url('/customer/index')}}">
                                                        <button class="btn btn-sm btn-secondary btn-form" type="reset">
                                                            กลับไปหน้าก่อนหน้า
                                                        </button>
                                                    </a>
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

        $("#radio1").prop("checked", true);
        $("#radio2").prop("checked", true);

        $('body').on('click', '#create-user', function () {
            console.log('submit');

            var gender = $("input[name='gender']:checked").val();
            var title = $("input[name='title']:checked").val();
            var fname = $('#fname').val();
            var lname = $('#lname').val();
            var date = $('#date').val();
            var tel = $('#tel').val();
            var address = $('#address').val();
            var province = $('#province').val();
            var district = $('#district').val();
            var subdistrict = $('#subdistrict').val();
            var zipcode = $('#zipcode').val();

            var fd = new FormData();

            if (fname && lname && date && province && district && district && zipcode && tel) {
                fd.append('_token', "{{ csrf_token() }}");


                fd.append('gender', gender);
                fd.append('title', title);
                fd.append('tel', tel);
                fd.append('fname', fname);
                fd.append('lname', lname);
                fd.append('date', date);

                fd.append('address', address);
                fd.append('province', province);
                fd.append('district', district);
                fd.append('subdistrict', subdistrict);
                fd.append('zipcode', zipcode);

                $.ajax({
                    method: "POST",
                    url: "/drinking/public/customer/store",
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
                            // location.reload()
                            location.href = '/drinking/public/customer/index'
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
