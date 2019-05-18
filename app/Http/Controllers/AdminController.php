<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Session;
use DB;
use PDF;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function testing() {
        return view('admin.testing');
    }

    public function update_status($table, $id, $status) {
        try {
            if ($table == 'users') {
                $update_status = DB::table('users')
                        ->where('id', $id)
                        ->update(['status' => $status]);
            } elseif ($table == 'categories') {
                $update_status = DB::table('categories')
                        ->where('category_id', $id)
                        ->update(['status' => $status]);
            } elseif ($table == 'products') {
                $update_status = DB::table('products')
                        ->where('product_id', $id)
                        ->update(['status' => $status]);
            } elseif ($table == 'battery_analysis') {
                $update_status = DB::table('battery_analysis')
                        ->where('battery_analysis_id', $id)
                        ->update(['status' => $status]);
            } elseif ($table == 'battery_complaints') {
                $update_status = DB::table('battery_complaints')
                        ->where('battery_complaint_id', $id)
                        ->update(['status' => $status]);
            } elseif ($table == 'warranty') {
                $update_status = DB::table('warranty')
                        ->where('warranty_id', $id)
                        ->update(['status' => $status]);
            } elseif ($table == 'sub_categories') {
                $update_status = DB::table('sub_categories')
                        ->where('sub_cat_id', $id)
                        ->update(['status' => $status]);
            } elseif ($table == 'promotions') {
                $update_status = DB::table('promotions')
                        ->where('promotion_id', $id)
                        ->update(['status' => $status, 'updated_at' => new \DateTime()]);
            } elseif ($table == 'target') {
                $update_status = DB::table('targets')
                        ->where('target_id', $id)
                        ->update(['status' => $status]);
            }
        } catch (\Exception $e) {
            
        }
        echo 'success';
    }

    public function my_profile(Request $request) {
        if ($_POST) {
            if (!empty($request['name']) && !empty($request['email'])) {
                try {
                    DB::table('users')
                            ->where('id', $request['row_id'])
                            ->update(['name' => $request['name'],
                                'email' => $request['email'],
                                'mobile_number' => $request['mobile_number'],
                                'dealer_code' => $request['dealer_code']
                    ]);
                } catch (\Exception $e) {
                    
                }
                Session::flash('success', 'Profile updated successfully!');
                return redirect('my_profile');
            } else {
                Session::flash('fail', 'Please enter mandatory fields to update!');
                return redirect('my_profile');
            }
        } else {
            $auth_user = Auth::user();
            $content['user'] = $auth_user;
            return view('admin.my_profile', $content);
        }
    }

    public function dealers() {
        return view('admin.dealer.index');
    }

    public function dealers_list_json() {
        $dealers_list_json = DB::table('users')
                ->where('user_type', '2')
                ->orderBy('id', 'DESC')
                ->get();
        echo json_encode($dealers_list_json, 1);
    }

    public function dealer_add(Request $request) {
        if ($_POST) {
            $this->validate($request, [
                'name' => 'required',
                'location' => 'required',
                'email' => 'required',
                'firm_name' => 'required',
                'mobile_number' => 'required',
                'dealer_code' => 'required',
                'gst_no' => 'required',
                'vat_no' => 'required',
                'rating' => 'required',
            ]);
            try {
                $ins_id = DB::table('users')
                        ->insert(['name' => $request['name'],
                    'email' => $request['email'],
                    'firm_name' => $request['firm_name'],
                    'mobile_number' => $request['mobile_number'],
                    'dealer_code' => $request['dealer_code'],
                    'gst_no' => $request['gst_no'],
                    'address' => $request['address'],
                    'rating' => $request['rating'],
                    'vat_no' => $request['vat_no'],
                    'location' => $request['location'],
                    'password' => Hash::make('Dixon123'),
                    'user_type' => '2',
                    'status' => '1',
                    'created_at' => new \DateTime(),
                    'updated_at' => new \DateTime()
                ]);
            } catch (\Exception $e) {
                
            }
            if (isset($ins_id) && !empty($ins_id)) {
                Session::flash('success', 'Dealer created successfully!');
            } else {
                Session::flash('fail', 'Dealer could not be created!');
            }
            return redirect('dealers');
        } else {
            return view('admin.dealer.add');
        }
    }

    public function dealer_edit(Request $request, $id) {
        if ($_POST) {
            $this->validate($request, [
                'name' => 'required',
                'location' => 'required',
                'email' => 'required',
                'firm_name' => 'required',
                'mobile_number' => 'required',
                'dealer_code' => 'required',
                'gst_no' => 'required',
                'vat_no' => 'required',
                'rating' => 'required',
            ]);
            try {
                $upd_id = DB::table('users')
                        ->where('id', $id)
                        ->update(['name' => $request['name'],
                    'email' => $request['email'],
                    'firm_name' => $request['firm_name'],
                    'mobile_number' => $request['mobile_number'],
                    'dealer_code' => $request['dealer_code'],
                    'gst_no' => $request['gst_no'],
                    'address' => $request['address'],
                    'rating' => $request['rating'],
                    'vat_no' => $request['vat_no'],
                    'location' => $request['location'],
                    'user_type' => '2',
                    'updated_at' => new \DateTime()
                ]);
            } catch (\Exception $e) {
                
            }
            Session::flash('success', 'Dealer updated successfully!');
            return redirect('dealers');
        } else {
            $dealer = DB::table('users')->where('id', $id)->first();
            $content['dealer'] = $dealer;
            return view('admin.dealer.edit', $content);
        }
    }

    public function dealer_view($id) {
        $dealer = DB::table('users')->where('id', $id)->first();
        $content['dealer'] = $dealer;
        return view('admin.dealer.view', $content);
    }

    public function categories() {
        return view('admin.category.index');
    }

    public function categories_list_json() {
        $categories_list_json = DB::table('categories')
                ->orderBy('category_id', 'DESC')
                ->get();
        echo json_encode($categories_list_json, 1);
    }

    public function category_add(Request $request) {
        if ($_POST) {
            $this->validate($request, [
                'category_name' => 'required',
            ]);
            try {
                $ins_id = DB::table('categories')
                        ->insert(['category_name' => $request['category_name'],
                    'category_desc' => $request['category_desc'],
                    'status' => '1',
                    'created_by' => Auth::user()->id,
                    'created_at' => new \DateTime(),
                    'updated_at' => new \DateTime()
                ]);
            } catch (\Exception $e) {
                
            }
            if (isset($ins_id) && !empty($ins_id)) {
                Session::flash('success', 'Category created successfully!');
            } else {
                Session::flash('fail', 'Category could not be created!');
            }
            return redirect('categories');
        } else {
            return view('admin.category.add');
        }
    }

    public function category_edit(Request $request, $id) {
        if ($_POST) {
            $this->validate($request, [
                'category_name' => 'required',
            ]);
            try {
                $upd_id = DB::table('categories')
                        ->where('category_id', $id)
                        ->update(['category_name' => $request['category_name'],
                    'category_desc' => $request['category_desc'],
                    'created_by' => Auth::user()->id,
                    'updated_at' => new \DateTime()
                ]);
            } catch (\Exception $e) {
                
            }
            Session::flash('success', 'Category updated successfully!');
            return redirect('categories');
        } else {
            $category = DB::table('categories')->where('category_id', $id)->first();
            $content['category'] = $category;
            return view('admin.category.edit', $content);
        }
    }

    public function products() {
        return view('admin.product.index');
    }

    public function products_list_json() {
        DB::statement(DB::raw('set @row:=0'));
        $products_list_json = DB::table('products')
                ->join('sub_categories', 'products.sub_category_id', 'sub_categories.sub_cat_id')
                ->leftjoin('categories', 'sub_categories.category_id', 'categories.category_id')
                ->orderBy('products.product_id', 'DESC')
                ->select(DB::raw('@row:=@row+1 as s_no'), 'products.*', 'categories.category_name', 'sub_categories.sub_category_name')
                ->get();
        echo json_encode($products_list_json, 1);
    }

    public function product_add(Request $request) {
        if ($_POST) {
            $this->validate($request, [
                'model' => 'required',
                'container' => 'required',
                'capacity' => 'required',
                'length' => 'required',
                'width' => 'required',
                'height' => 'required',
                'charging_current' => 'required',
                'filled_weight' => 'required',
                'sub_category_id' => 'required',
                'points' => 'required',
                'price' => 'required',
            ]);

            if ($request->hasFile('pic')) {
                //File Upload
                $images = $request->file('pic');
                foreach ($images as $image):
                    $ren_img = date('hisYdm') . '_' . $image->getClientOriginalName();
                    $image->move(
                            base_path() . '/public/uploads/images/', $ren_img
                    );
                    $path[] = $request->root() . '/public/uploads/images/' . $ren_img;
                endforeach;
                $path_json = json_encode($path, 1);
                //File Upload;
            } else {
                $path_json = '';
            }


            try {
                $ins_id = DB::table('products')
                        ->insert(['model' => $request['model'],
                    'container' => $request['container'],
                    'capacity' => $request['capacity'],
                    'length' => $request['length'],
                    'width' => $request['width'],
                    'height' => $request['height'],
                    'charging_current' => $request['charging_current'],
                    'filled_weight' => $request['filled_weight'],
                    'sub_category_id' => $request['sub_category_id'],
                    'points' => $request['points'],
                    'price' => $request['price'],
                    'image_paths' => $path_json,
                    'status' => '1',
                    'created_by' => Auth::user()->id,
                    'created_at' => new \DateTime(),
                    'updated_at' => new \DateTime()
                ]);
            } catch (\Exception $e) {
                
            }
            if (isset($ins_id) && !empty($ins_id)) {
                Session::flash('success', 'Product created successfully!');
            } else {
                Session::flash('fail', 'Product could not be created!');
            }
            return redirect('products');
        } else {
            $categories = DB::table('categories')
                    ->where('status', '1')
                    ->get();
            $content['categories'] = $categories;
            return view('admin.product.add', $content);
        }
    }

    public function product_edit(Request $request, $id) {
        if ($_POST) {
            $this->validate($request, [
                'model' => 'required',
                'container' => 'required',
                'capacity' => 'required',
                'length' => 'required',
                'width' => 'required',
                'height' => 'required',
                'charging_current' => 'required',
                'filled_weight' => 'required',
                'sub_category_id' => 'required',
                'points' => 'required',
                'price' => 'required',
            ]);
            if ($request->hasFile('pic')) {
                //File Upload
                $images = $request->file('pic');
                foreach ($images as $image):
                    $ren_img = date('hisYdm') . '_' . $image->getClientOriginalName();
                    $image->move(
                            base_path() . '/public/uploads/images/', $ren_img
                    );
                    $path[] = $request->root() . '/public/uploads/images/' . $ren_img;
                endforeach;
                $path_json = json_encode($path, 1);
                //File Upload;
            } else {
                $path_json = $request['ori_image'];
            }
            try {
                $upd_id = DB::table('products')
                        ->where('product_id', $id)
                        ->update(['model' => $request['model'],
                    'container' => $request['container'],
                    'capacity' => $request['capacity'],
                    'length' => $request['length'],
                    'width' => $request['width'],
                    'height' => $request['height'],
                    'charging_current' => $request['charging_current'],
                    'filled_weight' => $request['filled_weight'],
                    'sub_category_id' => $request['sub_category_id'],
                    'points' => $request['points'],
                    'price' => $request['price'],
                    'image_paths' => $path_json,
                    'created_by' => Auth::user()->id,
                    'updated_at' => new \DateTime()
                ]);
            } catch (\Exception $e) {
                echo'<pre>';
                print_r($e->getMessage());
                exit;
            }
            Session::flash('success', 'Product updated successfully!');
            return redirect('products');
        } else {
            $product = DB::table('products')
                    ->join('sub_categories', 'products.sub_category_id', 'sub_categories.sub_cat_id')
                    ->where('product_id', $id)
                    ->select('products.*', 'sub_categories.category_id')
                    ->first();
//            echo'<Pre>';print_r($product);exit;
            $categories = DB::table('categories')
                    ->where('status', '1')
                    ->get();
            $content['categories'] = $categories;
            $content['product'] = $product;
            return view('admin.product.edit', $content);
        }
    }

    public function product_view($id) {
        $product = DB::table('products')
                ->join('sub_categories', 'products.sub_category_id', 'sub_categories.sub_cat_id')
                ->leftjoin('categories', 'sub_categories.category_id', 'categories.category_id')
                ->where('product_id', $id)
                ->select('products.*', 'categories.category_name', 'sub_categories.sub_category_name')
                ->first();
        $content['product'] = $product;
        return view('admin.product.view', $content);
    }

    public function battery_analysis() {
        $dealers = DB::table('users')
                ->where('user_type', '2')
                ->get();
        $content['dealers'] = $dealers;
        $products = DB::table('products')
                ->where('products.status', 1)
                ->get();
        $content['dealers'] = $dealers;
        $content['products'] = $products;
        return view('admin.battery_analysis.index', $content);
    }

    public function battery_analysis_list_json() {
        $battery_analysis_list_json = DB::table('battery_analysis')
                ->join('users', 'battery_analysis.dealer_id', '=', 'users.id')
                ->join('products', 'battery_analysis.product_id', '=', 'products.product_id')
                ->leftjoin('sub_categories', 'products.sub_category_id', 'sub_categories.sub_cat_id')
                ->leftjoin('categories', 'sub_categories.category_id', 'categories.category_id')
                ->orderBy('battery_analysis.battery_analysis_id', 'DESC')
                ->select('battery_analysis.*', 'users.name', 'users.dealer_code', 'products.model', 'categories.category_name', 'sub_categories.sub_category_name')
                ->get();
        echo json_encode($battery_analysis_list_json, 1);
    }

    public function battery_analysis_add(Request $request) {
        if ($_POST) {
            $this->validate($request, [
                'dealer_id' => 'required',
                'battery_sno' => 'required',
                'product_details' => 'required',
                'physical_status' => 'required',
                'acid_level' => 'required',
            ]);
            $product_split = explode('_', $request->product_details);
            $product_id = $product_split[0];
            try {
                $ins_id = DB::table('battery_analysis')
                        ->insert(['battery_sno' => $request['battery_sno'],
                    'product_id' => $product_id,
                    'ocv' => $request['ocv'],
                    'physical_status' => $request['physical_status'],
                    'acid_level' => $request['acid_level'],
                    'cell_wise_acid_sp_gr' => $request['cell_wise_acid_sp_gr'],
                    'charge_details' => $request['charge_details'],
                    'test_details' => $request['test_details'],
                    'battery_resend_on' => $request['battery_resend_on'],
                    'replaced_battery_sno' => $request['replaced_battery_sno'],
                    'dealer_id' => $request['dealer_id'],
                    'status' => '1',
                    'created_by' => Auth::user()->id,
                    'created_at' => new \DateTime(),
                    'updated_at' => new \DateTime()
                ]);
            } catch (\Exception $e) {
                
            }
            if (isset($ins_id) && !empty($ins_id)) {
                Session::flash('success', 'Battery analysis created successfully!');
            } else {
                Session::flash('fail', 'Battery analysis could not be created!');
            }
            return redirect('battery_analysis');
        } else {
            $products = DB::table('products')
                    ->join('sub_categories', 'products.sub_category_id', 'sub_categories.sub_cat_id')
                    ->leftjoin('categories', 'sub_categories.category_id', 'categories.category_id')
                    ->where('products.status', 1)
                    ->select('products.*', 'categories.category_name', 'sub_categories.sub_category_name')
                    ->get();
            $dealers = DB::table('users')->where('user_type', '2')->get();
            $content['products'] = $products;
            $content['dealers'] = $dealers;
            return view('admin.battery_analysis.add', $content);
        }
    }

    public function battery_analysis_edit(Request $request, $id) {
        if ($_POST) {
            $this->validate($request, [
                'dealer_id' => 'required',
                'battery_sno' => 'required',
                'product_details' => 'required',
                'physical_status' => 'required',
                'acid_level' => 'required',
            ]);
            $product_split = explode('_', $request->product_details);
            $product_id = $product_split[0];
            try {
                $upd_id = DB::table('battery_analysis')
                        ->where('battery_analysis_id', $id)
                        ->update(['battery_sno' => $request['battery_sno'],
                    'product_id' => $product_id,
                    'ocv' => $request['ocv'],
                    'physical_status' => $request['physical_status'],
                    'acid_level' => $request['acid_level'],
                    'cell_wise_acid_sp_gr' => $request['cell_wise_acid_sp_gr'],
                    'charge_details' => $request['charge_details'],
                    'test_details' => $request['test_details'],
                    'battery_resend_on' => $request['battery_resend_on'],
                    'replaced_battery_sno' => $request['replaced_battery_sno'],
                    'dealer_id' => $request['dealer_id'],
                    'created_by' => Auth::user()->id,
                    'updated_at' => new \DateTime()
                ]);
            } catch (\Exception $e) {
                
            }
            Session::flash('success', 'Battery analysis updated successfully!');
            return redirect('battery_analysis');
        } else {
            $battery_analysis = DB::table('battery_analysis')
                    ->join('products', 'battery_analysis.product_id', '=', 'products.product_id')
                    ->leftjoin('sub_categories', 'products.sub_category_id', 'sub_categories.sub_cat_id')
                    ->leftjoin('categories', 'sub_categories.category_id', 'categories.category_id')
                    ->where('battery_analysis.battery_analysis_id', $id)
                    ->select('battery_analysis.*', 'categories.category_name', 'sub_categories.sub_category_name')
                    ->first();
            $products = DB::table('products')
                    ->join('sub_categories', 'products.sub_category_id', 'sub_categories.sub_cat_id')
                    ->leftjoin('categories', 'sub_categories.category_id', 'categories.category_id')
                    ->where('products.status', 1)
                    ->select('products.*', 'categories.category_name', 'sub_categories.sub_category_name')
                    ->get();
            $dealers = DB::table('users')->where('user_type', '2')->get();
            $content['products'] = $products;
            $content['dealers'] = $dealers;
            $content['battery_analysis'] = $battery_analysis;
            return view('admin.battery_analysis.edit', $content);
        }
    }

    public function battery_analysis_view($id) {
        $battery_analysis = DB::table('battery_analysis')
                ->join('users', 'battery_analysis.dealer_id', '=', 'users.id')
                ->join('products', 'battery_analysis.product_id', '=', 'products.product_id')
                ->leftjoin('sub_categories', 'products.sub_category_id', 'sub_categories.sub_cat_id')
                ->leftjoin('categories', 'sub_categories.category_id', 'categories.category_id')
                ->select('battery_analysis.*', 'users.name', 'users.dealer_code', 'products.model', 'categories.category_name', 'sub_categories.sub_category_name')
                ->where('battery_analysis.battery_analysis_id', $id)
                ->first();
        $content['battery_analysis'] = $battery_analysis;
        return view('admin.battery_analysis.view', $content);
    }

    public function battery_complaints() {
        $dealers = DB::table('users')
                ->where('user_type', '2')
                ->get();
        $content['dealers'] = $dealers;
        $products = DB::table('products')
                ->where('products.status', 1)
                ->get();
        $content['dealers'] = $dealers;
        $content['products'] = $products;
        return view('admin.battery_complaint.index', $content);
    }

    public function battery_complaints_list_json() {
        $battery_complaints_list_json = DB::table('battery_complaints')
                ->join('users', 'battery_complaints.dealer_id', '=', 'users.id')
                ->join('products', 'battery_complaints.product_id', '=', 'products.product_id')
                ->leftjoin('sub_categories', 'products.sub_category_id', 'sub_categories.sub_cat_id')
                ->leftjoin('categories', 'sub_categories.category_id', 'categories.category_id')
                ->orderBy('battery_complaints.battery_complaint_id', 'DESC')
                ->select('battery_complaints.*', 'users.name', 'users.dealer_code', 'products.model', 'categories.category_name', 'sub_categories.sub_category_name')
                ->get();
        echo json_encode($battery_complaints_list_json, 1);
    }

    public function battery_complaint_add(Request $request) {
        if ($_POST) {
            $this->validate($request, [
                'dealer_id' => 'required',
                'product_details' => 'required',
                'battery_serial_no' => 'required',
                'complaint_date' => 'required',
                'complaint' => 'required',
            ]);
            $product_split = explode('_', $request->product_details);
            $product_id = $product_split[0];
            try {
                $ins_id = DB::table('battery_complaints')
                        ->insert(['customer_name' => $request['customer_name'],
                    'battery_serial_no' => $request['battery_serial_no'],
                    'product_id' => $product_id,
                    'complaint_date' => $request['complaint_date'],
                    'complaint' => $request['complaint'],
                    'dealer_id' => $request['dealer_id'],
                    'status' => '1',
                    'created_by' => Auth::user()->id,
                    'created_at' => new \DateTime(),
                    'updated_at' => new \DateTime()
                ]);
            } catch (\Exception $e) {
                
            }
            if (isset($ins_id) && !empty($ins_id)) {
                Session::flash('success', 'Battery complaint created successfully!');
            } else {
                Session::flash('fail', 'Battery complaint could not be created!');
            }
            return redirect('battery_complaints');
        } else {
            $dealers = DB::table('users')->where('user_type', '2')->get();
            $products = DB::table('products')
                    ->join('sub_categories', 'products.sub_category_id', 'sub_categories.sub_cat_id')
                    ->leftjoin('categories', 'sub_categories.category_id', 'categories.category_id')
                    ->where('products.status', 1)
                    ->select('products.*', 'categories.category_name', 'sub_categories.sub_category_name')
                    ->get();
            $content['dealers'] = $dealers;
            $content['products'] = $products;
            return view('admin.battery_complaint.add', $content);
        }
    }

    public function battery_complaint_view($id) {
        $battery_complaint = DB::table('battery_complaints')
                ->join('users', 'battery_complaints.dealer_id', '=', 'users.id')
                ->join('products', 'battery_complaints.product_id', '=', 'products.product_id')
                ->leftjoin('sub_categories', 'products.sub_category_id', 'sub_categories.sub_cat_id')
                ->leftjoin('categories', 'sub_categories.category_id', 'categories.category_id')
                ->where('battery_complaints.battery_complaint_id', $id)
                ->select('battery_complaints.*', 'users.name', 'users.dealer_code', 'products.model', 'categories.category_name', 'sub_categories.sub_category_name')
                ->first();
//        echo'<pre>';print_r($battery_complaint);exit;
        $content['battery_complaint'] = $battery_complaint;
        return view('admin.battery_complaint.view', $content);
    }

    public function battery_complaint_edit(Request $request, $id) {
        if ($_POST) {
            $this->validate($request, [
                'dealer_id' => 'required',
                'product_details' => 'required',
                'battery_serial_no' => 'required',
                'complaint_date' => 'required',
                'complaint' => 'required',
            ]);
            $product_split = explode('_', $request->product_details);
            $product_id = $product_split[0];
            try {
                $upd_id = DB::table('battery_complaints')
                        ->where('battery_complaint_id', $id)
                        ->update(['customer_name' => $request['customer_name'],
                    'battery_serial_no' => $request['battery_serial_no'],
                    'product_id' => $product_id,
                    'complaint_date' => $request['complaint_date'],
                    'complaint' => $request['complaint'],
                    'dealer_id' => $request['dealer_id'],
                    'created_by' => Auth::user()->id,
                    'updated_at' => new \DateTime()
                ]);
            } catch (\Exception $e) {
                
            }
            Session::flash('success', 'Battery Complaint updated successfully!');
            return redirect('battery_complaints');
        } else {
            $battery_complaint = DB::table('battery_complaints')
                    ->join('products', 'battery_complaints.product_id', '=', 'products.product_id')
                    ->leftjoin('sub_categories', 'products.sub_category_id', 'sub_categories.sub_cat_id')
                    ->leftjoin('categories', 'sub_categories.category_id', 'categories.category_id')
                    ->where('battery_complaints.battery_complaint_id', $id)
                    ->select('battery_complaints.*', 'categories.category_name', 'sub_categories.sub_category_name')
                    ->first();
            $dealers = DB::table('users')->where('user_type', '2')->get();
            $products = DB::table('products')
                    ->join('sub_categories', 'products.sub_category_id', 'sub_categories.sub_cat_id')
                    ->leftjoin('categories', 'sub_categories.category_id', 'categories.category_id')
                    ->where('products.status', 1)
                    ->select('products.*', 'categories.category_name', 'sub_categories.sub_category_name')
                    ->get();
            $content['dealers'] = $dealers;
            $content['products'] = $products;
            $content['battery_complaint'] = $battery_complaint;
            return view('admin.battery_complaint.edit', $content);
        }
    }

