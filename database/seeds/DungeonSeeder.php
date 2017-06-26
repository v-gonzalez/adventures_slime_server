<?php

use Illuminate\Database\Seeder;
use App\Dungeons;
class DungeonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Dungeons::create(
        	[
        		'level_required' =>'1',
        		'level_required'=>1,
        		'durability'=>5,
        		'name'=>'Dummy Example 1',
        		'status'=>'easy',
        		'exp_reward_range'=>'40,60',
        		'cash_reward_range'=>'10,20',
        		'tired_cost_range'=>'20,30',
        		'hungry_cost_range'=>'7,10'
        	]
        );
        Dungeons::create(
        		['level_required' =>'1',
        		'level_required'=>2,
        		'durability'=>3,
        		'name'=>'Dummy Example 2',
        		'status'=>'hard',
        		'exp_reward_range'=>'40,60',
        		'cash_reward_range'=>'10,20',
        		'tired_cost_range'=>'20,30',
        		'hungry_cost_range'=>'7,10'
        	]
        );
        Dungeons::create(
        	[
        		'level_required' =>'1',
        		'level_required'=>3,
        		'durability'=>10,
        		'name'=>'Dummy Example 3',
        		'status'=>'crazy',
        		'exp_reward_range'=>'40,60',
        		'cash_reward_range'=>'10,20',
        		'tired_cost_range'=>'20,30',
        		'hungry_cost_range'=>'7,10'
        	]
        );
        Dungeons::create(
        	[
        		'level_required' =>'1',
        		'level_required'=>4,
        		'durability'=>30,
        		'name'=>'Dummy Example 4',
        		'status'=>'nightmare',
        		'exp_reward_range'=>'200,500',
        		'cash_reward_range'=>'250,300',
        		'tired_cost_range'=>'50,60',
        		'hungry_cost_range'=>'30,35'
        	]
        );
    }
}
