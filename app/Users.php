<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class Users extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract{
	
	use Authenticatable, Authorizable, CanResetPassword;
	
    protected $table = 'users';
	protected $primaryKey = 'user_id';
	protected $fillable = ['nickname','password','device_id','phone','email'];
	
	public function friendsTo(){
		return $this->hasMany('App\Friends','friend_to','user_id');
	}
	public function friendsFrom(){
		return $this->hasMany('App\Friends','friend_from','user_id');
	}
}
