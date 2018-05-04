@extends('admin')

@section('content')
<section class="content">
  <div class="row">
      <span class="col-md-7"> <h4 onclick="location.href='{{url('taches')}}'" style="cursor:pointer">Taches > Details</h4> </span>
      @if (Auth::user()->type == 1)
        <div class="col-md-4" style="text-align:right;margin-left:25px">
          <button class="btn" title="Annuler cette tache"  data-toggle="modal" data-target="#ouiNonAnnuler" ><i class="fa fa-ban"></i>&nbsp; Annuler</button>
        </div>
      @endif

  </div>
  @if (session('status')){!! session('status') !!}@endif
  <div class="row">
    <div class="col-md-7 ">
      <div class="det-prosp-soc ">
        <h2>{{$tache->titre}} - <span style="background-color:{{$priorite->couleur}}">[ {{$priorite->libPrio}} ]</span></h2>
        <hr/>
        <div class="tache-info"> <i class="fa fa-calendar"></i> &nbsp;{{$tache->dateDebut}} -> {{$tache->dateFin}} </div>
        <hr/>
      <div class="" >
         <label>Remarques </label>
         <div class="form-control" disabled>{!!$tache->remarque!!}</div>
      </div>
    </div>
 </div>
    <div class="col-md-4 det-prosp-soc">
      <h3>Commercial </h3>
      <hr/>
      <div class="tache-info">{{$user->name}} {{$user->prenom}} </div>
      <h3>Prospects concernés </h3>
      <hr/>
      <ul>
        @foreach ($lesProspects  as $prospect)
          <li>{{$prospect->societe}}</li>
        @endforeach
      </ul>
    </div>

</div>
  <div class="row">

    <div class="col-md-6 ">
      <div class="det-prosp-soc ">
        <h3>Derniers échanges <span><a onclick="toutLesContacts()"> -Toute la liste des contacts</a></span></h3>
        <hr/>
        <div id="cntctList5" class="list-group">
          @php
            $i=0;
          @endphp
          @foreach ($contacts as $contact)
            @if ($i != 5)
              <a href="#" class="list-group-item list-group-item-action cntctList5Delete"
                 onclick="chargeUpdateContact( {{$contact->id}},
                                            '{{$contact->type}}',
                                            '{{str_replace("'","\'",$contact->remarque)}}',
                                            '{{$contact->date}}',
                                            '{{str_replace("'","\'",$prospectContact[$i]->societe)}}',
                                            {{$prospectContact[$i]->id}},
                                            {{ json_encode($details[$i]) }},
                                            '{{$userContact[$i]["name"]." ".$userContact[$i]["prenom"]}}',
                                            '{{$scores[$i]->LibScore}}'
                                          )"
                 data-toggle="modal" data-target="#updateContact">
                @if ($contact->type == "A")
                <i class="fa fa-phone"></i> Appel
              @else
                <i class="fa fa-envelope-o"></i> Email
              @endif
              <i class="fa fa-clock-o"></i> {{$contact->date}}   - Par : {{$userContact[$i]["name"]}} {{$userContact[$i]["prenom"]}} </a>
              @php
                $i++;
              @endphp
            @endif

            @endforeach
        </div>
      </div>


    </div>
    <div class="col-md-5 det-prosp-soc">
      <h3>Suivie de tache :</h3>
      <hr/>
      <div class="tache-info">
        <div class="list-group">
          @php
            $k=0;
          @endphp
           @foreach ($HistoriqueEtats as $etat)
             <a href="#" class="list-group-item list-group-item-action"><i class=""></i> {{$etat->LibEtat }} <i class="fa fa-clock-o"></i> {{$etatDate[$k]->created_at }} </a>
             @php
               $k++;
             @endphp
           @endforeach
        </div>
      </div>

      <h3>Produits & Services : </h3>
      <hr/>
      <div class="tache-info">
        <div class="list-group">
           @foreach ($tache_produits as $produit)
             <a href="#" class="list-group-item list-group-item-action"><i class=""></i> {{$produit->LibProd }} <i class="fa fa-clock-o"></i> {{$produit->typePrd }} </a>
           @endforeach
        </div>
      </div>
    </div>

  </div>

  <div class="row">

  </div>

</section><!-- /.content -->

<!--Update tache-->
{{-- @include('layouts.modals.updatetache') --}}

<!--Update Contact-->
@include('layouts.modals.updateContact')

  <div class="modal fade" id="ouiNonAnnuler">
    <div class="modal-dialog modal-lg modal-T1" >
      <div class="modal-content">
        <div class="modal-body">

            <div class="row">
              <div class="col-md-12">
              <h2>Voullez vous vraiment annuler cette tache ?</h2>
              <span>*ceci implique la suppression de toute autre information en relation avec cette tache.</span>
              </div>
            </div>
            <hr/>

            <div class="row">
              <div class="col-md-12">
                <button class="col-md-6 btn btn-info" onclick="location.href='{{url('destroyTache/'.$tache->id)}}'">Oui</button>
                <button class="col-md-6 btn btn-danger" data-dismiss="modal">Non</button>
              </div>
            </div>

        </div>
      </div>
    </div>
  </div>

  <script>
    toutLesContacts = function(){
       $('#cntctList5Delete').remove();

       var toutelaliste = `
                             <?
                               $i=0;
                             ?>
                             @foreach ($contacts as $contact)

                                 <a href="#" class="list-group-item list-group-item-action cntctList5Delete"
                                    onclick="chargeUpdateContact( {{$contact->id}},
                                                               '{{$contact->type}}',
                                                               '{{str_replace("'","\'",$contact->remarque)}}',
                                                               '{{$contact->date}}',
                                                               '{{str_replace("'","\'",$tache->societe)}}',
                                                               {{$tache->id}},
                                                               {{ json_encode($details[$i]) }},
                                                               '{{$userContact[$i]["name"]." ".$userContact[$i]["prenom"]}}',
                                                               '{{$scores[$i]->LibScore}}'
                                                             )"
                                    data-toggle="modal" data-target="#updateContact">
                                   @if ($contact->type == "A")
                                   <i class="fa fa-phone"></i> Appel
                                 @else
                                   <i class="fa fa-envelope-o"></i> Email
                                 @endif
                                 <i class="fa fa-clock-o"></i> {{$contact->date}}   - Par : {{$userContact[$i]["name"]}} {{$userContact[$i]["prenom"]}} </a>
                                 <?
                                   $i++;
                                 ?>

                               @endforeach
                 `;
       $('#cntctList5').html(toutelaliste);
    }
  </script>

@endsection
