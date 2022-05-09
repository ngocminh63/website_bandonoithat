<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Roles;
use Auth;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    public function login_auth(){
        return view('auth_login');
    }
//xử lý đăng nhập
    public function login(Request $request){
        $this->validate($request,[
            'admin_email' => 'required|email|max:255',
            'admin_pass' => 'required|max:255'
        ]);
        // $data = $request->all();
        if(Auth::attempt(['admin_email'=> $request->admin_email, 'admin_pass'=> $request->admin_pass])){
            echo Auth::attempt(['admin_email'=> $request->admin_email, 'admin_pass'=> $request->admin_pass]);
        //     return Redirect::to('/dashboard');
        // }else{
        //     return Redirect::to('/login-auth')-> with('message','Email hoặc mật khẩu nhập sai, hãy nhập lại');
        }
    }
//ktra các trường gửi vào xem đúng yêu cầu k
    public function validation($request){
        return $this->validate($request,[
            'admin_name' => 'required|max:255',
            'admin_email' => 'required|email|max:255',
            'admin_pass' => 'required|max:255',
        ]);
    }
}
