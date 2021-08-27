@extends('layouts.admin.main')
@section('content')
<div class="pcoded-content">

    <div class="page-header card">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class=" fa fa-shopping-basket bg-c-blue"></i>
                    <div class="d-inline">
                        <h5>จัดการข้อมูลสินค้า</h5>
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
                                    <h5>ข้อมูลสินค้า</h5>
                                </div>
                                <div style="margin:auto">
                                    <a href="{{ url('/PDF/product_pdf') }}">
                                        <button class="btn btn-sm btn-dark btn_print">
                                            พิมพ์
                                        </button>
                                    </a>
                                    {{-- <a href="javascript: window.open(); window.print(); window.close(); ">​​​​​​​​​​​​​​​​​print pdf</a> --}}
                                </div>
                                <div class="card-block">
                                    <div class="table-responsive dt-responsive">
                                        <table id="multi-colum-dt" class="table table-striped table-bordered nowrap">
                                            <thead>
                                                <tr style="text-align: center;">
                                                    <th>รหัสสินค้า</th>
                                                    <th style="width: 20%">รูปภาพสินค้า</th>
                                                    <th>ชื่อสินค้า</th>
                                                    <th>ประเภท</th>
                                                    <th>ปริมาณ</th>
                                                    <th>ราคา</th>
                                                    <th>จำนวน</th>
                                                    <th>หน่วย</th>
                                                    <th>แก้ไข / ลบ</th>
                                                    {{-- <th>ลบ</th> --}}
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $i = 1 @endphp
                                                @foreach ($product as $value)
                                                <tr>
                                                    <td style="text-align: center;">{{ sprintf('%05d', $value->product_id) }}</td>
                                                    <td style="text-align: center">
                                                        <img src="{{url('/upload/store/'.$value->product_img)}}" alt="" width="50%" class="open_modal"
                                                        data-toggle="modal" data-target=".bd-example-modal-xl" data-product_img="{{ $value->product_img }}">
                                                    </td>
                                                    <td>
                                                        {{$value->product_name}}
                                                    </td>
                                                    <td>{{$value->product_t_name}}</td>
                                                    <td>{{$value->unit_name}}</td>
                                                    <td style="text-align: right;">{{$value->product_price}}</td>
                                                    <td style="text-align: right;">{{$value->product_total}}</td>
                                                    <td>{{$value->punit}}</td>
                                                    <td style="text-align: center;">
                                                        <a href="{{url('/product/edit/'.$value->product_id)}}">
                                                            <button class="btn btn-sm btn-primary">edit</button>
                                                        </a>
                                                    {{-- </td>
                                                    <td style="text-align: center;"> --}}
                                                        <a href="javascript:void(0);" class="delete"
                                                            data-id="{{$value->product_id}}">
                                                            <button class="btn btn-sm btn-danger">
                                                                delete
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

<!-- Extra large modal -->
<div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <span id="product_img_show" style="margin: auto;"></span>
      </div>
    </div>
  </div>

@endsection

@section('js')
<script>
    $(document).ready(function () {

        $('body').on('click', '.open_modal', function() {
                var product_img = $(this).data('product_img');
                console.log(product_img);
                var html = '';
                html += `<img src="{{ asset('/upload/store/`+product_img+`') }}">`;
                $('#product_img_show').html('').append(html);
            });

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
                        url: "/product/destroy/" + id,
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
