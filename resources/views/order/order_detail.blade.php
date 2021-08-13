@extends('layouts.admin.main')
@section('content')
    <div class="pcoded-content">

        <div class="page-header card">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="fa fa-shopping-bag bg-c-blue"></i>
                        <div class="d-inline">
                            <h5>จัดการข้อมูลสั่งซื้อสินค้า</h5>
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
                                        <h5>รายละเอียดข้อมูลสั่งซื้อสินค้า</h5>
                                    </div>
                                    <div style="margin:auto">
                                        <button class="btn btn-sm btn-dark">พิมพ์</button>
                                    </div>
                                    <div class="card-block">
                                        <div class="form-group row">
                                            {{-- <div class="col-sm-1"></div> --}}
                                            <div class="col-sm-12">
                                                <div class="form-group row">
                                                    <div class="col-sm-8">
                                                        <label for="">เลขที่ใบสั่งซื้อ : </label>
                                                        <label for="">{{ sprintf('%05d', $order->order_id) }}</label>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label for="">วันที่เริ่มสั่งซื้อ : </label>
                                                        <label
                                                            for="">{{ date('d-m-Y', strtotime($order->order_startdate)) }}</label>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-8">
                                                        <label for="">ชื่อลูกค้า : </label>
                                                        @if ($order_db->cus_id == 99)
                                                            <label for="">{{ $order->o_name }}</label>
                                                        @else
                                                            <label for="">{{ $order->cus_fristname }}
                                                                {{ $order->cus_lastname }}</label>
                                                        @endif
                                                    </div>
                                                    {{-- <div class="col-sm-4">
                                                        <label for="">วันที่สั่งซื้อเสร็จ : </label>
                                                        <label for="">{{ date('d-m-Y', strtotime($order->order_completeddate)) }}</label>
                                                    </div> --}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="table-responsive dt-responsive table-p">
                                            <table id="multi-colum-dt" class="table table-striped table-bordered nowrap">
                                                <thead>
                                                    <tr style="text-align: center;">
                                                        <th>ลำดับ</th>
                                                        <th>รูปสินค้า</th>
                                                        <th>สินค้า</th>
                                                        <th>จำนวน</th>
                                                        <th>หน่วย</th>
                                                        <th>ราคา</th>
                                                        <th>หน่วย</th>
                                                        <th>ราคารวม</th>
                                                        <th>หน่วย</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php $i = 1 @endphp
                                                    @foreach ($order_d as $value)
                                                        <tr>
                                                            <td style="text-align: center;">{{ $i }}</td>
                                                            <td style="text-align: center">
                                                                <img src="{{url('/upload/store/'.$value->product_img)}}" alt="" width="50%" class="open_modal"
                                                                data-toggle="modal" data-target=".bd-example-modal-xl" data-product_img="{{ $value->product_img }}">
                                                            </td>
                                                            <td>
                                                                {{ $value->product_name }}
                                                            </td>
                                                            <td style="text-align: right;">
                                                                {{ $value->orderdetail_quantity_total }}
                                                            </td>
                                                            <td>
                                                                {{ $value->punit }}
                                                            </td>
                                                            <td style="text-align: right;">
                                                                {{ $value->orderdetail_priceunit }}
                                                            </td>
                                                            <td>
                                                                บาท
                                                            </td>
                                                            <td style="text-align: right;">
                                                                {{ $value->orderdetail_quantity_total * $value->orderdetail_priceunit }}.00
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
                                                        <th colspan="6" style="text-align:right">รวม : </th>
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
                                        <hr>
                                        {{-- <div class="form-group row">
                                            <div class="col-sm-12">
                                                <h5>สถานะการจ่ายเงิน</h5>
                                            </div>
                                            <div class="col-sm-12">
                                                @if ($order_db->order_status == 1)
                                                    <label for="">จ่ายเงินสด</label>
                                                @elseif ($order_db->order_status == 2)
                                                    <label for="">จ่ายแบบโอน</label>
                                                @else
                                                    <label for="">ยังไม่ได้จ่ายเงิน</label>
                                                @endif
                                            </div>
                                            <div class="col-sm-12">
                                                @if ($order_db->order_bill != null)
                                                    <img src="{{ url('/upload/slip/'.$order_db->order_bill) }}" alt="" width="25%">
                                                @else

                                                @endif
                                            </div>
                                        </div> --}}
                                    </div>
                                    <div style="margin:auto">
                                        <a href="{{ url('/order/order_index') }}">
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