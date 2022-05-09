<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'name_tp', 'type'
    ];
    protected $primaryKey = 'matp';
 	protected $table = 'tinhthanhpho';
}
