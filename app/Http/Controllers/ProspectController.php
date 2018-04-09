<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Prospect;

class ProspectController extends Controller
{
    public function store(){

    	$this->validate(request(),[
    		'codeProsp'->'required'
    		'idChampAct'->'required'
    		'societe'->'required'
    		'wilaya'->'required'
    		'tele1'->'required'
    	]);


		Score::create(request()->all());
 
		redirect('/');
    }

    public function update(Prospect $prospect){
    	$this->validate(request(),[
    		'LibScore'->'required'
    	]);
    		/*
    			Ndirouhoum ga3 un par un wella kayan plus simple ??
			*/

    	$score->save();
    }

    public function destroy(Prospect $prospect){

    	$prospect->delete();
    }
}
