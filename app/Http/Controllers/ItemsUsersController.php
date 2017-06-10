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
            $data['Message'] = 'There is not user item at this moment.';
            return null;
        }
        $data['Result'] = $itemUser;
        $data['Code'] = 200;
        $data['Error'] = false;
        $data['Message'] = 'User profile found';
        return response()->json($itemUser, 200);
    }
    public function getByUserId($id){
        $data['Result'] = null;
        $data['Code'] = 500;
        $data['Error'] = true;
        $data['Message'] = 'Ha ocurrido un error inesperado';

        $userItems = ItemsUsers::where("user_id","=",$id)->get();
        if ($userItems === null){
            $data['Result'] = null;
            $data['Code'] = 404;
            $data['Error'] = true;
            $data['Message'] = 'There are not user items at this moment.';
            return null;
        }
        $data['Result'] = $userItems;
        $data['Code'] = 200;
        $data['Error'] = false;
        $data['Message'] = 'user items found';
        return response()->json($userItems, 200);
    }
    public function getByUserIds($ids){
        $data['Result'] = null;
        $data['Code'] = 500;
        $data['Error'] = true;
        $data['Message'] = 'Ha ocurrido un error inesperado';

        $json_ids = json_decode($ids);

        $items = [];
        foreach ($json_ids as $id) {
            $items[] = ItemsUsers::where("user_id","=",$id)->get();
        }
        
        if ($items === null){
            $data['Result'] = null;
            $data['Code'] = 404;
            $data['Error'] = true;
            $data['Message'] = 'There are not items at this moment.';
            return null;
        }
        $data['Result'] = $items;
        $data['Code'] = 200;
        $data['Error'] = false;
        $data['Message'] = 'items found';
        return response()->json($items, 200);
    }
    public function setBroken(Request $request, $id)
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
            $itemUser['status'] = 'broken';
            $itemUser->save();
            $data['Result'] = $itemUser;
            $data['Code'] = 200;
            $data['Error'] = false;
            $data['Message'] = 'user item updated';
            return response()->json($itemUser, 200);
        }else{
            return null;
        }
    }
    public function destroy(Request $request, $id)
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
            $itemUser->delete();
            $data['Result'] = $itemUser;
            $data['Code'] = 200;
            $data['Error'] = false;
            $data['Message'] = 'user item deleted';
            return response()->json($itemUser, 200);
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
      
        $itemUser = ItemsUsers::find($id);
        if ($itemUser){
            $inputData = $request->input();
            $itemUser->fill($inputData);
            $itemUser->save();
            $data['Result'] = $itemUser;
            $data['Code'] = 200;
            $data['Error'] = false;
            $data['Message'] = 'user item updated';
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
}
