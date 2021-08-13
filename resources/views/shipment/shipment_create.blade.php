@extends('layouts.admin.main')
@section('content')
    <div class="pcoded-content">

        <div class="page-header card">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="fa fa-shopping-bag bg-c-blue"></i>
                        <div class="d-inline">
                            <h5>จัดการข้อมูลส่งสินค้า</h5>
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
                                        <h5>เพิ่มข้อมูลส่งสินค้า</h5>
                                    </div>
                                    <div class="card-block">
                                        <div class="form-group row">
                                            <div class="col-sm-2"></div>
                                            <div class="col-sm-10">
                                                <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <label class="col-form-label">รหัสลูกค้า : </label>
                                                        {{-- <label for="">{{ sprintf('%05d', $cus->cus_id) }}</label> --}}
                                                        <label for="">
                                                            <select name="select" id="cus_id"
                                                                class="form-control cus_id select_cus">
                                                                <option value="">-- รหัสลูกค้า --</option>
                                                                @foreach ($customer as $item)
                                                                    <option value="{{ $item->cus_id }}">
                                                                        {{ sprintf('%05d', $item->cus_id) }} </option>
                                                                @endforeach
                                                            </select>
                                                        </label>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label class="col-form-label">ชื่อจริง - นามสกุล : </label>
                                                        <label for="" id="cus_title"></label> <label for=""
                                                            id="cus_fristname"></label> <label for=""
                                                            id="cus_lastname"></label>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <label class="col-form-label">เบอร์โทรศัพท์ : </label>
                                                        <label id="cus_phonenumber"></label>
                                                    </div>
                                                </div>
                                                {{-- <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <label class="col-form-label">ข้อมูลสินค้า : </label><br>
                                                        <label class="col-sm-12" id="product_name"></label> --}}
                                                {{-- @foreach ($cus_p as $item)
                                                            <div>
                                                                <label style="font-weight: bold;">{{ $item->product_name }}</label>
                                                            </div>
                                                        @endforeach --}}
                                                {{-- <div>
                                                            <button type="button" data-target="#exampleModal"
                                                                data-toggle="modal"
                                                                class="btn btn-sm btn-primary">เพิ่มข้อมูลสินค้า</button>
                                                        </div> --}}
                                                {{-- </div>
                                                </div> --}}
                                                <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <label class=" col-form-label">บ้านเลขที่/หมู่บ้าน : </label>
                                                        <label id="cus_address"></label>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <label class="col-form-label">จังหวัด : </label>
                                                        <label id="province_name"></label>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label class="col-form-label">อำเภอ : </label>
                                                        <label id="district_name"></label>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <label class="col-form-label">ตำบล : </label>
                                                        <label id="subdistrict_name"></label>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label class="col-form-label">รหัสไปรษณีย์ : </label>
                                                        <label id="cus_zipcode"></label>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <label class="col-form-label">วันที่จัดส่ง</label>
                                                        {{-- <label for="" id="cus_date"></label> --}}
                                                        <input type="date" class="form-control" id="ship_date">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <label class="col-form-label">ข้อมูลสินค้า</label>
                                                        <select name="" id="" class="form-control product_id">
                                                            <option value="">--เลือกสินค้า--</option>
                                                            @foreach ($product as $item)
                                                            <option value="{{ $item->product_id }}">
                                                                    {{ $item->product_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label class="col-form-label">จำนวน</label>
                                                        <input type="number" class="form-control product_num" id="">
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
                                                        <a href="{{ url('/customer/index') }}">
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
                                <label class="col-form-label">ข้อมูลสินค้า</label>
                                <select name="" id="" class="form-control product_id">
                                    <option value="">--เลือกสินค้า--</option>
                                    @foreach ($product as $item)
                                    <option value="{{ $item->product_id }}">
                                            {{ $item->product_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label class="col-form-label">จำนวน</label>
                                <input type="number" class="form-control product_num" id="">
                            </div>
                        </div>`;
                $("#add-row").append(html);
            });

            $('body').on('click', '#create-insert', function() {
                // e.preventDefault();
                // console.log('insert');
                var product_id = [];
                var product_id_ = $('.product_id')
                var product_num = [];
                var product_num_ = $('.product_num')
                
                var cus_id = $('#cus_id').val()
                var ship_date = $('#ship_date').val()
                var fd = new FormData();

                $.each(product_id_, function(index, value) {
                    var v = $(this).val()
                    product_id.push(v)
                });

                $.each(product_num_, function(index, value) {
                    var v = $(this).val()
                    product_num.push(v)
                });

                console.log(cus_id);
                console.log(product_id);
                console.log(product_num);

                if (cus_id != "" && product_id != "" && product_num != "") {
                    fd.append('_token', "{{ csrf_token() }}");
                    fd.append('cus_id', cus_id);
                    fd.append('product_id', product_id);
                    fd.append('product_num', product_num);
                    fd.append('ship_date', ship_date);

                    $.ajax({
                        method: "POST",
                        url: "/shipment/insert",
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
                                location.href = '/shipment/shipment_index'
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

            $('body').on('change', '.select_cus', function() {
                var id = $('.select_cus').val()
                console.log(id)

                $.ajax({
                        method: "POST",
                        url: "/select_customer",
                        data: {
                            "id": id,
                            "_token": $('meta[name="csrf-token"]').attr('content'),
                        }
                    })
                    .done(function(msg) {
                        var data = JSON.parse(msg);
                        var pros = JSON.parse(msg);
                        data = data.cus;
                        pro = pros.pro;
                        var title = '';
                        // console.log(data)
                        console.log(pro)
                        if (data.cus_title == 1) {
                            title = 'นาย'

                        } else if (data.cus_title == 2) {
                            title = 'นาง'
                        } else {
                            title = 'นางสาว'
                        }
                        $('#cus_fristname').html(data.cus_fristname)
                        $('#cus_lastname').html(data.cus_lastname)
                        $('#cus_title').html(title)
                        // $('#cus_date').html(data.cus_date)
                        $('#cus_phonenumber').html(data.cus_phonenumber)
                        $('#cus_address').html(data.cus_address)
                        $('#province_name').html(data.province_name)
                        $('#district_name').html(data.district_name)
                        $('#subdistrict_name').html(data.subdistrict_name)
                        $('#cus_zipcode').html(data.cus_zipcode)

                        // $('#product_name').html(pro.product_name)

                        // $.each(pro, function(index, value) {
                        //     console.log(value)
                        //     $('#product_name').append('<label id="">' + value.product_name +
                        //         '</label><input type="number" class="form-control" name="" id="" placeholder="" ><br>'
                        //     )
                        // });

                    });

            });
        });
    </script>
@endsection
