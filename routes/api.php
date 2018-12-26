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

Route::group(['namespace' => 'Api'], function () {
    // ユーザー新規作成
    Route::post('/user/register', 'Auth\RegisterController@register');
    Route::group(['middleware' => 'auth:api'], function () {

    });
});

// ユーザー情報取得
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});