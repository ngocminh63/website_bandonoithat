<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Slider;
use Session;
use App\Http\Requests;
use Mail;
use Illuminate\Support\Facades\Redirect;
session_start();

class HomeController extends Controller
{
    public function index(){
        //slide
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','0')->take(3)->get();

        $cate_pos = DB::table('cate_post')->where('cate_post_status','0')->orderby('cate_post_id','desc')->get();

        $cate_pro = DB::table('cate')->where('cate_status','0')->orderby('cate_id','desc')->get();

        $brand_pro = DB::table('brand')->where('brand_status','0')->orderby('brand_id','desc')->get();

        $room_pro = DB::table('room')->where('room_status','0')->orderby('room_id','desc')->get();

        // $all_product = DB::table('product')
        // ->join('cate','cate.cate_id','=','product.cate_id')
        // ->join('brand','brand.brand_id','=','product.brand_id')
        // ->orderby('pro_id','desc')->get();
        $all_product = DB::table('product')->where('pro_status','0')->orderby('pro_id','desc')->paginate(6);

        return view('pages.home')->with('category',$cate_pro)->with('brand',$brand_pro)->with('room',$room_pro)->with('all_product',$all_product)->with('slider',$slider)->with('catepo',$cate_pos);
    }
    public function search(Request $request){

        $keywords = $request->keywords_submit;

        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','0')->take(3)->get();

        $cate_pos = DB::table('cate_post')->where('cate_post_status','0')->orderby('cate_post_id','desc')->get();

        $cate_pro = DB::table('cate')->where('cate_status','0')->orderby('cate_id','desc')->get();

        $brand_pro = DB::table('brand')->where('brand_status','0')->orderby('brand_id','desc')->get();

        $room_pro = DB::table('room')->where('room_status','0')->orderby('room_id','desc')->get();

        // $all_product = DB::table('product')
        // ->join('cate','cate.cate_id','=','product.cate_id')
        // ->join('brand','brand.brand_id','=','product.brand_id')
        // ->orderby('pro_id','desc')->get();
        $search_pro = DB::table('product')->where('pro_name','like','%'.$keywords.'%')->get();

        return view('pages.sanpham.search')->with('category',$cate_pro)->with('brand',$brand_pro)->with('room',$room_pro)->with('search_product',$search_pro)->with('slider',$slider)->with('catepo',$cate_pos);
        
    }

    //sendmail
    public function send_mail(){
         //send mail
        $to_name = "MIN:FULLHOUSE";
        $to_email = "ltnminh12ahla@gmail.com";//send to this email
        
      
        $data = array("name"=>"Mail t??? t??i kho???n Kh??ch h??ng","body"=>'Mail g???i v??? v???n v??? h??ng h??a'); //body of mail.blade.php
         
        Mail::send('pages.send_mail',$data,function($message) use ($to_name,$to_email){

            $message->to($to_email)->subject('Test th??? g???i mail google');//send this mail with subject
            $message->from($to_email,$to_name);//send from this mail
        });
        return redirect('/')->with('message',''); //g???i v??? trang ch???
         //--send mail
    }

    //g???i view ????ng nh???p khi mu???n thanh to??n m?? ch??a ????ng nh???p
    public function dang_nhap(){
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','0')->take(3)->get();

        $cate_pos = DB::table('cate_post')->where('cate_post_status','0')->orderby('cate_post_id','desc')->get();

        $cate_pro = DB::table('cate')->where('cate_status','0')->orderby('cate_id','desc')->get();

        $brand_pro = DB::table('brand')->where('brand_status','0')->orderby('brand_id','desc')->get();

        $room_pro = DB::table('room')->where('room_status','0')->orderby('room_id','desc')->get();

        return view('pages.login')->with('category',$cate_pro)->with('brand',$brand_pro)->with('room',$room_pro)->with('slider',$slider)->with('catepo',$cate_pos);
    }
    //g???i view ????ng k??
    public function register(){
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','0')->take(3)->get();

        $cate_pos = DB::table('cate_post')->where('cate_post_status','0')->orderby('cate_post_id','desc')->get();

        $cate_pro = DB::table('cate')->where('cate_status','0')->orderby('cate_id','desc')->get();

        $brand_pro = DB::table('brand')->where('brand_status','0')->orderby('brand_id','desc')->get();

        $room_pro = DB::table('room')->where('room_status','0')->orderby('room_id','desc')->get();

        return view('pages.register_cus')->with('category',$cate_pro)->with('brand',$brand_pro)->with('room',$room_pro)->with('slider',$slider)->with('catepo',$cate_pos);
    }
    //Th??m kh??ch h??ng
    public function add_customer(Request $request){

    	$data = array();
    	$data['cus_name'] = $request->customer_name;
    	$data['cus_phone'] = $request->customer_phone;
    	$data['cus_email'] = $request->customer_email;
    	$data['cus_pass'] = md5($request->customer_password);

    	$customer_id = DB::table('customers')->insertGetId($data);

    	Session::put('cus_id',$customer_id);
    	Session::put('cus_name',$request->customer_name);
    	return Redirect::to('/trang-chu');
    }

    public function login_customer(Request $request){
        $email = $request->email_account;
        $password = md5($request->password_account);
        $result = DB::table('customers')->where('cus_email',$email)->where('cus_pass',$password)->first();

        if($result){
            Session::put('cus_id',$result->cus_id);
    		return Redirect::to('/trang-chu');
    	}else{
    		return Redirect::to('/dang-nhap');
    	}
    }
}
