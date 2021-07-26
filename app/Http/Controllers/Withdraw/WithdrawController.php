<?php

namespace App\Http\Controllers\Withdraw;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Users;
use App\Models\Withdraw;
use App\Models\Withdraw_detail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        $data['emp'] = Users::get();
        $data['with'] = Withdraw::leftJoin('empolyee', 'empolyee.emp_id', 'withdraw_product.emp_id')->orderBy('withdraw_p_id', 'desc')
            ->get();
        $data['pending'] = Withdraw::leftJoin('empolyee', 'empolyee.emp_id', 'withdraw_product.emp_id')->orderBy('withdraw_p_id', 'desc')
            ->where('withdraw_p_status', '0')
            ->get();
        $data['dis'] = Withdraw::leftJoin('empolyee', 'empolyee.emp_id', 'withdraw_product.emp_id')->orderBy('withdraw_p_id', 'desc')
            ->where('withdraw_p_status', '1')
            ->get();
        $data['approve'] = Withdraw::leftJoin('empolyee', 'empolyee.emp_id', 'withdraw_product.emp_id')->orderBy('withdraw_p_id', 'desc')
            ->where('withdraw_p_status', '2')
            ->get();
        $data['fin'] = Withdraw::leftJoin('empolyee', 'empolyee.emp_id', 'withdraw_product.emp_id')->orderBy('withdraw_p_id', 'desc')
        ->where('withdraw_p_status', '3')
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

            foreach ($product_id as $key => $ttt) {
                if (!$ttt) {
                    $return['status'] = 3;
                    $return['content'] = 'ไม่สำเร็จ';
                    return json_encode($return);
                }
            }

            foreach ($withdraw_p_num as $key => $tttt) {
                if (!$tttt) {
                    $return['status'] = 3;
                    $return['content'] = 'ไม่สำเร็จ';
                    return json_encode($return);
                }
            }

            // dd("stop");
            $table = [
                'withdraw_p_name' => $withdraw_p_name,
                'withdraw_p_date' => $withdraw_p_date,
                'withdraw_p_status' => '0',
                'emp_id' => Auth::user()->emp_id,
            ];

            $w_id = Withdraw::insertGetId($table);
            // $w_id = 1;
            for ($i = 0; $i < $count; $i++) {
                $table1[] = [
                    'withdraw_p_d_num' => $withdraw_p_num[$i],
                    'product_id' => $product_id[$i],
                    'withdraw_p_id' => $w_id,
                ];
            }
