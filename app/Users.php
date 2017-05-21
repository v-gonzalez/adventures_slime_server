<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users extends Model{
    protected $table = 'users';
	protected $primaryKey = 'user_id';
	protected $fillable = ['nickname','device_id','phone','email'];
	
	public function friendsTo(){
		return $this->hasMany('App\Friends','friend_to','user_id');
	}
	public function friendsFrom(){
		return $this->hasMany('App\Friends','friend_from','user_id');
	}
}
