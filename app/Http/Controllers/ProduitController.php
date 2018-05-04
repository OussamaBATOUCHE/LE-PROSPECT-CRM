<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

use App\Produit;
use App\Prospect_produit;

class ProduitController extends Controller
{
 public function get()
    {
      if($this->UserType()==1){
          $produits = Produit::get();
          return view('produits')->with('produits',$produits);
      }else {
       return  $this->messageDroitAccee();
      }
    }

    public function create(Request $rq){

      $produit = new Produit ;
      $produit->LibProd = $rq->LibProd;
      $produit->typePrd = $rq->typePrd;
      $produit->prixPrd = $rq->prixPrd;
  	  $produit->save();
		  return redirect('/produits')->with('status', '<div class="alert alert-success alert-dismissible show" ><button type="button" class="close" data-dismiss="alert" aria-label="Close"><spanaria-hidden="true">&times;</span></button>Ajouté avec succée !</div>');
    }



 public function update(Request $request,$produit ){

    $data = request()->except(['_token','_method']);
    Produit::where('id', '=', $produit)->update($data);
      return redirect('/produits')->with('status', '<div class="alert alert-success alert-dismissible show" ><button type="button" class="close" data-dismiss="alert" aria-label="Close"><spanaria-hidden="true">&times;</span></button>Modifier avec succée !</div>');
    }

    public function destroy($id){
      $row = Prospect_produit::where('idPrd',$id)->delete(); //ici je supprime tous les rows qui concernent le produit dont je vient de le supprimer..
      $produit = Produit::find($id)->delete();
      return redirect('/produits')->with('status', '<div class="alert alert-success alert-dismissible show" ><button type="button" class="close" data-dismiss="alert" aria-label="Close"><spanaria-hidden="true">&times;</span></button>supprimé avec succée !</div>');
    }

}
