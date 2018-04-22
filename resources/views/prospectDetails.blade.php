@extends('admin')

@section('content')
<section class="content">
  <div class="row">
      <span class="col-md-7"> <h4>Prospect > Details</h4> </span>
      <div class="col-md-4" style="text-align:right">
      <a class="btn btn-info " data-toggle="modal" data-target="#addprospectModal" ><i class="fa fa-edit"></i>&nbsp; Modifier</a>
      </div>
  </div>

  <div class="row">
    <div class="col-md-7 ">
      <div class="det-prosp-soc ">
        <h2>KOONOUZ STORE - <span style="background-color:#07d8e2">[Chaud-3]</span></h2>
        <hr/>
        <div class="prospect-info"> <i class="fa fa-map-marker"></i> &nbsp;kouba alger 16024 KOUBA </div>
        <div class="prospect-info"><i class="fa fa-map-signs"></i> ALGER </div>
        <div class="prospect-info"><i class="fa fa-users"></i> 23 Employes </div>
      </div>
      <div class="det-prosp-soc" >
         <label for="h">Remarques </label>
         <textarea class="form-control" rows="2" disabled></textarea>
      </div>
    </div>

    <div class="col-md-4 det-prosp-soc">
      <h3>Contact </h3>
      <hr/>
      <div class="prospect-info"> Mme.BENOTHMAN Yasmin </div>
      <div class="prospect-info"> <i class="fa fa-phone"></i> 1- &nbsp;0553 83 95 77 </div>
      <div class="prospect-info"> <i class="fa fa-phone"></i> 2- &nbsp;0553 83 95 77 </div>
      <div class="prospect-info"> <i class="fa fa-phone"></i> 3- &nbsp;0553 83 95 77 </div>
      <div class="prospect-info"> <i class="fa fa-fax"></i> &nbsp;0213 83 95 77 </div>
      <div class="prospect-info"><i class="fa fa-skype"></i> Koonouz skype </div>
      <div class="prospect-info"><i class="fa fa-at"></i> administration@koonouz.com </div>
      <div class="prospect-info"><i class="fa fa-globe"></i> <a href="">www.koonouzstore.com</a> </div>
    </div>

  </div>
  <div class="row">

    <div class="col-md-6 ">
      <div class="det-prosp-soc ">
        <h3>Derniers échanges </h3>
        <hr/>
        <div class="list-group">
          <a href="#" class="list-group-item list-group-item-action"><i class="fa fa-phone"></i> Appel <i class="fa fa-clock-o"></i> 22.03.2018 15:30   - Par : BENSIAB Kamel </a>
          <a href="#" class="list-group-item list-group-item-action"><i class="fa fa-at"></i> Email <i class="fa fa-clock-o"></i> 12.03.2018 10:00  - Par : AMGHAR Abdennour </a>
          <a href="#" class="list-group-item list-group-item-action"><i class="fa fa-at"></i> Email <i class="fa fa-clock-o"></i> 15.02.2018 10:00   - Par : Directeur Commercial </a>
        </div>
      </div>


    </div>
    <div class="col-md-5 det-prosp-soc">
      <h3>Champ d'activites : <span><a> -Gestion des champs d'activités</a></span></h3>
      <hr/>
      <div class="prospect-info"> Electronique. </div>
      <h3>Groupe : <span><a> -Gestion des groupe</a></span></h3>
      <hr/>
      <div class="prospect-info"> G1. </div>
      <h3>Produits & Services : <span><a> - Gestion des produits/services</a></span></h3>
      <hr/>
      <div class="prospect-info"> G1. </div>
    </div>

  </div>

  <div class="row">

  </div>

</section><!-- /.content -->


@endsection
