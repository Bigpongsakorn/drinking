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
                        <div class="row add-blog">
                            <div class="col-sm-12">

                                <div class="card">
                                    <div class="card-header">
                                        <h5>แก้ไขข้อมูลการเบิกวัตถุดิบ</h5>
                                    </div>
                                    <div class="card-block">
                                        <div class="form-group row">
                                            <div class="col-sm-1"></div>
                                            <div class="col-sm-10">
                                                <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <label class="col-form-label">รายการเบิกวัตถุดิบ</label>
                                                        <input type="text" class="form-control withdraw_m_name" name="name"
                                                            id="name" value="{{ $mate1->withdraw_m_name }}">
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label class="col-form-label">วันที่</label>
                                                        <input type="date" class="form-control withdraw_m_date" name="date"
                                                            id="date" value="{{ $mate1->withdraw_m_date }}">
                                                    </div>
                                                    <input type="hidden" name="emp_id" id="emp_id" class="emp_id"
                                                        value="{{ $mate1->emp_id }}">
                                                    <input type="hidden" name="withdraw_m_id" id="withdraw_m_id" class="withdraw_m_id"
                                                        value="{{ $mate1->withdraw_m_id }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @php $count_ = 0 @endphp
                            @foreach ($mate as $item)
                                <div class="col-sm-12 col-delete" id="addrow" data-count="{{ ++$count_ }}">
                                    <div class="card count">
                                        <div class="card-block">
                                            <div class="form-group row">
                                                <div class="col-sm-1"></div>
                                                <div class="col-sm-10">
                                                    <div class="form-group row">
                                                        <div class="col-sm-6">
                                                            <label class="col-form-label">ชื่อวัตถุดิบ</label>
                                                            <select name="select" class="form-control material_id"
                                                                name="product" id="product">
                                                                <option value="">ข้อมูลวัตถุดิบ</option>
                                                                @foreach ($mate2 as $value)
                                                                    <option value="{{ $value->material_id }}" @if ($value->material_id == $item->material_id) {{ 'selected' }} @endif>
                                                                        {{ $value->material_name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <label class="col-form-label">จำนวนวัตถุดิบ</label>
                                                            <input type="number" class="form-control withdraw_m_num"
                                                                name="number" id="number"
                                                                value="{{ $item->withdraw_m_d_num }}" min="1">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-sm-11"></div>
                                                        <div class="col-sm-1">
                                                            <button class="btn btn-sm btn-danger delete"
                                                                data-count="{{ $count_ }}">x</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="row">
                            <div class="col-sm-12" style="margin-bottom: 2%">
                                <button id="btnrow" class="btn btn-sm btn-primary">Add +</button>
                            </div>
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-block">
                                        <div class="form-group row">
                                            <div class="col-sm-1"></div>
                                            <div class="col-sm-10">
                                                <div class="form-group row">
                                                    <div style="margin: auto">
                                                        <button type="submit" class="btn btn-sm btn-success"
                                                            id="create-user">แก้ไขเบิกวัตถุดิบ</button>
                                                        <a href="{{ url('/withdraw/withdraw_material') }}">
                                                            <button class="btn btn-sm btn-secondary btn-form" type="reset">
                                                                กลับไปหน้าก่อนหน้า
                                                            </button>
                                                        </a>
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
            </div>

            {{-- <div id="styleSelector">
        </div> --}}
        </div>
    </div>
@endsection

@section('js')

    <script>
        $(document).ready(function() {

            $('body').on('click', '.delete', function() {
                var id = $(this).data('count');
                console.log(id);
                $('.col-delete[data-count=' + id + ']').remove()
            })

            $("#btnrow").click(function() {
                var count = 0;
                var count_ = $('.col-delete');
                $.each(count_, function(index, value) {
                    count++
                });
                $(".add-blog").append('<div class="col-sm-12 col-delete" id="addrow" data-count="' + (++ count) + '">\
                                                            <div class="card count">\
                                                                        <div class="card-block">\
                                                                            <div class="form-group row">\
                                                                                <div class="col-sm-1"></div>\
                                                                                <div class="col-sm-10">\
                                                                                    <div class="form-group row">\
                                                                                        <div class="col-sm-6">\
                                                                                            <label class="col-form-label">ชื่อวัตถุดิบ</label>\
                                                                                            <select name="select" class="form-control material_id"\
                                                                                                name="product" id="product">\
                                                                                                <option value="">ข้อมูลวัตถุดิบ</option>\
                                                                                                @foreach ($mate2 as $value)\
                                                                                                    <option value="{{ $value->material_id }}">\
                                                                                                        {{ $value->material_name }}\
                                                                                                    </option>\
                                                                                                @endforeach\
                                                                                            </select>\
                                                                                        </div>\
                                                                                        <div class="col-sm-6">\
                                                                                            <label class="col-form-label">จำนวนวัตถุดิบ</label>\
                                                                                            <input type="number" class="form-control withdraw_m_num"\
                                                                                                name="number" id="number" placeholder="จำนวนวัตถุดิบ"\
                                                                                                min="1">\
                                                                                        </div>\
                                                                                    </div>\
                                                                                    <div class="form-group row">\
                                                                                    <div class="col-sm-11"></div>\
                                                                                    <div class="col-sm-1">\
                                                                                    <button class="btn btn-sm btn-danger delete" data-count="' + (count) + '">x</button>\
                                                                                    </div>\
                                                                                    </div>\
                                                                                </div>\
                                                                            </div>\
                                                                        </div>\
                                                                    </div>\
                                                                </div>');
            });

            $('body').on('click', '#create-user', function() {
                // console.log('submit');
                // var id = $('#id').val();
                // var product = $('#product').val();
                // var number = $('#number').val();
                // var date = $('#date').val();
                var count = 0;
                var count_ = $('.count')
                var emp_id = [];
                var emp_id_ = $('.emp_id')
                var withdraw_m_name = [];
                var withdraw_m_name_ = $('.withdraw_m_name')
                var withdraw_m_date = [];
                var withdraw_m_date_ = $('.withdraw_m_date')
                var material_id = [];
                var material_id_ = $('.material_id')
                var withdraw_m_num = [];
                var withdraw_m_num_ = $('.withdraw_m_num')
                var withdraw_m_id = [];
                var withdraw_m_id_ = $('.withdraw_m_id')

                $.each(count_, function(index, value) {
                    count++
                });
                $.each(emp_id_, function(index, value) {
                    var v = $(this).val()
                    emp_id.push(v)
                });
                $.each(withdraw_m_id_, function(index, value) {
                    var v = $(this).val()
                    withdraw_m_id.push(v)
                });
                $.each(withdraw_m_name_, function(index, value) {
                    var v = $(this).val()
                    withdraw_m_name.push(v)
                });
                $.each(material_id_, function(index, value) {
                    var v = $(this).val()
                    material_id.push(v)
                });
                $.each(withdraw_m_date_, function(index, value) {
                    var v = $(this).val()
                    withdraw_m_date.push(v)
                });
                $.each(withdraw_m_num_, function(index, value) {
                    var v = $(this).val()
                    withdraw_m_num.push(v)
                });
                var fd = new FormData();

                if (withdraw_m_name && withdraw_m_date) {
                    fd.append('_token', "{{ csrf_token() }}");
                    fd.append('count', count);
                    fd.append('material_id', material_id);
                    fd.append('withdraw_m_name', withdraw_m_name);
                    fd.append('withdraw_m_date', withdraw_m_date);
                    fd.append('withdraw_m_num', withdraw_m_num);
                    fd.append('emp_id', emp_id);
                    fd.append('withdraw_m_id', withdraw_m_id);

                    $.ajax({
                        method: "POST",
                        url: "/drinking/public/withdraw_e/update",
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
                                location.href = '/drinking/public/withdraw/withdraw_material'
                            })
                        }
                        if (rec.status == '3') {
                            swal({
                                title: 'กรุณากรอกข้อมูลให้ครบถ้วน!',
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
