<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\CustomerProduct;
use App\Models\Product;
use App\Models\ReturnProduct;
use App\Models\Shipment;
use App\Models\ShipmentProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ShipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['page'] = '/shipment';
        $data['user_id'] = Auth::user()->emp_id; // เก็บตัวแปล id ของผู้ใช้งานที่ Login อยู่
        $data["user_type"] = Auth::user()->position_id;
        $data['customer'] = Customer::get();
        $data['ship'] = Shipment::leftJoin('customer_data','customer_data.cus_id','shipment.cus_id')
        ->leftJoin('empolyee','empolyee.emp_id','shipment.emp_id')
        ->orderBy('ship_id','desc')
        ->get();
        $data['ship_pending'] = Shipment::leftJoin('customer_data','customer_data.cus_id','shipment.cus_id')
        ->leftJoin('empolyee','empolyee.emp_id','shipment.emp_id')
        ->where('ship_status','0')
        ->orderBy('ship_id','desc')
        ->get();
        $data['ship_approve'] = Shipment::leftJoin('customer_data','customer_data.cus_id','shipment.cus_id')
        ->leftJoin('empolyee','empolyee.emp_id','shipment.emp_id')
        ->where('ship_status','1')
        ->orderBy('ship_id','desc')
        ->get();
        $data['ship_fin'] = Shipment::leftJoin('customer_data','customer_data.cus_id','shipment.cus_id')
        ->leftJoin('empolyee','empolyee.emp_id','shipment.emp_id')
        ->where('ship_status','2')
        ->orderBy('ship_id','desc')
        ->get();
        // dd($data);
        return view('shipment.shipment_index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['page'] = '/shipment/create';
        // $data['cus'] = Customer::leftjoin('provinces', 'provinces.province_id', 'customer_data.cus_province')
        // ->leftjoin('districts', 'districts.district_id', 'customer_data.cus_district')
        // ->leftjoin('subdistricts', 'subdistricts.subdistrict_id', 'customer_data.cus_subdistrict')
        // // ->where('cus_id',$id)
        // ->first();
        $data['product'] = Product::get();
        $data['cus_p'] = CustomerProduct::leftjoin('product_data','product_data.product_id','customer_product.product_id')
        // ->where('cus_id',$id)
        ->get();
        $data['customer'] = Customer::where('cus_status','!=',1)->get();
        // dd($data);
        return view('shipment.shipment_create', $data);
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
            Shipment::insert($table);

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

    public function insert(Request $request)
    {
        // dd($request);
        try {
            $product_id = explode(",", $request->product_id);
            $product_num = explode(",", $request->product_num);

            // ลบสินค้า
            // for ($id=0; $id < count($product_id); $id++) { 
            //     $pd = Product::where('product_id',$product_id[$id])->first();
            //     // dd($pd->product_total);
            //     if($product_num[$id] > $pd->product_total){
            //         dd("error");
            //     }else{
            //         $p_total = $pd->product_total - $product_num[$id];
            //         $table_p = [
            //             'product_total' => $p_total,
            //         ];
            //         // dd($product_id[$id]);
            //         Product::where('product_id',$product_id[$id])->update($table_p);
            //     }
                
            // }
            
            $table = [
                'cus_id' => $request->cus_id,
                'emp_id'=>Auth::user()->emp_id,
                'ship_date' => $request->ship_date,
                'ship_status' => 0,
                'ship_pay' => 2,
            ];
            // dd($table);  
            $s_id = Shipment::insertGetId($table);
            // $s_id = 1;
            $count = 0;
            foreach ($product_id as $key => $value) {
                $count++;
            }
            for ($i = 0; $i < $count; $i++) {
                $data[] = [
                    'product_id' => $product_id[$i],
                    'product_num' => $product_num[$i],
                    'ship_id' => $s_id,
                ];
            }
            // dd($data);
            ShipmentProduct::insert($data);
            
            for ($i = 0; $i < $count; $i++) {
                $table_return[] = [
                    'rd_status' => '0',
                    'ship_id' => $s_id,
                    'product_id' => $product_id[$i],
                    'product_number' => $product_num[$i],
                ];
            }

            ReturnProduct::insert($table_return);

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
        // dd($id);
        $data['page'] = '/shipment';
        $data['customer'] = Customer::get();
        $data['product'] = Product::get();
        $data['ship'] = Shipment::leftJoin('customer_data','customer_data.cus_id','shipment.cus_id')
        ->leftJoin('empolyee','empolyee.emp_id','shipment.emp_id')
        ->leftjoin('provinces', 'provinces.province_id', 'customer_data.cus_province')
        ->leftjoin('districts', 'districts.district_id', 'customer_data.cus_district')
        ->leftjoin('subdistricts', 'subdistricts.subdistrict_id', 'customer_data.cus_subdistrict')
        ->where('ship_id',$id)
        ->first();
        $data['ship_p'] = ShipmentProduct::leftJoin('product_data','product_data.product_id','shipment_product.product_id')
        ->where('ship_id',$id)->get();
        // dd($data);
        return view('shipment.shipment_detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['page'] = '/shipment/create';
        $data['customer'] = Customer::get();
        $data['product'] = Product::get();
        $data['ship'] = Shipment::leftJoin('customer_data','customer_data.cus_id','shipment.cus_id')
        ->leftJoin('empolyee','empolyee.emp_id','shipment.emp_id')
        ->leftjoin('provinces', 'provinces.province_id', 'customer_data.cus_province')
        ->leftjoin('districts', 'districts.district_id', 'customer_data.cus_district')
        ->leftjoin('subdistricts', 'subdistricts.subdistrict_id', 'customer_data.cus_subdistrict')
        ->where('ship_id',$id)
        ->first();
        $data['ship_p'] = ShipmentProduct::where('ship_id',$id)->get();
        // dd($data);
        return view('shipment.shipment_edit', $data);
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
            $product_id = explode(",", $request->product_id);
            $product_num = explode(",", $request->product_num);

            $table = [
                // 'cus_id' => $request->cus_id,
                // 'emp_id'=>Auth::user()->emp_id,
                'ship_date' => $request->ship_date,
                'ship_status' => 0,
            ];
            // dd($table);
            Shipment::where('ship_id',$request->id)->update($table);
            // $s_id = Shipment::insertGetId($table);
            // $s_id = 1;
            ShipmentProduct::where('ship_id',$request->id)->delete();
            
            $count = 0;
            foreach ($product_id as $key => $value) {
                $count++;
            }
            for ($i = 0; $i < $count; $i++) {
                $data[] = [
                    'product_id' => $product_id[$i],
                    'product_num' => $product_num[$i],
                    'ship_id' => $request->id,
                ];
            }
            ShipmentProduct::insert($data);

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

            Shipment::where('ship_id',$id)->delete();
            ShipmentProduct::where('ship_id',$id)->delete();

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

    public function status(Request $request)
    {
        // dd($request);
        try {
            if($request->ship_status == 2){
                $nono = [
                    'ship_status' => $request->ship_status,
                    // 'ship_note' => $request->ship_note,
                    // 'ship_pay' => $request->ship_pay,
                ];
                Shipment::where('ship_id',$request->ship_id)->update($nono);
            }else{
                $nono = [
                    'ship_status' => $request->ship_status,
                    // 'ship_note' => null,
                    // 'ship_pay' => null,
                ];
                Shipment::where('ship_id',$request->ship_id)->update($nono);
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

    public function price(Request $request)
    {
        // dd($request);
        try {
           
            if($request->ship_pay == 1){
                 //จ่ายเงิน
                //  dd("จ่ายเงิน");
                 if($request->ship_pay_s != null){
                    if($request->ship_pay_s == 1){
                        // dd("จ่ายเงินสด");
                        $table = [
                            'ship_pay' => $request->ship_pay,
                            'ship_pay_s' => $request->ship_pay_s,
                            'ship_note' => $request->ship_note,
                            'ship_price' => null,
                        ];
                        // dd($table);
                        Shipment::where('ship_id',$request->ship_id)->update($table);
                    }else{
                        // dd("จ่ายเงินโอน");
                        if($request->ship_bill != null){

                            $path = public_path() . '/upload/shipment/';
                            $pic = Shipment::select('ship_bill')->where('ship_id', $request->ship_id)->first();

                            if ($pic->ship_bill != null) {
                                $file_old = $path . $pic->ship_bill;
                                unlink($file_old);
                            }
        
                            $file = $request->file('ship_bill');
                            $extension = $file->getClientOriginalExtension();
                            $filename = time() . '.' . $extension;
                            $file->move($path, $filename);
                            $request->news_pic = $filename;
                            $news_pic = $request->news_pic;

                            $table = [
                                'ship_pay' => $request->ship_pay,
                                'ship_pay_s' => $request->ship_pay_s,
                                'ship_bill' => $news_pic,
                                'ship_note' => $request->ship_note,
                                'ship_price' => null,
                            ];
                            // dd($table);
                            Shipment::where('ship_id',$request->ship_id)->update($table);
                        }else{
                            // dd("f");
                            DB::rollBack();
                            $return['status'] = 3;
                            $return['content'] = 'ไม่สำเร็จ';
                            return json_encode($return);
                        }
                    }
                 }else{
                    DB::rollBack();
                    $return['status'] = 3;
                    $return['content'] = 'ไม่สำเร็จ';
                    return json_encode($return);
                 }
            }elseif($request->ship_pay == 3){
                if($request->ship_price != null){
                    $table = [
                        'ship_pay' => $request->ship_pay,
                        'ship_note' => $request->ship_note2,
                        'ship_price' => $request->ship_price,
                    ];
                    Shipment::where('ship_id',$request->ship_id)->update($table);
                }else{
                    DB::rollBack();
                    $return['status'] = 3;
                    $return['content'] = 'ไม่สำเร็จ';
                    return json_encode($return);
                }
            }else{
                //ไม่ได้จ่ายเงิน
                // dd("ไม่ได้จ่ายเงิน");
            $table = [
                'ship_pay' => $request->ship_pay,
                'ship_note' => $request->ship_note,
            ];
            Shipment::where('ship_id',$request->ship_id)->update($table);
            }
            // dd("s");

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
