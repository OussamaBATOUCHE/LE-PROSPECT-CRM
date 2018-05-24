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

use App\Tache_etat;
use App\Etat;
use App\Tache;

use App\User;

use App\Groupe;
use App\ChampActivite;

use App\Client_produit;
use App\ProchaineAction;
class ContactController extends Controller
{

  public function get($type = 0){
    //verification des droits d'acces
    if($this->UserType()==1){//dans ce cas , c'est le admin qu'est en ligne , ainsi je lui return toute la liste
      switch ($type) {
        case 0:
          $contacts = Contact::orderByRaw('id DESC')->get();
          break;
          case 1:
            $contacts = Contact::where('type','A')->orderByRaw('id DESC')->get();
            break;
            case 2:
              $contacts = Contact::where('type','E')->orderByRaw('id DESC')->get();
              break;
      }

    }else {//dans ce cas c'est un simple commercial , ainsi je luis return sa propre liste de contacte
      switch ($type) {
        case 0:
          $contacts = Contact::where('idUser',Auth::user()->id)->orderByRaw('id DESC')->get();
          break;
          case 1:
            $contacts = Contact::where('type','A')->where('idUser',Auth::user()->id)->orderByRaw('id DESC')->get();
            break;
            case 2:
              $contacts = Contact::where('type','A')->where('idUser',Auth::user()->id)->orderByRaw('id DESC')->get();
              break;
      }

    }
    // et je contenu la procedure le plus normalement possible
    $users=array();
    $prospects =array();
    $scores = array();
    $taches = array();
    $details = array();
    foreach ($contacts as $contact) {
      $users[] = User::find($contact->idUser);
      $prospects[] = Prospect::find($contact->idProsp);
      $scores[] = Score::find($contact->idScore);
      $taches[] = Tache::find($contact->idTach);
      switch ($contact->type) {

        case 'A':
          $details[] = cntct_appel::where('idCntct',$contact->id)->first();//c sur que y'a q'un seul appel pour un contact
          break;
        case 'E':
          $details[] = cntct_email::where('idCntct',$contact->id)->first();//c sur que y'a q'un seul mail pour un contact
          break;
          default:return $contact->type; break;
      }
    }

    //pour les email en groupe
    $tousLesGroupes = Groupe::get();
    $tousLesChampActiv = ChampActivite::get();


    //dd($taches);
    return view('contacts')->with('contacts',$contacts)
                           ->with('details',$details)
                           ->with('users',$users)
                           ->with('prospects',$prospects)
                           ->with('scores',$scores)
                           ->with('taches',$taches)
                           ->with('tousLesGroupes', $tousLesGroupes)
                           ->with('tousLesChampActiv', $tousLesChampActiv);

  }


  public function create(Request $rq,$tache,$type,$prospect){
    $contact = new contact ;
    $contact->idUser = Auth::user()->id;
    $contact->idTach = $tache;
    $contact->idProsp = $prospect;
    $contact->idScore = $rq->score;
    $contact->objet = $rq->objet;
    $contact->date = $rq->date;
    $contact->remarque = $rq->remarque;
    $contact->type = $rq->type;

    $contact->save();

    // T_3 mis a jour des infos du prospect en cas qu'il devient un client
    $clientScore = Score::whereRaw('num = (select max(`num`) from Scores)')->first();
    if($rq->score == $clientScore->id ){
      Prospect::where('id',$prospect)
                ->update(["client"=>1]);

       foreach ($rq->produits as $p) {
         $client_produit = new Client_produit;
         $client_produit->idPros = $prospect;
         $client_produit->idPrd = $p;
         $client_produit->save();
       }
     }
   // T_3 end

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

      $envoye = 'Non';
      //return $rq->jsave ;
      if ($rq->jsave != "Enregistrer") {
        $Reciever = Prospect::where('id',$prospect)->first();
        $this->sendEmail($Reciever,$rq->titre,$rq->remarque);
        $emailSendResult=" et email envoyé ";
        $envoye = 'Oui';
      }


      $cntct_email = new cntct_email;
      $cntct_email->idCntct = $contact->id;
      $cntct_email->idGrp = 0;
      $cntct_email->contenu = $rq->remarque;
      $cntct_email->envoye = $envoye;
      $cntct_email->save();
    }

    //si ce contact corespand a une tache , je doit recuperer l'etat d'avancement de cette tache
    if ($tache!=0) {
      $tache_etat = new Tache_etat;
      $tache_etat->idEtat = $rq->etatTache;
      $tache_etat->idTache = $tache;
      $tache_etat->save();

      //si cette etat est le plus grand dans liste des tache ceci dire que la tache est bien accompli
      $etat = Etat::whereRaw('num = (select max(`num`) from Etats)')->first();
      if ($rq->etatTache == $etat->num) {
        $TacheToUpdate = Tache::find($tache)->update(["termine"=>1]);
      }
    }

