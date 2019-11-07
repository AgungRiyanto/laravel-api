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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('register', 'UserController@register');
Route::post('login', 'UserController@login');

Route::get('project', 'ProjectController@getProject')->middleware('jwt.verify');
Route::post('project', 'ProjectController@create')->middleware('jwt.verify');

Route::get('team', 'TeamController@getTeam')->middleware('jwt.verify');
Route::post('team', 'TeamController@create')->middleware('jwt.verify');
