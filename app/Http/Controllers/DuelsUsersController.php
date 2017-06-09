<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\DuelsUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DuelsUsersController extends Controller
{
    public function getById($id){
        $data['Result'] = null;
        $data['Code'] = 500;
        $data['Error'] = true;
        $data['Message'] = 'Ha ocurrido un error inesperado';

        $duelsUsers = DuelsUsers::find($id);
        if ($duelsUsers === null){
            $data['Result'] = null;
            $data['Code'] = 404;
            $data['Error'] = true;
            $data['Message'] = 'There are not duelsusers at this moment.';
            return null;
        }
        $data['Result'] = $duelsUsers;
        $data['Code'] = 200;
        $data['Error'] = false;
        $data['Message'] = 'duelsusers found';
        return response()->json($duelsUsers, 200);
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
      
        $duelsUsers = DuelsUsers::find($id);
        if ($duelsUsers){
            $inputData = $request->input();
            $duelsUsers->fill($inputData);
            $duelsUsers->save();
            $data['Result'] = $duelsUsers;
            $data['Code'] = 200;
            $data['Error'] = false;
            $data['Message'] = 'dueluser updated';
            return response()->json($duelsUsers, 200);
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
        
        $duelsUsers = new DuelsUsers;
        $inputData = $request->input();
        $duelsUsers->fill($inputData);
        $duelsUsers->save();
        $data['Result']     = $duelsUsers;
        $data['Code']       = 200;
        $data['Error']      = false;
        $data['Message']    = null;
        return response()->json($duelsUsers, 200);
    }
    public function delete(Request $request, $id)
    {
        $data['Result'] = null;
        $data['Code'] = 500;
        $data['Error'] = true;
        $data['Message'] = 'Unexpected Error';

        $duelsUsers = DuelsUsers::find($id);
        if ($duelsUsers){
        	$duelsUsers['status'] = 'disabled';
            $duelsUsers->fill($inputData);
            $duelsUsers->save();
            $data['Result'] = $duelsUsers;
            $data['Code'] = 200;
            $data['Error'] = false;
            $data['Message'] = 'dueluser deleted';
            return response()->json($duelsUsers, 200);
        }else{
            return null;
        }
    }
}
