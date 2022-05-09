<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Cart;
use Mail;
use Carbon\Carbon;
use App\Models\City;
use App\Models\Customer;
use App\Models\Province;
use App\Models\Wards;
use App\Models\Feeship;
use App\Models\Shipping;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Slider;
use App\Models\Coupon;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class CheckoutController extends Controller
{
    // public function AuthLogin(){
    //     $admin_id = Session::get('admin_id');
    //     if($admin_id){
    //         return Redirect::to('dashboard');
    //     }else{
    //         return Redirect::to('admin')->send();
    //     }
    // }
    //gọi view đăng nhập khi muốn thanh toán mà chưa đăng nhập
    public function login_checkout(){
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','0')->take(3)->get();

        $cate_pos = DB::table('cate_post')->where('cate_post_status','0')->orderby('cate_post_id','desc')->get();

        $cate_pro = DB::table('cate')->where('cate_status','0')->orderby('cate_id','desc')->get();

        $brand_pro = DB::table('brand')->where('brand_status','0')->orderby('brand_id','desc')->get();

        $room_pro = DB::table('room')->where('room_status','0')->orderby('room_id','desc')->get();

        return view('pages.checkout.login_checkout')->with('category',$cate_pro)->with('brand',$brand_pro)->with('room',$room_pro)->with('slider',$slider)->with('catepo',$cate_pos);
    }
    //gọi view đăng kí
    public function register_cus(){
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','0')->take(3)->get();

        $cate_pos = DB::table('cate_post')->where('cate_post_status','0')->orderby('cate_post_id','desc')->get();

        $cate_pro = DB::table('cate')->where('cate_status','0')->orderby('cate_id','desc')->get();

        $brand_pro = DB::table('brand')->where('brand_status','0')->orderby('brand_id','desc')->get();

        $room_pro = DB::table('room')->where('room_status','0')->orderby('room_id','desc')->get();

        return view('pages.checkout.register')->with('category',$cate_pro)->with('brand',$brand_pro)->with('room',$room_pro)->with('slider',$slider)->with('catepo',$cate_pos);
    }
    //Thêm khách hàng
    public function add_cus(Request $request){

    	$data = array();
    	$data['cus_name'] = $request->customer_name;
    	$data['cus_phone'] = $request->customer_phone;
    	$data['cus_email'] = $request->customer_email;
    	$data['cus_pass'] = md5($request->customer_password);

    	$customer_id = DB::table('customers')->insertGetId($data);

    	Session::put('cus_id',$customer_id);
    	Session::put('cus_name',$request->customer_name);
    	return Redirect::to('/checkout');
    }
    //gọi view điền thông tin đặt hàng
    public function checkout(){
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','0')->take(3)->get();

        $cate_pos = DB::table('cate_post')->where('cate_post_status','0')->orderby('cate_post_id','desc')->get();

        $cate_pro = DB::table('cate')->where('cate_status','0')->orderby('cate_id','desc')->get();

        $brand_pro = DB::table('brand')->where('brand_status','0')->orderby('brand_id','desc')->get();

        $room_pro = DB::table('room')->where('room_status','0')->orderby('room_id','desc')->get();

        $city = City::orderby('matp','ASC')->get();

        return view('pages.checkout.checkout')->with('category',$cate_pro)->with('brand',$brand_pro)->with('room',$room_pro)->with('slider',$slider)->with('city',$city)->with('catepo',$cate_pos);
    }
    //lưu thông tin đặt hàng
    public function save_checkout_cus(Request $request){
        $data = array();
    	$data['ship_name'] = $request->shipping_name;
    	$data['ship_phone'] = $request->shipping_phone;
    	$data['ship_email'] = $request->shipping_email;
        $data['ship_address'] = $request->shipping_address;
    	$data['ship_notes'] = $request->shipping_note;

    	$shipping_id = DB::table('shipping')->insertGetId($data);

    	Session::put('ship_id',$shipping_id);
    	return Redirect::to('/payment');
    }
    //Gọi giao diện đặt hàng
    public function payment(){
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','0')->take(3)->get();

        $cate_pos = DB::table('cate_post')->where('cate_post_status','0')->orderby('cate_post_id','desc')->get();

        $cate_pro = DB::table('cate')->where('cate_status','0')->orderby('cate_id','desc')->get();

        $brand_pro = DB::table('brand')->where('brand_status','0')->orderby('brand_id','desc')->get();

        $room_pro = DB::table('room')->where('room_status','0')->orderby('room_id','desc')->get();

        return view('pages.checkout.payment')->with('category',$cate_pro)->with('brand',$brand_pro)->with('room',$room_pro)->with('slider',$slider)->with('catepo',$cate_pos);
    }
    //đặt hàng
    public function order_place(Request $request){
        //lấy hình thức thanh toán
        //thêm vào hình thức thanh toán
        $data = array();
    	$data['pay_method'] = $request->payment_option;//hình thức thanh toán
    	$data['pay_status'] = 'Đang chờ xử lý';
    	$payment_id = DB::table('payment')->insertGetId($data);

        //Thêm thông tin vào đặt order
        $order_data = array();
    	$order_data['cus_id'] = Session::get('cus_id');
    	$order_data['ship_id'] = Session::get('ship_id');
        $order_data['pay_id'] = $payment_id;
        $order_data['order_total'] = Cart::total(0,',','.').' '.'VNĐ';//vừa sửa
        $order_data['order_status'] = 'Đang chờ xử lý';
    	$order_id = DB::table('order')->insertGetId($order_data);

        //Thêm vào bảng chi tiết đơn hàng
        $content = Cart::content();
        foreach ($content as $v_content) {
            $order_d_data['order_id'] = $order_id;
            $order_d_data['pro_id'] = $v_content->id;
            $order_d_data['pro_name'] = $v_content->name;
            $order_d_data['pro_price'] = $v_content->price;
            $order_d_data['pro_sales_qty'] = $v_content->qty;
            DB::table('order_details')->insert($order_d_data);
        }
        if($data['pay_method']==1){

            echo 'Thanh toán bằng thẻ ATM';

        }elseif($data['pay_method']==2){
            Cart::destroy();//hủy các sp ở giỏ hàng đã mua

            $cate_pro = DB::table('cate')->where('cate_status','0')->orderby('cate_id','desc')->get();

            $brand_pro = DB::table('brand')->where('brand_status','0')->orderby('brand_id','desc')->get();
    
            $room_pro = DB::table('room')->where('room_status','0')->orderby('room_id','desc')->get();
    
            return view('pages.checkout.handcash')->with('category',$cate_pro)->with('brand',$brand_pro)->with('room',$room_pro);

        }else{
            echo 'Thẻ ghi nợ';

        }
    	// return Redirect::to('/payment');
    }

    public function logout_checkout(){
        Session::forget('cus_id');
        Session::forget('cart');                              //đăng xuất là xóa giỏ hàng và ng dùng
    	return Redirect::to('/trang-chu');

    }

    public function login_cus(Request $request){
        $email = $request->email_account;
        $password = md5($request->password_account);
        $result = DB::table('customers')->where('cus_email',$email)->where('cus_pass',$password)->first();

        if($result){
            Session::put('cus_id',$result->cus_id);
    		return Redirect::to('/checkout');
    	}else{
    		return Redirect::to('/login-checkout');
    	}
    }

    //quản lý đơn hàng trang admin
    // public function manager_order(){
    //     $this->AuthLogin();
    //     $all_order = DB::table('order')
    //     ->join('customers','customers.cus_id','=','order.cus_id')
    //     ->select('order.*','customers.cus_name')
    //     ->orderby('order.order_id','desc')->get();
    //     $manager_order = view('admin.manager_order')->with('all_order',$all_order);
    //     return view('admin_layout')->with('admin.manager_order',$manager_order);
    // }

    //gọi view xem thông tin chi tiết đơn hàng
    // public function view_order($orderID){
    //     $this->AuthLogin();
    //     $order_by_id = DB::table('order')
    //     ->join('customers','order.cus_id','=','customers.cus_id')
    //     ->join('shipping','order.ship_id','=','shipping.ship_id')
    //     ->join('order_details','order.order_id','=','order_details.order_id')
    //     ->select('order.*','customers.*','shipping.*','order_details.*')->first();

    //     $view_orderID = view('admin.view_order')->with('order_by_id',$order_by_id);
    //     return view('admin_layout')->with('admin.view_order',$view_orderID);
    // }
    

    //ajax
    //tính mã giảm giá
    public function calculate_fee(Request $request){
        $data = $request->all();
        if($data['matp']){                                                         //nếu có dữ liệu tp
            $feeship = Feeship::where('fee_matp',$data['matp'])->where('fee_maqh',$data['maqh'])->where('fee_xaid',$data['xaid'])->get();  //lấy dữ liệu ss phần dl vào và bảng dl
            if($feeship){
                $count_feeship = $feeship->count();
                if($count_feeship>0){
                     foreach($feeship as $key => $fee){
                        Session::put('fee',$fee->fee_feeship);
                        Session::save();
                    }
                }else{ 
                    Session::put('fee',100000);
                    Session::save();
                }
            }
           
        }
    }
    //xác nhận đặt hàng
    public function confirm_order(Request $request){
        $data = $request->all();
        //get coupon
        if($data['order_coupon']!= 'Không có mã'){
            $coupon = Coupon::where('coupon_code',$data['order_coupon'])->first();
            $coupon->coupon_qty = $coupon->coupon_qty-1;
            $coupon_mail = $coupon-> coupon_code;
        }else{
            $coupon_mail = "Không có mã";
        }
        
        //get shipping
        $shipping = new Shipping();
        $shipping->ship_name = $data['shipping_name'];             //bên trái cột bên csdl, bên phải là dữ liệu bên ddienf vào
        $shipping->ship_email = $data['shipping_email'];
        $shipping->ship_phone = $data['shipping_phone'];
        $shipping->ship_address = $data['shipping_address'];
        $shipping->ship_notes = $data['shipping_notes'];
        $shipping->ship_method = $data['shipping_method'];
        $shipping->save();
        //khai báo, laauys ra id của trường shipping
        $shipping_id = $shipping->ship_id;

        $checkout_code = substr(md5(microtime()),rand(0,26),5);     //tự tạo ra random code

 
        $order = new Order;
        $order->cus_id = Session::get('cus_id');  //lấy id tk đang đăng nhập
        $order->ship_id = $shipping_id;
        $order->order_status = 1;                    //lấy đơn hàng mới, 1 là đơn hàng mới
        $order->order_code = $checkout_code;

        date_default_timezone_set('Asia/Ho_Chi_Minh');    //lấy thời gian hiện tại theo thời gian của VN
        $order_date = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
        $order->created_at = now();
        $order->order_date = $order_date;
        $order->save();

        if(Session::get('cart')==true){                                          //nếu có tồn tại giỏ hàng
            foreach(Session::get('cart') as $key => $cart){
                $order_details = new OrderDetails;                               //sp gọi models để thêm vào dl, vì 1 giỏ hàng nhìu sp
                $order_details->order_code = $checkout_code;                    //cartpro_id lây biến được gán phần addcartajax
                $order_details->pro_id = $cart['pro_id'];                        //lấy ra sessioncart để thêm vào
                $order_details->pro_name = $cart['pro_name'];
                $order_details->pro_price = $cart['pro_price'];
                $order_details->pro_sales_qty = $cart['pro_qty'];
                $order_details->pro_coupon =  $data['order_coupon'];
                $order_details->pro_fee = $data['order_fee'];               //dataorder_feetrường gửi qua bằng ajax
                $order_details->save();
            }
        }

        // //gửi thông tin xác nhận đơn hàng
        // $now = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');

        // $title_mail = "Đơn hàng xác nhận ngày".' '.$now;
        // $customer = Customer::find(Session::get('cus_id'));
        
        // $data =[];
        // foreach($customer as $cus){
        //     $data['email'][] = $cus->cus_email;
        // }
        // //lấy giỏ hàng
        // if(Session::get('cart')==true){
        //     foreach(Session::get('cart') as $key => $cart_mail){
        //         $cart_array[] = array(                               //vì giỏ hàng nhiều sản phẩm nên cần giá trị mảng vào
        //             'pro_name'=> $cart_mail['pro_name'],
        //             'pro_price' => $cart_mail['pro_price'],
        //             'pro_qty' => $cart_mail['pro_qty']
        //         );
        //     }
        // }
        // //lấy vận chuyển
        // $shipping_array = array(
        //     'cus_name' => $customer-> cus_name,
        //     'ship_name' => $data['shipping_name'],
        //     'ship_email' => $data['shipping_email'],
        //     'ship_phone' => $data['shipping_phone'],
        //     'ship_address' => $data['shipping_address'],
        //     'ship_notes' => $data['shipping_notes'],
        //     'ship_method' => $data['shipping_method']
        // );
        // //lấy mã giảm giá 
        // $order_code = array(
        //     'coupon_code' => $coupon_mail,
        //     'order_code' => $checkout_code
        // );

        // Mail::send('pages.send_coupon',['cart_array'=>$cart_array, 'shipping_array'=> $shipping_array, 'code'=>$order_code],function($message) use ($title_mail,$data){

        //     $message->to($data['email'])->subject($title_mail);//send this mail with subject
        //     $message->from($data['email'],$title_mail);//send from this mail
        // });

        Session::forget('coupon');                                         //xóa đi mã, giỏ hàng, phí
        Session::forget('fee');
        Session::forget('cart'); 
   }

}
