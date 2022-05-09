<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public $timestamps = false; //Mặc định  lưu ngày tạo về time
    protected $fillable = [
    	'post_title', 'post_desc', 'post_content','post_status','post_slug','post_img','cate_post_id'
    ];//fillable là thêm dữ liệu vào, các cột dữ liệu//là một chuỗi
    protected $primaryKey = 'post_id';
 	protected $table = 'posts';
    
    public function cate_post(){
        return $this->belongsTo('App\Models\CatePosts', 'cate_post_id');
    }
}

