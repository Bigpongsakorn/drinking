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
                                        <h5>รายละเอียดข้อมูลส่งสินค้า</h5>
                                    </div>
                                    <div style="margin:auto">
                                        <button class="btn btn-sm btn-info btn-all">ทั้งหมด</button>
                                        <button class="btn btn-sm btn-warning btn-pending">รอจัดส่ง</button>
                                        {{-- <button class="btn btn-sm btn-danger btn-dis">ไม่อนุมัติ</button> --}}
                                        <button class="btn btn-sm btn-secondary btn-approve">อนุมัติจัดส่ง</button>
                                        <button class="btn btn-sm btn-success btn-fin">ส่งเสร็จ</button>
                                    </div>
                                    <div class="card-block">
                                        <div class="table-responsive dt-responsive table-p">
                                            <table id="multi-colum-dt" class="table table-striped table-bordered nowrap">
                                                <thead>
                                                    <tr style="text-align: center;">
                                                        {{-- <th><input type="checkbox" name="" id=""></th> --}}
                                                        <th>ลำดับ</th>
                                                        <th>ชื่อ</th>
                                                        <th>วันที่ต้องส่ง</th>
                                                        <th>เบอร์โทร</th>
                                                        <th>รายละเอียด</th>
                                                        <th>สถานะ</th>
                                                        <th>แก้ไข / ลบ</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="table-all">
                                                    @php $i = 1 @endphp
                                                    @foreach ($ship as $value)
                                                        <tr>
                                                            {{-- <td style="text-align: center;">
                                                                <input type="checkbox" name="ck_box" id="ck_box"
                                                                    class="check-box" data-id="{{ $value->cus_id }}"
                                                                    data-date="{{ $value->cus_date }}">
                                                            </td> --}}
                                                            <td style="text-align: center;">{{ $i }}</td>
                                                            <td style="text-align: center;">
                                                                {{ $value->cus_fristname }} {{ $value->cus_lastname }}
                                                            </td>
                                                            <td style="text-align: center;">
                                                                {{ date('d-m-Y', strtotime($value->ship_date)) }}
                                                            </td>
                                                            <td style="text-align: center;">
                                                                {{ $value->cus_phonenumber }}
                                                            </td>
                                                            <td style="text-align: center;">
                                                                <a
                                                                    href="{{ url('/shipment/shipment_detail/' . $value->ship_id) }}">
                                                                    <button class="btn btn-sm btn-info">รายละเอียด</button>
                                                                </a>
                                                            </td>
                                                            <td style="text-align: center;">
                                                                @if ($value->ship_status == 0)
                                                                    @if ($user_type == 1 || $user_type == 2)
                                                                        <button class="btn btn-sm btn-warning open_modal"
                                                                            data-toggle="modal" data-target="#exampleModal"
                                                                            data-ship_id="{{ $value->ship_id }}"
                                                                            data-ship_status="{{ $value->ship_status }}">
                                                                            รอจัดส่ง
                                                                        </button>
                                                                    @else
                                                                        <button class="btn btn-sm btn-warning">
                                                                            รอจัดส่ง
                                                                        </button>
                                                                    @endif
                                                                @elseif($value->ship_status == 1)
                                                                    <button class="btn btn-sm btn-secondary open_modal2"
                                                                        data-toggle="modal" data-target="#exampleModal2"
                                                                        data-ship_id="{{ $value->ship_id }}"
                                                                        data-ship_status="{{ $value->ship_status }}">
                                                                        อนุมัติจัดส่ง
                                                                    </button>
                                                                @else
                                                                    <button class="btn btn-sm btn-success open_modal3"
                                                                        data-toggle="modal" data-target="#exampleModal3"
                                                                        data-ship_id="{{ $value->ship_id }}"
                                                                        data-ship_note="{{ $value->ship_note }}"
                                                                        data-ship_pay="{{ $value->ship_pay }}"
                                                                        data-ship_status="{{ $value->ship_status }}">
                                                                        ส่งเสร็จ
                                                                    </button>
                                                                @endif
                                                            </td>
                                                            <td style="text-align: center;">
                                                                @if ($value->ship_status == 1 || $value->ship_status == 2)
                                                                    <button class="btn btn-sm btn-secondary">edit</button>
                                                                    <button class="btn btn-sm btn-secondary">
                                                                        delete
                                                                    </button>
                                                                @else
                                                                    <a href="{{ url('/shipment/shipment_edit/' . $value->ship_id) }}">
                                                                        <button class="btn btn-sm btn-primary">edit</button>
                                                                    </a>
                                                                    <a href="javascript:void(0);" class="delete"
                                                                        data-id="{{ $value->ship_id }}">
                                                                        <button class="btn btn-sm btn-danger">
                                                                            delete
                                                                        </button>
                                                                    </a>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        @php $i++ @endphp
                                                    @endforeach
                                                </tbody>
                                                <tbody class="table-pending">
                                                    @php $i = 1 @endphp
                                                    @foreach ($ship_pending as $value)
                                                        <tr>
                                                            {{-- <td style="text-align: center;">
                                                                <input type="checkbox" name="ck_box" id="ck_box"
                                                                    class="check-box" data-id="{{ $value->cus_id }}"
                                                                    data-date="{{ $value->cus_date }}">
                                                            </td> --}}
                                                            <td style="text-align: center;">{{ $i }}</td>
                                                            <td style="text-align: center;">
                                                                {{ $value->cus_fristname }} {{ $value->cus_lastname }}
                                                            </td>
                                                            <td style="text-align: center;">
                                                                {{ date('d-m-Y', strtotime($value->ship_date)) }}
                                                            </td>
                                                            <td style="text-align: center;">
                                                                {{ $value->cus_phonenumber }}
                                                            </td>
                                                            <td style="text-align: center;">
                                                                <a
                                                                    href="{{ url('/shipment/shipment_detail/' . $value->ship_id) }}">
                                                                    <button class="btn btn-sm btn-info">รายละเอียด</button>
                                                                </a>
                                                            </td>
                                                            <td style="text-align: center;">
                                                                @if ($value->ship_status == 0)
                                                                    @if ($user_type == 1 || $user_type == 2)
                                                                        <button class="btn btn-sm btn-warning open_modal"
                                                                            data-toggle="modal" data-target="#exampleModal"
                                                                            data-ship_id="{{ $value->ship_id }}"
                                                                            data-ship_status="{{ $value->ship_status }}">
                                                                            รอจัดส่ง
                                                                        </button>
                                                                    @else
                                                                        <button class="btn btn-sm btn-warning">
                                                                            รอจัดส่ง
                                                                        </button>
                                                                    @endif
                                                                @elseif($value->ship_status == 1)
                                                                    <button class="btn btn-sm btn-secondary open_modal2"
                                                                        data-toggle="modal" data-target="#exampleModal2"
                                                                        data-ship_id="{{ $value->ship_id }}"
                                                                        data-ship_status="{{ $value->ship_status }}">
                                                                        อนุมัติจัดส่ง
                                                                    </button>
                                                                @else
                                                                    <button class="btn btn-sm btn-success open_modal3"
                                                                        data-toggle="modal" data-target="#exampleModal3"
                                                                        data-ship_id="{{ $value->ship_id }}"
                                                                        data-ship_note="{{ $value->ship_note }}"
                                                                        data-ship_pay="{{ $value->ship_pay }}"
                                                                        data-ship_status="{{ $value->ship_status }}">
                                                                        ส่งเสร็จ
                                                                    </button>
                                                                @endif
                                                            </td>
                                                            <td style="text-align: center;">
                                                                <a
                                                                    href="{{ url('/shipment/shipment_edit/' . $value->ship_id) }}">
                                                                    <button class="btn btn-sm btn-primary">edit</button>
                                                                </a>
                                                                <a href="javascript:void(0);" class="delete"
                                                                    data-id="{{ $value->ship_id }}">
                                                                    <button class="btn btn-sm btn-danger">
                                                                        delete
                                                                    </button>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        @php $i++ @endphp
                                                    @endforeach
                                                </tbody>
                                                <tbody class="table-approve">
                                                    @php $i = 1 @endphp
                                                    @foreach ($ship_approve as $value)
                                                        <tr>
                                                            {{-- <td style="text-align: center;">
                                                                <input type="checkbox" name="ck_box" id="ck_box"
                                                                    class="check-box" data-id="{{ $value->cus_id }}"
                                                                    data-date="{{ $value->cus_date }}">
                                                            </td> --}}
                                                            <td style="text-align: center;">{{ $i }}</td>
                                                            <td style="text-align: center;">
                                                                {{ $value->cus_fristname }} {{ $value->cus_lastname }}
                                                            </td>
                                                            <td style="text-align: center;">
                                                                {{ date('d-m-Y', strtotime($value->ship_date)) }}
                                                            </td>
                                                            <td style="text-align: center;">
                                                                {{ $value->cus_phonenumber }}
                                                            </td>
                                                            <td style="text-align: center;">
                                                                <a
                                                                    href="{{ url('/shipment/shipment_detail/' . $value->ship_id) }}">
                                                                    <button class="btn btn-sm btn-info">รายละเอียด</button>
                                                                </a>
                                                            </td>
                                                            <td style="text-align: center;">
                                                                @if ($value->ship_status == 0)
                                                                    <button class="btn btn-sm btn-warning open_modal"
                                                                        data-toggle="modal" data-target="#exampleModal"
                                                                        data-ship_id="{{ $value->ship_id }}"
                                                                        data-ship_status="{{ $value->ship_status }}">
                                                                        รอจัดส่ง
                                                                    </button>
                                                                @elseif($value->ship_status == 1)
                                                                    <button class="btn btn-sm btn-secondary open_modal2"
                                                                        data-toggle="modal" data-target="#exampleModal2"
                                                                        data-ship_id="{{ $value->ship_id }}"
                                                                        data-ship_status="{{ $value->ship_status }}">
                                                                        อนุมัติจัดส่ง
                                                                    </button>
                                                                @else
                                                                    <button class="btn btn-sm btn-success open_modal3"
                                                                        data-toggle="modal" data-target="#exampleModal3"
                                                                        data-ship_id="{{ $value->ship_id }}"
                                                                        data-ship_note="{{ $value->ship_note }}"
                                                                        data-ship_pay="{{ $value->ship_pay }}"
                                                                        data-ship_status="{{ $value->ship_status }}">
                                                                        ส่งเสร็จ
                                                                    </button>
                                                                @endif
                                                            </td>
                                                            <td style="text-align: center;">
                                                                {{-- <a href="{{ url('/shipment/shipment_edit/'.$value->ship_id) }}"> --}}
                                                                <button class="btn btn-sm btn-secondary">edit</button>
                                                                {{-- </a> --}}
                                                                {{-- <a href="javascript:void(0);" class="delete"
                                                                    data-id="{{ $value->ship_id }}"> --}}
                                                                <button class="btn btn-sm btn-secondary">
                                                                    delete
                                                                </button>
                                                                {{-- </a> --}}
                                                            </td>
                                                        </tr>
                                                        @php $i++ @endphp
                                                    @endforeach
                                                </tbody>
                                                <tbody class="table-fin">
                                                    @php $i = 1 @endphp
                                                    @foreach ($ship_fin as $value)
                                                        <tr>
                                                            {{-- <td style="text-align: center;">
                                                                <input type="checkbox" name="ck_box" id="ck_box"
                                                                    class="check-box" data-id="{{ $value->cus_id }}"
                                                                    data-date="{{ $value->cus_date }}">
                                                            </td> --}}
                                                            <td style="text-align: center;">{{ $i }}</td>
                                                            <td style="text-align: center;">
                                                                {{ $value->cus_fristname }} {{ $value->cus_lastname }}
                                                            </td>
                                                            <td style="text-align: center;">
                                                                {{ date('d-m-Y', strtotime($value->ship_date)) }}
                                                            </td>
                                                            <td style="text-align: center;">
                                                                {{ $value->cus_phonenumber }}
                                                            </td>
                                                            <td style="text-align: center;">
                                                                <a
                                                                    href="{{ url('/shipment/shipment_detail/' . $value->ship_id) }}">
                                                                    <button class="btn btn-sm btn-info">รายละเอียด</button>
                                                                </a>
                                                            </td>
                                                            <td style="text-align: center;">
                                                                @if ($value->ship_status == 0)
                                                                    <button class="btn btn-sm btn-warning open_modal"
                                                                        data-toggle="modal" data-target="#exampleModal"
                                                                        data-ship_id="{{ $value->ship_id }}"
                                                                        data-ship_status="{{ $value->ship_status }}">
                                                                        รอจัดส่ง
                                                                    </button>
                                                                @elseif($value->ship_status == 1)
                                                                    <button class="btn btn-sm btn-secondary open_modal2"
                                                                        data-toggle="modal" data-target="#exampleModal2"
                                                                        data-ship_id="{{ $value->ship_id }}"
                                                                        data-ship_status="{{ $value->ship_status }}">
                                                                        อนุมัติจัดส่ง
                                                                    </button>
                                                                @else
                                                                    <button class="btn btn-sm btn-success open_modal3"
                                                                        data-toggle="modal" data-target="#exampleModal3"
                                                                        data-ship_id="{{ $value->ship_id }}"
                                                                        data-ship_note="{{ $value->ship_note }}"
                                                                        data-ship_pay="{{ $value->ship_pay }}"
                                                                        data-ship_status="{{ $value->ship_status }}">
                                                                        ส่งเสร็จ
                                                                    </button>
                                                                @endif
                                                            </td>
                                                            <td style="text-align: center;">
                                                                {{-- <a href="{{ url('/shipment/shipment_edit/'.$value->ship_id) }}"> --}}
                                                                <button class="btn btn-sm btn-secondary">edit</button>
                                                                {{-- </a> --}}
                                                                {{-- <a href="javascript:void(0);" class="delete"
                                                                    data-id="{{ $value->ship_id }}"> --}}
                                                                <button class="btn btn-sm btn-secondary">
                                                                    delete
                                                                </button>
                                                                {{-- </a> --}}
                                                            </td>
                                                        </tr>
                                                        @php $i++ @endphp
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            {{-- <button class="btn btn-success" id="submit">Submit</button> --}}
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

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">การอนุมัติ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="" id="create-product-category">
                    <div class="modal-body">
                        <input type="hidden" id="ship_id" name="" value="">
                        <select name="" class="form-control" id="ship_status">
                            <option value="0">รอจัดส่ง</option>
                            <option value="1">อนุมัติจัดส่ง</option>
                        </select>
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
                    <h5 class="modal-title" id="exampleModalLabel">การอนุมัติ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="" id="create-product-category2">
                    <div class="modal-body">
                        <input type="hidden" id="ship_id_" name="" value="">
                        <select name="" class="form-control order_status1" id="ship_status_">
                            <option value="1">อนุมัติจัดส่ง</option>
                            <option value="2">ส่งเสร็จ</option>
                        </select>
                    </div>
                    {{-- <div class="modal-body box-show" style="display: none">
                        <select name="" class="form-control" id="ship_pay">
                            <option value="1">จ่ายเงินแล้ว</option>
                            <option value="2">ไม่ได้จ่ายเงิน</option>
                        </select>
                        <label style="color: red">* หมายเหตุ</label>
                        <input type="text" class="form-control box-detail" name="" id="ship_note">
                    </div> --}}
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">ปิด</button>
                        <button type="submit" class="btn btn-sm btn-primary">บันทึก</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- <div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">การอนุมัติ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="" id="create-product-category3">
                    <div class="modal-body">
                        <input type="hidden" id="ship_id__" name="" value="">
                        <input type="hidden" id="ship_status__" name="" value="">
                        <select name="" class="form-control" id="ship_pay_">
                            <option value="1">จ่ายเงินแล้ว</option>
                            <option value="2">ไม่ได้จ่ายเงิน</option>
                        </select>
                        <label style="color: red">* หมายเหตุ</label>
                        <input type="text" class="form-control box-detail" name="" id="ship_note_">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">ปิด</button>
                        <button type="submit" class="btn btn-sm btn-primary">บันทึก</button>
                    </div>
                </form>
            </div>
        </div>
    </div> --}}

