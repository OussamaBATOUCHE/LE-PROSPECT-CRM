<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


use App\ChampActivite;

class ChampActiviteController extends Controller
{

    public function get()
    {
      if($this->checkAccess()==1){
          $champs = ChampActivite::get();
          return view('champActivite')->with('champs',$champs);
      }else {
       return  $this->messageDroitAccee();
      }
    }

    public function store(){

    	$this->validate(request(),[
    		'LibChampAct'=>'required'
    	]);


		Score::create([
    			'LibChampAct' => request('LibChampAct')
		]);
 
		redirect('/');
    }

    public function update(Request $rq){
        $this->validate(request(),[
            'LibChampAct'=>'required'
        ]);

    }
    
    public function destroy(ChampActivite $champActivite){

    	$champActivite->delete();
    }
}
