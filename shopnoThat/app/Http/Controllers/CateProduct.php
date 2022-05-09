<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Slider;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class CateProduct extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    //gọi view thêm danh mục
    public function add_category_product(){
        $this->AuthLogin();
        return view('admin.add_category_product');
    }
    //gọi view liệt kê danh mục
    public function all_category_product(){
        $this->AuthLogin();
        $all_category_product = DB::table('cate')->get();
        $manager_cate = view('admin.all_category_product')->with('all_category_product',$all_category_product);
        return view('admin_layout')->with('all_category_product',$manager_cate);
    }
    //xử lý lưu danh mục sản phẩm sau khi thêm rồi hiện thông báo thêm thành công
    public function save_category_product(Request $request){
        $this->AuthLogin();
        $data = array();
        $data['cate_name'] = $request->category_product_name;
        $data['cate_slug'] = $request->category_product_slug;
        $data['cate_desc'] = $request->category_product_desc;
        $data['cate_status'] = $request->category_product_status;

        DB::table('cate')->insert($data);
        Session::put('message','Thêm danh mục sản phẩm thành công');
        return Redirect::to('/all-category-product');
    }
    //ẩn hiển thị trạng thái
    public function active_category_product($category_id){
        $this->AuthLogin();
        DB::table('cate')->where('cate_id',$category_id)->update(['cate_status'=>0]);
        Session::put('message','Kích hoạt danh mục sản phẩm thành công');
        return Redirect::to('all-category-product');
    }

    public function unactive_category_product($category_id){
        $this->AuthLogin();
        DB::table('cate')->where('cate_id',$category_id)->update(['cate_status'=>1]);
        Session::put('message','Ẩn danh mục sản phẩm thành công');
        return Redirect::to('all-category-product');
    }
    //edit danh mục first là lấy ra 1
    public function edit_category_product($category_id){
        $this->AuthLogin();
        $edit_category_product = DB::table('cate')->where('cate_id',$category_id)->get();
        $manager_cate = view('admin.edit_category_product')->with('edit_category_product',$edit_category_product);
        return view('admin_layout')->with('edit_category_product',$manager_cate);
    }
    //update dữ liệu(request lấy yêu cầu dữ liệu)
    public function update_category_product(Request $request,$category_id){
        $this->AuthLogin();
        $data = array();
        $data['cate_name'] = $request->category_product_name;
        $data['cate_slug'] = $request->category_product_slug;
        $data['cate_desc'] = $request->category_product_desc;

        DB::table('cate')->where('cate_id',$category_id)->update($data);
        Session::put('message','Cập nhật danh mục sản phẩm thành công');
        return Redirect::to('/all-category-product');
    }
    //xóa danh mục
    public function delete_category_product($category_id){
        $this->AuthLogin();
        DB::table('cate')->where('cate_id',$category_id)->delete();
        Session::put('message','Xóa danh mục sản phẩm thành công');
        return Redirect::to('/all-category-product');
    }
    //end phần admin
    //begin phần giao diện ng dùng
    public function show_cate_home(Request $request ,$category_slug){
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','0')->take(3)->get();

        $cate_pos = DB::table('cate_post')->where('cate_post_status','0')->orderby('cate_post_id','desc')->get();

        $cate_pro = DB::table('cate')->where('cate_status','0')->orderby('cate_id','desc')->get();

        $brand_pro = DB::table('brand')->where('brand_status','0')->orderby('brand_id','desc')->get();

        $room_pro = DB::table('room')->where('room_status','0')->orderby('room_id','desc')->get();


        // $category_name =  DB::table('cate')->where('cate_id',$category_id)->limit(1)->get();

        // $category_by_id = DB::table('product')->join('cate','cate.cate_id','=','product.cate_id')->where('product.cate_id',$category_id)->get();
        $category_by_id = DB::table('product')->join('cate','cate.cate_id','=','product.cate_id')
        ->where('cate.cate_slug',$category_slug)->paginate(6);

        $category_name = DB::table('cate')->where('cate.cate_slug',$category_slug)->limit(1)->get();
        return view('pages.category.show_category_home')->with('category',$cate_pro)->with('brand',$brand_pro)->with('room',$room_pro)
        ->with('category_by_id',$category_by_id)->with('category_name',$category_name)->with('slider',$slider)->with('catepo',$cate_pos);
    }
}
