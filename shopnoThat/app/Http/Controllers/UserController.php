<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Models\Admin;
use App\Models\Roles;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();


class UserController extends Controller
{
    //gọi trang liệt kê
    public function index()
    {
        $admin = Admin::with('roles')->orderBy('admin_id','ASC')->paginate(3);
        return view('admin.all_users')->with(compact('admin'));
    }
    //nút phân quyền
    public function assign_roles(Request $request){
        //detach là tách user với role,tách tất cả các quyền, gỡ các quyền đã có
        
        //nếu data nó lấy qua, nếu chọn thì sẽ thêm quyền mới vào, attach là nối, request từng cái còn để data sẽ lấy 3 trường để đem ra so sánh, dùng data phải thêm foreach
        $user = Admin::where('admin_email',$request['admin_email'])->first();
        $user->roles()->detach();
        
        if($request['shipper_role']){
           $user->roles()->attach(Roles::where('role_name','shipper')->first());     
        }
        if($request['admin_role']){
            $user->roles()->attach(Roles::where('role_name','admin')->first());     
         }
        if($request['user_role']){
           $user->roles()->attach(Roles::where('role_name','user')->first());     
        }
        return redirect()->back()->with('message','Kích hoạt quyền thành công');
    }

    //thêm user
    public function add_users(){
        return view('admin.add_user');
    }

    public function store_users(Request $request){
        $data = $request->all();
        $admin = new Admin();
        $admin->admin_name = $data['admin_name'];
        $admin->admin_phone = $data['admin_phone'];
        $admin->admin_email = $data['admin_email'];
        $admin->admin_pass = md5($data['admin_password']);
        $admin->save();
        $admin->roles()->attach(Roles::where('role_name','user')->first());
        Session::put('message','Thêm users thành công');
        return Redirect::to('users');
    }
}
