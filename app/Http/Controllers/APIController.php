<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use DB;
use Log;

class APIController extends Controller {

    public function __construct() {
        
    }

    public function api_console() {
        return view('admin.api_console');
    }

    public function login() {
        $data = $_POST;
        if (Auth::attempt(['mobile_number' => $data['mobile_number'], 'password' => $data['password'], 'user_type' => '2', 'status' => '1'])) {
            $user = DB::table('users')
                    ->where(['mobile_number' => $data['mobile_number'], 'user_type' => '2', 'status' => '1'])
                    ->select('id', 'name', 'firm_name', 'email', 'mobile_number', 'dealer_code', 'gst_no', 'vat_no', 'address', 'rating')
                    ->first();
            $response['success'] = 'true';
            $response['message'] = 'valid user';
            $response['user_details'] = array(
                $user
            );
        } else {
            $response['success'] = 'false';
            $response['message'] = 'invalid user';
        }
        return json_encode($response, 1);
    }

    public function send_otp($mobile_number) {
        $user = DB::table('users')
                ->where(['mobile_number' => $mobile_number, 'status' => 1])
                ->first();
        if (!empty($user)) {
            //Generate OTP
            $characters = '0123456789';
            $otp = '';
            $max = strlen($characters) - 1;
            for ($i = 0; $i < 6; $i++) {
                $otp .= $characters[mt_rand(0, $max)];
            }
            $update_status = DB::table('users')
                    ->where('id', $user->id)
                    ->update(['otp' => $otp]);
            //Generate OTP
            //Send OTP
            $msg = rawurlencode("Dear user ,OTP for Dixon Batteries is " . $otp);
            $msg = str_replace(' ', '%20', $msg);
//            $url = '';
            $url = "sms.mmlive.in/index.php/api/bulk-sms?username=susheel&password=Cancri712%&from=KISANB&to=$mobile_number&message=$msg&sms_type=2";
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $curl_scraped_page = curl_exec($ch);
            curl_close($ch);
            //Send OTP
            $response['success'] = 'true';
            $response['message'] = 'sent success';
        } else {
            $response['success'] = 'false';
            $response['message'] = 'invalid user';
        }
        return json_encode($response, 1);
    }

    public function check_otp($mobile_number, $otp) {
        $user = DB::table('users')
                ->where(['mobile_number' => $mobile_number, 'otp' => $otp, 'status' => '1'])
                ->first();
        if (!empty($user)) {
            $response['success'] = 'true';
            $response['message'] = 'otp matched';
        } else {
            $response['success'] = 'false';
            $response['message'] = 'invalid otp';
        }
        return json_encode($response, 1);
    }

    public function change_password($mobile_number, $password) {
        $user = DB::table('users')
                ->where(['mobile_number' => $mobile_number])
                ->first();
        if (!empty($user)) {
            $update_status = DB::table('users')
                    ->where('id', $user->id)
                    ->update(['password' => Hash::make($password)]);
            $response['success'] = 'true';
            $response['message'] = 'password changed';
        } else {
            $response['success'] = 'false';
            $response['message'] = 'invalid user';
        }
        return json_encode($response, 1);
    }

    public function categories_list() {
        $categories = DB::table('categories')
                ->where('status', '1')
                ->select('category_id', 'category_name', 'category_desc')
                ->get();

        if (count($categories) > 0) {
            $response['success'] = 'true';
            $response['message'] = 'records found';
            $response['no_of_records'] = count($categories);
            $response['category_records'] = $categories;
        } else {
            $response['success'] = 'false';
            $response['message'] = 'no records found';
            $response['no_of_records'] = '0';
        }
        return json_encode($response, 1);
    }

    public function sub_categories_list($category_id) {
        $sub_categories = DB::table('sub_categories')
                ->where(['category_id' => $category_id, 'status' => '1'])
                ->select('sub_cat_id', 'sub_category_name', 'sub_category_desc')
                ->get();
        if (count($sub_categories) > 0) {
            $response['success'] = 'true';
            $response['message'] = 'records found';
            $response['no_of_records'] = count($sub_categories);
            $response['sub_category_records'] = $sub_categories;
        } else {
            $response['success'] = 'false';
            $response['message'] = 'no records found';
            $response['no_of_records'] = '0';
        }
        return json_encode($response, 1);
    }

