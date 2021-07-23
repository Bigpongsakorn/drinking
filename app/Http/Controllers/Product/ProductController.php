<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Material;
use App\Models\Material_Product;
use App\Models\Product;
use App\Models\ProductType;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['page'] = '/product';
        $data['product'] = Product::leftjoin('product_type', 'product_type.product_t_id', 'product_data.product_type')
            ->leftjoin('product_unit', 'product_unit.unit_id', 'product_data.unit_id')
            ->get();
        return view('product.index', $data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['page'] = '/product/create';
        $data['product'] = Product::get();
        $data['unit'] = Unit::get();
        $data['type'] = ProductType::get();
        $data['mat'] = Material::get();
        return view('product.create_product', $data);
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

            // upload new file
            $path = public_path() . '/upload/store/';
            $file = $request->file('input_file');
            $extension = $file->getClientOriginalExtension(); // ส่วนขยายรูปภาพ
            $filename = time() . '.' . $extension;
            $file->move($path, $filename);
            $request->news_pic = $filename;
            $news_pic = $request->news_pic;

            $table = [
                'product_name' => $request->name,
                'unit_id' => $request->unit,
                'product_type' => $request->type,
                'product_price' => $request->price,
                'product_total' => $request->total,
                'punit' => $request->punit,
                'product_img' => $news_pic,
            ];

            $p_id = Product::insertGetId($table);

            $material = explode(",", $request->material);
            $quan = explode(",", $request->quan);
            foreach ($material as $key => $value) {
                // dd($value);
                foreach ($quan as $key => $vque) {
                    // dd($vque);
                    $mate = [
                        'product_id' => $p_id,
                        'material_id' => $value,
                        'mp_quantity' => $vque,
                    ];
                }
                // dd($mate);
                Material_Product::insert($mate);
            }
            // dd("ssss");
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
        $data['page'] = '/product/create';
        $data['product'] = Product::where('product_id', $id)->first();
        $data['unit'] = Unit::get();
        $data['type'] = ProductType::get();
        $data['mat'] = Material::get();
        $data['mat_p'] = Material_Product::where('product_id', $id)->orderby('mp_id', 'asc')->get();
        // dd($data);
        return view('product.edit_product', $data);
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

            if ($request->hasFile('input_file')) {

                $new = Product::select('product_img')->where('product_id', $request->id)->first();
                $path = public_path() . '/upload/store/';

                //code for remove old file
                if ($new->product_img != '') {
                    $file_old = $path . $new->product_img;
                    unlink($file_old);
                }

                // upload new file
                $file = $request->file('input_file');
                $extension = $file->getClientOriginalExtension(); // ส่วนขยายรูปภาพ
                $filename = time() . '.' . $extension;
                $file->move($path, $filename);
                $request->news_pic = $filename;
                $news_pic = $request->news_pic;

                $table = [
                    'product_name' => $request->name,
                    'unit_id' => $request->unit,
                    'product_type' => $request->type,
                    'product_price' => $request->price,
                    'product_total' => $request->total,
                    'product_img' => $news_pic,
                    'punit' => $request->punit,
                ];

                Product::where('product_id', $request->id)->update($table);
                Material_Product::where('product_id', $request->id)->delete();
                $material = explode(",", $request->material);
                $quan = explode(",", $request->quan);
                foreach ($material as $key => $value) {
                    // dd($value);
                    foreach ($quan as $key => $vque) {
                        // dd($vque);
                        $mate = [
                            'product_id' => $request->id,
                            'material_id' => $value,
                            'mp_quantity' => $vque,
                        ];
                    }
                    // dd($mate);
                    Material_Product::insert($mate);
                }
            }

            $table = [
                'product_name' => $request->name,
                'unit_id' => $request->unit,
                'product_type' => $request->type,
                'product_price' => $request->price,
                'product_total' => $request->total,
                'punit' => $request->punit,
            ];
// dd($table);
            Product::where('product_id', $request->id)->update($table);
            Material_Product::where('product_id', $request->id)->delete();
            $material = explode(",", $request->material);
            $quan = explode(",", $request->quan);
                foreach ($material as $key => $value) {
                    // dd($value);
                    foreach ($quan as $key => $vque) {
                        // dd($vque);
                        $mate = [
                            'product_id' => $request->id,
                            'material_id' => $value,
                            'mp_quantity' => $vque,
                        ];
                    }
                    // dd($mate);
                    Material_Product::insert($mate);
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

            $new = Product::select('product_img')->where('product_id', $id)->first();
            $path = public_path() . '/upload/store/';

            //code for remove old file
            if ($new->product_img != '') {
                $file_old = $path . $new->product_img;
                unlink($file_old);
            }

            DB::beginTransaction();
            Product::where('product_id', $id)->delete();
            Material_Product::where('product_id', $id)->delete();

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
