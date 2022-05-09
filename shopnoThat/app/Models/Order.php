<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'cus_id', 'ship_id', 'order_status','order_code','created_at','order_date'
    ];
    protected $primaryKey = 'order_id';
 	protected $table = 'order';
}
