@extends('layouts.admin.main')
@section('content')
    <div class="pcoded-content">

        <div class="page-header card">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="fa fa-newspaper-o bg-c-blue"></i>
                        <div class="d-inline">
                            <h5>จัดการข้อมูลการเบิกสินค้า</h5>
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
                                        <h5>เพิ่มข้อมูลเบิกสินค้า</h5>
                                    </div>
                                    <div class="card-block">
                                        <div class="form-group row">
                                            <div class="col-sm-1"></div>
                                            <div class="col-sm-10">
                                                <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <label class="col-form-label">รายการเบิกสินค้า</label>
                                                        <input type="text" class="form-control withdraw_p_name" name="name"
                                                            id="name" placeholder="รายการเบิกสินค้า">
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label class="col-form-label">วันที่</label>
                                                        <input type="date" class="form-control withdraw_p_date" name="date"
                                                            id="date">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12" id="addrow">
                                <div class="card count">
                                    <div class="card-block">
                                        <div class="form-group row">
                                            <div class="col-sm-1"></div>
                                            <div class="col-sm-10">
                                                <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <label class="col-form-label">ชื่อสินค้า</label>
                                                        <select name="select" class="form-control product_id" name="product"
                                                            id="product">
                                                            <option value="">ข้อมูลสินค้า</option>
                                                            @foreach ($product as $value)
                                                                <option value="{{ $value->product_id }}">
                                                                    {{ $value->product_name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label class="col-form-label">จำนวนสินค้า</label>
                                                        <input type="number" class="form-control withdraw_p_num"
                                                            name="number" id="number" placeholder="จำนวนสินค้า" min="1">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12" style="margin-bottom: 2%">
                                <button id="btnrow" class="btn btn-sm btn-primary">Add +</button>
                            </div>
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-block">
                                        <div class="form-group row">
                                            <div style="margin: auto">
                                                <button type="submit" class="btn btn-sm btn-success"
                                                    id="create-user">เบิกสินค้า</button>
                                                <a href="{{ url('/withdraw/withdraw_product') }}">
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

                {{-- <div id="styleSelector">
        </div> --}}
            </div>
        </div>
    @endsection

    @section('js')

        <script>
            $(document).ready(function() {

                $("#btnrow").click(function() {
                    $("#addrow").append('<div class="card count">\
                                            <div class="card-block">\
                                                <div class="form-group row">\
                                                    <div class="col-sm-1"></div>\
                                                    <div class="col-sm-10">\
                                                        <div class="form-group row">\
                                                            <div class="col-sm-6">\
                                                                <label class="col-form-label">ชื่อสินค้า</label>\
                                                                <select name="select" class="form-control product_id"\
                                                                    name="product" id="product">\
                                                                    <option value="">ข้อมูลสินค้า</option>\
                                                                    @foreach ($product as $value)\
                                                                        <option value="{{ $value->product_id }}">\
                                                                            {{ $value->product_name }}\
                                                                        </option>\
                                                                    @endforeach\
                                                                </select>\
                                                            </div>\
                                                            <div class="col-sm-6">\
                                                                <label class="col-form-label">จำนวนสินค้า</label>\
                                                                <input type="number" class="form-control withdraw_p_num" name="number" id="number"\
                                                                    placeholder="จำนวนสินค้า" min="1">\
                                                            </div>\
                                                        </div>\
                                                    </div>\
                                                </div>\
                                            </div>\
                                        </div>');
                });

                $('body').on('click', '#create-user', function() {
                    // console.log('submit');
                    var count = 0;
                    var count_ = $('.count')
                    var withdraw_p_name = [];
                    var withdraw_p_name_ = $('.withdraw_p_name')
                    var withdraw_p_date = [];
                    var withdraw_p_date_ = $('.withdraw_p_date')
                    var product_id = [];
                    var product_id_ = $('.product_id')
                    var withdraw_p_num = [];
                    var withdraw_p_num_ = $('.withdraw_p_num')

                    $.each(count_, function(index, value) {
                        count++
                    });
                    $.each(withdraw_p_name_, function(index, value) {
                        var v = $(this).val()
                        withdraw_p_name.push(v)
                    });
                    $.each(product_id_, function(index, value) {
                        var v = $(this).val()
                        product_id.push(v)
                    });
                    $.each(withdraw_p_date_, function(index, value) {
                        var v = $(this).val()
                        withdraw_p_date.push(v)
                    });
                    $.each(withdraw_p_num_, function(index, value) {
                        var v = $(this).val()
                        withdraw_p_num.push(v)
                    });

                    var fd = new FormData();

                    if (withdraw_p_name && withdraw_p_date) {
                        fd.append('_token', "{{ csrf_token() }}");
                        fd.append('count', count);
                        fd.append('product_id', product_id);
                        fd.append('withdraw_p_name', withdraw_p_name);
                        fd.append('withdraw_p_date', withdraw_p_date);
                        fd.append('withdraw_p_num', withdraw_p_num);

                        $.ajax({
                            method: "POST",
                            url: "/withdraw/store",
                            dataType: 'json',
                            cache: false,
                            contentType: false,
                            processData: false,
                            data: fd,

                        }).done(function(rec) {

                            if (rec.status == '1') {
                                swal({
                                    title: 'บันทึกสำเร็จ!',
                                    text: "กดปุ่ม ok เพื่อดำเนินการต่อ!",
                                    type: 'success',
                                    padding: '2em'
                                }).then(function(then) {
                                    location.reload()
                                })
                            }
                            if (rec.status == '3') {
                                swal({
                                    title: 'กรุณากรอกข้อมูลให้ครบถ้วน!',
                                    text: "กดปุ่ม ok เพื่อดำเนินการต่อ!",
                                    type: 'error',
                                    padding: '2em'
                                })
                            }
                            if (rec.status == '0') {
                                swal({
                                    title: 'บันทึกไม่สำเร็จ!',
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
