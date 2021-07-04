<?php

namespace App\Http\Controllers\Production;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Production;
use App\Models\ProductType;
use App\Models\Unit;
use Illuminate\Http\Request;
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
        $data['production'] = Production::leftjoin('product_data', 'product_data.product_id', 'production_data.product_id')
            ->leftjoin('product_type', 'product_type.product_t_id', 'production_data.product_t_id')
            ->leftjoin('product_unit', 'product_unit.unit_id', 'production_data.unit_id')
            ->orderBy('production_id','DESC')
            ->get();
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
        return view('production.production_create', $data);
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
                'product_id' => $request->product,
                'production_number' => $request->number,
                'product_t_id' => $request->type,
                'unit_id' => $request->unit,
                'production_date' => $request->date,
                'production_unit' => $request->punit,
                'production_status' => 0,
            ];

            Production::insertGetId($table);

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
        $data['page'] = '/production/create';
        $data['pd'] = Production::where('production_id', $id)->first();
        $data['product'] = Product::get();
        $data['unit'] = Unit::get();
        $data['type'] = ProductType::get();
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
        try {
            $table = [
                'product_id' => $request->product,
                'production_number' => $request->number,
                'product_t_id' => $request->type,
                'unit_id' => $request->unit,
                'production_date' => $request->date,
                'production_unit' => $request->punit,
                'production_status' => 0,
            ];

            Production::where('production_id', $request->id)->update($table);

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
            Production::where('production_id', $id)->delete();

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

        try {
            $table = [
                'production_status' => $request->production_status,
            ];

            Production::where('production_id', $request->production_id)->update($table);

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
