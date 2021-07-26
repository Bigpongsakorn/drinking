@extends('layouts.admin.main')
@section('content')
    <div class="pcoded-content">

        <div class="page-header card">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="fa fa-newspaper-o bg-c-blue"></i>
                        <div class="d-inline">
                            <h5>จัดการข้อมูลการเบิกสินค้า</h5>
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
                                        <h5>ข้อมูลการเบิกสินค้า</h5>
                                    </div>
                                    <div style="margin:auto">
                                        <button class="btn btn-sm btn-info btn-all">ทั้งหมด</button>
                                        <button class="btn btn-sm btn-warning btn-pending">รออนุมัติ</button>
                                        <button class="btn btn-sm btn-danger btn-dis">ไม่อนุมัติ</button>
                                        <button class="btn btn-sm btn-success btn-approve">อนุมัติ</button>
                                        <button class="btn btn-sm btn-fin" style="color: #fff; background: #218838;" >ขนของขึ้นรถ</button>
                                    </div>
                                    <div class="card-block">
                                        <div class="table-responsive dt-responsive">
                                            <table id="multi-colum-dt" class="table table-striped table-bordered nowrap">
                                                <thead>
                                                    <tr style="text-align: center;">
                                                        <th>รหัสทำรายการ</th>
                                                        <th>ข้อมูลเบิกสินค้า</th>
                                                        <th>วันที่</th>
                                                        <th>ชื่อผู้เบิก</th>
                                                        <th>รายละเอียด</th>
                                                        <th>การอนุมัติ</th>
                                                        <th>แก้ไข / ลบ</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="table-all">
                                                    @php $i = 1 @endphp
                                                    @foreach ($with as $value)
                                                        <tr>
                                                            <td style="text-align: center;">
                                                                {{ sprintf('%05d', $value->withdraw_p_id) }}</td>
                                                            <td>
                                                                {{ $value->withdraw_p_name }}
                                                            </td>
                                                            <td style="text-align: center;">
                                                                {{ date('d-m-Y H:i:s', strtotime($value->withdraw_p_date)) }}
                                                            </td>
                                                            <td style="text-align: center;">
                                                                {{ $value->emp_firstname }} {{ $value->emp_lastname }}
                                                            </td>
                                                            <td style="text-align: center;">
                                                                <a
                                                                    href="{{ url('/withdraw/withdraw_detail/' . $value->withdraw_p_id) }}">
                                                                    <button class="btn btn-sm btn-primary">
                                                                        รายละเอียด
                                                                    </button>
                                                                </a>
                                                            </td>
                                                            <td style="text-align: center;">
                                                                @if ($value->withdraw_p_status == 0)
                                                                    <button type="button" data-toggle="modal"
                                                                        data-target="#exampleModal"
                                                                        data-withdraw_p_id="{{ $value->withdraw_p_id }}"
                                                                        data-withdraw_p_status="{{ $value->withdraw_p_status }}"
                                                                        data-withdraw_p_status_detail="{{ $value->withdraw_p_status_detail }}"
                                                                        class="btn btn-sm btn-warning open_modal">รออนุมัติ</button>
                                                                @elseif($value->withdraw_p_status == 1)
                                                                    <button type="button" data-toggle="modal"
                                                                        data-target="#exampleModal"
                                                                        data-withdraw_p_id="{{ $value->withdraw_p_id }}"
                                                                        data-withdraw_p_status="{{ $value->withdraw_p_status }}"
                                                                        data-withdraw_p_status_detail="{{ $value->withdraw_p_status_detail }}"
                                                                        class="btn btn-sm btn-danger open_modal">ไม่อนุมัติ</button>
                                                                @elseif($value->withdraw_p_status == 2)
                                                                    <button type="button" data-toggle="modal"
                                                                        data-target="#exampleModal2"
                                                                        data-withdraw_p_id="{{ $value->withdraw_p_id }}"
                                                                        data-withdraw_p_status="{{ $value->withdraw_p_status }}"
                                                                        data-w_emp_id="{{ $value->w_emp_id }}"
                                                                        class="btn btn-sm btn-success open_modal">อนุมัติ</button>
                                                                @else
                                                                    <button type="button"
                                                                        style="color: #fff; background: #218838;"
                                                                        class="btn btn-sm open_modal">ขนของขึ้นรถ</button>
                                                                @endif
                                                            </td>
                                                            @if ($value->withdraw_p_status == 2 || $value->withdraw_p_status == 3)
                                                                <td style="text-align: center;">
                                                                    <button class="btn btn-sm btn-secondary">edit</button>
                                                                    <button class="btn btn-sm btn-secondary">
                                                                        delete
                                                                    </button>
                                                                </td>
                                                            @else
                                                                <td style="text-align: center;">
                                                                    <a
                                                                        href="{{ url('/withdraw/withdraw_edit/' . $value->withdraw_p_id) }}">
                                                                        <button class="btn btn-sm btn-primary">edit</button>
                                                                    </a>
                                                                    <a href="javascript:void(0);" class="delete"
                                                                        data-id="{{ $value->withdraw_p_id }}">
                                                                        <button class="btn btn-sm btn-danger">
                                                                            delete
                                                                        </button>
                                                                    </a>
                                                                </td>
                                                            @endif
                                                        </tr>
                                                        @php $i++ @endphp
                                                    @endforeach
                                                </tbody>
                                                <tbody class="table-pending">
                                                    @php $i = 1 @endphp
                                                    @foreach ($pending as $value)
                                                        <tr>
                                                            <td style="text-align: center;">
                                                                {{ sprintf('%05d', $value->withdraw_p_id) }}</td>
                                                            <td>
                                                                {{ $value->withdraw_p_name }}
                                                            </td>
                                                            <td style="text-align: center;">
                                                                {{ date('d-m-Y H:i:s', strtotime($value->withdraw_p_date)) }}
                                                            </td>
                                                            <td style="text-align: center;">
                                                                {{ $value->emp_firstname }} {{ $value->emp_lastname }}
                                                            </td>
                                                            <td style="text-align: center;">
                                                                <a
                                                                    href="{{ url('/withdraw/withdraw_detail/' . $value->withdraw_p_id) }}">
                                                                    <button class="btn btn-sm btn-primary">
                                                                        รายละเอียด
                                                                    </button>
                                                                </a>
                                                            </td>
                                                            <td style="text-align: center;">
                                                                @if ($value->withdraw_p_status == 0)
                                                                    <button type="button" data-toggle="modal"
                                                                        data-target="#exampleModal"
                                                                        data-withdraw_p_id="{{ $value->withdraw_p_id }}"
                                                                        data-withdraw_p_status="{{ $value->withdraw_p_status }}"
                                                                        data-withdraw_p_status_detail="{{ $value->withdraw_p_status_detail }}"
                                                                        class="btn btn-sm btn-warning open_modal">รออนุมัติ</button>
                                                                @elseif($value->withdraw_p_status == 1)
                                                                    <button type="button" data-toggle="modal"
                                                                        data-target="#exampleModal"
                                                                        data-withdraw_p_id="{{ $value->withdraw_p_id }}"
                                                                        data-withdraw_p_status="{{ $value->withdraw_p_status }}"
                                                                        data-withdraw_p_status_detail="{{ $value->withdraw_p_status_detail }}"
                                                                        class="btn btn-sm btn-danger open_modal">ไม่อนุมัติ</button>
                                                                @elseif($value->withdraw_p_status == 2)
                                                                    <button type="button" data-toggle="modal"
                                                                        data-target="#exampleModal2"
                                                                        data-withdraw_p_id="{{ $value->withdraw_p_id }}"
                                                                        data-withdraw_p_status="{{ $value->withdraw_p_status }}"
                                                                        data-w_emp_id="{{ $value->w_emp_id }}"
                                                                        class="btn btn-sm btn-success open_modal">อนุมัติ</button>
                                                                @else
                                                                    <button type="button"
                                                                        style="color: #fff; background: #218838;"
                                                                        class="btn btn-sm open_modal">ขนของขึ้นรถ</button>
                                                                @endif
                                                            </td>
                                                            @if ($value->withdraw_p_status == 2 || $value->withdraw_p_status == 3)
                                                                <td style="text-align: center;">
                                                                    <button class="btn btn-sm btn-secondary">edit</button>
                                                                    <button class="btn btn-sm btn-secondary">
                                                                        delete
                                                                    </button>
                                                                </td>
                                                            @else
                                                                <td style="text-align: center;">
                                                                    <a
                                                                        href="{{ url('/withdraw/withdraw_edit/' . $value->withdraw_p_id) }}">
                                                                        <button class="btn btn-sm btn-primary">edit</button>
                                                                    </a>
                                                                    <a href="javascript:void(0);" class="delete"
                                                                        data-id="{{ $value->withdraw_p_id }}">
                                                                        <button class="btn btn-sm btn-danger">
                                                                            delete
                                                                        </button>
                                                                    </a>
                                                                </td>
                                                            @endif
                                                        </tr>
                                                        @php $i++ @endphp
                                                    @endforeach
                                                </tbody>
                                                <tbody class="table-dis">
                                                    @php $i = 1 @endphp
                                                    @foreach ($dis as $value)
                                                        <tr>
                                                            <td style="text-align: center;">
                                                                {{ sprintf('%05d', $value->withdraw_p_id) }}</td>
                                                            <td>
                                                                {{ $value->withdraw_p_name }}
                                                            </td>
                                                            <td style="text-align: center;">
                                                                {{ date('d-m-Y H:i:s', strtotime($value->withdraw_p_date)) }}
                                                            </td>
                                                            <td style="text-align: center;">
                                                                {{ $value->emp_firstname }} {{ $value->emp_lastname }}
                                                            </td>
                                                            <td style="text-align: center;">
                                                                <a
                                                                    href="{{ url('/withdraw/withdraw_detail/' . $value->withdraw_p_id) }}">
                                                                    <button class="btn btn-sm btn-primary">
                                                                        รายละเอียด
                                                                    </button>
                                                                </a>
                                                            </td>
                                                            <td style="text-align: center;">
                                                                @if ($value->withdraw_p_status == 0)
                                                                    <button type="button" data-toggle="modal"
                                                                        data-target="#exampleModal"
                                                                        data-withdraw_p_id="{{ $value->withdraw_p_id }}"
                                                                        data-withdraw_p_status="{{ $value->withdraw_p_status }}"
                                                                        data-withdraw_p_status_detail="{{ $value->withdraw_p_status_detail }}"
                                                                        class="btn btn-sm btn-warning open_modal">รออนุมัติ</button>
                                                                @elseif($value->withdraw_p_status == 1)
                                                                    <button type="button" data-toggle="modal"
                                                                        data-target="#exampleModal"
                                                                        data-withdraw_p_id="{{ $value->withdraw_p_id }}"
                                                                        data-withdraw_p_status="{{ $value->withdraw_p_status }}"
                                                                        data-withdraw_p_status_detail="{{ $value->withdraw_p_status_detail }}"
                                                                        class="btn btn-sm btn-danger open_modal">ไม่อนุมัติ</button>
                                                                @elseif($value->withdraw_p_status == 2)
                                                                    <button type="button" data-toggle="modal"
                                                                        data-target="#exampleModal2"
                                                                        data-withdraw_p_id="{{ $value->withdraw_p_id }}"
                                                                        data-withdraw_p_status="{{ $value->withdraw_p_status }}"
                                                                        data-w_emp_id="{{ $value->w_emp_id }}"
                                                                        class="btn btn-sm btn-success open_modal">อนุมัติ</button>
                                                                @else
                                                                    <button type="button"
                                                                        style="color: #fff; background: #218838;"
                                                                        class="btn btn-sm open_modal">ขนของขึ้นรถ</button>
                                                                @endif
                                                            </td>
                                                            @if ($value->withdraw_p_status == 2 || $value->withdraw_p_status == 3)
                                                                <td style="text-align: center;">
                                                                    <button class="btn btn-sm btn-secondary">edit</button>
                                                                    <button class="btn btn-sm btn-secondary">
                                                                        delete
                                                                    </button>
                                                                </td>
                                                            @else
                                                                <td style="text-align: center;">
                                                                    <a
                                                                        href="{{ url('/withdraw/withdraw_edit/' . $value->withdraw_p_id) }}">
                                                                        <button class="btn btn-sm btn-primary">edit</button>
                                                                    </a>
                                                                    <a href="javascript:void(0);" class="delete"
                                                                        data-id="{{ $value->withdraw_p_id }}">
                                                                        <button class="btn btn-sm btn-danger">
                                                                            delete
                                                                        </button>
                                                                    </a>
                                                                </td>
                                                            @endif
                                                        </tr>
                                                        @php $i++ @endphp
                                                    @endforeach
                                                </tbody>
                                                <tbody class="table-approve">
                                                    @php $i = 1 @endphp
                                                    @foreach ($approve as $value)
                                                        <tr>
                                                            <td style="text-align: center;">
                                                                {{ sprintf('%05d', $value->withdraw_p_id) }}</td>
                                                            <td>
                                                                {{ $value->withdraw_p_name }}
                                                            </td>
                                                            <td style="text-align: center;">
                                                                {{ date('d-m-Y H:i:s', strtotime($value->withdraw_p_date)) }}
                                                            </td>
                                                            <td style="text-align: center;">
                                                                {{ $value->emp_firstname }} {{ $value->emp_lastname }}
                                                            </td>
                                                            <td style="text-align: center;">
                                                                <a
                                                                    href="{{ url('/withdraw/withdraw_detail/' . $value->withdraw_p_id) }}">
                                                                    <button class="btn btn-sm btn-primary">
                                                                        รายละเอียด
                                                                    </button>
                                                                </a>
                                                            </td>
                                                            <td style="text-align: center;">
                                                                @if ($value->withdraw_p_status == 0)
                                                                    <button type="button" data-toggle="modal"
                                                                        data-target="#exampleModal"
                                                                        data-withdraw_p_id="{{ $value->withdraw_p_id }}"
                                                                        data-withdraw_p_status="{{ $value->withdraw_p_status }}"
                                                                        data-withdraw_p_status_detail="{{ $value->withdraw_p_status_detail }}"
                                                                        class="btn btn-sm btn-warning open_modal">รออนุมัติ</button>
                                                                @elseif($value->withdraw_p_status == 1)
                                                                    <button type="button" data-toggle="modal"
                                                                        data-target="#exampleModal"
                                                                        data-withdraw_p_id="{{ $value->withdraw_p_id }}"
                                                                        data-withdraw_p_status="{{ $value->withdraw_p_status }}"
                                                                        data-withdraw_p_status_detail="{{ $value->withdraw_p_status_detail }}"
                                                                        class="btn btn-sm btn-danger open_modal">ไม่อนุมัติ</button>
                                                                @elseif($value->withdraw_p_status == 2)
                                                                    <button type="button" data-toggle="modal"
                                                                        data-target="#exampleModal2"
                                                                        data-withdraw_p_id="{{ $value->withdraw_p_id }}"
                                                                        data-withdraw_p_status="{{ $value->withdraw_p_status }}"
                                                                        data-w_emp_id="{{ $value->w_emp_id }}"
                                                                        class="btn btn-sm btn-success open_modal">อนุมัติ</button>
                                                                @else
                                                                    <button type="button"
                                                                        style="color: #fff; background: #218838;"
                                                                        class="btn btn-sm open_modal">ขนของขึ้นรถ</button>
                                                                @endif
                                                            </td>
                                                            @if ($value->withdraw_p_status == 2 || $value->withdraw_p_status == 3)
                                                                <td style="text-align: center;">
                                                                    <button class="btn btn-sm btn-secondary">edit</button>
                                                                    <button class="btn btn-sm btn-secondary">
                                                                        delete
                                                                    </button>
                                                                </td>
                                                            @else
                                                                <td style="text-align: center;">
                                                                    <a
                                                                        href="{{ url('/withdraw/withdraw_edit/' . $value->withdraw_p_id) }}">
                                                                        <button class="btn btn-sm btn-primary">edit</button>
                                                                    </a>
                                                                    <a href="javascript:void(0);" class="delete"
                                                                        data-id="{{ $value->withdraw_p_id }}">
                                                                        <button class="btn btn-sm btn-danger">
                                                                            delete
                                                                        </button>
                                                                    </a>
                                                                </td>
                                                            @endif
                                                        </tr>
                                                        @php $i++ @endphp
                                                    @endforeach
                                                </tbody>
                                                <tbody class="table-fin">
                                                    @php $i = 1 @endphp
                                                    @foreach ($fin as $value)
                                                        <tr>
                                                            <td style="text-align: center;">
                                                                {{ sprintf('%05d', $value->withdraw_p_id) }}</td>
                                                            <td>
                                                                {{ $value->withdraw_p_name }}
                                                            </td>
                                                            <td style="text-align: center;">
                                                                {{ date('d-m-Y H:i:s', strtotime($value->withdraw_p_date)) }}
                                                            </td>
                                                            <td style="text-align: center;">
                                                                {{ $value->emp_firstname }} {{ $value->emp_lastname }}
                                                            </td>
                                                            <td style="text-align: center;">
                                                                <a
                                                                    href="{{ url('/withdraw/withdraw_detail/' . $value->withdraw_p_id) }}">
                                                                    <button class="btn btn-sm btn-primary">
                                                                        รายละเอียด
                                                                    </button>
                                                                </a>
                                                            </td>
                                                            <td style="text-align: center;">
                                                                @if ($value->withdraw_p_status == 0)
                                                                    <button type="button" data-toggle="modal"
                                                                        data-target="#exampleModal"
                                                                        data-withdraw_p_id="{{ $value->withdraw_p_id }}"
                                                                        data-withdraw_p_status="{{ $value->withdraw_p_status }}"
                                                                        data-withdraw_p_status_detail="{{ $value->withdraw_p_status_detail }}"
                                                                        class="btn btn-sm btn-warning open_modal">รออนุมัติ</button>
                                                                @elseif($value->withdraw_p_status == 1)
                                                                    <button type="button" data-toggle="modal"
                                                                        data-target="#exampleModal"
                                                                        data-withdraw_p_id="{{ $value->withdraw_p_id }}"
                                                                        data-withdraw_p_status="{{ $value->withdraw_p_status }}"
                                                                        data-withdraw_p_status_detail="{{ $value->withdraw_p_status_detail }}"
                                                                        class="btn btn-sm btn-danger open_modal">ไม่อนุมัติ</button>
                                                                @elseif($value->withdraw_p_status == 2)
                                                                    <button type="button" data-toggle="modal"
                                                                        data-target="#exampleModal2"
                                                                        data-withdraw_p_id="{{ $value->withdraw_p_id }}"
                                                                        data-withdraw_p_status="{{ $value->withdraw_p_status }}"
                                                                        data-w_emp_id="{{ $value->w_emp_id }}"
                                                                        class="btn btn-sm btn-success open_modal">อนุมัติ</button>
                                                                @else
                                                                    <button type="button"
                                                                        style="color: #fff; background: #218838;"
                                                                        class="btn btn-sm open_modal">ขนของขึ้นรถ</button>
                                                                @endif
                                                            </td>
                                                            @if ($value->withdraw_p_status == 2 || $value->withdraw_p_status == 3)
                                                                <td style="text-align: center;">
                                                                    <button class="btn btn-sm btn-secondary">edit</button>
                                                                    <button class="btn btn-sm btn-secondary">
                                                                        delete
                                                                    </button>
                                                                </td>
                                                            @else
                                                                <td style="text-align: center;">
                                                                    <a
                                                                        href="{{ url('/withdraw/withdraw_edit/' . $value->withdraw_p_id) }}">
                                                                        <button class="btn btn-sm btn-primary">edit</button>
                                                                    </a>
                                                                    <a href="javascript:void(0);" class="delete"
                                                                        data-id="{{ $value->withdraw_p_id }}">
                                                                        <button class="btn btn-sm btn-danger">
                                                                            delete
                                                                        </button>
                                                                    </a>
                                                                </td>
                                                            @endif
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
                        <input type="hidden" class="withdraw_p_id" name="" value="">
                        <select name="" id="" class="form-control change_status withdraw_p_status">
                            <option value="0">รออนุมัติ</option>
                            <option value="2">อนุมัติ</option>
                            <option value="1">ไม่อนุมัติ</option>
                        </select>
                    </div>
                    <div class="modal-body status_data" style="display: none">
                        <p style="color: red">*หมายเหตุ</p>
                        <input type="text" name="" id="withdraw_p_status_detail" class="form-control status_data_i">
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
                        <input type="hidden" class="withdraw_p_id" name="" value="">
                        <select name="" id="withdraw_p_status2" class="form-control change_emp withdraw_p_status">
                            <option value="2">อนุมัติ</option>
                            <option value="3">ขนของขึ้นรถ</option>
                        </select>
                    </div>
                    <div class="modal-body emp_data" style="display: none">
                        <p>รายชื่อพนักงาน</p>
                        <select name="" id="w_emp_id" class="form-control emp_data_i">
                            <option value="">-- รายชื่อพนักงาน --</option>
                            @foreach ($emp as $item)
                                @if ($item->position_id == 1 || $item->position_id == 2)
                                @else
                                    <option value="{{ $item->emp_id }}">
                                        {{ $item->emp_firstname }} {{ $item->emp_lastname }}
                                    </option>
                                @endif
                            @endforeach
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
@endsection

