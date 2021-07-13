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
                                        <h5>ข้อมูลรายการผลิต</h5>
                                    </div>
                                    <div style="margin:auto">
                                        <button class="btn btn-sm btn-info btn-all">ทั้งหมด</button>
                                        <button class="btn btn-sm btn-warning btn-pending">รออนุมัติ</button>
                                        <button class="btn btn-sm btn-danger btn-dis">ไม่อนุมัติ</button>
                                        <button class="btn btn-sm btn-secondary btn-approve">อนุมัติการผลิต</button>
                                        <button class="btn btn-sm btn-success btn-finished">ผลิตเสร็จสิ้น</button>
                                    </div>
                                    <div class="card-block">
                                        <div class="table-responsive dt-responsive">
                                            <table id="multi-colum-dt" class="table table-striped table-bordered nowrap">
                                                <thead>
                                                    <tr style="text-align: center;">
                                                        <th>ลำดับ</th>
                                                        <th>รายการผลิต</th>
                                                        <th>วันที่</th>
                                                        <th>ชื่อผู้ทำรายการ</th>
                                                        <th>รายละเอียด</th>
                                                        <th>การอนุมัติ</th>
                                                        <th>แก้ไข / ลบ</th>
                                                        {{-- <th>ลบ</th> --}}
                                                    </tr>
                                                </thead>
                                                <tbody class="table-all">
                                                    @php $i = 1 @endphp
                                                    @foreach ($production as $value)
                                                        <tr>
                                                            <td style="text-align: center;">{{ $i }}</td>
                                                            <td>{{ $value->production_name }}</td>
                                                            <td style="text-align: center;">
                                                                {{ date('d-m-Y', strtotime($value->production_date)) }}
                                                            </td>
                                                            <td style="text-align: center;">{{ $value->emp_firstname }}
                                                                {{ $value->emp_lastname }}</td>
                                                            <td style="text-align: center;">
                                                                <a
                                                                    href="{{ url('/production/production_detail/' . $value->production_group) }}">
                                                                    <button class="btn btn-sm btn-primary">
                                                                        รายละเอียด
                                                                    </button>
                                                                </a>
                                                            </td>
                                                            <td style="text-align: center;">
                                                                @if ($user_type == 1 || $user_type == 2)
                                                                    @if ($value->production_status == 0)
                                                                        <button type="button" data-toggle="modal"
                                                                            data-target="#exampleModal"
                                                                            data-production_group="{{ $value->production_group }}"
                                                                            data-production_status="{{ $value->production_status }}"
                                                                            class="btn btn-sm btn-warning open_modal">รออนุมัติ</button>
                                                                    @elseif($value->production_status == 1)
                                                                        <button type="button" data-toggle="modal"
                                                                            data-target="#exampleModal"
                                                                            data-production_group="{{ $value->production_group }}"
                                                                            data-production_status="{{ $value->production_status }}"
                                                                            class="btn btn-sm btn-danger open_modal">ไม่อนุมัติ</button>
                                                                    @elseif($value->production_status == 2)
                                                                        <button type="button" data-toggle="modal"
                                                                            data-target="#exampleModal2"
                                                                            data-production_group="{{ $value->production_group }}"
                                                                            data-production_status="{{ $value->production_status }}"
                                                                            class="btn btn-sm btn-secondary open_modal">อนุมัติการผลิต</button>
                                                                    @else
                                                                        <button type="button"
                                                                            class="btn btn-sm btn-success">ผลิตเสร็จสิ้น</button>
                                                                    @endif
                                                                @else
                                                                    @if ($value->production_status == 0)
                                                                        <button type="button"
                                                                            class="btn btn-sm btn-warning open_modal">รออนุมัติ</button>
                                                                    @elseif($value->production_status == 1)
                                                                        <button type="button"
                                                                            class="btn btn-sm btn-danger open_modal">ไม่อนุมัติ</button>
                                                                    @elseif($value->production_status == 2)
                                                                        <button type="button" data-toggle="modal"
                                                                            data-target="#exampleModal2"
                                                                            data-production_group="{{ $value->production_group }}"
                                                                            data-production_status="{{ $value->production_status }}"
                                                                            class="btn btn-sm btn-secondary open_modal">อนุมัติการผลิต</button>
                                                                    @else
                                                                        <button type="button"
                                                                            class="btn btn-sm btn-success">ผลิตเสร็จสิ้น</button>
                                                                    @endif
                                                                @endif
                                                            </td>
                                                            @if ($value->production_status == 2 || $value->production_status == 3)
                                                                <td style="text-align: center;">
                                                                    <button class="btn btn-sm btn-secondary">edit</button>
                                                                    <button class="btn btn-sm btn-secondary">
                                                                        delete
                                                                    </button>
                                                                </td>
                                                            @else
                                                                <td style="text-align: center;">
                                                                    <a
                                                                        href="{{ url('/production/production_edit/' . $value->production_group) }}">
                                                                        <button class="btn btn-sm btn-primary">edit</button>
                                                                    </a>
                                                                    <a href="javascript:void(0);" class="delete"
                                                                        data-id="{{ $value->production_group }}">
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
                                                            <td style="text-align: center;">{{ $i }}</td>
                                                            <td>{{ $value->production_name }}</td>
                                                            <td style="text-align: center;">
                                                                {{ date('d-m-Y', strtotime($value->production_date)) }}
                                                            </td>
                                                            <td style="text-align: center;">{{ $value->emp_firstname }}
                                                                {{ $value->emp_lastname }}</td>
                                                            <td style="text-align: center;">
                                                                <a
                                                                    href="{{ url('/production/production_detail/' . $value->production_group) }}">
                                                                    <button class="btn btn-sm btn-primary">
                                                                        รายละเอียด
                                                                    </button>
                                                                </a>
                                                            </td>
                                                            <td style="text-align: center;">
                                                                @if ($user_type == 1 || $user_type == 2)
                                                                    @if ($value->production_status == 0)
                                                                        <button type="button" data-toggle="modal"
                                                                            data-target="#exampleModal"
                                                                            data-production_group="{{ $value->production_group }}"
                                                                            data-production_status="{{ $value->production_status }}"
                                                                            class="btn btn-sm btn-warning open_modal">รออนุมัติ</button>
                                                                    @elseif($value->production_status == 1)
                                                                        <button type="button" data-toggle="modal"
                                                                            data-target="#exampleModal"
                                                                            data-production_group="{{ $value->production_group }}"
                                                                            data-production_status="{{ $value->production_status }}"
                                                                            class="btn btn-sm btn-danger open_modal">ไม่อนุมัติ</button>
                                                                    @elseif($value->production_status == 2)
                                                                        <button type="button" data-toggle="modal"
                                                                            data-target="#exampleModal2"
                                                                            data-production_group="{{ $value->production_group }}"
                                                                            data-production_status="{{ $value->production_status }}"
                                                                            class="btn btn-sm btn-secondary open_modal">อนุมัติการผลิต</button>
                                                                    @else
                                                                        <button type="button"
                                                                            class="btn btn-sm btn-success">ผลิตเสร็จสิ้น</button>
                                                                    @endif
                                                                @else
                                                                    @if ($value->production_status == 0)
                                                                        <button type="button"
                                                                            class="btn btn-sm btn-warning open_modal">รออนุมัติ</button>
                                                                    @elseif($value->production_status == 1)
                                                                        <button type="button"
                                                                            class="btn btn-sm btn-danger open_modal">ไม่อนุมัติ</button>
                                                                    @elseif($value->production_status == 2)
                                                                        <button type="button" data-toggle="modal"
                                                                            data-target="#exampleModal2"
                                                                            data-production_group="{{ $value->production_group }}"
                                                                            data-production_status="{{ $value->production_status }}"
                                                                            class="btn btn-sm btn-secondary open_modal">อนุมัติการผลิต</button>
                                                                    @else
                                                                        <button type="button"
                                                                            class="btn btn-sm btn-success">ผลิตเสร็จสิ้น</button>
                                                                    @endif
                                                                @endif
                                                            </td>
                                                            @if ($value->production_status == 2)
                                                                <td style="text-align: center;">
                                                                    <button class="btn btn-sm btn-secondary">edit</button>
                                                                    <button class="btn btn-sm btn-secondary">
                                                                        delete
                                                                    </button>
                                                                </td>
                                                            @else
                                                                <td style="text-align: center;">
                                                                    <a
                                                                        href="{{ url('/production/production_edit/' . $value->production_group) }}">
                                                                        <button class="btn btn-sm btn-primary">edit</button>
                                                                    </a>
                                                                    <a href="javascript:void(0);" class="delete"
                                                                        data-id="{{ $value->production_group }}">
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
                                                            <td style="text-align: center;">{{ $i }}</td>
                                                            <td>{{ $value->production_name }}</td>
                                                            <td style="text-align: center;">
                                                                {{ date('d-m-Y', strtotime($value->production_date)) }}
                                                            </td>
                                                            <td style="text-align: center;">{{ $value->emp_firstname }}
                                                                {{ $value->emp_lastname }}</td>
                                                            <td style="text-align: center;">
                                                                <a
                                                                    href="{{ url('/production/production_detail/' . $value->production_group) }}">
                                                                    <button class="btn btn-sm btn-primary">
                                                                        รายละเอียด
                                                                    </button>
                                                                </a>
                                                            </td>
                                                            <td style="text-align: center;">
                                                                @if ($user_type == 1 || $user_type == 2)
                                                                    @if ($value->production_status == 0)
                                                                        <button type="button" data-toggle="modal"
                                                                            data-target="#exampleModal"
                                                                            data-production_group="{{ $value->production_group }}"
                                                                            data-production_status="{{ $value->production_status }}"
                                                                            class="btn btn-sm btn-warning open_modal">รออนุมัติ</button>
                                                                    @elseif($value->production_status == 1)
                                                                        <button type="button" data-toggle="modal"
                                                                            data-target="#exampleModal"
                                                                            data-production_group="{{ $value->production_group }}"
                                                                            data-production_status="{{ $value->production_status }}"
                                                                            class="btn btn-sm btn-danger open_modal">ไม่อนุมัติ</button>
                                                                    @elseif($value->production_status == 2)
                                                                        <button type="button" data-toggle="modal"
                                                                            data-target="#exampleModal2"
                                                                            data-production_group="{{ $value->production_group }}"
                                                                            data-production_status="{{ $value->production_status }}"
                                                                            class="btn btn-sm btn-secondary open_modal">อนุมัติการผลิต</button>
                                                                    @else
                                                                        <button type="button"
                                                                            class="btn btn-sm btn-success">ผลิตเสร็จสิ้น</button>
                                                                    @endif
                                                                @else
                                                                    @if ($value->production_status == 0)
                                                                        <button type="button"
                                                                            class="btn btn-sm btn-warning open_modal">รออนุมัติ</button>
                                                                    @elseif($value->production_status == 1)
                                                                        <button type="button"
                                                                            class="btn btn-sm btn-danger open_modal">ไม่อนุมัติ</button>
                                                                    @elseif($value->production_status == 2)
                                                                        <button type="button" data-toggle="modal"
                                                                            data-target="#exampleModal2"
                                                                            data-production_group="{{ $value->production_group }}"
                                                                            data-production_status="{{ $value->production_status }}"
                                                                            class="btn btn-sm btn-secondary open_modal">อนุมัติการผลิต</button>
                                                                    @else
                                                                        <button type="button"
                                                                            class="btn btn-sm btn-success">ผลิตเสร็จสิ้น</button>
                                                                    @endif
                                                                @endif
                                                            </td>
                                                            @if ($value->production_status == 2)
                                                                <td style="text-align: center;">
                                                                    <button class="btn btn-sm btn-secondary">edit</button>
                                                                    <button class="btn btn-sm btn-secondary">
                                                                        delete
                                                                    </button>
                                                                </td>
                                                            @else
                                                                <td style="text-align: center;">
                                                                    <a
                                                                        href="{{ url('/production/production_edit/' . $value->production_group) }}">
                                                                        <button class="btn btn-sm btn-primary">edit</button>
                                                                    </a>
                                                                    <a href="javascript:void(0);" class="delete"
                                                                        data-id="{{ $value->production_group }}">
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
                                                            <td style="text-align: center;">{{ $i }}</td>
                                                            <td>{{ $value->production_name }}</td>
                                                            <td style="text-align: center;">
                                                                {{ date('d-m-Y', strtotime($value->production_date)) }}
                                                            </td>
                                                            <td style="text-align: center;">{{ $value->emp_firstname }}
                                                                {{ $value->emp_lastname }}</td>
                                                            <td style="text-align: center;">
                                                                <a
                                                                    href="{{ url('/production/production_detail/' . $value->production_group) }}">
                                                                    <button class="btn btn-sm btn-primary">
                                                                        รายละเอียด
                                                                    </button>
                                                                </a>
                                                            </td>
                                                            <td style="text-align: center;">
                                                                @if ($user_type == 1 || $user_type == 2)
                                                                    @if ($value->production_status == 0)
                                                                        <button type="button" data-toggle="modal"
                                                                            data-target="#exampleModal"
                                                                            data-production_group="{{ $value->production_group }}"
                                                                            data-production_status="{{ $value->production_status }}"
                                                                            class="btn btn-sm btn-warning open_modal">รออนุมัติ</button>
                                                                    @elseif($value->production_status == 1)
                                                                        <button type="button" data-toggle="modal"
                                                                            data-target="#exampleModal"
                                                                            data-production_group="{{ $value->production_group }}"
                                                                            data-production_status="{{ $value->production_status }}"
                                                                            class="btn btn-sm btn-danger open_modal">ไม่อนุมัติ</button>
                                                                    @elseif($value->production_status == 2)
                                                                        <button type="button" data-toggle="modal"
                                                                            data-target="#exampleModal2"
                                                                            data-production_group="{{ $value->production_group }}"
                                                                            data-production_status="{{ $value->production_status }}"
                                                                            class="btn btn-sm btn-secondary open_modal">อนุมัติการผลิต</button>
                                                                    @else
                                                                        <button type="button"
                                                                            class="btn btn-sm btn-success">ผลิตเสร็จสิ้น</button>
                                                                    @endif
                                                                @else
                                                                    @if ($value->production_status == 0)
                                                                        <button type="button"
                                                                            class="btn btn-sm btn-warning open_modal">รออนุมัติ</button>
                                                                    @elseif($value->production_status == 1)
                                                                        <button type="button"
                                                                            class="btn btn-sm btn-danger open_modal">ไม่อนุมัติ</button>
                                                                    @elseif($value->production_status == 2)
                                                                        <button type="button" data-toggle="modal"
                                                                            data-target="#exampleModal2"
                                                                            data-production_group="{{ $value->production_group }}"
                                                                            data-production_status="{{ $value->production_status }}"
                                                                            class="btn btn-sm btn-secondary open_modal">อนุมัติการผลิต</button>
                                                                    @else
                                                                        <button type="button"
                                                                            class="btn btn-sm btn-success">ผลิตเสร็จสิ้น</button>
                                                                    @endif
                                                                @endif
                                                            </td>
                                                            @if ($value->production_status == 2)
                                                                <td style="text-align: center;">
                                                                    <button class="btn btn-sm btn-secondary">edit</button>
                                                                    <button class="btn btn-sm btn-secondary">
                                                                        delete
                                                                    </button>
                                                                </td>
                                                            @else
                                                                <td style="text-align: center;">
                                                                    <a
                                                                        href="{{ url('/production/production_edit/' . $value->production_group) }}">
                                                                        <button class="btn btn-sm btn-primary">edit</button>
                                                                    </a>
                                                                    <a href="javascript:void(0);" class="delete"
                                                                        data-id="{{ $value->production_group }}">
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
                                                <tbody class="table-finished">
                                                    @php $i = 1 @endphp
                                                    @foreach ($finished as $value)
                                                        <tr>
                                                            <td style="text-align: center;">{{ $i }}</td>
                                                            <td>{{ $value->production_name }}</td>
                                                            <td style="text-align: center;">
                                                                {{ date('d-m-Y', strtotime($value->production_date)) }}
                                                            </td>
                                                            <td style="text-align: center;">{{ $value->emp_firstname }}
                                                                {{ $value->emp_lastname }}</td>
                                                            <td style="text-align: center;">
                                                                <a
                                                                    href="{{ url('/production/production_detail/' . $value->production_group) }}">
                                                                    <button class="btn btn-sm btn-primary">
                                                                        รายละเอียด
                                                                    </button>
                                                                </a>
                                                            </td>
                                                            <td style="text-align: center;">
                                                                @if ($user_type == 1 || $user_type == 2)
                                                                    @if ($value->production_status == 0)
                                                                        <button type="button" data-toggle="modal"
                                                                            data-target="#exampleModal"
                                                                            data-production_group="{{ $value->production_group }}"
                                                                            data-production_status="{{ $value->production_status }}"
                                                                            class="btn btn-sm btn-warning open_modal">รออนุมัติ</button>
                                                                    @elseif($value->production_status == 1)
                                                                        <button type="button" data-toggle="modal"
                                                                            data-target="#exampleModal"
                                                                            data-production_group="{{ $value->production_group }}"
                                                                            data-production_status="{{ $value->production_status }}"
                                                                            class="btn btn-sm btn-danger open_modal">ไม่อนุมัติ</button>
                                                                    @elseif($value->production_status == 2)
                                                                        <button type="button" data-toggle="modal"
                                                                            data-target="#exampleModal2"
                                                                            data-production_group="{{ $value->production_group }}"
                                                                            data-production_status="{{ $value->production_status }}"
                                                                            class="btn btn-sm btn-secondary open_modal">อนุมัติการผลิต</button>
                                                                    @else
                                                                        <button type="button"
                                                                            class="btn btn-sm btn-success">ผลิตเสร็จสิ้น</button>
                                                                    @endif
                                                                @else
                                                                    @if ($value->production_status == 0)
                                                                        <button type="button"
                                                                            class="btn btn-sm btn-warning open_modal">รออนุมัติ</button>
                                                                    @elseif($value->production_status == 1)
                                                                        <button type="button"
                                                                            class="btn btn-sm btn-danger open_modal">ไม่อนุมัติ</button>
                                                                    @elseif($value->production_status == 2)
                                                                        <button type="button" data-toggle="modal"
                                                                            data-target="#exampleModal2"
                                                                            data-production_group="{{ $value->production_group }}"
                                                                            data-production_status="{{ $value->production_status }}"
                                                                            class="btn btn-sm btn-secondary open_modal">อนุมัติการผลิต</button>
                                                                    @else
                                                                        <button type="button"
                                                                            class="btn btn-sm btn-success">ผลิตเสร็จสิ้น</button>
                                                                    @endif
                                                                @endif
                                                            </td>
                                                            @if ($value->production_status == 2 || $value->production_status == 3)
                                                                <td style="text-align: center;">
                                                                    <button class="btn btn-sm btn-secondary">edit</button>
                                                                    <button class="btn btn-sm btn-secondary">
                                                                        delete
                                                                    </button>
                                                                </td>
                                                            @else
                                                                <td style="text-align: center;">
                                                                    <a
                                                                        href="{{ url('/production/production_edit/' . $value->production_group) }}">
                                                                        <button class="btn btn-sm btn-primary">edit</button>
                                                                    </a>
                                                                    <a href="javascript:void(0);" class="delete"
                                                                        data-id="{{ $value->production_group }}">
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
                        <input type="hidden" id="production_group" name="" value="">
                        <select name="production_status" id="production_status" class="form-control">
                            <option value="0">รออนุมัติ</option>
                            <option value="2">อนุมัติการผลิต</option>
                            <option value="1">ไม่อนุมัติ</option>
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
                    <h5 class="modal-title" id="exampleModalLabel">การอนุมัติการผลิต</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="" id="create-product-category2">
                    <div class="modal-body">
                        <input type="hidden" id="production_group" name="" value="">
                        <select name="production_status2" id="production_status2" class="form-control">
                            <option value="2">อนุมัติการผลิต</option>
                            <option value="3">ผลิตเสร็จสิ้น</option>
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

            $('body').on('click', '.open_modal', function() {
                var production_group = $(this).data('production_group');
                var production_status = $(this).data('production_status');

                $('#production_group').val(production_group)
                $('#production_status').val(production_status)
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
                            url: "/production/destroy/" + id,
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

            $('body').on('submit', '#create-product-category', function(e) {
                e.preventDefault();
                var production_group = $('#production_group').val()
                var production_status = $('.production_status').val()
                var fd = new FormData();

                if (production_status) {

                    fd.append('_token', "{{ csrf_token() }}");
                    fd.append('production_group', production_group);
                    fd.append('production_status', production_status);

                    $.ajax({
                        method: "POST",
                        url: "/production/status",
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
                                title: 'วัตถุดิบไม่พอผลิต!',
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
                var production_group = $('#production_group').val()
                var production_status = $('#production_status2').val()
                var fd = new FormData();

                if (production_status) {

                    fd.append('_token', "{{ csrf_token() }}");
                    fd.append('production_group', production_group);
                    fd.append('production_status', production_status);

                    $.ajax({
                        method: "POST",
                        url: "/production/status",
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
                                title: 'วัตถุดิบไม่พอผลิต!',
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
            $('.table-finished').hide()
            $('.btn-all').click(function() {
                $('.table-all').show()
                $('.table-pending').hide()
                $('.table-dis').hide()
                $('.table-approve').hide()
                $('.table-finished').hide()
            });
            $('.btn-pending').click(function() {
                $('.table-pending').show()
                $('.table-all').hide()
                $('.table-dis').hide()
                $('.table-approve').hide()
                $('.table-finished').hide()
            });
            $('.btn-dis').click(function() {
                $('.table-pending').hide()
                $('.table-all').hide()
                $('.table-pending').hide()
                $('.table-dis').show()
                $('.table-approve').hide()
                $('.table-finished').hide()
            });
            $('.btn-approve').click(function() {
                $('.table-pending').hide()
                $('.table-all').hide()
                $('.table-pending').hide()
                $('.table-dis').hide()
                $('.table-approve').show()
                $('.table-finished').hide()
            });
            $('.btn-finished').click(function() {
                $('.table-pending').hide()
                $('.table-all').hide()
                $('.table-pending').hide()
                $('.table-dis').hide()
                $('.table-approve').hide()
                $('.table-finished').show()
            });
        });
    </script>
@endsection
