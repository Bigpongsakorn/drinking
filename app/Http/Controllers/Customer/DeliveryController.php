<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\CustomerProduct;
use App\Models\Delivery;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['page'] = '/delivery';
        $data['customer'] = Customer::get();
        // dd($data);
        return view('delivery.delivery_index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['page'] = '/delivery/create';
        $data['cus'] = Customer::leftjoin('provinces', 'provinces.province_id', 'customer_data.cus_province')
        ->leftjoin('districts', 'districts.district_id', 'customer_data.cus_district')
        ->leftjoin('subdistricts', 'subdistricts.subdistrict_id', 'customer_data.cus_subdistrict')
        // ->where('cus_id',$id)
        ->first();
        $data['product'] = Product::get();
        $data['cus_p'] = CustomerProduct::leftjoin('product_data','product_data.product_id','customer_product.product_id')
        // ->where('cus_id',$id)
        ->get();
        $data['customer'] = Customer::get();
        // dd($data);
        return view('delivery.delivery_create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        try {
            $table = [
                'de_name'=>$request->date,
                'cus_id'=>$request->id,
                'emp_id'=>Auth::user()->emp_id,
                'de_date'=>date('Y-m-d'),
            ];
            // dd($table);
            Delivery::insert($table);

            DB::commit();  
            $return['status'] = 1;
            $return['content'] = 'สำเร็จ';
        } catch (\Throwable $th) {
            DB::rollBack();
            $return['status'] = 0;
            $return['content'] = 'ไม่สำเร็จ' . $th->getMessage();
        }
        return json_encode($return);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function select_customer(Request $request)
    {
        // dd($request);
        $data['cus'] = Customer::leftjoin('provinces', 'provinces.province_id', 'customer_data.cus_province')
        ->leftjoin('districts', 'districts.district_id', 'customer_data.cus_district')
        ->leftjoin('subdistricts', 'subdistricts.subdistrict_id', 'customer_data.cus_subdistrict')
        ->where('customer_data.cus_id', $request->id)->first();

        $data['pro'] = CustomerProduct::leftjoin('product_data','product_data.product_id','customer_product.product_id')
        ->where('cus_id',$request->id)->get();
        // dd($data);
        return json_encode($data);
    }

}
