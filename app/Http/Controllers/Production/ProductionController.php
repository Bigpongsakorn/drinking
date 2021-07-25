<?php

namespace App\Http\Controllers\Production;

use App\Http\Controllers\Controller;
use App\Models\Material;
use App\Models\Material_Product;
use App\Models\Product;
use App\Models\Production;
use App\Models\Production_m;
use App\Models\ProductType;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['page'] = '/production';
        $data['user_id'] = Auth::user()->emp_id; // เก็บตัวแปล id ของผู้ใช้งานที่ Login อยู่
        $data["user_type"] = Auth::user()->position_id;
        $data['production'] = Production::leftjoin('empolyee', 'empolyee.emp_id', 'production_data.emp_id')
            ->groupby('production_group')->groupby('production_date')->groupby('production_status')->groupby('production_name')->groupby('production_data.emp_id')->groupby('emp_firstname')->groupby('emp_lastname')
            ->select('production_group', 'production_date', 'production_status', 'production_name', 'production_data.emp_id', 'emp_firstname', 'emp_lastname')
            ->orderBy('production_id', 'DESC')
            ->get();
        $data['pending'] = Production::leftjoin('empolyee', 'empolyee.emp_id', 'production_data.emp_id')
            ->groupby('production_group')->groupby('production_date')->groupby('production_status')->groupby('production_name')->groupby('production_data.emp_id')->groupby('emp_firstname')->groupby('emp_lastname')
            ->select('production_group', 'production_date', 'production_status', 'production_name', 'production_data.emp_id', 'emp_firstname', 'emp_lastname')
            ->orderBy('production_id', 'DESC')
            ->where('production_status', '0')
            ->get();
        $data['dis'] = Production::leftjoin('empolyee', 'empolyee.emp_id', 'production_data.emp_id')
            ->groupby('production_group')->groupby('production_date')->groupby('production_status')->groupby('production_name')->groupby('production_data.emp_id')->groupby('emp_firstname')->groupby('emp_lastname')
            ->select('production_group', 'production_date', 'production_status', 'production_name', 'production_data.emp_id', 'emp_firstname', 'emp_lastname')
            ->orderBy('production_id', 'DESC')
            ->where('production_status', '1')
            ->get();
        $data['approve'] = Production::leftjoin('empolyee', 'empolyee.emp_id', 'production_data.emp_id')
            ->groupby('production_group')->groupby('production_date')->groupby('production_status')->groupby('production_name')->groupby('production_data.emp_id')->groupby('emp_firstname')->groupby('emp_lastname')
            ->select('production_group', 'production_date', 'production_status', 'production_name', 'production_data.emp_id', 'emp_firstname', 'emp_lastname')
            ->orderBy('production_id', 'DESC')
            ->where('production_status', '2')
            ->get();
        $data['finished'] = Production::leftjoin('empolyee', 'empolyee.emp_id', 'production_data.emp_id')
            ->groupby('production_group')->groupby('production_date')->groupby('production_status')->groupby('production_name')->groupby('production_data.emp_id')->groupby('emp_firstname')->groupby('emp_lastname')
            ->select('production_group', 'production_date', 'production_status', 'production_name', 'production_data.emp_id', 'emp_firstname', 'emp_lastname')
            ->orderBy('production_id', 'DESC')
            ->where('production_status', '3')
            ->get();
        // dd($data);
        return view('production.production_index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['page'] = '/production/create';
        $data['product'] = Product::get();
        $data['unit'] = Unit::get();
        $data['type'] = ProductType::get();
        $data['mat'] = Material::get();
        $data['mat_p'] = Material_Product::get();
        // dd($data);
        return view('production.production_create', $data);
    }

    public function select_product(Request $request)
    {
        // dd($request);
        $data['material_p'] = Material_Product::leftjoin('product_material','product_material.material_id','material_product.material_id')
        ->where('product_id',$request->id)->get();
        return json_encode($data);
    }

    public function calculate(Request $request)
    {
        // dd($request);
        $data['material_p'] = Material_Product::leftjoin('product_material','product_material.material_id','material_product.material_id')
        ->where('product_id',$request->product_id)->get();
        // dd($data['material_p']);
        foreach ($data['material_p'] as $key => $value) {
            // dd($value->mp_quantity);
            $total = $value->mp_quantity * $request->production_number;
            $table[] = [
                'text' => $value->material_name,
                'total' => $total,
                'unit' => $value->material_unit,
            ];
        }
        $returns = $table;
        return json_encode($returns);

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

            $product_id = explode(",", $request->product_id);
            $production_number = explode(",", $request->production_number);
            $count = $request->count;
            $production_name = $request->production_name;
            $production_date = $request->production_date;
            // $material_id = explode(",", $request->material_id);
            $material_id = json_decode($request->material_id);
            // $material_number = explode(",", $request->material_number);
            $material_number = json_decode($request->material_number);
            $count2 = $request->count2;

            foreach ($product_id as $key => $ttt) {
                if (!$ttt) {
                    $return['status'] = 3;
                    $return['content'] = 'ไม่สำเร็จ';
                    return json_encode($return);
                }
            }
            foreach ($production_number as $key => $tttt) {
                if (!$tttt) {
                    $return['status'] = 3;
                    $return['content'] = 'ไม่สำเร็จ';
                    return json_encode($return);
                }
            }

            $id = null;

            for ($i = 0; $i < $count; $i++) {
                $table[] = [
                    'production_number' => $production_number[$i],
                    'product_id' => $product_id[$i],
                    'production_name' => $production_name,
                    'production_date' => $production_date,
                    'production_status' => '0',
                    'emp_id' => Auth::user()->emp_id,
                ];
            }

            // dd($table);

            // $idp = [];
            $ss = 0;
            foreach ($table as $key => $value) {
                // dd($value);
                $idp = Production::insertGetId($value);

                // dd($key);
                for ($i = 0; $i < count($material_number); $i++) {

                    $this_ = $material_number[$i];
                    // dd($material_number[$i]);

                    if ($material_number[$i][0] == $key + 1) {
                        // dd('1');
                        $table2 = [
                            'material_id' => $material_id[$i][1],
                            'production_m_num' => $material_number[$i][1],
                            'production_id' => $idp,
                        ];
                        // dd($table2);
                        Production_m::insert($table2);
                    }

                }

                // for ($i = 0; $i < $count; $i++) {
                //     $table2 = [
                //         'material_id' => $material_id[$i],
                //         'production_m_num' => $material_number[$i],
                //         'production_id' => $idp,
                //     ];
                //     Production_m::insert($table2);
                //     if($i == 1){
                //         dd($table2);

                //     }
                // }
            }
            // dd($ss);

            // for ($i = 0; $i < $count2; $i++) {
            //     $table2[] = [
            //         'material_id' => $material_id[$i],
            //         'production_m_num' => $material_number[$i],
            //         'production_id' => $idp,
            //     ];
            // }
            // foreach($table2 as $key2 => $value2){
            //     // dd($value2);
            //     Production_m::insert($value2);
            // }

            $id = Production::orderby('production_id', 'desc')->first();
            $id = $id->production_id;
            Production::where('production_id', $id)
                ->update(['production_group' => $id]);

            Production::whereNull('production_group')->update(['production_group' => $id]);

            Production_m::whereNull('production_m_group')->update(['production_m_group' => $id]);
// dd("stop");
            // $table = [
            //     'product_id' => $request->product,
            //     'production_number' => $request->number,
            //     'product_t_id' => $request->type,
            //     'unit_id' => $request->unit,
            //     'production_date' => $request->date,
            //     'production_unit' => $request->punit,
            //     'production_status' => 0,
            // ];

            // Production::insertGetId($table);

            DB::commit();
            $return['status'] = 1;
            $return['content'] = 'สำเร็จ';

        } catch (\Throwable $th) {
            // dd($th);
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
        $data['page'] = '/production';
        $data['pro'] = Production::leftjoin('product_data', 'product_data.product_id', 'production_data.product_id')
            ->where('production_group', $id)
            ->get();
        $data['mat'] = Production_m::leftjoin('product_material', 'product_material.material_id', 'production_m_data.material_id')
            ->where('production_m_group', $id)
            ->get();

        $data['sum'] = DB::table('product_data')
        ->leftJoin('production_data','product_data.product_id','production_data.product_id')
        ->select('product_data.product_id',DB::raw('SUM(product_data.product_price * production_data.production_number) as sum'))
        ->groupBy('product_data.product_id')
        ->where('production_data.production_group', $id)
        ->get();

        $data['sumT'] = DB::table('product_material')
        ->leftJoin('production_m_data','product_material.material_id','production_m_data.material_id')
        ->select('product_material.material_id',DB::raw('SUM(product_material.material_price * production_m_data.production_m_num) as sumt'))
        ->groupBy('product_material.material_id')
        ->where('production_m_data.production_m_group', $id)
        ->get();

        // dd($data);
        return view('production.production_detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['page'] = '/production/create';
        $data['pd'] = Production::where('production_group', $id)->orderby('production_id', 'asc')->get();
        $data['pd1'] = Production::where('production_group', $id)->first();
        $data['product'] = Product::get();
        $data['mate'] = Material::get();
        $data['mate1'] = Production_m::leftjoin('production_data', 'production_data.production_id', 'production_m_data.production_id')
            ->where('production_m_group', $id)
            ->get();
        return view('production.production_edit', $data);
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
            Production::where('production_group', $request->production_group)->delete();
            Production_m::where('production_m_group', $request->production_group)->delete();

            $product_id = explode(",", $request->product_id);
            $production_number = explode(",", $request->production_number);
            $count = $request->count;
            $production_name = $request->production_name;
            $production_date = $request->production_date;
            // $material_id = explode(",", $request->material_id);
            $material_id = json_decode($request->material_id);
            // $material_number = explode(",", $request->material_number);
            $material_number = json_decode($request->material_number);
            $count2 = $request->count2;

            foreach ($product_id as $key => $ttt) {
                if (!$ttt) {
                    $return['status'] = 3;
                    $return['content'] = 'ไม่สำเร็จ';
                    return json_encode($return);
                }
            }
            foreach ($production_number as $key => $tttt) {
                if (!$tttt) {
                    $return['status'] = 3;
                    $return['content'] = 'ไม่สำเร็จ';
                    return json_encode($return);
                }
            }
// dd("ssss");
            $id = null;

            for ($i = 0; $i < $count; $i++) {
                $table[] = [
                    'production_number' => $production_number[$i],
                    'product_id' => $product_id[$i],
                    'production_name' => $production_name,
                    'production_date' => $production_date,
                    'production_status' => '0',
                    'emp_id' => Auth::user()->emp_id,
                ];
            }

            // dd($table);

            // $idp = [];
            $ss = 0;
            foreach ($table as $key => $value) {
                // dd($value);
                $idp = Production::insertGetId($value);

                // dd($key);
                for ($i = 0; $i < count($material_number); $i++) {

                    $this_ = $material_number[$i];
                    // dd($material_number[$i]);

                    if ($material_number[$i][0] == $key + 1) {
                        // dd('1');
                        $table2 = [
                            'material_id' => $material_id[$i][1],
                            'production_m_num' => $material_number[$i][1],
                            'production_id' => $idp,
                        ];
                        // dd($table2);
                        Production_m::insert($table2);
                    }

                }

            }

            $id = Production::orderby('production_id', 'desc')->first();
            $id = $id->production_id;
            Production::where('production_id', $id)
                ->update(['production_group' => $id]);

            Production::whereNull('production_group')->update(['production_group' => $id]);

            Production_m::whereNull('production_m_group')->update(['production_m_group' => $id]);

            // $table = [
            //     'product_id' => $request->product,
            //     'production_number' => $request->number,
            //     'product_t_id' => $request->type,
            //     'unit_id' => $request->unit,
            //     'production_date' => $request->date,
            //     'production_unit' => $request->punit,
            //     'production_status' => 0,
            // ];

            // Production::where('production_id', $request->id)->update($table);

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
            Production::where('production_group', $id)->delete();
            Production_m::where('production_m_group', $id)->delete();

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
            if ($request->production_status == 3) {
                // dd("pazz");
                $id = Production_m::where('production_m_group', $request->production_group)->get();
                foreach ($id as $key => $value) {
                    $idp = Material::where('material_id', $value->material_id)->get();
                    foreach ($idp as $key => $pid) {
                        // dd($pid->product_total); // ข้อมูล
                        // dd($value->withdraw_p_d_num); // จำนวนเบิก
                        $total = $pid->material_remaining - $value->production_m_num;
                        $total1 = [
                            'material_remaining' => $total,
                        ];
                        Material::where('material_id', $value->material_id)->update($total1);
                    }
                }
                // สินค้า
                $id = Production::where('production_group', $request->production_group)->get();
                foreach ($id as $key => $value) {
                    $idp = Product::where('product_id', $value->product_id)->get();
                    foreach ($idp as $key => $pid) {
                        // dd($pid->product_total); // ข้อมูล
                        // dd($value->withdraw_p_d_num); // จำนวนเบิก
                        $total = $value->production_number + $pid->product_total;
                        $total2 = [
                            'product_total' => $total,
                        ];
                        // dd($total2);
                        Product::where('product_id', $value->product_id)->update($total2);
                    }
                }
            }elseif($request->production_status == 2){
                // dd("sss2");
                // ตรวจสอบ วัตถุดิบ
                $id = Production_m::where('production_m_group', $request->production_group)->get();
                // dd($id->production_m_num);
                foreach ($id as $key => $value) {
                    $idp = Material::where('material_id', $value->material_id)->get();
                    // dd($value->production_m_num);
                    foreach ($idp as $key => $pid) {
                        if ($pid->material_remaining < $value->production_m_num) {
                            // dd('ไม่สำเร็จ');
                            $return['status'] = 3;
                            $return['content'] = 'ไม่สำเร็จ';
                            return json_encode($return);
                        }
                    }
                }
            }
            // dd("stop");
            $table = [
                'production_status' => $request->production_status,
            ];

            Production::where('production_group', $request->production_group)->update($table);

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
