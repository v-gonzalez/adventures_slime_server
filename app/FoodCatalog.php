<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FoodCatalog extends Model
{
    protected $table = 'food_catalog';
	protected $primaryKey = 'food_id';
	protected $fillable = ['name','hungry_recovery','type','percentage_effect','due_date'];
}
