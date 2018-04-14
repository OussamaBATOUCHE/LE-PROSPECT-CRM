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


/*    List route oussama  */
Route::get('/', function () {
    return view('welcome');
});


Route::get('/paramList','HomeController@paramList');
Route::get('/scores','ScoreController@get');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


/*  END  List route oussama  */


/*    List route kamel  */



/*  END  List route kamel  */
