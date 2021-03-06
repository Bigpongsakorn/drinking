@extends('layouts.admin.main')
@section('content')
    <div class="pcoded-content">

        <div class="page-header card">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="icon-film bg-c-blue"></i>
                        <div class="d-inline">
                            <h5>จัดการข้อมูลการเบิกวัตถุดิบ</h5>
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
                                        <h5>ข้อมูลการเบิกวัตถุดิบ</h5>
                                    </div>
                                    <div style="margin:auto">
                                        <button class="btn btn-sm btn-info btn-all">ทั้งหมด</button>
                                        <button class="btn btn-sm btn-warning btn-pending">รออนุมัติ</button>
                                        <button class="btn btn-sm btn-danger btn-dis">ไม่อนุมัติ</button>
                                        <button class="btn btn-sm btn-success btn-approve">อนุมัติ</button>
                                    </div>
                                    <div class="card-block">
                                        <div class="table-responsive dt-responsive">
                                            <table id="multi-colum-dt" class="table table-striped table-bordered nowrap">
                                                <thead>
                                                    <tr style="text-align: center;">
                                                        <th>ลำดับ</th>
                                                        <th>ข้อมูลเบิกวัตถุดิบ</th>
                                                        <th>วันที่</th>
                                                        <th>ชื่อผู้เบิก</th>
                                                        <th>รายละเอียด</th>
                                                        <th>การอนุมัติ</th>
                                                        <th>แก้ไข / ลบ</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="table-all">
                                                        @php $i = 1 @endphp
                                                        @foreach ($mate as $value)
                                                            <tr>
                                                                <td style="text-align: center;">{{ $i }}</td>
                                                                <td>
                                                                    {{ $value->withdraw_m_name }}
                                                                </td>
                                                                <td style="text-align: center;">
                                                                    {{ date('d-m-Y',strtotime($value->withdraw_m_date)) }}
                                                                </td>
                                                                <td style="text-align: center;">
                                                                    {{ $value->emp_firstname }} {{ $value->emp_lastname }}
                                                                </td>
                                                                <td style="text-align: center;">
                                                                    <a href="{{ url('/withdraw/withdraw_material_detail/' . $value->withdraw_m_id) }}">
                                                                        <button class="btn btn-sm btn-primary">
                                                                            รายละเอียด
                                                                        </button>
                                                                    </a>
                                                                </td>
                                                                <td style="text-align: center;">
                                                                    @if ($value->withdraw_m_status == 0)
                                                                        <button type="button" data-toggle="modal"
                                                                            data-target="#exampleModal"
                                                                            data-withdraw_m_id="{{ $value->withdraw_m_id }}"
                                                                            data-withdraw_m_status="{{ $value->withdraw_m_status }}"
                                                                            class="btn btn-sm btn-warning open_modal">รออนุมัติ</button>
                                                                    @elseif($value->withdraw_m_status == 1)
                                                                        <button type="button" data-toggle="modal"
                                                                            data-target="#exampleModal"
                                                                            data-withdraw_m_id="{{ $value->withdraw_m_id }}"
                                                                            data-withdraw_m_status="{{ $value->withdraw_m_status }}"
                                                                            class="btn btn-sm btn-danger open_modal">ไม่อนุมัติ</button>
                                                                    @else
                                                                        <button type="button"
                                                                            class="btn btn-sm btn-success">อนุมัติ</button>
                                                                    @endif
                                                                </td>
                                                                @if ($value->withdraw_m_status == 2)
                                                                    <td style="text-align: center;">
                                                                        <button class="btn btn-sm btn-secondary">edit</button>
                                                                        <button class="btn btn-sm btn-secondary">
                                                                            delete
                                                                        </button>
                                                                    </td>
                                                                @else
                                                                    <td style="text-align: center;">
                                                                        <a
                                                                            href="{{ url('/withdraw/withdraw_material_edit/' . $value->withdraw_m_id) }}">
                                                                            <button class="btn btn-sm btn-primary">edit</button>
                                                                        </a>
                                                                        <a href="javascript:void(0);" class="delete"
                                                                            data-id="{{ $value->withdraw_m_id }}">
                                                                            <button class="btn btn-sm btn-danger">
                                                                                delete
                                                                            </button>
                                                                        </a>
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
                                                            <td>
                                                                {{ $value->withdraw_m_name }}
                                                            </td>
                                                            <td style="text-align: center;">
                                                                {{ date('d-m-Y',strtotime($value->withdraw_m_date)) }}
                                                            </td>
                                                            <td style="text-align: center;">
                                                                {{ $value->emp_firstname }} {{ $value->emp_lastname }}
                                                            </td>
                                                            <td style="text-align: center;">
                                                                <a href="{{ url('/withdraw/withdraw_material_detail/' . $value->withdraw_m_id) }}">
                                                                    <button class="btn btn-sm btn-primary">
                                                                        รายละเอียด
                                                                    </button>
                                                                </a>
                                                            </td>
                                                            <td style="text-align: center;">
                                                                @if ($value->withdraw_m_status == 0)
                                                                    <button type="button" data-toggle="modal"
                                                                        data-target="#exampleModal"
                                                                        data-withdraw_m_id="{{ $value->withdraw_m_id }}"
                                                                        data-withdraw_m_status="{{ $value->withdraw_m_status }}"
                                                                        class="btn btn-sm btn-warning open_modal">รออนุมัติ</button>
                                                                @elseif($value->withdraw_m_status == 1)
                                                                    <button type="button" data-toggle="modal"
                                                                        data-target="#exampleModal"
                                                                        data-withdraw_m_id="{{ $value->withdraw_m_id }}"
                                                                        data-withdraw_m_status="{{ $value->withdraw_m_status }}"
                                                                        class="btn btn-sm btn-danger open_modal">ไม่อนุมัติ</button>
                                                                @else
                                                                    <button type="button"
                                                                        class="btn btn-sm btn-success">อนุมัติ</button>
                                                                @endif
                                                            </td>
                                                            @if ($value->withdraw_m_status == 2)
                                                                <td style="text-align: center;">
                                                                    <button class="btn btn-sm btn-secondary">edit</button>

                                                                    <button class="btn btn-sm btn-secondary">
                                                                        delete
                                                                    </button>
                                                                </td>
                                                            @else
                                                                <td style="text-align: center;">
                                                                    <a
                                                                        href="{{ url('/withdraw/withdraw_material_edit/' . $value->withdraw_m_id) }}">
                                                                        <button class="btn btn-sm btn-primary">edit</button>
                                                                    </a>
                                                                    <a href="javascript:void(0);" class="delete"
                                                                        data-id="{{ $value->withdraw_m_id }}">
                                                                        <button class="btn btn-sm btn-danger">
                                                                            delete
                                                                        </button>
                                                                    </a>
                                                                </td>
                                                            @endif
                                                        </tr>
                                                        @php $i++ @endphp
                                                    @endforeach
                                                </tbody>
                                                <tbody class="table-dis">
                                                    @php $i = 1 @endphp
                                                    @foreach ($dis as $value)
                                                        <tr>
                                                            <td style="text-align: center;">{{ $i }}</td>
                                                            <td>
                                                                {{ $value->withdraw_m_name }}
                                                            </td>
                                                            <td style="text-align: center;">
                                                                {{ date('d-m-Y',strtotime($value->withdraw_m_date)) }}
                                                            </td>
                                                            <td style="text-align: center;">
                                                                {{ $value->emp_firstname }} {{ $value->emp_lastname }}
                                                            </td>
                                                            <td style="text-align: center;">
                                                                <a href="{{ url('/withdraw/withdraw_material_detail/' . $value->withdraw_m_id) }}">
                                                                    <button class="btn btn-sm btn-primary">
                                                                        รายละเอียด
                                                                    </button>
                                                                </a>
                                                            </td>
                                                            <td style="text-align: center;">
                                                                @if ($value->withdraw_m_status == 0)
                                                                    <button type="button" data-toggle="modal"
                                                                        data-target="#exampleModal"
                                                                        data-withdraw_m_id="{{ $value->withdraw_m_id }}"
                                                                        data-withdraw_m_status="{{ $value->withdraw_m_status }}"
                                                                        class="btn btn-sm btn-warning open_modal">รออนุมัติ</button>
                                                                @elseif($value->withdraw_m_status == 1)
                                                                    <button type="button" data-toggle="modal"
                                                                        data-target="#exampleModal"
                                                                        data-withdraw_m_id="{{ $value->withdraw_m_id }}"
                                                                        data-withdraw_m_status="{{ $value->withdraw_m_status }}"
                                                                        class="btn btn-sm btn-danger open_modal">ไม่อนุมัติ</button>
                                                                @else
                                                                    <button type="button"
                                                                        class="btn btn-sm btn-success">อนุมัติ</button>
                                                                @endif
                                                            </td>
                                                            @if ($value->withdraw_m_status == 2)
                                                                <td style="text-align: center;">
                                                                    <button class="btn btn-sm btn-secondary">edit</button>

                                                                    <button class="btn btn-sm btn-secondary">
                                                                        delete
                                                                    </button>
                                                                </td>
                                                            @else
                                                                <td style="text-align: center;">
                                                                    <a
                                                                        href="{{ url('/withdraw/withdraw_material_edit/' . $value->withdraw_m_id) }}">
                                                                        <button class="btn btn-sm btn-primary">edit</button>
                                                                    </a>
                                                                    <a href="javascript:void(0);" class="delete"
                                                                        data-id="{{ $value->withdraw_m_id }}">
                                                                        <button class="btn btn-sm btn-danger">
                                                                            delete
                                                                        </button>
                                                                    </a>
                                                                </td>
                                                            @endif
                                                        </tr>
                                                        @php $i++ @endphp
                                                    @endforeach
                                                </tbody>
                                                <tbody class="table-approve">
                                                    @php $i = 1 @endphp
                                                    @foreach ($approve as $value)
                                                        <tr>
                                                            <td style="text-align: center;">{{ $i }}</td>
                                                            <td>
                                                                {{ $value->withdraw_m_name }}
                                                            </td>
                                                            <td style="text-align: center;">
                                                                {{ date('d-m-Y',strtotime($value->withdraw_m_date)) }}
                                                            </td>
                                                            <td style="text-align: center;">
                                                                {{ $value->emp_firstname }} {{ $value->emp_lastname }}
                                                            </td>
                                                            <td style="text-align: center;">
                                                                <a href="{{ url('/withdraw/withdraw_material_detail/' . $value->withdraw_m_id) }}">
                                                                    <button class="btn btn-sm btn-primary">
                                                                        รายละเอียด
                                                                    </button>
                                                                </a>
                                                            </td>
                                                            <td style="text-align: center;">
                                                                @if ($value->withdraw_m_status == 0)
                                                                    <button type="button" data-toggle="modal"
                                                                        data-target="#exampleModal"
                                                                        data-withdraw_m_id="{{ $value->withdraw_m_id }}"
                                                                        data-withdraw_m_status="{{ $value->withdraw_m_status }}"
                                                                        class="btn btn-sm btn-warning open_modal">รออนุมัติ</button>
                                                                @elseif($value->withdraw_m_status == 1)
                                                                    <button type="button" data-toggle="modal"
                                                                        data-target="#exampleModal"
                                                                        data-withdraw_m_id="{{ $value->withdraw_m_id }}"
                                                                        data-withdraw_m_status="{{ $value->withdraw_m_status }}"
                                                                        class="btn btn-sm btn-danger open_modal">ไม่อนุมัติ</button>
                                                                @else
                                                                    <button type="button"
                                                                        class="btn btn-sm btn-success">อนุมัติ</button>
                                                                @endif
                                                            </td>
                                                            @if ($value->withdraw_m_status == 2)
                                                                <td style="text-align: center;">
                                                                    <button class="btn btn-sm btn-secondary">edit</button>

                                                                    <button class="btn btn-sm btn-secondary">
                                                                        delete
                                                                    </button>
                                                                </td>
                                                            @else
                                                                <td style="text-align: center;">
                                                                    <a
                                                                        href="{{ url('/withdraw/withdraw_material_edit/' . $value->withdraw_m_id) }}">
                                                                        <button class="btn btn-sm btn-primary">edit</button>
                                                                    </a>
                                                                    <a href="javascript:void(0);" class="delete"
                                                                        data-id="{{ $value->withdraw_m_id }}">
                                                                        <button class="btn btn-sm btn-danger">
                                                                            delete
                                                                        </button>
                                                                    </a>
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
                        <input type="hidden" id="withdraw_m_id" name="" value="">
                        <select name="withdraw_m_status" id="withdraw_m_status" class="form-control">
                            <option value="0">รออนุมัติ</option>
                            <option value="2">อนุมัติ</option>
                            <option value="1">ไม่อนุมัติ</option>
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

