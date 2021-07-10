@extends('layouts.admin.main')
@section('content')
    <div class="pcoded-content">

        <div class="page-header card">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class=" fa fa-shopping-basket bg-c-blue"></i>
                        <div class="d-inline">
                            <h5>จัดการข้อมูลสั่งซื้อสินค้า</h5>
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
                                        <h5>เพิ่มข้อมูลสั่งซื้อสินค้า</h5>
                                    </div>
                                    <div class="card-block">
                                        <div class="form-group row">
                                            <div class="col-sm-1"></div>
                                            <div class="col-sm-10">
                                                <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <label class="col-form-label">เลขที่ใบสั่งซื้อ</label>
                                                        <input type="text" class="form-control orderdetail_listnumber" name="orderdetail_listnumber"
                                                            id="orderdetail_listnumber" placeholder="เลขที่ใบสั่งซื้อ">
                                                    </div>
                                                    {{-- <div class="col-sm-6">
                                                        <label class="col-form-label">ราคารายละเอียดการสั่งซื้อทั้งหมด</label>
                                                        <input type="text" class="form-control orderdetail_quantity_total" name="orderdetail_quantity_total"
                                                            id="orderdetail_quantity_total" placeholder="ราคารายละเอียดการสั่งซื้อทั้งหมด">
                                                    </div> --}}
                                                </div>
                                                {{-- <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <label class="col-form-label">รายละเอียดการสั่งซื้อ ราคาหน่วย</label>
                                                        <input type="text" class="form-control orderdetail_priceunit" name="orderdetail_priceunit"
                                                            id="orderdetail_priceunit" placeholder="รายละเอียดการสั่งซื้อ ราคาหน่วย">
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label class="col-form-label">สั่งซื้อรายละเอียดราคารวม</label>
                                                        <input type="text" class="form-control orderdetail_pricetotal" name="orderdetail_pricetotal"
                                                            id="orderdetail_pricetotal" placeholder="สั่งซื้อรายละเอียดราคารวม">
                                                    </div>
                                                </div> --}}
                                                <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <label class="col-form-label">หัวข้อการสั่งซื้อ</label>
                                                        <input type="text" class="form-control oder_name" name="oder_name"
                                                            id="oder_name" placeholder="หัวข้อการสั่งซื้อ">
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label class="col-form-label">วันที่เริ่มสั่งซื้อ</label>
                                                        <input type="date" class="form-control order_startdate"
                                                            name="order_startdate" id="order_startdate">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <label class="col-form-label">วันที่สั่งซื้อเสร็จ</label>
                                                        <input type="date" class="form-control order_completeddate" name="order_completeddate"
                                                            id="order_completeddate" placeholder="วันที่สั่งซื้อเสร็จ">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                        <label class=" col-form-label">ข้อมูลลูกค้า</label>
                                                        <select name="select" class="form-control cus_id" name="cus_id"
                                                            id="cus_id">
                                                            <option value="">ข้อมูลลูกค้า</option>
                                                            @foreach ($customer as $value)
                                                                <option value="{{ $value->cus_id }}">
                                                                    {{ $value->cus_fristname }}
                                                                    {{ $value->cus_lastname }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div id="addrow">
                                                    <div class="form-group row count">
                                                        <div class="col-sm-6">
                                                            <label class=" col-form-label">ข้อมูลสินค้า</label>
                                                            <select name="select" class="form-control product_id"
                                                                name="product_id" id="product_id">
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
                                                            <input type="number" class="form-control orderdetail_quantity_total"
                                                                name="orderdetail_quantity_total" id="orderdetail_quantity_total"
                                                                placeholder="จำนวนสินค้า">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <button class="btn btn-sm btn-primary" id="btnrow"
                                                        data-count="1">+</button>
                                                </div>
                                                <div class="form-group row">
                                                    <div style="margin: auto">
                                                        <button type="submit" class="btn btn-sm btn-success"
                                                            id="create-user">เพิ่มข้อมูล</button>
                                                        <a href="{{ url('/order/order_index') }}">
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

            $("#btnrow").click(function() {
                $("#addrow").append('<div class="form-group row count">\
                                                    <div class="col-sm-6">\
                                                        <label class=" col-form-label">ข้อมูลสินค้า</label>\
                                                        <select name="select" class="form-control product_id" name="product_id"\
                                                            id="product_id">\
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
                                                        <input type="number" class="form-control orderdetail_quantity_total" name="orderdetail_quantity_total" id="orderdetail_quantity_total"\
                                                            placeholder="จำนวนสินค้า">\
                                                    </div>\
                                                </div>');
            });

            $('body').on('click', '#create-user', function() {
                // console.log('submit');
                var count = 0;
                var count_ = $('.count')
                var oder_name = [];
                var oder_name_ = $('.oder_name')
                var order_startdate = [];
                var order_startdate_ = $('.order_startdate')
                var cus_id = [];
                var cus_id_ = $('.cus_id')
                var product_id = [];
                var product_id_ = $('.product_id')
                var orderdetail_quantity_total = [];
                var orderdetail_quantity_total_ = $('.orderdetail_quantity_total') //รายละเอียดการสั่งซื้อ จำนวน ทั้งหมด
                var orderdetail_listnumber = $('.orderdetail_listnumber').val(); // เลขที่
                var order_completeddate = $('.order_completeddate').val(); //วันที่สั่งซื้อเสร็จ
                // var orderdetail_priceunit = $('.orderdetail_priceunit').val(); //รายละเอียดการสั่งซื้อ ราคาหน่วย
                // var orderdetail_pricetotal = $('.orderdetail_pricetotal').val(); //สั่งซื้อรายละเอียดราคารวม

                var fd = new FormData();

                $.each(count_, function(index, value) {
                    count++
                });
                $.each(oder_name_, function(index, value) {
                    var v = $(this).val()
                    oder_name.push(v)
                });
                $.each(order_startdate_, function(index, value) {
                    var v = $(this).val()
                    order_startdate.push(v)
                });
                $.each(cus_id_, function(index, value) {
                    var v = $(this).val()
                    cus_id.push(v)
                });
                $.each(product_id_, function(index, value) {
                    var v = $(this).val()
                    product_id.push(v)
                });
                $.each(orderdetail_quantity_total_, function(index, value) {
                    var v = $(this).val()
                    orderdetail_quantity_total.push(v)
                });

                if (oder_name != "" && order_startdate != "" && cus_id != "" ) {
                    fd.append('_token', "{{ csrf_token() }}");
                    fd.append('count', count);
                    fd.append('oder_name', oder_name);
                    fd.append('order_startdate', order_startdate);
                    fd.append('cus_id', cus_id);
                    fd.append('product_id', product_id);
                    fd.append('orderdetail_quantity_total', orderdetail_quantity_total); //รายละเอียดการสั่งซื้อ จำนวน ทั้งหมด
                    fd.append('orderdetail_listnumber', orderdetail_listnumber); // เลขที่
                    fd.append('order_completeddate', order_completeddate); // วันที่สั่งซื้อเสร็จ
                    // fd.append('orderdetail_priceunit', orderdetail_priceunit); //รายละเอียดการสั่งซื้อ ราคาหน่วย
                    // fd.append('orderdetail_pricetotal', orderdetail_pricetotal); //สั่งซื้อรายละเอียดราคารวม

                    $.ajax({
                        method: "POST",
                        url: "/order/store",
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
                                // location.reload()
                                location.href = '/order/order_index'
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
