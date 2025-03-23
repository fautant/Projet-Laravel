<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\ApiController;
Route::apiResource('api', App\Http\Controllers\ApiController::class);

Route::get('/sauces', 'App\Http\Controllers\ApiController@index');
Route::get('/sauces/{id}', 'App\Http\Controllers\ApiController@show');
Route::post('/sauces', 'App\Http\Controllers\ApiController@store');



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
