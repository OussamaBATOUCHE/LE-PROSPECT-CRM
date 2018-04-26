<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Prospect;
use App\Prospect_produit;
use App\Prospect_score;
use App\score;
use App\champActivite;
use App\Groupe;
use App\Produit;
use App\Contact;
use App\User;
use App\cntct_email;
use App\cntct_appel;
use App\cntct_terain;
use App\Priorite;

class ProspectController extends Controller
{
    public function get($bloque = 0)
    {
          $prospects = Prospect::where('bloquer',$bloque)->orderByRaw('id DESC')->get(); //je ne recuppere que les prospects non bloque , inclus les client
          $tousLesScores = Score::get();//pour un nouveau contact/prospect
          $tousLesChampActiv = ChampActivite::get();
          $tousLesGroupes = Groupe::get();
          $tousLesProduits = Produit::get();
          $tousLesUsers = User::where('type',0)->get();
          //pour form ajout tache et recuperation des produit supposes au moment de creation de se prospect
          $produitsPropose = Prospect_produit::get();
          $tousLesPriorites = Priorite::get();

          $infosProspect = array();//pour chaque prospect , on recupere toute autre infos

          //dernier score marqué
          foreach ($prospects as $prospect) {
             $lastScore = Prospect_score::where('idPros',$prospect->id)->latest()->first();
             $scoreById = Score::where('id',$lastScore->idScore)->first();
             $champActById = champActivite::where('id',$prospect->idChampAct)->first();
             $derniersContacts = Contact::where('idProsp',$prospect->id)->orderByRaw('id DESC')->first();
             $cntct="";
             if ($derniersContacts) { //si un contact exist deja , dans le cas de creatino ce code ne s'execute pas .
               switch ($derniersContacts->type) {

                 case 'A':
                   $cntct = cntct_appel::where('idCntct',$derniersContacts->id)->first();//c sur que y'a q'un seul appel pour un contact
                   break;
                 case 'E':
                   $cntct = cntct_email::where('idCntct',$derniersContacts->id)->first();//c sur que y'a q'un seul mail pour un contact
                   break;
                 case 'T':
                   $cntct = cntct_terain::where('idCntct',$derniersContacts->id)->first();//c sur que y'a q'un seul appel pour un contact
                   break;
                   default:return $derniersContacts->type; break;
               }
               $userCntct = user::where('id',$derniersContacts->idUser)->first();
               $infosProspect[] = array( "score" => $scoreById->num,
                                         "scoreLib" => $scoreById->LibScore,
                                         "date" => $lastScore->date,
                                         "remarque" => $lastScore->remarque,
                                         "couleur" => $scoreById->couleur,
                                         "champActiv"=> $champActById->LibChampAct,
                                         "idDernierCntct" => $derniersContacts->id,
                                         "typeDernierCntct" => $derniersContacts->type,
                                         "remarqueDernierCntct" => $derniersContacts->remarque,
                                         "cntct_info" => json_decode($cntct, true),
                                         "cntct_user" => $userCntct->name." ".$userCntct->prenom
                                       );
             }else {
               $infosProspect[] = array( "score" => $scoreById->num,
                                         "scoreLib" => $scoreById->LibScore,
                                         "date" => $lastScore->date,
                                         "remarque" => $lastScore->remarque,
                                         "couleur" => $scoreById->couleur,
                                         "champActiv"=> $champActById->LibChampAct,
                                         "idDernierCntct" => "",
                                         "typeDernierCntct" => "",
                                         "remarqueDernierCntct" => "",
                                         "cntct_info" => "",
                                         "cntct_user" => ""
                                       );
             }

          }


          return view('prospects')->with('prospects',$prospects)
                                  ->with('tousLeScores',$tousLesScores)
                                  ->with('tousLesChampActiv',$tousLesChampActiv)
                                  ->with('tousLesGroupes',$tousLesGroupes)
                                  ->with('tousLesProduits',$tousLesProduits)
                                  ->with('infosProsp',$infosProspect)
                                  ->with('tousLesUsers',$tousLesUsers)
                                  ->with('produitsPropose',$produitsPropose)
                                  ->with('tousLesPriorites',$tousLesPriorites);
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

         // traitement pour obtenir le num sequentiel d'un nouveau prospect


         //traitement des champs de code
         $NchAct = strval($rq->idChampAct); if(strlen($NchAct) != 2) $NchAct = "0".$NchAct;
         $Nwilaya = strval($rq->wilaya);    if(strlen($Nwilaya) != 2) $Nwilaya = "0".$Nwilaya;
         $year   = substr(date("Y"),-2); //to get only the 2 last number ex: 2016 -> 16
         $sytax = $NchAct.$Nwilaya.$year;

          $oldPrspects = Prospect::select('codeProsp')->get();
          $threeOne = 0 ; // pour savoir si on a prospect avec le meme champ d'activite et la meme wilaya et la meme annee , dans ce cas on doit incrementer , other ways une simple initialisation.
          $list[] = 0 ; //une liste qui contient les num sequenciel qui existe deja
          foreach ($oldPrspects as $prospect) {
            $OPchAct  = substr($prospect->codeProsp,0,2);
            $OPwilaya = substr($prospect->codeProsp,3,2);
            $OPyear   = substr($prospect->codeProsp,-2);
            $OPsytax = $OPchAct.$OPwilaya.$OPyear;

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



          $newCode =$NchAct.".".$Nwilaya.".".$mySeq."/".substr(date("Y"),-2);//le code est pret

          //Societe
          $prospect = new Prospect ;
          $prospect->codeProsp = $newCode;
          $prospect->societe = ucfirst(strtolower($rq->societe));
          $prospect->adresse = $rq->adresse;
          $prospect->codePostal = $rq->codePostal;
          $prospect->wilaya = $rq->wilaya;
          $prospect->nbreEmplyes = $rq->nbreEmplyes;
          //Contact
          $prospect->genre = $rq->genre;
          $prospect->nom = strtoupper($rq->nom);
          $prospect->prenom = ucfirst(strtolower($rq->prenom));
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
          //$prospect->created_at = \Carbon\Carbon::now()->toDateTimeString() ;

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
          $prospect_score->date = date("d/m/Y H:i:s");//la date est en format string
          $prospect_score->remarque = 'Creation.';

          $prospect_score->save();

          return redirect('/prospects')->with('status', '<div class="alert alert-success alert-dismissible show" ><button type="button" class="close" data-dismiss="alert" aria-label="Close"><spanaria-hidden="true">&times;</span></button>Ajouté avec succée !</div>');
    }



 public function update(Request $rq,$prospect ){

      Prospect::where('id',$prospect)
                ->update(["societe"=>$rq->societe,
                          "adresse"=>$rq->adresse,
                          "codePostal"=>$rq->codePostal,
                          "wilaya"=>$rq->wilaya,
                          "nbreEmplyes"=>$rq->nbreEmplyes,
                          //contact
                          "genre"=>$rq->genre,
                          "nom"=>$rq->nom,
                          "prenom"=>$rq->prenom,
                          "email"=>$rq->email,
                          "tele1"=>$rq->tele1,
                          "tele2"=>$rq->tele2,
                          "tele3"=>$rq->tele3,
                          "fax"=>$rq->fax,
                          "skype"=>$rq->skype,
                          "siteWeb"=>$rq->siteWeb,
                          //autre
                          "description"=>$rq->description,
                          "idGrp"=>$rq->idGrp,
                          "idChampAct"=>$rq->idChampAct
                         ]);

        //mise a jour des produits
        $prospect_produits = Prospect_produit::where('idProsp',$prospect)->delete();
        //Nouveau produits affectés pour ce prospect
        foreach ($rq->produits as $produit) {
          $prospect_produit = new Prospect_produit ;
          $prospect_produit->idPrd = $produit;
          $prospect_produit->idProsp = $prospect ;
          $prospect_produit->save();
        }
        //updateScorring -> if it's defrent from the last one
        $lastScore = Prospect_score::where('idPros',$prospect)->latest()->first();
        if ($lastScore->idScore != $rq->score ) {
          $prospect_score = new Prospect_score;
          $prospect_score->idPros = $prospect;
          $prospect_score->idScore = $rq->score ;
          $prospect_score->date = date("d/m/Y H:i:s");//la date est en format string
          $prospect_score->remarque = 'Modification de prospect.';
          $prospect_score->save();
        }


      return redirect('detailsProspect/'.$prospect)->with('status', '<div class="alert alert-success alert-dismissible show" ><button type="button" class="close" data-dismiss="alert" aria-label="Close"><spanaria-hidden="true">&times;</span></button>Modifier avec succée !</div>');
    }

    public function bloquer($id){
      //yak 9oulna prospect jamais la yetsuprimas
      $prospect = Prospect::where('id',$id)->update(["bloquer"=>1]);
      return redirect('detailsProspect/'.$id)->with('status', '<div class="alert alert-danger alert-dismissible show" ><button type="button" class="close" data-dismiss="alert" aria-label="Close"><spanaria-hidden="true">&times;</span></button>Le prospect est bloqué (vous pouvez le debloquer dans la <a href="'.url('prospectsBloques/1').'">liste des prospect bloqués</a>)</div>');
    }

    public function debloquer($id){
      $prospect = Prospect::where('id',$id)->update(["bloquer"=>0]);
      return redirect('detailsProspect/'.$id)->with('status', '<div class="alert alert-success alert-dismissible show" ><button type="button" class="close" data-dismiss="alert" aria-label="Close"><spanaria-hidden="true">&times;</span></button>Le prospect est Debloquer.</div>');
    }

    public function getById($id)
    {
      $prospect = Prospect::find($id);

      $scores = Prospect_score::where('idPros',$prospect->id)->latest()->first();
      $scoreById = Score::where('id',$scores->idScore)->first();//pour la couleur
      $monGroupe = Groupe::where('id',$prospect->idGrp)->first();

      $champActById = champActivite::where('id',$prospect->idChampAct)->first();
      $derniersContacts = Contact::where('idProsp',$prospect->id)->orderByRaw('id DESC')->get();

      $cntct=array();
      if ($derniersContacts) { //si un contact exist deja , dans le cas de creation ce code ne s'execute pas .
        foreach ($derniersContacts as $derCntct) {
          switch ($derCntct->type) {

            case 'A':
              $cntct[] = cntct_appel::where('idCntct',$derCntct->id)->first();//c sur que y'a q'un seul appel pour un contact
              break;
            case 'E':
              $cntct[] = cntct_email::where('idCntct',$derCntct->id)->first();//c sur que y'a q'un seul mail pour un contact
              break;
              default://return $derCntct->type; break;
          }
        }

      }

      $produitsPros = Prospect_produit::where('idProsp',$prospect->id)->select('idPrd')->get();
      $pr = array();
      foreach ($produitsPros as $prs) {
           $pr[] = $prs->idPrd ;
       }

      $produits = DB::table('Produits')->whereIn('id',$pr)->get();//et sa marche

      $us = array();
      foreach ($derniersContacts as $uss) {
           $userCntct = User::where('id',$uss->idUser)->first();
           $us[] = array("name"=>$userCntct->name,"prenom"=>$userCntct->prenom);
       }


       //pour le modal de modification
       $tousLesScores = Score::get();
       $tousLesChampActiv = ChampActivite::get();
       $tousLesGroupes = Groupe::get();
       $tousLesProduits = Produit::get();

      return view('prospectDetails')->with('prospect',$prospect)
                                    ->with('score',$scoreById)
                                    ->with('chamActiv',$champActById)
                                    ->with('monGroupe',$monGroupe)
                                    ->with('contacts',$derniersContacts)
                                    ->with('userContact',$us)
                                    ->with('cntct_infos',$cntct)
                                    ->with('produits',$produits)
                                    ->with('scores',$tousLesScores)
                                    ->with('lesChampActiv',$tousLesChampActiv)
                                    ->with('lesGroupes',$tousLesGroupes)
                                    ->with('lesProduits',$tousLesProduits);

    }
}
