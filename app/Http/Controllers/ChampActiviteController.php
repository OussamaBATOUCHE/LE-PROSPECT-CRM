<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;
use App\ChampActivite;
use App\Prospect;

class ChampActiviteController extends Controller
{

    public function get()
    {
      if($this->UserType()==1){
          $champs = ChampActivite::get();
          return view('champActivite')->with('champs',$champs);
      }else {
       return  $this->messageDroitAccee();
      }
    }

    public function create(Request $rq){

      $champ = new ChampActivite ;
      $champ->LibChampAct = $rq->LibChampAct;
      $champ->save();
      return redirect('/champActivite')->with('status', '<div class="alert alert-success alert-dismissible show" ><button type="button" class="close" data-dismiss="alert" aria-label="Close"><spanaria-hidden="true">&times;</span></button>Ajouté avec succée !</div>');
    }

     public function update(Request $request,$champ ){

    $data = request()->except(['_token','_method']);
    ChampActivite::where('id', '=', $champ)->update($data);
      return redirect('/champActivite')->with('status', '<div class="alert alert-success alert-dismissible show" ><button type="button" class="close" data-dismiss="alert" aria-label="Close"><spanaria-hidden="true">&times;</span></button>Modifier avec succée !</div>');
    }

    public function destroy($id){
      $row = Prospect::where('idChampAct',$id)->update(['idChampAct' => 0]); //ici je met a 0 tous les rows qui concernent le champ d'activite dont je vient de le supprimer..
      $champ = ChampActivite::find($id)->delete();
      return redirect('/champActivite')->with('status', '<div class="alert alert-success alert-dismissible show" ><button type="button" class="close" data-dismiss="alert" aria-label="Close"><spanaria-hidden="true">&times;</span></button>supprimé avec succée !</div>');
    }
}
