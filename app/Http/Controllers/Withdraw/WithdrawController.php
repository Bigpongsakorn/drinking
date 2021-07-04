<?php

namespace App\Http\Controllers\Withdraw;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductType;
use App\Models\Unit;
use App\Models\Withdraw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class WithdrawController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['page'] = '/withdraw_product';
        $data['with'] = Withdraw::groupby('withdraw_p_name')->groupby('withdraw_p_date')->groupby('withdraw_p_status')->groupby('withdraw_p_group')
        ->select('withdraw_p_name','withdraw_p_date','withdraw_p_status','withdraw_p_group')
        ->orderBy('withdraw_p_id','desc')
        ->get();
        $data['pending'] = Withdraw::groupby('withdraw_p_name')->groupby('withdraw_p_date')->groupby('withdraw_p_status')->groupby('withdraw_p_group')
        ->select('withdraw_p_name','withdraw_p_date','withdraw_p_status','withdraw_p_group')
        ->orderBy('withdraw_p_id','desc')
        ->where('withdraw_p_status','0')
        ->get();
        $data['dis'] = Withdraw::groupby('withdraw_p_name')->groupby('withdraw_p_date')->groupby('withdraw_p_status')->groupby('withdraw_p_group')
        ->select('withdraw_p_name','withdraw_p_date','withdraw_p_status','withdraw_p_group')
        ->orderBy('withdraw_p_id','desc')
        ->where('withdraw_p_status','1')
        ->get();
        $data['approve'] = Withdraw::groupby('withdraw_p_name')->groupby('withdraw_p_date')->groupby('withdraw_p_status')->groupby('withdraw_p_group')
        ->select('withdraw_p_name','withdraw_p_date','withdraw_p_status','withdraw_p_group')
        ->orderBy('withdraw_p_id','desc')
        ->where('withdraw_p_status','2')
        ->get();
        // dd($data);
        return view('withdraw.withdraw_index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['page'] = '/withdraw/withdraw_product_create';
        $data['product'] = Product::leftjoin('product_unit', 'product_unit.unit_id', 'product_data.unit_id')
            ->leftjoin('product_type', 'product_type.product_t_id', 'product_data.product_type')
            ->get();
        $data['unit'] = Unit::get();
        $data['type'] = ProductType::get();
        // dd($data);
        return view('withdraw.withdraw_create', $data);
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
                $withdraw_p_num = explode(",", $request->withdraw_p_num);
                $count = $request->count;
                $withdraw_p_name = $request->withdraw_p_name;
                $withdraw_p_date = $request->withdraw_p_date;
                $id = null;

                for ($i = 0; $i < $count; $i++) {
                    $table[] = [
                        'withdraw_p_num' => $withdraw_p_num[$i],
                        'product_id' => $product_id[$i],
                        'withdraw_p_name' => $withdraw_p_name,
                        'withdraw_p_date' => $withdraw_p_date,
                        'withdraw_p_status' => '0',
                        'user_id' => Auth::user()->user_id,
                    ];
                }

                foreach($table as $key => $value){
                    Withdraw::insert($value);
                }
    
                $id = Withdraw::orderby('withdraw_p_id', 'desc')->first();
                $id = $id->withdraw_p_id;
                Withdraw::where('withdraw_p_id', $id)
                    ->update(['withdraw_p_group' => $id]);
    
                Withdraw::whereNull('withdraw_p_group')->update(['withdraw_p_group' => $id]);

                // $table = [
                //     'withdraw_p_num' => $request->number,
                //     'withdraw_p_date' => $request->date,
                //     'product_id' => $request->product,
                //     'withdraw_p_status' => '0',
                //     'user_id' => Auth::user()->user_id,
                // ];

                // Withdraw::insert($table);

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
        $data['page'] = '/withdraw_product';
        $data['detail'] = Withdraw::leftjoin('product_data','product_data.product_id','withdraw_producr.product_id')
        ->leftjoin('user_data','user_data.user_id','withdraw_producr.user_id')
        ->where('withdraw_p_group',$id)
        ->get();
        // dd($data);
        return view('withdraw.withdraw_detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['page'] = '/withdraw/withdraw_product_create';
        $data['with'] = Withdraw::where('withdraw_p_group', $id)->orderby('withdraw_p_id','asc')->get();
        $data['with1'] = Withdraw::where('withdraw_p_group', $id)->first();
        $data['product'] = Product::get();
        // dd($data);
        return view('withdraw.withdraw_edit', $data);
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
                Withdraw::where('withdraw_p_group', $request->withdraw_p_group)->delete();
                $product_id = explode(",", $request->product_id);
                $withdraw_p_num = explode(",", $request->withdraw_p_num);
                $count = $request->count;
                $withdraw_p_name = $request->withdraw_p_name;
                $withdraw_p_date = $request->withdraw_p_date;
                $user_id = $request->user_id;
                $id = null;

                for ($i = 0; $i < $count; $i++) {
                    $table[] = [
                        'withdraw_p_num' => $withdraw_p_num[$i],
                        'product_id' => $product_id[$i],
                        'withdraw_p_name' => $withdraw_p_name,
                        'withdraw_p_date' => $withdraw_p_date,
                        'withdraw_p_status' => '0',
                        'user_id' => $user_id,
                    ];
                }

                foreach($table as $key => $value){
                    Withdraw::insert($value);
                }
    
                $id = Withdraw::orderby('withdraw_p_id', 'desc')->first();
                $id = $id->withdraw_p_id;
                Withdraw::where('withdraw_p_id', $id)
                    ->update(['withdraw_p_group' => $id]);
    
                Withdraw::whereNull('withdraw_p_group')->update(['withdraw_p_group' => $id]);

                // $table = [
                //     'withdraw_p_date' => $request->date,
                //     'withdraw_p_status' => '0',
                // ];
                // Withdraw::where('withdraw_p_id', $request->id)->update($table);

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
            Withdraw::where('withdraw_p_group', $id)->delete();

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
            $id = Withdraw::where('withdraw_p_group', $request->withdraw_p_group)->get();
            foreach($id as $key => $value){
                $idp = Product::where('product_id',$value->product_id)->get();
                foreach($idp as $key => $pid){
                    // dd($pid->material_remaining);
                    $total = $value->withdraw_p_num + $pid->product_total;
                    $total1 = [
                        'product_total' => $total,
                    ];
                    // dd($total1);
                    Product::where('product_id',$value->product_id)->update($total1);
                }
            }
            $table = [
                'withdraw_p_status' => $request->withdraw_p_status,
            ];

            Withdraw::where('withdraw_p_group', $request->withdraw_p_group)->update($table);

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
