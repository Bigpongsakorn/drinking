<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Material;
use App\Models\Material_Product;
use App\Models\Product;
use App\Models\ReturnMaterial;
use App\Models\ReturnProduct;
use App\Models\Shipment;
use App\Models\ShipmentProduct;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReturnController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['page'] = '/return';
        $data['customer'] = Customer::where('cus_status','!=','1')->get();

        // $data['customer'] = Customer::leftJoin('shipment','shipment.cus_id','customer_data.cus_id')
        // ->leftJoin('return_product','return_product.ship_id','shipment.ship_id')

        // ->groupBy('return_product.rd_status')
        // // ->groupBy('cus_status')
        // ->groupBy('customer_data.cus_id')
        // ->groupBy('customer_data.cus_fristname')
        // ->groupBy('customer_data.cus_lastname')
        // ->groupBy('customer_data.cus_phonenumber')
        // ->groupBy('shipment.cus_id')
        // ->select(
        //     'return_product.rd_status',
        //     // 'cus_status',
        //     'customer_data.cus_id as cus_id_c',
        //     'customer_data.cus_fristname',
        //     'customer_data.cus_lastname',
        //     'customer_data.cus_phonenumber',
        //     'shipment.cus_id as cus_id_s')
        // // ->selectRaw('customer_data.cus_id as cus_id_c,customer_data.*,shipment.*,return_product.*')
        // ->where('cus_status','!=','1')
        // ->get();

        return view('return.return_index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['page'] = '/return';
        $data['customer'] = Customer::get();
        $data['product'] = Product::get();
        // $data['return'] = ReturnProduct::get();
        
        $data['ship'] = Customer::leftJoin('shipment','shipment.cus_id','customer_data.cus_id')
        // ->leftJoin('empolyee','empolyee.emp_id','shipment.emp_id')
        ->leftjoin('provinces', 'provinces.province_id', 'customer_data.cus_province')
        ->leftjoin('districts', 'districts.district_id', 'customer_data.cus_district')
        ->leftjoin('subdistricts', 'subdistricts.subdistrict_id', 'customer_data.cus_subdistrict')
        ->selectRaw('customer_data.cus_id as c_cus_id,customer_data.*,provinces.*,districts.*,subdistricts.*,shipment.*')
        ->where('customer_data.cus_id',$id)
        ->first();
        
        // $data['ship_data'] = Shipment::where('shipment.cus_id',$id)
        // ->where('ship_status','2')
        // ->orderBy('ship_id','desc')
        // ->get();

        $data['ship_data'] = Shipment::leftJoin('return_product','return_product.ship_id','shipment.ship_id')
        ->where('shipment.cus_id',$id)
        ->where('ship_status','2')
        ->orderBy('shipment.ship_id','desc')
        ->groupBy('return_product.ship_id')->groupBy('rd_status')->groupBy('ship_date')
        ->groupBy('ship_pay')->groupBy('ship_note')->groupBy('shipment.ship_id')
        ->groupBy('shipment.ship_price')->groupBy('shipment.ship_bill')->groupBy('shipment.ship_pay_s')
        ->select('return_product.ship_id as rid','rd_status','ship_date','ship_pay','ship_note','shipment.ship_id as ship_id','ship_price','ship_bill','ship_pay_s')
        ->get();

        // $data['return'] = ReturnProduct::groupBy('return_product.ship_id')
        // ->select('return_product.ship_id as s_r_id')
        // ->get();

        // $data['ship_p'] = ShipmentProduct::leftjoin('shipment','shipment.ship_id','shipment_product.ship_id')
        // ->leftJoin('product_data','product_data.product_id','shipment_product.product_id')
        // ->where('shipment.ship_id','asc')
        // ->get();
        
        // dd($data);
        return view('return.return_detail', $data);
    }

    public function show_p($id)
    {
        // dd($id);
        $data['page'] = '/return';
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
        return view('return.return_product_detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // dd($id);
        $data['page'] = '/return';
        $data['customer'] = Customer::get();
        $data['product'] = Product::get();
        $data['ship'] = Shipment::leftJoin('customer_data','customer_data.cus_id','shipment.cus_id')
        ->leftJoin('empolyee','empolyee.emp_id','shipment.emp_id')
        ->leftjoin('provinces', 'provinces.province_id', 'customer_data.cus_province')
        ->leftjoin('districts', 'districts.district_id', 'customer_data.cus_district')
        ->leftjoin('subdistricts', 'subdistricts.subdistrict_id', 'customer_data.cus_subdistrict')
        ->where('ship_id',$id)
        ->first();

        $data['rd'] = ReturnProduct::where('ship_id',$id)->first();
        $data['return_m'] = ReturnMaterial::leftJoin('material','material.material_id','return_material.material_id')->where('ship_id',$id)->get();
        $data['ship_p'] = ReturnProduct::leftJoin('product_data','product_data.product_id','return_product.product_id')
        ->where('ship_id',$id)->get();

        // dd($data);
        return view('return.return_form', $data);
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
            $rd_id = explode(",", $request->rd_id);
            $material_id = explode(",",$request->material_id);
            $mat_num = explode(",",$request->mat_num);
            $quantity = explode(",",$request->quantity);

            // $sum_m = $quantity - $mat_num;
// dd($quantity);
            // foreach ($rd_id as $key => $value) {
            //     $vvv = ReturnProduct::where('rd_id',$value)->first();
            //     // dd($vvv);
            //     foreach ($product_num as $key => $nnn) {
            //         // dd($nnn);
            //         // dd($vvv->product_number);
            //         if($nnn == $vvv->product_number){
            //             $status = "1";
            //         }else{
            //             $status = "2";
            //         }
            //     }
            // }
            
            foreach ($product_num as $key => $ttt) {
                // dd($ttt);
                if ($ttt == null) {
                    $return['status'] = 3;
                    $return['content'] = 'ไม่สำเร็จ';
                    return json_encode($return);
                }
            }
            foreach ($mat_num as $key => $ttt) {
                // dd($ttt);
                if ($ttt == null) {
                    $return['status'] = 3;
                    $return['content'] = 'ไม่สำเร็จ';
                    return json_encode($return);
                }
            }

            if($request->select_p == 2){

                for ($i=0; $i < count($material_id) ; $i++) { 
                    $mat = Material::where('material_id',$material_id[$i])->first();
                    $total_mat = $mat_num[$i] + $mat->material_remaining;
                    $table_m = [
                        'material_remaining' => $total_mat,
                    ];
                    // dd($table_m);
                    Material::where('material_id',$material_id[$i])->update($table_m);

                    $rm = ReturnMaterial::where('ship_id',$request->id)->where('material_id',$material_id[$i])->get();
                    // dd($rm);
                    if(count($rm)){
                        // dd("มีข้อมูล");
                        foreach ($rm as $key => $value) {
                            // dd($value);
                            // foreach ($mat_num as $key => $value_m) {
                                // dd($value_m);
                                $sum[] = $value->material_num - $mat_num[$i];
                            // }
                            // dd($sum);
                        }
                        // dd($quantity);
                        // dd($mat_num);
                        // $sum = $quantity[$i] - $mat_num[$i];
                        // dd($sum);
                        $table_rm[] = [
                            'rm_date' => Carbon::now(),
                            'material_id' => $material_id[$i],
                            'material_num' => $sum[$i],
                            'ship_id' => $request->id,
                            'emp_id' => Auth::user()->emp_id,
                        ];
                    }else{
                        // dd("ไม่มีข้อมูล");
                        $sum_m = $quantity[$i] - $mat_num[$i];
                        // dd($sum_m);
                        $table_rm[] = [
                            'rm_date' => Carbon::now(),
                            'material_id' => $material_id[$i],
                            'material_num' => $sum_m,
                            'ship_id' => $request->id,
                            'emp_id' => Auth::user()->emp_id,
                        ];
                    }
                    
                }
                // dd($table_rm);
                ReturnMaterial::where('ship_id',$request->id)->delete();
                foreach ($table_rm as $key => $table_v) {
                    ReturnMaterial::insert($table_v);
                }
            }else{
                for ($i=0; $i < count($material_id) ; $i++) { 
                    $mat = Material::where('material_id',$material_id[$i])->first();
                    $total_mat = $mat_num[$i] + $mat->material_remaining;
                    $table_m = [
                        'material_remaining' => $total_mat,
                    ];
                    // dd($table_m);
                    Material::where('material_id',$material_id[$i])->update($table_m);

                    $rm = ReturnMaterial::where('ship_id',$request->id)->where('material_id',$material_id[$i])->get();
                    // dd($rm);
                    if(count($rm)){
                        // dd("มีข้อมูล");
                        foreach ($rm as $key => $value) {
                            // dd($value);
                            // foreach ($mat_num as $key => $value_m) {
                                // dd($value_m);
                                $sum[] = $value->material_num - $mat_num[$i];
                            // }
                            // dd($sum);
                        }
                        // dd($quantity);
                        // dd($mat_num);
                        // $sum = $quantity[$i] - $mat_num[$i];
                        // dd($sum);
                        $table_rm[] = [
                            'rm_date' => Carbon::now(),
                            'material_id' => $material_id[$i],
                            'material_num' => $sum[$i],
                            'ship_id' => $request->id,
                            'emp_id' => Auth::user()->emp_id,
                        ];
                    }else{
                        // dd("ไม่มีข้อมูล");
                        $sum_m = $quantity[$i] - $mat_num[$i];
                        // dd($sum_m);
                        $table_rm[] = [
                            'rm_date' => Carbon::now(),
                            'material_id' => $material_id[$i],
                            'material_num' => $sum_m,
                            'ship_id' => $request->id,
                            'emp_id' => Auth::user()->emp_id,
                        ];
                    }
                }
                
                ReturnMaterial::where('ship_id',$request->id)->delete();
                foreach ($table_rm as $key => $table_v) {
                    ReturnMaterial::insert($table_v);
                }
            }

            for ($i=0; $i < count($product_num); $i++) { 
                $rd_p = ReturnProduct::where('rd_id',$rd_id[$i])->first();
                $product_num1 = $rd_p->product_number -  $product_num[$i];
                // dd($rd_p->product_number);
                $table[] = [
                    'product_id' => $product_id[$i],
                    'product_number' => $product_num1,
                    'ship_id' => $request->id,
                    'rd_status' => $request->select_p,
                    // 'rd_status' => $status,
                    'rd_note' => $request->rd_note,
                    'emp_id' => Auth::user()->emp_id,
                    'rd_date' => Carbon::now(),
                ];
            }
                // dd($table);
                // dd($request->id);
            ReturnProduct::where('ship_id',$request->id)->delete();
            foreach ($table as $key => $table_d) {
                ReturnProduct::insert($table_d);
            }

            // เพิ่มสินค้า
            // for ($id=0; $id < count($product_id); $id++) { 
            //     $pd = Product::where('product_id',$product_id[$id])->first();
            //     // dd($pd->product_total);
            //     $p_total = $product_num[$id] + $pd->product_total;
            //     $table_p = [
            //         'product_total' => $p_total,
            //     ];
            //     // dd($table_p);
            //     Product::where('product_id',$product_id[$id])->update($table_p);
                
            // }
                
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
    public function ship_select(Request $request)
    {
        // dd($request);
        $data['ship_p'] = ReturnProduct::leftJoin('product_data','product_data.product_id','return_product.product_id')
        ->where('ship_id',$request->ship_id)
        ->get();

        foreach ($data['ship_p'] as $key => $value) {
            // dd($value->product_id);
            $data['test'] = Product::leftJoin('product_material','product_material.product_id','product_data.product_id')
                ->leftJoin('material','material.material_id','product_material.material_id')
                ->where('product_data.product_id', $value->product_id)
                ->get();
        }
        
        // dd($data['test']);
        return json_encode($data);
    }
}
