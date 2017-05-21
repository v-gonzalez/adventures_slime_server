<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemsDungeonsDrops extends Model
{
    protected $table = 'items_dungeons_drops';
	protected $primaryKey = 'item_dungeon_drop_id';
	protected $fillable = ['dungeon_id','item_id','drop_chance'];

	public function dungeon(){
		return $this->hasOne('App\Dungeons','dungeon_id','dungeon_id');
	}
	public function Items(){
		return $this->hasOne('App\Items','item_id','item_id');
	}
}
