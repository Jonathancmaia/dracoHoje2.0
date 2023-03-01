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

Route::get('getDracoDaily', 'App\Http\Controllers\DracoController@getDracoDaily')->name('getDracoDaily');
Route::get('getDracoWeekly', 'App\Http\Controllers\DracoController@getDracoWeekly')->name('getDracoWeekly');;
Route::get('getDracoMonthly', 'App\Http\Controllers\DracoController@getDracoMonthly')->name('getDracoMonthly');;
Route::get('getDracoAll', 'App\Http\Controllers\DracoController@getDracoAll')->name('getDracoAll');;

Route::get('getHydraDaily', 'App\Http\Controllers\HydraController@getHydraDaily')->name('getHydraDaily');
Route::get('getHydraWeekly', 'App\Http\Controllers\HydraController@getHydraWeekly')->name('getHydraWeekly');
Route::get('getHydraMonthly', 'App\Http\Controllers\HydraController@getHydraMonthly')->name('getHydraMonthly');
Route::get('getHydraAll', 'App\Http\Controllers\HydraController@getHydraAll')->name('getHydraAll');