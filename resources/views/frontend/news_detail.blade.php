@extends('layouts.frontend.navbar')
@section('content')
    {{-- <img src="{{url('/upload/water-background2.jpg')}}" width="100%" height="700px"/> --}}
    <div class="container"> 
        <span style="margin: 50% 0">
            <h1 style="margin-top:30px;text-align: center;">ข่าวสาร</h1>
        </span>

        <div class="row" style="margin: 25px 0">
            <div class="col-md-7 mb-4">
                <img src="{{url('/upload/news/'.$news->new_image)}}" width="100%"/>
            </div>
            <br>
            <div class="col-sm-5">
                <h1>{{ $news->new_toppic }}</h1>
                <p>{{ $news->new_detail }}</p>
            </div>
        </div>

    </div>
@endsection