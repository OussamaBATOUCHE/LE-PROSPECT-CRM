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


//Route::post('/updateProfil','Auth\RegisterController@update');


/*  END  List route oussama  */


/*    List route kamel  */

				/*    ----- GET ------ */


Route::get('/score_delete/{score}','ScoreController@destroy');

Route::get('/champActivite','ChampActiviteController@get');

Route::get('/champActivite_delete/{champ}','ChampActiviteController@destroy');

Route::get('/produits','ProduitController@get');

Route::get('/produit_delete/{produit}','ProduitController@destroy');




				/*    ----- POST ------ */



Route::post('/createChamp','ChampActiviteController@create');

Route::post('/createProduit','ProduitController@create');


				/*    ----- PATCH ------ */

Route::patch('/updateScore/{score}', 'ScoreController@update');

Route::patch('/updateChamp/{champ}', 'ChampActiviteController@update');

Route::patch('/updateProduit/{produit}', 'ProduitController@update');

Route::patch('/updateProfil/{user}', 'Auth\RegisterController@update');
		
/*  END  List route kamel  */
