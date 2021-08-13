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
                                        <h5>แก้ไขข้อมูลส่งสินค้า</h5>
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
                                                            {{-- <select name="select" id="cus_id"
                                                                class="form-control cus_id select_cus">
                                                                <option value="">-- รหัสลูกค้า --</option>
                                                                @foreach ($customer as $item)
                                                                    <option value="{{ $item->cus_id }}">
                                                                        {{ sprintf('%05d', $item->cus_id) }} </option>
                                                                @endforeach
                                                            </select> --}}
                                                            <input type="hidden" name="" id="id" value="{{ $ship->ship_id }}">
                                                            <label class="col-form-label">{{ sprintf('%05d', $ship->cus_id) }}</label>
                                                        </label>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label class="col-form-label">ชื่อจริง - นามสกุล : </label>
                                                        <label class="show-data">@if ($ship->cus_title == 1)
                                                            นาย
                                                        @elseif($ship->cus_title == 2)
                                                            นาง
                                                        @else
                                                            นางสาว
                                                        @endif
                                                            {{ $ship->cus_fristname }} {{ $ship->cus_lastname }}</label>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <label class="col-form-label">เบอร์โทรศัพท์ : </label>
                                                        <label class="">{{ $ship->cus_phonenumber }}</label>
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
                                                        <label class="">{{ $ship->cus_address }}</label>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <label class="col-form-label">จังหวัด : </label>
                                                        <label class="">{{ $ship->province_name }}</label>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label class="col-form-label">อำเภอ : </label>
                                                        <label class="">{{ $ship->district_name }}</label>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <label class="col-form-label">ตำบล : </label>
                                                        <label class="">{{ $ship->subdistrict_name }}</label>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label class="col-form-label">รหัสไปรษณีย์ : </label>
                                                        <label class="">{{ $ship->zip_code }}</label>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <label class="col-form-label">วันที่จัดส่ง</label>
                                                        {{-- <label for="" id="cus_date"></label> --}}
                                                        <input type="date" class="form-control" id="ship_date" value="{{ $ship->ship_date }}">
                                                    </div>
                                                </div>
                                                @foreach ($ship_p as $v)
                                                <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <label class="col-form-label">ข้อมูลสินค้า</label>
                                                        <select name="" id="" class="form-control product_id">
                                                            <option value="">--เลือกสินค้า--</option>
                                                            @foreach ($product as $item)
                                                            <option value="{{ $item->product_id }}" @if ($item->product_id == $v->product_id)
                                                                {{ 'selected' }}
                                                            @endif>
                                                                    {{ $item->product_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label class="col-form-label">จำนวน</label>
                                                        <input type="number" class="form-control product_num" id="" value="{{ $v->product_num }}">
                                                    </div>
                                                </div>
                                                @endforeach
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
                                                            id="create-insert">แก้ไขข้อมูล</button>
                                                        <a href="{{ url('/shipment/shipment_index') }}">
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
                
                var id = $('#id').val()
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

                console.log(id);
                console.log(product_id);
                console.log(product_num);

                if (product_id != "" && product_num != "") {
                    fd.append('_token', "{{ csrf_token() }}");
                    fd.append('id', id);
                    fd.append('product_id', product_id);
                    fd.append('product_num', product_num);
                    fd.append('ship_date', ship_date);

                    $.ajax({
                        method: "POST",
                        url: "/shipment/update",
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

        });
    </script>
@endsection
