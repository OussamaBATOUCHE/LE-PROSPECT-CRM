<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Auth;

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

}
