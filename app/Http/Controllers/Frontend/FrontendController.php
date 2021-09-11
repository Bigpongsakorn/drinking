<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['page'] = '/';
        $data['news'] = News::limit(3)->orderBy('new_id','desc')->get();
        $data['product'] = Product::limit(3)->orderBy('product_id','desc')->get();
        // dd($data);
        return view('frontend.index',$data);
    }

    public function news_detail($id)
    {
        $data['page'] = '/news_detail';
        $data['news'] = News::where('new_id',$id)->first();
        return view('frontend.news_detail',$data);
    }

    public function news_list()
    {
        $data['page'] = '/news_list';
        $data['news'] = News::orderBy('new_id','desc')->get();
        return view('frontend.news_list',$data);
    }

    public function product_list()
    {
        $data['page'] = '/product_list';
        $data['product'] = Product::orderBy('product_id','desc')->get();
        return view('frontend.product_list',$data);
    }
    public function contact()
    {
        $data['page'] = '/contact';
        return view('frontend.contact',$data);
    }
}