    public function orders_list($dealer_id, $status) {
        $orders = array();
        if ($status != '0') {
            $month = date('m');
            $year = date('Y');
            $data = DB::table('orders')
                    ->join('products', 'orders.product_id', '=', 'products.product_id')
                    ->leftjoin('sub_categories', 'products.sub_category_id', 'sub_categories.sub_cat_id')
                    ->leftjoin('categories', 'sub_categories.category_id', 'categories.category_id')
                    ->whereRaw('MONTH(orders.created_at) = ?', [$month])
                    ->whereRaw('YEAR(orders.created_at) = ?', [$year])
                    ->where(['orders.dealer_id' => $dealer_id, 'orders.status' => $status])
                    ->orderBy('orders.order_id', 'DESC')
                    ->select('orders.order_id', 'orders.order_number', 'orders.product_id', 'products.model', 'products.capacity', 'products.length', 'products.width', 'products.height', 'categories.category_name', 'sub_categories.sub_category_name', 'orders.quantity', 'products.points', DB::raw('orders.quantity * products.points as order_points'), 'products.image_paths', 'orders.created_at')
                    ->get();
        } else {
            $data = DB::table('orders')
                    ->join('products', 'orders.product_id', '=', 'products.product_id')
                    ->leftjoin('sub_categories', 'products.sub_category_id', 'sub_categories.sub_cat_id')
                    ->leftjoin('categories', 'sub_categories.category_id', 'categories.category_id')
                    ->where(['orders.dealer_id' => $dealer_id])
                    ->orderBy('orders.order_id', 'DESC')
                    ->select('orders.order_id', 'orders.order_number', 'orders.product_id', 'products.model', 'products.capacity', 'products.length', 'products.width', 'products.height', 'categories.category_name', 'sub_categories.sub_category_name', 'orders.quantity', 'products.points', DB::raw('orders.quantity * products.points as order_points'), 'products.image_paths', 'orders.created_at')
                    ->get();
        }
        if (count($data) > 0) {
            foreach ($data as $k => $value) {
                $orders[$k] = $value;
                if (!empty($value->image_paths)) {
                    $images = json_decode($value->image_paths, 1);
                    $orders[$k]->image = $images[0];
                } else {
                    $orders[$k]->image = '';
                }
                unset($orders[$k]->image_paths);
            }
            $response['success'] = 'true';
            $response['message'] = 'records found';
            $response['no_of_records'] = count($orders);
            $response['order_records'] = $orders;
        } else {
            $response['success'] = 'false';
            $response['message'] = 'no records found';
            $response['no_of_records'] = '0';
        }
        return json_encode($response, 1);
    }

    public function products() {
        $products = array();
        $data = DB::table('products')
                ->where('status', '1')
                ->select('product_id', 'model', 'capacity', 'image_paths')
                ->get();
        if (count($data) > 0) {
            foreach ($data as $k => $value) {
                $products[$k]['product_id'] = $value->product_id;
                $products[$k]['model'] = $value->model;
                $products[$k]['capacity'] = $value->capacity;
                if (!empty($value->image_paths)) {
                    $images = json_decode($value->image_paths, 1);
                    $products[$k]['image'] = $images[0];
                } else {
                    $products[$k]['image'] = '';
                }
            }
            $response['success'] = 'true';
            $response['message'] = 'records found';
            $response['no_of_records'] = count($products);
            $response['product_records'] = $products;
        } else {
            $response['success'] = 'false';
            $response['message'] = 'no records found';
            $response['no_of_records'] = '0';
        }
        return json_encode($response, 1);
    }

    public function products_by_subcategory($sub_category_id) {
        $data = DB::table('products')
                ->where(['sub_category_id' => $sub_category_id, 'status' => '1'])
                ->select('product_id', 'model', 'capacity', 'image_paths')
                ->get();
        if (count($data) > 0) {
            foreach ($data as $k => $value) {
                $products[$k]['product_id'] = $value->product_id;
                $products[$k]['model'] = $value->model;
                $products[$k]['capacity'] = $value->capacity;
                if (!empty($value->image_paths)) {
                    $images = json_decode($value->image_paths, 1);
                    $products[$k]['image'] = $images[0];
                } else {
                    $products[$k]['image'] = '';
                }
            }
            $response['success'] = 'true';
            $response['message'] = 'records found';
            $response['no_of_records'] = count($products);
            $response['subcategory_product_records'] = $products;
        } else {
            $response['success'] = 'false';
            $response['message'] = 'no records found';
            $response['no_of_records'] = '0';
        }
        return json_encode($response, 1);
    }

