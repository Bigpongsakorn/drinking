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
                                    <div style="margin:auto">
                                        <button class="btn btn-sm btn-info btn-all">ทั้งหมด</button>
                                        <button class="btn btn-sm btn-warning btn-pending">เก็บขึ้นรถ</button>
                                        <button class="btn btn-sm btn-success btn-fin">เก็บเข้าคลัง</button>
                                    </div>
                                    <br>
                                    <div style="margin:auto">
                                        <a href="{{ url('/customer/index') }}">
                                            <button class="btn btn-primary">
                                                เพิ่มการเก็บสินค้า
                                            </button>
                                        </a>
                                    </div>
                                    <div class="card-block">
                                        <div class="table-responsive dt-responsive">
                                            <table id="multi-colum-dt" class="table table-striped table-bordered nowrap">
                                                <thead>
                                                    <tr style="text-align: center;">
                                                        <th>รหัสการเก็บสินค้า</th>
                                                        <th>ชื่อลูกค้า</th>
                                                        <th>เบอร์โทร</th>
                                                        <th>วันที่เก็บสินค้า</th>
                                                        <th>รายละเอียด</th>
                                                        <th>สถานะ</th>
                                                        <th>แก้ไข / ลบ</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="table-all">
                                                    @foreach ($return as $value)
                                                    <tr>
                                                        <td style="text-align: center;">{{ sprintf('%05d',$value->re_id) }}</td>
                                                        <td style="text-align: center;">
                                                            {{ $value->cus_fristname }} {{ $value->cus_lastname }}
                                                        </td>
                                                        <td style="text-align: center;">
                                                            {{ $value->cus_phonenumber }}
                                                        </td>
                                                        <td style="text-align: center;">
                                                            {{ date('d-m-Y', strtotime($value->re_date)) }}
                                                        </td>
                                                        <td style="text-align: center;">
                                                            <a href="{{ url('/return/return_detail/' . $value->re_id) }}">
                                                                <button class="btn btn-sm btn-info">รายละเอียด</button>
                                                            </a>
                                                        </td>
                                                        <td style="text-align: center;">
                                                            @if ($value->re_status == 0)
                                                                <button class="btn btn-sm btn-warning open_modal"
                                                                    data-toggle="modal" data-target="#exampleModal"
                                                                    data-re_id="{{ $value->re_id }}" data-re_status="{{ $value->re_status }}">
                                                                    เก็บขึ้นรถ
                                                                </button>
                                                            @else
                                                                <button class="btn btn-sm btn-success">
                                                                    เก็บเข้าคลัง
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
                                                                <a href="{{ url('/return/return_edit/' . $value->re_id) }}">
                                                                    <button class="btn btn-sm btn-primary">edit</button>
                                                                </a>
                                                                <a href="javascript:void(0);" class="delete"
                                                                    data-id="{{ $value->re_id }}">
                                                                    <button class="btn btn-sm btn-danger">
                                                                        delete
                                                                    </button>
                                                                </a>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                                <tbody class="table-pending">
                                                    @foreach ($return_w as $value)
                                                    <tr>
                                                        <td style="text-align: center;">{{ sprintf('%05d',$value->re_id) }}</td>
                                                        <td style="text-align: center;">
                                                            {{ $value->cus_fristname }} {{ $value->cus_lastname }}
                                                        </td>
                                                        <td style="text-align: center;">
                                                            {{ $value->cus_phonenumber }}
                                                        </td>
                                                        <td style="text-align: center;">
                                                            {{ date('d-m-Y', strtotime($value->re_date)) }}
                                                        </td>
                                                        <td style="text-align: center;">
                                                            <a href="{{ url('/return/return_detail/' . $value->re_id) }}">
                                                                <button class="btn btn-sm btn-info">รายละเอียด</button>
                                                            </a>
                                                        </td>
                                                        <td style="text-align: center;">
                                                            @if ($value->re_status == 0)
                                                                <button class="btn btn-sm btn-warning open_modal"
                                                                    data-toggle="modal" data-target="#exampleModal"
                                                                    data-re_id="{{ $value->re_id }}" data-re_status="{{ $value->re_status }}">
                                                                    เก็บขึ้นรถ
                                                                </button>
                                                            @else
                                                                <button class="btn btn-sm btn-success">
                                                                    เก็บเข้าคลัง
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
                                                                <a href="{{ url('/return/return_edit/' . $value->re_id) }}">
                                                                    <button class="btn btn-sm btn-primary">edit</button>
                                                                </a>
                                                                <a href="javascript:void(0);" class="delete"
                                                                    data-id="{{ $value->re_id }}">
                                                                    <button class="btn btn-sm btn-danger">
                                                                        delete
                                                                    </button>
                                                                </a>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                                <tbody class="table-fin">
                                                    @foreach ($return_f as $value)
                                                    <tr>
                                                        <td style="text-align: center;">{{ sprintf('%05d',$value->re_id) }}</td>
                                                        <td style="text-align: center;">
                                                            {{ $value->cus_fristname }} {{ $value->cus_lastname }}
                                                        </td>
                                                        <td style="text-align: center;">
                                                            {{ $value->cus_phonenumber }}
                                                        </td>
                                                        <td style="text-align: center;">
                                                            {{ date('d-m-Y', strtotime($value->re_date)) }}
                                                        </td>
                                                        <td style="text-align: center;">
                                                            <a href="{{ url('/return/return_detail/' . $value->re_id) }}">
                                                                <button class="btn btn-sm btn-info">รายละเอียด</button>
                                                            </a>
                                                        </td>
                                                        <td style="text-align: center;">
                                                            @if ($value->re_status == 0)
                                                                <button class="btn btn-sm btn-warning open_modal"
                                                                    data-toggle="modal" data-target="#exampleModal"
                                                                    data-re_id="{{ $value->re_id }}" data-re_status="{{ $value->re_status }}">
                                                                    เก็บขึ้นรถ
                                                                </button>
                                                            @else
                                                                <button class="btn btn-sm btn-success">
                                                                    เก็บเข้าคลัง
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
                                                                <a href="{{ url('/return/return_edit/' . $value->re_id) }}">
                                                                    <button class="btn btn-sm btn-primary">edit</button>
                                                                </a>
                                                                <a href="javascript:void(0);" class="delete"
                                                                    data-id="{{ $value->re_id }}">
                                                                    <button class="btn btn-sm btn-danger">
                                                                        delete
                                                                    </button>
                                                                </a>
                                                            @endif
                                                        </td>
                                                    </tr>
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

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">สถานะการเก็บคืน</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="" id="re_id">
                <select name="" class="form-control" id="re_status">
                    <option value="0">เก็บขึ้นรถ</option>
                    <option value="1">เก็บเข้าคลัง</option>
                </select>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">ปิด</button>
                <button type="submit" class="btn btn-sm btn-primary save_status">บันทึก</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
    <script>
        $(document).ready(function() {

            $('body').on('click', '.open_modal', function() {
                var re_id = $(this).data('re_id');
                var re_status = $(this).data('re_status');
                
                console.log(re_id);
                console.log(re_status);
                $('#re_id').val(re_id)
                $('#re_status').val(re_status)
            })

            $('body').on('click', '.save_status', function(e) {
                // e.preventDefault();
                var re_id = $('#re_id').val();
                var re_status = $('#re_status').val();
                var fd = new FormData();

                fd.append('_token', "{{ csrf_token() }}");
                fd.append('re_id', re_id);
                fd.append('re_status', re_status);

                $.ajax({
                    method: "POST",
                    url: "/drinking/public/return/status",
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
                            url: "/drinking/public/return/destroy/" + id,
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
            $('.table-fin').hide()
            $('.btn-all').click(function() {
                $('.table-all').show()
                $('.table-pending').hide()
                $('.table-fin').hide()
            });
            $('.btn-pending').click(function() {
                $('.table-pending').show()
                $('.table-all').hide()
                $('.table-fin').hide()
            });
            $('.btn-fin').click(function() {
                $('.table-pending').hide()
                $('.table-all').hide()
                $('.table-fin').show()
            });
        
        });
    </script>
@endsection
