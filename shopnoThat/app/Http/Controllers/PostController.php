<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Models\Slider;
use App\Models\Post;
use App\Models\CatePosts;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class PostController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    //gọi view thêm sản phẩm
    public function add_post(){
        $this->AuthLogin();
        $cate_pos = CatePosts::orderBy('cate_post_id','DESC')->get();
        return view('admin.add_post')->with(compact('cate_pos'));
    }
    //gọi view liệt kê sản phẩm
    public function all_post(){
        $this->AuthLogin();
        $all_post = Post::orderBy('post_id')->get();
        
        return view('admin.all_post')->with(compact('all_post'));
    }
    //xử lý lưu sản phẩm sau khi thêm rồi hiện thông báo thêm thành công
    public function save_post(Request $request){
        $this->AuthLogin();
        $data = $request->all();
        $post = new Post();
        
        $post->post_title = $data['post_title'];
    	$post->post_slug = $data['post_slug'];
    	$post->post_desc = $data['post_desc'];
        $post->post_content = $data['post_content'];
        $post->cate_post_id = $data['post_cate'];
    	$post->post_status = $data['post_status'];

        $get_image = $request->file('post_image');
      
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();      //lấy tên của hình ảnh
            $name_image = current(explode('.',$get_name_image));        //lấy tên 1.jpg, nó lấy 1, current lấy tên ảnh
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();   //lấy đuôi mở rộng
            $get_image->move('public/uploads/post',$new_image);        //nơi chứa ảnh với tên mới
            
            $post->post_img = $new_image;

            $post -> save();
            Session::put('message','Thêm bài viết thành công');
            return Redirect::to('all-post');
        }else{
            Session::put('message','Thêm bài viết không thành công');
            return redirect()->back();
        }
        
    }
    //ẩn hiển thị trạng thái
    public function active_post($pos_id){
        $this->AuthLogin();
        DB::table('posts')->where('post_id',$pos_id)->update(['post_status'=>0]);
        Session::put('message','Hiển thị bài viết');
        return Redirect::to('all-post');
    }

    public function unactive_post($pos_id){
        $this->AuthLogin();
        DB::table('posts')->where('post_id',$pos_id)->update(['post_status'=>1]);
        Session::put('message','Ẩn bài viết');
        return Redirect::to('all-post');
    }
    public function edit_post($pos_id){
        $this->AuthLogin();
        $cate_pos = DB::table('cate_post')->orderby('cate_post_id','desc')->get();

        $edit_post = DB::table('posts')->where('post_id',$pos_id)->get();
        $manager_post = view('admin.edit_post')->with('edit_post',$edit_post)->with('cate_pos',$cate_pos);
        return view('admin_layout')->with('edit_post',$manager_post);
    }
    //update dữ liệu(request lấy yêu cầu dữ liệu)
    public function update_post(Request $request,$pos_id){
        $this->AuthLogin();
        $data = array();
        $data['post_title'] = $request->post_title;
        $data['post_slug'] = $request->post_slug;
        $data['post_desc'] = $request->post_desc;
        $data['post_content'] = $request->post_content;
        $data['cate_post_id'] = $request->post_cate;

        $get_image = $request->file('post_image');
      
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/post',$new_image);
            $data['post_img'] = $new_image;
            DB::table('posts')->where('post_id',$pos_id)->update($data);
            Session::put('message','Cập nhật bài viết thành công');
            return Redirect::to('all-post');
        }
        DB::table('posts')->where('post_id',$pos_id)->update($data);
    	Session::put('message','Cập nhật bài viết thành công');
    	return Redirect::to('all-post');
    }
    //xóa sản phẩm
    public function delete_post($pos_id){
        $this->AuthLogin();
        $post = Post::find($pos_id);
        $post_image = $post->post_img;
        unlink('public/uploads/post/'.$post_image);          //xóa hình ảnh trong file ảnh khi xóa bài viêts

        $post->delete();

        Session::put('message','Xóa sản phẩm thành công');
        return redirect()->back();
    }
    //end admin
    //chi tiết bài viết
    public function bai_viet(Request $request ,$post_slug){
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','0')->take(3)->get();

        $cate_pos = DB::table('cate_post')->where('cate_post_status','0')->orderby('cate_post_id','desc')->get();

        $cate_pro = DB::table('cate')->where('cate_status','0')->orderby('cate_id','desc')->get();

        $brand_pro = DB::table('brand')->where('brand_status','0')->orderby('brand_id','desc')->get();

        $room_pro = DB::table('room')->where('room_status','0')->orderby('room_id','desc')->get();


        // $category_name =  DB::table('cate')->where('cate_id',$category_id)->limit(1)->get();

        // $category_by_id = DB::table('post')->join('cate','cate.cate_id','=','post.cate_id')->where('post.cate_id',$category_id)->get();
        // $catepost = CatePosts::where('cate_post_slug',$post_slug)->take(1)->get();
        // foreach($catepost as $key => $cate){
        //     $cate_id = $cate->cate_post_id;
        // }
        $post = Post::with('cate_post')->where('post_status',0)->where('post_slug',$post_slug)->take(1)->get();
        foreach($post as $key => $p){
            $cate_id = $p->cate_post_id;
        }
        $related = Post::with('cate_post')->where('post_status',0)-> where('cate_post_id',$cate_id)
        ->whereNotIn('post_slug',[$post_slug])->take(3)->get();
        return view('pages.baiviet.post_detail')->with('category',$cate_pro)->with('brand',$brand_pro)->with('room',$room_pro)
        ->with('slider',$slider)->with('catepo',$cate_pos)->with('post',$post)->with('related',$related);
    }
}
