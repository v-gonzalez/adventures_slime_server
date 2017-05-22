<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Users;
class UsersController extends Controller
{

    public function show($id){

    }
    public function destroy($id)
    {
        //
    }
    public function getById($id){
        $data['Result'] = null;
        $data['Code'] = 500;
        $data['Error'] = true;
        $data['Message'] = 'Ha ocurrido un error inesperado';

        $user = Users::find($id);
        if ($user === null){
            $data['Result'] = null;
            $data['Code'] = 404;
            $data['Error'] = true;
            $data['Message'] = 'There is not users at this moment.';
            return null;
        }
        $data['Result'] = $user;
        $data['Code'] = 200;
        $data['Error'] = false;
        $data['Message'] = 'User found';
        return response()->json($user, 200);
    }

    public function getAll(Request $request){
        $data['Result'] = null;
        $data['Code'] = 500;
        $data['Error'] = true;
        $data['Message'] = 'Unexpected error';
        $users = Users::all();
        if ($users === null || $users->isEmpty()){
            $data['Result'] = null;
            $data['Code'] = 404;
            $data['Error'] = true;
            $data['Message'] = 'There is not users at this moment.';
            return null;
        }
        $data['Result'] = $users;
        $data['Code'] = 200;
        $data['Error'] = false;
        $data['Message'] = 'Users found';
        return response()->json($users, 200);
    }
    public function update(Request $request, $id)
    {
        $data['Result'] = null;
        $data['Code'] = 500;
        $data['Error'] = true;
        $data['Message'] = 'Unexpected Error';

        //Validation rules
        $rules = array(
            'nickname'      => 'sometimes|string',
            'device_id'     => 'sometimes|string',
            'phone'         => 'sometimes|string',
            'email'         => 'sometimes|email',
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
        $duplicatedNickname = $request->input('nickname');
        if(!empty($duplicatedNickname)){
            $userDuplicated = Users::where('nickname', $request->input('nickname'))->where('user_id','<>',$id)->get()->first();
            if(!empty($userDuplicated)){
                $data['Result'] = null;
                $data['Code'] = 500;
                $data['Error'] = true;
                $data['Message'] = 'Nickname already taken';
                return null;
            }
        }
        $user = Users::find($id);
        if ($user){
            $inputData = $request->input();
            $user->fill($inputData);
            $user->save();
            $data['Result'] = $user;
            $data['Code'] = 200;
            $data['Error'] = false;
            $data['Message'] = 'User updated';
            return response()->json($user, 200);
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
            'nickname'          => 'required|unique:users',
            'device_id'         => 'required|string',
            'phone'             => 'required|string',
            'email'             => 'required|email'
        );
        $messages = array(
            'nickname.required'     => 'Nickname required',
            'nickname.unique'       => 'Nickname already taken',
            'device_id.required'    => 'DeviceId required',
            'phone.required'        => 'Phone number required'
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
        
        $user = new Users;
        $inputData = $request->input();
        $user->fill($inputData);
        $user->save();
        $data['Result']     = $user;
        $data['Code']       = 200;
        $data['Error']      = false;
        $data['Message']    = null;
        return response()->json($user, 200);
    }
}
