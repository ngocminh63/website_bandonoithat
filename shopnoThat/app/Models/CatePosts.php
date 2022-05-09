<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatePosts extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'cate_post_name', 'cate_post_slug','cate_post_desc','cate_post_status'
    ];
    protected $primaryKey = 'cate_post_id';
 	protected $table = 'cate_post';
}
