<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
       $type =0;
       if ($data['type'] == true) {
          $type = 1;
       }
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'type' => $type,
            'password' => Hash::make($data['password']),
        ]);
    }
    /*
    public function update(Request $rq)
    {
      return 3;
      $user = User::where("id",$rq->id)
                      ->update(
                             array(
                                     'name'=>$rq->name,
                                     'email'=>$rq->email,
                                     'type'=>$rq->type,
                                     'password'=>Hash::make($rq->password)
                                   )
                             );
      return view('/home')->with('status', '<div class="alert alert-success alert-dismissible show" ><button type="button" class="close"data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> Utilisateur Modifié.</div>');
    }*/

public function update(Request $request,$user ){

    $data = request()->except(['_token','_method']);
    User::where('id', '=', $user)->update($data);
    
    return view('/home')->with('status', '<div class="alert alert-success alert-dismissible show" ><button type="button" class="close"data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> Utilisateur Modifié.</div>');
}
}
