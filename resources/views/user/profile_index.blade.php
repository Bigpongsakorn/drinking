@extends('layouts.admin.main')
@section('content')
<div class="pcoded-content">

    <div class="page-header card">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class=" icon-user bg-c-blue"></i>
                    <div class="d-inline">
                        <h5>จัดารข้อมูลส่วนตัว</h5>
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
                                    <h5>ข้อมูลส่วนตัว</h5>
                                </div>
                                <div class="card-block">
                                    {{-- <form> --}}
                                    <div class="form-group row">
                                        @if($user->emp_image == null)
                                        <img src="{{url('/upload/users/user.png')}}" alt="" style="margin: auto;" width="25%">
                                        @else
                                        <img src="{{url('/upload/users/'.$user->emp_image)}}" alt=""
                                            style="margin: auto;" width="25%">
                                        @endif
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-2"></div>
                                        <div class="col-sm-10">
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <label class="col-form-label">ชื่อผู้ใช้งานระบบ : </label>
                                                    <label for="">{{$user->username}}</label>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-10">
                                                    <label class="col-form-label">ประเภทผู้ใช้งาน : </label>
                                                    <label>
                                                        {{$user->position_name}}
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <label class="col-form-label">เพศ : </label>
                                                    <label class="">
                                                        @if ($user->emp_gender == 1)
                                                        ชาย
                                                        @else
                                                        หญิง
                                                        @endif
                                                    </label>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label class="col-form-label">คำนำหน้า : </label>
                                                    <label class="">
                                                        @if ($user->emp_title == 1)
                                                        นาย
                                                        @elseif ($user->emp_title == 2)
                                                        นาง
                                                        @else
                                                        นางสาว
                                                        @endif
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <label class="col-form-label">ชื่อจริง : </label>
                                                    <label for="">{{$user->emp_firstname}}</label>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label class="col-form-label">นามสกุล : </label>
                                                    <label for="">{{$user->emp_lastname}}</label>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <label class="col-form-label">วันเกิด : </label>
                                                    <label for="">{{date('d-m-Y',strtotime($user->emp_birthdate))}}</label>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label class="col-form-label">หมายเลขบัตรประชาชน</label>
                                                    <label for="">{{$user->emp_id_crad}}</label>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <label class="col-form-label">อีเมล์ : </label>
                                                    <label for="">{{$user->emp_email}}</label>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label class="col-form-label">เบอร์โทรศัพท์</label>
                                                    <label for="">{{$user->emp_phonenumber}}</label>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">บ้านเลขที่/หมู่บ้าน : </label>
                                                <div class="col-sm-8 col-form-label">
                                                    <label for="">{{$user->emp_address}}</label>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <label class="col-form-label">จังหวัด : </label>
                                                    <label for="">{{$user->province_name}}</label>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label class="col-form-label">อำเภอ : </label>
                                                    <label for="">{{$user->district_name}}</label>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <label class="col-form-label">ตำบล : </label>
                                                    <label for="">{{$user->subdistrict_name}}</label>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label class="col-form-label">รหัสไปรษณีย์ : </label>
                                                    <label for="">{{$user->zip_code}}</label>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div style="margin: auto">

                                            <a href="{{url('/user/profile_edit',$user->emp_id)}}">
                                                <button class="btn btn-success btn-form">
                                                    แก้ไขข้อมูล
                                                </button>
                                            </a>

                                        </div>

                                    </div>
                                    {{-- </form> --}}
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- <div id="styleSelector">
        </div> --}}
</div>
</div>
@endsection
