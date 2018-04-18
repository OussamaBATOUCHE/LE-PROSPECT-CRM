<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Prospect;

class ProspectController extends Controller
{
    public function get()
    {
          $prospects = prospect::get();
          return view('prospects')->with('prospects',$prospects);
    }

    public function create(Request $rq){

        /*    $this->validate(request(),[
            'codeProsp'->required,
            'idChampAct'->required,
            'societe'->required,
            'wilaya'->required,
            'tele1'->required
            ]);
         */ 

          $prospect = new Prospect ;
          $prospect->codeProsp = $rq->codeProsp;
          $prospect->idGrp = $rq->idGrp;
          $prospect->idChampAct = $rq->idChampAct;
          $prospect->societe = $rq->societe;
          $prospect->nom = $rq->nom;
          $prospect->prenom = $rq->prenom;
          $prospect->wilaya = $rq->wilaya;
          $prospect->commune = $rq->commune;
          $prospect->adresse = $rq->adresse;
          $prospect->email = $rq->email;
          $prospect->email2 = $rq->email2;
          $prospect->skype = $rq->skype;
          $prospect->tele1 = $rq->tele1;
          $prospect->tele2 = $rq->tele2;
          $prospect->tele3 = $rq->tele3;
          $prospect->fax = $rq->fax;
          $prospect->siteWeb = $rq->siteWeb;
          $prospect->nbreEmplyes = $rq->nbreEmplyes;
          $prospect->description = $rq->description;
          $prospect->bloquer = $rq->bloquer;

          $prospect->save();

          return redirect('/prospects')->with('status', '<div class="alert alert-success alert-dismissible show" ><button type="button" class="close" data-dismiss="alert" aria-label="Close"><spanaria-hidden="true">&times;</span></button>Ajouté avec succée !</div>');
    }
      

      
 public function update(Request $request,$prospect ){

    $data = request()->except(['_token','_method']);
    Prospect::where('id', '=', $prospect)->update($data);
      return redirect('/prospects')->with('status', '<div class="alert alert-success alert-dismissible show" ><button type="button" class="close" data-dismiss="alert" aria-label="Close"><spanaria-hidden="true">&times;</span></button>Modifier avec succée !</div>');
    }

    public function destroy($id){
      $prospect = Prospect::find($id);
        $prospect->delete();
      return redirect('/prospects')->with('status', '<div class="alert alert-success alert-dismissible show" ><button type="button" class="close" data-dismiss="alert" aria-label="Close"><spanaria-hidden="true">&times;</span></button>supprimé avec succée !</div>');    
    }
}