    //prochaine action
    if ($rq->nvAction == 1) {
      $action = new ProchaineAction;
      $action->idCntct = $contact->id;
      $action->action = $rq->action;
      $action->date = $rq->dateNvAct;
      $action->note = $rq->noteNvAct;
      $action->save();
    }

    return back()->with('status', '<div class="alert alert-success alert-dismissible show" ><button type="button" class="close" data-dismiss="alert" aria-label="Close"><spanaria-hidden="true">&times;</span></button>Contact ajouté '.$emailSendResult.'avec succée !</div>');
  }
  public function GrpEmail(Request $rq){
  if($rq->prospects!= null) {
    foreach ($rq->prospects as $prospect) {
    //  return $rq->prospects;
      $contact = new contact ;
      $contact->idUser = Auth::user()->id;
      $contact->idTach = 0;
      $contact->idProsp = $prospect;
      $score = Prospect_score::where('idPros',$prospect)->latest()->first();
    //  return $score;
      $contact->idScore = $score->idScore;//pour garder le meme score (dernier)
      $contact->objet = $rq->titre." -EmailGroupe.";
      $contact->date = date("Y-m-d H:m");
      $contact->remarque = $rq->remarque." -EmailGroupe.";
      $contact->type = "E";
      $contact->save();

      $Reciever = Prospect::where('id',$prospect)->first();
      $this->sendEmail($Reciever,$rq->titre,$rq->remarque);

      $cntct_email = new cntct_email;
      $cntct_email->idCntct = $contact->id;
      $cntct_email->idGrp = 0;
      $cntct_email->contenu = $rq->remarque;
      $cntct_email->envoye = 'oui';
      $cntct_email->save();
    }
   }
   if($rq->idGrp!= null) {
    foreach ($rq->idGrp as $grp) {
       $prospects = Prospect::where('idGrp',$grp)->get();
       foreach ($prospects as $prospect) {
         $contact = new contact ;
         $contact->idUser = Auth::user()->id;
         $contact->idTach = 0;
         $contact->idProsp = $prospect->id;
         $score = Prospect_score::where('idPros',$prospect->id)->latest()->first();
         $contact->idScore = $score->idScore;//pour garder le meme score (dernier)
         $contact->objet = $rq->titre." -EmailGroupe.";
         $contact->date = date("Y-m-d H:m");
         $contact->remarque = $rq->remarque." -EmailGroupe.";
         $contact->type = "E";
         $contact->save();


         $Reciever = Prospect::where('id',$prospect)->first();
         $this->sendEmail($Reciever,$rq->titre,$rq->remarque);

         $cntct_email = new cntct_email;
         $cntct_email->idCntct = $contact->id;
         $cntct_email->idGrp = 0;
         $cntct_email->contenu = $rq->remarque;
         $cntct_email->envoye = 'oui';
         $cntct_email->save();
       }
    }
  }
  if($rq->idChampAct!= null) {
    foreach ($rq->idChampAct as $champActiv) {

       $prospects = Prospect::where('idChampAct',$champActiv)->get();
        // return $prospects;
       foreach ($prospects as $prospect) {
       //  return $rq->prospects;
         $contact = new contact ;
         $contact->idUser = Auth::user()->id;
         $contact->idTach = 0;
         $contact->idProsp = $prospect->id;
         $score = Prospect_score::where('idPros',$prospect->id)->latest()->first();
       //  return $score;
         $contact->idScore = $score->idScore;//pour garder le meme score (dernier)
         $contact->objet = $rq->titre." -EmailGroupe.";
         $contact->date = date("Y-m-d H:m");
         $contact->remarque = $rq->remarque." -EmailGroupe.";
         $contact->type = "E";
         $contact->save();

         $Reciever = Prospect::where('id',$prospect->id)->first();
         $this->sendEmail($Reciever,$rq->titre,$rq->remarque);

         $cntct_email = new cntct_email;
         $cntct_email->idCntct = $contact->id;
         $cntct_email->idGrp = 0;
         $cntct_email->contenu = $rq->remarque;
         $cntct_email->envoye = 'oui';
         $cntct_email->save();
       }
    }
  }
    return back()->with('status', '<div class="alert alert-success alert-dismissible show" ><button type="button" class="close" data-dismiss="alert" aria-label="Close"><spanaria-hidden="true">&times;</span></button>Emails envoyés avec succée !</div>');

  }

  public function delete($id)
  {
    $rowAppel = cntct_appel::where('idCntct',$id)->delete(); //ici je supprime tous les rows qui concernent le contact dont je vient de le supprimer..
    $rowEmail = cntct_email::where('idCntct',$id)->delete(); //ici je supprime tous les rows qui concernent le contact dont je vient de le supprimer..
    $contact = Contact::find($id)->delete();
    return back()->with('status', '<div class="alert alert-success alert-dismissible show" ><button type="button" class="close" data-dismiss="alert" aria-label="Close"><spanaria-hidden="true">&times;</span></button> Supprimé avec succée !</div>');

  }

}
