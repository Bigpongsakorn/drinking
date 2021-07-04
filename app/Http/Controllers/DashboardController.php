<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['page'] = '/index';
        return view('dashboard.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['page'] = '/news/create';
        return view('dashboard.create_news', $data);

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
            $path = public_path() . '/upload/news/';
            $file = $request->file('input_file');
            $extension = $file->getClientOriginalExtension(); // ส่วนขยายรูปภาพ
            $filename = time() . '.' . $extension;
            $file->move($path, $filename);
            $request->news_pic = $filename;
            $news_pic = $request->news_pic;

            $table = [
                'new_toppic' => $request->toppic,
                'new_date' => $request->date,
                'new_detail' => $request->detail,
                'new_image' => $news_pic,
            ];

            News::insertGetId($table);

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
    public function show()
    {
        $data['page'] = '/news/list';
        $data['news'] = News::get();
        return view('dashboard.list_news', $data);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['page'] = '/news/create';
        $data['news'] = News::where('new_id', $id)->first();
        return view('dashboard.edit_news', $data);
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

                $new = News::select('new_image')->where('new_id', $request->id)->first();
                $path = public_path() . '/upload/news/';

                //code for remove old file
                if ($new->new_image != '') {
                    $file_old = $path . $new->new_image;
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
                    'new_toppic' => $request->toppic,
                    'new_date' => $request->date,
                    'new_detail' => $request->detail,
                    'new_image' => $news_pic,
                ];

                News::where('new_id', $request->id)->update($table);

            }

            $table = [
                'new_toppic' => $request->toppic,
                'new_date' => $request->date,
                'new_detail' => $request->detail,
            ];

            News::where('new_id', $request->id)->update($table);

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

            $new = News::select('new_image')->where('new_id', $id)->first();
            $path = public_path() . '/upload/news/';

            //code for remove old file
            if ($new->new_image != '') {
                $file_old = $path . $new->new_image;
                unlink($file_old);
            }

            DB::beginTransaction();
            News::where('new_id', $id)->delete();

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
