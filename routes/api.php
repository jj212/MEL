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




Route::group(['middleware' => 'api', 'namespace'=>'Api'], function ($router) {
    Route::post('login', 'Auth\AuthController@login');
    Route::post('register', 'Auth\AuthController@register');
//    Route::post('forgot-password', 'Auth\AuthController@forgotPassword');

    Route::post('ckfinder/image/upload', 'UploadsController@imageUpload');

    Route::group([ 'middleware'=>'jwt.auth'], function () {
        Route::get('me', 'Auth\AuthController@me');
        Route::post('logout', 'Auth\AuthController@logout');
        Route::get('refresh', 'Auth\AuthController@refresh');



        Route::post('documents', 'DocumentsController@store');
    });

});
