<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cate extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'cate_name', 'cate_slug','cate_desc','cate_status'
    ];
    protected $primaryKey = 'cate_id';
 	protected $table = 'cate';
}
