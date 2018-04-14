<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Score;

class ScoreController extends Controller
{


    public function get()
    {
      if($this->checkAccess()==1){
          $scores = Score::get();
          return view('scores')->with('scores',$scores);
      }else {
       return  $this->messageDroitAccee();
      }
    }

    public function store(){

    	$this->validate(request(),[
    		'LibScore'=>'required'
    	]);


		Score::create([
    			'LibScore' => request('LibScore'),
    			'description' => request('description'),
    			'action' => request('action'),
    			'obs' => request('obs')
		]);

		redirect('/');
    }

    public function update(Request $rq){
    	$this->validate(request(),[
    		'LibScore'=>'required'
    	]);

    }

    public function destroy(Score $score){

    	$score->delete();
    }
}
