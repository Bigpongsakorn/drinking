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
                                                    <input type="hidden" id="id" name="id" class="production_id" value="{{ $pd1->production_id }}">
                                                    <input type="hidden" id="group" name="group" class="production_group" value="{{ $pd1->production_group }}">
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
                                                            <select name="select" class="form-control product_id select_p" name="product" data-count="{{ $item->production_id }}" data-product_id="product_id"
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
                                                            <input type="number" class="form-control production_number" name="number"
                                                                id="number" value="{{ $item->production_number }}" data-count="{{ $item->production_id }}">
                                                        </div>
                                                    </div>
                                                    <div class="displa_mat" data-count="{{ $item->production_id }}">
                                                        @php
                                                        $test = App\Models\Production::leftjoin('product_material','product_material.product_id','production_data.product_id')
                                                        ->leftjoin('material','material.material_id','product_material.material_id')
                                                        ->where('production_id', $item->production_id)
                                                        ->get();
                                                        @endphp
                                                        @foreach ($test as $item1)
                                                        <div class="form-group row">
                                                            <div class="col-sm-6">
                                                                <label class="col-form-label">ชื่อวัตถุดิบ</label>
                                                                <input type="text" name="" id="" value="{{ $item1->material_name }}" class="form-control" readonly>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <label class="col-form-label">จำนวนวัตถุดิบ</label>
                                                                <input type="text" name="" id="" value="{{ $item1->pm_quantity }}" class="form-control" readonly>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                    <div id="show_data" data-count="{{ $item->production_id }}"></div>
                                                    <div id="show_total" data-count="{{ $item->production_id }}"></div>
                                                    <button class="btn btn-sm btn-primary calculate" data-count="{{ $item->production_id }}" >คำนวณ</button>
                                                    {{-- <hr>
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
                                                        </div> --}}
                                                    
                                                    {{-- <div class="form-group row">
                                                        <button class="btn btn-sm btn-primary addcol"
                                                            data-count="{{ $count_ }}">+</button>
                                                    </div> --}}

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
                                                                    <select name="select" class="form-control product_id select_p" name="product" id="product" data-count="' + count + '">\
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
                                                                    <input type="number" class="form-control production_number" data-count="' + count + '" name="number" id="number"\
                                                                        placeholder="จำนวนสินค้า">\
                                                                </div>\
                                                            </div>\
                                                            <div id="show_data" data-count="' + count + '"></div>\
                                                            <div id="show_total" data-count="' + count + '"></div>\
                                                            <button class="btn btn-sm btn-primary calculate" data-count="' + count + '" style="display: none" >คำนวณ</button><hr>\
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

            // $("body").on('click', '.addcol', function() {
            //     var count_ = $(this).data('count');
            //     console.log(count_);
            //     $("#addcol[data-count='" + count_ + "']").append(' <div class="form-group row count2">\
            //                                                             <div class="col-sm-6">\
            //                                                                 <label class="col-form-label">ชื่อวัตถุดิบ</label>\
            //                                                                 <select name="select" class="form-control material_id" name="material_id"\
            //                                                                     id="material_id" data-material="' + count_ + '">\
            //                                                                     <option value="">ข้อมูลวัตถุดิบ</option>\
            //                                                                     @foreach ($mate as $value)\
            //                                                                         <option value="{{ $value->material_id }}">\
            //                                                                             {{ $value->material_name }}\
            //                                                                         </option>\
            //                                                                     @endforeach\
            //                                                                 </select>\
            //                                                             </div>\
            //                                                             <div class="col-sm-6">\
            //                                                                 <label class="col-form-label">จำนวนวัตถุดิบ</label>\
            //                                                                 <input type="number" class="form-control material_number" name="number" id="number" data-material="' + count_ + '"\
            //                                                                     placeholder="จำนวนวัตถุดิบ">\
            //                                                             </div>\
            //                                                         </div>');
            // });

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
                var production_id = [];
                var production_id_ = $('.production_id')
                var production_group = [];
                var production_group_ = $('.production_group')
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
                $.each(production_id_, function(index, value) {
                    var v = $(this).val()
                    production_id.push(v)
                });
                $.each(production_group_, function(index, value) {
                    var v = $(this).val()
                    production_group.push(v)
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
                    fd.append('production_group', production_group);
                    fd.append('production_id', production_id);
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
                                // location.reload()
                                location.href = '/production/production_index'
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

            $('body').on('change', '.select_p', function() {
                var count = $(this).data('count');
                var id =  $(this).val()
                console.log(count);
                console.log(id);
                $('.calculate').show()
                $('.displa_mat[data-count="'+count+'"]').hide()
                console.log(count);
                $.ajax({
                        method: "POST",
                        url: "/production/select_product",
                        data: {
                            "id": id,
                            "_token": $('meta[name="csrf-token"]').attr('content'),
                        }
                    }) .done(function(msg) {
                        var data = JSON.parse(msg);
                        material_p = data.material_p;
                        console.log(material_p)
                        var html = '';
                        $.each(material_p, function(index, value) {
                            // console.log(value.material_id)
                            html += `<div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <label class="col-form-label">ชื่อวัตถุดิบ</label>
                                                        <input type="text" name="" id="" value="`+value.material_name+`" class="form-control" readonly>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label class="col-form-label">จำนวนวัตถุดิบ</label>
                                                        <input type="text" name="" id="" value="`+value.pm_quantity+`" class="form-control" readonly>
                                                    </div>
                                                </div>
                                                <div>
                                                </div>`;
                            
                        });
                        $("#show_data[data-count='" + count + "']").html('').append(html)
                        // $("#calculate[data-count='" + count + "']").html('').append('<button class="btn btn-sm btn-primary calculate" >คำนวณ</button>')
                    });
            });
            
            $('body').on('click', '.calculate', function() {
                var count = $(this).data('count');
                var product_id = $('.product_id').val();
                // var material_number = $('.production_number').val();


                // material_id
                // console.log(product_id);
                // console.log(material_number);
                console.log('-----------------');
                var product_id = $('.product_id[data-count="'+count+'"]').val();
                console.log(product_id);
                var production_number = $('.production_number[data-count="'+count+'"]').val();
                console.log(production_number);
                console.log('-----------------');
                console.log(count);
                $('#show_data[data-count="'+count+'"]').hide()
                $('.displa_mat[data-count="'+count+'"]').hide()
                $.ajax({
                        method: "POST",
                        url: "/production/calculate",
                        data: {
                            "product_id": product_id,
                            "production_number" : production_number,
                            "_token": $('meta[name="csrf-token"]').attr('content'),
                        }
                    }).done(function(msg) {
                        var data = JSON.parse(msg);
                        // data = data.data;
                        console.log(data);

                        var html = '';
                        $.each(data, function(index, value) {
                            // html += `<p>`+value.text+` จำนวนในการผลิต `+value.total+` `+value.unit+`</p>`;
                            html += `<div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <label class="col-form-label">ชื่อวัตถุดิบ</label>
                                                        <input type="text" name="" id="" value="`+value.text+`" class="form-control" readonly>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label class="col-form-label">จำนวนวัตถุดิบ</label>
                                                        <input type="text" name="" id="" value="`+value.total+`" class="form-control" readonly>
                                                    </div>
                                                </div>`;
                        });
                        $("#show_total[data-count='" + count + "']").html('').append(html)
                    });
            });

        });
    </script>

@endsection
