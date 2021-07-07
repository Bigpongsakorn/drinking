<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Position;
use App\Models\Province;
use App\Models\Subdistrict;
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
        $data['users'] = Users::leftjoin('empolyee_position', 'empolyee_position.position_id', 'empolyee.position_id')
            ->get();
        // dd($data);
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

            if ($request->hasFile('input_file')) {
                // upload new file
                $path = public_path() . '/upload/users/';
                $file = $request->file('input_file');
                $extension = $file->getClientOriginalExtension(); // ส่วนขยายรูปภาพ
                $filename = time() . '.' . $extension;
                $file->move($path, $filename);
                $request->news_pic = $filename;
                $news_pic = $request->news_pic;

                $table_data = [
                    'username' => $request->username,
                    'password' => $password,
                    'position_id' => $request->type,
                    'emp_firstname' => $request->fname,
                    'emp_lastname' => $request->lname,
                    'emp_title' => $request->title,
                    'emp_gender' => $request->gender,
                    'emp_birthdate' => $request->bday,
                    'emp_id_crad' => $request->idcart,
                    'emp_email' => $request->email,
                    'emp_phonenumber' => $request->tel,
                    'emp_address' => $request->address,
                    'emp_province' => $request->province,
                    'emp_district' => $request->district,
                    'emp_subdistrict' => $request->subdistrict,
                    'emp_zipcode' => $request->zipcode,
                    'emp_image' => $news_pic,
                ];
                // dd($table_data);
                Users::insertGetId($table_data);

            }

            $table_data = [
                'username' => $request->username,
                'password' => $password,
                'position_id' => $request->type,
                'emp_firstname' => $request->fname,
                'emp_lastname' => $request->lname,
                'emp_title' => $request->title,
                'emp_gender' => $request->gender,
                'emp_birthdate' => $request->bday,
                'emp_id_crad' => $request->idcart,
                'emp_email' => $request->email,
                'emp_phonenumber' => $request->tel,
                'emp_address' => $request->address,
                'emp_province' => $request->province,
                'emp_district' => $request->district,
                'emp_subdistrict' => $request->subdistrict,
                'emp_zipcode' => $request->zipcode,
            ];
            // dd($table_data);
            Users::insertGetId($table_data);

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
        $data['user'] = Users::where('emp_id', $id)->first();
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

                $new = Users::select('emp_image')->where('emp_id', $request->id)->first();
                $path = public_path() . '/upload/users/';

                //code for remove old file
                if ($new->emp_image != '') {
                    $file_old = $path . $new->emp_image;
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
                    'position_id' => $request->type,
                    'emp_firstname' => $request->fname,
                    'emp_lastname' => $request->lname,
                    'emp_title' => $request->title,
                    'emp_gender' => $request->gender,
                    'emp_birthdate' => $request->bday,
                    'emp_id_crad' => $request->idcart,
                    'emp_email' => $request->email,
                    'emp_phonenumber' => $request->tel,
                    'emp_address' => $request->address,
                    'emp_province' => $request->province,
                    'emp_district' => $request->district,
                    'emp_subdistrict' => $request->subdistrict,
                    'emp_zipcode' => $request->zipcode,
                    'emp_image' => $news_pic,
                ];

                Users::where('emp_id', $request->id)->update($table);

            }

            $table = [
                'position_id' => $request->type,
                'emp_firstname' => $request->fname,
                'emp_lastname' => $request->lname,
                'emp_title' => $request->title,
                'emp_gender' => $request->gender,
                'emp_birthdate' => $request->bday,
                'emp_id_crad' => $request->idcart,
                'emp_email' => $request->email,
                'emp_phonenumber' => $request->tel,
                'emp_address' => $request->address,
                'emp_province' => $request->province,
                'emp_district' => $request->district,
                'emp_subdistrict' => $request->subdistrict,
                'emp_zipcode' => $request->zipcode,
            ];
// dd($table);
            Users::where('emp_id', $request->id)->update($table);

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

            $new = Users::select('emp_image')->where('emp_id', $id)->first();
            $path = public_path() . '/upload/users/';

            //code for remove old file
            if ($new->emp_image != '') {
                $file_old = $path . $new->emp_image;
                unlink($file_old);
            }

            DB::beginTransaction();
            Users::where('emp_id', $id)->delete();

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
