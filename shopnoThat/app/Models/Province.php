<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'name_qh', 'type', 'matp'
    ];
    protected $primaryKey = 'maqh';
 	protected $table = 'quanhuyen';
}
