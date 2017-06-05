<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\UsersProfiles;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersProfilesController extends Controller
{
    public function getById($id){
        $data['Result'] = null;
        $data['Code'] = 500;
        $data['Error'] = true;
        $data['Message'] = 'Ha ocurrido un error inesperado';

        $userProfile = UsersProfiles::find($id);
        if ($userProfile === null){
            $data['Result'] = null;
            $data['Code'] = 404;
            $data['Error'] = true;
            $data['Message'] = 'There is not users profiles at this moment.';
            return null;
        }
        $data['Result'] = $userProfile;
        $data['Code'] = 200;
        $data['Error'] = false;
        $data['Message'] = 'User profile found';
        return response()->json($userProfile, 200);
    }

    public function update(Request $request, $id)
    {
        $data['Result'] = null;
        $data['Code'] = 500;
        $data['Error'] = true;
        $data['Message'] = 'Unexpected Error';

        //Validation rules
        $rules = array(
            'level' 			=> 'sometimes',
			'experience' 		=> 'sometimes',
			'hp' 				=> 'sometimes',
			'mana' 				=> 'sometimes',
			'agi' 				=> 'sometimes',
			'str' 				=> 'sometimes',
			'int' 				=> 'sometimes',
			'phys_dmg' 			=> 'sometimes',
			'magic_dmg' 		=> 'sometimes',
			'armor' 			=> 'sometimes',
			'status' 			=> 'sometimes',
			'last_action_date' 	=> 'sometimes',
			'hungry_points' 	=> 'sometimes',
			'tired_points' 		=> 'sometimes',
			'cash_points' 		=> 'sometimes',
			'longitued' 		=> 'sometimes',
			'latitude' 			=> 'sometimes',
			'shape' 			=> 'sometimes',
			'color' 			=> 'sometimes',
			'eye' 				=> 'sometimes'
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
      
        $userProfile = UsersProfiles::find($id);
        if ($userProfile){
            $inputData = $request->input();
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