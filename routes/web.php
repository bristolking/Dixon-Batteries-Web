<?php

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


//Clear Cache

Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('config:cache');
    return '<h2>Cache,Route,View,Config Cleared</h2>';
});

//Clear Cache


Route::get('/testing', function () {
    
    return view('admin.testing');
    
});






Auth::routes();

//Home Controller

Route::get('/', 'HomeController@index')->name('index');

Route::get('/logout', 'HomeController@logout');


//Home Controller
//Admin Controller


Route::any('/my_profile', 'AdminController@my_profile');

//Distributors

Route::get('/dealers', 'AdminController@dealers');

Route::get('/dealers_list_json', 'AdminController@dealers_list_json');

Route::any('/dealer/add', 'AdminController@dealer_add');

Route::any('/dealer/edit/{id}', 'AdminController@dealer_edit');

Route::get('dealer/view/{id}', 'AdminController@dealer_view');

Route::any('dealer/import', 'AdminController@dealer_import');

//Distributors
//Common Service

Route::get('/update_status/{table}/{id}/{status}', 'AdminController@update_status');

//Common Service
//Categories

Route::get('/categories', 'AdminController@categories');

Route::get('/categories_list_json', 'AdminController@categories_list_json');

Route::any('/category/add', 'AdminController@category_add');

Route::any('/category/edit/{id}', 'AdminController@category_edit');

//Categories     
//Categories

Route::get('/sub_categories', 'AdminController@sub_categories');

Route::get('/sub_categories_list_json', 'AdminController@sub_categories_list_json');

Route::any('/sub_category/add', 'AdminController@sub_category_add');

Route::any('/sub_category/edit/{id}', 'AdminController@sub_category_edit');

Route::post('/get_sub_categories','AdminController@get_sub_categories');

//Categories     
//Products

Route::get('/products', 'AdminController@products');

Route::get('/products_list_json', 'AdminController@products_list_json');

Route::any('/product/add', 'AdminController@product_add');

Route::any('/product/edit/{id}', 'AdminController@product_edit');

Route::get('/product/view/{id}', 'AdminController@product_view');

//products
//Battery Analysis

Route::get('/battery_analysis', 'AdminController@battery_analysis');

Route::get('/battery_analysis_list_json', 'AdminController@battery_analysis_list_json');

Route::any('/battery_analysis/add', 'AdminController@battery_analysis_add');

Route::any('/battery_analysis/edit/{id}', 'AdminController@battery_analysis_edit');

Route::get('/battery_analysis/view/{id}', 'AdminController@battery_analysis_view');

//Battery Analysis
//Battery Complaints

Route::get('/battery_complaints', 'AdminController@battery_complaints');

Route::get('/battery_complaints_list_json', 'AdminController@battery_complaints_list_json');

Route::any('/battery_complaint/add', 'AdminController@battery_complaint_add');

Route::any('battery_complaint/edit/{id}', 'AdminController@battery_complaint_edit');

Route::any('battery_complaint/view/{id}', 'AdminController@battery_complaint_view');

//Battery Complaints
//Settings

//Route::get('/settings/warranty', 'AdminController@warranty');
//
//Route::get('/settings/warranty_list_json', 'AdminController@warranty_list_json');
//
//Route::any('/settings/warranty/add', 'AdminController@warranty_add');
//
//Route::any('/settings/warranty/edit/{id}', 'AdminController@warranty_edit');

//Settings

//Orders

Route::get('orders','AdminController@orders');

Route::get('/orders_list_json', 'AdminController@orders_list_json');

Route::any('order/add','AdminController@order_add');

Route::any('order/edit/{id}','AdminController@order_edit');

Route::any('order/view/{id}','AdminController@order_view');


//Route::get('order/accepted','AdminController@order_accepted');

//Route::get('/accepted_list_json', 'AdminController@accepted_list_json');

//Route::get('order/dispatched','AdminController@order_dispatched');

//Route::get('/dispatched_list_json', 'AdminController@dispatched_list_json');

//Route::get('order/pending','AdminController@order_pending');

//Route::get('/pending_list_json', 'AdminController@pending_list_json');

//Route::get('order/declined','AdminController@order_declined');

//Route::get('/declined_list_json', 'AdminController@declined_list_json');

//Route::get('order/delivered','AdminController@order_delivered');

//Route::get('/delivered_list_json', 'AdminController@delivered_list_json');

//Orders


//Points

Route::get('points','AdminController@points');

Route::get('/points_list_json', 'AdminController@points_list_json');

Route::get('/point/view/{user_id}', 'AdminController@point_view');

//Points


//Promotions

Route::get('/promotions', 'AdminController@promotions');

Route::any('/promotion/add', 'AdminController@promotion_add');

Route::get('/promotions_list_json', 'AdminController@promotions_list_json');

Route::get('/promotion/view/{id}', 'AdminController@promotion_view');

//Promotions

//Tagets

Route::get('/targets', 'AdminController@targets');

Route::any('/target/add', 'AdminController@target_add');

Route::get('/targets_list_json', 'AdminController@targets_list_json');

Route::any('/target/edit/{id}','AdminController@target_edit');

Route::get('/target/view/{id}','AdminController@target_view');

//Tagets

//Admin Controller






//API Controller


Route::get('api_console','APIController@api_console');


Route::post('app/login','APIController@login');

Route::get('app/send_otp/{mobile_number}','APIController@send_otp');

Route::get('app/check_otp/{mobile_number}/{otp}','APIController@check_otp');

Route::get('app/change_password/{mobile_number}/{password}','APIController@change_password');

Route::get('app/categories/list','APIController@categories_list');

Route::get('app/sub_categories/list/{category_id}','APIController@sub_categories_list');

Route::get('app/orders/list/{dealer_id}/{status}','APIController@orders_list');

Route::get('app/products/list','APIController@products');

Route::get('app/products_by_subcategory/list/{sub_category}','APIController@products_by_subcategory');

Route::get('app/product_details/{product_id}','APIController@product_details');

Route::post('app/order_now','APIController@order_now');

Route::get('app/order/statuses','APIController@order_statuses');

Route::post('app/profile/update','APIController@update_profile');

Route::post('app/battery_analysis/add','APIController@battery_analysis_add');

Route::post('app/battery_complaint/add','APIController@battery_complaint_add');

Route::get('app/promotion/get','APIController@promotion_get');

Route::post('app/target/get','APIController@target_get');





//API Controller