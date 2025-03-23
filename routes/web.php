<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SauceController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route du controller de sauce
Route::get('/create', 'App\Http\Controllers\SauceController@create')->name('create');
Route::post('/store', 'App\Http\Controllers\SauceController@store')->name('store');
Route::post('/update/{id}', 'App\Http\Controllers\SauceController@update')->name('update');

Route::get('/edit/{id}', 'App\Http\Controllers\SauceController@edit')->name('edit');
Route::get('/show/{id}', 'App\Http\Controllers\SauceController@show')->name('show');

Route::get('/destroy/{id}', 'App\Http\Controllers\SauceController@destroy')->name('destroy');

Route::get('/like/{id}', 'App\Http\Controllers\SauceController@like')->name('like');
Route::get('/dislike/{id}', 'App\Http\Controllers\SauceController@dislike')->name('dislike');
