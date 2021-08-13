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
                                        <h5>ข้อมูลสั่งซื้อสินค้า</h5>
                                    </div>
                                    <div style="margin:auto">
                                        <button class="btn btn-sm btn-info btn-all">ทั้งหมด</button>
                                        <button class="btn btn-sm btn-warning btn-pending">รอจ่ายเงิน</button>
                                        {{-- <button class="btn btn-sm btn-danger btn-dis">ไม่อนุมัติ</button>
                                        <button class="btn btn-sm btn-secondary btn-approve">อนุมัติการผลิต</button> --}}
                                        <button class="btn btn-sm btn-success btn-finished">จ่ายเงินแล้ว</button>
                                    </div>
                                    <div class="card-block">
                                        <div class="table-responsive dt-responsive">
                                            <table id="multi-colum-dt" class="table table-striped table-bordered nowrap">
                                                <thead>
                                                    <tr style="text-align: center;">
                                                        <th>ลำดับ</th>
                                                        <th>ชื่อสั่งสินค้า</th>
                                                        <th>ราคาทั้งหมด</th>
                                                        <th>วันที่เริ่มสั่งซื้อ</th>
                                                        {{-- <th>วันที่สั่งซื้อเสร็จ</th> --}}
                                                        <th>รายละเอียด</th>
                                                        <th>การจ่ายเงิน</th>
                                                        <th>แก้ไข / ลบ</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="table-all">
                                                    @php $i = 1 @endphp
                                                    @foreach ($order as $value)
                                                        <tr>
                                                            <td style="text-align: center;">{{ $i }}</td>
                                                            <td>{{ $value->order_name }}</td>
                                                            <td style="text-align: right;">
                                                                {{ $value->total }}
                                                            </td>
                                                            <td style="text-align: center;">
                                                                {{ date('d-m-Y', strtotime($value->order_startdate)) }}
                                                            </td>
                                                            {{-- <td style="text-align: center;">
                                                                รอยืนยัน
                                                            </td> --}}
                                                            <td style="text-align: center;">
                                                                <a
                                                                    href="{{ url('/order/order_detail/' . $value->order_id) }}">
                                                                    <button class="btn btn-sm btn-primary">
                                                                        รายละเอียด
                                                                    </button>
                                                                </a>
                                                            </td>
                                                            <td style="text-align: center;">
                                                                @if ($value->order_status == 0)
                                                                    <button type="button" data-toggle="modal"
                                                                        data-target="#exampleModal"
                                                                        data-order_id="{{ $value->order_id }}"
                                                                        data-order_status="{{ $value->order_status }}"
                                                                        class="btn btn-sm btn-warning open_modal">รอจ่ายเงิน
                                                                    </button>
                                                                @else
                                                                    <button type="button" data-toggle="modal"
                                                                            data-target="#exampleModal2"
                                                                            data-order_id="{{ $value->order_id }}"
                                                                            data-order_status="{{ $value->order_status }}"
                                                                            data-order_bill="{{ $value->order_bill }}"
                                                                        class="btn btn-sm btn-success open_modal2">จ่ายเงินแล้ว
                                                                    </button>
                                                                @endif
                                                            </td>
                                                            @if ($value->order_status == 0)
                                                                <td style="text-align: center;">
                                                                    <a
                                                                        href="{{ url('/order/order_edit/' . $value->order_id) }}">
                                                                        <button class="btn btn-sm btn-primary">edit</button>
                                                                    </a>
                                                                    <a href="javascript:void(0);" class="delete"
                                                                        data-id="{{ $value->order_id }}">
                                                                        <button class="btn btn-sm btn-danger">
                                                                            delete
                                                                        </button>
                                                                    </a>
                                                                </td>
                                                            @else
                                                                <td style="text-align: center;">
                                                                    <button class="btn btn-sm btn-secondary">edit</button>
                                                                    <button class="btn btn-sm btn-secondary">
                                                                        delete
                                                                    </button>
                                                                </td>
                                                            @endif
                                                        </tr>
                                                        @php $i++ @endphp
                                                    @endforeach
                                                </tbody>
                                                <tbody class="table-pending">
                                                    @php $i = 1 @endphp
                                                    @foreach ($pending as $value)
                                                        <tr>
                                                            <td style="text-align: center;">{{ $i }}</td>
                                                            <td>{{ $value->order_name }}</td>
                                                            <td style="text-align: right;">
                                                                {{ $value->total }}
                                                            </td>
                                                            <td style="text-align: center;">
                                                                {{ date('d-m-Y', strtotime($value->order_startdate)) }}
                                                            </td>
                                                            {{-- <td style="text-align: center;">
                                                                รอยืนยัน
                                                            </td> --}}
                                                            <td style="text-align: center;">
                                                                <a
                                                                    href="{{ url('/order/order_detail/' . $value->order_id) }}">
                                                                    <button class="btn btn-sm btn-primary">
                                                                        รายละเอียด
                                                                    </button>
                                                                </a>
                                                            </td>
                                                            <td style="text-align: center;">
                                                                @if ($value->order_status == 0)
                                                                    <button type="button" data-toggle="modal"
                                                                        data-target="#exampleModal"
                                                                        data-order_id="{{ $value->order_id }}"
                                                                        data-order_status="{{ $value->order_status }}"
                                                                        class="btn btn-sm btn-warning open_modal">รอจ่ายเงิน
                                                                    </button>
                                                                @else
                                                                    <button type="button"
                                                                        class="btn btn-sm btn-success open_modal">จ่ายเงินแล้ว
                                                                    </button>
                                                                @endif
                                                            </td>
                                                            @if ($value->order_status == 0)
                                                                <td style="text-align: center;">
                                                                    <a
                                                                        href="{{ url('/order/order_edit/' . $value->order_id) }}">
                                                                        <button class="btn btn-sm btn-primary">edit</button>
                                                                    </a>
                                                                    <a href="javascript:void(0);" class="delete"
                                                                        data-id="{{ $value->order_id }}">
                                                                        <button class="btn btn-sm btn-danger">
                                                                            delete
                                                                        </button>
                                                                    </a>
                                                                </td>
                                                            @else
                                                                <td style="text-align: center;">
                                                                    <button class="btn btn-sm btn-secondary">edit</button>
                                                                    <button class="btn btn-sm btn-secondary">
                                                                        delete
                                                                    </button>
                                                                </td>
                                                            @endif
                                                        </tr>
                                                        @php $i++ @endphp
                                                    @endforeach
                                                </tbody>
                                                <tbody class="table-finished">
                                                    @php $i = 1 @endphp
                                                    @foreach ($finished as $value)
                                                        <tr>
                                                            <td style="text-align: center;">{{ $i }}</td>
                                                            <td>{{ $value->order_name }}</td>
                                                            <td style="text-align: right;">
                                                                {{ $value->total }}
                                                            </td>
                                                            <td style="text-align: center;">
                                                                {{ date('d-m-Y', strtotime($value->order_startdate)) }}
                                                            </td>
                                                            {{-- <td style="text-align: center;">
                                                                รอยืนยัน
                                                            </td> --}}
                                                            <td style="text-align: center;">
                                                                <a
                                                                    href="{{ url('/order/order_detail/' . $value->order_id) }}">
                                                                    <button class="btn btn-sm btn-primary">
                                                                        รายละเอียด
                                                                    </button>
                                                                </a>
                                                            </td>
                                                            <td style="text-align: center;">
                                                                @if ($value->order_status == 0)
                                                                    <button type="button" data-toggle="modal"
                                                                        data-target="#exampleModal"
                                                                        data-order_id="{{ $value->order_id }}"
                                                                        data-order_status="{{ $value->order_status }}"
                                                                        class="btn btn-sm btn-warning open_modal">รอจ่ายเงิน
                                                                    </button>
                                                                @else
                                                                    <button type="button"
                                                                        class="btn btn-sm btn-success open_modal">จ่ายเงินแล้ว
                                                                    </button>
                                                                @endif
                                                            </td>
                                                            @if ($value->order_status == 0)
                                                                <td style="text-align: center;">
                                                                    <a
                                                                        href="{{ url('/order/order_edit/' . $value->order_id) }}">
                                                                        <button class="btn btn-sm btn-primary">edit</button>
                                                                    </a>
                                                                    <a href="javascript:void(0);" class="delete"
                                                                        data-id="{{ $value->order_id }}">
                                                                        <button class="btn btn-sm btn-danger">
                                                                            delete
                                                                        </button>
                                                                    </a>
                                                                </td>
                                                            @else
                                                                <td style="text-align: center;">
                                                                    <button class="btn btn-sm btn-secondary">edit</button>
                                                                    <button class="btn btn-sm btn-secondary">
                                                                        delete
                                                                    </button>
                                                                </td>
                                                            @endif
                                                        </tr>
                                                        @php $i++ @endphp
                                                    @endforeach
                                                </tbody>
                                            </table>
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

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">การจ่ายเงิน</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="" id="create-product-category">
                    <div class="modal-body">
                        <input type="hidden" id="order_id" name="" value="">
                        <select name="" id="order_status1" class="form-control order_status">
                            <option value="">-- เลือกการจ่ายเงิน --</option>
                            <option value="1">จ่ายเงินสด</option>
                            <option value="2">จ่ายแบบโอน</option>
                        </select>
                        <br>
                        <div class="select_bill" style="display: none">
                            <label for="">สลิปโอน</label>
                            <input type="file" class="form-control order_bill">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">ปิด</button>
                            <button type="submit" class="btn btn-sm btn-primary">บันทึก</button>
                        </div>
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
                {{-- <form class="" id="create-product-category"> --}}
                    <div class="modal-body">
                        {{-- <input type="hidden" id="order_id_" name="" value="">
                        <select name="" id="order_status1" class="form-control order_status order_status_">
                            <option value="">-- เลือกการจ่ายเงิน --</option>
                            <option value="1">จ่ายเงินสด</option>
                            <option value="2">จ่ายแบบโอน</option>
                        </select> --}}
                        <div class="order_status_"></div>
                        <br>
                        <div class="select_bill2" style="display: none">
                            <label for="">สลิปโอน</label>
                            {{-- <input type="file" class="form-control order_bill"> --}}
                            <div id="order_bill"></div>
                        </div>

                        {{-- <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">ปิด</button>
                            <button type="submit" class="btn btn-sm btn-primary">บันทึก</button>
                        </div> --}}
                    </div>
                {{-- </form> --}}
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script>
        $(document).ready(function() {

            $('body').on('change', '#order_status1', function() {
                var id = $('#order_status1').val()
                console.log(id)
                if (id == 1) {
                    $('.select_bill').hide()
                    $('.order_bill').val(null)
                }
                if (id == 2) {
                    $('.select_bill').show()
                }
                if (id == "") {
                    $('.select_bill').hide()
                    $('.order_bill').val(null)
                }

            });

            $('body').on('click', '.open_modal2', function() {
                // var order_id = $(this).data('order_id');
                var order_status = $(this).data('order_status');
                var order_bill = $(this).data('order_bill');
                if(order_status == 2){
                    $('.select_bill2').show()
                }
// console.log(order_id)
// console.log(order_status)
// console.log(order_bill)
                // $('#order_id_').val(order_id)
                // $('.order_status_').val(order_status)
                // $('#order_bill').val(order_bill)
                var title =  '';
                    if(order_status == 1){
                        title = 'จ่ายเงินสด'
                    }else{
                        title = 'จ่ายแบบโอน'
                    }
                var html = '';
                html += `<img src="{{ url('/upload/slip/`+order_bill+`') }}" alt="" width="50%">`;
                $('.order_status_').html('').append("<label>"+title+"</label>")
                $('#order_bill').html('').append(html)
            })

            $('body').on('click', '.open_modal', function() {
                var order_id = $(this).data('order_id');
                var order_status = $(this).data('order_status');

                $('#order_id').val(order_id)
                $('#order_status').val(order_status)
            })

            $('body').on('submit', '#create-product-category', function(e) {
                e.preventDefault();
                var order_id = $('#order_id').val()
                var order_status = $('.order_status').val()
                var order_bill = $('.order_bill').prop('files');
                var fd = new FormData();

                if (order_status) {

                    fd.append('_token', "{{ csrf_token() }}");
                    fd.append('order_id', order_id);
                    fd.append('order_status', order_status);
                    // fd.append('order_bill', order_bill);

                    jQuery.each(jQuery('.order_bill')[0].files, function(i, file) {
                        fd.append('order_bill', file);
                    });

                    $.ajax({
                        method: "POST",
                        url: "/order/status",
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
                                title: 'โปรดใส่รูปใบสร็จจ่ายเงิน!',
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
                            url: "/order/destroy/" + id,
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
            $('.table-finished').hide()
            $('.btn-all').click(function() {
                $('.table-all').show()
                $('.table-pending').hide()
                $('.table-finished').hide()
            });
            $('.btn-pending').click(function() {
                $('.table-all').hide()
                $('.table-pending').show()
                $('.table-finished').hide()
            });
            $('.btn-finished').click(function() {
                $('.table-all').hide()
                $('.table-pending').hide()
                $('.table-finished').show()
            });

        });
    </script>
@endsection
