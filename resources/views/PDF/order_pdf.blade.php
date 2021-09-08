<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ url('css/style.css') }}">
    <link rel="stylesheet" href="{{ url('css/style2.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('/css/bootstrap.min.css') }}">
</head>

<body class="body-sty body-font">
    <div class="rowv2">
        <div class="card">
            <div class="pcoded-inner-content">
                <div id="printable">
                    <div class="form-group row">
                        <div class="col-sm-3">
                            <img src="{{url('/upload/logo_test.png')}}" alt="" width="70%">
                        </div>
                        <div class="col-sm-5">
                            <br>
                            <h3>อันดาน้ำดื่ม</h3>
                            <p>เลขที่ 30 ตำบลนาแก้ว อำเภอเกาะคา จังหวัดลำปาง 52130</p>
                        </div>
                        <div class="col-sm-4">
                            <br>
                            <h2>ใบสั่งซื้อสินค้า</h2>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-8">
                            <label for="">เลขที่ใบสั่งซื้อ : </label>
                            <label for="">{{ sprintf('%05d', $customer_db->order_id) }}</label>
                        </div>
                        <div class="col-sm-4">
                            <label for="">วันที่เริ่มสั่งซื้อ : </label>
                            <label for="">{{ date('d-m-Y', strtotime($customer_db->order_startdate)) }}</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-8">
                            <label for="">ชื่อลูกค้า : </label>
                            @if ($order_db->cus_id == 99)
                                <label for="">{{ $other_db->o_name }}</label>
                            @else
                                <label for="">{{ $customer_db->cus_fristname }}
                                    {{ $customer_db->cus_lastname }}</label>
                            @endif
                        </div>
                        <div class="col-sm-4">
                            <label for="">เบอร์โทร : </label>
                            @if ($order_db->cus_id == 99)
                                <label for="">{{ $other_db->o_phonenumber }}</label>
                            @else
                                <label for="">{{ $customer_db->cus_phonenumber }}</label>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-8">
                            <label for="">ที่อยู่ : </label>
                            @if ($order_db->cus_id == 99)
                                <label for="">{{ $other_db->o_address }}</label>
                            @else
                                <label for="">{{ $customer_db->cus_address }}</label>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-8">
                            <label for="">จังหวัด : </label>
                            @if ($order_db->cus_id == 99)
                                <label for="">{{ $other_db->province_name }}</label>
                            @else
                                <label for="">{{ $customer_db->province_name }}</label>
                            @endif
                        </div>
                        <div class="col-sm-4">
                            <label for="">อำเภอ : </label>
                            @if ($order_db->cus_id == 99)
                                <label for="">{{ $other_db->district_name }}</label>
                            @else
                                <label for="">{{ $customer_db->district_name }}</label>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-8">
                            <label for="">ตำบล : </label>
                            @if ($order_db->cus_id == 99)
                                <label for="">{{ $other_db->subdistrict_name }}</label>
                            @else
                                <label for="">{{ $customer_db->subdistrict_name }}</label>
                            @endif
                        </div>
                        <div class="col-sm-4">
                            <label for="">รหัสไปรษณีย์ : </label>
                            @if ($order_db->cus_id == 99)
                                <label for="">{{ $other_db->zip_code }}</label>
                            @else
                                <label for="">{{ $customer_db->zip_code }}</label>
                            @endif
                        </div>
                    </div>
                    <table id="multi-colum-dt" class="table table-striped table-bordered nowrap">
                        <thead>
                            <tr style="text-align: center;">
                                <th>ลำดับ</th>
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
                                        {{ number_format($value->orderdetail_priceunit,2) }}
                                    </td>
                                    <td>
                                        บาท
                                    </td>
                                    <td style="text-align: right;">
                                        {{ number_format($value->orderdetail_quantity_total * $value->orderdetail_priceunit,2) }}
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
                                    {{ number_format($total,2) }}
                                </th>
                                <th>บาท</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div id="non-printable" style="margin: 0 44%">
                    <button type="button" name="button" class="btn btn-info" id="btn-print"
                        onclick="window.print()">พิมพ์
                    </button>
                    <a href="{{ url('/order/order_detail/'.$customer_db->order_id) }}" class="btn btn-secondary">
                        ยกเลิก
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
