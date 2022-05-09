<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use App\Models\Slider;
use Illuminate\Support\Facades\Redirect;
use Cart;
use Carbon\Carbon;
use App\Models\Coupon;
session_start();

class CartController extends Controller
{
    //bumbummen
    public function save_cart(Request $request){
        // $productid = $request->productid_hidden;
        // $quantity = $request->qty;
        // $product_info = DB::table('product')->where('pro_id',$productid)->first();

        // // Cart::add('293ad', 'Product 1', 1, 9.99, 550);
        Cart::destroy();
        // $data['id'] = $product_info->pro_id;
        // $data['qty'] = $quantity;
        // $data['name'] = $product_info->pro_name;
        // $data['price'] = $product_info->pro_price;
        // $data['weight'] = $product_info->pro_size;
        // $data['options']['image'] = $product_info->pro_img;

        // Cart::add($data);
        // //chỉnh thuế
        // Cart::setGlobalTax(10);

        // return Redirect::to('/show-cart');
    }
    public function show_cart(){

        $cate_pro = DB::table('cate')->where('cate_status','0')->orderby('cate_id','desc')->get();
        $brand_pro = DB::table('brand')->where('brand_status','0')->orderby('brand_id','desc')->get();
        $room_pro = DB::table('room')->where('room_status','0')->orderby('room_id','desc')->get();
        
        return view('pages.cart.show_cart_home')->with('category',$cate_pro)->with('brand',$brand_pro)->with('room',$room_pro);
        
    }

    public function delete_cart($rowId){

        Cart::update($rowId, 0);//xóa sp dựa vào rowid, đưa số lượng về 0 coi như trạng thái k tồn tại
        Session::put('message','Xóa sản phẩm thành công');
        return Redirect::to('/show-cart');
        
    }

    public function update_cart_qty(Request $request){
        
        $rowId = $request->rowId_cart;
        $qty = $request->cart_quantity;

        Cart::update($rowId, $qty);//update số lượng theo qty
        Session::put('message','Cập nhật số lượng sản phẩm thành công');
        return Redirect::to('/show-cart');
    }

    //ajax
    public function add_cart_ajax(Request $request){
        $data = $request->all();
        $session_id = substr(md5(microtime()),rand(0,26),5);  //mỗi sản phẩm thêm vào có 1 session idcó 5 kí tự, xóa dựa vào sesionid để xóa
        $cart = Session::get('cart');                           //tạo một session để ktra
        if($cart==true){                                       //nếu đã tồn tại
            $is_avaiable = 0;
            foreach($cart as $key => $val){                      //suy ra giá trị
                if($val['pro_id']==$data['cart_product_id']){     //ktra xem sản phẩm có chưa, có rồi thì số lượng sẽ tăng lên
                    $is_avaiable++;
                }
            }
            if($is_avaiable == 0){                                //k có cái nào trùng thì thêm mới
                $cart[] = array(
                'session_id' => $session_id,
                'pro_name' => $data['cart_product_name'],
                'pro_id' => $data['cart_product_id'],
                'pro_image' => $data['cart_product_image'],
                'pro_quantity' => $data['cart_product_quantity'],
                'pro_qty' => $data['cart_product_qty'],
                'pro_price' => $data['cart_product_price'],
                );
                Session::put('cart',$cart);
            }
        }else{
            $cart[] = array(                                        //nếu chưa cho nó bằng chuỗi
                'session_id' => $session_id,
                'pro_name' => $data['cart_product_name'],
                'pro_id' => $data['cart_product_id'],
                'pro_image' => $data['cart_product_image'],
                'pro_quantity' => $data['cart_product_quantity'],
                'pro_qty' => $data['cart_product_qty'],
                'pro_price' => $data['cart_product_price'],

            );
            Session::put('cart',$cart);
        }
       
        Session::save();
    }

