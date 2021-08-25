@extends('layouts.admin.main')
@section('content')
    <div class="pcoded-content">

        <div class="page-header card">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="fa fa-shopping-bag bg-c-blue"></i>
                        <div class="d-inline">
                            <h5>จัดการข้อมูลส่งสินค้า</h5>
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
                                        <h5>รายละเอียดข้อมูลส่งสินค้า</h5>
                                    </div>
                                    <div style="margin:auto">
                                        <button class="btn btn-sm btn-info btn-all">ทั้งหมด</button>
                                        <button class="btn btn-sm btn-warning btn-pending">รอจัดส่ง</button>
                                        {{-- <button class="btn btn-sm btn-danger btn-dis">ไม่อนุมัติ</button> --}}
                                        {{-- <button class="btn btn-sm btn-secondary btn-approve">อนุมัติจัดส่ง</button> --}}
                                        <button class="btn btn-sm btn-success btn-fin">ส่งเสร็จ</button>
                                    </div>
                                    <br>
                                    <div style="margin:auto">
                                        <a href="{{ url('/customer/index') }}">
                                            <button class="btn btn-primary">
                                                เพิ่มการจัดส่งสินค้า
                                            </button>
                                        </a>
                                    </div>
                                    <div class="card-block">
                                        <div class="table-responsive dt-responsive table-p">
                                            <table id="multi-colum-dt" class="table table-striped table-bordered nowrap">
                                                <thead>
                                                    <tr style="text-align: center;">
                                                        {{-- <th><input type="checkbox" name="" id=""></th> --}}
                                                        <th>รหัสการส่งสินค้า</th>
                                                        <th>ชื่อลูกค้า</th>
                                                        <th>วันที่จัดส่ง</th>
                                                        <th>เบอร์โทร</th>
                                                        <th>รายละเอียด</th>
                                                        <th>การชำระเงิน</th>
                                                        <th>สถานะ</th>
                                                        <th>แก้ไข / ลบ</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="table-all">
                                                    @php $i = 1 @endphp
                                                    @foreach ($ship as $value)
                                                        <tr>
                                                            {{-- <td style="text-align: center;">
                                                                <input type="checkbox" name="ck_box" id="ck_box"
                                                                    class="check-box" data-id="{{ $value->cus_id }}"
                                                                    data-date="{{ $value->cus_date }}">
                                                            </td> --}}
                                                            <td style="text-align: center;">{{ sprintf('%05d',$value->ship_id) }}</td>
                                                            <td style="text-align: center;">
                                                                {{ $value->cus_fristname }} {{ $value->cus_lastname }}
                                                            </td>
                                                            <td style="text-align: center;">
                                                                {{ date('d-m-Y', strtotime($value->ship_date)) }}
                                                            </td>
                                                            <td style="text-align: center;">
                                                                {{ $value->cus_phonenumber }}
                                                            </td>
                                                            <td style="text-align: center;">
                                                                <a
                                                                    href="{{ url('/shipment/shipment_detail/' . $value->ship_id) }}">
                                                                    <button class="btn btn-sm btn-info">รายละเอียด</button>
                                                                </a>
                                                            </td>
                                                            <td style="text-align: center;">
                                                                @if ($value->ship_pay == 1)
                                                                <button type="button" class="btn btn-sm btn-success open_modal1"
                                                                        data-toggle="modal" data-target="#exampleModal1"
                                                                        data-ship_id="{{ $value->ship_id }}"
                                                                        data-ship_pay="{{ $value->ship_pay }}"
                                                                        data-total="{{ $value->total }}"
                                                                        data-ship_price="{{ $value->ship_price }}"
                                                                        data-ship_change="{{ $value->ship_change }}"
                                                                        data-ship_pay_status="{{ $value->ship_pay_status }}"
                                                                        data-ship_bill="{{ $value->ship_bill }}"> 
                                                                    จ่ายเงินแล้ว
                                                                </button>
                                                                @elseif ($value->ship_pay == 3)
                                                                <button class="btn btn-sm btn-warning open_modal3"
                                                                        data-toggle="modal" data-target="#exampleModal3"
                                                                        data-ship_id="{{ $value->ship_id }}"
                                                                        data-ship_note="{{ $value->ship_note }}"
                                                                        data-ship_pay="{{ $value->ship_pay }}"
                                                                        data-ship_status="{{ $value->ship_status }}"
                                                                        data-total="{{ $value->total }}"
                                                                        data-ship_arrears="{{ $value->ship_arrears }}">
                                                                    ค้างจ่าย
                                                                </button>
                                                                @else
                                                                <button class="btn btn-sm btn-danger open_modal3"
                                                                        data-toggle="modal" data-target="#exampleModal3"
                                                                        data-ship_id="{{ $value->ship_id }}"
                                                                        data-ship_note="{{ $value->ship_note }}"
                                                                        data-ship_pay="{{ $value->ship_pay }}"
                                                                        data-ship_status="{{ $value->ship_status }}"
                                                                        data-total="{{ $value->total }}">
                                                                    ไม่ได้จ่ายเงิน
                                                                </button>
                                                                @endif
                                                            </td>
                                                            <td style="text-align: center;">
                                                                @if ($value->ship_status == 0)
                                                                    @if ($user_type == 1 || $user_type == 2)
                                                                        <button class="btn btn-sm btn-warning open_modal"
                                                                            data-toggle="modal" data-target="#exampleModal"
                                                                            data-ship_id="{{ $value->ship_id }}"
                                                                            data-ship_status="{{ $value->ship_status }}">
                                                                            รอจัดส่ง
                                                                        </button>
                                                                    @else
                                                                        <button class="btn btn-sm btn-warning">
                                                                            รอจัดส่ง
                                                                        </button>
                                                                    @endif
                                                                @elseif($value->ship_status == 1)
                                                                    <button class="btn btn-sm btn-secondary open_modal2"
                                                                        data-toggle="modal" data-target="#exampleModal2"
                                                                        data-ship_id="{{ $value->ship_id }}"
                                                                        data-ship_status="{{ $value->ship_status }}">
                                                                        อนุมัติจัดส่ง
                                                                    </button>
                                                                @else
                                                                    <button class="btn btn-sm btn-success">
                                                                        ส่งเสร็จ
                                                                    </button>
                                                                @endif
                                                            </td>
                                                            <td style="text-align: center;">
                                                                @if ($value->ship_status == 1 || $value->ship_status == 2)
                                                                    <button class="btn btn-sm btn-secondary">edit</button>
                                                                    <button class="btn btn-sm btn-secondary">
                                                                        delete
                                                                    </button>
                                                                @else
                                                                    <a href="{{ url('/shipment/shipment_edit/' . $value->ship_id) }}">
                                                                        <button class="btn btn-sm btn-primary">edit</button>
                                                                    </a>
                                                                    <a href="javascript:void(0);" class="delete"
                                                                        data-id="{{ $value->ship_id }}">
                                                                        <button class="btn btn-sm btn-danger">
                                                                            delete
                                                                        </button>
                                                                    </a>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        @php $i++ @endphp
                                                    @endforeach
                                                </tbody>
                                                <tbody class="table-pending">
                                                    @php $i = 1 @endphp
                                                    @foreach ($ship_pending as $value)
                                                        <tr>
                                                            {{-- <td style="text-align: center;">
                                                                <input type="checkbox" name="ck_box" id="ck_box"
                                                                    class="check-box" data-id="{{ $value->cus_id }}"
                                                                    data-date="{{ $value->cus_date }}">
                                                            </td> --}}
                                                            <td style="text-align: center;">{{ sprintf('%05d',$value->ship_id) }}</td>
                                                            <td style="text-align: center;">
                                                                {{ $value->cus_fristname }} {{ $value->cus_lastname }}
                                                            </td>
                                                            <td style="text-align: center;">
                                                                {{ date('d-m-Y', strtotime($value->ship_date)) }}
                                                            </td>
                                                            <td style="text-align: center;">
                                                                {{ $value->cus_phonenumber }}
                                                            </td>
                                                            <td style="text-align: center;">
                                                                <a
                                                                    href="{{ url('/shipment/shipment_detail/' . $value->ship_id) }}">
                                                                    <button class="btn btn-sm btn-info">รายละเอียด</button>
                                                                </a>
                                                            </td>
                                                            <td style="text-align: center;">
                                                                @if ($value->ship_pay == 1)
                                                                <button type="button" class="btn btn-sm btn-success open_modal1"
                                                                        data-toggle="modal" data-target="#exampleModal1"
                                                                        data-ship_id="{{ $value->ship_id }}"
                                                                        data-ship_pay="{{ $value->ship_pay }}"
                                                                        data-total="{{ $value->total }}"
                                                                        data-ship_price="{{ $value->ship_price }}"
                                                                        data-ship_change="{{ $value->ship_change }}"
                                                                        data-ship_pay_status="{{ $value->ship_pay_status }}"
                                                                        data-ship_bill="{{ $value->ship_bill }}"> 
                                                                    จ่ายเงินแล้ว
                                                                </button>
                                                                @elseif ($value->ship_pay == 3)
                                                                <button class="btn btn-sm btn-warning open_modal3"
                                                                        data-toggle="modal" data-target="#exampleModal3"
                                                                        data-ship_id="{{ $value->ship_id }}"
                                                                        data-ship_note="{{ $value->ship_note }}"
                                                                        data-ship_pay="{{ $value->ship_pay }}"
                                                                        data-ship_status="{{ $value->ship_status }}"
                                                                        data-total="{{ $value->total }}"
                                                                        data-ship_arrears="{{ $value->ship_arrears }}">
                                                                    ค้างจ่าย
                                                                </button>
                                                                @else
                                                                <button class="btn btn-sm btn-danger open_modal3"
                                                                        data-toggle="modal" data-target="#exampleModal3"
                                                                        data-ship_id="{{ $value->ship_id }}"
                                                                        data-ship_note="{{ $value->ship_note }}"
                                                                        data-ship_pay="{{ $value->ship_pay }}"
                                                                        data-ship_status="{{ $value->ship_status }}"
                                                                        data-total="{{ $value->total }}">
                                                                    ไม่ได้จ่ายเงิน
                                                                </button>
                                                                @endif
                                                            </td>
                                                            <td style="text-align: center;">
                                                                @if ($value->ship_status == 0)
                                                                    @if ($user_type == 1 || $user_type == 2)
                                                                        <button class="btn btn-sm btn-warning open_modal"
                                                                            data-toggle="modal" data-target="#exampleModal"
                                                                            data-ship_id="{{ $value->ship_id }}"
                                                                            data-ship_status="{{ $value->ship_status }}">
                                                                            รอจัดส่ง
                                                                        </button>
                                                                    @else
                                                                        <button class="btn btn-sm btn-warning">
                                                                            รอจัดส่ง
                                                                        </button>
                                                                    @endif
                                                                @elseif($value->ship_status == 1)
                                                                    <button class="btn btn-sm btn-secondary open_modal2"
                                                                        data-toggle="modal" data-target="#exampleModal2"
                                                                        data-ship_id="{{ $value->ship_id }}"
                                                                        data-ship_status="{{ $value->ship_status }}">
                                                                        อนุมัติจัดส่ง
                                                                    </button>
                                                                @else
                                                                    <button class="btn btn-sm btn-success">
                                                                        ส่งเสร็จ
                                                                    </button>
                                                                @endif
                                                            </td>
                                                            <td style="text-align: center;">
                                                                <a
                                                                    href="{{ url('/shipment/shipment_edit/' . $value->ship_id) }}">
                                                                    <button class="btn btn-sm btn-primary">edit</button>
                                                                </a>
                                                                <a href="javascript:void(0);" class="delete"
                                                                    data-id="{{ $value->ship_id }}">
                                                                    <button class="btn btn-sm btn-danger">
                                                                        delete
                                                                    </button>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        @php $i++ @endphp
                                                    @endforeach
                                                </tbody>
                                                <tbody class="table-approve">
                                                    @php $i = 1 @endphp
                                                    @foreach ($ship_approve as $value)
                                                        <tr>
                                                            {{-- <td style="text-align: center;">
                                                                <input type="checkbox" name="ck_box" id="ck_box"
                                                                    class="check-box" data-id="{{ $value->cus_id }}"
                                                                    data-date="{{ $value->cus_date }}">
                                                            </td> --}}
                                                            <td style="text-align: center;">{{ sprintf('%05d',$value->ship_id) }}</td>
                                                            <td style="text-align: center;">
                                                                {{ $value->cus_fristname }} {{ $value->cus_lastname }}
                                                            </td>
                                                            <td style="text-align: center;">
                                                                {{ date('d-m-Y', strtotime($value->ship_date)) }}
                                                            </td>
                                                            <td style="text-align: center;">
                                                                {{ $value->cus_phonenumber }}
                                                            </td>
                                                            <td style="text-align: center;">
                                                                <a
                                                                    href="{{ url('/shipment/shipment_detail/' . $value->ship_id) }}">
                                                                    <button class="btn btn-sm btn-info">รายละเอียด</button>
                                                                </a>
                                                            </td>
                                                            <td style="text-align: center;">
                                                                @if ($value->ship_pay == 1)
                                                                <button type="button" class="btn btn-sm btn-success open_modal1"
                                                                        data-toggle="modal" data-target="#exampleModal1"
                                                                        data-ship_id="{{ $value->ship_id }}"
                                                                        data-ship_pay="{{ $value->ship_pay }}"
                                                                        data-total="{{ $value->total }}"
                                                                        data-ship_price="{{ $value->ship_price }}"
                                                                        data-ship_change="{{ $value->ship_change }}"
                                                                        data-ship_pay_status="{{ $value->ship_pay_status }}"
                                                                        data-ship_bill="{{ $value->ship_bill }}"> 
                                                                    จ่ายเงินแล้ว
                                                                </button>
                                                                @elseif ($value->ship_pay == 3)
                                                                <button class="btn btn-sm btn-warning open_modal3"
                                                                        data-toggle="modal" data-target="#exampleModal3"
                                                                        data-ship_id="{{ $value->ship_id }}"
                                                                        data-ship_note="{{ $value->ship_note }}"
                                                                        data-ship_pay="{{ $value->ship_pay }}"
                                                                        data-ship_status="{{ $value->ship_status }}"
                                                                        data-total="{{ $value->total }}"
                                                                        data-ship_arrears="{{ $value->ship_arrears }}">
                                                                    ค้างจ่าย
                                                                </button>
                                                                @else
                                                                <button class="btn btn-sm btn-danger open_modal3"
                                                                        data-toggle="modal" data-target="#exampleModal3"
                                                                        data-ship_id="{{ $value->ship_id }}"
                                                                        data-ship_note="{{ $value->ship_note }}"
                                                                        data-ship_pay="{{ $value->ship_pay }}"
                                                                        data-ship_status="{{ $value->ship_status }}"
                                                                        data-total="{{ $value->total }}">
                                                                    ไม่ได้จ่ายเงิน
                                                                </button>
                                                                @endif
                                                            </td>
                                                            <td style="text-align: center;">
                                                                @if ($value->ship_status == 0)
                                                                    @if ($user_type == 1 || $user_type == 2)
                                                                        <button class="btn btn-sm btn-warning open_modal"
                                                                            data-toggle="modal" data-target="#exampleModal"
                                                                            data-ship_id="{{ $value->ship_id }}"
                                                                            data-ship_status="{{ $value->ship_status }}">
                                                                            รอจัดส่ง
                                                                        </button>
                                                                    @else
                                                                        <button class="btn btn-sm btn-warning">
                                                                            รอจัดส่ง
                                                                        </button>
                                                                    @endif
                                                                @elseif($value->ship_status == 1)
                                                                    <button class="btn btn-sm btn-secondary open_modal2"
                                                                        data-toggle="modal" data-target="#exampleModal2"
                                                                        data-ship_id="{{ $value->ship_id }}"
                                                                        data-ship_status="{{ $value->ship_status }}">
                                                                        อนุมัติจัดส่ง
                                                                    </button>
                                                                @else
                                                                    <button class="btn btn-sm btn-success">
                                                                        ส่งเสร็จ
                                                                    </button>
                                                                @endif
                                                            </td>
                                                            <td style="text-align: center;">
                                                                {{-- <a href="{{ url('/shipment/shipment_edit/'.$value->ship_id) }}"> --}}
                                                                <button class="btn btn-sm btn-secondary">edit</button>
                                                                {{-- </a> --}}
                                                                {{-- <a href="javascript:void(0);" class="delete"
                                                                    data-id="{{ $value->ship_id }}"> --}}
                                                                <button class="btn btn-sm btn-secondary">
                                                                    delete
                                                                </button>
                                                                {{-- </a> --}}
                                                            </td>
                                                        </tr>
                                                        @php $i++ @endphp
                                                    @endforeach
                                                </tbody>
                                                <tbody class="table-fin">
                                                    @php $i = 1 @endphp
                                                    @foreach ($ship_fin as $value)
                                                        <tr>
                                                            {{-- <td style="text-align: center;">
                                                                <input type="checkbox" name="ck_box" id="ck_box"
                                                                    class="check-box" data-id="{{ $value->cus_id }}"
                                                                    data-date="{{ $value->cus_date }}">
                                                            </td> --}}
                                                            <td style="text-align: center;">{{ sprintf('%05d',$value->ship_id) }}</td>
                                                            <td style="text-align: center;">
                                                                {{ $value->cus_fristname }} {{ $value->cus_lastname }}
                                                            </td>
                                                            <td style="text-align: center;">
                                                                {{ date('d-m-Y', strtotime($value->ship_date)) }}
                                                            </td>
                                                            <td style="text-align: center;">
                                                                {{ $value->cus_phonenumber }}
                                                            </td>
                                                            <td style="text-align: center;">
                                                                <a
                                                                    href="{{ url('/shipment/shipment_detail/' . $value->ship_id) }}">
                                                                    <button class="btn btn-sm btn-info">รายละเอียด</button>
                                                                </a>
                                                            </td>
                                                            <td style="text-align: center;">
                                                                @if ($value->ship_pay == 1)
                                                                <button type="button" class="btn btn-sm btn-success open_modal1"
                                                                        data-toggle="modal" data-target="#exampleModal1"
                                                                        data-ship_id="{{ $value->ship_id }}"
                                                                        data-ship_pay="{{ $value->ship_pay }}"
                                                                        data-total="{{ $value->total }}"
                                                                        data-ship_price="{{ $value->ship_price }}"
                                                                        data-ship_change="{{ $value->ship_change }}"
                                                                        data-ship_pay_status="{{ $value->ship_pay_status }}"
                                                                        data-ship_bill="{{ $value->ship_bill }}"> 
                                                                    จ่ายเงินแล้ว
                                                                </button>
                                                                @elseif ($value->ship_pay == 3)
                                                                <button class="btn btn-sm btn-warning open_modal3"
                                                                        data-toggle="modal" data-target="#exampleModal3"
                                                                        data-ship_id="{{ $value->ship_id }}"
                                                                        data-ship_note="{{ $value->ship_note }}"
                                                                        data-ship_pay="{{ $value->ship_pay }}"
                                                                        data-ship_status="{{ $value->ship_status }}"
                                                                        data-total="{{ $value->total }}"
                                                                        data-ship_arrears="{{ $value->ship_arrears }}">
                                                                    ค้างจ่าย
                                                                </button>
                                                                @else
                                                                <button class="btn btn-sm btn-danger open_modal3"
                                                                        data-toggle="modal" data-target="#exampleModal3"
                                                                        data-ship_id="{{ $value->ship_id }}"
                                                                        data-ship_note="{{ $value->ship_note }}"
                                                                        data-ship_pay="{{ $value->ship_pay }}"
                                                                        data-ship_status="{{ $value->ship_status }}"
                                                                        data-total="{{ $value->total }}">
                                                                    ไม่ได้จ่ายเงิน
                                                                </button>
                                                                @endif
                                                            </td>
                                                            <td style="text-align: center;">
                                                                @if ($value->ship_status == 0)
                                                                    @if ($user_type == 1 || $user_type == 2)
                                                                        <button class="btn btn-sm btn-warning open_modal"
                                                                            data-toggle="modal" data-target="#exampleModal"
                                                                            data-ship_id="{{ $value->ship_id }}"
                                                                            data-ship_status="{{ $value->ship_status }}">
                                                                            รอจัดส่ง
                                                                        </button>
                                                                    @else
                                                                        <button class="btn btn-sm btn-warning">
                                                                            รอจัดส่ง
                                                                        </button>
                                                                    @endif
                                                                @elseif($value->ship_status == 1)
                                                                    <button class="btn btn-sm btn-secondary open_modal2"
                                                                        data-toggle="modal" data-target="#exampleModal2"
                                                                        data-ship_id="{{ $value->ship_id }}"
                                                                        data-ship_status="{{ $value->ship_status }}">
                                                                        อนุมัติจัดส่ง
                                                                    </button>
                                                                @else
                                                                    <button class="btn btn-sm btn-success">
                                                                        ส่งเสร็จ
                                                                    </button>
                                                                @endif
                                                            </td>
                                                            <td style="text-align: center;">
                                                                {{-- <a href="{{ url('/shipment/shipment_edit/'.$value->ship_id) }}"> --}}
                                                                <button class="btn btn-sm btn-secondary">edit</button>
                                                                {{-- </a> --}}
                                                                {{-- <a href="javascript:void(0);" class="delete"
                                                                    data-id="{{ $value->ship_id }}"> --}}
                                                                <button class="btn btn-sm btn-secondary">
                                                                    delete
                                                                </button>
                                                                {{-- </a> --}}
                                                            </td>
                                                        </tr>
                                                        @php $i++ @endphp
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            {{-- <button class="btn btn-success" id="submit">Submit</button> --}}
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

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">การอนุมัติ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="" id="create-product-category">
                    <div class="modal-body">
                        <input type="hidden" id="ship_id" name="" value="">
                        <select name="" class="form-control" id="ship_status">
                            <option value="0">รอจัดส่ง</option>
                            {{-- <option value="1">อนุมัติจัดส่ง</option> --}}
                            <option value="2">ส่งเสร็จ</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">ปิด</button>
                        <button type="submit" class="btn btn-sm btn-primary">บันทึก</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">การอนุมัติ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="" id="create-product-category2">
                    <div class="modal-body">
                        <input type="hidden" id="ship_id_" name="" value="">
                        <select name="" class="form-control" id="ship_status_">
                            <option value="1">อนุมัติจัดส่ง</option>
                            <option value="2">ส่งเสร็จ</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">ปิด</button>
                        <button type="submit" class="btn btn-sm btn-primary">บันทึก</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">การจ่ายเงิน</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="ship_id3" name="" value="">
                    <select name="" class="form-control order_status1" id="ship_pay3">
                        <option value="1">จ่ายเงินแล้ว</option>
                        <option value="3">ค้างจ่าย</option>
                        <option value="2">ไม่ได้จ่ายเงิน</option>
                    </select>
                </div>
                <div class="modal-body box_note3" style="display: none">
                    <label style="color: red">* เงินที่ค้าง</label>
                    <input type="text" class="form-control" name="" id="ship_price">
                </div>
                <div class="modal-body box_note">
                    <label style="color: red">* หมายเหตุ</label>
                    <input type="text" class="form-control " name="" id="ship_note3">
                </div>
                <div class="modal-body box_pay" style="display: none">
                    <select name="" id="" class="form-control order_pay">
                        <option value="">-- เลือกการจ่ายเงิน --</option>
                        <option value="1">จ่ายเงินสด</option>
                        <option value="2">จ่ายแบบโอน</option>
                    </select>
                </div>
                <div class="modal-body box_bill" style="display: none">
                    <label for="">สลิปโอน</label>
                    <input type="file" class="form-control ship_bill">
                </div>
                <div class="modal-body box_price" style="display: none">
                    <label for="">ราคารวม</label>
                    <label id="p_total"></label> บาท <br>
                    <label class="red">* จำนวนที่จ่าย</label>
                    <div class="form-group row">
                        <input type="hidden" name="" id="ppp_total">
                        <input type="text" class="form-control col-md-5 p_price" style="margin: 0 10px 0 10px">
                        <button class="btn btn-sm btn-primary btn_cal"
                            >คำนวณ
                        </button>
                    </div>
                    <div class="form-group row d_cal" style="margin-left: 5px; display: none;">
                        <label for="">เงินทอน</label>
                        <label id="ttotal"></label> บาท
                        <input type="hidden" name="" id="ttotal2">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">ปิด</button>
                    <button type="submit" class="btn btn-sm btn-primary" id="create-product-category3">บันทึก</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">การจ่ายเงิน</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="ship_status_"></div>
                    <div class="select_chang" style="display: none">
                        <label for="">ราคารวม</label>
                        <label class="ship_ttotl"></label> บาท <br>
                        <label for="">จำนวนที่จ่าย</label>
                        <label class="ship_price"></label> บาท <br>
                        <label for="">เงินทอน</label>
                        <label class="ship_change"></label> บาท <br>
                    </div>
                    <div class="select_bill2" style="display: none">
                        <label for="">สลิปโอน</label>
                        <div id="ship_bill"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')

    <script>
        $(document).ready(function() {

            $('body').on('change', '.order_status1', function() {
                var id = $('.order_status1').val()
                if (id == 1) {
                    $('.box_pay').show()
                    $('.box_note').hide()
                    $('.box_note3').hide()
                    $('#ship_note3').val(null)
                    $('#ship_price').val(null)
                    $('.box_bill').hide()
                    $('.box_price').hide()
                }
                if (id == 2) {
                    $('.box_pay').hide()
                    $('.order_pay').val(null)
                    $('.box_note').show()
                    $('.box_note3').hide()
                    $('#ship_price').val(null)
                    $('.box_bill').hide()
                    $('.box_price').hide()
                }
                if(id == 3){
                    $('.box_pay').hide()
                    $('.order_pay').val(null)
                    $('.box_note').show()
                    $('.box_note3').show()
                    $('.box_bill').hide()
                    $('.box_price').hide()
                }
            });

            $('body').on('change', '.order_pay', function() {
                var id = $('.order_pay').val()
                if(id == 1){
                    $('.box_bill').hide()
                    $('.box_price').show()
                }
                if(id == 2){
                    $('.box_bill').show()
                    $('.box_price').hide()
                }
                if(id == ""){
                    $('.box_bill').hide()
                    $('.box_price').hide()
                }
            });
            
            $('body').on('click', '.btn_cal', function() {
                // var p_total = $(this).data('p_total');
                var p_price = $('.p_price').val() //ราคาจ่าย
                var p_total = $('#ppp_total').val() //ราคารวม
                $('.d_cal').show()
                // console.log(p_price);
                // console.log(p_total);
                var ttotall = p_price - p_total;
                $('#ttotal').html('').append("<label style='margin:0 5px 0 5px;'>"+ttotall+".00</label>")
                $('#ttotal2').val(ttotall) //เงินทอน
            });

            $('body').on('click', '.open_modal1', function() {
                // var ship_id = $(this).data('ship_id');
                var ship_status = $(this).data('ship_pay_status');
                var ship_bill = $(this).data('ship_bill');
                var ship_change = $(this).data('ship_change');
                var total = $(this).data('total');
                var ship_price = $(this).data('ship_price');

                const price = ship_price;
                let dollarUSLocale = Intl.NumberFormat('en-US');
                console.log("US Locale output: " + dollarUSLocale.format(price));

                const price2 = ship_change;
                // let dollarUSLocale = Intl.NumberFormat('en-US');
                console.log("US Locale output2: " + dollarUSLocale.format(price2));
                // console.log(ship_price);
                // console.log(ship_change);
                
                if(ship_status == 2){
                    $('.select_bill2').show()
                    $('.select_chang').hide()
                }else{
                    $('.select_bill2').hide()
                    $('.select_chang').show()
                }
                // console.log(ship_id)
                // console.log(total)
                // console.log(ship_change)
                // $('#ship_id_').val(ship_id)
                // $('.ship_status_').val(ship_status)
                // $('#ship_bill').val(ship_bill)
                $('.ship_change').html('').append("<label>"+dollarUSLocale.format(price2)+".00</label>")
                $('.ship_ttotl').html('').append("<label>"+total+"</label>")
                $('.ship_price').html('').append("<label>"+dollarUSLocale.format(price)+".00</label>")

                var title =  '';
                    if(ship_status == 1){
                        title = 'จ่ายเงินสด'
                    }else{
                        title = 'จ่ายแบบโอน'
                    }
                var html = '';
                html += `<img src="{{ url('/upload/shipment/`+ship_bill+`') }}" alt="" width="50%">`;
                $('.ship_status_').html('').append("<label>"+title+"</label>")
                $('#ship_bill').html('').append(html)
            })

            $('body').on('click', '.open_modal3', function() {
                var ship_id = $(this).data('ship_id');
                var ship_pay = $(this).data('ship_pay'); //สถานะจ่ายเงิน
                var ship_note = $(this).data('ship_note');
                var total = $(this).data('total'); //ราคารวม
                var ship_arrears = $(this).data('ship_arrears');
console.log(ship_id)
// console.log(ship_pay)
// console.log(ship_note)
// console.log(total)        
console.log(ship_arrears)     
                if(ship_pay == 1){
                    // $('.box_note3').hide()
                    // $('#ship_price').val(null)
                }  
                if(ship_pay == 2){
                    $('.box_note3').hide()
                    $('#ship_price').val(null)
                }         
                if(ship_pay == 3){
                    $('.box_note3').show()
                    $('#ship_price').val(ship_arrears)
                }
                
                $('#ship_id3').val(ship_id)
                $('#ship_pay3').val(ship_pay)
                $('#ship_note3').val(ship_note)
                $('#ppp_total').val(total) //ราคารวม
                $('#p_total').html('').append("<label>"+total+"</label>")
            })

            $('body').on('click', '.open_modal2', function() {
                var ship_id = $(this).data('ship_id');
                var ship_status = $(this).data('ship_status');

                $('#ship_id_').val(ship_id)
                $('#ship_status_').val(ship_status)
            })

            $('body').on('click', '.open_modal', function() {
                var ship_id = $(this).data('ship_id');
                var ship_status = $(this).data('ship_status');

                $('#ship_id').val(ship_id)
                $('#ship_status').val(ship_status)
            })

            $('body').on('click', '#create-product-category3', function(e) {
                e.preventDefault();
                var ship_id = $('#ship_id3').val()
                var ship_note = $('#ship_note3').val()
                var ship_pay = $('#ship_pay3').val() //สถานะจ่าย
                var ship_price = $('#ship_price').val() //เงินค้าง
                var order_pay = $('.order_pay').val() //สถานะการจ่ายเงิน
                var ship_bill = $('.ship_bill').val() //รูปบิล
                var p_price = $('.p_price').val() //ราคาที่จ่าย
                var change = $('#ttotal2').val() //เงินทอน
                var fd = new FormData();

                if (ship_id && ship_pay) {

                    fd.append('_token', "{{ csrf_token() }}");
                    fd.append('ship_id', ship_id);
                    fd.append('ship_note', ship_note);
                    fd.append('ship_pay', ship_pay);
                    fd.append('ship_price', ship_price);
                    fd.append('order_pay', order_pay);
                    // fd.append('ship_bill', ship_bill);
                    fd.append('p_price', p_price);
                    fd.append('change', change);

                    jQuery.each(jQuery('.ship_bill')[0].files, function(i, file) {
                        fd.append('ship_bill', file);
                    });

                    $.ajax({
                        method: "POST",
                        url: "/drinking/public/shipment/price",
                        dataType: 'json',
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: fd,
                    }).done(function(rec) {
                        // rec = JSON.parse(rec);
                        if (rec.status == '1') {
                            swal({
                                title: 'บันทึกสำเร็จ!',
                                text: "กดปุ่ม ok เพื่อดำเนินการต่อ!",
                                type: 'success',
                                padding: '2em'
                            }).then(function(then) {
                                location.reload()
                            })
                        }
                        if (rec.status == '3') {
                            swal({
                                title: 'กรุณากรอกข้อมูลให้ครบถ้วน!',
                                text: "กดปุ่ม ok เพื่อดำเนินการต่อ!",
                                type: 'error',
                                padding: '2em'
                            })
                        }
                        if (rec.status == '0') {
                            swal({
                                title: 'บันทึกไม่สำเร็จ!',
                                text: "กดปุ่ม ok เพื่อดำเนินการต่อ!",
                                type: 'error',
                                padding: '2em'
                            })
                        }
                    }).fail(function() {
                        swal("Error!", "You clicked the button!", "error");
                    })
                }

            })

            $('body').on('submit', '#create-product-category2', function(e) {
                e.preventDefault();
                var ship_id = $('#ship_id_').val()
                var ship_status = $('#ship_status_').val()
                // var ship_note = $('#ship_note').val()
                // var ship_pay = $('#ship_pay').val()
                var fd = new FormData();

                if (ship_status) {

                    fd.append('_token', "{{ csrf_token() }}");
                    fd.append('ship_id', ship_id);
                    fd.append('ship_status', ship_status);
                    // fd.append('ship_note', ship_note);
                    // fd.append('ship_pay', ship_pay);

                    $.ajax({
                        method: "POST",
                        url: "/drinking/public/shipment/status",
                        dataType: 'json',
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: fd,
                    }).done(function(rec) {
                        // rec = JSON.parse(rec);
                        if (rec.status == '1') {
                            swal({
                                title: 'บันทึกสำเร็จ!',
                                text: "กดปุ่ม ok เพื่อดำเนินการต่อ!",
                                type: 'success',
                                padding: '2em'
                            }).then(function(then) {
                                location.reload()
                            })
                        }
                        if (rec.status == '3') {
                            swal({
                                title: 'สินค้าไม่พอส่ง!',
                                text: "กดปุ่ม ok เพื่อดำเนินการต่อ!",
                                type: 'error',
                                padding: '2em'
                            })
                        }
                        if (rec.status == '0') {
                            swal({
                                title: 'บันทึกไม่สำเร็จ!',
                                text: "กดปุ่ม ok เพื่อดำเนินการต่อ!",
                                type: 'error',
                                padding: '2em'
                            })
                        }
                    }).fail(function() {
                        swal("Error!", "You clicked the button!", "error");
                    })
                }

            })

            $('body').on('submit', '#create-product-category', function(e) {
                e.preventDefault();
                var ship_id = $('#ship_id').val()
                var ship_status = $('#ship_status').val()
                var fd = new FormData();

                if (ship_status) {

                    fd.append('_token', "{{ csrf_token() }}");
                    fd.append('ship_id', ship_id);
                    fd.append('ship_status', ship_status);

                    $.ajax({
                        method: "POST",
                        url: "/drinking/public/shipment/status",
                        dataType: 'json',
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: fd,
                    }).done(function(rec) {
                        // rec = JSON.parse(rec);
                        if (rec.status == '1') {
                            swal({
                                title: 'บันทึกสำเร็จ!',
                                text: "กดปุ่ม ok เพื่อดำเนินการต่อ!",
                                type: 'success',
                                padding: '2em'
                            }).then(function(then) {
                                location.reload()
                            })
                        }
                        if (rec.status == '3') {
                            swal({
                                title: 'สินค้าไม่พอส่ง!',
                                text: "กดปุ่ม ok เพื่อดำเนินการต่อ!",
                                type: 'error',
                                padding: '2em'
                            })
                        }
                        if (rec.status == '0') {
                            swal({
                                title: 'บันทึกไม่สำเร็จ!',
                                text: "กดปุ่ม ok เพื่อดำเนินการต่อ!",
                                type: 'error',
                                padding: '2em'
                            })
                        }
                    }).fail(function() {
                        swal("Error!", "You clicked the button!", "error");
                    })
                }

            })

            $('body').on('click', '.delete', function() {
                let id = $(this).data('id');

                swal({
                    title: 'ยืนยันการลบข้อมูล?',
                    text: "กดปุ่ม Delete เพื่อดำเนินการต่อ!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Delete',
                    padding: '2em'
                }).then(function(result) {
                    if (result.value) {

                        $.ajax({
                            method: "GET",
                            url: "/drinking/public/shipment/destroy/" + id,
                        }).done(function(rec) {
                            rec = JSON.parse(rec);
                            console.log(rec);
                            if (rec.status == '1') {
                                swal({
                                    title: 'ลบข้อมูลสำเร็จ!',
                                    text: "กดปุ่ม ok เพื่อดำเนินการต่อ!",
                                    type: 'success',
                                    padding: '2em'
                                }).then(function(then) {
                                    location.reload()
                                })
                            } else {
                                swal({
                                    title: 'ลบข้อมูลไม่สำเร็จ!',
                                    text: "กดปุ่ม ok เพื่อดำเนินการต่อ!",
                                    type: 'error',
                                    padding: '2em'
                                })
                            }
                        }).fail(function() {
                            swal("Error!", "You clicked the button!", "error");
                        })

                    }
                })
            })

            $('.table-pending').hide()
            $('.table-approve').hide()
            $('.table-fin').hide()
            $('.btn-all').click(function() {
                $('.table-all').show()
                $('.table-pending').hide()
                $('.table-approve').hide()
                $('.table-fin').hide()
            });
            $('.btn-pending').click(function() {
                $('.table-pending').show()
                $('.table-all').hide()
                $('.table-approve').hide()
                $('.table-fin').hide()
            });
            $('.btn-approve').click(function() {
                $('.table-pending').hide()
                $('.table-all').hide()
                $('.table-pending').hide()
                $('.table-approve').show()
                $('.table-fin').hide()
            });
            $('.btn-fin').click(function() {
                $('.table-pending').hide()
                $('.table-all').hide()
                $('.table-pending').hide()
                $('.table-approve').hide()
                $('.table-fin').show()
            });
            // $('body').on('click', '#submit', function() {
            //     var checkbox = $('.check-box')

            //     $.each(checkbox, function(index, value) {
            //         if ($(this).is(':checked')) {

            //             var id = $(this).data('id')
            //             var date = $(this).data('date')
            //             console.log('checkkkkk', id, '=>', date)
            //             var fd = new FormData();

            //             if (id && date) {

            //             fd.append('_token', "{{ csrf_token() }}");
            //             fd.append('id', id);
            //             fd.append('date', date);

            //             $.ajax({
            //                 method: "POST",
            //                 url: "/shipment/store",
            //                 dataType: 'json',
            //                 cache: false,
            //                 contentType: false,
            //                 processData: false,
            //                 data: fd,

            //             }).done(function(rec) {

            //                 if (rec.status == '1') {
            //                     swal({
            //                         title: 'บันทึกสำเร็จ!',
            //                         text: "กดปุ่ม ok เพื่อดำเนินการต่อ!",
            //                         type: 'success',
            //                         padding: '2em'
            //                     }).then(function(then) {
            //                         // location.reload()
            //                         location.href = '/customer/index'
            //                     })
            //                 } else {
            //                     swal({
            //                         title: 'บันทึกไม่สำเร็จ!',
            //                         text: "กดปุ่ม ok เพื่อดำเนินการต่อ!",
            //                         type: 'error',
            //                         padding: '2em'
            //                     })
            //                 }
            //             }).fail(function() {
            //                 swal("Error!", "You clicked the button!", "error");
            //             })

            //         } else {
            //             swal({
            //                 title: 'กรุณากรอกข้อมูลให้ครบถ้วน!',
            //                 text: "กดปุ่ม ok เพื่อดำเนินการต่อ!",
            //                 type: 'error',
            //                 padding: '2em'
            //             })
            //         }
            //         }
            //     });
            // });
        });
    </script>

@endsection
