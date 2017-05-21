<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DungeonsUsers extends Model
{
    protected $table = 'dungeons_users';
	protected $primaryKey = 'dungeon_user_id';
	protected $fillable = ['dungeon_id','user_id','init_date','end_date','status'];
	
	public function user(){
		return $this->hasOne('App\Users','user_id','user_id');
	}
	public function dungeon(){
		return $this->hasOne('App\Dungeons','dungeon_id','dungeon_id');
	}
}
