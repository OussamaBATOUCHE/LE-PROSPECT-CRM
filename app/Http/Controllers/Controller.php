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



class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;




    public function messageDroitAccee()
    {
      return  redirect('home')->with('status',  '<div class="alert alert-danger alert-dismissible show" >
                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                          <span aria-hidden="true">&times;</span>
                                                        </button>
                                                         Acces interdit !
                                                       </div>');
    }

    public function checkAccess()
    {
        return Auth::user()->type;
    }


    public function updateProfile(Request $rq)
        {
          if ($rq->password == "") {
            $user = User::where("id",$rq->id)
                            ->update(
                                   array(
                                           'name' => $rq->name,
                                           'prenom' => $rq->prenom,
                                           'email' => $rq->email,
                                           'adresse' => $rq->adresse,
                                           'telephone' => $rq->telephone,
                                           'type'=>$rq->type
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
                                           'type'=>$rq->type,
                                           'password'=>Hash::make($rq->password)
                                         )
                                   );
          }

          return view('/home')->with('status', '<div class="alert alert-success alert-dismissible show" ><button type="button" class="close"data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> Profil Modifié.</div>');
        }


        public function sendEmail($rq,$titre,$msg)
        {

          Mail::send('emails.template' , ['msg'=>$msg] , function ($m) use($rq,$titre) {
              $m->from('prspection@fecomit.com');

              $m->to('kamatcho1513@gmail.com', $rq->name)->subject($titre);
          });

        }


}
