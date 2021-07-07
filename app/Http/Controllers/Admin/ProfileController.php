<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Position;
use App\Models\Province;
use App\Models\Subdistrict;
// use App\Models\UserData;
use App\Models\Users;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['page'] = '/profile';
        $uid = Auth::user()->emp_id;
        $data['user'] = Users::leftjoin('empolyee_position', 'empolyee_position.position_id', 'empolyee.position_id')
            ->leftjoin('provinces', 'provinces.province_id', 'empolyee.emp_province')
            ->leftjoin('districts', 'districts.district_id', 'empolyee.emp_district')
            ->leftjoin('subdistricts', 'subdistricts.subdistrict_id', 'empolyee.emp_subdistrict')
        // ->leftjoin('subdistricts', 'subdistricts.zip_code', 'user_data.user_d_zipcode')
            ->where('emp_id', $uid)->first();
        // dd($data);
        return view('user/profile_index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

        $data['page'] = '/profile/edit';
        $data['position'] = Position::get();
        $data['province'] = Province::get();
        $data['district'] = District::get();
        $data['subistrict'] = Subdistrict::get();
        $data['user'] = Users::where('emp_id', $id)->first();
        // dd($data);
        return view('user/profile_edit', $data);
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
                    'position_id' => $request->type,
                ];
                // dd($table);
                Users::where('emp_id', $request->id)->update($table);

            }

            $table = [
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
                'position_id' => $request->type,
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
        //
    }
}
