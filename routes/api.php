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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
    });
Route::post('register', 'Auth\RegisterController@register');
Route::group(['middleware' => ['auth','auth:api']], function() {
    Route::get('users', 'UserController@index');
    Route::delete('user/delete/{id}', 'UserController@delete');
    Route::get('user/view/{id}', 'UserController@view');
    Route::patch('user/update/{id}', 'UserController@update');

    Route::get('roles', 'UserRolesController@roles');
    Route::get('permissions', 'UserRolesController@permissions');
    Route::post('add-user-role/{userId}/{roleId}', 'UserRolesController@addRole');
    Route::post('add-user-permission/{userId}/{permissionId}', 'UserRolesController@addPermission');
});
//Route::post('register', 'Auth\RegisterController@register');
//Route::post('login', 'Auth\LoginController@login');
