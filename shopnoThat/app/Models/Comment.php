<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public $timestamps = false; //Mặc định  lưu ngày tạo về time
    protected $fillable = [
    	'comment', 'cmt_name', 'cmt_date','cmt_status','comment_pro_id','comment_parent_cmt'
    ];//fillable là thêm dữ liệu vào, các cột dữ liệu//là một chuỗi
    protected $primaryKey = 'cmt_id';
 	protected $table = 'comments';

    public function product(){
        return $this->belongsTo('App\Models\Product','comment_pro_id');
    }
}
