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

class ContactController extends Controller
{

  public function get(){
    //verification des droits d'acces
    if($this->UserType()==1){//dans ce cas , c'est le admin qu'est en ligne , ainsi je lui return toute la liste
    $contacts = Contact::orderByRaw('id DESC')->get();
    }else {//dans ce cas c'est un simple commercial , ainsi je luis return sa propre liste de contacte
    $contacts = Contact::where('idUser',Auth::user()->id)->orderByRaw('id DESC')->get();
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

    //dd($taches);
    return view('contacts')->with('contacts',$contacts)
                           ->with('details',$details)
                           ->with('users',$users)
                           ->with('prospects',$prospects)
                           ->with('scores',$scores)
                           ->with('taches',$taches);

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

    return back()->with('status', '<div class="alert alert-success alert-dismissible show" ><button type="button" class="close" data-dismiss="alert" aria-label="Close"><spanaria-hidden="true">&times;</span></button>Contact ajouté '.$emailSendResult.'avec succée !</div>');
  }

  public function delete($id)
  {
    $rowAppel = cntct_appel::where('idCntct',$id)->delete(); //ici je supprime tous les rows qui concernent le contact dont je vient de le supprimer..
    $rowEmail = cntct_email::where('idCntct',$id)->delete(); //ici je supprime tous les rows qui concernent le contact dont je vient de le supprimer..
    $contact = Contact::find($id)->delete();
    return redirect('/prospects')->with('status', '<div class="alert alert-success alert-dismissible show" ><button type="button" class="close" data-dismiss="alert" aria-label="Close"><spanaria-hidden="true">&times;</span></button> Supprimé avec succée !</div>');

  }

}
