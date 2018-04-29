@extends('admin')

@section('content')
<section class="content">
  <div style="text-align:right;float: right">
  <a class="btn btn-info" onclick="chargeNouvelleTachePlusieurTache({{$tousLesProduits}})" ><i class="fa fa-plus-square"></i>&nbsp; Taches en groupe</a>


  </div>
  <div style="float:left">

  <h3>Taches en cours</h3>
  </div>
  @if (session('status')){!! session('status') !!}@endif
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header pull-right">
          <a class="btn btn-success" data-toggle="modal" data-target="#chargeNouvelleTache" ><i class="fa fa-plus-square"></i>&nbsp; Ajouter un tache</a>
        </div><!-- /.box-header -->
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Titre</th>
                <th>Priorite</th>
                <th>Prospect</th>
                <th>D.Debut</th>
                <th>D.Fin</th>
                <th>Etat</th>
                <th>Commrcial</th>
                <th> -- </th>
              </tr>
            </thead>
            <tbody>
              @php
                $i = 0 ;
              @endphp
              @foreach($taches as $tache)
              <tr>
                <th>{{$tache->titre}}</th>
                <th style="background-color:{{$infosTache[$i]['couleur']}}" >{{$infosTache[$i]['libPrio']}}-{{$infosTache[$i]['libPrio']}}</th>
                <th class="sub-info"><a href="{{url('detailsTache/'.$tache->id)}}" data-toggle="popover" data-trigger="hover"  title="{{$tache->societe}}" data-content="{{$tache->description}}">{{$tache->societe}}</a> <span><br/> {{$tache->adresse}} <br/> {{$tache->codePostal}} {{$tache->wilaya}}</span></th>
                <th style="background-color:{{$infosProsp[$i]["couleur"]}};" > <span class="text-white">{{$infosProsp[$i]["score"]}}</span> <i class="fa fa-info score-info" data-toggle="popover" data-trigger="hover"  title="{{$infosProsp[$i]["date"]}}" data-content="{{$infosProsp[$i]["remarque"]}}"></i></th>
                <th class="sub-info">{{$tache->genre}}.{{$tache->nom}} {{$tache->prenom}} <span><br/> {{$tache->email}} <br/> {{$tache->tele1}}</span></th>
                <th>{{$infosProsp[$i]["champActiv"]}}</th>
                <th>

                     @if ($infosProsp[$i]["cntct_user"] != "")
                       <a href="" title="Mettre à joure"
                          onclick="chargeUpdateContact( {{$infosProsp[$i]["idDernierCntct"]}},
                                                        '{{$infosProsp[$i]["typeDernierCntct"]}}',
                                                        '{{str_replace("'","\'",$infosProsp[$i]["remarqueDernierCntct"])}}',
                                                        '{{$infosProsp[$i]["date"]}}',
                                                        '{{str_replace("'","\'",$tache->societe)}}',
                                                        {{$tache->id}},
                                                        {{ json_encode($infosProsp[$i]["cntct_info"]) }},
                                                        '{{$infosProsp[$i]["cntct_user"]}}',
                                                        '{{$infosProsp[$i]["scoreLib"]}}'
                                                      )"
                          data-toggle="modal" data-target="#updateContact">
                        {{$infosProsp[$i]["date"]}}
                       </a>
                     @else
                       Aucun Echange
                     @endif

                </th>
                <th>
                  <a class="btn btn-info col" title="Nouveau contact" onclick="chargeNouveauContact('{{str_replace("'","\'",$tache->societe)}}',{{$tache->id}})" data-toggle="modal" data-target="#nouveauContact"><i class="fa fa-plus-square"></i></a>
                  <a class="btn btn-info col" title="Programmer une Tache" onclick="chargeNouvelleTache('{{str_replace("'","\'",$tache->societe)}}',{{$tache->id}} , {{$tousLesProduits}} , {{$produitsPropose}})"  data-toggle="modal" data-target="#nouvelleTache"><i class="fa fa-calendar"></i></a>
                </th>
              @php $i++; @endphp
              @endforeach
            </tbody>
            </tfoot>
          </table>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!-- /.col -->
  </div><!-- /.row -->
</section><!-- /.content -->

<!--Nouveau Tache-->
@include('layouts.modals.createTache')

<!--Nouveau Contact-->
@include('layouts.modals.createContact')

<script>


    $(document).ready(function(){
        var allSelected = false;
        $('[data-toggle="popover"]').popover({ trigger: "hover" , html: true }); // and now my popover accept hmtl text ^^

    });


</script>



@endsection
