<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    public $timestamps = false; //Mặc định  lưu ngày tạo về time
    protected $fillable = [
    	'brand_name', 'brand_slug', 'brand_desc','brand_status'
    ];//fillable là thêm dữ liệu vào, các cột dữ liệu//là một chuỗi
    protected $primaryKey = 'brand_id';
 	protected $table = 'brand';
}
