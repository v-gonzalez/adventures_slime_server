<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\ItemsDungeonsDrops;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class ItemsDungeonsDropsController extends Controller
{
    public function getById($id){
        $data['Result'] = null;
        $data['Code'] = 500;
        $data['Error'] = true;
        $data['Message'] = 'Ha ocurrido un error inesperado';

        $itemsDungeonsDrop = ItemsDungeonsDrops::find($id);
        if ($itemsDungeonsDrop === null){
            $data['Result'] = null;
            $data['Code'] = 404;
            $data['Error'] = true;
            $data['Message'] = 'There is not users profiles at this moment.';
            return null;
        }
        $data['Result'] = $itemsDungeonsDrop;
        $data['Code'] = 200;
        $data['Error'] = false;
        $data['Message'] = 'Items dungeons drop found';
        return response()->json($itemsDungeonsDrop, 200);
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
      
        $itemsDungeonsDrop = ItemsDungeonsDrops::find($id);
        if ($itemsDungeonsDrop){
            $inputData = $request->input();
            $itemsDungeonsDrop->fill($inputData);
            $itemsDungeonsDrop->save();
            $data['Result'] = $itemsDungeonsDrop;
            $data['Code'] = 200;
            $data['Error'] = false;
            $data['Message'] = 'item dungeon drop updated';
            return response()->json($itemsDungeonsDrop, 200);
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
        
        $itemsDungeonsDrop = new ItemsDungeonsDrops;
        $inputData = $request->input();
        $itemsDungeonsDrop->fill($inputData);
        $itemsDungeonsDrop->save();
        $data['Result']     = $itemsDungeonsDrop;
        $data['Code']       = 200;
        $data['Error']      = false;
        $data['Message']    = null;
        return response()->json($itemsDungeonsDrop, 200);
    }
    public function delete(Request $request, $id)
    {
        $data['Result'] = null;
        $data['Code'] = 500;
        $data['Error'] = true;
        $data['Message'] = 'Unexpected Error';

        $itemsDungeonsDrop = ItemsDungeonsDrops::find($id);
        if ($itemsDungeonsDrop){
        	$itemsDungeonsDrop['status'] = 'disabled';
            $itemsDungeonsDrop->fill($inputData);
            $itemsDungeonsDrop->save();
            $data['Result'] = $itemsDungeonsDrop;
            $data['Code'] = 200;
            $data['Error'] = false;
            $data['Message'] = 'item dungeon drop deleted';
            return response()->json($itemsDungeonsDrop, 200);
        }else{
            return null;
        }
    }
}
