<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\FoodUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class FoodUsersController extends Controller
{
    public function getById($id){
        $data['Result'] = null;
        $data['Code'] = 500;
        $data['Error'] = true;
        $data['Message'] = 'Unexpected error';

        $foodUsers = FoodUsers::find($id);
        if ($foodUsers === null){
            $data['Result'] = null;
            $data['Code'] = 404;
            $data['Error'] = true;
            $data['Message'] = 'There is not food at this moment.';
            return null;
        }
        $data['Result'] = $foodUsers;
        $data['Code'] = 200;
        $data['Error'] = false;
        $data['Message'] = 'food users found';
        return response()->json($foodUsers, 200);
    }
    public function getByUserId($id){
        $data['Result'] = null;
        $data['Code'] = 500;
        $data['Error'] = true;
        $data['Message'] = 'Unexpected error';

        $food = FoodUsers::where("user_id","=",$id)->get();
        if ($food === null){
            $data['Result'] = null;
            $data['Code'] = 404;
            $data['Error'] = true;
            $data['Message'] = 'There is not food at this moment.';
            return null;
        }
        $data['Result'] = $food;
        $data['Code'] = 200;
        $data['Error'] = false;
        $data['Message'] = 'food found';
        return response()->json($food, 200);
    }
    public function setExpired($id)
    {
        $data['Result'] = null;
        $data['Code'] = 500;
        $data['Error'] = true;
        $data['Message'] = 'Unexpected Error';

        $foodUsers = FoodUsers::find($id);
        if ($foodUsers){
            $foodUsers['status'] = 'expired';
            $foodUsers->save();
            $data['Result'] = $foodUsers;
            $data['Code'] = 200;
            $data['Error'] = false;
            $data['Message'] = 'food user updated';
            return response()->json($foodUsers, 200);
        }else{
            return null;
        }
    }
    public function setBad($id)
    {
        $data['Result'] = null;
        $data['Code'] = 500;
        $data['Error'] = true;
        $data['Message'] = 'Unexpected Error';

        $foodUsers = FoodUsers::find($id);
        if ($foodUsers){
            $foodUsers['status'] = 'bad';
            $foodUsers->save();
            $data['Result'] = $foodUsers;
            $data['Code'] = 200;
            $data['Error'] = false;
            $data['Message'] = 'food user updated';
            return response()->json($foodUsers, 200);
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
      
        $foodUsers = FoodUsers::find($id);
        if ($foodUsers){
            $inputData = $request->input();
            $foodUsers->fill($inputData);
            $foodUsers->save();
            $data['Result'] = $foodUsers;
            $data['Code'] = 200;
            $data['Error'] = false;
            $data['Message'] = 'food user updated';
            return response()->json($foodUsers, 200);
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
        
        $foodUsers = new FoodUsers;
        $inputData = $request->input();
        $foodUsers->fill($inputData);
        $foodUsers->save();
        $data['Result']     = $foodUsers;
        $data['Code']       = 200;
        $data['Error']      = false;
        $data['Message']    = null;
        return response()->json($foodUsers, 200);
    }
    public function delete(Request $request, $id)
    {
        $data['Result'] = null;
        $data['Code'] = 500;
        $data['Error'] = true;
        $data['Message'] = 'Unexpected Error';

        $foodUsers = FoodUsers::find($id);
        if ($foodUsers){
            $foodUsers->delete();
            $data['Result'] = $foodUsers;
            $data['Code'] = 200;
            $data['Error'] = false;
            $data['Message'] = 'food user deleted';
            return response()->json($foodUsers, 200);
        }else{
            return null;
        }
    }
}
