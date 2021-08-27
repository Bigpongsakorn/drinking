<?php

namespace App\Http\Controllers\PDF;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Withdraw;
use App\Models\Withdraw_detail;
use App\Models\Customer;
use App\Models\Order_data;
use App\Models\Order_detail;
use App\Models\Other;
use App\Models\Production;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// use PDF;

class PDFController extends Controller
{
    public function product_index()
    {
        // $data['page'] = '/pdf';
        $data['product'] = Product::leftjoin('product_type', 'product_type.product_t_id', 'product_data.product_type')
            ->leftjoin('product_unit', 'product_unit.unit_id', 'product_data.unit_id')
            ->get();

        return view('pdf.product_pdf', $data);

        // $product = Product::leftjoin('product_type', 'product_type.product_t_id', 'product_data.product_type')
        //     ->leftjoin('product_unit', 'product_unit.unit_id', 'product_data.unit_id')
        //     ->get();

        // $pdf = PDF::LoadView('/PDF/product_pdf', ['product' => $product]);
        // return @$pdf->stream();

    }

    public function withdraw_detail($id)
    {
        // dd($id);
        // $data['page'] = '/withdraw_product';
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
        return view('pdf.withdraw_pdf', $data);
    }

    public function order_detail($id)
    {
        $data['customer'] = Customer::get();
        $data['product'] = Product::get();
        $data['order_db'] = Order_data::where('order_id', $id)->first();
        $data['other_db'] = Other::leftjoin('provinces', 'provinces.province_id', 'other.o_province')
        ->leftjoin('districts', 'districts.district_id', 'other.o_district')
        ->leftjoin('subdistricts', 'subdistricts.subdistrict_id', 'other.o_subdistrict')
        ->where('order_id',$id)
        ->first();
        $data['customer_db'] = Order_data::leftJoin('customer_data', 'customer_data.cus_id', 'order_data.cus_id')
            // ->leftJoin('other','other.order_id','order_data.order_id')
            ->leftjoin('provinces', 'provinces.province_id', 'customer_data.cus_province')
            ->leftjoin('districts', 'districts.district_id', 'customer_data.cus_district')
            ->leftjoin('subdistricts', 'subdistricts.subdistrict_id', 'customer_data.cus_subdistrict')
            // ->selectRaw('order_data.order_id as oo_id,order_data.*,other.*,customer_data.*')
            ->where('order_data.order_id', $id)
            ->first();
        $data['order_d'] = Order_detail::leftJoin('product_data', 'product_data.product_id', 'orderdetail.product_id')
            ->where('order_id', $id)
            ->get();
        $data['sum'] = DB::table('product_data')
            ->leftJoin('orderdetail', 'product_data.product_id', 'orderdetail.product_id')
            ->select('product_data.product_id', DB::raw('SUM(product_data.product_price * orderdetail.orderdetail_quantity_total) as sum'))
            ->groupBy('product_data.product_id')
            ->where('orderdetail.order_id', $id)
            ->get();
        return view('pdf.order_pdf', $data);
    }

    public function production_detail($id)
    {
        $data['pro'] = Production::leftjoin('product_data', 'product_data.product_id', 'production_data.product_id')
            ->where('production_group', $id)
            ->get();
        $data['p_id'] = Production::where('production_group',$id)->first();

        $data['mat'] = Production::leftjoin('product_material','product_material.product_id','production_data.product_id')
        ->leftjoin('material','material.material_id','product_material.material_id')
        ->where('production_group',$id)->get();

        $data['sum'] = DB::table('product_data')
        ->leftJoin('production_data','product_data.product_id','production_data.product_id')
        ->select('product_data.product_id',DB::raw('SUM(product_data.product_price * production_data.production_number) as sum'))
        ->groupBy('product_data.product_id')
        ->where('production_data.production_group', $id)
        ->get();

        // dd($data);
        return view('pdf.production_pdf', $data);
    }
}
