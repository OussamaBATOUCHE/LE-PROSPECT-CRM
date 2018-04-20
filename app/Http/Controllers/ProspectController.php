<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Prospect;
use App\Prospect_produit;
use App\Prospect_score;
use App\score;

class ProspectController extends Controller
{
    public function get()
    {
          $prospects = prospect::where('bloquer',0)->orderByRaw('created_at DESC')->get(); //je ne recuppere que les prospects non bloque , inclus les client
          $tousLesScores = score::get();//pour un nouveau contact/prospect
          $listScore = array();//pour chaque prospect , on recupere le dernier score obtenu
          //dernier score marqué
          //dd($prospects);
          foreach ($prospects as $prospect) {
             $lastScore = Prospect_score::where('idPros',$prospect->id)->first();
             $scoreById = Score::where('id',$lastScore->idScore)->first();
             $listScore[] = array( "score" => $scoreById->num,
                                   "date" => $lastScore->date,
                                   "remarque" => $lastScore->remarque,
                                   "couleur" => $scoreById->couleur
                                  );
          }
          //return $listScore[0]["score"];
         $MyJsonList = json_encode($listScore,JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES );
          //dd($MyJsonList);
         // return $JsonList[0]->score;
        //  $listScore ; // hadi ma temchich 7ta nro7 n'ajouti scores ki ana ki nass
          return view('prospects')->with('prospects',$prospects)
                                  ->with('tousLeScores',$tousLesScores)
                                  ->with('DerniersScores',$listScore);
    }

    public function create(Request $rq){

        /*    $this->validate(request(),[
            'codeProsp'->required,
            'idChampAct'->required,
            'societe'->required,
            'wilaya'->required,
            'tele1'->required
            ]);
         */ //mais had la validation lzem ndirouha ....

         // traitement pour obtenir le num sequenciel de nouveau prospect


         //traitement des champs de code
         $NchAct = strval($rq->idChampAct); if(strlen($NchAct) != 2) $NchAct = "0".$NchAct;
         $Nwilaya = strval($rq->wilaya);    if(strlen($Nwilaya) != 2) $Nwilaya = "0".$Nwilaya;
         $year   = substr(date("Y"),-2); //to get only the 2 last number ex: 2016 -> 16
         $sytax = $NchAct.$Nwilaya.$year;
         //return $sytax;
          $oldPrspects = Prospect::select('codeProsp')->get();
          $threeOne = 0 ; // pour savoir si on a prospect avec le meme champ d'activite et la meme wilaya et la meme annee , dans ce cas on doit incrementer , other ways une simple initialisation.
          $list[] = 0 ; //une liste qui contient les num sequenciel qui existe deja
          foreach ($oldPrspects as $prospect) {
            $OPchAct  = substr($prospect->codeProsp,0,2);
            $OPwilaya = substr($prospect->codeProsp,3,2);
            $OPyear   = substr($prospect->codeProsp,-2);
            $OPsytax = $OPchAct.$OPwilaya.$OPyear;
            //return $OPsytax;
            if ( $sytax == $OPsytax) {
              $threeOne = 1;
            }else{
              $list[] = intval(substr($prospect->codeProsp,6,4));
            }
          }

          if ($threeOne == 1) {
            $mySeq = strval(max($list)+1); if(strlen($mySeq) == 1){$mySeq = "000".$mySeq;}else{if(strlen($mySeq) == 2){$mySeq = "00".$mySeq;}else{if(strlen($mySeq) == 3){$mySeq = "0".$mySeq;}}}
          }else {
            $mySeq = "0001";
          }



          $newCode =$NchAct.".".$Nwilaya.".".$mySeq."/".substr(date("Y"),-2);//le code ext pret

          //Societe
          $prospect = new Prospect ;
          $prospect->codeProsp = $newCode;
          $prospect->societe = $rq->societe;
          $prospect->adresse = $rq->adresse;
          $prospect->codePostal = $rq->codePostal;
          $prospect->wilaya = $rq->wilaya;
          $prospect->nbreEmplyes = $rq->nbreEmplyes;
          //Contact
          $prospect->nom = $rq->nom;
          $prospect->genre = $rq->genre;
          $prospect->prenom = $rq->prenom;
          $prospect->email = $rq->email;
          $prospect->tele1 = $rq->tele1;
          $prospect->tele2 = $rq->tele2;
          $prospect->tele3 = $rq->tele3;
          $prospect->fax = $rq->fax;
          $prospect->skype = $rq->skype;
          $prospect->siteWeb = $rq->siteWeb;

          //Autre
          $prospect->description = $rq->description;
          $prospect->idGrp = $rq->idGrp;
          $prospect->idChampAct = $rq->idChampAct;
          $prospect->bloquer = 0;

          //Done
          $prospect->save();

          //produits supposés pour ce prospect
          foreach ($rq->produits as $produit) {
            $prospect_produit = new Prospect_produit ;
            $prospect_produit->idPrd = $produit;
            $prospect_produit->idProsp = $prospect->id ;
            $prospect_produit->save();
          }
          //preScorring
          $prospect_score = new Prospect_score;
          $prospect_score->idPros = $prospect->id;
          $prospect_score->idScore = $rq->score ;
          $prospect_score->date = date("d/m/Y H:i:s");
          $prospect_score->remarque = 'Creation.';
          $prospect_score->save();

          return redirect('/prospects')->with('status', '<div class="alert alert-success alert-dismissible show" ><button type="button" class="close" data-dismiss="alert" aria-label="Close"><spanaria-hidden="true">&times;</span></button>Ajouté avec succée !</div>');
    }



 public function update(Request $request,$prospect ){

    $data = request()->except(['_token','_method']);
      Prospect::where('id',$prospect)->update($data);
      return redirect('/prospects')->with('status', '<div class="alert alert-success alert-dismissible show" ><button type="button" class="close" data-dismiss="alert" aria-label="Close"><spanaria-hidden="true">&times;</span></button>Modifier avec succée !</div>');
    }

    public function destroy($id){
      //yak 9oulna prospect jamais la yetsuprimas
      $prospect = Prospect::find($id);
        $prospect->delete();
      return redirect('/prospects')->with('status', '<div class="alert alert-success alert-dismissible show" ><button type="button" class="close" data-dismiss="alert" aria-label="Close"><spanaria-hidden="true">&times;</span></button>supprimé avec succée !</div>');
    }
}