@section('js')
    <script>
        $(document).ready(function() {

            $('body').on('change', '.change_emp', function() {
                var id = $('.change_emp').val()
                // console.log(id);
                if (id == 2) {
                    $('.emp_data').hide()
                    $('.emp_data_i').val(null)
                }
                if (id == 3) {
                    $('.emp_data').show()
                }
            });

            $('body').on('change', '.change_status', function() {
                var id = $('.change_status').val()
                // console.log(id);
                if (id == 0) {
                    $('.status_data').hide()
                    $('.status_data_i').val(null)
                }
                if (id == 2) {
                    $('.status_data').hide()
                    $('.status_data_i').val(null)
                }
                if (id == 1) {
                    $('.status_data').show()
                }
            });

            $('body').on('click', '.open_modal', function() {
                var withdraw_p_id = $(this).data('withdraw_p_id');
                var withdraw_p_status = $(this).data('withdraw_p_status');
                var withdraw_p_status_detail = $(this).data('withdraw_p_status_detail');
                var w_emp_id = $(this).data('w_emp_id');
                // console.log(withdraw_p_status);
                $('.withdraw_p_id').val(withdraw_p_id)
                $('.withdraw_p_status').val(withdraw_p_status)
                $('#withdraw_p_status_detail').val(withdraw_p_status_detail)
                $('#w_emp_id').val(w_emp_id)
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
                            url: "/withdraw/destroy/" + id,
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

            $('body').on('submit', '#create-product-category2', function(e) {
                e.preventDefault();
                var withdraw_p_id = $('.withdraw_p_id').val()
                var withdraw_p_status = $('#withdraw_p_status2').val()
                var w_emp_id = $('#w_emp_id').val()
                var fd = new FormData();

                console.log(withdraw_p_id);
                console.log(withdraw_p_status);
                console.log("======================2222");
                if (withdraw_p_status) {

                    fd.append('_token', "{{ csrf_token() }}");
                    fd.append('withdraw_p_id', withdraw_p_id);
                    fd.append('withdraw_p_status', withdraw_p_status);
                    fd.append('w_emp_id', w_emp_id);

                    $.ajax({
                        method: "POST",
                        url: "/withdraw/status",
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
                                title: 'จำนวนสินค้าไม่พอเบิก!',
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
                var withdraw_p_id = $('.withdraw_p_id').val()
                var withdraw_p_status = $('.withdraw_p_status').val()
                var withdraw_p_status_detail = $('#withdraw_p_status_detail').val()
                var fd = new FormData();

                console.log(withdraw_p_id);
                console.log(withdraw_p_status);
                console.log("======================");
                if (withdraw_p_status) {

                    fd.append('_token', "{{ csrf_token() }}");
                    fd.append('withdraw_p_id', withdraw_p_id);
                    fd.append('withdraw_p_status', withdraw_p_status);
                    fd.append('withdraw_p_status_detail', withdraw_p_status_detail);

                    $.ajax({
                        method: "POST",
                        url: "/withdraw/status",
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
                                title: 'จำนวนสินค้าไม่พอเบิก!',
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
            $('.table-pending').hide()
            $('.table-dis').hide()
            $('.table-approve').hide()
            $('.table-fin').hide()
            $('.btn-all').click(function() {
                $('.table-all').show()
                $('.table-pending').hide()
                $('.table-dis').hide()
                $('.table-approve').hide()
                $('.table-fin').hide()
            });
            $('.btn-pending').click(function() {
                $('.table-pending').show()
                $('.table-all').hide()
                $('.table-dis').hide()
                $('.table-approve').hide()
                $('.table-fin').hide()
            });
            $('.btn-dis').click(function() {
                $('.table-pending').hide()
                $('.table-all').hide()
                $('.table-pending').hide()
                $('.table-dis').show()
                $('.table-approve').hide()
                $('.table-fin').hide()
            });
            $('.btn-approve').click(function() {
                $('.table-pending').hide()
                $('.table-all').hide()
                $('.table-pending').hide()
                $('.table-dis').hide()
                $('.table-approve').show()
                $('.table-fin').hide()
            });
            $('.btn-fin').click(function() {
                $('.table-pending').hide()
                $('.table-all').hide()
                $('.table-pending').hide()
                $('.table-dis').hide()
                $('.table-approve').hide()
                $('.table-fin').show()
            });
            
        });
    </script>
@endsection
