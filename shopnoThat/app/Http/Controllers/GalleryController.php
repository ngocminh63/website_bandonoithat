<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Models\Gallery;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class GalleryController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    //gọi view thêm gallery
    public function add_gallery($prod_id){
        $this->AuthLogin();
        $pro_id = $prod_id;
    	return view('admin.add_gallery')->with(compact('pro_id'));
    }
    public function insert_gallery(Request $request, $prod_id){
        $this->AuthLogin();
        $get_image = $request->file('file');
        if($get_image){
            foreach($get_image as $image){
                $get_name_image = $image->getClientOriginalName();
                $name_image = current(explode('.',$get_name_image));
                $new_image =  $name_image.rand(0,99).'.'.$image->getClientOriginalExtension();
                $image->move('public/uploads/gallery',$new_image);
                $gallery = new Gallery();
                $gallery->gallery_name = $new_image;
                $gallery->gallery_img = $new_image;
                $gallery->prod_id = $prod_id;
                $gallery->save();
            }
        }
        Session::put('message','Thêm thư viện ảnh thành công');
        return redirect()->back();
    }
    //update tên gallery
    public function update_galname(Request $request){
        $gal_id = $request->gal_id;
        $gal_text = $request->gal_text;
        $gallery = Gallery::find($gal_id);
        $gallery->gallery_name = $gal_text;
        $gallery->save();
    }
    //xóa gallery
    public function delete_gallery(Request $request){
        $gal_id = $request->gal_id;
        $gallery = Gallery::find($gal_id);
        unlink('public/uploads/gallery/'.$gallery->gallery_img);
        $gallery->delete();
        Session::put('message','Xóa thư viện ảnh thành công');
        return redirect()->back();
    }
    //contenteditable tên có thể sửa đk
    public function all_gallery(Request $request){
        $product_id = $request->pro_id;
        $gallery= Gallery::where('prod_id',$product_id)->get();
        $gallery_cout = $gallery->count();                        //đếm số ảnh
        $output = '<form>
                    '.csrf_field().'
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tên hình ảnh</th>
                                <th>Hình ảnh</th>
                                <th>Quản lý</th>
                            </tr>
                        </thead>
                        <tbody>
        ';
        if($gallery_cout > 0){
            $i = 0;
            foreach($gallery as $key => $ga){
                $i++;
                $output.='
                    <form>
                    '.csrf_field().'
                        <tr>
                            <td>'.$i.'</td>  
                            <td contenteditable class="edit_galname" data-gal_id="'.$ga->gallery_id.'">'.$ga->gallery_name.'</td>                                   
                            <td>
                                <img src="'.url('public/uploads/gallery/'.$ga->gallery_img).'" class="img-thumbnail" height="100" width="100">
                            </td>
                            <td><button type="button" data-gal_id="'.$ga->gallery_id.'" class="btn btn-xs btn-danger delete-gallery">Xóa</button></td>
                        </tr>
                    </form>
                ';
            }
        }else{
            $output.='<tr>
                            <td colspan="4">Sản phẩm chưa có thư viện ảnh</td>
                        </tr>
                ';
        }
        $output.='		
                    </tbody>
                </table>
            </form>
			';
        echo $output;
    }
}
