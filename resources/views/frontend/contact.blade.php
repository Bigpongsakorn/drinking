@extends('layouts.frontend.navbar')
@section('content')
    <div class="container">
        <h1 style="margin:30px 0;" class="main_font" >ข้อมูลติดต่อ</h1>
        <div class="row">
            <div class="col-md-7 mb-4">
                <div class="card card-cascade narrower">
                    <div class="row">
                        <div class="col-sm-12">
                            <div id="map"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-5">
                <br>
                <div class="contact">
                    <h4>เบอร์โทร : 0812345678</h4>
                    <h4>ที่อยู่ : เลขที่ 30 ตำบลนาแก้ว อำเภอเกาะคา จังหวัดลำปาง 52130</h4>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')

<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAbQYN8OUJG8hsQuM3vd6wsbzDRQWhedko&callback=initMap&libraries=&v=weekly&channel=2"
    async></script>

<script>
function initMap() {
            const myLatLng = { lat: 18.15617185952577, lng: 99.37638953370593 }; // เริ่มต้น
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
</script>

@endsection