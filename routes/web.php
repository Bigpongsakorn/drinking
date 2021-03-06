<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\News;
use App\Models\Product;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/', function () {
    $data['page'] = '/';
    $data['news'] = News::limit(3)->orderBy('new_id','desc')->get();
    $data['product'] = Product::limit(3)->orderBy('product_id','desc')->get();
    return view('frontend.index',$data);
    // return view('welcome'); //หน้าแรก
});

Auth::routes();

// All
// ============================= Frontend =============================
Route::get('/index', 'Frontend\FrontendController@index');
Route::get('/news_detail/{id}', 'Frontend\FrontendController@news_detail');
Route::get('/news_list', 'Frontend\FrontendController@news_list');
Route::get('/product_list', 'Frontend\FrontendController@product_list');
Route::get('/contact', 'Frontend\FrontendController@contact');

//Route for normal user
Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@index');
});

//Route for admin
// Route::group(['prefix' => 'admin'], function(){
Route::group(['middleware' => ['admin']], function () {

    Route::POST('/province', 'HomeController@province');
    Route::POST('/subdistrict', 'HomeController@subdistrict');

    // ============================= Dashboard =============================
    Route::get('/dashboard', 'DashboardController@index');
    Route::get('/dashboard/list_news', 'DashboardController@show');
    Route::get('/dashboard/create_news', 'DashboardController@create');
    Route::post('/new/store', 'DashboardController@store');
    Route::get('/dashboard/edit_news/{id}', 'DashboardController@edit');
    Route::post('/new/update', 'DashboardController@update');
    Route::get('/new/destroy/{id}', 'DashboardController@destroy');

    // ============================= USERS =============================
    Route::get('/user/index', 'Admin\UserController@index');
    Route::get('/user/create', 'Admin\UserController@create');
    Route::post('/user/store', 'Admin\UserController@store');
    Route::get('/user/edit_user/{id}', 'Admin\UserController@edit');
    Route::post('/user/update', 'Admin\UserController@update');
    Route::get('/user/destroy/{id}', 'Admin\UserController@destroy');
    Route::post('/user/status', 'Admin\UserController@status');

    // ============================= PROFILE =============================
    Route::get('/user/profile_index', 'Admin\ProfileController@index');
    Route::get('/user/profile_edit/{id}', 'Admin\ProfileController@edit');
    Route::post('/profile/update', 'Admin\ProfileController@update');

    // ============================= CUSTOMER =============================
    Route::get('/customer/index', 'Customer\CustomerController@index');
    Route::get('/customer/create', 'Customer\CustomerController@create');
    Route::post('/customer/store', 'Customer\CustomerController@store');
    Route::get('/customer/edit/{id}', 'Customer\CustomerController@edit');
    Route::post('/customer/update', 'Customer\CustomerController@update');
    Route::get('/customer/destroy/{id}', 'Customer\CustomerController@destroy');
    // Route::get('/customer/map', 'Customer\CustomerController@show');
    // Route::get('/customer/map_s', 'Customer\CustomerController@show_s');
    Route::get('/customer/product_customer/{id}', 'Customer\CustomerController@product');
    Route::post('/customer/insert', 'Customer\CustomerController@insertproduct');
    Route::post('/customer/status', 'Customer\CustomerController@status');

// ============================= EVENT =============================
    // Route::get('/customer/index_event', 'Customer\EventController@index');
    // Route::get('/customer/create_event', 'Customer\EventController@create');
    // Route::post('/customer/store', 'Customer\EventController@store');
    // Route::get('/customer/edit/{id}', 'Customer\EventController@edit');
    // Route::post('/customer/update', 'Customer\EventController@update');
    // Route::get('/customer/destroy/{id}', 'Customer\EventController@destroy');

    // ============================= PRODUCT =============================
    Route::get('/product/index', 'Product\ProductController@index');
    Route::get('/product/create', 'Product\ProductController@create');
    Route::post('/product/store', 'Product\ProductController@store');
    Route::get('/product/edit/{id}', 'Product\ProductController@edit');
    Route::post('/product/update', 'Product\ProductController@update');
    Route::get('/product/destroy/{id}', 'Product\ProductController@destroy');

    // ============================= PRODUCT TYPR =============================
    Route::get('/product/index_type', 'Product\ProductTypeController@index');
    Route::get('/product/create_type', 'Product\ProductTypeController@create');
    Route::post('/product_type/store', 'Product\ProductTypeController@store');
    Route::get('/product/edit_type/{id}', 'Product\ProductTypeController@edit');
    Route::post('/product_type/update', 'Product\ProductTypeController@update');
    Route::get('/product_type/destroy/{id}', 'Product\ProductTypeController@destroy');

    // ============================= PRODUCT UNIT =============================
    Route::get('/product/index_unit', 'Product\UnitController@index');
    Route::get('/product/create_unit', 'Product\UnitController@create');
    Route::post('/product_unit/store', 'Product\UnitController@store');
    Route::get('/product/edit_unit/{id}', 'Product\UnitController@edit');
    Route::post('/product_unit/update', 'Product\UnitController@update');
    Route::get('/product_unit/destroy/{id}', 'Product\UnitController@destroy');

    // ============================= MATERIAL =============================
    Route::get('/product/material_index', 'Product\MaterialController@index');
    Route::get('/product/material_create', 'Product\MaterialController@create');
    Route::post('/material/store', 'Product\MaterialController@store');
    Route::get('/product/material_edit/{id}', 'Product\MaterialController@edit');
    Route::post('/material/update', 'Product\MaterialController@update');
    Route::get('/material/destroy/{id}', 'Product\MaterialController@destroy');

    // ============================= PRODUCTION =============================
    Route::get('/production/production_index', 'Production\ProductionController@index');
    Route::get('/production/production_create', 'Production\ProductionController@create');
    Route::post('/production/store', 'Production\ProductionController@store');
    Route::get('/production/production_edit/{id}', 'Production\ProductionController@edit');
    Route::post('/production/update', 'Production\ProductionController@update');
    Route::get('/production/destroy/{id}', 'Production\ProductionController@destroy');
    Route::post('/production/status', 'Production\ProductionController@status');
    Route::get('/production/production_detail/{id}', 'Production\ProductionController@show');
    Route::post('/production/select_product', 'Production\ProductionController@select_product');
    Route::post('/production/calculate', 'Production\ProductionController@calculate');

    // ============================= WITHDRAW PRODUCT =============================
    Route::get('/withdraw/withdraw_product', 'Withdraw\WithdrawController@index');
    Route::get('/withdraw/withdraw_product_create', 'Withdraw\WithdrawController@create');
    Route::post('/withdraw/store', 'Withdraw\WithdrawController@store');
    Route::get('/withdraw/withdraw_edit/{id}', 'Withdraw\WithdrawController@edit');
    Route::post('/withdraw/update', 'Withdraw\WithdrawController@update');
    Route::get('/withdraw/destroy/{id}', 'Withdraw\WithdrawController@destroy');
    Route::post('/withdraw/status', 'Withdraw\WithdrawController@status');
    Route::get('/withdraw/withdraw_detail/{id}', 'Withdraw\WithdrawController@show');

    // ============================= WITHDRAW MATEROAL =============================
    Route::get('/withdraw/withdraw_material', 'Withdraw\WithdrawMaterialController@index');
    Route::get('/withdraw/withdraw_material_create', 'Withdraw\WithdrawMaterialController@create');
    Route::post('/withdraw_e/store', 'Withdraw\WithdrawMaterialController@store');
    Route::get('/withdraw/withdraw_material_edit/{id}', 'Withdraw\WithdrawMaterialController@edit');
    Route::post('/withdraw_e/update', 'Withdraw\WithdrawMaterialController@update');
    Route::get('/withdraw_e/destroy/{id}', 'Withdraw\WithdrawMaterialController@destroy');
    Route::post('/withdraw_e/status', 'Withdraw\WithdrawMaterialController@status');
    Route::get('/withdraw/withdraw_material_detail/{id}', 'Withdraw\WithdrawMaterialController@show');

    // ============================= ODER =============================
    Route::get('/order/order_index', 'Customer\OrderController@index');
    Route::get('/order/order_create', 'Customer\OrderController@create');
    Route::post('/order/store', 'Customer\OrderController@store');
    Route::get('/order/order_edit/{id}', 'Customer\OrderController@edit');
    Route::post('/order/update', 'Customer\OrderController@update');
    Route::get('/order/destroy/{id}', 'Customer\OrderController@destroy');
    Route::get('/order/order_detail/{id}', 'Customer\OrderController@show');
    Route::post('/select_order', 'Customer\OrderController@select_order');
    Route::post('/order/status', 'Customer\OrderController@status');
    Route::get('/order/cancel/{id}', 'Customer\OrderController@cancel');

    // ============================= SHIPMENT =============================
    Route::get('/shipment/shipment_index', 'Customer\ShipmentController@index');
    // Route::get('/shipment/shipment_create', 'Customer\ShipmentController@create');
    Route::post('/shipment/store', 'Customer\ShipmentController@store');
    Route::post('/select_customer', 'Customer\ShipmentController@select_customer');
    Route::post('/shipment/insert', 'Customer\ShipmentController@insert');
    Route::get('/shipment/shipment_edit/{id}', 'Customer\ShipmentController@edit');
    Route::post('/shipment/update', 'Customer\ShipmentController@update');
    Route::get('/shipment/destroy/{id}', 'Customer\ShipmentController@destroy');
    Route::post('/shipment/status', 'Customer\ShipmentController@status');
    Route::get('/shipment/shipment_detail/{id}', 'Customer\ShipmentController@show');
    Route::post('/shipment/price', 'Customer\ShipmentController@price');

    Route::get('/shipment/shipment_create/{id}', 'Customer\ShipmentController@create');

    // ============================= RETURN =============================
    Route::get('/return/return_index', 'Customer\ReturnController@index');
    Route::get('/return/return_create/{id}', 'Customer\ReturnController@create');
    Route::post('/return/return_insert', 'Customer\ReturnController@store');
    Route::get('/return/destroy/{id}', 'Customer\ReturnController@destroy');
    Route::get('/return/return_edit/{id}', 'Customer\ReturnController@edit');
    Route::post('/return/return_update', 'Customer\ReturnController@update');
    Route::post('/return/status', 'Customer\ReturnController@status');

    Route::get('/return/return_detail/{id}', 'Customer\ReturnController@show');
    Route::get('/return/return_product_detail/{id}', 'Customer\ReturnController@show_p');
    Route::get('/return/return_form/{id}', 'Customer\ReturnController@edit2');
    Route::post('/return/update', 'Customer\ReturnController@update2');
    Route::post('/return/ship_select', 'Customer\ReturnController@ship_select');
    
    // ============================= PDF =============================
    Route::get('/PDF/product_pdf', 'PDF\PDFController@product_index');
    Route::get('/PDF/withdraw_pdf/{id}', 'PDF\PDFController@withdraw_detail');
    Route::get('/PDF/order_pdf/{id}', 'PDF\PDFController@order_detail');
    Route::get('/PDF/production_pdf/{id}', 'PDF\PDFController@production_detail');
    
});
// });