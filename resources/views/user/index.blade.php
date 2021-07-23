@extends('layouts.admin.main')
@section('content')
    <div class="pcoded-content">

        <div class="page-header card">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class=" icon-user bg-c-blue"></i>
                        <div class="d-inline">
                            <h5>จัดการข้อมูลผู้ใช้งาน</h5>
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
                                        <h5>ข้อมูลผู้ใช้งาน</h5>
                                    </div>
                                    <div class="card-block">
                                        <div class="table-responsive dt-responsive">
                                            <table id="multi-colum-dt" class="table table-striped table-bordered nowrap">
                                                <thead>
                                                    <tr style="text-align: center;">
                                                        <th>รหัสผู้ใข้งาน</th>
                                                        <th>ชื่อผู้ใช้งาน</th>
                                                        <th>ชื่อ - นามสกุล</th>
                                                        <th>เบอร์โทรศัพท์</th>
                                                        <th>ตำแหน่ง</th>
                                                        <th>สถานะ</th>
                                                        <th>แก้ไข / ลบ</th>
                                                        {{-- <th>ลบ</th> --}}
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    {{-- @php $i = 1 @endphp --}}
                                                    @foreach ($users as $value)
                                                        <tr>
                                                            <td style="text-align: center;">
                                                                {{ sprintf('%05d', $value->emp_id) }}</td>
                                                            <td>{{ $value->username }}</td>
                                                            <td>{{ $value->emp_firstname }} {{ $value->emp_lastname }}
                                                            </td>
                                                            <td style="text-align: center;">{{ $value->emp_phonenumber }}
                                                            </td>
                                                            <td style="text-align: center;">{{ $value->position_name }}
                                                            </td>
                                                            <td style="text-align: center;">
                                                                @if ($value->emp_status == 0)
                                                                    <button class="btn btn-sm btn-success open_modal"
                                                                        type="button" data-toggle="modal"
                                                                        data-target="#exampleModal"
                                                                        data-emp_id="{{ $value->emp_id }}"
                                                                        data-emp_status="{{ $value->emp_status }}"
                                                                        data-emp_status_data="{{ $value->emp_status_data }}">
                                                                        ใช้งานปกติ
                                                                    </button>
                                                                @elseif($value->emp_status == 1)
                                                                    <button class="btn btn-sm btn-warning open_modal"
                                                                        type="button" data-toggle="modal"
                                                                        data-target="#exampleModal"
                                                                        data-emp_id="{{ $value->emp_id }}"
                                                                        data-emp_status="{{ $value->emp_status }}"
                                                                        data-emp_status_data="{{ $value->emp_status_data }}">
                                                                        ไม่ได้ใช้งาน
                                                                    </button>
                                                                @else
                                                                    <button class="btn btn-sm btn-danger open_modal"
                                                                        type="button" data-toggle="modal"
                                                                        data-target="#exampleModal"
                                                                        data-emp_id="{{ $value->emp_id }}"
                                                                        data-emp_status="{{ $value->emp_status }}"
                                                                        data-emp_status_data="{{ $value->emp_status_data }}">
                                                                        ลาออก
                                                                    </button>
                                                                @endif

                                                            </td>
                                                            <td style="text-align: center;">
                                                                <a href="{{ url('/user/edit_user/' . $value->emp_id) }}">
                                                                    <button class="btn btn-sm btn-primary">edit</button>
                                                                </a>
                                                                {{-- </td>
                                                    <td style="text-align: center;"> --}}
                                                                <a href="javascript:void(0);" class="delete"
                                                                    data-id="{{ $value->emp_id }}">
                                                                    <button class="btn btn-sm btn-danger">
                                                                        delete
                                                                    </button>
                                                                </a>

                                                            </td>
                                                        </tr>
                                                        {{-- @php $i++ @endphp --}}
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
                            <input type="hidden" id="emp_id" name="" value="">
                            <select name="" id="emp_status" class="form-control change_status">
                                <option value="0">ใช้งานปกติ</option>
                                <option value="1">ไม่ได้ใช้งาน</option>
                                <option value="2">ลาออก</option>
                            </select>
                        </div>
                        <div class="modal-body status_data" style="display: none">
                            <p style="color: red">*หมายเหตุ</p>
                            <input type="text" name="" id="emp_status_data" class="form-control status_data_i">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">ปิด</button>
                            <button type="submit" class="btn btn-sm btn-primary">บันทึก</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

    <script src="{{ url('/js/rocket-loader.min.js') }}" data-cf-settings="1dc21dc544476ddffbc54af6-|49" defer="">
    </script>

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
                    $('.status_data').hide()
                    $('.status_data_i').val(null)
                }
                if (id == 2) {
                    $('.status_data').show()
                }
            });

            $('body').on('click', '.open_modal', function() {
                var emp_id = $(this).data('emp_id');
                var emp_status = $(this).data('emp_status');
                var emp_status_data = $(this).data('emp_status_data');
                console.log(emp_status);
                if(emp_status == 2){
                    $('.status_data').show()
                }else{
                    $('.status_data').hide()
                }
                $('#emp_id').val(emp_id)
                $('#emp_status').val(emp_status)
                $('#emp_status_data').val(emp_status_data)
            });

            $('body').on('submit', '.save_status', function(e) {
                e.preventDefault();
                var emp_id = $('#emp_id').val();
                var emp_status = $('#emp_status').val();
                var emp_status_data = $('#emp_status_data').val();
                var fd = new FormData();

                fd.append('_token', "{{ csrf_token() }}");
                fd.append('emp_id', emp_id);
                fd.append('emp_status', emp_status);
                fd.append('emp_status_data', emp_status_data);

                $.ajax({
                    method: "POST",
                    url: "/user/status",
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
                            url: "/drinking/public/user/destroy/" + id,
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
            });
        });
    </script>
@endsection
