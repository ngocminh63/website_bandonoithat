<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class Admin extends Authenticatable
{
    use Notifiable;
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'admin_email', 'admin_pass', 'admin_name','admin_phone'
    ];
    protected $primaryKey = 'admin_id';
 	protected $table = 'admin';

    public function roles(){
        return $this->belongsToMany('App\Models\Roles');
    }

    public function getAuthPassword(){
        return $this->admin_pass;
    }

    public function hasAnyRoles($roles){       

        if(is_array($roles)){
            foreach($roles as $role){
                if($this->hasRole($role)){
                    return true;
                }
            }
        }else{
            if($this->hasRole($roles)){
                return true;
            }
        }
        return false;
    }
    public function hasRole($role){               
        if($this->roles()->where('role_name',$role)->first()){
            return true;
        }
        return false;
    }
}
