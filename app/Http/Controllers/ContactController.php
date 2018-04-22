<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Contact;
use App\Prospect;
use App\Prospect_produit;
use App\Prospect_score;
use App\score;
use App\cntct_appel;
use App\cntct_email;
use Auth;

class ContactController extends Controller
{


  public function create(Request $rq,$tache,$type,$prospect){
    $contact = new contact ;
    $contact->idUser = Auth::user()->id;
    $contact->idTach = $tache;
    $contact->idProsp = $prospect;
    $contact->date = $rq->date;
    $contact->remarque = $rq->remarque;
    $contact->type = $this->typeCntctToChar($rq->type);

    $contact->save();

    //new Scorring
    $prospect_score = new Prospect_score;
    $prospect_score->idPros = $prospect;
    $prospect_score->idScore = $rq->score ;
    $prospect_score->date = $rq->date." ".$rq->heure ;//la date est en format string
    $prospect_score->remarque = $rq->remarque;
    $prospect_score->save();

    $emailSendResult=""; //pour les emails
    //traitement des types
    //Appel
    if ($type == "phone") {
      $cntct_appel = new cntct_appel;
      $cntct_appel->idCntct = $contact->id;
      $cntct_appel->entrantSortant = $rq->ES;
      $cntct_appel->duree = $rq->duree;
      $cntct_appel->save();
    }elseif ($type == "mail") {
      //we send'it first if it's a saveSend Request

      $envoye = "Non";
      //return $rq->jsave ;
      if ($rq->jsave != "Enregistrer") {
        $Reciever = Prospect::where('id',$prospect)->first();
        $this->sendEmail($Reciever,$rq->titre,$rq->remarque);
        $emailSendResult=" et email envoyé ";
        $envoye = "Oui";
      }


      $cntct_email = new cntct_email;
      $cntct_email->idCntct = $contact->id;
      $cntct_email->idGrp = 0;
      $cntct_email->contenu = $rq->remarque;
      $cntct_email->envoye = $envoye;
      $cntct_email->save();
    }

    return redirect('/prospects')->with('status', '<div class="alert alert-success alert-dismissible show" ><button type="button" class="close" data-dismiss="alert" aria-label="Close"><spanaria-hidden="true">&times;</span></button>Contact ajouté '.$emailSendResult.'avec succée !</div>');
  }

}