//    public function warranty() {
//        return view('admin.settings.warranty.index');
//    }
//
//    public function warranty_list_json() {
//        $warranty_list_json = DB::table('warranty')->get();
//        echo json_encode($warranty_list_json, 1);
//    }
//
//    public function warranty_add(Request $request) {
//        if ($_POST) {
//            $this->validate($request, [
//                'months' => 'required',
//            ]);
//            try {
//                $ins_id = DB::table('warranty')
//                        ->insert(['months' => $request['months'],
//                    'description' => $request['description'],
//                    'status' => '1',
//                    'created_by' => Auth::user()->id,
//                    'created_at' => new \DateTime(),
//                    'updated_at' => new \DateTime()
//                ]);
//            } catch (\Exception $e) {
//                
//            }
//            if (isset($ins_id) && !empty($ins_id)) {
//                Session::flash('success', 'Warranty created successfully!');
//            } else {
//                Session::flash('fail', 'Warranty could not be created!');
//            }
//            return redirect('settings/warranty');
//        } else {
//            return view('admin.settings.warranty.add');
//        }
//    }
//
//    public function warranty_edit(Request $request, $id) {
//        if ($_POST) {
//            $this->validate($request, [
//                'months' => 'required',
//            ]);
//            try {
//                $upd_id = DB::table('warranty')
//                        ->where('warranty_id', $id)
//                        ->update(['months' => $request['months'],
//                    'description' => $request['description'],
//                    'created_by' => Auth::user()->id,
//                    'updated_at' => new \DateTime()
//                ]);
//            } catch (\Exception $e) {
//                
//            }
//            Session::flash('success', 'Warranty updated successfully!');
//            return redirect('settings/warranty');
//        } else {
//            $warranty = DB::table('warranty')->where('warranty_id', $id)->first();
//            $content['warranty'] = $warranty;
//            return view('admin.settings.warranty.edit', $content);
//        }
//    }

    public function sub_categories() {
        $categories = DB::table('categories')->where('status', 1)->get();
        $content['categories'] = $categories;
        return view('admin.sub_category.index', $content);
    }

    public function sub_categories_list_json() {
        $sub_categories_list_json = DB::table('sub_categories')
                ->leftJoin('categories', 'categories.category_id', '=', 'sub_categories.category_id')
                ->select('sub_categories.*', 'categories.category_name')
                ->orderBy('sub_categories.sub_cat_id', 'DESC')
                ->get();
        echo json_encode($sub_categories_list_json, 1);
    }

    public function sub_category_add(Request $request) {
        if ($_POST) {
            $this->validate($request, [
                'sub_category_name' => 'required',
                'category_id' => 'required',
            ]);
            try {
                $ins_id = DB::table('sub_categories')
                        ->insert(['sub_category_name' => $request['sub_category_name'],
                    'category_id' => $request['category_id'],
                    'sub_category_desc' => $request['sub_category_desc'],
                    'status' => '1',
                    'created_by' => Auth::user()->id,
                    'created_at' => new \DateTime(),
                    'updated_at' => new \DateTime()
                ]);
            } catch (\Exception $e) {
                
            }
            if (isset($ins_id) && !empty($ins_id)) {
                Session::flash('success', 'Sub category created successfully!');
            } else {
                Session::flash('fail', 'Sub category could not be created!');
            }
            return redirect('sub_categories');
        } else {

            $categories = DB::table('categories')
                    ->where('status', '1')
                    ->select('category_id', 'category_name')
                    ->get();
            $content['categories'] = $categories;
            return view('admin.sub_category.add', $content);
        }
    }

    public function sub_category_edit(Request $request, $id) {
        if ($_POST) {
            $this->validate($request, [
                'sub_category_name' => 'required',
                'category_id' => 'required',
            ]);
            try {
                $upd_id = DB::table('sub_categories')
                        ->where('sub_cat_id', $id)
                        ->update(['sub_category_name' => $request['sub_category_name'],
                    'category_id' => $request['category_id'],
                    'sub_category_desc' => $request['sub_category_desc'],
                    'created_by' => Auth::user()->id,
                    'updated_at' => new \DateTime()
                ]);
            } catch (\Exception $e) {
                
            }
            Session::flash('success', 'Sub category updated successfully!');
            return redirect('sub_categories');
        } else {
            $sub_category = DB::table('sub_categories')->where('sub_cat_id', $id)->first();
            $categories = DB::table('categories')
                    ->select('category_id', 'category_name', 'status')
                    ->get();
            $content['categories'] = $categories;
            $content['sub_category'] = $sub_category;
            return view('admin.sub_category.edit', $content);
        }
    }

    public function get_sub_categories() {
        $category_id = $_POST['category_id'];
        $select_id = $_POST['select_id'];
        $sub_categories = DB::table('sub_categories')
                ->where('category_id', $category_id)
                ->get();
        $html = "";
        if (!empty($sub_categories)) {
            $html = "<option value=''>Please select...</option>";
            foreach ($sub_categories as $k => $sub_category) {
                $id = $sub_category->sub_cat_id;
                $name = $sub_category->sub_category_name;
                if ($id == $select_id) {
                    $html = $html . "<option value=" . $id . " selected=" . true . ">" . $name . "</option>";
                } else {
                    $html = $html . "<option value=" . $id . ">" . $name . "</option>";
                }
            }
        }
        echo json_encode($html, 1);
    }

    public function dealer_import(Request $request) {
        if ($_POST) {
            $dealers = '';
            if ($request->hasFile('dealers')) {
                $path = $request->file('dealers')->getRealPath();
                $data = Excel::load($path, function($reader) {
                            
                        })->get();
                if (!empty($data) && $data->count()) {
                    foreach ($data->toArray() as $k => $value) {
                        if (!empty($value)) {
                            foreach ($value as $l => $value1) {
                                if (isset($value1['dealer_name']) && isset($value1['firm_name']) && isset($value1['address']) && isset($value1['email']) && isset($value1['mobile_number']) && isset($value1['code']) && isset($value1['gst_number']) && isset($value1['vat_number']) && isset($value1['rating'])) {
                                    $dealers = '1';
                                    $existing_user = DB::table('users')->where('mobile_number', $value1['mobile_number'])->first();
                                    if (isset($existing_user) && !empty($existing_user)) {
                                        //Update
                                        try {
                                            $upd_id = DB::table('users')
                                                    ->where('id', $existing_user->id)
                                                    ->update(['name' => $value1['dealer_name'],
                                                'email' => $value1['email'],
                                                'firm_name' => $value1['firm_name'],
                                                'mobile_number' => $value1['mobile_number'],
                                                'dealer_code' => $value1['code'],
                                                'gst_no' => $value1['gst_number'],
                                                'address' => $value1['address'],
                                                'rating' => $value1['rating'],
                                                'vat_no' => $value1['vat_number'],
                                                'updated_at' => new \DateTime()
                                            ]);
                                        } catch (\Exception $e) {
                                            
                                        }
                                        //Update
                                    } else {
                                        //Insert
                                        try {
                                            $ins_id = DB::table('users')
                                                    ->insert(['name' => $value1['dealer_name'],
                                                'email' => $value1['email'],
                                                'firm_name' => $value1['firm_name'],
                                                'mobile_number' => $value1['mobile_number'],
                                                'dealer_code' => $value1['code'],
                                                'gst_no' => $value1['gst_number'],
                                                'address' => $value1['address'],
                                                'rating' => $value1['rating'],
                                                'vat_no' => $value1['vat_number'],
                                                'password' => Hash::make('Dixon123'),
                                                'user_type' => '2',
                                                'status' => '1',
                                                'created_at' => new \DateTime(),
                                                'updated_at' => new \DateTime()
                                            ]);
                                        } catch (\Exception $e) {
                                            
                                        }
                                        //Insert
                                    }
                                }
                            }
                        }
                    }
                    if (isset($dealers) && !empty($dealers)) {
                        Session::flash('success', 'Dealers uploaded successfully!');
                        return redirect('dealers');
                    } else {
                        Session::flash('fail', 'Headers could not be matched!');
                    }
                } else {
                    Session::flash('fail', 'Excel input has some errors!');
                }
            } else {
                Session::flash('fail', 'Empty form submitted!');
            }
            return redirect('dealer/import');
        } else {
            return view('admin.dealer.import');
        }
    }

    public function orders() {
        $dealers = DB::table('users')
                ->where('user_type', '2')
                ->get();
        $products = DB::table('products')
                ->where('products.status', 1)
                ->get();
        $content['dealers'] = $dealers;
        $content['products'] = $products;
        return view('admin.order.index', $content);
    }

    public function order_add(Request $request) {
        if ($_POST) {
            $this->validate($request, [
                'order_number' => 'required',
                'dealer_id' => 'required',
                'product_details' => 'required',
                'quantity' => 'required',
                'lr_number' => 'required',
            ]);
            $product_split = explode('_', $request->product_details);
            $product_id = $product_split[0];
            try {
                $ins_id = DB::table('orders')
                        ->insert(['order_number' => $request['order_number'],
                    'dealer_id' => $request['dealer_id'],
                    'product_id' => $product_id,
                    'quantity' => $request['quantity'],
                    'lr_number' => $request['lr_number'],
                    'accepted_date' => date('d-m-Y'),
                    'status' => 1,
                    'created_by' => Auth::user()->id,
                    'created_at' => new \DateTime(),
                    'updated_at' => new \DateTime()
                ]);
            } catch (\Exception $e) {
                
            }
            if (isset($ins_id) && !empty($ins_id)) {
                Session::flash('success', 'Order created successfully!');
            } else {
                Session::flash('fail', 'Order could not be created!');
            }
            return redirect('orders');
        } else {
            $dealers = DB::table('users')
                    ->where('user_type', '2')
                    ->get();
            $products = DB::table('products')
                    ->join('sub_categories', 'products.sub_category_id', 'sub_categories.sub_cat_id')
                    ->leftjoin('categories', 'sub_categories.category_id', 'categories.category_id')
                    ->where('products.status', 1)
                    ->select('products.*', 'categories.category_name', 'sub_categories.sub_category_name')
                    ->get();
            $content['dealers'] = $dealers;
            $content['products'] = $products;
            return view('admin.order.add', $content);
        }
    }

    public function orders_list_json() {
        DB::statement(DB::raw('set @row:=0'));
        $orders_list_json = DB::table('orders')
                ->join('users', 'orders.dealer_id', '=', 'users.id')
                ->join('products', 'orders.product_id', '=', 'products.product_id')
                ->join('sub_categories', 'products.sub_category_id', 'sub_categories.sub_cat_id')
                ->leftjoin('categories', 'sub_categories.category_id', 'categories.category_id')
                ->orderBy('orders.order_id', 'DESC')
                ->select(DB::raw('@row:=@row+1 as s_no'), 'orders.*', DB::raw('DATE_FORMAT(orders.created_at, "%d-%m-%Y") as ordered_date'), 'users.name', 'users.dealer_code', 'products.model', 'categories.category_name', 'sub_categories.sub_category_name')
                ->get();
        echo json_encode($orders_list_json, 1);
    }

    public function order_view($id) {
        $order = DB::table('orders')
                ->join('users', 'orders.dealer_id', '=', 'users.id')
                ->join('products', 'orders.product_id', '=', 'products.product_id')
                ->join('sub_categories', 'products.sub_category_id', 'sub_categories.sub_cat_id')
                ->leftjoin('categories', 'sub_categories.category_id', 'categories.category_id')
                ->select('orders.*', 'products.model', 'users.name', 'users.dealer_code', 'categories.category_name', 'sub_categories.sub_category_name')
                ->where('orders.order_id', $id)
                ->first();
        $content['order'] = $order;
        return view('admin.order.view', $content);
    }

    public function order_edit(Request $request, $id) {
        if ($_POST) {
            $this->validate($request, [
                'order_number' => 'required',
                'dealer_id' => 'required',
                'product_details' => 'required',
                'quantity' => 'required',
                'lr_number' => 'required',
                'status_date' => 'required',
            ]);
            $product_split = explode('_', $request->product_details);
            $product_id = $product_split[0];
            if ($request['status'] == 1) {
                DB::table('orders')
                        ->where('order_id', $id)
                        ->update(['accepted_date' => $request['status_date'],
                            'status' => $request['status']]);
            } elseif ($request['status'] == 2) {
                DB::table('orders')
                        ->where('order_id', $id)
                        ->update(['dispatched_date' => $request['status_date'],
                            'status' => $request['status']]);
            } elseif ($request['status'] == 3) {
                DB::table('orders')
                        ->where('order_id', $id)
                        ->update(['pending_date' => $request['status_date'],
                            'status' => $request['status']]);
            } elseif ($request['status'] == 4) {
                DB::table('orders')
                        ->where('order_id', $id)
                        ->update(['declined_date' => $request['status_date'],
                            'status' => $request['status']]);
            } elseif ($request['status'] == 5) {
                DB::table('orders')
                        ->where('order_id', $id)
                        ->update(['delivered_date' => $request['status_date'],
                            'status' => $request['status']]);
            }
            try {
                $upd_id = DB::table('orders')
                        ->where('order_id', $id)
                        ->update(['order_number' => $request['order_number'],
                    'dealer_id' => $request['dealer_id'],
                    'product_id' => $product_id,
                    'quantity' => $request['quantity'],
                    'lr_number' => $request['lr_number'],
                    'status' => $request['status'],
                    'created_by' => Auth::user()->id,
                    'updated_at' => new \DateTime()
                ]);
            } catch (\Exception $e) {
                
            }
            Session::flash('success', 'Order updated successfully!');
            return redirect('orders');
        } else {
            $order = DB::table('orders')
                    ->join('products', 'orders.product_id', '=', 'products.product_id')
                    ->join('sub_categories', 'products.sub_category_id', 'sub_categories.sub_cat_id')
                    ->leftjoin('categories', 'sub_categories.category_id', 'categories.category_id')
                    ->select('orders.*', 'categories.category_name', 'sub_categories.sub_category_name')
                    ->where('orders.order_id', $id)
                    ->first();
            $dealers = DB::table('users')
                    ->where('user_type', '2')
                    ->get();
            $products = DB::table('products')
                    ->join('sub_categories', 'products.sub_category_id', 'sub_categories.sub_cat_id')
                    ->leftjoin('categories', 'sub_categories.category_id', 'categories.category_id')
                    ->where('products.status', 1)
                    ->select('products.*', 'categories.category_name', 'sub_categories.sub_category_name')
                    ->get();
            $content['order'] = $order;
            $content['dealers'] = $dealers;
            $content['products'] = $products;
            return view('admin.order.edit', $content);
        }
    }

    public function points() {
        $dealers = DB::table('users')
                ->where('user_type', '2')
                ->get();
        $content['dealers'] = $dealers;
        return view('admin.point.index', $content);
    }

    public function points_list_json() {
        $points_list_json = array();
        $users = DB::table('users')
                ->where('user_type', 2)
                ->select('id', 'name', 'firm_name', 'email', 'mobile_number', 'dealer_code', 'gst_no', 'vat_no', 'address', 'location', 'rating')
                ->get();
        if (!empty($users)) {
            foreach ($users as $k => $user) {
                $user_points = array();
                unset($user_points);
                $products = DB::table('orders')
                        ->join('products', 'orders.product_id', '=', 'products.product_id')
                        ->where('.orders.dealer_id', $user->id)
                        ->select('products.*')
                        ->orderBY('orders.order_id', 'DESC')
                        ->get();
                if (count($products) > 0) {
                    $points_list_json[$k] = $user;
                    foreach ($products as $l => $product) {
                        $points_list_json[$k]->products[$l] = $product;
                        $total_quantity = DB::table('orders')
                                ->join('products', 'orders.product_id', '=', 'products.product_id')
                                ->where(['orders.dealer_id' => $user->id, 'orders.product_id' => $product->product_id])
                                ->sum('orders.quantity');
                        $points_list_json[$k]->products[$l]->quantity = $total_quantity;
                        $points_list_json[$k]->products[$l]->points_gained = ($product->points * $total_quantity);
                        $user_points[] = ($product->points * $total_quantity);
                    }
                    $points_list_json[$k]->user_points = array_sum($user_points);
                }
            }
        }
        echo json_encode($points_list_json, 1);
    }

    public function point_view($user_id) {
        $dealer_orders = '';
        $user = DB::table('users')
                ->where(['id' => $user_id, 'user_type' => '2'])
                ->select('id', 'name', 'firm_name', 'email', 'mobile_number', 'dealer_code', 'gst_no', 'vat_no', 'address', 'rating')
                ->first();
        if (!empty($user)) {
            $user_points = array();
            $user_amounts = array();
            unset($user_points);
            unset($user_amounts);
            $products = DB::table('orders')
                    ->join('products', 'orders.product_id', '=', 'products.product_id')
                    ->where('.orders.dealer_id', $user->id)
                    ->join('sub_categories', 'products.sub_category_id', 'sub_categories.sub_cat_id')
                    ->leftjoin('categories', 'sub_categories.category_id', 'categories.category_id')
                    ->select('orders.order_id', 'products.*', 'categories.category_name', 'sub_categories.sub_category_name', 'orders.created_at')
                    ->orderBY('orders.order_id', 'DESC')
                    ->get();
            if (count($products) > 0) {
                $dealer_orders = $user;
                foreach ($products as $l => $product) {
                    $dealer_orders->products[$l] = $product;
                    $total_quantity = DB::table('orders')
                            ->join('products', 'orders.product_id', '=', 'products.product_id')
                            ->where(['orders.dealer_id' => $user->id, 'orders.product_id' => $product->product_id])
                            ->sum('orders.quantity');
                    $dealer_orders->products[$l]->quantity = $total_quantity;
                    $dealer_orders->products[$l]->points_earned = ($product->points * $total_quantity);
                    $dealer_orders->products[$l]->amount_earned = ($product->price * $total_quantity);
                    $user_qty[] = $total_quantity;
                    $user_points[] = ($product->points * $total_quantity);
                    $user_amounts[] = ($product->price * $total_quantity);
                }
                $dealer_orders->user_qty = array_sum($user_qty);
                $dealer_orders->user_points = array_sum($user_points);
                $dealer_orders->user_amounts = array_sum($user_amounts);
            }
        }
//        echo'<pre>';print_r($dealer_orders);exit;
        $content['dealer_orders'] = $dealer_orders;
        return view('admin.point.view', $content);
    }

    public function promotions() {
        return view('admin.promotion.index');
    }

    public function promotion_add(Request $request) {
        if ($_POST) {
            $this->validate($request, [
                'title' => 'required',
                'content' => 'required',
                'expiry_date' => 'required',
            ]);


            if ($request->hasFile('pic')) {
                //File Upload
                $image = $request->file('pic');
                $ren_img = date('hisYdm') . '_' . $image->getClientOriginalName();
                $image->move(
                        base_path() . '/public/uploads/images/', $ren_img
                );
                $path_json = $request->root() . '/public/uploads/images/' . $ren_img;
                //File Upload;
            } else {
                $path_json = '';
            }
            try {
                $ins_id = DB::table('promotions')
                        ->insert(['title' => $request['title'],
                    'content' => $request['content'],
                    'image_path' => $path_json,
                    'expiry_date' => $request['expiry_date'],
                    'status' => '0',
                    'created_by' => Auth::user()->id,
                    'created_at' => new \DateTime(),
                    'updated_at' => new \DateTime()
                ]);
            } catch (\Exception $e) {
                
            }
            if (isset($ins_id) && !empty($ins_id)) {
                Session::flash('success', 'Promotion created successfully!');
            } else {
                Session::flash('fail', 'Promotion could not be created!');
            }
            return redirect('promotions');
        } else {
            return view('admin.promotion.add');
        }
    }

    public function promotions_list_json() {
        $orders_list_json = DB::table('promotions')
                ->orderBy('promotion_id', 'DESC')
                ->get();
        echo json_encode($orders_list_json, 1);
    }

    public function promotion_view($id) {
        $promotion = DB::table('promotions')
                ->where('promotion_id', $id)
                ->first();
        $content['promotion'] = $promotion;
        return view('admin.promotion.view', $content);
    }

    public function targets() {
        $dealers = DB::table('users')
                ->where('user_type', '2')
                ->get();
        $content['dealers'] = $dealers;
        return view('admin.target.index', $content);
    }

    public function target_add(Request $request) {
        if ($_POST) {
            $this->validate($request, [
                'dealer_id' => 'required',
                'month' => 'required',
                'year' => 'required',
                'target_amount' => 'required',
            ]);
            $exists_not = DB::table('targets')->where(['dealer_id' => $request['dealer_id'], 'month' => $request['month'], 'year' => $request['year']])->first();
            if (empty($exists_not)) {
                try {
                    $ins_id = DB::table('targets')
                            ->insert(['dealer_id' => $request['dealer_id'],
                        'month' => $request['month'],
                        'year' => $request['year'],
                        'target_amount' => $request['target_amount'],
                        'target_qty' => $request['target_qty'],
                        'status' => '0',
                        'created_by' => Auth::user()->id,
                        'created_at' => new \DateTime(),
                        'updated_at' => new \DateTime()
                    ]);
                } catch (\Exception $e) {
                    
                }
                if (isset($ins_id) && !empty($ins_id)) {
                    Session::flash('success', 'Target assigned successfully!');
                } else {
                    Session::flash('fail', 'Target could not be assigned!');
                }
            } else {
                Session::flash('fail', 'Target Already assigned!');
            }
            return redirect('targets');
        } else {
            $dealers = DB::table('users')
                    ->where('user_type', '2')
                    ->get();
            $content['dealers'] = $dealers;
            return view('admin.target.add', $content);
        }
    }

    public function targets_list_json() {
        $targets_list_json = array();
        $targets = DB::table('targets')
                ->join('users', 'targets.dealer_id', '=', 'users.id')
                ->orderBy('target_id', 'DESC')
                ->select('targets.*', 'users.name', 'users.firm_name', 'users.email', 'users.dealer_code')
                ->get();
        $user_points = array();
        $user_amounts = array();
        if (isset($targets) && !empty($targets)) {
            foreach ($targets as $k => $target) {
                $monthwiseTAT[$k] = $target;
                $month = $target->month;
                $year = $target->year;
                $cur_month = date('m');
                $cur_year = date('Y');
                $products = DB::table('orders')
                        ->join('products', 'orders.product_id', '=', 'products.product_id')
                        ->where('.orders.dealer_id', $target->dealer_id)
                        ->whereRaw('MONTH(orders.created_at) = ?', [$month])
                        ->whereRaw('YEAR(orders.created_at) = ?', [$year])
                        ->join('sub_categories', 'products.sub_category_id', 'sub_categories.sub_cat_id')
                        ->leftjoin('categories', 'sub_categories.category_id', 'categories.category_id')
                        ->select('products.*', 'categories.category_name', 'sub_categories.sub_category_name')
                        ->orderBY('orders.order_id', 'DESC')
                        ->get();
                if (count($products) > 0) {
                    foreach ($products as $l => $product) {
//                        $monthwiseTAT[$k]->prodcuts[$l] = $product;
                        $total_quantity = DB::table('orders')
                                ->join('products', 'orders.product_id', '=', 'products.product_id')
                                ->where(['orders.dealer_id' => $target->dealer_id, 'orders.product_id' => $product->product_id])
                                ->whereRaw('MONTH(orders.created_at) = ?', [$month])
                                ->whereRaw('YEAR(orders.created_at) = ?', [$year])
                                ->sum('orders.quantity');
//                        $monthwiseTAT[$k]->prodcuts[$l]->quantity = $total_quantity;
                        $user_points[] = ($product->points * $total_quantity);
                        $user_amounts[] = ($product->price * $total_quantity);
                    }
                    $monthwiseTAT[$k]->acheived_points = array_sum($user_points);
                    $monthwiseTAT[$k]->achieved_amounts = array_sum($user_amounts);
                } else {
                    $monthwiseTAT[$k]->acheived_points = '0';
                    $monthwiseTAT[$k]->achieved_amounts = '0';
                }
            }
        }
        echo json_encode($monthwiseTAT, 1);
    }

    public function target_edit(Request $request, $id) {
        if ($_POST) {
            $this->validate($request, [
                'target_amount' => 'required',
            ]);
            try {
                $upd_id = DB::table('targets')
                        ->where('target_id', $id)
                        ->update(['target_amount' => $request['target_amount'],
                    'target_qty' => $request['target_qty'],
                    'created_by' => Auth::user()->id,
                    'updated_at' => new \DateTime()
                ]);
            } catch (\Exception $e) {
                
            }
            Session::flash('success', 'Target updated successfully!');
            return redirect('targets');
        } else {
            $target = DB::table('targets')
                    ->where('target_id', $id)
                    ->first();
            $dealers = DB::table('users')
                    ->where('user_type', '2')
                    ->get();
            $content['target'] = $target;
            $content['dealers'] = $dealers;
            return view('admin.target.edit', $content);
        }
    }

    public function target_view($id) {
        $target = DB::table('targets')
                ->join('users', 'targets.dealer_id', '=', 'users.id')
                ->where('target_id', $id)
                ->orderBy('target_id', 'DESC')
                ->select('targets.*', 'users.name', 'users.firm_name', 'users.email', 'users.dealer_code')
                ->first();
        if (!empty($target)) {
            $monthwiseTAT = $target;
            $month = $target->month;
            $year = $target->year;
            $cur_month = date('m');
            $cur_year = date('Y');
            $products = DB::table('orders')
                    ->join('products', 'orders.product_id', '=', 'products.product_id')
                    ->where('.orders.dealer_id', $target->dealer_id)
                    ->whereRaw('MONTH(orders.created_at) = ?', [$month])
                    ->whereRaw('YEAR(orders.created_at) = ?', [$year])
                    ->join('sub_categories', 'products.sub_category_id', 'sub_categories.sub_cat_id')
                    ->leftjoin('categories', 'sub_categories.category_id', 'categories.category_id')
                    ->select('orders.order_id', 'products.*', 'categories.category_name', 'sub_categories.sub_category_name', 'orders.created_at')
                    ->orderBY('orders.order_id', 'DESC')
                    ->get();
            if (count($products) > 0) {
                foreach ($products as $l => $product) {
                    $monthwiseTAT->products[$l] = $product;
                    $total_quantity = DB::table('orders')
                            ->join('products', 'orders.product_id', '=', 'products.product_id')
                            ->where(['orders.dealer_id' => $target->dealer_id, 'orders.product_id' => $product->product_id])
                            ->whereRaw('MONTH(orders.created_at) = ?', [$month])
                            ->whereRaw('YEAR(orders.created_at) = ?', [$year])
                            ->sum('orders.quantity');
                    $monthwiseTAT->products[$l]->quantity = $total_quantity;
                    $monthwiseTAT->products[$l]->points_earned = $product->points * $total_quantity;
                    $monthwiseTAT->products[$l]->amount_earned = $product->price * $total_quantity;
                    $user_qty[] = $total_quantity;
                    $user_points[] = ($product->points * $total_quantity);
                    $user_amounts[] = ($product->price * $total_quantity);
                }
                $monthwiseTAT->achieve_qty = array_sum($user_qty);
                $monthwiseTAT->achieve_points = array_sum($user_points);
                $monthwiseTAT->achieve_amounts = array_sum($user_amounts);
            } else {
                $monthwiseTAT->achieve_qty = '0';
                $monthwiseTAT->achieve_points = '0';
                $monthwiseTAT->achieve_amounts = '0';
            }
            $content['target'] = $monthwiseTAT;
            return view('admin.target.view', $content);
        } else {
            return redirect('targets');
        }
    }

}
