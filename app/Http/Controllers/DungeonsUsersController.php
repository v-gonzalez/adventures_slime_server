<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\DungeonsUsers;
use App\Users;
use App\UsersProfiles;
use App\Dungeons;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DungeonsUsersController extends Controller
{
    public function getById($id){
        $data['Result'] = null;
        $data['Code'] = 500;
        $data['Error'] = true;
        $data['Message'] = 'Ha ocurrido un error inesperado';

        $dungeonsUsers = DungeonsUsers::find($id);
        if ($dungeonsUsers === null){
            $data['Result'] = null;
            $data['Code'] = 404;
            $data['Error'] = true;
            $data['Message'] = 'There are not DungeonsUsers at this moment.';
            return null;
        }
        $data['Result'] = $dungeonsUsers;
        $data['Code'] = 200;
        $data['Error'] = false;
        $data['Message'] = 'DungeonsUsers found';
        return response()->json($dungeonsUsers, 200);
    }
    public function getAllDungeonsByUserId($id){
        $data['Result'] = null;
        $data['Code'] = 500;
        $data['Error'] = true;
        $data['Message'] = 'Unexpected error';

        $dungeonsUsers = DungeonsUsers::where("user_id","=",$id)->orderBy("init_date",'desc')->get();
        if ($dungeonsUsers === null){
            $data['Result'] = null;
            $data['Code'] = 404;
            $data['Error'] = true;
            $data['Message'] = 'There is not dungeonsUsers at this moment.';
            return null;
        }
        $data['Result'] = $dungeonsUsers;
        $data['Code'] = 200;
        $data['Error'] = false;
        $data['Message'] = 'dungeonsUsers found';
        return response()->json($dungeonsUsers, 200);
    }
    public function getActiveDungeonByUserId($id){
        $data['Result'] = null;
        $data['Code'] = 500;
        $data['Error'] = true;
        $data['Message'] = 'Unexpected error';

        $dungeonsUsers = DungeonsUsers::where("user_id","=",$id)->where("status",'=','active')->first();
        if ($dungeonsUsers === null){
            $data['Result'] = null;
            $data['Code'] = 404;
            $data['Error'] = true;
            $data['Message'] = 'There is not dungeonsUsers at this moment.';
            return null;
        }
        $data['Result'] = $dungeonsUsers;
        $data['Code'] = 200;
        $data['Error'] = false;
        $data['Message'] = 'dungeonsUsers found';
        return response()->json($dungeonsUsers, 200);
    }
    public function getLostDungeonsByUserId($id){
        $data['Result'] = null;
        $data['Code'] = 500;
        $data['Error'] = true;
        $data['Message'] = 'Unexpected error';

        $dungeonsUsers = DungeonsUsers::where("user_id","=",$id)->where("status",'=','lost')->get();
        if ($dungeonsUsers === null){
            $data['Result'] = null;
            $data['Code'] = 404;
            $data['Error'] = true;
            $data['Message'] = 'There is not dungeonsUsers at this moment.';
            return null;
        }
        $data['Result'] = $dungeonsUsers;
        $data['Code'] = 200;
        $data['Error'] = false;
        $data['Message'] = 'dungeonsUsers found';
        return response()->json($dungeonsUsers, 200);
    }
    public function getCompleteDungeonsByUserId($id){
        $data['Result'] = null;
        $data['Code'] = 500;
        $data['Error'] = true;
        $data['Message'] = 'Unexpected error';

        $dungeonsUsers = DungeonsUsers::where("user_id","=",$id)->where("status",'=','completed')->get();
        if ($dungeonsUsers === null){
            $data['Result'] = null;
            $data['Code'] = 404;
            $data['Error'] = true;
            $data['Message'] = 'There is not dungeonsUsers at this moment.';
            return null;
        }
        $data['Result'] = $dungeonsUsers;
        $data['Code'] = 200;
        $data['Error'] = false;
        $data['Message'] = 'dungeonsUsers found';
        return response()->json($dungeonsUsers, 200);
    }
    public function setCompleted(Request $request, $id)
    {
        $data['Result'] = null;
        $data['Code'] = 500;
        $data['Error'] = true;
        $data['Message'] = 'Unexpected Error';

        $dungeonsUsers = DungeonsUsers::find($id);
        if ($dungeonsUsers){
            $dungeonsUsers['status'] = 'completed';
            $dungeonsUsers->save();
            $data['Result'] = $dungeonsUsers;
            $data['Code'] = 200;
            $data['Error'] = false;
            $data['Message'] = 'DungeonsUsers updated';
            return response()->json($dungeonsUsers, 200);
        }else{
            return null;
        }
    }
    public function setLost(Request $request, $id)
    {
        $data['Result'] = null;
        $data['Code'] = 500;
        $data['Error'] = true;
        $data['Message'] = 'Unexpected Error';

        $dungeonsUsers = DungeonsUsers::find($id);
        if ($dungeonsUsers){
            $dungeonsUsers['status'] = 'lost';
            $dungeonsUsers->save();
            $data['Result'] = $dungeonsUsers;
            $data['Code'] = 200;
            $data['Error'] = false;
            $data['Message'] = 'DungeonsUsers updated';
            return response()->json($dungeonsUsers, 200);
        }else{
            return null;
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
      
        $dungeonsUsers = DungeonsUsers::find($id);
        if ($dungeonsUsers){
            $inputData = $request->input();
            $dungeonsUsers->fill($inputData);
            $dungeonsUsers->save();
            $data['Result'] = $dungeonsUsers;
            $data['Code'] = 200;
            $data['Error'] = false;
            $data['Message'] = 'DungeonsUsers updated';
            return response()->json($dungeonsUsers, 200);
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
        $inputData = $request->input();
        $user = Users::where("user_id","=",$inputData['user_id'])->where("remember_token","=",$inputData['session'])->first();
        /* Validations */
        if (!$user)
            return "invalid_session";
        $dungeonRow = Dungeons::where("dungeon_id","=",$inputData['dungeon_id'])->first();
        if (!$dungeonRow)
            return "invalid_dungeon";
        $userProfile = UsersProfiles::where("user_id","=",$inputData["user_id"])->first();
        if (!$userProfile)
            return "invalid_user_profile";
        if ($userProfile && $userProfile['status'] == 'dungeon')
            return "already_in_dungeon";
        if ($userProfile['level'] < $dungeonRow['level_required'])
            return "insufficient_level";


        /* * * * * * * */

        
        $dungeonsUsers = new DungeonsUsers;
        $dungeonsUsers->fill($inputData);
        $dungeonsUsers->init_date = date("Y-m-d h:i:s");
        $dungeonsUsers->end_date = date("Y-m-d h:i:s", strtotime("+".$dungeonRow['durability']." minutes"));
        $dungeonsUsers->status = 'active';

        $userProfile['status'] = 'dungeon';
        $userProfile->save();
        $dungeonsUsers->save();
        $data['Result']     = $dungeonsUsers;
        $data['Code']       = 200;
        $data['Error']      = false;
        $data['Message']    = null;
        return response()->json($dungeonsUsers, 200);
    }
    public function delete(Request $request, $id)
    {
        $data['Result'] = null;
        $data['Code'] = 500;
        $data['Error'] = true;
        $data['Message'] = 'Unexpected Error';

        $dungeonsUsers = DungeonsUsers::find($id);
        if ($dungeonsUsers){
            $dungeonsUsers->delete();
            $data['Result'] = $dungeonsUsers;
            $data['Code'] = 200;
            $data['Error'] = false;
            $data['Message'] = 'DungeonsUsers deleted';
            return response()->json($dungeonsUsers, 200);
        }else{
            return null;
        }
    }
}
