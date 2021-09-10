@extends('layouts.frontend.navbar')
@section('content')
    <div class="container">

        <div style="margin-bottom:30px;">
            <h1 style="margin:30px 0;" class="main_font">รายละเอียดสินค้า</h1>

            {{-- <div class="card-deck" style="margin-top:30px;margin-bottom:20px;"> --}}
                <div class="row">
                    @foreach ($product as $value)
                    <div class="col-md-4">
                        {{-- <div class="card" style="box-shadow: 0px 0px 10px #007bff;"> --}}
                        <div class="card" style="border: solid 1px #007bff;">
                            <img class="card-img-top" src="{{ url('/upload/store/' . $value->product_img) }}" 
                             alt="Card image cap">
                            <div class="card-body box-bk">
                                <h5 class="card-title" style="text-align: center">{{ $value->product_name }}</h5>
                                <p class="card-text" style="text-align: center">ราคา {{ $value->product_price }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            {{-- </div> --}}
        </div>

    </div>
@endsection
