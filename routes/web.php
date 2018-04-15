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

/* --- GET --- */

Route::get('/','HomeController@index');
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/paramList','HomeController@paramList');
Route::get('/scores','ScoreController@get');

Auth::routes();


/* --- POST --- */

Route::post('/createScore','ScoreController@create');



/*  END  List route oussama  */


/*    List route kamel  */

Route::get('/profil','HomeController@profil');
Route::get('/champActivite','ChampActiviteController@get');


/*  END  List route kamel  */
