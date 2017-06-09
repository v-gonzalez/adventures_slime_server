<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Items;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ItemsController extends Controller
{
    public function getById($id){
        $data['Result'] = null;
        $data['Code'] = 500;
        $data['Error'] = true;
        $data['Message'] = 'Ha ocurrido un error inesperado';

        $items = Items::find($id);
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
        $data['Message'] = 'Items found';
        return response()->json($items, 200);
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
      
        $items = Items::find($id);
        if ($items){
            $inputData = $request->input();
            $items->fill($inputData);
            $items->save();
            $data['Result'] = $items;
            $data['Code'] = 200;
            $data['Error'] = false;
            $data['Message'] = 'item updated';
            return response()->json($items, 200);
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
        
        $items = new Items;
        $inputData = $request->input();
        $items->fill($inputData);
        $items->save();
        $data['Result']     = $items;
        $data['Code']       = 200;
        $data['Error']      = false;
        $data['Message']    = null;
        return response()->json($items, 200);
    }
    public function delete(Request $request, $id)
    {
        $data['Result'] = null;
        $data['Code'] = 500;
        $data['Error'] = true;
        $data['Message'] = 'Unexpected Error';

        $items = Items::find($id);
        if ($items){
        	$items['status'] = 'disabled';
            $items->fill($inputData);
            $items->save();
            $data['Result'] = $items;
            $data['Code'] = 200;
            $data['Error'] = false;
            $data['Message'] = 'item dungeon drop deleted';
            return response()->json($items, 200);
        }else{
            return null;
        }
    }
}
