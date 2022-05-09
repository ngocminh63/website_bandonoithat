<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Video;
use App\Models\Slider;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class VideoController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    //gọi view show video
    public function video(){
        return view('admin.all_video');
    }
    //thêm video
    public function insert_video(Request $request){
        $data= $request->all();
        $video = new Video();
        $sub_link = substr($data['video_link'], 17);                 //cắt 17 kí tự đầu của link
        $video->video_title = $data['video_title'];
        $video->video_slug = $data['video_slug'];
        $video->video_link = $sub_link;
        $video->video_desc = $data['video_desc'];

        $get_image = $request->file('file');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/video',$new_image);
            $video->video_img = $new_image;
        }
        $video->save();
    }
    //cập nhật video
    public function update_video(Request $request){
        $data= $request->all();
        $video_id = $data['video_id'];
        $video_edit = $data['video_edit'];
        $video_check = $data['video_check'];
        $video = Video::find($video_id);

        if($video_check == 'video_title'){
            $video->video_title = $video_edit;
        }elseif($video_check == 'video_slug'){
            $video->video_slug = $video_edit;
        }elseif($video_check == 'video_link'){
            $sub_link = substr($video_edit, 17);
            $video->video_link = $sub_link;
        }else{
            $video->video_desc = $video_edit;
        }
        $video->save();
    }
    //xóa video
    public function delete_video(Request $request){
        $data= $request->all();
        $video_id = $data['video_id'];
        $video = Video::find($video_id);
        unlink('public/uploads/video/'.$video->video_img);
        $video->delete();
    }
    public function all_video(Request $request){
        $video= Video::orderBy('video_id','DESC')->get();
        $video_cout = $video->count();                        //đếm số ảnh
        $output = '<form>
                    '.csrf_field().'
                    <table class="table table-striped b-t b-light">
                        <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên video</th>
                            <th>Slug</th>
                            <th>Link</th>
                            <th>Hình ảnh</th>
                            <th>Mô tả</th>
                            <th>Demo video</th>
                            <th style="width:30px;"></th>
                        </tr>
                        </thead>
                        <tbody>
        ';
        if($video_cout > 0){
            $i = 0;
            foreach($video as $key => $vi){
                $i++;
                $output.='
                    <form>
                    '.csrf_field().'
                    <tr>
                        <td>'.$i.'</td>
                        <td contenteditable data-video_id="'.$vi->video_id.'" class="video_edit" data-video_type="video_title" id="video_title_'.$vi->video_id.'">'.$vi->video_title.'</td>

                        <td contenteditable data-video_id="'.$vi->video_id.'" class="video_edit" data-video_type="video_slug" id="video_slug_'.$vi->video_id.'">'.$vi->video_slug.'</td>

                        <td contenteditable data-video_id="'.$vi->video_id.'" class="video_edit" data-video_type="video_link" id="video_link_'.$vi->video_id.'">https://youtu.be/'.$vi->video_link.'</td>

                        <td>
                            <img src="'.url('public/uploads/video/'.$vi->video_img).'" class="img-thumbnail" height="300" width="300">
                        </td>

                        <td contenteditable data-video_id="'.$vi->video_id.'" class="video_edit" data-video_type="video_desc" id="video_desc_'.$vi->video_id.'">'.$vi->video_desc.'</td>

                        <td><iframe width="200" height="200" src="https://www.youtube.com/embed/'.$vi->video_link.'" title="YouTube video player" frameborder="0" 
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; 
                            picture-in-picture" allowfullscreen></iframe>
                        </td>
                        <td><button type="button" data-video_id="'.$vi->video_id.'" class="btn btn-xs btn-danger btn-delete-video">Xóa video</button></td>
                    </tr>
                    </form>
                ';
            }
        }else{
            $output.='<tr>
                            <td colspan="4">Chưa có video nào</td>
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
    public function show_video_home(){
        //slide
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','0')->take(3)->get();

        $cate_pos = DB::table('cate_post')->where('cate_post_status','0')->orderby('cate_post_id','desc')->get();

        $cate_pro = DB::table('cate')->where('cate_status','0')->orderby('cate_id','desc')->get();

        $brand_pro = DB::table('brand')->where('brand_status','0')->orderby('brand_id','desc')->get();

        $room_pro = DB::table('room')->where('room_status','0')->orderby('room_id','desc')->get();

        // $all_product = DB::table('product')
        // ->join('cate','cate.cate_id','=','product.cate_id')
        // ->join('brand','brand.brand_id','=','product.brand_id')
        // ->orderby('pro_id','desc')->get();
        $all_video = DB::table('video')->paginate(6);

        return view('pages.video.video')->with('category',$cate_pro)->with('brand',$brand_pro)->with('room',$room_pro)->with('all_video',$all_video)->with('slider',$slider)->with('catepo',$cate_pos);
    }
    public function watch_video(Request $request){
        $video_id = $request->video_id;
        $video = Video::find($video_id);
        $output['video_title']= $video->video_title;
        $output['video_desc']= $video->video_desc;
        $output['video_link']= '<iframe width="100%" height="400" src="https://www.youtube.com/embed/'.$video->video_link.'" title="YouTube video player" frameborder="0" 
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; 
                                picture-in-picture" allowfullscreen></iframe>';
        echo json_encode($output);                                    //giải mã dữ liệu
    }
}
