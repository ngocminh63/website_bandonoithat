<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coupon;
use App\Models\Customer;
use Carbon\Carbon;
use Session;
use Mail;
use Illuminate\Support\Facades\Redirect;
session_start();

class CouponController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }

    public function add_coupon(){
        $this->AuthLogin();
    	return view('admin.add_coupon');
    }

    public function all_coupon(){
        $this->AuthLogin();
        $today = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
    	$coupon = Coupon::orderby('coupon_id','DESC')->get();

        // $manager_coupon = view('admin.all_coupon')->with('coupon',$coupon);
        // return view('admin_layout')->with('all_coupon',$manager_coupon);
        return view('admin.all_coupon')->with(compact('coupon','today'));
    }

    public function save_coupon(Request $request){
        $this->AuthLogin();

    	$data = $request->all();

    	$coupon = new Coupon;

    	$coupon->coupon_name = $data['coupon_name'];
    	$coupon->coupon_number = $data['coupon_number'];
    	$coupon->coupon_code = $data['coupon_code'];
    	$coupon->coupon_qty = $data['coupon_qty'];
        $coupon->coupon_date_start = $data['coupon_date_start'];
    	$coupon->coupon_date_end = $data['coupon_date_end'];
    	$coupon->coupon_condition = $data['coupon_condition'];
    	$coupon->save();

    	Session::put('message','Thêm mã giảm giá thành công');
        return Redirect::to('all-coupon');

    }

    public function delete_coupon($coupon_id){
        $this->AuthLogin();
        //find dùng để lấy giá trị để ss với id, còn nếu k ss với id mà ss với điều kiện khác thì phải dùng where
        //VD nếu ss với giá trị khác với id thì dùng where('coupon_slug',$coupon_id)->first();
        $coupon = Coupon::find($coupon_id);
        $coupon->delete();
        Session::put('message','Xóa mã giảm giá thành công');
        return Redirect::to('/all-coupon');
    }


    public function unset_coupon(){
		$coupon = Session::get('coupon');        //nếu có tồn tại mã giảm giá
        if($coupon==true){
          
            Session::forget('coupon');           //xóa mã
            return redirect()->back()->with('message','Xóa mã khuyến mãi thành công');
        }
	}
    //gửi mail
    public function send_coupon($coupon_number,$coupon_condition,$coupon_code){
        $this->AuthLogin();
    	$customer = Customer::orderby('cus_id')->get();
        $coupon = Coupon::where('coupon_code',$coupon_code)->first();
        $start_date = $coupon->coupon_date_start;
        $end_date = $coupon->coupon_date_end;
        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');
        $title_mail = "Mã giảm giá".' '.$now;

        $data =[];
        foreach($customer as $cus){
            $data['email'][] = $cus->cus_email;
        }
        $coupon = array(
            'start_date' => $start_date,
            'end_date' => $end_date,
            'coupon_number' => $coupon_number,
            'coupon_condition' => $coupon_condition,
            'coupon_code' => $coupon_code,
        );
        // dd($data);
        Mail::send('pages.send_coupon',['coupon'=>$coupon],function($message) use ($title_mail,$data){

                $message->to($data['email'])->subject($title_mail);//send this mail with subject
                $message->from($data['email'],$title_mail);//send from this mail
            });
        return redirect()->back()->with('message','Gửi mã khuyến mãi thành công');
    }

    public function mail_example(){
        return view('pages.send_coupon');
    }


}