// dd($table1);
            foreach ($table1 as $key => $value) {
                Withdraw_detail::insert($value);
            }

            // $id = Withdraw::orderby('withdraw_p_id', 'desc')->first();
            // $id = $id->withdraw_p_id;
            // Withdraw::where('withdraw_p_id', $id)
            //     ->update(['withdraw_p_group' => $id]);

            // Withdraw::whereNull('withdraw_p_group')->update(['withdraw_p_group' => $id]);

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
        $data['page'] = '/withdraw_product';
        $data['wid'] = Withdraw::leftjoin('empolyee','empolyee.emp_id','withdraw_product.w_emp_id')
        ->where('withdraw_p_id',$id)->first();
        $data['detail'] = Withdraw_detail::leftjoin('product_data', 'product_data.product_id', 'withdraw_product_detail.product_id')
            ->where('withdraw_p_id', $id)
            ->get();

        $data['sum'] = DB::table('product_data')
        ->leftJoin('withdraw_product_detail','product_data.product_id','withdraw_product_detail.product_id')
        ->select('product_data.product_id',DB::raw('SUM(product_data.product_price * withdraw_product_detail.withdraw_p_d_num) as sum'))
        ->groupBy('product_data.product_id')
        ->where('withdraw_product_detail.withdraw_p_id', $id)
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
        $data['with'] = Withdraw_detail::where('withdraw_p_id', $id)->orderby('withdraw_p_d_id', 'asc')->get();
        $data['with1'] = Withdraw::where('withdraw_p_id', $id)->first();
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
            // Withdraw::where('withdraw_p_id', $request->withdraw_p_id)->delete();
            $withdraw_p_id = $request->withdraw_p_id;
            $product_id = explode(",", $request->product_id);
            $withdraw_p_d_num = explode(",", $request->withdraw_p_d_num);
            $count = $request->count;
            $withdraw_p_name = $request->withdraw_p_name;
            $withdraw_p_date = $request->withdraw_p_date;
            $emp_id = $request->emp_id;
            $id = null;

            foreach ($product_id as $key => $ttt) {
                if (!$ttt) {
                    $return['status'] = 3;
                    $return['content'] = 'ไม่สำเร็จ';
                    return json_encode($return);
                }
            }
            foreach ($withdraw_p_d_num as $key => $tttt) {
                if (!$tttt) {
                    $return['status'] = 3;
                    $return['content'] = 'ไม่สำเร็จ';
                    return json_encode($return);
                }
            }

            // for ($i = 0; $i < $count; $i++) {
                $table = [
                    'withdraw_p_name' => $withdraw_p_name,
                    'withdraw_p_date' => $withdraw_p_date,
                    'withdraw_p_status' => '0',
                    'emp_id' => $emp_id,
                ];
            // }
            // dd($table);
            // foreach ($table as $key => $value) {
                // Withdraw::insert($value);
                Withdraw::where('withdraw_p_id', $withdraw_p_id)->update($table);
            // }

            for ($i = 0; $i < $count; $i++) {
                $table1[] = [
                    'withdraw_p_d_num' => $withdraw_p_d_num[$i],
                    'product_id' => $product_id[$i],
                    'withdraw_p_id' => $withdraw_p_id,
                ];
            }
// dd($table1);
            Withdraw_detail::where('withdraw_p_id', $request->withdraw_p_id)->delete();

            foreach ($table1 as $key => $value) {
                Withdraw_detail::insert($value);
            }

            // $id = Withdraw::orderby('withdraw_p_id', 'desc')->first();
            // $id = $id->withdraw_p_id;
            // Withdraw::where('withdraw_p_id', $id)
            //     ->update(['withdraw_p_group' => $id]);

            // Withdraw::whereNull('withdraw_p_group')->update(['withdraw_p_group' => $id]);

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
            Withdraw::where('withdraw_p_id', $id)->delete();
            Withdraw_detail::where('withdraw_p_id', $id)->delete();

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
            if ($request->withdraw_p_status == 3) {
                $id = Withdraw_detail::where('withdraw_p_id', $request->withdraw_p_id)->get();
                foreach ($id as $key => $value) {
                    $idp = Product::where('product_id', $value->product_id)->get();
                    // dd($value->withdraw_p_d_num);
                    foreach ($idp as $key => $pid) {
                        if ($pid->product_total < $value->withdraw_p_d_num) {
                            // dd('ไม่สำเร็จ');
                            $return['status'] = 3;
                            $return['content'] = 'ไม่สำเร็จ';
                            return json_encode($return);
                        }
                    }
                }
                $id = Withdraw_detail::where('withdraw_p_id', $request->withdraw_p_id)->get();
                foreach ($id as $key => $value) {
                    $idp = Product::where('product_id', $value->product_id)->get();
                    foreach ($idp as $key => $pid) {
                        // dd($pid->product_total); // ข้อมูล
                        // dd($value->withdraw_p_d_num); // จำนวนเบิก
                        $total = $pid->product_total - $value->withdraw_p_d_num;
                        $total1 = [
                            'product_total' => $total,
                        ];
                        // dd($total1);
                        Product::where('product_id', $value->product_id)->update($total1);
                    }
                }
            }

            $table = [
                'withdraw_p_status' => $request->withdraw_p_status,
                'withdraw_p_status_time' => Carbon::now(),
                'withdraw_p_status_detail' =>$request->withdraw_p_status_detail,
                'w_emp_id' => $request->w_emp_id,
            ];

            Withdraw::where('withdraw_p_id', $request->withdraw_p_id)->update($table);

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
