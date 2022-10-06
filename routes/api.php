<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(['prefix'=>'/v1','as'=>'user'], function(){
    Route::middleware('auth:api')->group(function () {

        // Route::get('/user', function (Request $request) {
        //     return $request->user();
        // });
    });

    /*===========================AD_CONTROLLER============================= */
    Route::get('/ad', 'api\AdController@index');
    Route::get('/ad/{id}', 'api\AdController@get');
    Route::post('/ad', 'api\AdController@store');
    Route::patch('/ad/{id}', 'api\AdController@update');
    Route::delete('/ad/{id}', 'api\AdController@delete');
    Route::post('/ad/updatetag', 'api\AdController@updateTag');

    /*===========================CATEGORY_CONTROLLER============================= */
    Route::get('/category', 'api\CategoryController@index');
    Route::get('/category/{id}', 'api\CategoryController@get');
    Route::post('/category', 'api\CategoryController@store');
    Route::patch('/category/{id}', 'api\CategoryController@update');
    Route::delete('/category/{id}', 'api\CategoryController@delete');

    /*===========================TAG_CONTROLLER============================= */
    Route::get('/tag', 'api\TagController@index');
    Route::get('/tag/{id}', 'api\TagController@get');
    Route::post('/tag', 'api\TagController@store');
    Route::patch('/tag/{id}', 'api\TagController@update');
    Route::delete('/tag/{id}', 'api\TagController@delete');
});
