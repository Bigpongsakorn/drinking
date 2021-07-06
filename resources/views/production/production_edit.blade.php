@extends('layouts.admin.main')
@section('content')
    <div class="pcoded-content">

        <div class="page-header card">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class=" icon-layers bg-c-blue"></i>
                        <div class="d-inline">
                            <h5>จัดการข้อมูลการผลิต</h5>
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
                                        <h5>แก้ไขข้อมูลรายการผลิต</h5>
                                    </div>
                                    <div class="card-block">
                                        <div class="form-group row">
                                            <div class="col-sm-1"></div>
                                            <div class="col-sm-10">
                                                <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <label class="col-form-label">ข้อมูลรายการผลิต</label>
                                                        <input type="text" name="name" id="name"
                                                            value="{{ $pd1->production_name }}"
                                                            class="form-control production_name">
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label class="col-form-label">วันที่</label>
                                                        <input type="date" class="form-control production_date" name="date"
                                                            id="date" value="{{ $pd1->production_date }}">
                                                    </div>
                                                    <input type="hidden" id="id" name="id"
                                                        value="{{ $pd1->production_id }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @php $count_ = 0 @endphp
                            @foreach ($pd as $item)
                                <div class="col-sm-12 col-delete" id="addrow" data-count="{{ ++$count_ }}">
                                    <div class="card count">
                                        <div class="card-block">
                                            <div class="form-group row">
                                                <div class="col-sm-1"></div>
                                                <div class="col-sm-10">
                                                    <div class="form-group row">
                                                        <div class="col-sm-6">
                                                            <label class="col-form-label">ชื่อสินค้า</label>
                                                            <select name="select" class="form-control" name="product"
                                                                id="product">
                                                                <option value="">ข้อมูลสินค้า</option>
                                                                @foreach ($product as $value)
                                                                    <option value="{{ $value->product_id }}" @if ($value->product_id == $item->product_id) {{ 'selected' }} @endif>
                                                                        {{ $value->product_name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <label class="col-form-label">จำนวนสินค้า</label>
                                                            <input type="number" class="form-control" name="number"
                                                                id="number" value="{{ $item->production_number }}">
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    @php
                                                        $test = App\Models\Production_m::where('production_id', $item->production_id)->get();
                                                    @endphp
                                                   
                                                        <div id="addcol" data-count="{{ $count_ }}">
                                                            @foreach ($test as $value1)
                                                            <div class="form-group row count2">
                                                                <div class="col-sm-6">
                                                                    <label class="col-form-label">ชื่อวัตถุดิบ</label>
                                                                    <select name="select" class="form-control material_id"
                                                                        name="material_id" id="material_id" data-material="1">
                                                                        <option value="">ข้อมูลวัตถุดิบ</option>
                                                                        @foreach ($mate as $item)
                                                                            <option value="{{ $item->material_id }}" @if ($item->material_id == $value1->material_id) {{ 'selected' }} @endif>
                                                                                {{ $item->material_name }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <label class="col-form-label">จำนวนวัตถุดิบ</label>
                                                                    <input type="number"
                                                                        class="form-control material_number" name="number"
                                                                        id="number" data-material="1"
                                                                        value="{{ $value1->production_m_num }}">
                                                                </div>
                                                            </div>
                                                            @endforeach
                                                        </div>
                                                    
                                                    <div class="form-group row">
                                                        <button class="btn btn-sm btn-primary addcol"
                                                            data-count="{{ $count_ }}">+</button>
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
                                                            id="create-user">แก้ไขข้อมูล</button>
                                                        <a href="{{ url('/production/production_index') }}">
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
                count++
                $(".add-blog").append('<div class="col-sm-12 col-delete" id="addrow" data-count="' + count + '">\
                                            <div class="card count">\
                                                <div class="card-block">\
                                                    <div class="form-group row">\
                                                        <div class="col-sm-1"></div>\
                                                        <div class="col-sm-10">\
                                                            <div class="form-group row 1">\
                                                                <div class="col-sm-6">\
                                                                    <label class="col-form-label">ชื่อสินค้า</label>\
                                                                    <select name="select" class="form-control product_id" name="product"\
                                                                        id="product">\
                                                                        <option value="">ข้อมูลสินค้า</option>\
                                                                        @foreach ($product as $value)\
                                                                            <option value="{{ $value->product_id }}">\
                                                                                {{ $value->product_name }}\
                                                                            </option>\
                                                                        @endforeach\
                                                                    </select>\
                                                                </div>\
                                                                <div class="col-sm-6">\
                                                                    <label class="col-form-label">จำนวนสินค้า</label>\
                                                                    <input type="number" class="form-control production_number" name="number" id="number"\
                                                                        placeholder="จำนวนสินค้า">\
                                                                </div>\
                                                            </div>\
                                                            <hr>\
                                                            <div id="addcol" class="2" data-count="' + (count) + '">\
                                                                <div class="form-group row count2">\
                                                                    <div class="col-sm-6">\
                                                                        <label class="col-form-label">ชื่อวัตถุดิบ</label>\
                                                                        <select name="select" class="form-control material_id" name="material_id"\
                                                                            id="material_id" data-material="' + count + '">\
                                                                            <option value="">ข้อมูลวัตถุดิบ</option>\
                                                                            @foreach ($mate as $value)\
                                                                                <option value="{{ $value->material_id }}">\
                                                                                    {{ $value->material_name }}\
                                                                                </option>\
                                                                            @endforeach\
                                                                        </select>\
                                                                    </div>\
                                                                    <div class="col-sm-6">\
                                                                        <label class="col-form-label">จำนวนวัตถุดิบ</label>\
                                                                        <input type="number" class="form-control material_number" data-material="' + count + '" name="number" id="number"\
                                                                            placeholder="จำนวนวัตถุดิบ">\
                                                                    </div>\
                                                                </div>\
                                                            </div>\
                                                            <div class="form-group row">\
                                                                <button class="btn btn-sm btn-primary addcol" data-count="' + (count) + '">+</button>\
                                                            </div>\
                                                            <div class="form-group row">\
                                                        <div class="col-sm-11"></div>\
                                                        <div class="col-sm-1">\
                                                            <button class="btn btn-sm btn-danger delete"\
                                                                data-count="' + (count) + '">x</button>\
                                                        </div>\
                                                    </div>\
                                                        </div>\
                                                    </div>\
                                                </div>\
                                            </div>\
                                        </div>');
            });

            $("body").on('click', '.addcol', function() {
                var count_ = $(this).data('count');
                console.log(count_);
                $("#addcol[data-count='" + count_ + "']").append(' <div class="form-group row count2">\
                                                                        <div class="col-sm-6">\
                                                                            <label class="col-form-label">ชื่อวัตถุดิบ</label>\
                                                                            <select name="select" class="form-control material_id" name="material_id"\
                                                                                id="material_id" data-material="' + count_ + '">\
                                                                                <option value="">ข้อมูลวัตถุดิบ</option>\
                                                                                @foreach ($mate as $value)\
                                                                                    <option value="{{ $value->material_id }}">\
                                                                                        {{ $value->material_name }}\
                                                                                    </option>\
                                                                                @endforeach\
                                                                            </select>\
                                                                        </div>\
                                                                        <div class="col-sm-6">\
                                                                            <label class="col-form-label">จำนวนวัตถุดิบ</label>\
                                                                            <input type="number" class="form-control material_number" name="number" id="number" data-material="' + count_ + '"\
                                                                                placeholder="จำนวนวัตถุดิบ">\
                                                                        </div>\
                                                                    </div>');
            });

            $('body').on('click', '#create-user', function() {
                // console.log('submit');
                var count = 0;
                var count_ = $('.count')
                var production_name = [];
                var production_name_ = $('.production_name')
                var production_date = [];
                var production_date_ = $('.production_date')
                var product_id = [];
                var product_id_ = $('.product_id')
                var production_number = [];
                var production_number_ = $('.production_number')
                var material_id = [];
                var material_id_ = $('.material_id')
                var material_number = [];
                var material_number_ = $('.material_number')
                var fd = new FormData();

                $.each(count_, function(index, value) {
                    count++
                });
                $.each(production_name_, function(index, value) {
                    var v = $(this).val()
                    production_name.push(v)
                });
                $.each(production_date_, function(index, value) {
                    var v = $(this).val()
                    production_date.push(v)
                });
                $.each(product_id_, function(index, value) {
                    var v = $(this).val()
                    product_id.push(v)
                });
                $.each(production_number_, function(index, value) {
                    var v = $(this).val()
                    production_number.push(v)
                });

                $.each(material_id_, function(index, value) {
                    // var v = $(this).val()
                    // material_id.push(v)

                    var v = $(this).val()
                    var material = $(this).data('material')
                    material_id.push([material,v])

                });
                $.each(material_number_, function(index, value) {
                    // var v = $(this).val()
                    // material_number.push(v)

                    var v = $(this).val()
                    var material = $(this).data('material')
                    material_number.push([material,v])
                });

                if (production_name != "" && production_date != "") {
                    fd.append('_token', "{{ csrf_token() }}");
                    fd.append('count', count);
                    fd.append('production_name', production_name);
                    fd.append('production_date', production_date);
                    fd.append('product_id', product_id);
                    fd.append('production_number', production_number);
                    // fd.append('material_id', material_id);
                    // fd.append('material_number', material_number);
                    fd.append('material_id', JSON.stringify(material_id));
                    fd.append('material_number',JSON.stringify(material_number));

                    $.ajax({
                        method: "POST",
                        url: "/production/update",
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
