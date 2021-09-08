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
                                        <h5>ฟอร์มการเก็บคืน</h5>
                                    </div>
                                    <div class="card-block">
                                        <div class="form-group row">
                                            <div class="col-sm-2"></div>
                                            <div class="col-sm-10">
                                                <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <label class="col-form-label">รหัสลูกค้า : </label>
                                                        <label for="">
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
                                                        <label class="col-form-label">วันที่จัดส่ง : </label>
                                                        <label for="">{{ date('d-m-Y', strtotime($ship->ship_date)) }}</label>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        @if ($rd->rd_status == 1)
                                                        <select name="" id="" class="form-control select_p" data-ship_id="{{ $ship->ship_id }}" disabled="true">
                                                            <option value="1" @if ($rd->rd_status == 1) {{ "selected" }} @endif>สินค้าครบ</option>
                                                        </select>
                                                        @else
                                                        <select name="" id="" class="form-control select_p" data-ship_id="{{ $ship->ship_id }}">
                                                            <option value="">-- เลือกสถานะสินค้า --</option>
                                                            <option value="1" @if ($rd->rd_status == 1) {{ "selected" }} @endif>สินค้าครบ</option>
                                                            <option value="2" @if ($rd->rd_status == 2) {{ "selected" }} @endif>สินค้าไม่ครบ</option>
                                                        </select>
                                                        @endif
                                                    </div>
                                                </div>
                                                {{-- <div id="hide_data"> --}}
                                                    @foreach ($ship_p as $v)
                                                    <div class="form-group row">
                                                        <div class="col-sm-6">
                                                            <label class="col-form-label" style="color:#4099ff;font-weight: bold;border-bottom: solid 1px #555555b5;padding-bottom: 1px;">ข้อมูลสินค้าเก็บคืน</label>
                                                            <div style="padding-top: 10px">
                                                                <input type="hidden" name="" id="" class="rd_id" value="{{ $v->rd_id }}">
                                                                <input type="hidden" name="" id="" class="product_id" value="{{ $v->product_id }}">
                                                                <label for="">{{ $v->product_name }}</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <label class="col-form-label">จำนวน</label>
                                                            @if ($v->product_number == 0)
                                                            <input type="number" class="form-control product_num" id="" value="{{ $v->product_number }}" readonly>
                                                            @else
                                                            <input type="number" class="form-control product_num" id="" value="{{ $v->product_number }}">
                                                            @endif
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <label class="col-form-label" style="color:#4099ff;font-weight: bold;border-bottom: solid 1px #555555b5;padding-bottom: 1px;">ข้อมูลวัตถุดิบเก็บคืน</label>
                                                        </div>
                                                    </div>
                                                        @if (!count($return_m))
                                                            @php
                                                            $test = App\Models\Product::leftJoin('product_material','product_material.product_id','product_data.product_id')
                                                            ->leftJoin('material','material.material_id','product_material.material_id')
                                                            ->where('product_data.product_id', $v->product_id)
                                                            ->get();
                                                            @endphp
                                                            @foreach ($test as $item)
                                                            <div class="form-group row">
                                                                <div class="col-sm-6">
                                                                    <label for="">{{  $item->material_name  }}</label>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <input type="hidden" class="material_id" value="{{ $item->material_id }}">
                                                                    @if ($v->rd_status == 1)
                                                                    <input type="number" name="" id="" value="0" placeholder="0" class="form-control mat_num" readonly>
                                                                    @else
                                                                    <input type="hidden" name="" class="quantity" value="{{ $v->product_number * $item->pm_quantity }}">
                                                                    <input type="number" name="" id="" value="" placeholder="0" class="form-control mat_num">
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            @endforeach
                                                        @else
                                                            @php
                                                            $testt = App\Models\Product::leftJoin('product_material','product_material.product_id','product_data.product_id')
                                                            ->leftJoin('material','material.material_id','product_material.material_id')
                                                            ->leftJoin('return_material','return_material.material_id','product_material.material_id')
                                                            ->where('product_data.product_id', $v->product_id)
                                                            ->where('return_material.ship_id',$ship->ship_id)
                                                            ->get();
                                                            // $rrm =  App\Models\Material::leftJoin('material','material.material_id','return_material.material_id')
                                                            // ->leftJoin('material','material.material_id','product_material.material_id')
                                                            // ->where('product_material.product_id', $v->product_id)->get();
                                                            @endphp
                                                            @foreach ($testt as $item)
                                                            <div class="form-group row">
                                                                <div class="col-sm-6">
                                                                    <label for="">{{ $item->material_name }}</label>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <input type="hidden" class="material_id" value="{{ $item->material_id }}">
                                                                    @if ($item->material_num == 0)
                                                                    <input type="number" name="" id="" value="{{ $item->material_num }}" class="form-control mat_num" readonly>
                                                                    @else
                                                                    <input type="number" name="" id="" value="{{ $item->material_num }}" class="form-control mat_num">
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            @endforeach
                                                        @endif

                                                    @endforeach
                                                {{-- </div> --}}
                                                {{-- <div id="hide_data">
                                                    @foreach ($return_m as $item)
                                                    <div class="form-group row">
                                                        <div class="col-sm-6">
                                                            <label for="">{{ $item->material_name }}</label>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <input type="hidden" class="material_id" value="{{ $item->material_id }}">
                                                            @if ($item->material_num == 0)
                                                            <input type="number" name="" id="" value="{{ $item->material_num }}" class="form-control mat_num" readonly>
                                                            @else
                                                            <input type="number" name="" id="" value="{{ $item->material_num }}" class="form-control mat_num">
                                                            @endif
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                </div> --}}
                                                {{-- <span id="show_data"></span>
                                                <span id="show_data2"></span> --}}
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                        <label class="col-form-label " style="color: red">* หมายเหตุ</label>
                                                        <textarea name="" id="rd_note" cols="5" rows="5" class="form-control">{{ $v->rd_note }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div style="margin: auto">
                                                    @if ($rd->rd_status != 1)
                                                        <button type="submit" class="btn btn-sm btn-success"
                                                            id="create-insert">บันทึกข้อมูล</button>
                                                    @else
                                                        
                                                    @endif
                                                    <a href="{{ url('/return/return_detail/'.$ship->cus_id) }}">
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

            $('body').on('click', '#create-insert', function() {
                // e.preventDefault();
                // console.log('insert');
                var rd_id = [];
                var rd_id_ = $('.rd_id')
                var product_id = [];
                var product_id_ = $('.product_id')
                var product_num = [];
                var product_num_ = $('.product_num')
                var quantity = [];
                var quantity_ = $('.quantity')
                
                var mat_num = [];
                var mat_num_ = $('.mat_num')
                var material_id = [];
                var material_id_ = $('.material_id')
                // var mat_num = $('.mat_num').val()
                // var material_id = $('.material_id').val()

                var id = $('#id').val()
                var rd_note = $('#rd_note').val()
                var select_p = $('.select_p').val()
                var fd = new FormData();

                $.each(product_id_, function(index, value) {
                    var v = $(this).val()
                    product_id.push(v)
                });

                $.each(product_num_, function(index, value) {
                    var v = $(this).val()
                    product_num.push(v)
                });

                $.each(rd_id_, function(index, value) {
                    var v = $(this).val()
                    rd_id.push(v)
                });

                $.each(material_id_, function(index, value) {
                    var v = $(this).val()
                    material_id.push(v)
                });

                $.each(mat_num_, function(index, value) {
                    var v = $(this).val()
                    mat_num.push(v)
                });

                $.each(quantity_, function(index, value) {
                    var v = $(this).val()
                    quantity.push(v)
                });

                // console.log(id);
                // console.log(product_id);
                // console.log(product_num);
                console.log(material_id);
                console.log(mat_num);

                if (select_p) {
                    fd.append('_token', "{{ csrf_token() }}");
                    fd.append('id', id);
                    fd.append('product_id', product_id);
                    fd.append('product_num', product_num);
                    fd.append('rd_note', rd_note);
                    fd.append('rd_id', rd_id);
                    fd.append('material_id', material_id);
                    fd.append('mat_num', mat_num);
                    fd.append('select_p', select_p);
                    fd.append('quantity', quantity);
                    
                    $.ajax({
                        method: "POST",
                        url: "/return/update",
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
                                location.href = '/return/return_index'
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

            // $('body').on('change', '.select_p', function() {
            //     var id =  $(this).val()
            //     var ship_id = $(this).data('ship_id');
            //     // console.log(id);
            //     // console.log(ship_id);
            //     if(id == 1 || id == 3){
            //         // $("#show_data").hide();
            //         $("#show_data2").hide();
            //         $("#hide_data").show();
            //     }else{
            //         // $("#show_data2").show();
            //         // $("#hide_data").hide();
            //         $.ajax({
            //             method: "POST",
            //             url: "/return/ship_select",
            //             data: {
            //                 "id": id,
            //                 "ship_id" : ship_id,
            //                 "_token": $('meta[name="csrf-token"]').attr('content'),
            //             }
            //         }).done(function(msg) {
            //             var data = JSON.parse(msg);
            //             var data2 = JSON.parse(msg);
            //             ship_p = data.ship_p;
            //             test = data.test;
            //             // console.log(ship_p)
            //             // console.log(test)
            //             var html = '';
            //             var html2 = '';
            //             $.each(ship_p, function(index, value) {
            //                 console.log(value)
            //                 var product_number = (value.product_number == 0 ? '<input type="number" class="form-control product_num" id="" value="'+value.product_number+'" readonly>' : '<input type="number" class="form-control product_num" id="" value="'+value.product_number+'">')
            //                 html += `<div class="form-group row">
            //                             <div class="col-sm-6">
            //                                 <label class="col-form-label">ข้อมูลสินค้า</label>
            //                                 <div>
            //                                     <input type="hidden" name="" id="" class="rd_id" value="`+value.rd_id+`">
            //                                     <input type="hidden" name="" id="" class="product_id" value="`+value.product_id+`">
            //                                     <label for="">`+value.product_name+`</label>
            //                                 </div>
            //                             </div>
            //                             <div class="col-sm-6">
            //                                 <label class="col-form-label">จำนวน</label>
            //                                 `+product_number+`
            //                             </div>
            //                         </div>`;

            //                         $.each(test, function(index, value_t) {
            //                         // console.log(value.product_number);
            //                         var total = value_t.pm_quantity * value.product_number;
            //                         html2 += `<div class="form-group row">
            //                                     <div class="col-sm-6">
            //                                         <label for="">`+value_t.material_name+`</label>
            //                                     </div>
            //                                     <div class="col-sm-6">
            //                                         <input type="hidden" class="material_id" value="`+value_t.material_id+`">
            //                                         <input type="number" name="" id="" value="`+total+`" class="form-control mat_num">
            //                                     </div>
            //                                 </div>`;
            //                     });
            //             });
                        
            //             // $("#show_data").html('').append(html)
            //             $("#show_data2").html('').append(html2)
            //             // $("#hide_data").hide();
            //         });
            //     }
            // });
        });
    </script>
@endsection
