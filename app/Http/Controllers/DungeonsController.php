<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Dungeons;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DungeonsController extends Controller
{
    public function getById($id){
        $data['Result'] = null;
        $data['Code'] = 500;
        $data['Error'] = true;
        $data['Message'] = 'Ha ocurrido un error inesperado';

        $dungeons = Dungeons::find($id);
        if ($dungeons === null){
            $data['Result'] = null;
            $data['Code'] = 404;
            $data['Error'] = true;
            $data['Message'] = 'There are not dungeons at this moment.';
            return null;
        }
        $data['Result'] = $dungeons;
        $data['Code'] = 200;
        $data['Error'] = false;
        $data['Message'] = 'dungeons found';
        return response()->json($dungeons, 200);
    }
    public function getAll(){
        $data['Result'] = null;
        $data['Code'] = 500;
        $data['Error'] = true;
        $data['Message'] = 'Ha ocurrido un error inesperado';

        $dungeons = Dungeons::all()->orderBy('created_at','desc');
        if ($dungeons === null){
            $data['Result'] = null;
            $data['Code'] = 404;
            $data['Error'] = true;
            $data['Message'] = 'There are not dungeons at this moment.';
            return null;
        }
        $data['Result'] = $dungeons;
        $data['Code'] = 200;
        $data['Error'] = false;
        $data['Message'] = 'dungeons found';
        return response()->json($dungeons, 200);
    }
    public function getByName($name){
        $data['Result'] = null;
        $data['Code'] = 500;
        $data['Error'] = true;
        $data['Message'] = 'Ha ocurrido un error inesperado';

        $dungeons = Dungeons::where('name','LIKE', '%'.$name.'%')->orderBy('created_at','desc')->get();
        if ($dungeons === null){
            $data['Result'] = null;
            $data['Code'] = 404;
            $data['Error'] = true;
            $data['Message'] = 'There are not dungeons at this moment.';
            return null;
        }
        $data['Result'] = $dungeons;
        $data['Code'] = 200;
        $data['Error'] = false;
        $data['Message'] = 'dungeons found';
        return response()->json($dungeons, 200);
    }
    public function getByStatus($status){
        $data['Result'] = null;
        $data['Code'] = 500;
        $data['Error'] = true;
        $data['Message'] = 'Ha ocurrido un error inesperado';

        $dungeons = Dungeons::where('status','=', $status)->orderBy('created_at','desc')->get();
        if ($dungeons === null){
            $data['Result'] = null;
            $data['Code'] = 404;
            $data['Error'] = true;
            $data['Message'] = 'There are not dungeons at this moment.';
            return null;
        }
        $data['Result'] = $dungeons;
        $data['Code'] = 200;
        $data['Error'] = false;
        $data['Message'] = 'dungeons found';
        return response()->json($dungeons, 200);
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
      
        $dungeons = Dungeons::find($id);
        if ($dungeons){
            $inputData = $request->input();
            $dungeons->fill($inputData);
            $dungeons->save();
            $data['Result'] = $dungeons;
            $data['Code'] = 200;
            $data['Error'] = false;
            $data['Message'] = 'dungeon updated';
            return response()->json($dungeons, 200);
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
        
        $dungeons = new Dungeons;
        $inputData = $request->input();
        $dungeons->fill($inputData);
        $dungeons->save();
        $data['Result']     = $dungeons;
        $data['Code']       = 200;
        $data['Error']      = false;
        $data['Message']    = null;
        return response()->json($dungeons, 200);
    }
    public function delete(Request $request, $id)
    {
        $data['Result'] = null;
        $data['Code'] = 500;
        $data['Error'] = true;
        $data['Message'] = 'Unexpected Error';

        $dungeons = Dungeons::find($id);
        if ($dungeons){
            $dungeons->delete();
            $data['Result'] = $dungeons;
            $data['Code'] = 200;
            $data['Error'] = false;
            $data['Message'] = 'dungeon deleted';
            return response()->json($dungeons, 200);
        }else{
            return null;
        }
    }
}