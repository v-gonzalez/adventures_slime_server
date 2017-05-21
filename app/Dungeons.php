<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dungeons extends Model
{
    protected $table = 'dungeons';
	protected $primaryKey = 'dungeon_id';
	protected $fillable = ['level_required','durability','name','status','exp_reward_range','cash_reward_range','tired_cost_range','hungry_cost_range'];
}
