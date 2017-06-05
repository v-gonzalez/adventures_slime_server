<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\SleepingUsers;
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
            $data['Message'] = 'There is not users profiles at this moment.';
            return null;
        }
        $data['Result'] = $sleepingUser;
        $data['Code'] = 200;
        $data['Error'] = false;
        $data['Message'] = 'User profile found';
        return response()->json($sleepingUser, 200);
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
