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
                                    <h5>แก้ไขข่าวประชาสัมพันธ์</h5>
                                </div>
                                <div class="card-block">
                                    {{-- <form> --}}
                                    <div class="form-group row">
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-11">
                                            <div class="form-group row">
                                                <img src="{{url('/upload/news/'.$news->new_image)}}" alt=""
                                                    style="margin: auto;" width="25%">
                                            </div>
                                            <div class="form-group row">
                                                
                                                <div class="col-sm-11">
                                                    <label class="col-form-label">Upload File</label>
                                                    <input type="file" class="form-control" name="input_file"
                                                        id="input_file">
                                                </div>
                                            </div>
                                            <input type="hidden" id="id" name="id" value="{{$news->new_id}}">
                                            <div class="form-group row">
                                                <div class="col-sm-11">
                                                    <label class="col-form-label">หัวข้อ</label>
                                                    <input type="text" class="form-control" name="toppic" id="toppic"
                                                        value="{{$news->new_toppic}}">
                                                </div>
                                            </div>
                                            {{-- <div class="form-group row">
                                                <div class="col-sm-11">
                                                    <label class="col-form-label">วันที่</label>
                                                    <input type="date" class="form-control" name="date" id="date"
                                                        value="{{$news->new_date}}">
                                                </div>
                                            </div> --}}
                                            <div class="form-group row">
                                                <div class="col-sm-11">
                                                    <label class="col-form-label">รายละเอียด</label>
                                                    <textarea rows="5" cols="5" class="form-control" name="detail"
                                                        id="detail">{{$news->new_detail}}</textarea>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div style="margin: auto">
                                                    <button type="submit" class="btn btn-sm btn-success"
                                                        id="create-user">แก้ไขข้อมูล</button>
                                                    <a href="{{url('/dashboard/list_news')}}">
                                                        <button class="btn btn-sm btn-secondary btn-form" type="reset">
                                                            กลับไปหน้าก่อนหน้า
                                                        </button>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- </form> --}}
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>

        {{-- <div id="styleSelector">
        </div> --}}
    </div>
</div>
@endsection

@section('js')

<script>
    $(document).ready(function () {

        $('body').on('click', '#create-user', function () {
            // console.log('submit');
            var id = $('#id').val();
            var toppic = $('#toppic').val();
            // var date = $('#date').val();
            var detail = $('#detail').val();
            var input_file = $('#input_file').prop('files');
            var fd = new FormData();

            if (toppic && detail) {
                fd.append('_token', "{{ csrf_token() }}");
                fd.append('id', id);
                fd.append('toppic', toppic);
                // fd.append('date', date);
                fd.append('detail', detail);

                jQuery.each(jQuery('#input_file')[0].files, function (i, file) {
                    fd.append('input_file', file);
                });

                $.ajax({
                    method: "POST",
                    url: "/new/update",
                    dataType: 'json',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: fd,

                }).done(function (rec) {

                    if (rec.status == '1') {
                        swal({
                            title: 'บันทึกสำเร็จ!',
                            text: "กดปุ่ม ok เพื่อดำเนินการต่อ!",
                            type: 'success',
                            padding: '2em'
                        }).then(function (then) {
                            // location.reload()
                            location.href = '/dashboard/list_news'
                        })
                    } else {
                        swal({
                            title: 'บันทึกไม่สำเร็จ!',
                            text: "กดปุ่ม ok เพื่อดำเนินการต่อ!",
                            type: 'error',
                            padding: '2em'
                        })
                    }
                }).fail(function () {
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

        });

    });

</script>

@endsection
