<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tache;
use App\Tache_etat;
use App\Tache_produit;
use App\Tache_prospect;
use App\Etat;
use App\Priorite;

use App\User;
use App\Prospect;

use App\Score;
use App\Produit;
use App\Contact;
use Auth;
use App\cntct_appel;
use App\cntct_email;


class TacheController extends Controller
{

   public function get($termine = 0)
   {
      if($this->UserType() == 1){//c'est l'admin
        $taches = Tache::where('termine',$termine)->orderByRaw('id DESC')->get();
      }else{//un simple commercial
        $taches = Tache::where('termine',$termine)->where('idUser',Auth::user()->id)->orderByRaw('id DESC')->get();
      }


      $lesPrioritesTaches=array();
      $usersTaches = array();
      $lesProspects = array();
      $dernierEtat = array();
      $tache_produits = array();
      foreach ($taches as $tache) {
        $user = User::where('id',$tache->idUser)->first();
        $prio = Priorite::where('id',$tache->idPrio)->first();
        $usersTaches[] = $user;
        $lesPrioritesTaches[] =  $prio;

        //pour une tache , elle lui corespend 1 ou plusieur prospect , je doit les recuperer tous dans une liste . et c'est un probleme (29.04 17:40)
        $Tch_prospects = Tache_prospect::where('idTach',$tache->id)->get();
      //  dd($Tch_prospects);
        foreach ($Tch_prospects as $prospect) {
          $lesProspects[] = array($tache->id => Prospect::where('id',$prospect->idProsp)->first());
        }

        //pour chaque tache elle lui corespend une tache dans une moment donne .
        //dans ce cas je doit recuperer le dernier etat ajouter dans la table tache_etats
        //et ceci pour chaque tache
        $tach_etat = Tache_etat::where('idTache',$tache->id)->latest()->first();
        $etat = Etat::where('num',$tach_etat->idEtat)->first();
        $date = $tach_etat->created_at->format('m/d/Y');
        //dd($date);
        $dernierEtat[] =  $etat;

        //pour la vue des comemrcial , je doit afficher les produits/services en question
        $tache_produits[] = Tache_produit::where('idTach',$tache->id)->get();
      }
      //dd($tache_produits);

      //pour l'ajout des contact , je doit envoye tous les info necessaire
      $tousLesEtats = Etat::get();
      $tousLesScores = Score::get();
      $tousLesProduits = Produit::get();


      return view('taches')->with('taches',$taches)
                           ->with('lesPrioritesTaches', $lesPrioritesTaches)
                           ->with('lesProspects', array_values($lesProspects))
                           ->with('dernierEtats',$dernierEtat)
                           ->with('usersTaches', $usersTaches)
                           ->with('etats', $tousLesEtats)
                           ->with('tousLeScores', $tousLesScores)
                           ->with('tache_produits', $tache_produits)
                           ->with('tousLesProduits', $tousLesProduits);
   }

   public function getById($id){

     if($this->UserType() == 1){//dans ce cas , c'est le admin qu'est en ligne , ainsi je lui return toute la liste des contact et je luis permet de consulter les details de cette tache
         $tache = Tache::find($id);
         $tache_contact = Contact::where('idTach',$id)->orderByRaw('id DESC')->get();

     }else{//dans ce cas c'est un user , ainsi , si cette et affecte a lui , donc c ok , sinon je lui permet pas
         // dans le premier cas je ne luis permet de consulter que les contacts qui luis a fait .

         $tache = Tache::where('id',$id)->first();

             if ( $tache->idUser != Auth::user()->id ) {
              return $this->messageDroitAccee();
             }

             $tache_contact = Contact::where('idTach',$id)->where('idUser',Auth::user()->id)->orderByRaw('id DESC')->get();

            }



            $userContact = array();
            $prospectContact = array();
            $details = array();
            $scores = array();
            //pour recuperer les gens/prospect qui ont fait/luis_fait les contact afin de les utiliser dans la fonction chargeUpdateContact
            foreach ($tache_contact as $cntct) {
              $userContact[] = User::find($cntct->idUser);
              $prospectContact[] = Prospect::find($cntct->idProsp);

              //pour les details
              switch ($cntct->type) {

                case 'A':
                  $details[] = cntct_appel::where('idCntct',$cntct->id)->first();//c sur que y'a q'un seul appel pour un contact
                  break;
                case 'E':
                  $details[] = cntct_email::where('idCntct',$cntct->id)->first();//c sur que y'a q'un seul mail pour un contact
                  break;
                  default:return $cntct->type; break;
              }
              $scores[] = Score::find($cntct->idScore);

            }
            //dd($scores);
           $lesProspects = array();
           $user = User::where('id',$tache->idUser)->first();
           $priorite = Priorite::where('id',$tache->idPrio)->first();

           //pour une tache , elle lui corespend 1 ou plusieur prospect , je doit les recuperer tous dans une liste .
           $Tch_prospects = Tache_prospect::where('idTach',$id)->get();
           foreach ($Tch_prospects as $prospect) {
             $lesProspects[] = Prospect::where('id',$prospect->idProsp)->first();
           }

           //pour chaque tache elle lui corespend une tache dans une moment donne .
           //dans ce cas je doit recuperer tous les etats
           $etats = array();
           $tach_etat = Tache_etat::where('idTache',$id)->orderByRaw('created_at DESC')->get();
           foreach ($tach_etat as $tachEtat) {
              $etats[] = Etat::where('num',$tachEtat->idEtat)->first();
           }


           //afficher les produits/services en question
         $tps = Tache_produit::where('idTach',$id)->get();
         foreach ($tps as $tp) {
           $tache_produits[] = Produit::find($tp->idPrd);
         }

         //pour l'ajout des nouveau contact , je doit envoye tous les info necessaire
         $tousLesEtats = Etat::get();
         $tousLesScores = Score::get();
         $tousLesProduits = Produit::get();


         return view('tacheDetails')->with('tache',$tache)
                                    ->with('priorite', $priorite)
                                    ->with('lesProspects', $lesProspects)
                                    ->with('contacts',$tache_contact)
                                    ->with('details',$details)
                                    ->with('scores',$scores)
                                    ->with('userContact',$userContact)
                                    ->with('prospectContact',$prospectContact)
                                    ->with('HistoriqueEtats',$etats)
                                    ->with('etatDate',$tach_etat)
                                    ->with('user', $user)
                                    ->with('etats', $tousLesEtats)
                                    ->with('tousLeScores', $tousLesScores)
                                    ->with('tache_produits', $tache_produits)
                                    ->with('tousLesProduits', $tousLesProduits);

   }


