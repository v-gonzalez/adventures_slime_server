<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Users;
use App\Dungeons;
use App\DungeonsUsers;
use App\UsersProfiles;

class DungeonUsersChecker extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:updateDungeonsUsers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will update the current stats of the users who completed their active dungeons';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $dungeonsUsers = DungeonsUsers::where("end_date","<",date("Y-m-d h:i:s"))->where("status","=","active")->get();
        foreach ($dungeonsUsers as $key => $value) {
            $dungeonModel = Dungeons::where("dungeon_id","=",$dungeonsUsers[$key]['dungeon_id'])->first();
            $userProfileModel = UsersProfiles::where("user_id","=",$dungeonsUsers[$key]['user_id'])->first();
            
            $dungeonLost = false;
            $hp = $userProfileModel['hp'];
            $hungry_points = $userProfileModel['hungry_points'];
            $tired_points = $userProfileModel['tired_points'];
            
            $lifeCostRange = explode(',',$dungeonModel['life_cost_range'] );
            $lifeCostRange = random_int((int)$lifeCostRange[0], (int)$lifeCostRange[1]);
            
            $tiredCostRange = explode(',',$dungeonModel['tired_cost_range'] );
            $tiredCostRange = random_int((int)$tiredCostRange[0], (int)$tiredCostRange[1]);

            $hungryCostRange = explode(',',$dungeonModel['hungry_cost_range'] );
            $hungryCostRange = random_int((int)$hungryCostRange[0], (int)$hungryCostRange[1]);

            $expRewardRange = explode(',',$dungeonModel['exp_reward_range'] );
            $expRewardRange = random_int((int)$expRewardRange[0], (int)$expRewardRange[1]);    

            $cashRewardRange = explode(',',$dungeonModel['cash_reward_range'] );
            $cashRewardRange = random_int((int)$cashRewardRange[0], (int)$cashRewardRange[1]);

            $lifeCostRange = (float)$lifeCostRange / (float)$userProfileModel['armor'];
            
            (float)$userProfileModel['hp'] -= $lifeCostRange;
            (int)$userProfileModel['hungry_points'] -= $hungryCostRange;
            (int)$userProfileModel['tired_points'] -= $tiredCostRange;

            if ((int)$userProfileModel['hp'] < 1){
                $dungeonLost = true;
            }
            if ((int)$userProfileModel['hungry_points'] < 1 || $userProfileModel['tired_points'] < 1)
                $dungeonLost = true;

            if ($dungeonLost){
                $userProfileModel['hp'] = 0;
                $userProfileModel['hungry_points'] = 0;
                $userProfileModel['tired_points'] = 0;
                $userProfileModel['status'] = 'lost_dungeon';
                $dungeonsUsers[$key]['status'] = 'lost';
            }else{
                (int)$userProfileModel['cash_points'] += $cashRewardRange;
                (int)$userProfileModel['experience'] += $expRewardRange;
                if ((int)$userProfileModel['experience'] > 100){
                    (int)$userProfileModel['level'] += 1;
                    (int)$userProfileModel['experience'] = 0;
                    (float)$userProfileModel['armor'] += .15;
                    $userProfileModel['armor'] = number_format($userProfileModel['armor'], 2, '.', '');

                    (int)$userProfileModel['agi'] += 2;
                    (int)$userProfileModel['str'] += 5;
                    (int)$userProfileModel['inte'] += 3;

                    (int)$userProfileModel['phys_dmg'] += 5;
                    (int)$userProfileModel['magic_dmg'] += 8;
                }
                $dungeonsUsers[$key]['status'] = 'completed';
                $userProfileModel['status'] = 'active';
                if ((int)$userProfileModel['hungry_points'] < 20 )
                    $userProfileModel['status'] = 'hungry';
                if ((int)$userProfileModel['tired_points'] < 20 )
                    $userProfileModel['status'] = 'tired';
            }
            $dungeonsUsers[$key]->save();
            $userProfileModel->save();
        }
        echo 'Update success: ' . date("Y-m-d h:i:s");
    }
}
