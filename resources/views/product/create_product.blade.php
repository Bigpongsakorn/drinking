@extends('layouts.admin.main')
@section('content')
    <div class="pcoded-content">

        <div class="page-header card">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class=" fa fa-shopping-basket bg-c-blue"></i>
                        <div class="d-inline">
                            <h5>จัดการข้อมูลสินค้า</h5>
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
                                        <h5>เพิ่มข้อมูลสินค้า</h5>
                                    </div>
                                    <div class="card-block">
                                        {{-- <form> --}}
                                        <div class="form-group row">
                                            <div class="col-sm-1"></div>
                                            <div class="col-sm-10">
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                        <label class="col-form-label red">* รูปภาพสินค้า</label>
                                                        <input type="file" class="form-control" name="input_file"
                                                            id="input_file">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <label class="col-form-label red">* ชื่อสินค้า</label>
                                                        <input type="text" class="form-control" name="username" id="name"
                                                            placeholder="ชื่อสินค้า">
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label class="col-form-label red">* ราคาสินค้า</label>
                                                        <input type="number" class="form-control" name="price" id="price"
                                                            placeholder="ราคาสินค้า">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label red">* ประเภทสินค้า</label>
                                                    <div class="col-sm-9">
                                                        <select name="select" class="form-control" name="type" id="type">
                                                            <option value="">ประเภทสินค้า</option>
                                                            @foreach ($type as $value)
                                                                <option value="{{ $value->product_t_id }}">
                                                                    {{ $value->product_t_name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label red">* ปริมาณหน่วยสินค้า</label>
                                                    <div class="col-sm-9">
                                                        <select name="select" class="form-control" name="unit" id="unit">
                                                            <option value="">ปริมาณหน่วยสินค้า</option>
                                                            @foreach ($unit as $value)
                                                                <option value="{{ $value->unit_id }}">
                                                                    {{ $value->unit_name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <label class="col-form-label red">* จำนวน</label>
                                                        <input type="number" class="form-control" name="total" id="total"
                                                            placeholder="จำนวนคงเหลือ">
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label class="col-form-label red">* หน่วย</label>
                                                        <input type="text" class="form-control" name="punit" id="punit"
                                                            placeholder="ชิ้น">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <label class="col-form-label">วัตถุดิบประกอบสินค้า</label>
                                                        <select name="select" class="form-control material" name="" id="">
                                                            <option value="">วัตถุดิบประกอบสินค้า</option>
                                                            @foreach ($mat as $value)
                                                                <option value="{{ $value->material_id }}">
                                                                    {{ $value->material_name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label class="col-form-label">จำนวน</label>
                                                        <input type="text" class="form-control quan" name="" id=""
                                                            placeholder="">
                                                    </div>
                                                </div>
                                                <span id="add-row"></span>
                                                <div class="col-sm-12" style="margin-bottom: 2%">
                                                    <button id="btn-row" class="btn btn-sm btn-primary">+</button>
                                                </div>
                                                <div class="form-group row">
                                                    <div style="margin: auto">
                                                        <button type="submit" class="btn btn-sm btn-success"
                                                            id="create-user">เพิ่มข้อมูล</button>
                                                        <a href="{{ url('/product/index') }}">
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
        $(document).ready(function() {

            $('body').on('click', '#btn-row', function() {

                $('#add-row').append(' <div class="form-group row">\
                                            <div class="col-sm-6">\
                                                <label class="col-form-label">วัตถุดิบประกอบสินค้า</label>\
                                                <select name="select" class="form-control material" name="" id="">\
                                                    <option value="">วัตถุดิบประกอบสินค้า</option>\
                                                    @foreach ($mat as $value)\
                                                        <option value="{{ $value->material_id }}">\
                                                            {{ $value->material_name }}\
                                                        </option>\
                                                    @endforeach\
                                                </select>\
                                            </div>\
                                            <div class="col-sm-6">\
                                                <label class="col-form-label">จำนวน</label>\
                                                <input type="text" class="form-control quan" name="" id=""\
                                                    placeholder="">\
                                            </div>\
                                        </div>');
            });

            $('body').on('click', '#create-user', function() {
                // console.log('submit');
                var name = $('#name').val();
                var price = $('#price').val();
                var unit = $('#unit').val();
                var type = $('#type').val();
                var total = $('#total').val();
                var punit = $('#punit').val();
                var material = [];
                var material_ = $('.material')
                var quan = [];
                var quan_ = $('.quan')
                var input_file = $('#input_file').prop('files');
                var fd = new FormData();

                $.each(material_, function(index, value) {
                    var v = $(this).val()
                    material.push(v)
                });

                $.each(quan_, function(index, value) {
                    var v = $(this).val()
                    quan.push(v)
                });

                if (name && price && total && type && unit && punit && quan) {
                    fd.append('_token', "{{ csrf_token() }}");
                    fd.append('name', name);
                    fd.append('price', price);
                    fd.append('unit', unit);
                    fd.append('type', type);
                    fd.append('total', total);
                    fd.append('punit', punit);
                    fd.append('material', material);
                    fd.append('quan', quan);

                    jQuery.each(jQuery('#input_file')[0].files, function(i, file) {
                        fd.append('input_file', file);
                    });

                    $.ajax({
                        method: "POST",
                        url: "/drinking/public/product/store",
                        dataType: 'json',
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: fd,

                    }).done(function(rec) {

                        if (rec.status == '1') {
                            swal({
                                title: 'บันทึกข้อมูลสำเร็จ!',
                                text: "กดปุ่ม ok เพื่อดำเนินการต่อ!",
                                type: 'success',
                                padding: '2em'
                            }).then(function(then) {
                                // location.reload()
                                location.href = '/drinking/public/product/index'
                            })
                        } else {
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
