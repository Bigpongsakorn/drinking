<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Models\District;
use App\Models\Subdistrict;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // return view('home');
        $data['page'] = '/index';
        return view('dashboard.index',$data);
    }
    
     // ======= City =======
    public function province(Request $request)
    {
        $id = $request->id;
        $data['data'] = District::where('province_id', $id)->get();
        // dd($data);
        return json_encode($data);
    }

    public function subdistrict(Request $request)
    {
        $id = $request->id;
        $data['data'] = Subdistrict::where('district_id', $id)->get();
        // dd($data);
        return json_encode($data);
    }
}
