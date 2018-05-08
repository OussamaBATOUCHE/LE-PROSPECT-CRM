@extends('admin')

@section('content')
<section class="content">
  <div class="row">
      <span class="col-md-7"> <h4 onclick="location.href='{{url('prospects')}}'" style="cursor:pointer">Prospects > Details</h4> </span>
      <div class="col-md-4" style="text-align:right;margin-left:25px">
        @if ($prospect->bloquer == "1")
          <a class="btn btn-danger " title="Debloquer ce prospect"  data-toggle="modal" data-target="#ouiNonDebloque" ><i class="fa fa-edit"></i>&nbsp; Debloquer</a>
        @endif
      <a class="btn btn-info " title="Nouveau contact" onclick="chargeNouveauContact('{{str_replace("'","\'",$prospect->societe)}}',{{$prospect->id}})" data-toggle="modal" data-target="#updateprospectModal" ><i class="fa fa-pencil"></i>&nbsp; Modifier</a>
      </div>
  </div>
  @if (session('status')){!! session('status') !!}@endif
  <div class="row">
    <div class="col-md-7 ">
      <div class="det-prosp-soc ">
        <h2>{{$prospect->societe}} - <span style="background-color:{{$score->couleur}}">[ {{$score->LibScore}} ]</span></h2>
        Produits/Services Achetés :
        @foreach ($clientProduit as $cp)
             - {{$cp[0]->LibProd}}
        @endforeach
        <hr/>
        <div class="prospect-info"> <i class="fa fa-map-marker"></i> &nbsp;{{$prospect->adresse}} {{$prospect->codePostal}} </div>
        <div class="prospect-info"><i class="fa fa-map-signs"></i> <span  id="r-prospect-wilaya">{{$prospect->wilaya}}</span> </div>
        <div class="prospect-info"><i class="fa fa-users"></i> {{$prospect->nbreEmplyes}} Employes </div>
      </div>
      <div class="det-prosp-soc" >
         <label for="h">Remarques </label>
         <textarea class="form-control" rows="4" disabled>{{$prospect->description}}</textarea>
      </div>
    </div>

    <div class="col-md-4 det-prosp-soc">
      <h3>Contact </h3>
      <hr/>
      <div class="prospect-info"> {{$prospect->genre}}.{{$prospect->nom}} {{$prospect->prenom}} </div>
      <div class="prospect-info"> <i class="fa fa-phone"></i> 1- &nbsp;{{$prospect->tele1}} </div>
      <div class="prospect-info"> <i class="fa fa-phone"></i> 2- &nbsp;{{$prospect->tele2}} </div>
      <div class="prospect-info"> <i class="fa fa-phone"></i> 3- &nbsp;{{$prospect->tele3}} </div>
      <div class="prospect-info"> <i class="fa fa-fax"></i> &nbsp;{{$prospect->fax}} </div>
      <div class="prospect-info"><i class="fa fa-skype"></i> {{$prospect->skype}} </div>
      <div class="prospect-info"><i class="fa fa-at"></i> {{$prospect->email}} </div>
      <div class="prospect-info"><i class="fa fa-globe"></i> <a href="http://{{$prospect->siteWeb}}">{{$prospect->siteWeb}}</a> </div>
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
                                            '{{str_replace("'","\'",$prospect->societe)}}',
                                            {{$prospect->id}},
                                            {{ json_encode($cntct_infos[$i]) }},
                                            '{{$userContact[$i]["name"]." ".$userContact[$i]["prenom"]}}',
                                            '{{$score->LibScore}}'
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
      <h3>Champ d'activites : <span><a href="{{url('champActivite')}}"> -Gestion des champs d'activités</a></span></h3>
      <hr/>
      <div class="prospect-info"> {{$chamActiv->LibChampAct}} </div>
      <h3>Groupe : <span><a href="{{url('groupes')}}"> -Gestion des groupe</a></span></h3>
      <hr/>
      <div class="prospect-info"> @if(! $monGroupe) / @else {{$monGroupe->LibGrp}}. @endif </div>
      <h3>Produits & Services : <span><a href="{{url('produits')}}"> - Gestion des produits/services</a></span></h3>
      <hr/>
      <div class="prospect-info">
        <div class="list-group">
           @foreach ($produits as $produit)
             <a href="#" class="list-group-item list-group-item-action"><i class=""></i> {{$produit->LibProd }} <i class="fa fa-clock-o"></i> {{$produit->typePrd }} </a>
           @endforeach
        </div>
      </div>
    </div>

  </div>

  <div class="row">

  </div>

</section><!-- /.content -->

<!--Update Prospect-->
@include('layouts.modals.updateProspect')

<!--Update Contact-->
@include('layouts.modals.updateContact')

  <div class="modal fade" id="ouiNonDebloque">
    <div class="modal-dialog modal-lg modal-T1" >
      <div class="modal-content">
        <div class="modal-body">

            <div class="row">
              <div class="col-md-12">
              <h2>Voullez vous vraiment debloquer ce prospect ?</h2>
              </div>
            </div>
            <hr/>

            <div class="row">
              <div class="col-md-12">
                <button class="col-md-6 btn btn-info" onclick="location.href='{{url('debloquerProspect/'.$prospect->id)}}'">Oui</button>
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
                                                               '{{str_replace("'","\'",$prospect->societe)}}',
                                                               {{$prospect->id}},
                                                               {{ json_encode($cntct_infos[$i]) }},
                                                               '{{$userContact[$i]["name"]." ".$userContact[$i]["prenom"]}}',
                                                               '{{$score->LibScore}}'
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
