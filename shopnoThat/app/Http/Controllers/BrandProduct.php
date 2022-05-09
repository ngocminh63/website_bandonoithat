<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Brand;
use App\Models\Slider;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();
class BrandProduct extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    //gọi view thêm thương hiệu
    public function add_brand_product(){
        $this->AuthLogin();
        return view('admin.add_brand_product');
    }
    //gọi view liệt kê thương hiệu
    public function all_brand_product(){
        $this->AuthLogin();
        // C1: static hướng đối tượng
        // $all_brand_product = DB::table('brand')->get();

        // C2 dùng với models lấy hết dl
        // $all_brand_product = Brand::all();

        //C3 dùng với model nhưng có sắp xếp cái nào thêm trước lên trước
        $all_brand_product = Brand::orderBy('brand_id','DESC')->get();

        $manager_brand = view('admin.all_brand_product')->with('all_brand_product',$all_brand_product);
        return view('admin_layout')->with('all_brand_product',$manager_brand);
    }
    //xử lý lưu thương hiệu sau khi thêm rồi hiện thông báo thêm thành công
    public function save_brand_product(Request $request){
        $this->AuthLogin();

        // $data = array();
        // $data['brand_name'] = $request->brand_product_name;
        // $data['brand_slug'] = $request->brand_product_slug;
        // $data['brand_desc'] = $request->brand_product_desc;
        // $data['brand_status'] = $request->brand_product_status;

        // DB::table('brand')->insert($data);

        $data = $request->all();

        $brand = new Brand();
        $brand->brand_name = $data['brand_product_name'];
        $brand->brand_slug = $data['brand_product_slug'];
        $brand->brand_desc = $data['brand_product_desc'];
        $brand->brand_status = $data['brand_product_status'];
        $brand->save();

        Session::put('message','Thêm thương hiệu sản phẩm thành công');
        return Redirect::to('/all-brand-product');
    }
    //ẩn hiển thị trạng thái
    public function active_brand_product($brand_id){
        $this->AuthLogin();
        DB::table('brand')->where('brand_id',$brand_id)->update(['brand_status'=>0]);
        Session::put('message','Kích hoạt thương hiệu sản phẩm thành công');
        return Redirect::to('all-brand-product');
    }

    public function unactive_brand_product($brand_id){
        $this->AuthLogin();
        DB::table('brand')->where('brand_id',$brand_id)->update(['brand_status'=>1]);
        Session::put('message','Ẩn thương hiệu sản phẩm thành công');
        return Redirect::to('all-brand-product');
    }
    //edit thương hiệu 
    public function edit_brand_product($brand_id){
        $this->AuthLogin();
        $edit_brand_product = DB::table('brand')->where('brand_id',$brand_id)->get();
        $manager_brand = view('admin.edit_brand_product')->with('edit_brand_product',$edit_brand_product);
        return view('admin_layout')->with('edit_brand_product',$manager_brand);
    }
    //update dữ liệu(request lấy yêu cầu dữ liệu)
    public function update_brand_product(Request $request,$brand_id){
        $this->AuthLogin();
        $data = array();
        $data['brand_name'] = $request->brand_product_name;
        $data['brand_slug'] = $request->brand_product_slug;
        $data['brand_desc'] = $request->brand_product_desc;

        DB::table('brand')->where('brand_id',$brand_id)->update($data);
        Session::put('message','Cập nhật thương hiệu sản phẩm thành công');
        return Redirect::to('/all-brand-product');
    }
    //xóa thương hiệu
    public function delete_brand_product($brand_id){
        $this->AuthLogin();
        DB::table('brand')->where('brand_id',$brand_id)->delete();
        Session::put('message','Xóa thương hiệu sản phẩm thành công');
        return Redirect::to('/all-brand-product');
    }
    //end phần admin
    //begin phần giao diện ng dùng
    public function show_brand_home(Request $request ,$brand_slug){
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','0')->take(3)->get();

        $cate_pos = DB::table('cate_post')->where('cate_post_status','0')->orderby('cate_post_id','desc')->get();

        $cate_pro = DB::table('cate')->where('cate_status','0')->orderby('cate_id','desc')->get();

        $brand_pro = DB::table('brand')->where('brand_status','0')->orderby('brand_id','desc')->get();

        $room_pro = DB::table('room')->where('room_status','0')->orderby('room_id','desc')->get();

        // $brand_name =  DB::table('brand')->where('brand_id',$brand_id)->limit(1)->get();

        // $brand_by_id = DB::table('product')->join('brand','brand.brand_id','=','product.brand_id')
        // ->where('product.brand_id',$brand_id)->get();
        $brand_by_id = DB::table('product')->join('brand','product.brand_id','=','brand.brand_id')
        ->where('brand.brand_slug',$brand_slug)->paginate(6);

        $brand_name = DB::table('brand')->where('brand.brand_slug',$brand_slug)->limit(1)->get();
        return view('pages.brand.show_brand_home')->with('category',$cate_pro)->with('brand',$brand_pro)->with('room',$room_pro)->with('slider',$slider)->with('brand_by_id',$brand_by_id)
        ->with('brand_name',$brand_name)->with('catepo',$cate_pos);
    }
    
}