    public function product_details($product_id) {
        $product_details = DB::table('products')
                ->join('sub_categories', 'products.sub_category_id', 'sub_categories.sub_cat_id')
                ->leftjoin('categories', 'sub_categories.category_id', 'categories.category_id')
                ->where(['products.product_id' => $product_id])
                ->select('products.product_id', 'products.model', 'products.container', 'products.capacity', 'products.length', 'products.width', 'products.height', 'products.charging_current', 'products.filled_weight', 'products.points', 'products.image_paths', 'categories.category_name', 'sub_categories.sub_category_name')
                ->first();
        if (!empty($product_details)) {
            if (!empty($product_details->image_paths)) {
                $images = json_decode($product_details->image_paths, 1);
            } else {
                $images = '';
            }
            unset($product_details->image_paths);
            $product_details->images = $images;
            $response['success'] = 'true';
            $response['message'] = 'details found';
            $response['details'] = $product_details;
        } else {
            $response['success'] = 'false';
            $response['message'] = 'no details found';
            $response['no_of_records'] = '0';
        }
        return json_encode($response, 1);
    }

    public function order_now() {
        $data = $_POST;
        $count = DB::table('orders')
                ->count();
        try {
            $ins_id = DB::table('orders')
                    ->insert(['order_number' => $count + 1,
                'dealer_id' => $data['dealer_id'],
                'product_id' => $data['product_id'],
                'quantity' => $data['quantity'],
                'status' => 1,
                'created_by' => $data['dealer_id'],
                'created_at' => new \DateTime(),
                'updated_at' => new \DateTime()
            ]);
        } catch (\Exception $e) {
            echo'<pre>';
            print_r($e->getMessage());
            exit;
        }
        if (isset($ins_id) && !empty($ins_id)) {
            $response['success'] = 'true';
            $response['message'] = 'order placed';
        } else {
            $response['success'] = 'false';
            $response['message'] = 'order could not be placed';
        }
        return json_encode($response, 1);
    }

    public function order_statuses() {
        $accepted = DB::table('orders')
                ->where('status', 1)
                ->count();
        $dispatched = DB::table('orders')
                ->where('status', 2)
                ->count();
        $pending = DB::table('orders')
                ->where('status', 3)
                ->count();
        $declined = DB::table('orders')
                ->where('status', 4)
                ->count();
        $delivered = DB::table('orders')
                ->where('status', 5)
                ->count();

        $response = array(
            'success' => 'true',
            'message' => 'records found',
            'no_of_records' => 5,
            'status_records' =>
            array(
                array(
                    'id' => 1,
                    'name' => 'Accepted Orders',
                    'count' => $accepted,
                ),
                array(
                    'id' => 2,
                    'name' => 'Dispatched Orders',
                    'count' => $dispatched,
                ),
                array(
                    'id' => 3,
                    'name' => 'Pending Orders',
                    'count' => $pending,
                ),
                array(
                    'id' => 4,
                    'name' => 'Declined Orders',
                    'count' => $declined,
                ),
                array(
                    'id' => 5,
                    'name' => 'Delivered Orders',
                    'count' => $delivered,
                ),
            )
        );
        return json_encode($response, 1);
    }

    public function update_profile() {
        $data = $_POST;
        try {
            DB::table('users')
                    ->where('id', $data['dealer_id'])
                    ->update(['name' => $data['name'],
                        'email' => $data['email'],
                        'mobile_number' => $data['mobile_number'],
                        'dealer_code' => $data['dealer_code'],
                        'vat_no' => $data['vat_no'],
                        'address' => $data['address'],
            ]);
        } catch (\Exception $e) {
            echo'<pre>';
            print_r($e->getMessage());
            exit;
        }
        $response['success'] = 'true';
        $response['message'] = 'profile updated successfully';
        return json_encode($response, 1);
    }

    public function battery_analysis_add() {
        $data = $_POST;
        try {
            $ins_id = DB::table('battery_analysis')
                    ->insert(['battery_sno' => $data['battery_sno'],
                'product_id' => $data['product_id'],
                'ocv' => $data['ocv'],
                'physical_status' => $data['physical_status'],
                'acid_level' => $data['acid_level'],
                'cell_wise_acid_sp_gr' => $data['cell_wise_acid_sp_gr'],
                'charge_details' => $data['charge_details'],
                'test_details' => $data['test_details'],
                'battery_resend_on' => $data['battery_resend_on'],
                'replaced_battery_sno' => $data['replaced_battery_sno'],
                'dealer_id' => $data['dealer_id'],
                'status' => '1',
                'created_by' => $data['dealer_id'],
                'created_at' => new \DateTime(),
                'updated_at' => new \DateTime()
            ]);
        } catch (\Exception $e) {
            echo'<pre>';
            print_r($e->getMessage());
            exit;
        }
        if (isset($ins_id) && !empty($ins_id)) {
            $response['success'] = 'true';
            $response['message'] = 'battery analysis added successfully';
        } else {
            $response['success'] = 'false';
            $response['message'] = 'battery analysis could not be added';
        }
        return json_encode($response, 1);
    }

