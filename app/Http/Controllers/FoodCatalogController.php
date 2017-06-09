<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\FoodCatalog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;

class FoodCatalogController extends Controller
{
    public function getById($id){
        $data['Result'] = null;
        $data['Code'] = 500;
        $data['Error'] = true;
        $data['Message'] = 'Ha ocurrido un error inesperado';

        $foodCatalog = FoodCatalog::find($id);
        if ($foodCatalog === null){
            $data['Result'] = null;
            $data['Code'] = 404;
            $data['Error'] = true;
            $data['Message'] = 'There are not foodCatalogs at this moment.';
            return null;
        }
        $data['Result'] = $foodCatalog;
        $data['Code'] = 200;
        $data['Error'] = false;
        $data['Message'] = 'foodCatalogs found';
        return response()->json($foodCatalog, 200);
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
      
        $foodCatalog = FoodCatalog::find($id);
        if ($foodCatalog){
            $inputData = $request->input();
            $foodCatalog->fill($inputData);
            $foodCatalog->save();
            $data['Result'] = $foodCatalog;
            $data['Code'] = 200;
            $data['Error'] = false;
            $data['Message'] = 'foodcatalog updated';
            return response()->json($foodCatalog, 200);
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
        
        $foodCatalog = new FoodCatalog;
        $inputData = $request->input();
        $foodCatalog->fill($inputData);
        $foodCatalog->save();
        $data['Result']     = $foodCatalog;
        $data['Code']       = 200;
        $data['Error']      = false;
        $data['Message']    = null;
        return response()->json($foodCatalog, 200);
    }
    public function delete(Request $request, $id)
    {
        $data['Result'] = null;
        $data['Code'] = 500;
        $data['Error'] = true;
        $data['Message'] = 'Unexpected Error';

        $foodCatalog = FoodCatalog::find($id);
        if ($foodCatalog){
        	$foodCatalog['status'] = 'disabled';
            $foodCatalog->fill($inputData);
            $foodCatalog->save();
            $data['Result'] = $foodCatalog;
            $data['Code'] = 200;
            $data['Error'] = false;
            $data['Message'] = 'foodcatalog deleted';
            return response()->json($foodCatalog, 200);
        }else{
            return null;
        }
    }
}
