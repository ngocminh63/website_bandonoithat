<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    public $timestamps = false; //Mặc định  lưu ngày tạo về time
    protected $fillable = [
    	'gallery_name', 'gallery_img', 'prod_id'
    ];//fillable là thêm dữ liệu vào, các cột dữ liệu//là một chuỗi
    protected $primaryKey = 'gallery_id';
 	protected $table = 'gallery';
}
