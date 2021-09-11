@extends('layouts.frontend.navbar')
@section('content')
    <div class="container">

        <div style="margin-bottom:30px;">
            <h1 style="margin:30px 0;" class="main_font">รายละเอียดข่าวสาร</h1>
            {{-- <div class="card-deck" style="margin-top:30px;margin-bottom:20px;">
        
                @foreach ($news as $value)
                <div class="card">
                    <img class="card-img-top" src="{{url('/upload/news/'.$value->new_image)}}" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">
                            @if (strlen($value->new_toppic) > 50)
                            {!!mb_substr($value->new_toppic,0,40,'UTF-8')."..."!!}
                            @else
                            {!!$value->new_toppic!!}
                            @endif
                        </h5>      
                        <a href="{{ url('frontend/news_detail/'.$value->new_id) }}">
                            <button class="btn btn-sm btn-info">ดูรายละเอียด</button>
                        </a>
                    </div>
                </div>
                @endforeach
            </div> --}}

            <div class="row">

                @foreach ($news as $value)
                    <div class="col-md-4">
                        {{-- <div class="card" style="box-shadow: 0px 0px 10px #007bff;"> --}}
                        <div class="card" style="border: solid 1px #007bff;">
                            <img class="card-img-top" src="{{ url('/upload/news/' . $value->new_image) }}"
                                alt="Card image cap" height="200px">
                            <div class="card-body">
                                <hr>
                                <h5 class="card-title">
                                    @if (strlen($value->new_toppic) > 50)
                                        {!! mb_substr($value->new_toppic, 0, 40, 'UTF-8') . '...' !!}
                                    @else
                                        {!! $value->new_toppic !!}
                                    @endif
                                </h5><br>
                                <a href="{{ url('/news_detail/' . $value->new_id) }}">
                                    <button class="btn btn-sm btn-info">ดูรายละเอียด</button>
                                </a>
                            </div>
                            <div class="card-body box-bks">
                                <p class="card-text" style="text-align: center;font-size:16px;">วันที่ : {{ date('d-m-Y', strtotime($value->new_date)) }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>

    </div>
@endsection
