<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Models\Slider;
use App\Models\Gallery;
use App\Models\Comment;
use File;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class ProductController extends Controller
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
    public function add_product(){
        $this->AuthLogin();
        $cate_pro = DB::table('cate')->orderby('cate_id','desc')->get();
        $brand_pro = DB::table('brand')->orderby('brand_id','desc')->get();
        $room_pro = DB::table('room')->orderby('room_id','desc')->get();
        
        return view('admin.add_product')->with('cate_pro',$cate_pro)->with('brand_pro',$brand_pro)->with('room_pro',$room_pro);
    }
    //gọi view liệt kê sản phẩm
    public function all_product(){
        $this->AuthLogin();
        $all_product = DB::table('product')
        ->join('cate','cate.cate_id','=','product.cate_id')
        ->join('brand','brand.brand_id','=','product.brand_id')
        ->join('room','room.room_id','=','product.room_id')->orderby('pro_id','desc')->get();
        $manager_product = view('admin.all_product')->with('all_product',$all_product);
        return view('admin_layout')->with('all_product',$manager_product);
    }
    //xử lý lưu sản phẩm sau khi thêm rồi hiện thông báo thêm thành công
    public function save_product(Request $request){
        $this->AuthLogin();
        $data = array();
        $data['pro_name'] = $request->product_name;
        $data['pro_qty'] = $request->product_qty;
        $data['pro_sold'] = $request->product_sold;
        $data['pro_slug'] = $request->product_slug;
        $data['pro_desc'] = $request->product_desc;
        $data['pro_price'] = $request->product_price;
        $data['pro_cost'] = $request->product_cost;
        $data['pro_size'] = $request->product_size;
        $data['pro_color'] = $request->product_color;
        $data['pro_material'] = $request->product_material;
        $data['cate_id'] = $request->product_cate;
        $data['brand_id'] = $request->product_brand;
        $data['room_id'] = $request->product_room;
        $data['pro_status'] = $request->product_status;
        //getClientOriginalExtension sẽ lấy đuôi mở rộng của hình ảnh .jpg,.png
        //current phân tách tên và đuôi .jpg
        $get_image = $request->file('product_image');

        $path = 'public/uploads/product/';
        $path_gal = 'public/uploads/gallery/';
      
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move($path,$new_image);
            //copy ảnh từ filr product sang gallery
            File::copy($path.$new_image,$path_gal.$new_image);
            $data['pro_img'] = $new_image;
        }
        $pro_id=DB::table('product')->insertGetId($data);
        $gallery= new Gallery();
        $gallery->gallery_img= $new_image;
        $gallery->gallery_name= $new_image;
        $gallery->prod_id = $pro_id;
        $gallery->save();

        Session::put('message','Thêm sản phẩm thành công');
        return Redirect::to('all-product');
    }
    //ẩn hiển thị trạng thái
    public function active_product($product_id){
        $this->AuthLogin();
        DB::table('product')->where('pro_id',$product_id)->update(['pro_status'=>0]);
        Session::put('message','Kích hoạt sản phẩm thành công');
        return Redirect::to('all-product');
    }

    public function unactive_product($product_id){
        $this->AuthLogin();
        DB::table('product')->where('pro_id',$product_id)->update(['pro_status'=>1]);
        Session::put('message','Ẩn sản phẩm thành công');
        return Redirect::to('all-product');
    }
    // edit sản phẩm; where('pro_id',$product_id) lấy id trong csdl để bằng id sp cần lấy
    public function edit_product($product_id){
        $this->AuthLogin();
        $cate_pro = DB::table('cate')->orderby('cate_id','desc')->get();
        $brand_pro = DB::table('brand')->orderby('brand_id','desc')->get();
        $room_pro = DB::table('room')->orderby('room_id','desc')->get();

        $edit_product = DB::table('product')->where('pro_id',$product_id)->get();
        $manager_product = view('admin.edit_product')->with('edit_product',$edit_product)->with('cate_pro',$cate_pro)->with('brand_pro',$brand_pro)->with('room_pro',$room_pro);
        return view('admin_layout')->with('edit_product',$manager_product);
    }
    //update dữ liệu(request lấy yêu cầu dữ liệu)
    public function update_product(Request $request,$product_id){
        $this->AuthLogin();
        $data = array();
        $data['pro_name'] = $request->product_name;
        $data['pro_qty'] = $request->product_qty;
        $data['pro_sold'] = $request->product_sold;
        $data['pro_slug'] = $request->product_slug;
        $data['pro_desc'] = $request->product_desc;
        $data['pro_price'] = $request->product_price;
        $data['pro_cost'] = $request->product_cost;
        $data['pro_size'] = $request->product_size;
        $data['pro_color'] = $request->product_color;
        $data['pro_material'] = $request->product_material;
        $data['cate_id'] = $request->product_cate;
        $data['brand_id'] = $request->product_brand;
        $data['room_id'] = $request->product_room;
        $data['pro_status'] = $request->product_status;

        $get_image = $request->file('product_image');
      
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/product',$new_image);
            $data['pro_img'] = $new_image;
            DB::table('product')->where('pro_id',$product_id)->update($data);
            Session::put('message','Cập nhật sản phẩm thành công');
            return Redirect::to('all-product');
        }
        DB::table('product')->where('pro_id',$product_id)->update($data);
    	Session::put('message','Cập nhật sản phẩm thành công');
    	return Redirect::to('all-product');
    }
    //xóa sản phẩm
    public function delete_product($product_id){
        $this->AuthLogin();
        DB::table('product')->where('pro_id',$product_id)->delete();
        Session::put('message','Xóa sản phẩm thành công');
        return Redirect::to('/all-product');
    }
    //end admin
    //begin font details
    public function details_product($product_slug){
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','0')->take(3)->get();

        $cate_pos = DB::table('cate_post')->where('cate_post_status','0')->orderby('cate_post_id','desc')->get();

        $cate_pro = DB::table('cate')->where('cate_status','0')->orderby('cate_id','desc')->get();

        $brand_pro = DB::table('brand')->where('brand_status','0')->orderby('brand_id','desc')->get();

        $room_pro = DB::table('room')->where('room_status','0')->orderby('room_id','desc')->get();

        $details_product = DB::table('product')
        ->join('cate','cate.cate_id','=','product.cate_id')
        ->join('brand','brand.brand_id','=','product.brand_id')
        ->join('room','room.room_id','=','product.room_id')
        ->where('product.pro_slug',$product_slug)->get();
        //lấy sản phẩm gợi ý
        foreach($details_product as $key => $value){
            $category_id = $value->cate_id;
            $product_id = $value->pro_id;
            $product_name = $value->pro_name;
            $product_cate = $value->cate_name;
            $category_slug= $value->cate_slug;
            $product_brand = $value->brand_name;
            $bra_slug= $value->brand_slug;
            $product_room = $value->room_name;
            $ro_slug= $value->room_slug;
        }
        //Gallery
        $gallery = Gallery::where('prod_id',$product_id)->get();
        //wherenotin lấy sản phẩm  cùng cate trừ sp đã lấy
        $related_product = DB::table('product')
        ->join('cate','cate.cate_id','=','product.cate_id')
        ->join('brand','brand.brand_id','=','product.brand_id')
        ->join('room','room.room_id','=','product.room_id')
        ->where('cate.cate_id',$category_id)->whereNotIn('product.pro_slug',[$product_slug])->paginate(3);
        
        return view('pages.sanpham.show_details')->with('category',$cate_pro)->with('brand',$brand_pro)->with('room',$room_pro)
        ->with('product_details',$details_product)->with('relate_product',$related_product)
        ->with('slider',$slider)->with('catepo',$cate_pos)->with('gallery',$gallery)
        ->with('product_cate',$product_cate)->with('category_slug',$category_slug)
        ->with('product_brand',$product_brand)->with('bra_slug',$bra_slug)
        ->with('product_room',$product_room)->with('ro_slug',$ro_slug)->with('product_name',$product_name);
    }
    //show các cmt theo từng sp
    public function load_cmt(Request $request){
        $prod_id = $request->product_id;
        $comment = Comment::where('comment_pro_id',$prod_id)->where('comment_parent_cmt','=',0)->where('cmt_status',0)->get();
        $comment_rep = Comment::with('product')->where('comment_parent_cmt','>',0)->orderBy('cmt_id','DESC')->get();
        $output = '';
        foreach($comment as $key => $comm){
            $output.='
                <div class="row style_cmt">
                    <div class="col-md-2">
                        <img width="100%" src="'.url('/public/frontend/images/images.png').'" class="img img-responsive img-thumbnail">
                    </div>
                    <div class="col-md-10">
                        <p style="color: blue;">'.$comm->cmt_name.'</p>
                        <p>'.$comm->cmt_date.'</p>
                        <p>'.$comm->comment.'</p>
                    </div>
                </div>
                <p></p>
                ';
                foreach($comment_rep as $key =>$rep_cmt){
                    if($rep_cmt->comment_parent_cmt == $comm->cmt_id){
                        $output.='
                        <div class="row style_cmt" style="margin:5px 40px; background-color:#FFFFFF">
                            <div class="col-md-2">
                                <img width="80%" src="'.url('/public/frontend/images/1.png').'" class="img img-responsive img-thumbnail">
                            </div>
                            <div class="col-md-10">
                                <p style="color: green;">MIN:FULLHOUSE</p>
                                <p>'.$rep_cmt->cmt_date.'</p>
                                <p>'.$rep_cmt->comment.'</p>
                            </div>
                        </div>
                        <p></p>';
                    }
                }
        }
        echo $output;
    }
    //KH bình luận
    public function send_cmt(Request $request){
        $prod_id = $request->product_id;
        $comment_name = $request->comment_name;
        $comment_content = $request->comment_content;
        $comment = new Comment();
        $comment->comment_pro_id= $prod_id;
        $comment->cmt_name = $comment_name;
        $comment->comment = $comment_content;
        $comment->cmt_status = 0;
        $comment->comment_parent_cmt = 0;
        $comment->save();
    }
    //lấy tất cả cmt trong admin
    public function all_comment(){
        $this->AuthLogin();
        $comment = Comment::with('product')->where('comment_parent_cmt','=',0)->orderBy('cmt_status','DESC')->get();
        $comment_rep = Comment::with('product')->where('comment_parent_cmt','>',0)->orderBy('cmt_id','DESC')->get();
        return view('admin.all_comment')->with(compact('comment','comment_rep'));
    }
    //duyetj cmt
    public function allow_cmt(Request $request){
        $data = $request->all();
        $comment = Comment::find($data['comment_id']);
        $comment->cmt_status = $data['comment_status'];
        $comment->save();
    }
    //trả lời bình luận
    public function reply_cmt(Request $request){
        $data = $request->all();
        $comment= new Comment();
        $comment->comment = $data['comment'];
        $comment->comment_pro_id = $data['comment_pro_id'];
        $comment->comment_parent_cmt = $data['comment_id'];
        $comment->cmt_status = 0;
        $comment->cmt_name = 'ADMIN';
        $comment->save();
    }
    //xóa bình luận
    public function delete_cmt($comment_id){
        $this->AuthLogin();
        $comment = Comment::find($comment_id);
        $comment->delete();
        Session::put('message','Xóa bình luận thành công');
        return Redirect::to('/comment');
    }
}
