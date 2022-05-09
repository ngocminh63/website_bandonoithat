<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use PDF;
use Carbon\Carbon;
use App\Models\Slider;
use App\Http\Requests;
use App\Models\Feeship;
use App\Models\Shipping;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use App\Models\Coupon;
use App\Models\OrderDetails;
use App\Models\Statistical;
use Illuminate\Support\Facades\Redirect;
session_start();

class OrderController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    //gọi lấy giao diện đơn hàng, lấy ra các đơn hàng
    public function manager_order(){
        $this->AuthLogin();
    	$order = Order::ordery('created_at','DESC')->get();                //lấy đơn hàng gần nhất 
    	return view('admin.manager_order')->with(compact('order'));
    }
//chi tiết đon hàng
    public function view_order($order_code){
		$order_details = OrderDetails::with('product')->where('order_code',$order_code)->get();  //điều kiện ordercode=ordercode đã gửi qua
		$order = Order::where('order_code',$order_code)->get();                  //ordercode của hóa đơn bằng ordercode gửi đến để lấy cusid và shipid
		foreach($order as $key => $ord){
			$customer_id = $ord->cus_id;
			$shipping_id = $ord->ship_id;
			$order_status = $ord->order_status;
		}
		$customer = Customer::where('cus_id',$customer_id)->first();
		$shipping = Shipping::where('ship_id',$shipping_id)->first();

		$order_details_pro = OrderDetails::with('product')->where('order_code', $order_code)->get();            //nối 2 bảng

		foreach($order_details_pro as $key => $order_deta){

			$product_coupon = $order_deta->pro_coupon;
		}
		if($product_coupon != 'Không có mã'){                                         //nếu có mã giảm giá
			$coupon = Coupon::where('coupon_code',$product_coupon)->first();
			$coupon_condition = $coupon->coupon_condition;                    //nếu TH1 thì tính bằng %, còn trường hợp 2 tính bằng giá tiền
			$coupon_number = $coupon->coupon_number;
		}else{
			$coupon_condition = 2;                  //nếu k có mã giảm giá, thì gán condition bằng 2 là giảm theo tiền và gán số tiền là =0
			$coupon_number = 0 ;
		}
		
		return view('admin.view_order')->with(compact('order_details','customer','shipping','order_details','coupon_condition','coupon_number','order','order_status'));

	}
	//in đơn hàng
	public function print_order($checkout_code){
		$pdf = \App::make('dompdf.wrapper');
		$pdf->loadHTML($this->print_order_convert($checkout_code));
		
		return $pdf->stream();
	}

	public function print_order_convert($checkout_code){
		// return $checkout_code;
		$order_details = OrderDetails::with('product')->where('order_code',$checkout_code)->get();  //điều kiện ordercode=ordercode đã gửi qua
		$order = Order::where('order_code',$checkout_code)->get();                  //ordercode của hóa đơn bằng ordercode gửi đến để lấy cusid và shipid
		foreach($order as $key => $ord){
			$customer_id = $ord->cus_id;
			$shipping_id = $ord->ship_id;
			$order_status = $ord->order_status;
		}
		$customer = Customer::where('cus_id',$customer_id)->first();
		$shipping = Shipping::where('ship_id',$shipping_id)->first();

		$order_details_pro = OrderDetails::with('product')->where('order_code', $checkout_code)->get();            //nối 2 bảng

		foreach($order_details_pro as $key => $order_deta){

			$product_coupon = $order_deta->pro_coupon;
		}
		if($product_coupon != 'Không có mã'){                                         //nếu có mã giảm giá
			$coupon = Coupon::where('coupon_code',$product_coupon)->first();
			$coupon_condition = $coupon->coupon_condition;                    //nếu TH1 thì tính bằng %, còn trường hợp 2 tính bằng giá tiền
			$coupon_number = $coupon->coupon_number;
			if($coupon_condition==1){
				$coupon_echo = $coupon_number.'%';
			}elseif($coupon_condition==2){
				$coupon_echo = number_format($coupon_number,0,',','.').'đ';
			}
		}else{
			$coupon_condition = 2;                  //nếu k có mã giảm giá, thì gán condition bằng 2 là giảm theo tiền và gán số tiền là =0
			$coupon_number = 0 ;
			$coupon_echo = '0';
		}

		$output = '';
		$output.='<style>body{
			font-family: DejaVu Sans;
		}
		.table-styling{
			border:1px solid #000;
		}
		.table-styling tbody tr td{
			border:1px solid #000;
		}
		</style>
		<h1><center>Cửa hàng nội thất MIN:FULLHOSE</center></h1>
		<h4><center>Thông tin đơn hàng</center></h4>
		<p>Người đặt hàng</p>
		<table class="table-styling">
				<thead>
					<tr>
						<th>Tên khách đặt</th>
						<th>Số điện thoại</th>
						<th>Email</th>
					</tr>
				</thead>
				<tbody>';                                   
				
		$output.='		
					<tr>
						<td>'.$customer->cus_name.'</td>
						<td>'.$customer->cus_phone.'</td>
						<td>'.$customer->cus_email.'</td>
						
					</tr>';
				

		$output.='				
				</tbody>
		</table>
		<p>Địa chỉ nhận hàng</p>
			<table class="table-styling">
				<thead>
					<tr>
						<th>Tên người nhận</th>
						<th>Địa chỉ</th>
						<th>Sdt</th>
						<th>Email</th>
						<th>Ghi chú</th>
					</tr>
				</thead>
				<tbody>';
				
		$output.='		
					<tr>
						<td>'.$shipping->ship_name.'</td>
						<td>'.$shipping->ship_address.'</td>
						<td>'.$shipping->ship_phone.'</td>
						<td>'.$shipping->ship_email.'</td>
						<td>'.$shipping->ship_notes.'</td>
						
					</tr>';
				

		$output.='				
				</tbody>
			
		</table>
		
		<p>Thông tin đơn hàng</p>
			<table class="table-styling">
				<thead>
					<tr>
						<th>Tên sản phẩm</th>
						<th>Mã giảm giá</th>
						<th>Phí ship</th>
						<th>Số lượng</th>
						<th>Giá sản phẩm</th>
						<th>Thành tiền</th>
					</tr>
				</thead>
				<tbody>';
			
				$total = 0;

				foreach($order_details_pro as $key => $pro){

					$subtotal = $pro->pro_price*$pro->pro_sales_qty;
					$total+=$subtotal;

					if($pro->pro_coupon!='Không có mã'){
						$product_coupon = $pro->pro_coupon;
					}else{
						$product_coupon = 'Không có mã';
					}		

		$output.='		
					<tr>
						<td>'.$pro->pro_name.'</td>
						<td>'.$product_coupon.'</td>
						<td>'.number_format($pro->pro_fee,0,',','.').'đ'.'</td>
						<td>'.$pro->pro_sales_qty.'</td>
						<td>'.number_format($pro->pro_price,0,',','.').'đ'.'</td>
						<td>'.number_format($subtotal,0,',','.').'đ'.'</td>
						
					</tr>';
				}

				if($coupon_condition == 1){
					$total_after_coupon = ($total*$coupon_number)/100;
	                $total_coupon = $total - $total_after_coupon;
				}else{
                  	$total_coupon = $total - $coupon_number;
				}

		$output.= '<tr>
				<td colspan="2">
					<p>Tổng giảm: '.$coupon_echo.'</p>
					<p>Phí ship: '.number_format($pro->pro_fee,0,',','.').'đ'.'</p>
					<p>Thanh toán : '.number_format($total_coupon + $pro->product_fee,0,',','.').'đ'.'</p>
				</td>
		</tr>';
		$output.='				
				</tbody>
			
		</table>

		<p>Ký tên</p>
			<table>
				<thead>
					<tr>
						<th width="200px">Người lập phiếu</th>
						<th width="800px">Người nhận</th>
						
					</tr>
				</thead>
				<tbody>';
						
		$output.='				
				</tbody>
			
		</table>
		';
		return $output;

	}
	public function update_order_qty(Request $request){
		//update order
		$data = $request->all();
		$order = Order::find($data['order_id']);
		$order->order_status = $data['order_status'];
		$order->save();
		//order_date
		$order_date = $order->order_date;
		$statistic = Statistical::where('order_date',$order_date)->get();
		if($statistic){
			$statistic_count = $statistic->count();
		}else {
			$statistic_count = 0;
		}
		if($order->order_status==2){
			$total_order = 0;
			$sales = 0;
			$profit = 0;
			$quantity = 0;

			foreach($data['order_product_id'] as $key => $product_id){

				$product = Product::find($product_id);                          //tìm kiếm theo số lượng của product_id
				$product_quantity = $product->pro_qty;
				$product_sold = $product->pro_sold;
				$product_price = $product-> pro_price;
				$product_cost = $product-> pro_cost;
				$now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
				foreach($data['quantity'] as $key2 => $qty){
					if($key==$key2){
						$pro_remain = $product_quantity - $qty;          //số lượng còn lại
						$product->pro_qty = $pro_remain;
						$product->pro_sold = $product_sold + $qty;
						$product->save();
						//update doanh thu
						$quantity += $qty;
						$total_order += 1;
						$sales += $product_price*$qty;
						$profit = $sales-($product_cost*$qty);
					}
				}
			}
			//cập nhật doanh số
			if($statistic_count>0){
				$statistic_update = Statistical::where('order_date',$order_date)->first();
				$statistic_update ->sales = $statistic_update->sales + $sales;
				$statistic_update -> profit = $statistic_update->profit + $profit;
				$statistic_update -> qty = $statistic_update-> qty + $quantity;
				$statistic_update -> total_order = $statistic_update -> total_order + $total_order;
				$statistic_update -> save();
			}else {
				$statistic_new = new Statistical();
				$statistic_new -> order_date = $order_date;
				$statistic_new -> sales = $sales;
				$statistic_new -> profit = $profit;
				$statistic_new -> qty = $quantity;
				$statistic_new -> total_order = $total_order;
				$statistic_new->save();
			}
		}elseif($order->order_status!=1 && $order->order_status!=2){
			foreach($data['order_product_id'] as $key => $product_id){
				
				$product = Product::find($product_id);
				$product_quantity = $product->pro_qty;
				$product_sold = $product->pro_sold;
				foreach($data['quantity'] as $key2 => $qty){
						if($key==$key2){
								$pro_remain = $product_quantity + $qty;
								$product->pro_qty = $pro_remain;
								$product->pro_sold = $product_sold - $qty;
								$product->save();
						}
				}
			}
		}
	}
	public function history(){
		if(!Session::get('cus_id')){
			return redirect('login-checkout')->with('error','Vui lòng đăng nhập để xem lịch sử đơn hàng');
		}else {              
    		$slider = Slider::orderBy('slider_id','DESC')->where('slider_status','0')->take(3)->get();

			$cate_pos = DB::table('cate_post')->where('cate_post_status','0')->orderby('cate_post_id','desc')->get();

			$cate_pro = DB::table('cate')->where('cate_status','0')->orderby('cate_id','desc')->get();

			$brand_pro = DB::table('brand')->where('brand_status','0')->orderby('brand_id','desc')->get();

			$room_pro = DB::table('room')->where('room_status','0')->orderby('room_id','desc')->get();

			// $all_product = DB::table('product')
			// ->join('cate','cate.cate_id','=','product.cate_id')
			// ->join('brand','brand.brand_id','=','product.brand_id')
			// ->orderby('pro_id','desc')->get();
			
			$order = Order::where('cus_id',Session::get('cus_id'))->orderby('created_at','DESC')->paginate(5); 
			return view('pages.history.history')->with('category',$cate_pro)->with('brand',$brand_pro)->with('room',$room_pro)->with('order',$order)->with('slider',$slider)->with('catepo',$cate_pos);
		}
	}
	public function view_history($order_code){
		if(!Session::get('cus_id')){
			return redirect('login-checkout')->with('error','Vui lòng đăng nhập để xem lịch sử đơn hàng');
		}else {              
    		$slider = Slider::orderBy('slider_id','DESC')->where('slider_status','0')->take(3)->get();

			$cate_pos = DB::table('cate_post')->where('cate_post_status','0')->orderby('cate_post_id','desc')->get();

			$cate_pro = DB::table('cate')->where('cate_status','0')->orderby('cate_id','desc')->get();

			$brand_pro = DB::table('brand')->where('brand_status','0')->orderby('brand_id','desc')->get();

			$room_pro = DB::table('room')->where('room_status','0')->orderby('room_id','desc')->get();

			//xem chi tiết đơn hàng
			$order_details = OrderDetails::with('product')->where('order_code',$order_code)->get();  //điều kiện ordercode=ordercode đã gửi qua
			$order = Order::where('order_code',$order_code)->first();                 //ordercode của hóa đơn bằng ordercode gửi đến để lấy cusid và shipid
			
			$customer_id = $order->cus_id;
			$shipping_id = $order->ship_id;
			$order_status = $order->order_status;
			$customer = Customer::where('cus_id',$customer_id)->first();
			$shipping = Shipping::where('ship_id',$shipping_id)->first();

			$order_details_pro = OrderDetails::with('product')->where('order_code', $order_code)->get();            //nối 2 bảng

			foreach($order_details_pro as $key => $order_deta){

				$product_coupon = $order_deta->pro_coupon;
			}
			if($product_coupon != 'Không có mã'){                                         //nếu có mã giảm giá
				$coupon = Coupon::where('coupon_code',$product_coupon)->first();
				$coupon_condition = $coupon->coupon_condition;                    //nếu TH1 thì tính bằng %, còn trường hợp 2 tính bằng giá tiền
				$coupon_number = $coupon->coupon_number;
			}else{
				$coupon_condition = 2;                  //nếu k có mã giảm giá, thì gán condition bằng 2 là giảm theo tiền và gán số tiền là =0
				$coupon_number = 0 ;
			}
				
				
			return view('pages.history.view_history')->with('category',$cate_pro)->with('brand',$brand_pro)->with('room',$room_pro)->with('order',$order)->with('slider',$slider)->with('catepo',$cate_pos)
			->with(compact('order_details','customer','shipping','order_details','coupon_condition','coupon_number','order','order_status'));
		}
	}
}
