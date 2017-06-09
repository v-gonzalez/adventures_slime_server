<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\DungeonsUsers;
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
        
        $dungeonsUsers = new DungeonsUsers;
        $inputData = $request->input();
        $dungeonsUsers->fill($inputData);
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
        	$dungeonsUsers['status'] = 'disabled';
            $dungeonsUsers->fill($inputData);
            $dungeonsUsers->save();
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
