<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\UsersProfiles;
use App\Users;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersProfilesController extends Controller
{
    public function getByUserId(Request $request, $id){
        $data['Result'] = null;
        $data['Code'] = 500;
        $data['Error'] = true;
        $data['Message'] = 'Ha ocurrido un error inesperado';
        $inputData = $request->input();
        $session = $inputData['session'];
        $user = Users::where("user_id","=",$id)->where("remember_token","=",$session)->first();
        if (!$user)
            return "invalid_session";

        $userProfile = UsersProfiles::where("user_id","=",$id)->first();
        if ($userProfile === null){
            $data['Result'] = null;
            $data['Code'] = 404;
            $data['Error'] = true;
            $data['Message'] = 'There are not users profiles at this moment.';
            return null;
        }
        $data['Result'] = $userProfile;
        $data['Code'] = 200;
        $data['Error'] = false;
        $data['Message'] = 'User profile found';
        return response()->json($userProfile, 200);
    }
    public function getByUserIds($ids){
        $data['Result'] = null;
        $data['Code'] = 500;
        $data['Error'] = true;
        $data['Message'] = 'Ha ocurrido un error inesperado';

        $json_ids = json_decode($ids);

        $userProfiles = [];
        foreach ($json_ids as $id) {
            $userProfiles[] = UsersProfiles::where("user_id","=",$id)->first();
        }
        
        if ($userProfiles === null){
            $data['Result'] = null;
            $data['Code'] = 404;
            $data['Error'] = true;
            $data['Message'] = 'There are not users profiles at this moment.';
            return null;
        }
        $data['Result'] = $userProfiles;
        $data['Code'] = 200;
        $data['Error'] = false;
        $data['Message'] = 'User profiles found';
        return response()->json($userProfiles, 200);
    }
    public function create_character(Request $request, $id)
    {
        $data['Result'] = null;
        $data['Code'] = 500;
        $data['Error'] = true;
        $data['Message'] = 'Unexpected Error';
        $inputData = $request->input();
        
        $user = Users::where("user_id","=",$id)->where("remember_token","=",$inputData['session'])->first();
        if (!$user)
            return "invalid_session";

        $userProfile = UsersProfiles::where("user_id","=",$id)->first();
        if ($userProfile){
            $userProfile->shape = $inputData['shape'];
            $userProfile->eye   = $inputData['eye'];
            $userProfile->color = $inputData['color'];
            $userProfile->save();
            $data['Result'] = $userProfile; 
            $data['Code'] = 200;
            $data['Error'] = false;
            $data['Message'] = 'user profile updated';
            return response()->json($userProfile, 200);
        }else{
            return null;
        }
    }

    public function update(Request $request)
    {
        $data['Result'] = null;
        $data['Code'] = 500;
        $data['Error'] = true;
        $data['Message'] = 'Unexpected Error';

        $inputData = $request->input();
        $user = Users::where("user_id","=",$inputData['user_id'])->where("remember_token","=",$inputData['session'])->first();
        if (!$user)
            return "invalid_session";

        $userProfile = UsersProfiles::where("user_id","=",$inputData['user_id'])->first();
        if ($userProfile){
            $userProfile->fill($inputData);
            $userProfile->save();
            $data['Result'] = $userProfile;
            $data['Code'] = 200;
            $data['Error'] = false;
            $data['Message'] = 'user profile updated';
            return response()->json($userProfile, 200);
        }else{
            return null;
        }
    }
    public function updateStats(Request $request)
    {
        $data['Result'] = null;
        $data['Code'] = 500;
        $data['Error'] = true;
        $data['Message'] = 'Unexpected Error';

        $inputData = $request->input();
        $user = Users::where("user_id","=",$inputData['user_id'])->where("remember_token","=",$inputData['session'])->first();
        if (!$user)
            return "invalid_session";

        $userProfile = UsersProfiles::where("user_id","=",$inputData['user_id'])->first();
        if ($userProfile){
            $userProfile->str               = $inputData['str'];
            $userProfile->agi               = $inputData['agi'];
            $userProfile->inte              = $inputData['inte'];
            $userProfile->max_hp            = $inputData['max_hp'];
            $userProfile->spending_points   = $inputData['spending_points'];

            $userProfile->save();
            $data['Result'] = $userProfile;
            $data['Code'] = 200;
            $data['Error'] = false;
            $data['Message'] = 'user profile updated';
            return response()->json($userProfile, 200);
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
            'level' 			=> 'required',
			'experience' 		=> 'required',
			'hp' 				=> 'required',
			'mana' 				=> 'required',
			'agi' 				=> 'required',
			'str' 				=> 'required',
			'int' 				=> 'required',
			'phys_dmg' 			=> 'required',
			'magic_dmg' 		=> 'required',
			'armor' 			=> 'required',
			'status' 			=> 'required',
			'last_action_date' 	=> 'required',
			'hungry_points' 	=> 'required',
			'tired_points' 		=> 'required',
			'cash_points' 		=> 'required',
			'longitued' 		=> 'required',
			'latitude' 			=> 'required',
			'shape' 			=> 'required',
			'color' 			=> 'required',
			'eye' 				=> 'required'
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
        
        $userProfile = new UsersProfiles;
        $inputData = $request->input();
        $userProfile->fill($inputData);
        $userProfile->save();
        $data['Result']     = $userProfile;
        $data['Code']       = 200;
        $data['Error']      = false;
        $data['Message']    = null;
        return response()->json($userProfile, 200);
    }
    public function delete(Request $request, $id)
    {
        $data['Result'] = null;
        $data['Code'] = 500;
        $data['Error'] = true;
        $data['Message'] = 'Unexpected Error';

        $userProfile = UsersProfiles::find($id);
        if ($userProfile){
        	$userProfile['status'] = 'disabled';
            $userProfile->fill($inputData);
            $userProfile->save();
            $data['Result'] = $userProfile;
            $data['Code'] = 200;
            $data['Error'] = false;
            $data['Message'] = 'user profile deleted';
            return response()->json($userProfile, 200);
        }else{
            return null;
        }
    }
}