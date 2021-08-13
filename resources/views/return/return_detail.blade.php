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
                                        <h5>ข้อมูลเก็บคืน</h5>
                                    </div>
                                    <div class="card-block">
                                        <div class="form-group row">
                                            <div class="col-sm-2"></div>
                                            <div class="col-sm-10">
                                                <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <label class="col-form-label">รหัสลูกค้า : </label>
                                                        <label for="">
                                                            <label
                                                                class="col-form-label">{{ sprintf('%05d', $ship->c_cus_id) }}</label>
                                                        </label>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label class="col-form-label">ชื่อจริง - นามสกุล : </label>
                                                        <label class="show-data">
                                                            @if ($ship->cus_title == 1)
                                                                นาย
                                                            @elseif($ship->cus_title == 2)
                                                                นาง
                                                            @else
                                                                นางสาว
                                                            @endif
                                                            {{ $ship->cus_fristname }} {{ $ship->cus_lastname }}
                                                        </label>
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
                                                {{-- <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <label class="col-form-label">วันที่จัดส่ง : </label>
                                                        <label>{{ date('d-m-Y', strtotime($ship->ship_date)) }}</label>
                                                    </div>
                                                </div> --}}
                                            </div>
                                        </div>
                                        <div class="table-responsive dt-responsive table-p">
                                            <table id="multi-colum-dt" class="table table-striped table-bordered nowrap">
                                                <thead>
                                                    <tr style="text-align: center;">
                                                        <th>ลำดับ</th>
                                                        <th>วันที่จัดส่ง</th>
                                                        <th>สถานะจ่ายเงิน</th>
                                                        <th>หมายเหตุ</th>
                                                        <th>ข้อมูลสินค้า</th>
                                                        <th>สถานะเก็บคืน</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php $i = 1  @endphp
                                                    @foreach ($ship_data as $value)
                                                        <tr>
                                                            <td style="text-align: center;">
                                                                {{ $i }}
                                                            </td>
                                                            <td style="text-align: center;">
                                                                {{ date('d-m-Y', strtotime($value->ship_date)) }}
                                                            </td>
                                                            <td style="text-align: center;">
                                                                @if ($value->ship_pay == 1)
                                                                <button class="btn btn-sm btn-success open_modal2"
                                                                        data-toggle="modal" data-target="#exampleModal2"
                                                                        {{-- data-ship_id="{{ $value->ship_id }}" --}}
                                                                        {{-- data-ship_note="{{ $value->ship_note }}" --}}
                                                                        data-ship_pay="{{ $value->ship_pay }}"
                                                                        {{-- data-price="{{ $value->ship_price }}" --}}
                                                                        data-ship_bill="{{ $value->ship_bill }}"
                                                                        data-ship_pay_s="{{ $value->ship_pay_s }}">
                                                                    จ่ายเงินแล้ว
                                                                </button>
                                                                    {{-- <span style="color:green"></span> --}}
                                                                @elseif($value->ship_pay == 3)
                                                                <button class="btn btn-sm btn-warning open_modal3"
                                                                        data-toggle="modal" data-target="#exampleModal3"
                                                                        data-ship_id="{{ $value->ship_id }}"
                                                                        data-ship_note="{{ $value->ship_note }}"
                                                                        data-ship_pay="{{ $value->ship_pay }}"
                                                                        data-ship_price="{{ $value->ship_price }}"
                                                                        data-ship_bill="{{ $value->ship_bill }}"
                                                                        data-ship_pay_s="{{ $value->ship_pay_s }}">
                                                                    ค้างจ่าย
                                                                </button>
                                                                @else
                                                                <button class="btn btn-sm btn-danger open_modal3"
                                                                        data-toggle="modal" data-target="#exampleModal3"
                                                                        data-ship_id="{{ $value->ship_id }}"
                                                                        data-ship_note="{{ $value->ship_note }}"
                                                                        data-ship_pay="{{ $value->ship_pay }}"
                                                                        data-price="{{ $value->ship_price }}"
                                                                        data-ship_bill="{{ $value->ship_bill }}"
                                                                        data-ship_pay_s="{{ $value->ship_pay_s }}">
                                                                    ไม่ได้จ่ายเงิน
                                                                </button>
                                                                    {{-- <span style="color:red"></span> --}}
                                                                @endif
                                                            </td>
                                                            <td style="text-align: center;">
                                                                @if ($value->ship_note == null)
                                                                    -
                                                                @else
                                                                    {{ $value->ship_note }}
                                                                @endif
                                                            </td>
                                                            <td style="text-align: center;">
                                                                <a href="{{ url('/return/return_product_detail/' . $value->ship_id) }}">
                                                                    <button class="btn btn-sm btn-primary">
                                                                        ดูข้อมูล
                                                                    </button>
                                                                </a>
                                                            </td>
                                                            <td style="text-align: center;">
                                                                @if ($value->rd_status == 0)
                                                                <a href="{{ url('/return/return_form/' . $value->ship_id) }}">
                                                                    <button class="btn btn-sm btn-danger">
                                                                        ยังไม่ได้เก็บ
                                                                    </button>
                                                                </a>
                                                                @elseif($value->rd_status == 2 || $value->rd_status == 3 )
                                                                <a href="{{ url('/return/return_form/' . $value->ship_id) }}">
                                                                    <button class="btn btn-sm btn-warning">
                                                                        สินค้าค้าง
                                                                    </button>
                                                                </a>
                                                                @elseif($value->rd_status == 1)
                                                                <a href="{{ url('/return/return_form/' . $value->ship_id) }}">
                                                                    <button class="btn btn-sm btn-success">
                                                                        เก็บแล้ว
                                                                    </button>
                                                                </a>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        @php $i++ @endphp
                                                    @endforeach
                                                </tbody>
                                                {{-- <tfoot>
                                                    <tr>
                                                        <th colspan="7" style="text-align:right">รวม : </th>
                                                        <th style="text-align: right;">
                                                            {{ $sum }}.00
                                                        </th>
                                                        <th>บาท</th>
                                                    </tr>
                                                </tfoot> --}}
                                            </table>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div style="margin:auto">
                                            <a href="{{ url('/return/return_index') }}">
                                                <button class="btn btn-sm btn-secondary" type="">
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
    <!-- Extra large modal -->
    <div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <span id="product_img_show" style="margin: auto;"></span>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">การจ่ายเงิน</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="" id="create-product-category3">
                    <div class="modal-body">
                        <input type="hidden" id="ship_id__" name="" value="">
                        <select name="" class="form-control order_status1" id="ship_pay_">
                            <option value="1">จ่ายเงินแล้ว</option>
                            <option value="3">ค้างจ่าย</option>
                            <option value="2">ไม่ได้จ่ายเงิน</option>
                        </select>
                        <div class="box-show">
                            <label >หมายเหตุ</label>
                            <input type="text" class="form-control box-detail" name="" id="ship_note_">
                        </div>
                        <div class="box-show3" style="display: none" >
                            <label style="color: red">* เงินที่ค้าง</label>
                            <input type="text" class="form-control" name="" id="ship_price">
                            <label >หมายเหตุ</label>
                            <input type="text" class="form-control box-detail ship_note2" name="" id="ship_note_">
                        </div>
                        <div class="box-show2" style="display: none">
                           <select name="" id="ship_pay_s" class="form-control">
                                <option value="">--เลือกจ่ายเงิน--</option>
                                <option value="1">เงินสด</option>
                                <option value="2">โอนเงิน</option>
                           </select>
                           <br>
                           <input type="file" class="form-control s-bill" name="" id="ship_bill">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">ปิด</button>
                        <button type="submit" class="btn btn-sm btn-primary">บันทึก</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">การจ่ายเงิน</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="" id="create-product-category3">
                    <div class="modal-body">
                        <div class="ship_status_"></div>
                        <br>
                        <div class="select_bill2" style="display: none">
                            <label for="">สลิปโอน</label>
                            <div class="ship_bill"></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {

            $('body').on('change', '.order_status1', function() {
                var id = $('.order_status1').val()
                if (id == 1) { //จ่ายเงิน
                    $('.box-show').hide()
                    $('.box-detail').val(null)
                    $('.box-show2').show()
                    $('.box-show3').hide()
                }
                if (id == 2) { //ไม่จ่าย
                    $('.box-show').show()
                    $('.box-show2').hide()
                    $('.box-show3').hide()
                    $('#ship_pay_s').val(null)
                    $('.s-bill').val(null)
                }
                if (id == 3) { //ค้างจ่าย
                    $('.box-show').hide()
                    $('.box-show2').hide()
                    $('.box-show3').show()
                    $('.box-detail').val(null)
                    $('#ship_pay_s').val(null)
                    $('.s-bill').val(null)
                }
            });

            $('body').on('click', '.open_modal2', function() {
                var ship_pay_s = $(this).data('ship_pay_s');
                var ship_bill = $(this).data('ship_bill');
// console.log(ship_bill);
                if(ship_pay_s == 2){
                    $('.select_bill2').show()
                }else{
                    $('.select_bill2').hide()
                }

                var title =  '';
                    if(ship_pay_s == 1){
                        title = 'จ่ายเงินสด'
                    }else{
                        title = 'จ่ายแบบโอน'
                    }
                var html = '';
                html += `<img src="{{ url('/upload/shipment/`+ship_bill+`') }}" alt="" width="50%">`;
                console.log(html);
                $('.ship_status_').html('').append("<label>"+title+"</label>")
                $('.ship_bill').html('').append(html)
            })

            $('body').on('click', '.open_modal3', function() {
                var ship_id = $(this).data('ship_id');
                var ship_pay = $(this).data('ship_pay');
                var ship_note = $(this).data('ship_note');
                var ship_pay_s = $(this).data('ship_pay_s');
                var ship_price = $(this).data('ship_price');
                var ship_bill = $(this).data('ship_bill');
                console.log(ship_pay)
                console.log(ship_pay_s)
                if(ship_pay == 1){
                    $('.box-show').hide()
                    $('.box-show2').show()
                    $('.box-show3').hide()
                }
                if(ship_pay == 2){
                    $('.box-show').show()
                    $('.box-show2').hide()
                    $('.box-show3').hide()
                }
                if(ship_pay == 3){
                    $('.box-show').hide()
                    $('.box-show2').hide()
                    $('.box-show3').show()
                }
                $('#ship_id__').val(ship_id)
                $('#ship_pay_').val(ship_pay)
                $('#ship_note_').val(ship_note)
                $('#ship_pay_s').val(ship_pay_s)
                $('#ship_price').val(ship_price)
                $('#ship_bill').val(ship_bill)
            })

            $('body').on('submit', '#create-product-category3', function(e) {
                e.preventDefault();
                var ship_id = $('#ship_id__').val()
                var ship_note = $('#ship_note_').val()
                var ship_pay = $('#ship_pay_').val()
                var ship_price = $('#ship_price').val()
                var ship_pay_s = $('#ship_pay_s').val()
                var ship_note2 = $('.ship_note2').val()
                var ship_bill = $('#ship_bill').prop('files');

                var fd = new FormData();

                if (ship_id) {

                    fd.append('_token', "{{ csrf_token() }}");
                    fd.append('ship_id', ship_id);
                    fd.append('ship_note', ship_note);
                    fd.append('ship_pay', ship_pay);
                    fd.append('ship_price', ship_price);
                    fd.append('ship_pay_s', ship_pay_s);
                    fd.append('ship_note2', ship_note2);

                    jQuery.each(jQuery('#ship_bill')[0].files, function(i, file) {
                        fd.append('ship_bill', file);
                    });

                    $.ajax({
                        method: "POST",
                        url: "/shipment/price",
                        dataType: 'json',
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: fd,
                    }).done(function(rec) {
                        // rec = JSON.parse(rec);
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
                }else {
                    swal({
                        title: 'กรุณากรอกข้อมูลให้ครบถ้วน!',
                        text: "กดปุ่ม ok เพื่อดำเนินการต่อ!",
                        type: 'error',
                        padding: '2em'
                    })
                }

            });

            $('body').on('click', '.open_modal', function() {
                var product_img = $(this).data('product_img');
                console.log(product_img);
                var html = '';
                html += `<img src="{{ asset('/upload/store/`+product_img+`') }}">`;
                $('#product_img_show').html('').append(html);
            });
        });
    </script>
@endsection
