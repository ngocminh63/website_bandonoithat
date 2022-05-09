<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Slider;
use App\Models\CatePosts;
use App\Models\Post;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class CatePost extends Controller
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
    public function add_category_post(){
        $this->AuthLogin();
        $cate_pos = DB::table('cate_post')->where('cate_post_status','0')->orderby('cate_post_id','desc')->get();
    	return view('admin.add_category_post');
    }
    //gọi view liệt kê danh mục
    public function all_category_post(){
        $this->AuthLogin();
    	$all_category_post = CatePosts::orderby('cate_post_id','DESC')->get();

        // $manager_coupon = view('admin.all_coupon')->with('coupon',$coupon);
        // return view('admin_layout')->with('all_coupon',$manager_coupon);
        return view('admin.all_category_post')->with(compact('all_category_post'));
    }
    //xử lý lưu danh mục sản phẩm sau khi thêm rồi hiện thông báo thêm thành công
    public function save_category_post(Request $request){
        $this->AuthLogin();

    	$data = $request->all();

    	$cate_post = new CatePosts;

    	$cate_post->cate_post_name = $data['category_post_name'];
    	$cate_post->cate_post_slug = $data['category_post_slug'];
    	$cate_post->cate_post_desc = $data['category_post_desc'];
    	$cate_post->cate_post_status = $data['category_post_status'];
    	$cate_post->save();

    	Session::put('message','Thêm danh mục bài viết thành công');
        return Redirect::to('/all-category-post');
    }
    //ẩn hiển thị trạng thái
    public function active_category_post($cate_id){
        $this->AuthLogin();
        DB::table('cate_post')->where('cate_post_id',$cate_id)->update(['cate_post_status'=>0]);
        Session::put('message','Hiển thị danh mục bài viết thành công');
        return Redirect::to('all-category-post');
    }

    public function unactive_category_post($cate_id){
        $this->AuthLogin();
        DB::table('cate_post')->where('cate_post_id',$cate_id)->update(['cate_post_status'=>1]);
        Session::put('message','Ẩn danh mục bài viết thành công');
        return Redirect::to('all-category-post');
    }
    //edit danh mục first là lấy ra 1
    public function edit_category_post($cate_id){
        $this->AuthLogin();
        $edit_category_post = CatePosts::find($cate_id);
        return view('admin.edit_category_post')->with(compact('edit_category_post'));
    }
    //update dữ liệu(request lấy yêu cầu dữ liệu)
    public function update_category_post(Request $request,$cate_id){
        $this->AuthLogin();
        $data = $request->all();

    	$cate_post = CatePosts::find($cate_id);

    	$cate_post->cate_post_name = $data['category_post_name'];
    	$cate_post->cate_post_slug = $data['category_post_slug'];
    	$cate_post->cate_post_desc = $data['category_post_desc'];
    	$cate_post->save();

    	Session::put('message','Cập nhật danh mục bài viết thành công');
        return Redirect::to('/all-category-post');
    }
    //xóa danh mục
    public function delete_category_post($cate_id){
        $this->AuthLogin();
        $cate_post = CatePosts::find($cate_id);
        $cate_post -> delete();
        Session::put('message','Xóa danh mục bài viết thành công');
        return redirect()->back();
    }
    //end phần admin
    //begin phần giao diện ng dùng
    public function show_post(Request $request ,$post_slug){
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','0')->take(3)->get();

        $cate_pos = DB::table('cate_post')->where('cate_post_status','0')->orderby('cate_post_id','desc')->get();

        $cate_pro = DB::table('cate')->where('cate_status','0')->orderby('cate_id','desc')->get();

        $brand_pro = DB::table('brand')->where('brand_status','0')->orderby('brand_id','desc')->get();

        $room_pro = DB::table('room')->where('room_status','0')->orderby('room_id','desc')->get();


        // $category_name =  DB::table('cate')->where('cate_id',$category_id)->limit(1)->get();

        // $category_by_id = DB::table('product')->join('cate','cate.cate_id','=','product.cate_id')->where('product.cate_id',$category_id)->get();
        $catepost = CatePosts::where('cate_post_slug',$post_slug)->take(1)->get();
        foreach($catepost as $key => $cate){
            $cate_id = $cate->cate_post_id;
        }
        $post = Post::with('cate_post')->where('post_status',0)->where('cate_post_id',$cate_id)->paginate(2);
        return view('pages.baiviet.show_post')->with('category',$cate_pro)->with('brand',$brand_pro)->with('room',$room_pro)
        ->with('slider',$slider)->with('catepo',$cate_pos)->with('post',$post)->with('catepos',$catepost);
    }
    
}
