@extends('layouts.admin.main')
@section('content')
    <div class="pcoded-content">

        <div class="page-header card">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="fa fa-truck bg-c-blue"></i>
                        <div class="d-inline">
                            <h5>จัดการข้อมูลเก็บคืน</h5>
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
                                        <h5>เพิ่มข้อมูลการเก็บคืน</h5>
                                    </div>
                                    <div class="card-block">
                                        <div class="form-group row">
                                            <div class="col-sm-2"></div>
                                            <div class="col-sm-10">
                                                <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <label class="col-form-label">รหัสลูกค้า : </label>
                                                        <label for="">
                                                            <label class="col-form-label">{{ sprintf('%05d', $customer->cus_id) }}</label>
                                                            <input type="hidden" name="" id="cus_id" value="{{ $customer->cus_id }}">
                                                        </label>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label class="col-form-label">ชื่อจริง - นามสกุล : </label>
                                                        <label>
                                                            @if ($customer->cus_title == 1)
                                                                นาย
                                                            @elseif($customer->cus_title == 2)
                                                                นาง
                                                            @else
                                                                นางสาว
                                                            @endif
                                                            {{ $customer->cus_fristname }} {{ $customer->cus_lastname }}
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <label class="col-form-label">เบอร์โทรศัพท์ : </label>
                                                        <label id="cus_phonenumber">{{ $customer->cus_phonenumber }}</label>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <label class=" col-form-label">บ้านเลขที่/หมู่บ้าน : </label>
                                                        <label id="cus_address">{{ $customer->cus_address }}</label>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <label class="col-form-label">จังหวัด : </label>
                                                        <label id="province_name">{{ $customer->province_name }}</label>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label class="col-form-label">อำเภอ : </label>
                                                        <label id="district_name">{{ $customer->district_name }}</label>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <label class="col-form-label">ตำบล : </label>
                                                        <label id="subdistrict_name">{{ $customer->subdistrict_name }}</label>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label class="col-form-label">รหัสไปรษณีย์ : </label>
                                                        <label id="cus_zipcode">{{ $customer->zip_code }}</label>
                                                    </div>
                                                </div>
                                                {{-- <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <label class="col-form-label red">* วันที่เก็บสินค้า</label>
                                                        <input type="date" class="form-control" id="return_date">
                                                    </div>
                                                </div> --}}
                                                <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <label class="col-form-label red">* ข้อมูลวัตถุดิบ</label>
                                                        <select name="" id="" class="form-control material_id">
                                                            <option value="">--เลือกวัตถุดิบ--</option>
                                                            @foreach ($material as $item)
                                                                <option value="{{ $item->material_id }}">
                                                                    {{ $item->material_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label class="col-form-label red">* จำนวน</label>
                                                        <input type="number" class="form-control material_num" id="">
                                                    </div>
                                                </div>
                                                <div id="add-row"></div>
                                                <div class="form-group row">
                                                    <div class="col-sm-12" style="margin-bottom: 2%"><br>
                                                        <button id="addrow" class="btn btn-sm btn-primary">+</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-block">
                                        <div class="form-group row">
                                            <div class="col-sm-1"></div>
                                            <div class="col-sm-10">
                                                <div class="form-group row">
                                                    <div style="margin: auto">
                                                        <button type="submit" class="btn btn-sm btn-success"
                                                            id="create-insert">เพิ่มข้อมูล</button>
                                                        <a href="{{ url('/return/return_index') }}">
                                                            <button class="btn btn-sm btn-secondary btn-form" type="reset">
                                                                กลับไปหน้าก่อนหน้า
                                                            </button>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

@endsection

@section('js')
    <script>
        $(document).ready(function() {

            $("body").on('click', '#addrow', function() {
                // console.log("good");
                var html = "";
                html += `<div class="form-group row">
                            <div class="col-sm-6">
                                <label class="col-form-label red">* ข้อมูลวัตถุดิบ</label>
                                <select name="" id="" class="form-control material_id">
                                    <option value="">--เลือกวัตถุดิบ--</option>
                                    @foreach ($material as $item)
                                        <option value="{{ $item->material_id }}">
                                            {{ $item->material_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label class="col-form-label red">* จำนวน</label>
                                <input type="number" class="form-control material_num" id="">
                            </div>
                        </div>`;
                $("#add-row").append(html);
            });

            $('body').on('click', '#create-insert', function() {

                var material_id = [];
                var material_id_ = $('.material_id')
                var material_num = [];
                var material_num_ = $('.material_num')

                var cus_id = $('#cus_id').val()
                var fd = new FormData();

                $.each(material_id_, function(index, value) {
                    var v = $(this).val()
                    material_id.push(v)
                });

                $.each(material_num_, function(index, value) {
                    var v = $(this).val()
                    material_num.push(v)
                });

                if (cus_id) {
                    fd.append('_token', "{{ csrf_token() }}");
                    fd.append('cus_id', cus_id);
                    fd.append('material_id', material_id);
                    fd.append('material_num', material_num);

                    $.ajax({
                        method: "POST",
                        url: "/drinking/public/return/return_insert",
                        dataType: 'json',
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: fd,
                    }).done(function(rec) {
                        // rec = JSON.parse(rec);
                        if (rec.status == '1') {
                            swal({
                                title: 'บันทึกข้อมูลสำเร็จ!',
                                text: "กดปุ่ม ok เพื่อดำเนินการต่อ!",
                                type: 'success',
                                padding: '2em'
                            }).then(function(then) {
                                // location.reload()
                                location.href = '/drinking/public/return/return_index'
                            })
                        }
                        if (rec.status == '2') {
                            swal({
                                title: 'กรุณากรอกข้อมูลให้ครบถ้วน!',
                                text: "กดปุ่ม ok เพื่อดำเนินการต่อ!",
                                type: 'error',
                                padding: '2em'
                            })
                        }
                        if (rec.status == '0') {
                            swal({
                                title: 'บันทึกข้อมูลไม่สำเร็จ!',
                                text: "กดปุ่ม ok เพื่อดำเนินการต่อ!",
                                type: 'error',
                                padding: '2em'
                            })
                        }
                    }).fail(function() {
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
        });
    </script>
@endsection
