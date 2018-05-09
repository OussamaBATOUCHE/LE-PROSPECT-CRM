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

use App\Contact;
use App\Message;


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
                                           'poste'=>$rq->poste,
                                           'bloque'=>0
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
                                           'bloque'=>0,
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

        public function getAllUsers(){

          $users = User::get();
          $list ='';
          foreach ($users as $user) {
           $list .= '
                       <tr>
                         <td>'.$user->id.'</td>
                         <td><a href="'.url('profil/'.$user->id).'">'.$user->name.'</a></td>
                         <td>'.$user->email.'</td>
                         <td>'.$user->telephone.'</td>
                         <td>';
                         $tache = Tache::where('idUser',$user->id)->get();
                         $contact = Contact::where('idUser',$user->id)->get();
                         if ($tache->count() == 0 && $contact->count() == 0) {
                           $list .= '<a class="btn btn-danger fa fa-times" title="Supprimer cette utilisateur" href="'.url('deleteUser/'.$user->id).'"></a>';
                         }
                         if ($user->bloque == 0) {
                            $list .= '<a class="btn btn-warning fa fa-ban" title="Bloquer cette utilisateur" href="'.url('bloquerUser/'.$user->id).'"></a>';
                         }else{
                            $list .= '<a class="btn btn-succes fa fa-user" title="Debloquer cette utilisateur" href="'.url('debloquerUser/'.$user->id).'"></a>';
                         }

           $list.='
                         </td>
                       </tr>
                       ';
          }
          return $list;
        }

        public function bloquerUser($id){
          $user = User::find($id);
          $user->update(["bloque"=>1]);
          return back()->with('status', '<div class="alert alert-warning alert-dismissible show" ><button type="button" class="close"data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>L\'Utilisateur <a href="'.url('profil/'.$user->id).'">'.$user->name." ".$user->prenom.'</a> est bloqué.</div>');
        }
        public function debloquerUser($id){
          $user = User::find($id);
          $user->update(["bloque"=>0]);
          return back()->with('status', '<div class="alert alert-warning alert-dismissible show" ><button type="button" class="close"data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>L\'Utilisateur <a href="'.url('profil/'.$user->id).'">'.$user->name." ".$user->prenom.'</a> est debloqué.</div>');
        }
        public function deleteUser($id){
          $tache = Tache::where('idUser',$id)->get();
          $contact = Contact::where('idUser',$id)->get();
          $user = User::find($id);
          if ($tache->count() == 0 && $contact->count() == 0) {
             Message::where('user_id',$user->id)->orWhere('receiver',$user->id)->delete();
             $user->delete();

             $statu = '<div class="alert alert-warning alert-dismissible show" ><button type="button" class="close"data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>L\'Utilisateur '.$user->name." ".$user->prenom.' est supprimé ainsi que tous ces messages et autres dependances.</div>';
          }else{
             $statu = '<div class="alert alert-warning alert-dismissible show" ><button type="button" class="close"data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>L\'Utilisateur '.$user->name." ".$user->prenom.' ne peux pas être supprimé car il a des dependances.</div>';
          }

          return back()->with('status', $statu);
        }


        public function createUser(Request $data)
        {

            User::create([
                'name' => strtoupper($data['name']),
                'prenom' => ucfirst(strtolower($data['prenom'])),
                'email' => $data['email'],
                'adresse' => $data['adresse'],
                'telephone' => $data['telephone'],
                'type' => $data['type'],
                'poste' => $data['poste'],
                'bloque' => 0,
                'password' => Hash::make($data['password']),
            ]);
            return back()->with('status', '<div class="alert alert-success alert-dismissible show" ><button type="button" class="close"data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Un nouveau utilisateur a bien été crée.</div>');
        }
       public function directEmail(Request $rq){

         $this->sendEmail($rq,$rq->subject,$rq->msg);
         return back()->with('status', '<div class="alert alert-success alert-dismissible show" ><button type="button" class="close"data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Votre email a bien été envoyé.</div>');

       }



        public function sendEmail($rq,$titre,$msg)
        {

          Mail::send('emails.template' , ['msg'=>$msg] , function ($m) use($rq,$titre) {
              $m->from('prspection@fecomit.com');

              $m->to($rq->email, $rq->name)->subject($titre);
          });

        }


        //state

        public function mes_taches_finis($id){
            $tacheMe = Tache::where('idUser',$id)->get();
            return $tacheMe->count();
        }
        public function mes_emails($id){
          $emailMe = contact::where('idUser',$id)->where('type',"E")->get();
          return $emailMe->count();
        }
        public function mes_appels($id){
          $appelMe = contact::where('idUser',$id)->where('type',"A")->get();
          return $appelMe->count();
        }


}
