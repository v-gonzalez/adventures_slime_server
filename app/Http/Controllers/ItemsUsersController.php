<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\ItemsUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class ItemsUsersController extends Controller
{
    public function getById($id){
        $data['Result'] = null;
        $data['Code'] = 500;
        $data['Error'] = true;
        $data['Message'] = 'Ha ocurrido un error inesperado';

        $itemUser = ItemsUsers::find($id);
        if ($itemUser === null){
            $data['Result'] = null;
            $data['Code'] = 404;
            $data['Error'] = true;
            $data['Message'] = 'There is not users profiles at this moment.';
            return null;
        }
        $data['Result'] = $itemUser;
        $data['Code'] = 200;
        $data['Error'] = false;
        $data['Message'] = 'User profile found';
        return response()->json($itemUser, 200);
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
      
        $itemUser = ItemsUsers::find($id);
        if ($itemUser){
            $inputData = $request->input();
            $itemUser->fill($inputData);
            $itemUser->save();
            $data['Result'] = $itemUser;
            $data['Code'] = 200;
            $data['Error'] = false;
            $data['Message'] = 'sleeping user updated';
            return response()->json($itemUser, 200);
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
        
        $itemUser = new ItemsUsers;
        $inputData = $request->input();
        $itemUser->fill($inputData);
        $itemUser->save();
        $data['Result']     = $itemUser;
        $data['Code']       = 200;
        $data['Error']      = false;
        $data['Message']    = null;
        return response()->json($itemUser, 200);
    }
    public function setbroken(Request $request, $id)
    {
        $data['Result'] = null;
        $data['Code'] = 500;
        $data['Error'] = true;
        $data['Message'] = 'Unexpected Error';

        $itemUser = ItemsUsers::find($id);
        if ($itemUser){
        	$itemUser['status'] = 'broken';
            $itemUser->fill($inputData);
            $itemUser->save();
            $data['Result'] = $itemUser;
            $data['Code'] = 200;
            $data['Error'] = false;
            $data['Message'] = 'sleeping user deleted';
            return response()->json($itemUser, 200);
        }else{
            return null;
        }
    }
}