    public function gio_hang(Request $request){
        //seo 
        //slide
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','0')->take(3)->get();
        $cate_pos = DB::table('cate_post')->where('cate_post_status','0')->orderby('cate_post_id','desc')->get();
        $cate_pro = DB::table('cate')->where('cate_status','0')->orderby('cate_id','desc')->get();
        $brand_pro = DB::table('brand')->where('brand_status','0')->orderby('brand_id','desc')->get();
        $room_pro = DB::table('room')->where('room_status','0')->orderby('room_id','desc')->get();
        
        return view('pages.cart.cart_ajax')->with('category',$cate_pro)->with('brand',$brand_pro)->with('room',$room_pro)->with('slider',$slider)->with('catepo',$cate_pos);
    }

    public function del_product($session_id){

        $cart = Session::get('cart');              //lấy session giỏ hàng
       
        if($cart==true){                           //nếu có tồn tại giỏ hàng
            foreach($cart as $key => $val){          
                if($val['session_id']==$session_id){   //nếu có giá trị truyền vào bằng session id trong cart, thì nó trả ra vị trí giá trị trong giỏ hàng
                    unset($cart[$key]);                 //đưa ra cart mang vị trí đó, key chạy từ cart 0
                }
            }
            Session::put('cart',$cart);
            return redirect()->back()->with('message','Xóa sản phẩm thành công'); //trở lại trang trước với message

        }else{
            return redirect()->back()->with('message','Xóa sản phẩm thất bại');
        }
        
    }

    public function update_cart(Request $request){
        $data = $request->all();                      //gửi bao nhiêu lấy bấy nhiêu
        $cart = Session::get('cart');                 //đối chiếu xem tồn tại cart chưa
        if($cart==true){
            $message = '';

            foreach($data['cart_qty'] as $key => $qty){   //cart_qty là tên
                $i = 0;
                foreach($cart as $session => $val){
                    $i++;
                    if($val['session_id']==$key &&  $qty<$cart[$session]['pro_quantity']){            //nếu = số lượng ban đầu thù update k thì k update
                        $cart[$session]['pro_qty'] = $qty;   //update số lượng sản phẩm
                        $message.=' Cập nhật số lượng :'.$cart[$session]['pro_name'].' thành công';
                    }elseif($val['session_id']==$key &&  $qty>$cart[$session]['pro_quantity']){
                        $message.=' Cập nhật số lượng :'.$cart[$session]['pro_name'].' thất bại';
                    }
                }
            }
            Session::put('cart',$cart);
            return redirect()->back()->with('message',$message);
        }else{
            return redirect()->back()->with('error','Cập nhật số lượng thất bại');
        }
    }

    public function del_all_product(){
        $cart = Session::get('cart');
        if($cart==true){
            // Session::destroy();
            Session::forget('cart');
            //xóa giỏ hàng xóa luôn phần mã giảm
            Session::forget('coupon');
            return redirect()->back()->with('message','Xóa hết giỏ thành công');
        }
    }
    
    //Check mã giảm giá
    public function check_coupon(Request $request){ 
        $today = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
        $data = $request->all();                                                //lấy tất cả dl
        $coupon = Coupon::where('coupon_code',$data['coupon'])->where('coupon_status',1)->where('coupon_date_end','>=',$today)->first();        //mã code truyền vào sẽ ss với mã coupon truyền vào
        if($coupon){                                                             //nếu có mã giảm giá
            $count_coupon = $coupon->count();
            if($count_coupon>0){
                $coupon_session = Session::get('coupon');                        
                if($coupon_session==true){                                        //nếu có tồn tại, chỉ đk nhập 1 mã
                    $is_avaiable = 0;
                    if($is_avaiable==0){                                          //nếu tồn tại
                        $cou[] = array(                                           
                            'coupon_code' => $coupon->coupon_code,                 //lấy dl trong bảng để gán cho data
                            'coupon_condition' => $coupon->coupon_condition,
                            'coupon_number' => $coupon->coupon_number,

                        );
                        Session::put('coupon',$cou);
                    }
                }else{
                    $cou[] = array(
                            'coupon_code' => $coupon->coupon_code,
                            'coupon_condition' => $coupon->coupon_condition,
                            'coupon_number' => $coupon->coupon_number,

                        );
                    Session::put('coupon',$cou);
                }
                Session::save();
                return redirect()->back()->with('message','Thêm mã giảm giá thành công');
            }

        }else{
            return redirect()->back()->with('error','Mã giảm giá không đúng hoặc đã hết hạn');
        }
    }   
}
