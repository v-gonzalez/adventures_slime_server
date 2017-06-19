<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Users;
use App\UsersProfiles;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class UsersController extends Controller
{
    public function login(Request $request){
        $inputData = $request->all();
        $token = uniqid();
        if ( Auth::attempt([
                'nickname' => $inputData["nickname"], 
                'password' => $inputData['password']]) ){

            $user = Auth::user();
            $user->remember_token = $token;
            $user->save();
            $userProfile = UsersProfiles::where("user_id","=",$user->user_id)->first();
            $row['nickname']        =   $user->nickname;
            $row['user_id']         =   $user->user_id;
            $row['remember_token']  =   $user->remember_token;
            $row['sleeping']        =   $userProfile->sleeping;
            $row['status']          =   $userProfile->status;
            $row['shape']           =   $userProfile->shape;
            $row['color']           =   $userProfile->color;
            $row['eye']             =   $userProfile->eye;
            return response()->json($row, 200);
        }else{
            return "wrong";
        }
    }
    public function logout($session, $id){
        $user = Users::where("user_id","=",$id)->where("remember_token","=",$session)->first();
        if ($user){
            $user->remember_token = "";
            $user->save();
            Auth::logout();
            return "ok";
        }else  
            return "invalid_session";
        
        
    }
    public function show($id){
    }
    public function destroy($id){
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
    public function getByUserIds($ids){
        $data['Result'] = null;
        $data['Code'] = 500;
        $data['Error'] = true;
        $data['Message'] = 'Ha ocurrido un error inesperado';

        $json_ids = json_decode($ids);

        $users = [];
        foreach ($json_ids as $id) {
            $users[] = Users::where("user_id","=",$id)->first();
        }
        
        if ($users === null){
            $data['Result'] = null;
            $data['Code'] = 404;
            $data['Error'] = true;
            $data['Message'] = 'There are not users at this moment.';
            return null;
        }
        $data['Result'] = $users;
        $data['Code'] = 200;
        $data['Error'] = false;
        $data['Message'] = 'Users found';
        return response()->json($users, 200);
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
            'password'      => 'sometimes|string',
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
            $inputData['password'] =  Hash::make($inputData['password']);
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
            'password'          => 'required|string',
            'device_id'         => 'required|string',
            'phone'             => 'required|string',
            'email'             => 'required|email'
        );
        $messages = array(
            'nickname.required'     => 'Nickname required',
            'nickname.unique'       => 'Nickname already taken',
            'password.required'     => 'Password required',
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
        $inputData['password'] =  Hash::make($inputData['password']);
        $user->fill($inputData);
        $user->save();

        $userProfile = new UsersProfiles;
        $userProfile->user_id = $user->user_id;
        $userProfile->level = 1;
        $userProfile->experience = 0;
        $userProfile->hp = 100;
        $userProfile->mana = 200;
        $userProfile->agi = 10;
        $userProfile->str = 10;
        $userProfile->int = 10;
        $userProfile->phys_dmg = 15;
        $userProfile->magic_dmg = 20;
        $userProfile->armor = 1;
        $userProfile->status = "active";
        $userProfile->sleeping = "0";
        $userProfile->last_action_date = date("Y-m-d");
        $userProfile->hungry_points = 0;
        $userProfile->tired_points = 0;
        $userProfile->cash_points = 100;
        $userProfile->longitude = 0;
        $userProfile->latitude = 0;
        $userProfile->shape = "";
        $userProfile->color = "";
        $userProfile->eye   = "";
        $userProfile->save();
        $data['Result']     = $user;
        $data['Code']       = 200;
        $data['Error']      = false;
        $data['Message']    = null;
        return response()->json($user, 200);
    }
}
