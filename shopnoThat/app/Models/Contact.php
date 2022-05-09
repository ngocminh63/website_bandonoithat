<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    public $timestamps = false; //Mặc định  lưu ngày tạo về time
    protected $fillable = [
    	'inf_contact', 'inf_map','inf_img'
    ];//fillable là thêm dữ liệu vào, các cột dữ liệu//là một chuỗi
    protected $primaryKey = 'inf_id';
 	protected $table = 'information';
}
