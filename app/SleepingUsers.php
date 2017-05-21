<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SleepingUsers extends Model
{
    protected $table = 'sleeping_users';
	protected $primaryKey = 'sleeping_user_id';
	protected $fillable = ['user_id','init_date','end_date','tired_recovery','hungry_cost','status'];
	
	public function user(){
		return $this->hasOne('App\Users','user_id','user_id');
	}
}
