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

Route::get('/posts', 'PostController@index');
Route::get('/posts/show/{id}', 'PostController@show');
Route::post('/posts/store', 'PostController@store');
Route::post('/posts/comments/{id}/store', 'CommentController@store');

Route::get('/comments', 'CommentController@index');
Route::get('/comments/show/{id}', 'CommentController@show');
