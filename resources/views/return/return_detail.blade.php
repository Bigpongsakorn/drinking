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
                                        <h5>ข้อมูลการเก็บคืน</h5>
                                    </div>
                                    <div class="card-block">
                                        <div class="form-group row">
                                            <div class="col-sm-2"></div>
                                            <div class="col-sm-10">
                                                <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <label class="col-form-label">รหัสลูกค้า : </label>
                                                        <label for="">
                                                            <label class="col-form-label">{{ sprintf('%05d', $customer->cus_id) }}</label>
                                                        </label>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label class="col-form-label">ชื่อจริง - นามสกุล : </label>
                                                        <label>
                                                            @if ($customer->cus_title == 1)
                                                                นาย
                                                            @elseif($customer->cus_title == 2)
                                                                นาง
                                                            @else
                                                                นางสาว
                                                            @endif
                                                            {{ $customer->cus_fristname }} {{ $customer->cus_lastname }}
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <label class="col-form-label">เบอร์โทรศัพท์ : </label>
                                                        <label id="cus_phonenumber">{{ $customer->cus_phonenumber }}</label>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <label class=" col-form-label">บ้านเลขที่/หมู่บ้าน : </label>
                                                        <label id="cus_address">{{ $customer->cus_address }}</label>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <label class="col-form-label">จังหวัด : </label>
                                                        <label id="province_name">{{ $customer->province_name }}</label>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label class="col-form-label">อำเภอ : </label>
                                                        <label id="district_name">{{ $customer->district_name }}</label>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <label class="col-form-label">ตำบล : </label>
                                                        <label id="subdistrict_name">{{ $customer->subdistrict_name }}</label>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label class="col-form-label">รหัสไปรษณีย์ : </label>
                                                        <label id="cus_zipcode">{{ $customer->zip_code }}</label>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <label class="col-form-label">วันที่เก็บสินค้า</label>
                                                        <label id="">{{ date('d-m-Y', strtotime($customer->re_date)) }}</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="table-responsive dt-responsive table-p">
                                            <table id="multi-colum-dt" class="table table-striped table-bordered nowrap">
                                                <thead>
                                                    <tr style="text-align: center;">
                                                        <th>ลำดับรายการ</th>
                                                        <th>รูปภาพ</th>
                                                        <th>ชื่อสินค้า</th>
                                                        <th>จำนวนทั้งหมด</th>
                                                        <th>หน่วย</th>
                                                        {{-- <th>ราคาต่อชิ้น</th>
                                                        <th>หน่วย</th>
                                                        <th>ราคารวม</th>
                                                        <th>หน่วย</th> --}}
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php $i = 1 ; $sum = 0 @endphp
                                                    @foreach ($returnd as $value)
                                                        <tr>
                                                            <td style="text-align: center;">{{ $i }}</td>
                                                            <td style="text-align: center;">
                                                                <img src="{{url('/upload/material/'.$value->material_img)}}" alt="" width="50px" class="open_modal"
                                                                data-toggle="modal" data-target=".bd-example-modal-xl" data-product_img="{{ $value->material_img }}">
                                                            </td>
                                                            <td>
                                                                {{ $value->material_name }}
                                                            </td>
                                                            <td style="text-align: right;">
                                                                {{ $value->material_num }}
                                                            </td>
                                                            <td>
                                                                {{ $value->material_unit }}
                                                            </td>
                                                            {{-- <td style="text-align: right;">
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
                                                            </td> --}}
                                                        </tr>
                                                        @php $i++ ; $sum += $value->product_num * $value->product_price @endphp
                                                    @endforeach
                                                </tbody>
                                                {{-- <tfoot>
                                                    <tr>
                                                        <th colspan="7" style="text-align:right">รวม : </th>
                                                        <th style="text-align: right;">
                                                            {{ $sum }}.00
                                                        </th>
                                                        <th>บาท</th>
                                                    </tr>
                                                </tfoot> --}}
                                            </table>
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
                                                    <div style="margin: auto">
                                                        <a href="{{ url('/return/return_index') }}">
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

        </div>
    </div>

@endsection

@section('js')
    <script>
        $(document).ready(function() {
            
        });
    </script>
@endsection