@endsection

@section('js')

    <script>
        $(document).ready(function() {

            // $('body').on('change', '.order_status1', function() {
            //     var id = $('.order_status1').val()
            //     if (id == 1) {
            //         $('.box-show').hide()
            //         $('.box-detail').val(null)
            //     }
            //     if (id == 2) {
            //         $('.box-show').show()
            //     }
            // });

            // $('body').on('click', '.open_modal3', function() {
            //     var ship_id = $(this).data('ship_id');
            //     var ship_pay = $(this).data('ship_pay');
            //     var ship_note = $(this).data('ship_note');
            //     var ship_status = $(this).data('ship_status');

            //     $('#ship_id__').val(ship_id)
            //     $('#ship_pay_').val(ship_pay)
            //     $('#ship_note_').val(ship_note)
            //     $('#ship_status__').val(ship_status)
            // })

            $('body').on('click', '.open_modal2', function() {
                var ship_id = $(this).data('ship_id');
                var ship_status = $(this).data('ship_status');

                $('#ship_id_').val(ship_id)
                $('#ship_status_').val(ship_status)
            })

            $('body').on('click', '.open_modal', function() {
                var ship_id = $(this).data('ship_id');
                var ship_status = $(this).data('ship_status');

                $('#ship_id').val(ship_id)
                $('#ship_status').val(ship_status)
            })

            // $('body').on('submit', '#create-product-category3', function(e) {
            //     e.preventDefault();
            //     var ship_id = $('#ship_id__').val()
            //     var ship_status = $('#ship_status__').val()
            //     var ship_note = $('#ship_note_').val()
            //     var ship_pay = $('#ship_pay_').val()
            //     var fd = new FormData();

            //     if (ship_status) {

            //         fd.append('_token', "{{ csrf_token() }}");
            //         fd.append('ship_id', ship_id);
            //         fd.append('ship_status', ship_status);
            //         fd.append('ship_note', ship_note);
            //         fd.append('ship_pay', ship_pay);

            //         $.ajax({
            //             method: "POST",
            //             url: "/shipment/status",
            //             dataType: 'json',
            //             cache: false,
            //             contentType: false,
            //             processData: false,
            //             data: fd,
            //         }).done(function(rec) {
            //             // rec = JSON.parse(rec);
            //             if (rec.status == '1') {
            //                 swal({
            //                     title: 'บันทึกสำเร็จ!',
            //                     text: "กดปุ่ม ok เพื่อดำเนินการต่อ!",
            //                     type: 'success',
            //                     padding: '2em'
            //                 }).then(function(then) {
            //                     location.reload()
            //                 })
            //             }
            //             if (rec.status == '3') {
            //                 swal({
            //                     title: 'สินค้าไม่พอส่ง!',
            //                     text: "กดปุ่ม ok เพื่อดำเนินการต่อ!",
            //                     type: 'error',
            //                     padding: '2em'
            //                 })
            //             }
            //             if (rec.status == '0') {
            //                 swal({
            //                     title: 'บันทึกไม่สำเร็จ!',
            //                     text: "กดปุ่ม ok เพื่อดำเนินการต่อ!",
            //                     type: 'error',
            //                     padding: '2em'
            //                 })
            //             }
            //         }).fail(function() {
            //             swal("Error!", "You clicked the button!", "error");
            //         })
            //     }

            // })

            $('body').on('submit', '#create-product-category2', function(e) {
                e.preventDefault();
                var ship_id = $('#ship_id_').val()
                var ship_status = $('#ship_status_').val()
                // var ship_note = $('#ship_note').val()
                // var ship_pay = $('#ship_pay').val()
                var fd = new FormData();

                if (ship_status) {

                    fd.append('_token', "{{ csrf_token() }}");
                    fd.append('ship_id', ship_id);
                    fd.append('ship_status', ship_status);
                    // fd.append('ship_note', ship_note);
                    // fd.append('ship_pay', ship_pay);

                    $.ajax({
                        method: "POST",
                        url: "/shipment/status",
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
                                title: 'สินค้าไม่พอส่ง!',
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
                }

            })

            $('body').on('submit', '#create-product-category', function(e) {
                e.preventDefault();
                var ship_id = $('#ship_id').val()
                var ship_status = $('#ship_status').val()
                var fd = new FormData();

                if (ship_status) {

                    fd.append('_token', "{{ csrf_token() }}");
                    fd.append('ship_id', ship_id);
                    fd.append('ship_status', ship_status);

                    $.ajax({
                        method: "POST",
                        url: "/shipment/status",
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
                                title: 'สินค้าไม่พอส่ง!',
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
                }

            })

            $('body').on('click', '.delete', function() {
                let id = $(this).data('id');

                swal({
                    title: 'ยืนยันการลบข้อมูล?',
                    text: "กดปุ่ม Delete เพื่อดำเนินการต่อ!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Delete',
                    padding: '2em'
                }).then(function(result) {
                    if (result.value) {

                        $.ajax({
                            method: "GET",
                            url: "/shipment/destroy/" + id,
                        }).done(function(rec) {
                            rec = JSON.parse(rec);
                            console.log(rec);
                            if (rec.status == '1') {
                                swal({
                                    title: 'ลบข้อมูลสำเร็จ!',
                                    text: "กดปุ่ม ok เพื่อดำเนินการต่อ!",
                                    type: 'success',
                                    padding: '2em'
                                }).then(function(then) {
                                    location.reload()
                                })
                            } else {
                                swal({
                                    title: 'ลบข้อมูลไม่สำเร็จ!',
                                    text: "กดปุ่ม ok เพื่อดำเนินการต่อ!",
                                    type: 'error',
                                    padding: '2em'
                                })
                            }
                        }).fail(function() {
                            swal("Error!", "You clicked the button!", "error");
                        })

                    }
                })
            })

            $('.table-pending').hide()
            $('.table-approve').hide()
            $('.table-fin').hide()
            $('.btn-all').click(function() {
                $('.table-all').show()
                $('.table-pending').hide()
                $('.table-approve').hide()
                $('.table-fin').hide()
            });
            $('.btn-pending').click(function() {
                $('.table-pending').show()
                $('.table-all').hide()
                $('.table-approve').hide()
                $('.table-fin').hide()
            });
            $('.btn-approve').click(function() {
                $('.table-pending').hide()
                $('.table-all').hide()
                $('.table-pending').hide()
                $('.table-approve').show()
                $('.table-fin').hide()
            });
            $('.btn-fin').click(function() {
                $('.table-pending').hide()
                $('.table-all').hide()
                $('.table-pending').hide()
                $('.table-approve').hide()
                $('.table-fin').show()
            });
            // $('body').on('click', '#submit', function() {
            //     var checkbox = $('.check-box')

            //     $.each(checkbox, function(index, value) {
            //         if ($(this).is(':checked')) {

            //             var id = $(this).data('id')
            //             var date = $(this).data('date')
            //             console.log('checkkkkk', id, '=>', date)
            //             var fd = new FormData();

            //             if (id && date) {

            //             fd.append('_token', "{{ csrf_token() }}");
            //             fd.append('id', id);
            //             fd.append('date', date);

            //             $.ajax({
            //                 method: "POST",
            //                 url: "/shipment/store",
            //                 dataType: 'json',
            //                 cache: false,
            //                 contentType: false,
            //                 processData: false,
            //                 data: fd,

            //             }).done(function(rec) {

            //                 if (rec.status == '1') {
            //                     swal({
            //                         title: 'บันทึกสำเร็จ!',
            //                         text: "กดปุ่ม ok เพื่อดำเนินการต่อ!",
            //                         type: 'success',
            //                         padding: '2em'
            //                     }).then(function(then) {
            //                         // location.reload()
            //                         location.href = '/customer/index'
            //                     })
            //                 } else {
            //                     swal({
            //                         title: 'บันทึกไม่สำเร็จ!',
            //                         text: "กดปุ่ม ok เพื่อดำเนินการต่อ!",
            //                         type: 'error',
            //                         padding: '2em'
            //                     })
            //                 }
            //             }).fail(function() {
            //                 swal("Error!", "You clicked the button!", "error");
            //             })

            //         } else {
            //             swal({
            //                 title: 'กรุณากรอกข้อมูลให้ครบถ้วน!',
            //                 text: "กดปุ่ม ok เพื่อดำเนินการต่อ!",
            //                 type: 'error',
            //                 padding: '2em'
            //             })
            //         }
            //         }
            //     });
            // });
        });
    </script>

@endsection
