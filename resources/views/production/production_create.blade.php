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
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>เพิ่มข้อมูลรายการผลิต</h5>
                                </div>
                                <div class="card-block">
                                    <div class="form-group row">
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-10">
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <label class="col-form-label">ข้อมูลรายการผลิต</label>
                                                    <input type="text" name="" id="" placeholder="ข้อมูลรายการผลิต" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="card">
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
                                                        <option value="{{$value->product_id}}">{{$value->product_name}}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label class="col-form-label">จำนวนสินค้า</label>
                                                    <input type="number" class="form-control" name="number" id="number"
                                                        placeholder="จำนวนสินค้า">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <label class="col-form-label">หน่วยสินค้า</label>
                                                    <input type="text" class="form-control" name="punit" id="punit"
                                                        placeholder="ชิ้น">
                                                </div>
                                                <div class="col-sm-6">
                                                    <label class="col-form-label">วันที่</label>
                                                    <input type="date" class="form-control" name="date" id="date">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">ประเภทสินค้า</label>
                                                <div class="col-sm-10">
                                                    <select name="select" class="form-control" name="type" id="type">
                                                        <option value="">ประเภทสินค้า</option>
                                                        @foreach ($type as $value)
                                                        <option value="{{$value->product_t_id}}">
                                                            {{$value->product_t_name}}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">ปริมาณหน่วยสินค้า</label>
                                                <div class="col-sm-10">
                                                    <select name="select" class="form-control" name="unit" id="unit">
                                                        <option value="">ปริมาณหน่วยสินค้า</option>
                                                        @foreach ($unit as $value)
                                                        <option value="{{$value->unit_id}}">{{$value->unit_name}}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div style="margin: auto">
                                                    <button type="submit" class="btn btn-sm btn-success"
                                                        id="create-user">เพิ่มข้อมูล</button>
                                                    <a href="{{url('/production/production_index')}}">
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
    $(document).ready(function () {

        $('body').on('click', '#create-user', function () {
            // console.log('submit');
            var product = $('#product').val();
            var number = $('#number').val();
            var unit = $('#unit').val();
            var type = $('#type').val();
            var date = $('#date').val();
            var punit = $('#punit').val();
            var fd = new FormData();

            if (product && number && date && type && unit && punit) {
                fd.append('_token', "{{ csrf_token() }}");
                fd.append('product', product);
                fd.append('number', number);
                fd.append('unit', unit);
                fd.append('type', type);
                fd.append('date', date);
                fd.append('punit', punit);

                $.ajax({
                    method: "POST",
                    url: "/drinking/public/production/store",
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
