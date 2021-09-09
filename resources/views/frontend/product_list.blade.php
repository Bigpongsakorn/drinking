@extends('layouts.frontend.navbar')
@section('content')
    <div class="container">

        <div style="margin-bottom:30px;">
            <h1 style="margin:70px 0;text-align: center;">รายละเอียดสินค้า</h1>

            {{-- <div class="card-deck" style="margin-top:30px;margin-bottom:20px;"> --}}
                <div class="row">
                    @foreach ($product as $value)
                    <div class="col-md-4">
                        <div class="card">
                            <img class="card-img-top" src="{{ url('/upload/store/' . $value->product_img) }}" 
                             alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title">{{ $value->product_name }}</h5>
                                <p class="card-text">ราคา {{ $value->product_price }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            {{-- </div> --}}
        </div>

    </div>
@endsection
