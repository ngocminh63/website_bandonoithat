<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'cus_name', 'cus_email', 'cus_password','cus_phone'
    ];
    protected $primaryKey = 'cus_id';
 	protected $table = 'customers';
}
