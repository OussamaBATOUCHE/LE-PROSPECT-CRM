<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Score;

class ScoreController extends Controller
{
    

    public function store(){

    	$this->validate(request(),[
    		'LibScore'->'required'
    	]);


		Score::create([
    			'LibScore' => request('LibScore'),
    			'description' => request('description'),
    			'action' => request('action'),
    			'obs' => request('obs')
		]);
 
		redirect('/');
    }

    public function update(Score $score){
    	$this->validate(request(),[
    		'LibScore'->'required'
    	]);

    	$score->LibScore => request('LibScore');
    	$score->description => request('description');
    	$score->action => request('action');
    	$score->obs => request('obs');
    
    	$score->save();
    }

    public function destroy(Score $score){

    	$score->delete();
    }
}
