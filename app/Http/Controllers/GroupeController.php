<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;
use App\groupe;
use App\Prospect;

class GroupeController extends Controller
{
  public function get()
  {
    if($this->checkAccess()==1){
        $Groupes = Groupe::get();
        return view('groupes')->with('Groupes',$Groupes);
    }else {
     return  $this->messageDroitAccee();
    }
  }

  public function create(Request $rq){

    $Groupe = new Groupe ;
    $Groupe->LibGrp = $rq->LibGrp;
    $Groupe->save();
    return redirect('/groupes')->with('status', '<div class="alert alert-success alert-dismissible show" ><button type="button" class="close" data-dismiss="alert" aria-label="Close"><spanaria-hidden="true">&times;</span></button>Ajouté avec succée !</div>');
  }

   public function update(Request $request,$Groupe ){

  $data = request()->except(['_token','_method']);
  Groupe::where('id', '=', $Groupe)->update($data);
    return redirect('/groupes')->with('status', '<div class="alert alert-success alert-dismissible show" ><button type="button" class="close" data-dismiss="alert" aria-label="Close"><spanaria-hidden="true">&times;</span></button>Modifier avec succée !</div>');
  }

  public function destroy($id){
    $row = Prospect::where('idGrp',$id)->update(['idGrp' => 0]); //ici je met a 0 tous les rows qui concernent le Groupe d'activite dont je vient de le supprimer..
    $Groupe = Groupe::find($id)->delete();
    return redirect('/groupes')->with('status', '<div class="alert alert-success alert-dismissible show" ><button type="button" class="close" data-dismiss="alert" aria-label="Close"><spanaria-hidden="true">&times;</span></button>supprimé avec succée !</div>');
  }
}
