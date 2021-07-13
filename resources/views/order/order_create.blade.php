@extends('layouts.admin.main')
@section('content')
    <div class="pcoded-content">

        <div class="page-header card">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="fa fa-shopping-bag bg-c-blue"></i>
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
                                                    <div class="col-sm-12">
                                                        <label class="col-form-label">หัวข้อการสั่งซื้อ</label>
                                                        <input type="text" class="form-control oder_name" name="oder_name"
                                                            id="oder_name" placeholder="หัวข้อการสั่งซื้อ">
                                                    </div>
                                                </div>
                                                {{-- <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <label class="col-form-label">วันที่สั่งซื้อเสร็จ</label>
                                                        <input type="date" class="form-control order_completeddate" name="order_completeddate"
                                                            id="order_completeddate" placeholder="วันที่สั่งซื้อเสร็จ">
                                                    </div>
                                                </div> --}}
                                                <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <label class=" col-form-label">ข้อมูลลูกค้า</label>
                                                        <select name="select" class="form-control cus_id" name="cus_id" id="select_id">
                                                            <option value="">ข้อมูลลูกค้า</option>
                                                            @foreach ($customer as $value)
                                                                <option value="{{ $value->cus_id }}">
                                                                    {{ sprintf('%05d',$value->cus_id) }}
                                                                </option>
                                                            @endforeach
                                                            <option value="99">อื่นๆ</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label class=" col-form-label">ชื่อลูกค้า</label><br>
                                                        <label for="" id="cus_title"></label> <label for="" id="cus_fristname"></label> <label for="" id="cus_lastname"></label>
                                                    </div>
                                                </div>
                                                <div class="form-group row" style="display: none" id="show_description">
                                                    <div class="col-sm-6">
                                                        <label class=" col-form-label">กรอกข้อมูลลูกค้า</label>
                                                        <input type="text" class="form-control other_name"
                                                                name="other_name" id="other_name"
                                                                placeholder="ชื่อลูกค้า">
                                                    </div>
                                                    {{-- <div class="col-sm-6">
                                                        <label class=" col-form-label">ชื่อลูกค้า</label><br>
                                                        <input type="text" class="form-control orderdetail_quantity_total"
                                                                name="orderdetail_quantity_total" id="orderdetail_quantity_total"
                                                                placeholder="จำนวนสินค้า">
                                                    </div> --}}
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
                // var order_startdate = [];
                // var order_startdate_ = $('.order_startdate')
                var cus_id = [];
                var cus_id_ = $('.cus_id')
                var product_id = [];
                var product_id_ = $('.product_id')
                var orderdetail_quantity_total = [];
                var orderdetail_quantity_total_ = $('.orderdetail_quantity_total') //รายละเอียดการสั่งซื้อ จำนวน ทั้งหมด
                // var orderdetail_listnumber = $('.orderdetail_listnumber').val(); // เลขที่
                // var order_completeddate = $('.order_completeddate').val(); //วันที่สั่งซื้อเสร็จ
                // var orderdetail_priceunit = $('.orderdetail_priceunit').val(); //รายละเอียดการสั่งซื้อ ราคาหน่วย
                // var orderdetail_pricetotal = $('.orderdetail_pricetotal').val(); //สั่งซื้อรายละเอียดราคารวม
                var other_name = $('.other_name').val();
                var fd = new FormData();

                $.each(count_, function(index, value) {
                    count++
                });
                $.each(oder_name_, function(index, value) {
                    var v = $(this).val()
                    oder_name.push(v)
                });
                // $.each(order_startdate_, function(index, value) {
                //     var v = $(this).val()
                //     order_startdate.push(v)
                // });
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

                if (oder_name != "" && cus_id != "" ) {
                    fd.append('_token', "{{ csrf_token() }}");
                    fd.append('count', count);
                    fd.append('oder_name', oder_name);
                    // fd.append('order_startdate', order_startdate);
                    fd.append('cus_id', cus_id);
                    fd.append('product_id', product_id);
                    fd.append('orderdetail_quantity_total', orderdetail_quantity_total); //รายละเอียดการสั่งซื้อ จำนวน ทั้งหมด
                    // fd.append('orderdetail_listnumber', orderdetail_listnumber); // เลขที่
                    // fd.append('order_completeddate', order_completeddate); // วันที่สั่งซื้อเสร็จ
                    // fd.append('orderdetail_priceunit', orderdetail_priceunit); //รายละเอียดการสั่งซื้อ ราคาหน่วย
                    // fd.append('orderdetail_pricetotal', orderdetail_pricetotal); //สั่งซื้อรายละเอียดราคารวม
                    fd.append('other_name',other_name);

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
            
            $('body').on('change', '#select_id', function() {
                var id = $('#select_id').val()
                console.log(id)
                if(id == 99){
                    $('#show_description').show()
                    $('#cus_title').hide()
                    $('#cus_fristname').hide()
                    $('#cus_lastname').hide()
                }
                if(id == ''){
                    $('#other_name').attr('disabled', false).val('')
                    $('#show_description').hide()
                    $('#cus_title').hide()
                    $('#cus_fristname').hide()
                    $('#cus_lastname').hide()
                }
                if(id != 99 && id != ''){
                    $('#other_name').attr('disabled', false).val('')
                    $('#show_description').hide()
                    $('#cus_title').show()
                    $('#cus_fristname').show()
                    $('#cus_lastname').show()

                    $.ajax({
                    method: "POST",
                    url: "/select_order",
                    data: {
                        "id": id,
                        "_token": $('meta[name="csrf-token"]').attr('content'),
                    }
                })
                .done(function (msg) {
                    var data = JSON.parse(msg);
                    data = data.cus;
                    var title =  '';
                    console.log(data)
                    if(data.cus_title == 1){
                        title = 'นาย'

                    }else if(data.cus_title == 2){
                        title = 'นาง'
                    }else{
                        title = 'นางสาว'
                    }
                    $('#cus_fristname').html(data.cus_fristname)
                    $('#cus_lastname').html(data.cus_lastname)
                    $('#cus_title').html(title)
                });
                }
               
            });

        });
    </script>

@endsection
