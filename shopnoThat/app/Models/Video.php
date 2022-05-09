<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    public $timestamps = false; //Mặc định  lưu ngày tạo về time
    protected $fillable = [
    	'video_title', 'video_link','video_desc', 'video_slug', 'video_img'
    ];//fillable là thêm dữ liệu vào, các cột dữ liệu//là một chuỗi
    protected $primaryKey = 'video_id';
 	protected $table = 'video';
}
