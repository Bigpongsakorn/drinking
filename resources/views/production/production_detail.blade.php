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
                                        <button class="btn btn-sm btn-dark">พิมพ์</button>
                                    </div>
                                    <div class="card-block">
                                        <button class="btn btn-sm btn-primary btn-p">สินค้า</button>
                                        <button class="btn btn-sm btn-success btn-m">วัตถุดิบ</button>
                                        <div class="table-responsive dt-responsive table-p">
                                            <table id="multi-colum-dt" class="table table-striped table-bordered nowrap">
                                                <thead>
                                                    <tr style="text-align: center;">
                                                        <th>ลำดับ</th>
                                                        <th>ชื่อสินค้า</th>
                                                        <th>จำนวน</th>
                                                        <th>หน่วย</th>
                                                        <th>ราคา</th>
                                                        <th>หน่วย</th>
                                                        <th>วันที่</th>
                                                        <th>ชื่อผู้ทำรายการ</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php $i = 1 @endphp
                                                    @foreach ($pro as $value)
                                                        <tr>
                                                            <td style="text-align: center;">{{ $i }}</td>
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
                                                            <td style="text-align: center;">
                                                                {{ $value->production_date }}
                                                            </td>
                                                            <td style="text-align: center;">
                                                                {{ $value->user_d_fname }} {{ $value->user_d_lanme }}
                                                            </td>
                                                        </tr>
                                                        @php $i++ @endphp
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="table-responsive dt-responsive table-m">
                                            <table id="alt-pg-dt" class="table table-striped table-bordered nowrap">
                                                <thead>
                                                    <tr style="text-align: center;">
                                                        <th>ลำดับ</th>
                                                        <th>ชื่อวัตถุดิบ</th>
                                                        <th>จำนวน</th>
                                                        <th>หน่วย</th>
                                                        <th>ราคา</th>
                                                        <th>หน่วย</th>
                                                        {{-- <th>ชื่อผู้ทำรายการ</th> --}}
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php $i = 1 @endphp
                                                    @foreach ($mat as $value)
                                                        <tr>
                                                            <td style="text-align: center;">{{ $i }}</td>
                                                            <td>
                                                                {{ $value->material_name }}
                                                            </td>
                                                            <td style="text-align: right;">
                                                                {{ $value->production_m_num }}
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
                                                            {{-- <td style="text-align: center;">
                                                                {{ $value->user_d_fname }} {{ $value->user_d_lanme }}
                                                            </td> --}}
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
