<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    protected $table = 'items';
	protected $primaryKey = 'item_id';
	protected $fillable = [	'name',
							'phys_atk_range',
							'magic_atk_range',
							'armor',
							'level_required',
							'class_required',
							'bonus_hp',
							'bonus_mana',
							'bonus_agi',
							'bonus_str',
							'bonus_int',
							'bonus_level',
							'durability',
							'type',
							'slot',
							'status'];
}
