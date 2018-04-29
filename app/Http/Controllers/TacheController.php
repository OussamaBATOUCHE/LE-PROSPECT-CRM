<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tache;
use App\Tache_etat;
use App\Tache_produit;
use App\Tache_prospect;
use App\Etat;

class TacheController extends Controller
{
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
      if ($id == 0) {
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
