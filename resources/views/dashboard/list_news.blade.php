@extends('layouts.admin.main')
@section('content')
<div class="pcoded-content">

    <div class="page-header card">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="feather icon-clipboard bg-c-blue"></i>
                    <div class="d-inline">
                        <h5>จัดการข้อมูลข่าวประชาสัมพันธ์</h5>
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
                                    <h5>ข้อมูลข่าวประชาสัมพันธ์</h5>
                                </div>
                                <div class="card-block">
                                    <div class="table-responsive dt-responsive">
                                       <table id="multi-colum-dt" class="table table-striped table-bordered nowrap">
                                            <thead>
                                                <tr style="text-align: center;">
                                                    <th>ลำดับ</th>
                                                    <th>หัวข้อข่าว</th>
                                                    <th>วันที่</th>
                                                    <th>ชื่อผู้เพิ่ม</th>
                                                    <th>แก้ไข / ลบ</th>
                                                    {{-- <th>ลบ</th> --}}
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $i = 1 @endphp
                                                @foreach ($news as $value)
                                                <tr>
                                                    <td style="text-align: center;">{{$i}}</td>
                                                    <td>
                                                         @if (strlen($value->new_toppic)>50)
                                                         <p>{!!mb_substr($value->new_toppic,0,50,'UTF-8')."..."!!}</p>
                                                         @else
                                                         <p>{!!$value->new_toppic!!}</p>
                                                         @endif
                                                    </td>
                                                    <td style="text-align: center;">
                                                        {{date('d-m-Y',strtotime($value->new_date))}}
                                                    </td>
                                                    <td style="text-align: center;">

                                                    </td>
                                                    <td style="text-align: center;">
                                                        <a href="{{url('/dashboard/edit_news/'.$value->new_id)}}">
                                                            <button class="btn btn-sm btn-primary">
                                                                แก้ไข
                                                            </button>
                                                        </a>
                                                    {{-- </td>
                                                    <td style="text-align: center;"> --}}
                                                        <a href="javascript:void(0);" class="delete"
                                                            data-id="{{$value->new_id}}">
                                                            <button class="btn btn-sm btn-danger">
                                                                ลบ
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
                        url: "/new/destroy/" + id,
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
