@extends('layouts.frontend.navbar')
@section('content')
<style>
    .hero-area{
        height: 100vh;
        background-size: cover;
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;
        background-image: url(/drinking/public/upload/water-background2.jpg);
        background-attachment: fixed;
    }
    #h1{
        font-size: 85px;
        color: #ffffff;
        margin-bottom: 330px;
        font-weight: 600;
    }
    body{
        font-family: 'Kanit', sans-serif;
    }
</style>
{{-- <img src="{{url('/upload/water-background2.jpg')}}" width="100%" height="700px"/> --}}

<header class="hero-area th-fullpage" data-parallax="scroll">
        <div class="row">
            <div class="col-md-12">
                <h1 id="h1">อัลดาน้ำดื่ม</h1>
            </div>
        </div>
</header>

<div class="container">
  
    <div style="margin-bottom:30px;">
        <h1 style="margin-top:30px;text-align: center;">ข่าวสาร</h1>
        <div class="card-deck" style="margin-top:30px;margin-bottom:20px;">
    
            @foreach ($news as $value)
            <div class="card">
                <img class="card-img-top" src="{{url('/upload/news/'.$value->new_image)}}" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">
                        @if (strlen($value->new_toppic)>50)
                        {!!mb_substr($value->new_toppic,0,40,'UTF-8')."..."!!}
                        @else
                        {!!$value->new_toppic!!}
                        @endif
                    </h5><br>
                    <a href="{{ url('/news_detail/'.$value->new_id) }}">
                        <button class="btn btn-sm btn-info">ดูรายละเอียด</button>
                    </a>
                </div>
            </div>
            @endforeach
    
            {{-- <div class="card">
              <img class="card-img-top" src="{{url('/upload/news/1631005843.png')}}" alt="Card image cap">
              <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
                <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
              </div>
            </div>
            <div class="card">
              <img class="card-img-top" src="..." alt="Card image cap">
              <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
                <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
              </div>
            </div> --}}
        </div>
        {{-- <div style="text-align:center">
            <a href="{{ url('/news_list') }}">
                <button class="btn btn-primary">ดูข้อมูลเพิ่มเติม</button>
            </a>
        </div> --}}
    </div>
    <hr>
    <div style="margin-bottom:60px;">
        <h1 style="text-align: center;">สินค้า</h1>
        <div class="card-deck" style="margin-top:30px;margin-bottom:20px;">

            @foreach ($product as $value)
            <div class="card">
                <img class="card-img-top" src="{{url('/upload/store/'.$value->product_img)}}" alt="Card image cap">
                <div class="card-body">
                <h5 class="card-title" style="text-align: center">{{ $value->product_name }}</h5>
                <p class="card-text" style="text-align: center">ราคา {{ $value->product_price }}</p>
                </div>
            </div>
            @endforeach
            

            {{-- <div class="card">
                <img class="card-img-top" src="{{url('/upload/store/1627212517.jpg')}}" alt="Card image cap">
                <div class="card-body">
                <h5 class="card-title">ราคา xx.xx</h5>
                <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
                <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                </div>
            </div>
            <div class="card">
                <img class="card-img-top" src="{{url('/upload/store/1627216208.jpg')}}" alt="Card image cap">
                <div class="card-body">
                <h5 class="card-title">ราคา xx.xx</h5>
                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
                <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                </div>
            </div> --}}
        </div>
        {{-- <div style="text-align:center">
            <button class="btn btn-primary">ดูข้อมูลเพิ่มเติม</button>
        </div> --}}
    </div>
    
</div>
@endsection