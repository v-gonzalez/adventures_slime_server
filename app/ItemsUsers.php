<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemsUsers extends Model
{
    protected $table = 'items_users';
	protected $primaryKey = 'item_user_id';
	protected $fillable = ['user_id','item_id','status'];
	
	public function user(){
		return $this->hasOne('App\Users','user_id','user_id');
	}
	public function item(){
		return $this->hasOne('App\Items','item_id','item_id');
	}
}
