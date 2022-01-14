<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Route::get('menu', 'MenuController@index');

Route::get('card', 'CardController@index');
Route::post('card', 'CardController@cardAuthorize');
Route::get('card/result/{orderId}/{data}', 'CardController@authorizeResult');

Route::get('mpi', 'MpiController@index');
Route::post('mpi', 'MpiController@mpiAuthorize');
Route::post('mpi/result', 'MpiController@result');

Route::get('cvs', 'CvsController@index');
Route::post('cvs', 'CvsController@cvsAuthorize');
Route::get('cvs/result/{orderId}', 'CvsController@authorizeResult');

Route::post('push/mpi', 'PushController@mpi');


//予約
Route::get('/event/shibusawa/reserve/', 'MysteryController@shibusawa_index');

//予約
Route::post('/event/shibusawa/reserve/confirm', 'MysteryController@shibusawa_confirm')->name('shibusawa_confirm');

//予約
Route::post('/event/shibusawa/reserve/fix', 'MysteryController@shibusawa_fix')->name('shibusawa_fix');

//予約
Route::post('/event/shibusawa/reserve/thanks', 'MysteryController@shibusawa_thanks')->name('shibusawa_thanks');



