<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\SleepingUsers;
use App\Users;
use App\UsersProfiles;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SleepingUsersController extends Controller
{
    public function getById($id){
        $data['Result'] = null;
        $data['Code'] = 500;
        $data['Error'] = true;
        $data['Message'] = 'Ha ocurrido un error inesperado';

        $sleepingUser = SleepingUsers::find($id);
        if ($sleepingUser === null){
            $data['Result'] = null;
            $data['Code'] = 404;
            $data['Error'] = true;
            $data['Message'] = 'There is not sleeping user at this moment.';
            return null;
        }
        $data['Result'] = $sleepingUser;
        $data['Code'] = 200;
        $data['Error'] = false;
        $data['Message'] = 'User profile found';
        return response()->json($sleepingUser, 200);
    }
    public function getByUserId($id){
        $data['Result'] = null;
        $data['Code'] = 500;
        $data['Error'] = true;
        $data['Message'] = 'Ha ocurrido un error inesperado';

        $userSleeping = SleepingUsers::where("user_id","=",$id)->first();
        if ($userSleeping === null){
            $data['Result'] = null;
            $data['Code'] = 404;
            $data['Error'] = true;
            $data['Message'] = 'There is not user sleeping at this moment.';
            return null;
        }
        $data['Result'] = $userSleeping;
        $data['Code'] = 200;
        $data['Error'] = false;
        $data['Message'] = 'User sleeping found';
        return response()->json($userSleeping, 200);
    }
    public function getByUserIds($ids){
        $data['Result'] = null;
        $data['Code'] = 500;
        $data['Error'] = true;
        $data['Message'] = 'Ha ocurrido un error inesperado';

        $json_ids = json_decode($ids);

        $userSleepings = [];
        foreach ($json_ids as $id) {
            $userSleepings[] = SleepingUsers::where("user_id","=",$id)->first();
        }
        
        if ($userSleepings === null){
            $data['Result'] = null;
            $data['Code'] = 404;
            $data['Error'] = true;
            $data['Message'] = 'There are not users sleeping at this moment.';
            return null;
        }
        $data['Result'] = $userSleepings;
        $data['Code'] = 200;
        $data['Error'] = false;
        $data['Message'] = 'Users sleeping found';
        return response()->json($userSleepings, 200);
    }
    public function sleepUser(Request $request){
        $inputData = $request->input();
        $id = $inputData['id'];
        $session = $inputData['session'];

        $data['Result'] = null;
        $data['Code'] = 500;
        $data['Error'] = true;
        $data['Message'] = 'Ha ocurrido un error inesperado';

        $verifiedUser = Users::where("user_id","=",$id)->where("remember_token","=",$session)->first();
        if ($verifiedUser){
            $sleepingUser = SleepingUsers::where("user_id","=",$id)->first();
            if (empty($sleepingUser)){
                $newRow = new SleepingUsers;
                $newRow['user_id'] = $id;
                $newRow['init_date'] = date("Y-m-d");
                $newRow['end_date'] = date("Y-m-d", strtotime("+ 1 day"));
                $newRow['status'] = 'sleeping';
                $newRow['tired_recovery'] = '';
                $newRow['hungry_cost'] = '';
                $newRow->save();
                $userProfile = UsersProfiles::where("user_id","=",$newRow->user_id)->first();
                $userProfile->sleeping = "1";
                $userProfile->save();
                return response()->json($newRow, 200);
            }else{
                $sleepingUser['init_date'] = date("Y-m-d");
                $sleepingUser['end_date'] = date("Y-m-d", strtotime("+ 1 day"));
                $sleepingUser['status'] = 'sleeping';
                $sleepingUser['tired_recovery'] = '';
                $sleepingUser['hungry_cost'] = '';
                $sleepingUser->save();
                $userProfile = UsersProfiles::where("user_id","=",$sleepingUser->user_id)->first();
                $userProfile->sleeping = "1";
                $userProfile->save();
                return response()->json($sleepingUser, 200);
            }
            
            $data['Code'] = 200;
            $data['Error'] = false;
            $data['Message'] = 'User profile found';
            return response()->json($sleepingUser, 200);
        }else{
            return "invalid_token";
        }
        
    }
    //pending to detect if the user lost while sleeping.
    public function wakeUpUser(Request $request){
        $inputData = $request->input();
        $id = $inputData['id'];
        $session = $inputData['session'];

        $data['Result'] = null;
        $data['Code'] = 500;
        $data['Error'] = true;
        $data['Message'] = 'Ha ocurrido un error inesperado';

        $verifiedUser = Users::where("user_id","=",$id)->where("remember_token","=",$session)->first();
        if ($verifiedUser){
            $sleepingUser = SleepingUsers::where("user_id","=",$id)->first();
            if (!empty($sleepingUser)){
                $sleepingUser['status'] = 'completed';
                $init_date = new \DateTime($sleepingUser['init_date']);
                $end_date = new \DateTime();
                $res = $init_date->diff($end_date)->format("%i");
                $res = (int)$res/10;
                $sleepingUser['tired_recovery'] = $res;
                $sleepingUser['hungry_cost'] = (int)($res/3);
                $sleepingUser->save();
                $userProfile = UsersProfiles::where("user_id","=",$sleepingUser->user_id)->first();
                $userProfile->sleeping = "0";
                $userProfile->tired_points += $sleepingUser['tired_recovery'];
                $userProfile->hungry_points += $sleepingUser['hungry_cost'];
                (int)$userProfile->hp += $res;
                if ((int)$userProfile->hp > (int)$userProfile->max_hp){
                    (int)$userProfile->hp = (int)$userProfile->max_hp;
                }
                if ($userProfile->tired_points > 100)
                    $userProfile->tired_points = 100;
                if ($userProfile->hungry_points > 100)
                    $userProfile->hungry_points = 100;
                $userProfile->save();
            }
            if ($sleepingUser === null){
                $data['Result'] = null;
                $data['Code'] = 404;
                $data['Error'] = true;
                $data['Message'] = 'There is not sleeping user at this moment.';
                return null;
            }
            $data['Result'] = $sleepingUser;
            $data['Code'] = 200;
            $data['Error'] = false;
            $data['Message'] = 'Sleeping user found';
            return response()->json($sleepingUser, 200);
        }else{
            return "invalid_token";
        }
        
    }
    public function update(Request $request, $id)
    {
        $data['Result'] = null;
        $data['Code'] = 500;
        $data['Error'] = true;
        $data['Message'] = 'Unexpected Error';

        //Validation rules
        $rules = array(
            
        );
        $validator = Validator::make($request->all(), $rules);
        //Check for validation rules
        if ($validator->fails()) {
            $data['Result'] = null;
            $data['Code'] = 400;
            $data['Error'] = true;
            $data['Message'] = 'Please verify the information and fill the fields correctly';
            $data['ValidationErrors'] = $validator->messages()->toJson();
            return null;
        }
      
        $sleepingUser = SleepingUsers::find($id);
        if ($sleepingUser){
            $inputData = $request->input();
            $sleepingUser->fill($inputData);
            $sleepingUser->save();
            $data['Result'] = $sleepingUser;
            $data['Code'] = 200;
            $data['Error'] = false;
            $data['Message'] = 'sleeping user updated';
            return response()->json($sleepingUser, 200);
        }else{
            return null;
        }
    }
    public function store(Request $request)
    {
        $data['Result'] = null;
        $data['Code'] = 500;
        $data['Error'] = true;
        $data['Message'] = 'Unexpected Error';

        //Validation rules
        $rules = array(
            
        );
        $messages = array(

        );
        $validator = Validator::make($request->all(), $rules, $messages);
        //Check for validation rules
        if ($validator->fails()) {
            $data['Result'] = null;
            $data['Code'] = 400;
            $data['Error'] = true;
            $data['Message'] = 'Please verify the information and fill the fields correctly';
            $data['ValidationErrors'] = $validator->messages()->toJson();
            return null;
        }
        
        $sleepingUser = new SleepingUsers;
        $inputData = $request->input();
        $sleepingUser->fill($inputData);
        $sleepingUser->save();
        $data['Result']     = $sleepingUser;
        $data['Code']       = 200;
        $data['Error']      = false;
        $data['Message']    = null;
        return response()->json($sleepingUser, 200);
    }
    public function delete(Request $request, $id)
    {
        $data['Result'] = null;
        $data['Code'] = 500;
        $data['Error'] = true;
        $data['Message'] = 'Unexpected Error';

        $sleepingUser = SleepingUsers::find($id);
        if ($sleepingUser){
        	$sleepingUser['status'] = 'disabled';
            $sleepingUser->fill($inputData);
            $sleepingUser->save();
            $data['Result'] = $sleepingUser;
            $data['Code'] = 200;
            $data['Error'] = false;
            $data['Message'] = 'sleeping user deleted';
            return response()->json($sleepingUser, 200);
        }else{
            return null;
        }
    }
}
