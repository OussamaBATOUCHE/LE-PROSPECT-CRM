<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\ChampActivite;

class ChampActiviteController extends Controller
{
    public function store(){

    	$this->validate(request(),[
    		'LibChampAct'->'required'
    	]);


		Score::create([
    			'LibChampAct' => request('LibChampAct')
		]);
 
		redirect('/');
    }

    public function update(ChampActivite $champActivite){

    	$this->validate(request(),[
    		'LibChampAct'->'required'
    	]);

    	$champActivite->LibChampAct => request('LibChampAct');

    
    	$score->save();
    }

    public function destroy(ChampActivite $champActivite){

    	$champActivite->delete();
    }
}
