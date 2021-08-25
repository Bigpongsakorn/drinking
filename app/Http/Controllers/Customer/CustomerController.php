<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\CustomerProduct;
use App\Models\District;
use App\Models\Product;
use App\Models\Province;
use App\Models\Subdistrict;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['page'] = '/customer';
        $data['customer'] = Customer::get();
        return view('customer.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['page'] = '/customer/create';
        $data['province'] = Province::get();
        return view('customer.create_customer', $data);
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
                'cus_fristname' => $request->fname,
                'cus_lastname' => $request->lname,
                'cus_gender' => $request->gender,
                'cus_date' => $request->date,
                'cus_title' => $request->title,
                'cus_address' => $request->address,
                'cus_province' => $request->province,
                'cus_district' => $request->district,
                'cus_subdistrict' => $request->subdistrict,
                'cus_zipcode' => $request->zipcode,
                'cus_phonenumber' => $request->tel,
                'cus_status' => '0',
                'cus_lat' => $request->lat,
                'cus_long' => $request->lng,
            ];
// dd($table);
            Customer::insert($table);

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
    // public function show()
    // {
    //     return view('customer.map');

    // }

    // public function show_s()
    // {
    //     return view('customer.map_s');

    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['page'] = '/customer/create';
        $data['province'] = Province::get();
        $data['district'] = District::get();
        $data['subistrict'] = Subdistrict::get();
        $data['customer'] = Customer::where('cus_id', $id)->first();
        return view('customer.edit_customer', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // dd($request);
        try {
            $table = [
                'cus_fristname' => $request->fname,
                'cus_lastname' => $request->lname,
                'cus_gender' => $request->gender,
                // 'cus_date' => $request->date,
                'cus_title' => $request->title,
                'cus_address' => $request->address,
                'cus_province' => $request->province,
                'cus_district' => $request->district,
                'cus_subdistrict' => $request->subdistrict,
                'cus_zipcode' => $request->zipcode,
                'cus_phonenumber' => $request->tel,
                'cus_lat' => $request->lat,
                'cus_long' => $request->lng,
            ];

            Customer::where('cus_id', $request->id)->update($table);

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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            Customer::where('cus_id', $id)->delete();

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

    public function product($id)
    {
        $data['page'] = '/customer';
        $data['cus'] = Customer::leftjoin('provinces', 'provinces.province_id', 'customer_data.cus_province')
        ->leftjoin('districts', 'districts.district_id', 'customer_data.cus_district')
        ->leftjoin('subdistricts', 'subdistricts.subdistrict_id', 'customer_data.cus_subdistrict')
        ->where('cus_id',$id)->first();
        $data['product'] = Product::get();
        $data['cus_p'] = CustomerProduct::leftjoin('product_data','product_data.product_id','customer_product.product_id')
        ->where('cus_id',$id)->get();
        // dd($data);
        return view('customer.product_customer', $data);
    }

    public function insertproduct(Request $request)
    {
        // dd($request);
        try {
            $table = [
                'cus_id' => $request->cus_id,
                'product_id' => $request->product_id,
            ];
            // dd($table);
            CustomerProduct::insert($table);

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
    public function status(Request $request)
    {
        // dd($request);
        try {
            if ($request->cus_status == 1) {
                if($request->cus_status_data == null ){
                    $return['status'] = 3;
                    $return['content'] = 'ไม่สำเร็จ';
                    return json_encode($return);
                }else{
                    $table = [
                        'cus_status' => $request->cus_status,
                        'cus_status_data' => $request->cus_status_data,
                    ];
                    Customer::where('cus_id', $request->cus_id)->update($table);
                }
            } else {
                $table = [
                    'cus_status' => $request->cus_status,
                    'cus_status_data' => null,
                ];
                Customer::where('cus_id', $request->cus_id)->update($table);
            }
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
}
