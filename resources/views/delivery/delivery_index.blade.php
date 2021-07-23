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
                                    <div class="card-block">
                                        <div class="table-responsive dt-responsive table-p">
                                            <table id="multi-colum-dt" class="table table-striped table-bordered nowrap">
                                                <thead>
                                                    <tr style="text-align: center;">
                                                        <th><input type="checkbox" name="" id=""></th>
                                                        <th>ลำดับ</th>
                                                        <th>ชื่อ</th>
                                                        <th>วันที่ต้องส่ง</th>
                                                        <th>เบอร์โทร</th>
                                                        {{-- <th>ที่อยู่</th> --}}
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php $i = 1 @endphp
                                                    @foreach ($customer as $value)
                                                        <tr>
                                                            <td style="text-align: center;">
                                                                <input type="checkbox" name="ck_box" id="ck_box"
                                                                    class="check-box" data-id="{{ $value->cus_id }}"
                                                                    data-date="{{ $value->cus_date }}">
                                                            </td>
                                                            <td style="text-align: center;">{{ $i }}</td>
                                                            <td style="text-align: center;">
                                                                {{ $value->cus_fristname }} {{ $value->cus_lastname }}
                                                            </td>
                                                            <td style="text-align: center;">
                                                                {{ $value->cus_date }}
                                                            </td>
                                                            <td style="text-align: center;">
                                                                {{ $value->cus_phonenumber }}
                                                            </td>
                                                            {{-- <td>
                                                                {{ $value->cus_address }}
                                                            </td> --}}
                                                        </tr>
                                                        @php $i++ @endphp
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            <button class="btn btn-success" id="submit">Submit</button>
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
            $('body').on('click', '#submit', function() {
                var checkbox = $('.check-box')
                // var id = [];
                // var id_ = $('id')
                // var date = [];
                // var date_ = $('date')

                $.each(checkbox, function(index, value) {
                    if ($(this).is(':checked')) {

                        var id = $(this).data('id')
                        var date = $(this).data('date')
                        console.log('checkkkkk', id, '=>', date)
                        var fd = new FormData();

                        if (id && date) {

                        fd.append('_token', "{{ csrf_token() }}");
                        fd.append('id', id);
                        fd.append('date', date);

                        $.ajax({
                            method: "POST",
                            url: "/delivery/store",
                            dataType: 'json',
                            cache: false,
                            contentType: false,
                            processData: false,
                            data: fd,

                        }).done(function(rec) {

                            if (rec.status == '1') {
                                swal({
                                    title: 'บันทึกสำเร็จ!',
                                    text: "กดปุ่ม ok เพื่อดำเนินการต่อ!",
                                    type: 'success',
                                    padding: '2em'
                                }).then(function(then) {
                                    // location.reload()
                                    location.href = '/customer/index'
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

                    } else {
                        swal({
                            title: 'กรุณากรอกข้อมูลให้ครบถ้วน!',
                            text: "กดปุ่ม ok เพื่อดำเนินการต่อ!",
                            type: 'error',
                            padding: '2em'
                        })
                    }
                    }
                });
            });
        });
    </script>

@endsection