    public function battery_complaint_add() {
        $data = $_POST;
        try {
            $ins_id = DB::table('battery_complaints')
                    ->insert(['customer_name' => $data['customer_name'],
                'battery_serial_no' => $data['battery_serial_no'],
                'product_id' => $data['product_id'],
                'complaint' => $data['complaint'],
                'dealer_id' => $data['dealer_id'],
                'complaint_date' => $data['complaint_date'],
                'status' => '1',
                'created_by' => $data['dealer_id'],
                'created_at' => new \DateTime(),
                'updated_at' => new \DateTime()
            ]);
        } catch (\Exception $e) {
            echo'<pre>';
            print_r($e->getMessage());
            exit;
        }
        if (isset($ins_id) && !empty($ins_id)) {
            $response['success'] = 'true';
            $response['message'] = 'battery complaint added successfully';
        } else {
            $response['success'] = 'false';
            $response['message'] = 'battery complaint could not be added';
        }
        return json_encode($response, 1);
    }

    public function promotion_get() {
        $promotion = DB::table('promotions')
                ->where('status', 1)
                ->orderBy('updated_at', 'DESC')
                ->select('promotion_id', 'title', 'content', 'expiry_date', 'image_path as image')
                ->first();
        if (!empty($promotion)) {
            $response['success'] = 'true';
            $response['message'] = 'promotion found';
            $response['promotion_details'] = $promotion;
        } else {
            $response['success'] = 'false';
            $response['message'] = 'promotion could not be found';
        }
        return json_encode($response, 1);
    }

    public function target_get() {
        $data = $_POST;
        $monthwiseTAT = array();
        $user_points = array();
        $user_amounts = array();
        for ($month = 0; $month <= 11; $month++) {
            unset($user_points);
            unset($user_amounts);
            $cur_month = date('m');
            $cur_year = date('Y');
            if ($cur_month + 1 == $month + 1 && $cur_year == $data['year']) {
                break;
            }
            $target = DB::table('targets')
                    ->where(['dealer_id' => $data['dealer_id'], 'month' => $month + 1, 'year' => $data['year'], 'status' => '1'])
                    ->first();
            $products = DB::table('orders')
                    ->join('products', 'orders.product_id', '=', 'products.product_id')
                    ->where('.orders.dealer_id', $data['dealer_id'])
                    ->whereRaw('MONTH(orders.created_at) = ?', [$month + 1])
                    ->whereRaw('YEAR(orders.created_at) = ?', [$data['year']])
                    ->join('sub_categories', 'products.sub_category_id', 'sub_categories.sub_cat_id')
                    ->leftjoin('categories', 'sub_categories.category_id', 'categories.category_id')
                    ->select('products.*', 'categories.category_name', 'sub_categories.sub_category_name')
                    ->orderBY('orders.order_id', 'DESC')
                    ->get();
            if (count($products) > 0) {
                foreach ($products as $l => $product) {
                    $total_quantity = DB::table('orders')
                            ->join('products', 'orders.product_id', '=', 'products.product_id')
                            ->where(['orders.dealer_id' => $data['dealer_id'], 'orders.product_id' => $product->product_id])
                            ->whereRaw('MONTH(orders.created_at) = ?', [$month + 1])
                            ->whereRaw('YEAR(orders.created_at) = ?', [$data['year']])
                            ->sum('orders.quantity');
                    $user_points[] = ($product->points * $total_quantity);
                    $user_amounts[] = ($product->price * $total_quantity);
                }
                $monthwiseTAT[$month]['month'] = $month + 1;
                $monthwiseTAT[$month]['acheived_points'] = array_sum($user_points);
                $monthwiseTAT[$month]['achieved_amounts'] = array_sum($user_amounts);
                if (isset($target) && !empty($target)) {
                    $monthwiseTAT[$month]['target_amount'] = $target->target_amount;
                } else {
                    $monthwiseTAT[$month]['target_amount'] = '0';
                }
            } else {
                $monthwiseTAT[$month]['month'] = $month + 1;
                $monthwiseTAT[$month]['acheived_points'] = '0';
                $monthwiseTAT[$month]['achieved_amounts'] = '0';
                if (isset($target) && !empty($target)) {
                    $monthwiseTAT[$month]['target_amount'] = $target->target_amount;
                } else {
                    $monthwiseTAT[$month]['target_amount'] = '0';
                }
            }
        }
        $response['success'] = 'true';
        $response['message'] = 'targets found';
        $response['target_details'] = $monthwiseTAT;
        return json_encode($response, 1);
    }

}
