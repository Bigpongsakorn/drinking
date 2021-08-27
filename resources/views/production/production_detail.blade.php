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
                                        <h5>รายละเอียดข้อมูลรายการผลิต</h5>
                                    </div>
                                    <div style="margin:auto">
                                        <a href="{{ url('PDF/production_pdf/'.$p_id->production_group) }}">
                                            <button class="btn btn-sm btn-dark">พิมพ์</button>
                                        </a>
                                    </div>
                                    <div class="card-block">
                                        <button class="btn btn-sm btn-primary btn-p">สินค้า</button>
                                        <button class="btn btn-sm btn-success btn-m">วัตถุดิบ</button>
                                        <div class="table-responsive dt-responsive table-p">
                                            <table id="multi-colum-dt" class="table table-striped table-bordered nowrap">
                                                <thead>
                                                    <tr style="text-align: center;">
                                                        <th>ลำดับ</th>
                                                        <th style="width: 20%">รูปภาพสินค้า</th>
                                                        <th>ชื่อสินค้า</th>
                                                        <th>จำนวน</th>
                                                        <th>หน่วย</th>
                                                        <th>ราคาต่อชิ้น</th>
                                                        <th>หน่วย</th>
                                                        <th>รวม</th>
                                                        <th>หน่วย</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php $i = 1 @endphp
                                                    @foreach ($pro as $value)
                                                        <tr>
                                                            <td style="text-align: center;">{{ $i }}</td>
                                                            <td>
                                                                <img src="{{url('/upload/store/'.$value->product_img)}}" alt="" width="100%">
                                                            </td>
                                                            <td>
                                                                {{ $value->product_name }}
                                                            </td>
                                                            <td style="text-align: right;">
                                                                {{ $value->production_number }}
                                                            </td>
                                                            <td style="text-align: left;">
                                                                {{ $value->punit }}
                                                            </td>
                                                            <td style="text-align: right;">
                                                                {{ $value->product_price }}
                                                            </td>
                                                            <td style="text-align: left;">
                                                                บาท
                                                            </td>
                                                            <td style="text-align: right;">
                                                                {{ $value->product_price * $value->production_number }}.00
                                                            </td>
                                                            <td>
                                                                บาท
                                                            </td>
                                                        </tr>
                                                        @php $i++ @endphp
                                                    @endforeach
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th colspan="7" style="text-align:right">รวม : </th>
                                                        @php
                                                            $total = 0;
                                                        @endphp
                                                        <th style="text-align: right;">
                                                            @foreach ($sum as $key)
                                                            @php $total = $total + $key->sum @endphp
                                                            @endforeach
                                                            {{ $total }}.00
                                                        </th>
                                                        <th>บาท</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                        <div class="table-responsive dt-responsive table-m">
                                            <table id="alt-pg-dt" class="table table-striped table-bordered nowrap">
                                                <thead>
                                                    <tr style="text-align: center;">
                                                        <th>ลำดับ</th>
                                                        <th style="width: 20%">รูปภาพสินค้า</th>
                                                        <th>ชื่อวัตถุดิบ</th>
                                                        <th>จำนวน</th>
                                                        <th>หน่วย</th>
                                                        <th>ราคาต่อชิ้น</th>
                                                        <th>หน่วย</th>
                                                        <th>รวม</th>
                                                        <th>หน่วย</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php $i = 1; $sum = 0 @endphp
                                                    @foreach ($mat as $value)
                                                        <tr>
                                                            <td style="text-align: center;">{{ $i }}</td>
                                                            <td>
                                                                <img src="{{url('/upload/material/'.$value->material_img)}}" alt="" width="100%">
                                                            </td>
                                                            <td>
                                                                {{ $value->material_name }}
                                                            </td>
                                                            <td style="text-align: right;">
                                                                {{ $total = $value->production_number * $value->pm_quantity }}
                                                            </td>
                                                            <td style="text-align: left;">
                                                                {{ $value->material_unit }}
                                                            </td>
                                                            <td style="text-align: right;">
                                                                {{ $value->material_price }}
                                                            </td>
                                                            <td style="text-align: left;">
                                                                บาท
                                                            </td>
                                                            <td style="text-align: right;">
                                                                {{ $value->material_price * $total }}.00
                                                            </td>
                                                            <td>
                                                                บาท
                                                            </td>
                                                        </tr>
                                                        @php $i++; $sum += $value->material_price * $total @endphp
                                                    @endforeach
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th colspan="7" style="text-align:right">รวม : </th>
                                                        @php
                                                            // $total = 0;
                                                        @endphp
                                                        <th style="text-align: right;">
                                                            {{-- @foreach ($sumT as $key)
                                                            @php $total = $total + $key->sumt @endphp
                                                            @endforeach --}}
                                                            {{ $sum }}.00
                                                        </th>
                                                        <th>บาท</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                    <div style="margin:auto">
                                        <a href="{{ url('/production/production_index') }}">
                                            <button class="btn btn-sm btn-secondary btn-form" type="reset">
                                                กลับไปหน้าก่อนหน้า
                                            </button>
                                        </a>
                                    </div><br>
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
            $('.table-m').hide()
            $('.btn-p').click(function() {
                $('.table-p').show()
                $('.table-m').hide()
            });
            $('.btn-m').click(function() {
                $('.table-m').show()
                $('.table-p').hide()
            });
        });
    </script>

@endsection
