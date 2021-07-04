<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Position;
use App\Models\Province;
use App\Models\Subdistrict;
use App\Models\UserData;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['page'] = '/users';
        $data['users'] = Users::leftjoin('user_position', 'user_position.position_id', 'users.user_type')
        ->leftjoin('user_data','user_data.user_id','users.user_id')
        ->get();
        return view('user/index', $data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['page'] = '/users/create';
        $data['position'] = Position::get();
        $data['province'] = Province::get();
        return view('user/create_user', $data);
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
        $password = Hash::make($request->password);

        try {

            // upload new file
            $path = public_path() . '/upload/users/';
            $file = $request->file('input_file');
            $extension = $file->getClientOriginalExtension(); // ส่วนขยายรูปภาพ
            $filename = time() . '.' . $extension;
            $file->move($path, $filename);
            $request->news_pic = $filename;
            $news_pic = $request->news_pic;

            $table = [
                'username' => $request->username,
                'password' => $password,
                // 'user_email'=> $request->email,
                'user_type' => $request->type,
            ];

            $u_id = Users::insertGetId($table);

            $table_data = [
                'user_d_fname' => $request->fname,
                'user_d_lanme' => $request->lname,
                'user_d_title' => $request->title,
                'user_d_gender' => $request->gender,
                'user_d_birthday' => $request->bday,
                'user_d_idcart' => $request->idcart,
                'user_d_email' => $request->email,
                'user_d_tel' => $request->tel,
                'user_d_address' => $request->address,
                'user_d_province' => $request->province,
                'user_d_district' => $request->district,
                'user_d_subdistrict' => $request->subdistrict,
                'user_d_zipcode' => $request->zipcode,
                'user_d_image' => $news_pic,
                'user_id' => $u_id,
            ];

            UserData::insertGetId($table_data);

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
        $data['page'] = '/users/create';
        $data['position'] = Position::get();
        $data['province'] = Province::get();
        $data['district'] = District::get();
        $data['subistrict'] = Subdistrict::get();
        $data['user'] = Users::where('user_id', $id)->first();
        $data['user_d'] = UserData::where('user_id', $id)->first();
        // dd($data);
        return view('user/edit_user', $data);
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
        // dd($request->id);
        try {

            if ($request->hasFile('input_file')) {

                $new = UserData::select('user_d_image')->where('user_id', $request->id)->first();
                $path = public_path() . '/upload/users/';

                //code for remove old file
                if ($new->user_d_image != '') {
                    $file_old = $path . $new->user_d_image;
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
                    'user_type' => $request->type,
                ];

                Users::where('user_id', $request->id)->update($table);

                $table_data = [
                    'user_d_fname' => $request->fname,
                    'user_d_lanme' => $request->lname,
                    'user_d_title' => $request->title,
                    'user_d_gender' => $request->gender,
                    'user_d_birthday' => $request->bday,
                    'user_d_idcart' => $request->idcart,
                    'user_d_email' => $request->email,
                    'user_d_tel' => $request->tel,
                    'user_d_address' => $request->address,
                    'user_d_province' => $request->province,
                    'user_d_district' => $request->district,
                    'user_d_subdistrict' => $request->subdistrict,
                    'user_d_zipcode' => $request->zipcode,
                    'user_d_image' => $news_pic,
                ];

                UserData::where('user_id', $request->id)->update($table_data);

            }

            $table = [
                'user_type' => $request->type,
            ];

            Users::where('user_id', $request->id)->update($table);

            $table_data = [
                'user_d_fname' => $request->fname,
                'user_d_lanme' => $request->lname,
                'user_d_title' => $request->title,
                'user_d_gender' => $request->gender,
                'user_d_birthday' => $request->bday,
                'user_d_idcart' => $request->idcart,
                'user_d_email' => $request->email,
                'user_d_tel' => $request->tel,
                'user_d_address' => $request->address,
                'user_d_province' => $request->province,
                'user_d_district' => $request->district,
                'user_d_subdistrict' => $request->subdistrict,
                'user_d_zipcode' => $request->zipcode,
                // 'user_d_image' => ???,
            ];

            UserData::where('user_id', $request->id)->update($table_data);

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
            
            $new = UserData::select('user_d_image')->where('user_id', $id)->first();
            $path = public_path() . '/upload/users/';

            //code for remove old file
            if ($new->user_d_image != '') {
                $file_old = $path . $new->user_d_image;
                unlink($file_old);
            }

            DB::beginTransaction();
            Users::where('user_id', $id)->delete();
            UserData::where('user_id', $id)->delete();

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
