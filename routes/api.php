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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/product','ProdukController@index');
Route::post('/add-product','ProdukController@create');
Route::put('/update/{id}','ProdukController@update');
Route::get('/get-product/{id}','ProdukController@show');
Route::delete('/delete-product/{id}','ProdukController@destroy');
// Route::put('/update/{id}','ProdukController@update');
