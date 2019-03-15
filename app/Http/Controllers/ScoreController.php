<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

use App\Score;
use App\Prospect_score;

class ScoreController extends Controller
{


    public function get()
    {
      if($this->UserType()==1){
          $scores = Score::get();
          return view('scores')->with('scores',$scores);
      }else {
       return  $this->messageDroitAccee();
      }
    }

    public function create(Request $rq){

      $score = new Score ;
      $score->num = $rq->num;
      $score->LibScore = $rq->LibScore;
      $score->description = $rq->description;
      $score->action = $rq->action;
      $score->cycle = $rq->cycle;
      $score->obs = $rq->obs;
      $score->couleur = $rq->couleur;
  	  $score->save();
		  return redirect('/scores')->with('status', '<div class="alert alert-success alert-dismissible show" ><button type="button" class="close" data-dismiss="alert" aria-label="Close"><spanaria-hidden="true">&times;</span></button>Ajouté avec succée !</div>');
    }



 public function update(Request $request,$score ){

    $data = request()->except(['_token','_method']);
    Score::where('id', $score)->update($data);
      return redirect('/scores')->with('status', '<div class="alert alert-success alert-dismissible show" ><button type="button" class="close" data-dismiss="alert" aria-label="Close"><spanaria-hidden="true">&times;</span></button>Modifier avec succée !</div>');
    }

    public function destroy($id){
      $row = Prospect_score::where('idScore',$id)->delete(); //ici je supprime tous les rows qui concernent le score dont je vient de le supprimer..
      $score = Score::find($id)->delete();
      return redirect('/scores')->with('status', '<div class="alert alert-success alert-dismissible show" ><button type="button" class="close" data-dismiss="alert" aria-label="Close"><spanaria-hidden="true">&times;</span></button>supprimé avec succée !</div>');
    }
}
