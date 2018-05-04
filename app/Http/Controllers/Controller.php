<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Auth;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use Mail;


//pour getUserById
use App\Tache;
use App\Tache_prospect;
use App\Tache_etat;
use App\Etat;
use App\Prospect;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;




    public function messageDroitAccee()
    {
      return  back()->with('status',  '<div class="alert alert-danger alert-dismissible show" >
                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                          <span aria-hidden="true">&times;</span>
                                                        </button>
                                                         Acces interdit !
                                                       </div>');
    }

    public function UserType()
    {
        return Auth::user()->type;
    }


    public function updateProfile(Request $rq)
        {
          $type = 0;
          if ($rq->type == 1) {
            $type =1;
          }
          if ($rq->password == "") {
            //return $rq->type;
            $user = User::where("id",$rq->id)
                            ->update(
                                   array(
                                           'name' => $rq->name,
                                           'prenom' => $rq->prenom,
                                           'email' => $rq->email,
                                           'adresse' => $rq->adresse,
                                           'telephone' => $rq->telephone,
                                           'type'=>$type,
                                           'poste'=>$rq->poste
                                         )
                                   );
          }else{
            $user = User::where("id",$rq->id)
                            ->update(
                                   array(
                                           'name' => $rq->name,
                                           'prenom' => $rq->prenom,
                                           'email' => $rq->email,
                                           'adresse' => $rq->adresse,
                                           'telephone' => $rq->telephone,
                                           'type'=>$type,
                                           'poste'=>$rq->poste,
                                           'password'=>Hash::make($rq->password)
                                         )
                                   );
          }

          return back()->with('status', '<div class="alert alert-success alert-dismissible show" ><button type="button" class="close"data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> Profil Modifié.</div>');
        }

        public function getUserById($id){
          //verification des droits d'acces
          if($this->UserType()==1){

              $taches = Tache::where('idUser',$id)->orderByRaw('id DESC')->get();


              $lesProspects = array();
              $dernierEtat = array();

              foreach ($taches as $tache) {
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
                $dernierEtat[] =  $etat;

              }

              $me = User::find($id);

              return view('userProfil')->with('me',$me)
                                       ->with('taches',$taches)
                                       ->with('lesProspects', array_values($lesProspects))
                                       ->with('dernierEtats',$dernierEtat);
           }else {
            return  $this->messageDroitAccee();
           }
        }


        public function sendEmail($rq,$titre,$msg)
        {

          Mail::send('emails.template' , ['msg'=>$msg] , function ($m) use($rq,$titre) {
              $m->from('prspection@fecomit.com');

              $m->to('kamatcho1513@gmail.com', $rq->name)->subject($titre);
          });

        }


}
