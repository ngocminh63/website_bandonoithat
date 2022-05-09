<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Models\Slider;
use App\Models\Contact;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class ContactController extends Controller
{
    public function lien_he(){
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','0')->take(3)->get();

        $cate_pos = DB::table('cate_post')->where('cate_post_status','0')->orderby('cate_post_id','desc')->get();

        $cate_pro = DB::table('cate')->where('cate_status','0')->orderby('cate_id','desc')->get();

        $brand_pro = DB::table('brand')->where('brand_status','0')->orderby('brand_id','desc')->get();

        $room_pro = DB::table('room')->where('room_status','0')->orderby('room_id','desc')->get();

        // $all_product = DB::table('product')
        // ->join('cate','cate.cate_id','=','product.cate_id')
        // ->join('brand','brand.brand_id','=','product.brand_id')
        // ->orderby('pro_id','desc')->get();
        

        return view ('pages.lienhe.contact')->with('category',$cate_pro)->with('brand',$brand_pro)->with('room',$room_pro)->with('slider',$slider)->with('catepo',$cate_pos);
    }
}
