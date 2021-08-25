<style>
    #map {
        height: 500px;
        width: 100%;
    }
</style>
@extends('layouts.admin.main')
@section('content')
    <div class="pcoded-content">

        <div class="page-header card">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="icon-people bg-c-blue"></i>
                        <div class="d-inline">
                            <h5>จัดการข้อมูลลูกค้า</h5>
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
                                        <h5>ข้อมูลสินค้าของลูกค้า</h5>
                                    </div>
                                    <div class="card-block">
                                        <div class="form-group row">
                                            <div class="col-sm-2"></div>
                                            <div class="col-sm-10">
                                                <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <label class="col-form-label">รหัสลูกค้า : </label>
                                                        <label for="">{{ sprintf('%05d', $cus->cus_id) }}</label>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label class="col-form-label">ชื่อจริง - นามสกุล : </label>
                                                        <label for="">
                                                            @if ($cus->cus_title == 1)
                                                                นาย
                                                            @elseif ($cus->cus_title == 2)
                                                                นาง
                                                            @else
                                                                นางสาว
                                                            @endif {{ $cus->cus_fristname }}
                                                            {{ $cus->cus_lastname }}
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    {{-- <div class="col-sm-6">
                                                        <label class="col-form-label">วันที่จัดส่ง : </label>
                                                        <label for="">{{ $cus->cus_date }}</label>
                                                    </div> --}}
                                                    <div class="col-sm-6">
                                                        <label class="col-form-label">เบอร์โทรศัพท์ : </label>
                                                        <label for="">{{ $cus->cus_phonenumber }}</label>
                                                    </div>
                                                </div>
                                                {{-- <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <label class="col-form-label">ข้อมูลสินค้า : </label>
                                                        @foreach ($cus_p as $item)
                                                            <div>
                                                                <label style="font-weight: bold;">{{ $item->product_name }}</label>
                                                            </div>
                                                        @endforeach
                                                        <div>
                                                            <button type="button" data-target="#exampleModal"
                                                                data-toggle="modal"
                                                                class="btn btn-sm btn-primary">เพิ่มข้อมูลสินค้า</button>
                                                        </div>
                                                    </div>
                                                </div> --}}
                                                <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <label class=" col-form-label">บ้านเลขที่/หมู่บ้าน : </label>
                                                        <label for="">{{ $cus->cus_address }}</label>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <label class="col-form-label">จังหวัด : </label>
                                                        <label for="">{{ $cus->province_name }}</label>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label class="col-form-label">อำเภอ : </label>
                                                        <label for="">{{ $cus->district_name }}</label>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <label class="col-form-label">ตำบล : </label>
                                                        <label for="">{{ $cus->subdistrict_name }}</label>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label class="col-form-label">รหัสไปรษณีย์ : </label>
                                                        <label for="">{{ $cus->cus_zipcode }}</label>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                        <label for="">แผนที่</label>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label for="">lat</label>
                                                        <input type="text" name="" id="lat" class="form-control" value="{{ $cus->cus_lat }}">
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label for="">long</label>
                                                        <input type="text" name="" id="lng" class="form-control"  value="{{ $cus->cus_long }}">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                        <div id="map"></div>
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
            </div>

        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">เลือกสินค้า</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="" id="create-product">
                    <div class="modal-body">
                        <input type="hidden" id="cus_id" name="" value="{{ $cus->cus_id }}">
                        <select name="" id="product_id" class="form-control">
                            <option value="">-- เลือกสินค้า --</option>
                            @foreach ($product as $item)
                                <option value="{{ $item->product_id }}">{{ $item->product_name }}</option>
                            @endforeach
                        </select>
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
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAbQYN8OUJG8hsQuM3vd6wsbzDRQWhedko&callback=initMap&libraries=&v=weekly&channel=2"
    async></script>
    <script>

    var lat = $('#lat').val();
    var lng = $('#lng').val();

    function initMap() {
            console.log(lat);
            console.log(lng);

            if(lat && lng != null){
                var myLatLng = { lat: parseInt(lat), lng: parseInt(lng) }; // เริ่มต้น
            }else{
                var myLatLng = { lat: 18.1937621, lng: 99.3980395 }; // เริ่มต้น
            }
            
            const map = new google.maps.Map(document.getElementById('map'), {
                    center: myLatLng,
                    zoom: 15,
                });
                
            var marker = new google.maps.Marker({
                map:map,
                position: myLatLng,
                // title: "Hello World!",
            });

            google.maps.event.addListener(map,'click',function(event){
                console.log(event.latLng);
                // alert(event.latLng);
                marker.setPosition(event.latLng);
                $("#lat").val(event.latLng.lat());
                $("#lng").val(event.latLng.lng());
            });

        }
        // $(document).ready(function() {
        //     $('body').on('submit', '#create-product', function(e) {
        //         e.preventDefault();
        //         var cus_id = $('#cus_id').val()
        //         var product_id = $('#product_id').val()
        //         var fd = new FormData();

        //         if (product_id) {
        //             fd.append('_token', "{{ csrf_token() }}");
        //             fd.append('cus_id', cus_id);
        //             fd.append('product_id', product_id);

        //             $.ajax({
        //                 method: "POST",
        //                 url: "/customer/insert",
        //                 dataType: 'json',
        //                 cache: false,
        //                 contentType: false,
        //                 processData: false,
        //                 data: fd,
        //             }).done(function(rec) {
        //                 // rec = JSON.parse(rec);
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
        //                 }
        //                 if (rec.status == '0') {
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
        //         }

        //     })
        // });
    </script>
@endsection
