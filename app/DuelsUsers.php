<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DuelsUsers extends Model
{
    protected $table = 'duels_users';
	protected $primaryKey = 'duel_user_id';
	protected $fillable = ['user_from_id','user_to_id','status','init_date','end_date','user_won','durability_lost','cash_lost','hungry_lost','tired_lost'];
	
	public function userFrom(){
		return $this->hasOne('App\Users','user_id','user_from_id');
	}
	public function userTo(){
		return $this->hasOne('App\Users','user_id','user_to_id');
	}
}
