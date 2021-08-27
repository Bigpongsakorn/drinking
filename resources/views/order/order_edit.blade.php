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
                                                {{-- <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <label class="col-form-label">เลขที่ใบสั่งซื้อ</label>
                                                        <input type="text" class="form-control orderdetail_listnumber"
                                                            name="orderdetail_listnumber" id="orderdetail_listnumber"
                                                            value="{{ $order_db->orderdetail_listnumber }}">
                                                    </div>
                                                </div> --}}
                                                <input type="hidden" name="order_id" id="order_id" value="{{ $customer_db->order_id }}">
                                                {{-- <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <label class="col-form-label">หัวข้อการสั่งซื้อ</label>
                                                        <input type="text" class="form-control order_name" name="order_name"
                                                            id="order_name" value="{{ $order->order_name }}">
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label class="col-form-label">วันที่เริ่มสั่งซื้อ</label>
                                                        <input type="date" class="form-control order_startdate"
                                                            name="order_startdate" id="order_startdate"
                                                            value="{{ $order->order_startdate }}">
                                                    </div>
                                                </div> --}}
                                                {{-- <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <label class="col-form-label">วันที่สั่งซื้อเสร็จ</label>
                                                        <input type="date" class="form-control order_completeddate"
                                                            name="order_completeddate" id="order_completeddate"
                                                            value="{{ $order->order_completeddate }}">
                                                    </div>
                                                </div> --}}
                                                <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <label class=" col-form-label red">* ข้อมูลลูกค้า</label>
                                                        <select name="select" class="form-control cus_id" name="cus_id" id="select_id" disabled>
                                                            <option value="">ข้อมูลลูกค้า</option>
                                                            @if ($order_db->cus_id == 99)
                                                            @foreach ($customer as $value)
                                                                <option value="{{ $value->cus_id }}">
                                                                    {{ sprintf('%05d',$value->cus_id) }}
                                                                </option>
                                                            @endforeach
                                                            <option value="99" selected >ไม่เป็นสมาชิก</option>
                                                            @else
                                                            @foreach ($customer as $value)
                                                                <option value="{{ $value->cus_id }}" @if ($value->cus_id == $customer_db->cus_id) {{ 'selected' }} @endif>
                                                                    {{ sprintf('%05d',$value->cus_id) }}
                                                                </option>
                                                            @endforeach
                                                                <option value="99">ไม่เป็นสมาชิก</option>
                                                            @endif
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label class=" col-form-label">ชื่อลูกค้า</label><br>
                                                        <label for="" id="cus_title">@if ($customer_db->cus_title == 1)
                                                            นาย
                                                        @elseif($customer_db->cus_title == 2)
                                                            นาง
                                                        @elseif($customer_db->cus_title == 3)
                                                            นางสาว
                                                        @else
                                                        @endif</label> <label for="" id="cus_fristname">{{ $customer_db->cus_fristname }}</label> <label for="" id="cus_lastname">{{ $customer_db->cus_lastname }}</label>     
                                                    </div>
                                                </div>
                                                {{-- @if ($order_db->cus_id == 99)
                                                <div class="form-group row" id="show_description">
                                                    <div class="col-sm-6">
                                                        <label class=" col-form-label red">* ชื่อลูกค้า</label>
                                                        <input type="text" class="form-control other_name"
                                                                name="other_name" id="other_name" value="{{ $other_db->o_name }}">
                                                    </div>
                                                </div>
                                                @else
                                                <div class="form-group row" style="display: none" id="show_description">
                                                    <div class="col-sm-6">
                                                        <label class=" col-form-label red">* ชื่อลูกค้า</label>
                                                        <input type="text" class="form-control other_name"
                                                                name="other_name" id="other_name" placeholder="ชื่อลูกค้า">
                                                    </div>
                                                </div>
                                                @endif --}}
                                                @if ($order_db->cus_id == 99)
                                                    <div class="form-group row">
                                                        <div class="col-sm-6">
                                                            <label class=" col-form-label red">* ชื่อลูกค้า</label>
                                                            <input type="text" class="form-control other_name"
                                                                    name="other_name" id="other_name" value="{{ $other_db->o_name }}">
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <label class=" col-form-label red">* เบอร์โทรศัพท์</label><br>
                                                            <input type="text" class="form-control" maxlength="10" name="tel" id="tel" value="{{ $other_db->o_phonenumber }}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label red">* บ้านเลขที่/หมู่บ้าน</label>
                                                        <div class="col-sm-10">
                                                            <textarea rows="5" cols="5" class="form-control" name="address" id="address" placeholder="">{{ $other_db->o_address }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-sm-6">
                                                            <label class="col-form-label red">* จังหวัด</label>
                                                            <select name="select" class="form-control" name="province" id="province">
                                                                <option value="">เลือกจังหวัด</option>
                                                                @foreach ($province as $item)
                                                                <option value="{{$item->province_id}}" @if ($item->province_id == $other_db->o_province)
                                                                    {{ "selected" }}
                                                                @endif>
                                                                    {{$item->province_name}}
                                                                </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <label class="col-form-label">อำเภอ</label>
                                                            <select name="select" class="form-control" name="district" id="district">
                                                                <option value="">เลือกอำเภอ</option>
                                                                @foreach ($district as $item)
                                                                <option value="{{$item->district_id}}" @if ($item->district_id == $other_db->o_district)
                                                                    {{ "selected" }}
                                                                @endif>
                                                                    {{$item->district_name}}
                                                                </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-sm-6">
                                                            <label class="col-form-label">ตำบล</label>
                                                            <select name="select" class="form-control" name="subdistrict" id="subdistrict">
                                                                <option value="">เลือกตำบล</option>
                                                                @foreach ($subistrict as $item)
                                                                <option value="{{$item->subdistrict_id}}" @if ($item->subdistrict_id == $other_db->o_subdistrict)
                                                                    {{ "selected" }}
                                                                @endif>
                                                                    {{$item->subdistrict_name}}
                                                                </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <label class="col-form-label">รหัสไปรษณีย์</label>
                                                            <select name="select" class="form-control" name="zipcode" id="zipcode">
                                                                <option value="">เลือกรหัสไปรษณีย์</option>
                                                                @foreach ($subistrict as $item)
                                                                <option value="{{$item->zip_code}}" @if ($item->zip_code == $other_db->o_zipcode)
                                                                    {{ "selected" }}
                                                                @endif>
                                                                    {{$item->zip_code}}
                                                                </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                @else
                                                
                                                @endif
                                                <div id="addrow">
                                                    @foreach ($order_d as $item)
                                                        <div class="form-group row count">
                                                            <div class="col-sm-6">
                                                                <label class=" col-form-label red">* ข้อมูลสินค้า</label>
                                                                <select name="select" class="form-control product_id"
                                                                    name="product_id" id="product_id">
                                                                    <option value="">ข้อมูลสินค้า</option>
                                                                    @foreach ($product as $value)
                                                                        <option value="{{ $value->product_id }}" @if ($value->product_id == $item->product_id) {{ 'selected' }} @endif>
                                                                            {{ $value->product_name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <label class="col-form-label red">* จำนวนสินค้า</label>
                                                                <input type="number" class="form-control orderdetail_quantity_total"
                                                                    name="orderdetail_quantity_total" id="orderdetail_quantity_total"
                                                                    value="{{ $item->orderdetail_quantity_total }}">
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div class="form-group row">
                                                    <button class="btn btn-sm btn-primary" id="btnrow"
                                                        data-count="1">+</button>
                                                </div>
                                                <div class="form-group row">
                                                    <div style="margin: auto">
                                                        <button type="submit" class="btn btn-sm btn-success"
                                                            id="create-user">แก้ไขข้อมูล</button>
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

            {{-- <div id="styleSelector">
        </div> --}}
        </div>
    </div>
@endsection

@section('js')

    <script>
        $(document).ready(function() {

            $("#btnrow").click(function() {
                $("#addrow").append('<div class="form-group row count">\
                                                    <div class="col-sm-6">\
                                                        <label class=" col-form-label red">* ข้อมูลสินค้า</label>\
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
                                                        <label class="col-form-label red">* จำนวนสินค้า</label>\
                                                        <input type="number" class="form-control orderdetail_quantity_total" name="orderdetail_quantity_total" id="orderdetail_quantity_total"\
                                                            placeholder="จำนวนสินค้า">\
                                                    </div>\
                                                </div>');
            });

            $('body').on('click', '#create-user', function() {
                // console.log('submit');
                var count = 0;
                var count_ = $('.count')
                // var order_name = [];
                // var order_name_ = $('.order_name')
                // var order_startdate = [];
                // var order_startdate_ = $('.order_startdate')
                var cus_id = [];
                var cus_id_ = $('.cus_id')
                var product_id = [];
                var product_id_ = $('.product_id')
                var orderdetail_quantity_total = [];
                var orderdetail_quantity_total_ = $('.orderdetail_quantity_total')
                // var orderdetail_listnumber = $('.orderdetail_listnumber').val(); 
                // var order_completeddate = $('.order_completeddate').val(); 
                var order_id = $('#order_id').val(); 
                var other_name = $('.other_name').val();
                var tel = $('#tel').val();
                var address = $('#address').val();
                var province = $('#province').val();
                var subdistrict = $('#subdistrict').val();
                var district = $('#district').val();
                var zipcode = $('#zipcode').val();
                var fd = new FormData();

                $.each(count_, function(index, value) {
                    count++
                });
                // $.each(order_name_, function(index, value) {
                //     var v = $(this).val()
                //     order_name.push(v)
                // });
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

                if (cus_id != "") {
                    fd.append('_token', "{{ csrf_token() }}");
                    fd.append('count', count);
                    // fd.append('order_name', order_name);
                    // fd.append('order_startdate', order_startdate);
                    fd.append('cus_id', cus_id);
                    fd.append('product_id', product_id);
                    fd.append('orderdetail_quantity_total', orderdetail_quantity_total);
                    // fd.append('orderdetail_listnumber', orderdetail_listnumber);
                    // fd.append('order_completeddate', order_completeddate);
                    fd.append('order_id',order_id);
                    fd.append('other_name',other_name);
                    fd.append('tel',tel);
                    fd.append('address',address);
                    fd.append('province',province);
                    fd.append('subdistrict',subdistrict);
                    fd.append('district',district);
                    fd.append('zipcode',zipcode);

                    $.ajax({
                        method: "POST",
                        url: "/drinking/public/order/update",
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
                                location.href = '/drinking/public/order/order_index'
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
                        if (rec.status == '4') {
                            swal({
                                title: 'สินค้าไม่พอสั่งซื้อ!',
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
                    url: "/drinking/public/select_order",
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
