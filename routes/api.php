<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/user/{user_id}', function (Request $request, $user_id) {

    $response_code      = 500;
    $response_data      = [];
    $response_content   = "application/json; charset=UTF-8";

    $params = $request->all();

    $rules = [
        'token' => 'required'
        ];

    $messages = [
        'token.required' => 'token required'
        ];

    $validator = Validator::make( $params, $rules, $messages );

    if( $validator->fails() ) {
        $response_code = 401;
        $response_data = $validator->errors()->all();
    } else {
        // Check if token exists
        $session = ($params['token'] === '26d52f72f86a34ab3f054cc2b7198492560c3ef4');

        if($session) {
            if( $user_id == 123 ) {
                $response_code = 200;
                $response_data = [
                    "message"   => "Petition complete",
                    "error"     => false
                ];
            } else {
                $response_code = 401;
                $response_data = [
                    "message"   => "Permission denied",
                    "error"     => true
                ];
            }
        } else {
            $response_code = 401;
            $response_data = [
                "message"   => "Invalid token",
                "error"     => true
            ];
        }
    }

    return response($response_data, $response_code)
            ->header('Content-Type', $response_content);
});
