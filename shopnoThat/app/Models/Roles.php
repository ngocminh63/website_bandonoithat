<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'role_name'
    ];
    protected $primaryKey = 'role_id';
 	protected $table = 'roles';

 	public function admin(){
 		return $this->belongsToMany('App\Models\Admin');
 	}
}
