<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['page'] = '/material';
        $data['mater'] = Material::get();
        return view('product.material_index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['page'] = '/material/create';
        return view('product.material_create', $data);
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
            $path = public_path() . '/upload/material/';
            $file = $request->file('input_file');
            $extension = $file->getClientOriginalExtension(); // ส่วนขยายรูปภาพ
            $filename = time() . '.' . $extension;
            $file->move($path, $filename);
            $request->news_pic = $filename;
            $news_pic = $request->news_pic;

            $table = [
                'material_name' => $request->name,
                'material_price' => $request->price,
                'material_remaining' => $request->total,
                'material_img' => $news_pic,
                'material_remaining' => $request->total,
                'material_unit' => $request->punit,
            ];

            Material::insertGetId($table);

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
        $data['page'] = '/material/create';
        $data['mater'] = Material::where('material_id', $id)->first();
        return view('product.material_edit', $data);

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

                $new = Material::select('material_img')->where('material_id', $request->id)->first();
                $path = public_path() . '/upload/material/';

                //code for remove old file
                if ($new->material_img != '') {
                    $file_old = $path . $new->material_img;
                    unlink($file_old);
                }

                // upload new file
                $path = public_path() . '/upload/material/';
                $file = $request->file('input_file');
                $extension = $file->getClientOriginalExtension(); // ส่วนขยายรูปภาพ
                $filename = time() . '.' . $extension;
                $file->move($path, $filename);
                $request->news_pic = $filename;
                $news_pic = $request->news_pic;

                $table = [
                    'material_name' => $request->name,
                    'material_price' => $request->price,
                    'material_remaining' => $request->total,
                    'material_img' => $news_pic,
                    'material_unit' => $request->punit,
                ];

                Material::where('material_id', $request->id)->update($table);

            }

            $table = [
                'material_name' => $request->name,
                'material_price' => $request->price,
                'material_remaining' => $request->total,
                'material_unit' => $request->punit,
            ];

            Material::where('material_id', $request->id)->update($table);

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

           $new = Material::select('material_img')->where('material_id', $id)->first();

            $path = public_path() . '/upload/material/';

            //code for remove old file
            if ($new->material_img != '') {
                $file_old = $path . $new->material_img;
                unlink($file_old);
            }

            DB::beginTransaction();
            Material::where('material_id', $id)->delete();

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