@endsection

@section('js')
    <script>
        $(document).ready(function() {

            $('body').on('click', '.open_modal', function() {
                var withdraw_m_id = $(this).data('withdraw_m_id');
                var withdraw_m_status = $(this).data('withdraw_m_status');

                $('#withdraw_m_id').val(withdraw_m_id)
                $('#withdraw_m_status').val(withdraw_m_status)
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
                            url: "/withdraw_e/destroy/" + id,
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

            $('body').on('submit', '#create-product-category', function(e) {
                e.preventDefault();
                var withdraw_m_id = $('#withdraw_m_id').val()
                var withdraw_m_status = $('#withdraw_m_status').val()
                var fd = new FormData();

                if (withdraw_m_status) {

                    fd.append('_token', "{{ csrf_token() }}");
                    fd.append('withdraw_m_id', withdraw_m_id);
                    fd.append('withdraw_m_status', withdraw_m_status);

                    $.ajax({
                        method: "POST",
                        url: "/withdraw_e/status",
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
                        } else {
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

            $('.table-pending').hide()
            $('.table-dis').hide()
            $('.table-approve').hide()
            $('.btn-all').click(function() {
                $('.table-all').show()
                $('.table-pending').hide()
                $('.table-dis').hide()
                $('.table-approve').hide()
            });
            $('.btn-pending').click(function() {
                $('.table-pending').show()
                $('.table-all').hide()
                $('.table-dis').hide()
                $('.table-approve').hide()
            });
            $('.btn-dis').click(function() {
                $('.table-pending').hide()
                $('.table-all').hide()
                $('.table-pending').hide()
                $('.table-dis').show()
                $('.table-approve').hide()
            });
            $('.btn-approve').click(function() {
                $('.table-pending').hide()
                $('.table-all').hide()
                $('.table-pending').hide()
                $('.table-dis').hide()
                $('.table-approve').show()
            });
        });
    </script>
@endsection
