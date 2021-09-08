@extends('layouts.admin.main')
@section('content')
    <div class="pcoded-content">

        <div class="page-header card">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="icon-people bg-c-blue"></i>
                        <div class="d-inline">
                            <h5>จัดการข้อมูลลูกค้า</h5>
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
                                        <h5>ข้อมูลลูกค้า</h5>
                                    </div>
                                    <div class="card-block">
                                        <div class="table-responsive dt-responsive">
                                            <table id="multi-colum-dt" class="table table-striped table-bordered nowrap">
                                                <thead>
                                                    <tr style="text-align: center;">
                                                        <th>รหัสลูกค้า</th>
                                                        <th>ชื่อ - นามสกุล</th>
                                                        <th>เบอร์โทรศัพท์</th>
                                                        {{-- <th>วันที่จัดส่ง</th> --}}
                                                        <th>ตำแหน่ง</th>
                                                        <th>ข้อมูลลูกค้า</th>
                                                        <th>เพื่มข้อมูลการจัดส่ง</th>
                                                        <th>เพื่มข้อมูลเก็บคืน</th>
                                                        <th>สถานะ</th>
                                                        <th>แก้ไข / ลบ</th>
                                                        {{-- <th>ลบ</th> --}}
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php $i = 1 @endphp
                                                    @foreach ($customer as $value)
                                                        <tr>
                                                            <td style="text-align: center;">
                                                                {{ sprintf('%05d', $value->cus_id) }}</td>
                                                            <td>
                                                                {{ $value->cus_fristname }} {{ $value->cus_lastname }}
                                                            </td>
                                                            <td style="text-align: center;">
                                                                {{ $value->cus_phonenumber }}
                                                            </td>
                                                            {{-- <td style="text-align: center;">
                                                                {{ $value->cus_date }}
                                                            </td> --}}
                                                            <td style="text-align: center;">
                                                                <a href="https://google.com/maps?q={{$value->cus_lat}},{{$value->cus_long}}"
                                                                    target="_blank">
                                                                    <button class="btn btn-sm btn-secondary">ดูตำแหน่ง</button>
                                                                </a>
                                                            </td>
                                                            <td style="text-align: center;">
                                                                <a
                                                                    href="{{ url('/customer/product_customer/' . $value->cus_id) }}">
                                                                    <button class="btn btn-sm btn-primary">ดูข้อมูล</button>
                                                                </a>
                                                            </td>
                                                            <td style="text-align: center;">
                                                                <a href="{{ url('/shipment/shipment_create/' . $value->cus_id) }}">
                                                                    <button class="btn btn-sm btn-info">เพิ่มข้อมูล</button>
                                                                </a>
                                                            </td>
                                                            <td style="text-align: center;">
                                                                <a href="{{ url('/return/return_create/' . $value->cus_id) }}">
                                                                    <button class="btn btn-sm btn-info">เพิ่มข้อมูล</button>
                                                                </a>
                                                            </td>
                                                            <td style="text-align: center;">
                                                                @if ($value->cus_status == 0)
                                                                    <button class="btn btn-sm btn-success open_modal"
                                                                        type="button" data-toggle="modal"
                                                                        data-target="#exampleModal"
                                                                        data-cus_id="{{ $value->cus_id }}"
                                                                        data-cus_status="{{ $value->cus_status }}"
                                                                        data-cus_status_data="{{ $value->cus_status_data }}">
                                                                        ใช้งานปกติ
                                                                    </button>
                                                                @else
                                                                    <button class="btn btn-sm btn-danger open_modal"
                                                                        type="button" data-toggle="modal"
                                                                        data-target="#exampleModal"
                                                                        data-cus_id="{{ $value->cus_id }}"
                                                                        data-cus_status="{{ $value->cus_status }}"
                                                                        data-cus_status_data="{{ $value->cus_status_data }}">
                                                                        ไม่ได้ใช้งาน
                                                                    </button>
                                                                @endif
                                                            </td>
                                                            <td style="text-align: center;">
                                                                <a href="{{ url('/customer/edit/' . $value->cus_id) }}">
                                                                    <button class="btn btn-sm btn-primary">edit</button>
                                                                </a>
                                                                {{-- </td>
                                                    <td style="text-align: center;"> --}}
                                                                <a href="javascript:void(0);" class="delete"
                                                                    data-id="{{ $value->cus_id }}">
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

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">สถานะผู้ใช้งาน</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="save_status" id="">
                    <div class="modal-body">
                        <input type="hidden" id="cus_id" name="" value="">
                        <select name="" id="cus_status" class="form-control change_status">
                            <option value="0">ใช้งานปกติ</option>
                            <option value="1">ไม่ได้ใช้งาน</option>
                        </select>
                    </div>
                    <div class="modal-body status_data" style="display: none">
                        <p style="color: red">*หมายเหตุ</p>
                        <input type="text" name="" id="cus_status_data" class="form-control status_data_i">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">ปิด</button>
                        <button type="submit" class="btn btn-sm btn-primary">บันทึก</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script>
        $(document).ready(function() {

            $('body').on('change', '.change_status', function() {
                var id = $('.change_status').val()
                console.log(id);
                if (id == 0) {
                    $('.status_data').hide()
                    $('.status_data_i').val(null)
                }
                if (id == 1) {
                    $('.status_data').show()
                }
            });

            $('body').on('click', '.open_modal', function() {
                var cus_id = $(this).data('cus_id');
                var cus_status = $(this).data('cus_status');
                var cus_status_data = $(this).data('cus_status_data');
                console.log(cus_status);
                if (cus_status == 1) {
                    $('.status_data').show()
                } else {
                    $('.status_data').hide()
                }
                $('#cus_id').val(cus_id)
                $('#cus_status').val(cus_status)
                $('#cus_status_data').val(cus_status_data)
            });

            $('body').on('submit', '.save_status', function(e) {
                e.preventDefault();
                var cus_id = $('#cus_id').val();
                var cus_status = $('#cus_status').val();
                var cus_status_data = $('#cus_status_data').val();
                var fd = new FormData();

                fd.append('_token', "{{ csrf_token() }}");
                fd.append('cus_id', cus_id);
                fd.append('cus_status', cus_status);
                fd.append('cus_status_data', cus_status_data);

                $.ajax({
                    method: "POST",
                    url: "/drinking/public/customer/status",
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
                            title: 'โปรดใส่หมายเหตุ!',
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
            });

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
                            url: "/drinking/public/customer/destroy/" + id,
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
