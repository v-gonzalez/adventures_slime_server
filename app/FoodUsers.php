<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FoodUsers extends Model
{
    protected $table = 'food_users';
	protected $primaryKey = 'food_user_id';
	protected $fillable = ['user_id','food_id','status'];
	
	public function user(){
		return $this->hasOne('App\Users','user_id','user_id');
	}
	public function food(){
		return $this->hasOne('App\FoodCatalog','food_id','food_id');
	}
}
