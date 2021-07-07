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
                                                    <th>ชื่อจริง</th>
                                                    <th>นามสกุล</th>
                                                    <th>ตำแหน่ง</th>
                                                    <th>แก้ไข / ลบ</th>
                                                    {{-- <th>ลบ</th> --}}
                                                </tr>
                                            </thead>
                                            <tbody>
                                                {{-- @php $i = 1 @endphp --}}
                                                @foreach ($users as $value)
                                                <tr>
                                                    <td style="text-align: center;">{{$value->emp_id}}</td>
                                                    <td>{{$value->username}}</td>
                                                    <td>{{$value->emp_firstname}}</td>
                                                    <td>{{$value->emp_lastname}}</td>
                                                    <td>{{$value->position_name}}</td>
                                                    <td style="text-align: center;">
                                                        <a href="{{url('/user/edit_user/'.$value->emp_id)}}">
                                                            <button class="btn btn-sm btn-primary">edit</button>
                                                        </a>
                                                        {{-- </td>
                                                    <td style="text-align: center;"> --}}
                                                        <a href="javascript:void(0);" class="delete"
                                                            data-id="{{$value->emp_id}}">
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
</div>

<script src="{{url('/js/rocket-loader.min.js')}}" data-cf-settings="1dc21dc544476ddffbc54af6-|49" defer=""></script>

@endsection

@section('js')
<script>
    $(document).ready(function () {

        $('body').on('click', '.delete', function () {
            let id = $(this).data('id');

            swal({
                title: 'ยืนยันการลบข้อมูล?',
                text: "กดปุ่ม Delete เพื่อดำเนินการต่อ!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Delete',
                padding: '2em'
            }).then(function (result) {
                if (result.value) {

                    $.ajax({
                        method: "GET",
                        url: "/drinking/public/user/destroy/" + id,
                    }).done(function (rec) {
                        rec = JSON.parse(rec);
                        console.log(rec);
                        if (rec.status == '1') {
                            swal({
                                title: 'ลบข้อมูลสำเร็จ!',
                                text: "กดปุ่ม ok เพื่อดำเนินการต่อ!",
                                type: 'success',
                                padding: '2em'
                            }).then(function (then) {
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
                    }).fail(function () {
                        swal("Error!", "You clicked the button!", "error");
                    })

                }
            })
        })
    });

</script>
@endsection
