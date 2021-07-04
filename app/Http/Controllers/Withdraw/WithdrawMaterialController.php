<?php

namespace App\Http\Controllers\Withdraw;

use App\Http\Controllers\Controller;
use App\Models\Material;
use App\Models\Product;
use App\Models\Withdraw_material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WithdrawMaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['page'] = '/withdraw_material';
        // $data['mate'] = Withdraw_material::leftjoin('product_material', 'product_material.material_id', 'withdraw_material.material_id')
        //     ->leftjoin('user_data', 'user_data.user_id', 'withdraw_material.user_id')
        //     ->get();
        $data['mate'] = Withdraw_material::groupby('withdraw_m_name')->groupby('withdraw_m_date')->groupby('withdraw_m_status')->groupby('withdraw_m_group')
        ->select('withdraw_m_name','withdraw_m_date','withdraw_m_status','withdraw_m_group')
        ->orderBy('withdraw_m_id','desc')
        ->get();
        $data['pending'] = Withdraw_material::groupby('withdraw_m_name')->groupby('withdraw_m_date')->groupby('withdraw_m_status')->groupby('withdraw_m_group')
        ->select('withdraw_m_name','withdraw_m_date','withdraw_m_status','withdraw_m_group')
        ->orderBy('withdraw_m_id','desc')
        ->where('withdraw_m_status','0')
        ->get();
        $data['dis'] = Withdraw_material::groupby('withdraw_m_name')->groupby('withdraw_m_date')->groupby('withdraw_m_status')->groupby('withdraw_m_group')
        ->select('withdraw_m_name','withdraw_m_date','withdraw_m_status','withdraw_m_group')
        ->orderBy('withdraw_m_id','desc')
        ->where('withdraw_m_status','1')
        ->get();
        $data['approve'] = Withdraw_material::groupby('withdraw_m_name')->groupby('withdraw_m_date')->groupby('withdraw_m_status')->groupby('withdraw_m_group')
        ->select('withdraw_m_name','withdraw_m_date','withdraw_m_status','withdraw_m_group')
        ->orderBy('withdraw_m_id','desc')
        ->where('withdraw_m_status','2')
        ->get();
        // dd($data);
        return view('withdraw.withdraw_e_index', $data);

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['page'] = '/withdraw/withdraw_material_create';
        $data['mate'] = Material::get();
        return view('withdraw.withdraw_e_create', $data);

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
            $material_id = explode(",", $request->material_id);
            $withdraw_m_num = explode(",", $request->withdraw_m_num);
            $count = $request->count;
            $withdraw_m_name = $request->withdraw_m_name;
            $withdraw_m_date = $request->withdraw_m_date;
            $id = null;

            for ($i = 0; $i < $count; $i++) {
                $table[] = [
                    'withdraw_m_num' => $withdraw_m_num[$i],
                    'material_id' => $material_id[$i],
                    'withdraw_m_name' => $withdraw_m_name,
                    'withdraw_m_date' => $withdraw_m_date,
                    'withdraw_m_status' => '0',
                    'user_id' => Auth::user()->user_id,
                ];
            }
            // dd($table);

            foreach($table as $key => $value){
                Withdraw_material::insert($value);
            }

            $id = Withdraw_material::orderby('withdraw_m_id', 'desc')->first();
            $id = $id->withdraw_m_id;
            Withdraw_material::where('withdraw_m_id', $id)
                ->update(['withdraw_m_group' => $id]);

            Withdraw_material::whereNull('withdraw_m_group')->update(['withdraw_m_group' => $id]);

            // $table = [
            //     'withdraw_m_num' => $request->number,
            //     'withdraw_m_date' => $request->date,
            //     'material_id' => $request->product,
            //     'withdraw_m_status' => '0',
            //     'user_id' => Auth::user()->user_id,
            // ];

            // Withdraw_material::insert($table);

            DB::commit();
            $return['status'] = 1;
            $return['content'] = 'สำเร็จ';

        } catch (\Throwable $th) {
            DB::rollBack();
            $return['status'] = 3;
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
        $data['page'] = '/withdraw_material';
        $data['show'] = Withdraw_material::leftjoin('product_material','product_material.material_id','withdraw_material.material_id')
        ->leftjoin('user_data','user_data.user_id','withdraw_material.user_id')
        ->where('withdraw_m_group',$id)
        ->get();
        // dd($data);
        return view('withdraw.withdraw_material_detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['page'] = '/withdraw/withdraw_material_create';
        $data['mate'] = Withdraw_material::where('withdraw_m_group', $id)->orderby('withdraw_m_id','asc')->get();
        $data['mate1'] = Withdraw_material::where('withdraw_m_group', $id)->first();
        $data['mate2'] = Material::get();
        // dd($data);
        return view('withdraw.withdraw_e_edit', $data);
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
                Withdraw_material::where('withdraw_m_group', $request->withdraw_m_group)->delete();
                $material_id = explode(",", $request->material_id);
                $withdraw_m_num = explode(",", $request->withdraw_m_num);
                $count = $request->count;
                $withdraw_m_name = $request->withdraw_m_name;
                $withdraw_m_date = $request->withdraw_m_date;
                $user_id = $request->user_id;
                $id = null;
    
                for ($i = 0; $i < $count; $i++) {
                    $table[] = [
                        'withdraw_m_num' => $withdraw_m_num[$i],
                        'material_id' => $material_id[$i],
                        'withdraw_m_name' => $withdraw_m_name,
                        'withdraw_m_date' => $withdraw_m_date,
                        'withdraw_m_status' => '0',
                        'user_id' => $user_id,
                    ];
                }
                // dd($table);
    
                foreach($table as $key => $value){
                    Withdraw_material::insert($value);
                }
    
                $id = Withdraw_material::orderby('withdraw_m_id', 'desc')->first();
                $id = $id->withdraw_m_id;
                Withdraw_material::where('withdraw_m_id', $id)
                    ->update(['withdraw_m_group' => $id]);
    
                Withdraw_material::whereNull('withdraw_m_group')->update(['withdraw_m_group' => $id]);

                // $table = [
                //     'withdraw_m_date' => $request->date,
                //     'withdraw_m_status' => '0',
                // ];
                // Withdraw_material::where('withdraw_m_id', $request->id)->update($table);

                DB::commit();
                $return['status'] = 1;
                $return['content'] = 'สำเร็จ';

            } catch (\Throwable $th) {
                DB::rollBack();
                $return['status'] = 3;
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
            Withdraw_material::where('withdraw_m_group', $id)->delete();

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
            $id = Withdraw_material::where('withdraw_m_group', $request->withdraw_m_group)->get();
            foreach($id as $key => $value){
                // dd($value->material_id);
                $idm = Material::where('material_id',$value->material_id)->get();
                foreach($idm as $key => $matid){
                    // dd($matid->material_remaining);
                    $total = $value->withdraw_m_num + $matid->material_remaining;
                    $total1 = [
                        'material_remaining' => $total,
                    ];
                    // dd($total1);
                    Material::where('material_id',$value->material_id)->update($total1);
                }
            }
           
            $table = [
                'withdraw_m_status' => $request->withdraw_m_status,
            ];
            Withdraw_material::where('withdraw_m_group', $request->withdraw_m_group)->update($table);

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
