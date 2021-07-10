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
                                        <h5>ข้อมูลสั่งซื้อสินค้า</h5>
                                    </div>
                                    <div class="card-block">
                                        <div class="table-responsive dt-responsive">
                                            <table id="multi-colum-dt" class="table table-striped table-bordered nowrap">
                                                <thead>
                                                    <tr style="text-align: center;">
                                                        <th>ลำดับ</th>
                                                        <th>ชื่อสั่งสินค้า</th>
                                                        <th>วันที่เริ่มสั่งซื้อ</th>
                                                        <th>วันที่สั่งซื้อเสร็จ</th>
                                                        <th>รายละเอียด</th>
                                                        <th>การอนุมัติ</th>
                                                        <th>แก้ไข / ลบ</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php $i = 1 @endphp
                                                    @foreach ($order as $value)
                                                        <tr>
                                                            <td style="text-align: center;">{{ $i }}</td>
                                                            <td>{{ $value->order_name }}</td>
                                                            <td style="text-align: center;">
                                                                {{ date('d-m-Y', strtotime($value->order_startdate)) }}
                                                            </td>
                                                            <td style="text-align: center;">
                                                                รอยืนยัน
                                                            </td>
                                                            <td style="text-align: center;">
                                                                <a href="{{ url('/order/order_detail/' . $value->order_id) }}">
                                                                    <button class="btn btn-sm btn-primary">
                                                                        รายละเอียด
                                                                    </button>
                                                                </a>
                                                            </td>
                                                            <td style="text-align: center;">
                                                                <button type="button" data-toggle="modal"
                                                                    data-target="#exampleModal"
                                                                    data-withdraw_m_id="{{ $value->withdraw_m_id }}"
                                                                    data-withdraw_m_status="{{ $value->withdraw_m_status }}"
                                                                    class="btn btn-sm btn-warning open_modal">รออนุมัติ
                                                                </button>
                                                            </td>
                                                            <td style="text-align: center;">
                                                                <a href="{{ url('/order/order_edit/' . $value->order_id) }}">
                                                                    <button class="btn btn-sm btn-primary">edit</button>
                                                                </a>
                                                                <a href="javascript:void(0);" class="delete"
                                                                    data-id="{{ $value->order_id }}">
                                                                    <button class="btn btn-sm btn-danger">
                                                                        delete
                                                                    </button>
                                                                </a>
                                                            </td>
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

@endsection

@section('js')
    <script>
        $(document).ready(function() {

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
        });
    </script>
@endsection
