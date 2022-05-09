<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'ship_name', 'ship_address', 'ship_phone','ship_email','ship_notes','ship_method'
    ];
    protected $primaryKey = 'ship_id';
 	protected $table = 'shipping';
}
