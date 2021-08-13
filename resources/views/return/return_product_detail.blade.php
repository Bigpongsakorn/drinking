@extends('layouts.admin.main')
@section('content')
    <div class="pcoded-content">

        <div class="page-header card">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="fa fa-truck bg-c-blue"></i>
                        <div class="d-inline">
                            <h5>จัดการข้อมูลเก็บคืน</h5>
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
                                        <h5>ข้อมูลสินค้าเก็บคืน</h5>
                                    </div>
                                    <div class="card-block">
                                        {{-- <div class="form-group row">
                                            <div class="col-sm-2"></div>
                                            <div class="col-sm-10">
                                                <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <label class="col-form-label">รหัสลูกค้า : </label>
                                                        <label for="">
                                                            <input type="hidden" name="" id="id"
                                                                value="{{ $ship->ship_id }}">
                                                            <label
                                                                class="col-form-label">{{ sprintf('%05d', $ship->cus_id) }}</label>
                                                        </label>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label class="col-form-label">ชื่อจริง - นามสกุล : </label>
                                                        <label class="show-data">
                                                            @if ($ship->cus_title == 1)
                                                                นาย
                                                            @elseif($ship->cus_title == 2)
                                                                นาง
                                                            @else
                                                                นางสาว
                                                            @endif
                                                            {{ $ship->cus_fristname }} {{ $ship->cus_lastname }}
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <label class="col-form-label">เบอร์โทรศัพท์ : </label>
                                                        <label class="">{{ $ship->cus_phonenumber }}</label>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <label class=" col-form-label">บ้านเลขที่/หมู่บ้าน : </label>
                                                        <label class="">{{ $ship->cus_address }}</label>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <label class="col-form-label">จังหวัด : </label>
                                                        <label class="">{{ $ship->province_name }}</label>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label class="col-form-label">อำเภอ : </label>
                                                        <label class="">{{ $ship->district_name }}</label>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <label class="col-form-label">ตำบล : </label>
                                                        <label class="">{{ $ship->subdistrict_name }}</label>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label class="col-form-label">รหัสไปรษณีย์ : </label>
                                                        <label class="">{{ $ship->zip_code }}</label>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <label class="col-form-label">วันที่จัดส่ง : </label>
                                                        <label>{{ date('d-m-Y', strtotime($ship->ship_date)) }}</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> --}}
                                        <div class="table-responsive dt-responsive table-p">
                                            <table id="multi-colum-dt" class="table table-striped table-bordered nowrap">
                                                <thead>
                                                    <tr style="text-align: center;">
                                                        <th>ลำดับรายการ</th>
                                                        <th>รูปภาพ</th>
                                                        <th>ชื่อสินค้า</th>
                                                        <th>จำนวนทั้งหมด</th>
                                                        <th>หน่วย</th>
                                                        <th>ราคาต่อชิ้น</th>
                                                        <th>หน่วย</th>
                                                        <th>ราคารวม</th>
                                                        <th>หน่วย</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php $i = 1 ; $sum = 0 @endphp
                                                    @foreach ($ship_p as $value)
                                                        <tr>
                                                            <td style="text-align: center;">{{ $i }}</td>
                                                            <td style="text-align: center;">
                                                                <img src="{{url('/upload/store/'.$value->product_img)}}" alt="" width="50%" class="open_modal"
                                                                data-toggle="modal" data-target=".bd-example-modal-xl" data-product_img="{{ $value->product_img }}">
                                                            </td>
                                                            <td>
                                                                {{ $value->product_name }}
                                                            </td>
                                                            <td style="text-align: right;">
                                                                {{ $value->product_num }}
                                                            </td>
                                                            <td>
                                                                {{ $value->punit }}
                                                            </td>
                                                            <td style="text-align: right;">
                                                                {{ $value->product_price }}
                                                            </td>
                                                            <td>
                                                                บาท
                                                            </td>
                                                            <td style="text-align: right;">
                                                                {{ $value->product_num * $value->product_price }}.00
                                                            </td>
                                                            <td>
                                                                บาท
                                                            </td>
                                                        </tr>
                                                        @php $i++ ; $sum += $value->product_num * $value->product_price @endphp
                                                    @endforeach
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th colspan="7" style="text-align:right">รวม : </th>
                                                        <th style="text-align: right;">
                                                            {{ $sum }}.00
                                                        </th>
                                                        <th>บาท</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div style="margin:auto">
                                            <a href="{{ url('/return/return_detail/'.$ship->cus_id) }}">
                                                <button class="btn btn-sm btn-secondary" type="">
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
    });
</script>
@endsection