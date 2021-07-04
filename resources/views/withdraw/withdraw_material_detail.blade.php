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
                                        <div class="table-responsive dt-responsive">
                                            <table id="multi-colum-dt" class="table table-striped table-bordered nowrap">
                                                <thead>
                                                    <tr style="text-align: center;">
                                                        <th>ลำดับ</th>
                                                        <th>ชื่อวัตถุดิบ</th>
                                                        <th>จำนวน</th>
                                                        <th>หน่วย</th>
                                                        <th>วันที่</th>
                                                        <th>ชื่อผู้เบิก</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <span id="">
                                                        @php $i = 1 @endphp
                                                        @foreach ($show as $value)
                                                            <tr>
                                                                <td style="text-align: center;">{{ $i }}</td>
                                                                <td>
                                                                    {{ $value->material_name }}
                                                                </td>
                                                                <td style="text-align: right;">
                                                                    {{ $value->withdraw_m_num }}
                                                                </td>
                                                                <td style="text-align: left;">
                                                                    {{ $value->material_unit }}
                                                                </td>
                                                                <td style="text-align: center;">
                                                                    {{ $value->withdraw_m_date }}
                                                                </td>
                                                                <td style="text-align: center;">
                                                                    {{ $value->user_d_fname }} {{ $value->user_d_lanme }}
                                                                </td>
                                                            </tr>
                                                            @php $i++ @endphp
                                                        @endforeach
                                                    </span>
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
    
@endsection
