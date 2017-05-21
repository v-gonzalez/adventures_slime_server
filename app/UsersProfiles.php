<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersProfiles extends Model
{
    protected $table = 'users_profiles';
	protected $primaryKey = 'user_profile_id';
	protected $fillable = ['user_id','level','experience','hp','mana','agi','str','int','phys_dmg','magic_dmg','armor','status','last_action_date','hungry_points','tired_points','cash_points','longitued','latitude'];
	
	public function user(){
		return $this->hasOne('App\Users','user_id','user_id');
	}
}
