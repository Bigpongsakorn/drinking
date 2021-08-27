<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ url('css/style.css') }}">
    <link rel="stylesheet" href="{{ url('css/style2.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('/css/bootstrap.min.css') }}">

    <style>
        .fbody {
            font-size: 16px;
        }
    </style>

</head>

<body class="body-sty">
    <div class="rowv2">
        <div class="card">
            <div class="pcoded-inner-content">
                <div id="printable">
                    <div class="form-group row">
                        <div class="col-sm-3">
                            <img src="{{url('/upload/logo_test.png')}}" alt="" style="margin: 5%;" width="50%">
                        </div>
                        <div class="col-sm-5">
                            <br>
                            <h3>อันดาน้ำดื่ม</h3>
                            <p>เลขที่ 30 ตำบลนาแก้ว อำเภอเกาะคา จังหวัดลำปาง </p>
                        </div>
                        <div class="col-sm-4">
                            <br>
                            <h2>ใบเบิกสินค้า</h2>
                        </div>
                    </div>
                    <table id="multi-colum-dt" class="table table-striped table-bordered nowrap">
                        <thead>
                            <tr style="text-align: center;">
                                <th>ลำดับ</th>
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
                    <h5>สถานะ :
                        @if ($wid->withdraw_p_status == 0)
                            <span style="color: rgb(221, 208, 21)">รออนุมัติ</span>
                        @elseif ($wid->withdraw_p_status == 1)
                            <span style="color: red">ไม่อนุมัติ</span> : * หมายเหตุ
                            {{ $wid->withdraw_p_status_detail }}
                        @elseif ($wid->withdraw_p_status == 2)
                            <span style="color: rgb(24, 126, 75)">อนุมัติ</span>
                        @else
                            <span style="color:green">ขนของขึ้นรถ</span> โดย {{ $wid->emp_firstname }}
                            {{ $wid->emp_lastname }}
                        @endif
                    </h5><br>
                    @if ($wid->withdraw_p_status == 3)
                        <h5>วันที่อนุมัติ : {{ date('d-m-Y H:i:s', strtotime($wid->withdraw_p_status_time)) }}</h5>
                    @else

                    @endif
                </div>
                <div id="non-printable" style="margin: 0 44%">
                    <button type="button" name="button" class="btn btn-info" id="btn-print"
                        onclick="window.print()">พิมพ์
                    </button>
                    <a href="{{ url('/withdraw/withdraw_detail/'.$wid->withdraw_p_id) }}" class="btn btn-secondary">
                        ยกเลิก
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
