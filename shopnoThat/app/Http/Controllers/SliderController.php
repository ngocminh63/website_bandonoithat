<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class SliderController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    //gọi view liệt kê slider
    public function all_slider(){
        $this->AuthLogin();
        $all_slider = Slider::orderBy('slider_id','DESC')->get();             //thêm sau lên trước
    	return view('admin.all_slider')->with(compact('all_slider'));
    }

    //ẩn hiển thị trạng thái
    public function active_slider($slider_id){
        $this->AuthLogin();
        DB::table('slider')->where('slider_id',$slider_id)->update(['slider_status'=>0]);
        Session::put('message','Kích hoạt ảnh slide thành công');
        return Redirect::to('all-slider');
    }

    public function unactive_slider($slider_id){
        $this->AuthLogin();
        DB::table('slider')->where('slider_id',$slider_id)->update(['slider_status'=>1]);
        Session::put('message','Ẩn ảnh slide thành công');
        return Redirect::to('all-slider');
    }

    //gọi view thêm slider
    public function add_slider(){
        $this->AuthLogin();
    	return view('admin.add_slider');
    }

    //lưu slider
    public function save_slider(Request $request){
    	
    	$this->AuthLogin();

   		$data = $request->all();
       	$get_image = request('slider_image');
      
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();                                  //lấy tên của hình ảnh đó
            $name_image = current(explode('.',$get_name_image));                                    //phân tách tên vd 123.jpg, end nó lấy jpg, curent lấy 123
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();      //random để ghép với tên đã lấy
            $get_image->move('public/uploads/slider', $new_image);

            $slider = new Slider();
            $slider->slider_name = $data['slider_name'];
            $slider->slider_img = $new_image;
            $slider->slider_status = $data['slider_status'];
            $slider->slider_desc = $data['slider_desc'];
           	$slider->save();
            Session::put('message','Thêm slide thành công');
            return Redirect::to('all-slider');
        }else{
        	Session::put('message','Thêm slide không thành công');
    		return Redirect::to('add-slider');
        }
       	
    }
    //xóa slide
    public function delete_slide($slider_id){
        $this->AuthLogin();
        DB::table('slider')->where('slider_id',$slider_id)->delete();
        Session::put('message','Xóa ảnh slide thành công');
        return Redirect::to('/all-slider');
    }
}
