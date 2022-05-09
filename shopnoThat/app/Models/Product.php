<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'pro_name','pro_qty','pro_sold','pro_slug','cate_id','brand_id','room_id','pro_desc','pro_price','pro_size','pro_color','pro_material','pro_img','pro_status','pro_cost'
    ];
    protected $primaryKey = 'pro_id';
 	protected $table = 'product';

    public function comment(){
        return $this->hasMany('App\Models\Comment');
    }
}
