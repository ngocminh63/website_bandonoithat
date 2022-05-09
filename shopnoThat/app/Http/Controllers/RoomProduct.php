<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Slider;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();
class RoomProduct extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    //gọi view thêm phòng
    public function add_room_product(){
        $this->AuthLogin();
        return view('admin.add_room_product');
    }
    //gọi view liệt kê phòng
    public function all_room_product(){
        $this->AuthLogin();
        $all_room_product = DB::table('room')->get();
        $manager_room = view('admin.all_room_product')->with('all_room_product',$all_room_product);
        return view('admin_layout')->with('all_room_product',$manager_room);
    }
    //xử lý lưu phòng sau khi thêm rồi hiện thông báo thêm thành công
    public function save_room_product(Request $request){
        $this->AuthLogin();
        $data = array();
        $data['room_name'] = $request->room_product_name;
        $data['room_slug'] = $request->room_product_slug;
        $data['room_status'] = $request->room_product_status;

        DB::table('room')->insert($data);
        Session::put('message','Thêm phòng thành công');
        return Redirect::to('/all-room-product');
    }
    //ẩn hiển thị trạng thái
    public function active_room_product($room_id){
        $this->AuthLogin();
        DB::table('room')->where('room_id',$room_id)->update(['room_status'=>0]);
        Session::put('message','Kích hoạt phòng thành công');
        return Redirect::to('all-room-product');
    }

    public function unactive_room_product($room_id){
        $this->AuthLogin();
        DB::table('room')->where('room_id',$room_id)->update(['room_status'=>1]);
        Session::put('message','Ẩn phòng thành công');
        return Redirect::to('all-room-product');
    }
    //edit phòng first là lấy ra 1
    public function edit_room_product($room_id){
        $this->AuthLogin();
        $edit_room_product = DB::table('room')->where('room_id',$room_id)->get();
        $manager_room = view('admin.edit_room_product')->with('edit_room_product',$edit_room_product);
        return view('admin_layout')->with('edit_room_product',$manager_room);
    }
    //update dữ liệu(request lấy yêu cầu dữ liệu)
    public function update_room_product(Request $request,$room_id){
        $this->AuthLogin();
        $data = array();
        $data['room_name'] = $request->room_product_name;
        $data['room_slug'] = $request->room_product_slug;

        DB::table('room')->where('room_id',$room_id)->update($data);
        Session::put('message','Cập nhật phòng thành công');
        return Redirect::to('/all-room-product');
    }
    //xóa phòng
    public function delete_room_product($room_id){
        $this->AuthLogin();
        DB::table('room')->where('room_id',$room_id)->delete();
        Session::put('message','Xóa phòng thành công');
        return Redirect::to('/all-room-product');
    }

    //end phần admin
    //begin phần giao diện ng dùng
    public function show_room_home(Request $request ,$room_slug){
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','0')->take(3)->get();

        $cate_pos = DB::table('cate_post')->where('cate_post_status','0')->orderby('cate_post_id','desc')->get();

        $cate_pro = DB::table('cate')->where('cate_status','0')->orderby('cate_id','desc')->get();

        $brand_pro = DB::table('brand')->where('brand_status','0')->orderby('brand_id','desc')->get();

        $room_pro = DB::table('room')->where('room_status','0')->orderby('room_id','desc')->get();

        // $room_name =  DB::table('room')->where('room_id',$room_id)->limit(1)->get();

        // $room_by_id = DB::table('product')->join('room','room.room_id','=','product.room_id')->where('product.room_id',$room_id)->get();
        $room_by_id = DB::table('product')->join('room','product.room_id','=','room.room_id')
        ->where('room.room_slug',$room_slug)->paginate(6);

        $room_name = DB::table('room')->where('room.room_slug',$room_slug)->limit(1)->get();
        return view('pages.room.show_room_home')->with('category',$cate_pro)->with('brand',$brand_pro)->with('room',$room_pro)->with('slider',$slider)->with('room_by_id',$room_by_id)
        ->with('room_name',$room_name)->with('catepo',$cate_pos);
    }
}
