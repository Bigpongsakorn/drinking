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
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>รายละเอียดข้อมูลการเบิกวัตถุดิบ</h5>
                                    </div>
                                    <div style="margin:auto">
                                        <button class="btn btn-sm btn-dark">พิมพ์</button>
                                    </div>
                                    <div class="card-block">
                                        <h5>สถานะ : 
                                        @if ($wid->withdraw_p_status == 0)
                                        <span style="color: rgb(221, 208, 21)">รออนุมัติ</span>
                                        @elseif ($wid->withdraw_p_status == 1)
                                        <span style="color: red">ไม่อนุมัติ</span> : * หมายเหตุ {{ $wid->withdraw_p_status_detail }}
                                        @elseif ($wid->withdraw_p_status == 2)
                                        <span style="color: rgb(24, 126, 75)">อนุมัติ</span>
                                        @else
                                        <span style="color:green">ขนของขึ้นรถ</span> โดย {{ $wid->emp_firstname }} {{ $wid->emp_lastname }}
                                        @endif
                                        </h5><br>
                                        @if ($wid->withdraw_p_status == 3)
                                            <h5>วันที่อนุมัติ : {{ date('d-m-Y H:i:s',strtotime($wid->withdraw_p_status_time)) }}</h5>
                                        @else
                                            
                                        @endif
                                        <div class="table-responsive dt-responsive">
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
                                                    @foreach ($detail as $value)
                                                        <tr>
                                                            <td style="text-align: center;">{{ $i }}</td>
                                                            <td>
                                                                <img src="{{ url('/upload/store/' . $value->product_img) }}"
                                                                    alt="" width="100%">
                                                            </td>
                                                            <td>
                                                                {{ $value->product_name }}
                                                            </td>
                                                            <td style="text-align: right;">
                                                                {{ $value->withdraw_p_d_num }}
                                                            </td>
                                                            <td style="text-align: left;">
                                                                {{ $value->punit }}
                                                            </td>
                                                            <td style="text-align: right;">
                                                                {{ $value->product_price }}
                                                            </td>
                                                            <td>
                                                                บาท
                                                            </td>
                                                            <td style="text-align: right;">
                                                                {{ $value->product_price * $value->withdraw_p_d_num }}.00
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
                                    </div>
                                    <div style="margin:auto">
                                        <a href="{{ url('/withdraw/withdraw_product') }}">
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

@endsection
