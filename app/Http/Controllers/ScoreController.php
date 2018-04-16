<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

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

    public function create(Request $rq){

      $score = new Score ;
      $score->LibScore = $rq->LibScore;
      $score->description = $rq->description;
      $score->action = $rq->action;
      $score->obs = $rq->obs;
  	  $score->save();
		  return redirect('/scores')->with('status', '<div class="alert alert-success alert-dismissible show" >
                                                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                      </button>
                                                      Ajouté avec succée !
                                                    </div>');
    }

    public function update(Request $rq){
    	return 3;

    }

    public function destroy(Score $score){

    	$score->delete();
    }
}
