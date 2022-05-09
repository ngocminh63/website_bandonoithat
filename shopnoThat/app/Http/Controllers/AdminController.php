<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Carbon\Carbon;
use App\Models\Roles;
use App\Models\Statistical;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class AdminController extends Controller
{   
    public function AuthLogin(){
        $admin_id =  Session::get('admin_id');
        if($admin_id){
        
            return Redirect::to('dashboard'); 
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function index(){
        return view('admin_login');
    }

    public function show_dashboard(){
        $this->AuthLogin();
        return view('admin.dashboard');
    }
    //xử lý đăng nhập admin
    public function dashboard(Request $request){
        $admin_email = $request->admin_email;
        $admin_pass = md5($request->admin_pass);

        $result = DB::table('admin')-> where ('admin_email',$admin_email)->where('admin_pass',$admin_pass)->first();
        
        if($result){
            Session::put('admin_name',$result->admin_name);
            Session::put('admin_id',$result->admin_id);
            return Redirect::to('/dashboard');
        }else{
            Session::put('message','Email hoặc mật khẩu nhập sai, hãy nhập lại');
            return Redirect::to('/admin');
        }
    }

    public function logout(){
        $this->AuthLogin();
        Session::put('admin_name',null);
        Session::put('admin_id',null);
        return Redirect::to('/admin');
    }
//hiển thi 19 đơn hàng
    public function days_order(){
        $sub19days = Carbon::now('Asia/Ho_Chi_Minh')->subDays(19)->toDateString();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $get = Statistical::whereBetween('order_date',[$sub19days,$now])->orderBy('order_date','ASC')->get();
        foreach($get as $key => $val){
            $chart_data[] = array(
                'period' => $val->order_date,
                'order' => $val-> total_order,
                'sales' => $val-> sales,
                'profit' => $val-> profit,
                'quantity' => $val-> qty
            );
        }
        echo $data = json_encode($chart_data);
    }
    //thống kê
    public function filter_by_date(Request $request){
        $data = $request->all();
        $from_date = $data['from_date'];
        $to_date = $data['to_date'];

        $get = Statistical::whereBetween('order_date',[$from_date,$to_date])->orderBy('order_date','ASC')->get();
        foreach($get as $key => $val){
            $chart_data[] = array(
                'period' => $val->order_date,
                'order' => $val-> total_order,
                'sales' => $val-> sales,
                'profit' => $val-> profit,
                'quantity' => $val-> qty
            );
        }
        echo $data = json_encode($chart_data);
    }
    //thông kê theo option
    public function dashboard_filter(Request $request){
        $data = $request->all();
        // echo $today = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');
        $dauthangnay = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
        $dau_thangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
        $cuoi_thangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();

        $sub7days = Carbon::now('Asia/Ho_Chi_Minh')->subDays(7)->toDateString();
        $sub365days = Carbon::now('Asia/Ho_Chi_Minh')->subDays(365)->toDateString();

        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

        if($data['dashboard_value']=='7ngay'){
            $get = Statistical::whereBetween('order_date',[$sub7days,$now])->orderBy('order_date','ASC')->get();
        }elseif ($data['dashboard_value']=='thangtruoc') {
            $get = Statistical::whereBetween('order_date',[$dau_thangtruoc,$cuoi_thangtruoc])->orderBy('order_date','ASC')->get();
        }elseif ($data['dashboard_value']=='thangnay') {
            $get = Statistical::whereBetween('order_date',[$dauthangnay,$now])->orderBy('order_date','ASC')->get();
        }else {
            $get = Statistical::whereBetween('order_date',[$sub365days,$now])->orderBy('order_date','ASC')->get();
        }

        foreach($get as $key => $val){
            $chart_data[] = array(
                'period' => $val->order_date,
                'order' => $val-> total_order,
                'sales' => $val-> sales,
                'profit' => $val-> profit,
                'quantity' => $val-> qty
            );
        }
        echo $data = json_encode($chart_data);
    }
}
