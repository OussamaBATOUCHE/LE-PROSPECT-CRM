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

class TacheController extends Controller
{

   public function get($termine = 0)
   {
      $taches = Tache::where('termine',$termine)->orderByRaw('id DESC')->get();

      $lesPrioritesTaches=array();
      $usersTaches = array();
      $lesProspects = array();
      $dernierEtat = array();
      foreach ($taches as $tache) {
        $user = User::where('id',$tache->idUser)->first();
        $prio = Priorite::where('id',$tache->idPrio)->first();
        $usersTaches[] = $user;
        $lesPrioritesTaches[] =  $prio;

        //pour une tache , elle lui corespend 1 ou plusieur prospect , je doit les recuperer tous dans une liste . et c'est un probleme (29.04 17:40)
        $Tch_prospects = Tache_prospect::where('idTach',$tache->id)->get();
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
        $dernierEtat[] =  $etat;//je doit savoir quand est ce que cette etat a ete marqué.
      }
      //dd($dernierEtat);

      //pour l'ajout des contact , je doit envoye tous les info necessaire
      $tousLesEtats = Etat::get();
      $tousLesScores = Score::get();

      return view('taches')->with('taches',$taches)
                           ->with('lesPrioritesTaches', $lesPrioritesTaches)
                           ->with('lesProspects', array_values($lesProspects))
                           ->with('dernierEtats',$dernierEtat)
                           ->with('usersTaches', $usersTaches)
                           ->with('etats', $tousLesEtats)
                           ->with('tousLeScores', $tousLesScores);
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
      if ($id != 0) {
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
      return back()->with('status','<div class="alert alert-success alert-dismissible show" ><button type="button" class="close" data-dismiss="alert" aria-label="Close"><spanaria-hidden="true">&times;</span></button>La <a href="taches">tache</a> a bien été crée et affecté au <a href="tacheByCommId/'.$rq->user.'">commercial</a> designé .</div>');

    }
}
