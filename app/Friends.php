<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Friends extends Model
{
    protected $table = 'friends';
	protected $primaryKey = 'friend_id';
	protected $fillable = ['friend_from','friend_to','status'];
	
	public function friendFrom(){
		return $this->hasOne('App\Users','user_id','friend_from');
	}
	public function friendTo(){
		return $this->hasOne('App\Users','user_id','friend_to');
	}
}
