<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Order_data;
use App\Models\Order_detail;
use App\Models\Other;
use App\Models\Product;
use App\Models\District;
use App\Models\Province;
use App\Models\Subdistrict;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['page'] = '/order';
        // $data['customer'] = Customer::get();
        // $data['order'] = Order_data::leftJoin('customer_data', 'customer_data.cus_id', 'order_data.cus_id')
        //     ->orderBy('order_data.order_id', 'desc')
        //     ->get();

        $data['order'] = DB::table('order_data')
        ->leftJoin('orderdetail', 'order_data.order_id', 'orderdetail.order_id')
        ->leftJoin('customer_data','customer_data.cus_id','order_data.cus_id')
        ->leftJoin('other','other.order_id','order_data.order_id')
        ->select('order_data.order_id', 
        DB::raw('SUM(orderdetail_pricetotal) as total'),
        // 'order_data.order_name',
        'order_data.order_startdate',
        'order_data.order_status',
        'order_data.order_bill',
        'order_data.order_change',
        'order_data.order_amount',
        'order_data.cus_id',
        'customer_data.cus_fristname',
        'customer_data.cus_lastname',
        'other.o_name',)
        ->groupBy('order_data.order_id')
        // ->groupBy('order_data.order_name')
        ->groupBy('order_data.order_startdate')
        ->groupBy('order_data.order_status')
        ->groupBy('order_data.order_bill')
        ->groupBy('order_data.order_change')
        ->groupBy('order_data.order_amount')
        ->groupBy('order_data.cus_id')
        ->groupBy('customer_data.cus_fristname')
        ->groupBy('customer_data.cus_lastname')
        ->groupBy('other.o_name')
        ->orderBy('order_data.order_id', 'desc')
        ->get();

        $data['pending'] = DB::table('order_data')
        ->leftJoin('orderdetail', 'order_data.order_id', 'orderdetail.order_id')
        ->leftJoin('customer_data','customer_data.cus_id','order_data.cus_id')
        ->leftJoin('other','other.order_id','order_data.order_id')
        ->select('order_data.order_id', 
        DB::raw('SUM(orderdetail_pricetotal) as total'),
        // 'order_data.order_name',
        'order_data.order_startdate',
        'order_data.order_status',
        'order_data.order_bill',
        'order_data.cus_id',
        'customer_data.cus_fristname',
        'customer_data.cus_lastname',
        'other.o_name',)
        ->groupBy('order_data.order_id')
        // ->groupBy('order_data.order_name')
        ->groupBy('order_data.order_startdate')
        ->groupBy('order_data.order_status')
        ->groupBy('order_data.order_bill')
        ->groupBy('order_data.cus_id')
        ->groupBy('customer_data.cus_fristname')
        ->groupBy('customer_data.cus_lastname')
        ->groupBy('other.o_name')
        ->orderBy('order_data.order_id', 'desc')
        ->where('order_data.order_status','0')
        ->get();

        $data['finished'] = DB::table('order_data')
        ->leftJoin('orderdetail', 'order_data.order_id', 'orderdetail.order_id')
        ->leftJoin('customer_data','customer_data.cus_id','order_data.cus_id')
        ->leftJoin('other','other.order_id','order_data.order_id')
        ->select('order_data.order_id', 
        DB::raw('SUM(orderdetail_pricetotal) as total'),
        // 'order_data.order_name',
        'order_data.order_startdate',
        'order_data.order_status',
        'order_data.order_bill',
        'order_data.order_change',
        'order_data.order_amount',
        'order_data.cus_id',
        'customer_data.cus_fristname',
        'customer_data.cus_lastname',
        'other.o_name',)
        ->groupBy('order_data.order_id')
        // ->groupBy('order_data.order_name')
        ->groupBy('order_data.order_startdate')
        ->groupBy('order_data.order_status')
        ->groupBy('order_data.order_bill')
        ->groupBy('order_data.order_change')
        ->groupBy('order_data.order_amount')
        ->groupBy('order_data.cus_id')
        ->groupBy('customer_data.cus_fristname')
        ->groupBy('customer_data.cus_lastname')
        ->groupBy('other.o_name')
        ->orderBy('order_data.order_id', 'desc')
        ->where('order_data.order_status','1')
        ->orwhere('order_data.order_status','2')
        ->get();

        // dd($data);
        return view('order.order_index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['page'] = '/order/create';
        $data['customer'] = Customer::where('cus_status','!=',1)->get();
        $data['province'] = Province::get();
        $data['product'] = Product::get();
        // dd($data);
        return view('order.order_create', $data);
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
            $count = $request->count;
            // $oder_name = $request->oder_name;
            // $order_startdate = $request->order_startdate;
            $cus_id = $request->cus_id;
            $product_id = explode(",", $request->product_id);
            $orderdetail_quantity_total = explode(",", $request->orderdetail_quantity_total); //รายละเอียดการสั่งซื้อ จำนวน ทั้งหมด

            // dd($count);

            foreach ($product_id as $key => $ttt) {
                if (!$ttt) {
                    $return['status'] = 3;
                    $return['content'] = 'กรอกไม่ครบ!';
                    return json_encode($return);
                }
            }

            foreach ($orderdetail_quantity_total as $key => $tttt) {
                if (!$tttt) {
                    $return['status'] = 3;
                    $return['content'] = 'กรอกไม่ครบ!';
                    return json_encode($return);
                }
            }

            if($cus_id == 99){
                if ($request->other_name == null || $request->tel == null || $request->address == null || $request->province == null) {
                    $return['status'] = 3;
                    $return['content'] = 'กรอกไม่ครบ!';
                    return json_encode($return);
                }
            }
// dd("stop");
            foreach ($product_id as $key => $value_pid) {
                $p_ids = Product::where('product_id', $value_pid)->get();
                foreach ($p_ids as $key => $value_id2) {
                    for ($i = 0; $i < $count; $i++) {
                        // dd($values->product_total);
                        if($orderdetail_quantity_total[$i] > $value_id2->product_total){
                            // dd("error");
                            $return['status'] = 4;
                            $return['content'] = 'สินค้าไม่พอ';
                            return json_encode($return);
                        }
                    }
                }
            }

            $table = [
                // 'order_name' => $oder_name,
                // 'order_startdate' => $order_startdate,
                'order_startdate' => Carbon::now(),
                'cus_id' => $cus_id,
                'order_quantity' => $count, //ปริมาณ
                'order_status' => 0,
            ];
            // dd($table);
            $o_id = Order_data::insertGetId($table);
            // $o_id = '1';
            foreach ($product_id as $key => $value11) {

                $p_id = Product::where('product_id', $value11)->get();
                // dd($p_id);
                foreach ($p_id as $keys => $values) {

                    for ($i = 0; $i < $count; $i++) {

                        // dd($values->product_total);
                        // if($orderdetail_quantity_total[$i] > $values->product_total){
                        //     // dd("error");
                        //     $return['status'] = 4;
                        //     $return['content'] = 'สินค้าไม่พอ';
                        //     return json_encode($return);
                        // }
                        // dd("sss");
                        if ($product_id[$i] == $values->product_id) {
                            // dd($values->product_price);
                            $orderdetail_pricetotal = $orderdetail_quantity_total[$i] * $values->product_price;
                            // dd('=>'.$orderdetail_pricetotal);
                            $table1[] = [
                                'product_id' => $product_id[$i], // สินค้า
                                'orderdetail_quantity_total' => $orderdetail_quantity_total[$i], //รายละเอียดการสั่งซื้อ จำนวน ทั้งหมด
                                'order_id' => $o_id, // รายละเอียดใบสั่ง
                                'orderdetail_priceunit' => $values->product_price, //รายละเอียดการสั่งซื้อ ราคาหน่วย
                                'orderdetail_pricetotal' => $orderdetail_pricetotal,
                            ];
                            // dd($table1);
                        }

                    }
                }
            }
            // dd($table1);
            foreach ($table1 as $key => $value) {
                Order_detail::insert($value);
            }
            // other
            if ($request->other_name != null) {
                $other = [
                    'o_name' => $request->other_name,
                    'order_id' => $o_id,
                    'o_phonenumber' => $request->tel,
                    'o_address' => $request->address,
                    'o_province' => $request->province,
                    'o_district' => $request->district,
                    'o_subdistrict' => $request->subdistrict,
                    'o_zipcode' => $request->zipcode,
                ];
                Other::insert($other);
            }

            // dd("stop");
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
        $data['page'] = '/order';
        $data['customer'] = Customer::get();
        $data['product'] = Product::get();
        $data['order_db'] = Order_data::where('order_id', $id)->first();

        $data['other_db'] = Other::leftjoin('provinces', 'provinces.province_id', 'other.o_province')
        ->leftjoin('districts', 'districts.district_id', 'other.o_district')
        ->leftjoin('subdistricts', 'subdistricts.subdistrict_id', 'other.o_subdistrict')
        ->where('order_id',$id)
        ->first();

        $data['customer_db'] = Order_data::leftJoin('customer_data', 'customer_data.cus_id', 'order_data.cus_id')
            // ->leftJoin('other','other.order_id','order_data.order_id')
            ->leftjoin('provinces', 'provinces.province_id', 'customer_data.cus_province')
            ->leftjoin('districts', 'districts.district_id', 'customer_data.cus_district')
            ->leftjoin('subdistricts', 'subdistricts.subdistrict_id', 'customer_data.cus_subdistrict')
            // ->selectRaw('order_data.order_id as oo_id,order_data.*,other.*,customer_data.*')
            ->where('order_data.order_id', $id)
            ->first();

        // $data['order_d'] = Order_detail::groupby('orderdetail_listnumber')->groupby('orderdetail_quantity_total')->groupby('orderdetail_priceunit')->groupby('orderdetail_pricetotal')->groupby('product_id')->groupby('order_id')
        // ->select('orderdetail_listnumber','orderdetail_quantity_total','orderdetail_priceunit','orderdetail_pricetotal','product_id','order_id')
        // ->where('order_id', $id)
        // ->get();
        $data['order_d'] = Order_detail::leftJoin('product_data', 'product_data.product_id', 'orderdetail.product_id')
            ->where('order_id', $id)
            ->get();
        // $data['other'] = Other::leftjoin('order_data', 'order_data.order_id', 'other.order_id')
        //     ->where('order_data.order_id', $id)
        //     ->first();
        $data['sum'] = DB::table('product_data')
            ->leftJoin('orderdetail', 'product_data.product_id', 'orderdetail.product_id')
            ->select('product_data.product_id', DB::raw('SUM(product_data.product_price * orderdetail.orderdetail_quantity_total) as sum'))
            ->groupBy('product_data.product_id')
            ->where('orderdetail.order_id', $id)
            ->get();

        // dd($data);
        return view('order.order_detail', $data);
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
        $data['page'] = '/order/create';
        // $data['customer'] = Customer::get();
        $data['customer'] = Customer::where('cus_status','!=',1)->get();
        $data['product'] = Product::get();
        $data['province'] = Province::get();
        $data['district'] = District::get();
        $data['subistrict'] = Subdistrict::get();
        $data['order_db'] = Order_data::where('order_id', $id)->first();
        
        $data['other_db'] = Other::leftjoin('provinces', 'provinces.province_id', 'other.o_province')
            ->leftjoin('districts', 'districts.district_id', 'other.o_district')
            ->leftjoin('subdistricts', 'subdistricts.subdistrict_id', 'other.o_subdistrict')
            ->where('order_id',$id)
            ->first();

        $data['customer_db'] = Order_data::leftjoin('customer_data', 'customer_data.cus_id', 'order_data.cus_id')
            ->leftjoin('provinces', 'provinces.province_id', 'customer_data.cus_province')
            ->leftjoin('districts', 'districts.district_id', 'customer_data.cus_district')
            ->leftjoin('subdistricts', 'subdistricts.subdistrict_id', 'customer_data.cus_subdistrict')
            ->where('order_data.order_id', $id)->first();

        $data['order_d'] = Order_detail::where('order_id', $id)->get();

        // dd($data);
        return view('order.order_edit', $data);
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
            $count = $request->count;
            // $order_name = $request->order_name;
            // $order_startdate = $request->order_startdate;
            $cus_id = $request->cus_id;
            $product_id = explode(",", $request->product_id);
            $orderdetail_quantity_total = explode(",", $request->orderdetail_quantity_total); //รายละเอียดการสั่งซื้อ จำนวน ทั้งหมด

            foreach ($product_id as $key => $ttt) {
                if (!$ttt) {
                    $return['status'] = 3;
                    $return['content'] = 'กรอกไม่ครบ!';
                    return json_encode($return);
                }
            }

            foreach ($orderdetail_quantity_total as $key => $tttt) {
                if (!$tttt) {
                    $return['status'] = 3;
                    $return['content'] = 'กรอกไม่ครบ!';
                    return json_encode($return);
                }
            }

            if($cus_id == 99){
                if ($request->other_name == null || $request->tel == null || $request->address == null || $request->province == null) {
                    $return['status'] = 3;
                    $return['content'] = 'กรอกไม่ครบ!';
                    return json_encode($return);
                }
            }

            $table = [
                // 'order_name' => $order_name,
                // 'order_startdate' => $order_startdate,
                'order_startdate' => Carbon::now(),
                'cus_id' => $cus_id,
                'order_quantity' => $count, //ปริมาณ
                'order_status' => 0,
            ];
            // dd($table);
            // Order_data::insertGetId($table);
            Order_data::where('order_id', $request->order_id)->update($table);
            Order_detail::where('order_id', $request->order_id)->delete();

            foreach ($product_id as $key => $value11) {

                $p_id = Product::where('product_id', $value11)->get();
                // dd($p_id);
                foreach ($p_id as $keys => $values) {

                    for ($i = 0; $i < $count; $i++) {

                        if($orderdetail_quantity_total[$i] > $values->product_total){
                            // dd("error");
                            $return['status'] = 4;
                            $return['content'] = 'สินค้าไม่พอ';
                            return json_encode($return);
                        }

                        if ($product_id[$i] == $values->product_id) {
                            $orderdetail_pricetotal = $orderdetail_quantity_total[$i] * $values->product_price;
                            $table1[] = [
                                'product_id' => $product_id[$i], // สินค้า
                                'orderdetail_quantity_total' => $orderdetail_quantity_total[$i], //รายละเอียดการสั่งซื้อ จำนวน ทั้งหมด
                                'order_id' => $request->order_id,
                                'orderdetail_priceunit' => $values->product_price, //รายละเอียดการสั่งซื้อ ราคาหน่วย
                                // 'orderdetail_listnumber' => $request->orderdetail_listnumber,
                                'orderdetail_pricetotal' => $orderdetail_pricetotal,
                            ];
                        }

                    }
                }
            }
            // dd($table1);

            foreach ($table1 as $key => $value) {
                Order_detail::insert($value);
            }

            // other
            if ($request->other_name != null) {
                $other = [
                    'o_name' => $request->other_name,
                    'order_id' => $request->order_id,
                    'o_phonenumber' => $request->tel,
                    'o_address' => $request->address,
                    'o_province' => $request->province,
                    'o_district' => $request->district,
                    'o_subdistrict' => $request->subdistrict,
                    'o_zipcode' => $request->zipcode,
                ];
                // Other::insert($other);
                Other::where('order_id', $request->order_id)->update($other);
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
            Order_data::where('order_id', $id)->delete();
            Order_detail::where('order_id', $id)->delete();

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

    public function select_order(Request $request)
    {
        $data['cus'] = Customer::where('cus_id', $request->id)->first();
        return json_encode($data);
    }

    public function status(Request $request)
    {
        // dd($request);
        try {
            if ($request->order_status == 2) {

                if ($request->hasFile('order_bill')) {

                    $path = public_path() . '/upload/slip/';
                    $pic = Order_data::select('order_bill')->where('order_id', $request->order_id)->first();
                    // dd($pic->order_bill);
                    if ($pic->order_bill != null) {
                        $file_old = $path . $pic->order_bill;
                        unlink($file_old);
                    }

                    $file = $request->file('order_bill');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time() . '.' . $extension;
                    $file->move($path, $filename);
                    $request->news_pic = $filename;
                    $news_pic = $request->news_pic;

                    $table = [
                        'order_status' => $request->order_status,
                        'order_bill' => $news_pic,
                    ];
                    // dd($table);
                    Order_data::where('order_id', $request->order_id)->update($table);

                    $oo = Order_detail::where('order_id',$request->order_id)->get();
                    // dd($oo);
                    foreach ($oo as $key => $value) {
                        // dd($value->orderdetail_quantity_total);
                        $idp = Product::where('product_id', $value->product_id)->get();
                        // dd($idp);
                        foreach ($idp as $key => $pid) {
                            // dd($pid->product_total);
                            $total = $pid->product_total - $value->orderdetail_quantity_total;
                            $p_total = [
                                'product_total' => $total,
                            ];
                            // dd($p_total);
                            Product::where('product_id', $value->product_id)->update($p_total);
                        }
                    }

                } else {
                    $return['status'] = 3;
                    $return['content'] = 'ไม่อัพรูป';
                    return json_encode($return);
                }

            } else {
                $oo = Order_detail::where('order_id',$request->order_id)->get();
                // dd($oo);
                foreach ($oo as $key => $value) {
                    // dd($value->orderdetail_quantity_total);
                    $idp = Product::where('product_id', $value->product_id)->get();
                    // dd($idp);
                    foreach ($idp as $key => $pid) {
                        // dd($pid->product_total);
                        $total = $pid->product_total - $value->orderdetail_quantity_total;
                        $p_total = [
                            'product_total' => $total,
                        ];
                        // dd($p_total);
                        Product::where('product_id', $value->product_id)->update($p_total);
                    }
                }
                $table1 = [
                    'order_status' => $request->order_status,
                    'order_change' => $request->ttotal2, //เงินทอน
                    'order_amount' => $request->p_price, //ราคาจ่าย
                ];
                // dd($table1);
                Order_data::where('order_id', $request->order_id)->update($table1);
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

    public function cancel($id)
    {
        // dd($id);
        try {

            $table = [
                'order_status' => '0'
            ];
// dd($table);
            Order_data::where('order_id', $id)->update($table);
            
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
