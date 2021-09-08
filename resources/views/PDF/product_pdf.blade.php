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

<body class="body-sty">
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
                            <h2>สินค้าคงคลัง</h2>
                        </div>
                    </div>
                    <table id="" class="table table-striped table-bordered nowrap">
                        <thead>
                            <tr style="text-align: center;">
                                <th>รหัสสินค้า</th>
                                <th>ชื่อสินค้า</th>
                                <th>ประเภท</th>
                                <th>ปริมาณ</th>
                                <th>ราคา</th>
                                <th>จำนวน</th>
                                <th>หน่วย</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($product as $value)
                                <tr>
                                    <td style="text-align: center;">{{ sprintf('%05d', $value->product_id) }}
                                    </td>
                                    <td>
                                        {{ $value->product_name }}
                                    </td>
                                    <td>{{ $value->product_t_name }}</td>
                                    <td>{{ $value->unit_name }}</td>
                                    <td style="text-align: right;">{{ $value->product_price }}</td>
                                    <td style="text-align: right;">{{ $value->product_total }}</td>
                                    <td>{{ $value->punit }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div id="non-printable" style="margin: 0 44%">
                    <button type="button" name="button" class="btn btn-info" id="btn-print"
                        onclick="window.print()">พิมพ์
                    </button>
                    <a href="{{ url('/product/index') }}" class="btn btn-secondary">
                        ยกเลิก
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
