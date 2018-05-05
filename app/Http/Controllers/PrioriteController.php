<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Priorite;
use App\Tache;

class PrioriteController extends Controller
{
  public function get()
  {
    if($this->UserType()==1){
        $priorites = priorite::get();
        return view('priorites')->with('priorites',$priorites);
    }else {
     return  $this->messageDroitAccee();
    }
  }

  public function create(Request $rq){

    $priorite = new priorite ;
    $priorite->num = $rq->num;
    $priorite->libPrio = $rq->libPrio;
    $priorite->couleur = $rq->couleur;
    $priorite->save();
    return redirect('/priorites')->with('status', '<div class="alert alert-success alert-dismissible show" ><button type="button" class="close" data-dismiss="alert" aria-label="Close"><spanaria-hidden="true">&times;</span></button>Ajouté avec succée !</div>');

  }



public function update(Request $request,$priorite ){

  $data = request()->except(['_token','_method']);
  priorite::where('id', $priorite)->update($data);
    return redirect('/priorites')->with('status', '<div class="alert alert-success alert-dismissible show" ><button type="button" class="close" data-dismiss="alert" aria-label="Close"><spanaria-hidden="true">&times;</span></button>Modifier avec succée !</div>');
  }

  public function destroy($id){
    $row = tache::where('idPrio',$id)->update(['idPrio' => 0]); //ici je supprime tous les rows qui concernent le priorite dont je vient de le supprimer..
    $priorite = priorite::find($id)->delete();
    return redirect('/priorites')->with('status', '<div class="alert alert-success alert-dismissible show" ><button type="button" class="close" data-dismiss="alert" aria-label="Close"><spanaria-hidden="true">&times;</span></button>supprimé avec succée !</div>');
  }
}
