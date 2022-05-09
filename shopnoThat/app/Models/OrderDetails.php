<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'order_code', 'pro_id', 'pro_name','pro_price','pro_sales_qty','pro_coupon','pro_fee'
    ];
    protected $primaryKey = 'order_details_id';
 	protected $table = 'order_details';

 	public function product(){
 		return $this->belongsTo('App\Models\Product','pro_id');
 	}
}
