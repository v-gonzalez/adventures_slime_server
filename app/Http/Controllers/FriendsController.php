<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Friends;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class FriendsController extends Controller
{
    public function getById($id){
        $data['Result'] = null;
        $data['Code'] = 500;
        $data['Error'] = true;
        $data['Message'] = 'Ha ocurrido un error inesperado';

        $friends = Friends::find($id);
        if ($friends === null){
            $data['Result'] = null;
            $data['Code'] = 404;
            $data['Error'] = true;
            $data['Message'] = 'There are not friends at this moment.';
            return null;
        }
        $data['Result'] = $friends;
        $data['Code'] = 200;
        $data['Error'] = false;
        $data['Message'] = 'Friends found';
        return response()->json($friends, 200);
    }
    public function getAllFriendsByUserId($id){
        $data['Result'] = null;
        $data['Code'] = 500;
        $data['Error'] = true;
        $data['Message'] = 'Ha ocurrido un error inesperado';
        
        $friends = Friends::where('friend_from', '=', $id)->orWhere('friend_to', '=', $id)->orderBy('status','desc')->get();

        if ($friends === null){
            $data['Result'] = null;
            $data['Code'] = 404;
            $data['Error'] = true;
            $data['Message'] = 'There are not friends at this moment.';
            return null;
        }
        $data['Result'] = $friends;
        $data['Code'] = 200;
        $data['Error'] = false;
        $data['Message'] = 'friends found';
        return response()->json($friends, 200);
    }
    public function getAcceptedFriendsByUserId($id){
        $data['Result'] = null;
        $data['Code'] = 500;
        $data['Error'] = true;
        $data['Message'] = 'Ha ocurrido un error inesperado';
        
        $friends = Friends::where( 'status', '=', 'accepted' )->where( function ( $query ) use ( $id ){
            $query->where('friend_from', '=', $id)->where('friend_to', '=', $id);
        })->get();

        if ($friends === null){
            $data['Result'] = null;
            $data['Code'] = 404;
            $data['Error'] = true;
            $data['Message'] = 'There are not friends at this moment.';
            return null;
        }
        $data['Result'] = $friends;
        $data['Code'] = 200;
        $data['Error'] = false;
        $data['Message'] = 'friends found';
        return response()->json($friends, 200);
    }
    public function getPendingFriendsByUserId($id){
        $data['Result'] = null;
        $data['Code'] = 500;
        $data['Error'] = true;
        $data['Message'] = 'Ha ocurrido un error inesperado';

        $friends = Friends::where( 'status', '=', 'pending' )->where( function ( $query ) use ( $id ){
            $query->where('friend_from', '=', $id)->where('friend_to', '=', $id);
        })->get();

        if ($friends === null){
            $data['Result'] = null;
            $data['Code'] = 404;
            $data['Error'] = true;
            $data['Message'] = 'There are not friends at this moment.';
            return null;
        }
        $data['Result'] = $friends;
        $data['Code'] = 200;
        $data['Error'] = false;
        $data['Message'] = 'friends found';
        return response()->json($friends, 200);
    }
    public function getDeclinedFriendsByUserId($id){
        $data['Result'] = null;
        $data['Code'] = 500;
        $data['Error'] = true;
        $data['Message'] = 'Ha ocurrido un error inesperado';

        $friends = Friends::where( 'status', '=', 'declined' )->where( function ( $query ) use ( $id ){
            $query->where('friend_from', '=', $id)->where('friend_to', '=', $id);
        })->get();

        if ($friends === null){
            $data['Result'] = null;
            $data['Code'] = 404;
            $data['Error'] = true;
            $data['Message'] = 'There are not friends at this moment.';
            return null;
        }
        $data['Result'] = $friends;
        $data['Code'] = 200;
        $data['Error'] = false;
        $data['Message'] = 'friends found';
        return response()->json($friends, 200);
    }
    public function removeFriend(Request $request, $id)
    {
        $data['Result'] = null;
        $data['Code'] = 500;
        $data['Error'] = true;
        $data['Message'] = 'Unexpected Error';

        $friends = Friends::where("friend_from","=",$id)->orWhere("friend_to","=",$id)->first();
        if ($friends){
            $friends->delete();
            $data['Result'] = $friends;
            $data['Code'] = 200;
            $data['Error'] = false;
            $data['Message'] = 'friend deleted';
            return response()->json($friends, 200);
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
      
        $friends = Friends::find($id);
        if ($friends){
            $inputData = $request->input();
            $friends->fill($inputData);
            $friends->save();
            $data['Result'] = $friends;
            $data['Code'] = 200;
            $data['Error'] = false;
            $data['Message'] = 'friend updated';
            return response()->json($friends, 200);
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
        
        $friends = new Friends;
        $inputData = $request->input();
        $friends->fill($inputData);
        $friends->save();
        $data['Result']     = $friends;
        $data['Code']       = 200;
        $data['Error']      = false;
        $data['Message']    = null;
        return response()->json($friends, 200);
    }
    public function delete(Request $request, $id)
    {
        $data['Result'] = null;
        $data['Code'] = 500;
        $data['Error'] = true;
        $data['Message'] = 'Unexpected Error';

        $friends = Friends::find($id);
        if ($friends){
        	$friends['status'] = 'disabled';
            $friends->fill($inputData);
            $friends->save();
            $data['Result'] = $friends;
            $data['Code'] = 200;
            $data['Error'] = false;
            $data['Message'] = 'friend deleted';
            return response()->json($friends, 200);
        }else{
            return null;
        }
    }
}