    public function create(Request $rq , $id=0)
    {
      $tache = new Tache ;
      $tache->idUser = $rq->user;
      $tache->idPrio = $rq->prio;
      $tache->titre = $rq->titre;
      $tache->remarque = $rq->remarque;

      //traitement du champ date reçu depuis la $RQ en format string , pour obtenir deux var type date ;
      $d1 = strtotime(substr($rq->date,0,10));
      $dateDebut = date('Y-m-d',$d1);
      $d2 = strtotime(substr($rq->date,13,10));
      $dateFin = date('Y-m-d',$d2);
      //fin de petit traitement des date de debut et fin de la nouvelle taches.

      $tache->dateDebut = $dateDebut;
      $tache->dateFin = $dateFin;
      $tache->termine = 0;
      $tache->save();

      //suivie de deroulement et avancement des taches ..
      $tache_etat = new Tache_etat;
      $etats = etat::orderBy('num', 'ASC')->first(); //l'etat le plus basic
      $tache_etat->idTache = $tache->id;
      $tache_etat->idEtat = $etats->num;
      $tache_etat->save();

      //definition des produits pour ce prospect et cette taches . si ils exists
      foreach ($rq->produits as $produit) {
        $tache_produit = new Tache_produit;
        $tache_produit->idTach = $tache->id;
        $tache_produit->idPrd = $produit;
        $tache_produit->save();
      }

      //definition de/des prospect(s) concerné(s) par cette tache .
      if ($rq->prospects == null) {
        //donc sa concerne un seul prospect
        $tache_prospect = new Tache_prospect;
        $tache_prospect->idTach = $tache->id;
        $tache_prospect->idProsp = $id;
        $tache_prospect->save();
      }else {
        //donc sa concerne plusieur prospects
        foreach ($rq->prospects as $prospect) {
          $tache_prospect = new Tache_prospect;
          $tache_prospect->idTach = $tache->id;
          $tache_prospect->idProsp = $prospect;
          $tache_prospect->save();
        }
      }
      return back()->with('status','<div class="alert alert-success alert-dismissible show" ><button type="button" class="close" data-dismiss="alert" aria-label="Close"><spanaria-hidden="true">&times;</span></button>La <a href="tache/'.$tache->id.'">tache</a> a bien été crée et affecté au <a href="profil/'.$rq->user.'">commercial</a> designé .</div>');

    }

    public function destroy($id){
       //je doit d'abord netoyer tous les trucs qui sont en relation avec cette tache .
       Contact::where('idTach',$id)->update(['idTach'=>0]);
       Tache_etat::where('idTache',$id)->delete();
       Tache_produit::where('idTach',$id)->delete();
       Tache_prospect::where('idTach',$id)->delete();

       //et je la supprime ; B-SLAMA
       Tache::find($id)->delete();
       return $this->get()->with('status','<div class="alert alert-success alert-dismissible show" ><button type="button" class="close" data-dismiss="alert" aria-label="Close"><spanaria-hidden="true">&times;</span></button>La tache est Annulé.</div>');;

    }


    public function Notifications(){
        $mesTaches = Tache::where('idUser',Auth::user()->id)->where('termine',0)->orderByRaw('id DESC')->get();
        // return 222;

        $listeTache = '<a href="#" onclick="loadNotifications()" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i>
                        ';
                        if ($mesTaches->count() > 0) {
                          $listeTache .= '<span class="label label-warning">'.$mesTaches->count().'</span>
                                            </a>
                                            <ul class="dropdown-menu" >
                                              <li class="header">Vous avez '.$mesTaches->count().' tâches non terminées</li>';
                        }else {
                          $listeTache .= '
                                            </a>
                                            <ul class="dropdown-menu" >
                                              <li class="header">Toutes vos tâches sont terminées</li>';
                        }
       $listeTache .= '
                        <li>
                          <!-- inner menu: contains the actual data -->
                          <ul class="menu" id="mesNotifications" >';
                            foreach ($mesTaches as $tache) {
                              $listeTache .= '<li>
                                                <a href="'.url('tache/'.$tache->id).'">
                                                  <i class="fa fa-users text-aqua"></i> '.$tache->titre.'
                                                </a>
                                              </li>';
                            }
           $listeTache .='  </ul>
                          </li>
                          <li class="footer"><a href="taches">Afficher tous</a></li>
                        </ul>';

        return $listeTache;
    }
}
