<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Etat;
use App\Tache_etat;

class EtatController extends Controller
{
  public function get()
  {
    if($this->checkAccess()==1){
        $etats = Etat::get();
        return view('etats')->with('etats',$etats);
    }else {
     return  $this->messageDroitAccee();
    }
  }

  public function create(Request $rq){

    $etat = new Etat ;

    $etat->LibEtat = $rq->LibEtat;
    $etat->save();
    return redirect('/etats')->with('status', '<div class="alert alert-success alert-dismissible show" ><button type="button" class="close" data-dismiss="alert" aria-label="Close"><spanaria-hidden="true">&times;</span></button>Ajouté avec succée !</div>');

  }



public function update(Request $request,$etat ){

  $data = request()->except(['_token','_method']);
  Etat::where('id', $etat)->update($data);
    return redirect('/etats')->with('status', '<div class="alert alert-success alert-dismissible show" ><button type="button" class="close" data-dismiss="alert" aria-label="Close"><spanaria-hidden="true">&times;</span></button>Modifier avec succée !</div>');
  }

  public function destroy($id){
    $row = Tache_etat::where('idEtat',$id)->delete(); //ici je supprime tous les rows qui concernent le etat dont je vient de le supprimer..
    $etat = Etat::find($id)->delete();
    return redirect('/etats')->with('status', '<div class="alert alert-success alert-dismissible show" ><button type="button" class="close" data-dismiss="alert" aria-label="Close"><spanaria-hidden="true">&times;</span></button>supprimé avec succée !</div>');
  }
}
