@extends('admin')

@section('content')
<section class="content">
  <div style="text-align:right;float: right">
  <a class="btn btn-info" onclick="chargeNouvelleTachePlusieurProspect({{$tousLesProduits}})" ><i class="fa fa-plus-square"></i>&nbsp; Taches en groupe</a>
  <a class="btn btn-success" data-toggle="modal" data-target="#addprospectModal" ><i class="fa fa-plus-square"></i>&nbsp; Ajouter un prospect</a>

  </div>
  <div style="float:left">
    <div class="form-group col" style="float:left;margin:5px 5px;">
      <select class="form-control" id="champActivite" name="champActivite">
        <option value="0" disabled selected>Champ d'Activite</option>
        @foreach ($tousLesChampActiv as $champActiv)
          <option value="{{$champActiv->id}}" >{{$champActiv->LibChampAct}}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group col" style="float:left;margin:5px 5px;">
      <select class="form-control" id="group" name="group">
        <option value="0" disabled selected>Groupe</option>
        @foreach ($tousLesGroupes as $groupe)
          <option value="{{$groupe->id}}" >{{$groupe->LibGrp}}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group col" style="float:left;margin:5px 5px;">
      <select class="form-control" id="region" name="region">
        <option value=1"">Adrar</option>
        <option>2</option>
        <option>3</option>
        <option>4</option>
        <option>5</option>
      </select>
    </div>
    <div class="form-group col" style="float:left;margin:5px 5px;">
      <a id="btn-filtrer" class="btn btn-warning" ><i class="fa fa-search"></i>&nbsp; Filtrer</a>
    </div>

  </div>
  @if (session('status')){!! session('status') !!}@endif
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Gestion des prospects</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th><input id="checkAll" type="checkbox"  style="color:red"/></th>
                <th>Code Prospect</th>
                <th>Societé</th>
                <th>Score</th>
                <th>Contact</th>
                <th>Categorie</th>
                <th>Dernier Echange</th>
                <th>Contact</th>
              </tr>
            </thead>
            <tbody>
              {{-- <tr>
              <tr>
                <th><input type="checkbox"/></th>
                <th>06.18.0706/18</th>
                <th><a href="#" data-toggle="popover" data-trigger="hover"  title="SULTAN Hotel" data-content="voici la toute dernier remarque sur ce prospect ... ">SULTAN Hotel</a> <span style="color:#848484;"><br/> 12 Rue salim merabet <br/> 16056 Alger</span></th>
                <th style="background-color:#ffc440; font-size: 25px;color: white;">2</th>
                <th>MALKI Amine<span style="color:#848484;"><br/> contact@sultanHotel.com <br/> 02.14.56.73.02</span></th>
                <th>Hotel & restauration</th>
                <th><a>12-04-2018</a></th>
                <th>
                  <a class="btn btn-info col"><i class="fa fa-plus-square"></i></a>
                  <a class="btn btn-info col"><i class="fa fa-calendar"></i></a>
                </th>
              </tr> --}}
              @php
                $i = 0 ;
              @endphp
              @foreach($prospects as $prospect)
              <tr>
                <th><input class="check" type="checkbox" value="{{$prospect->id}}"/></th>
                <th>{{$prospect->codeProsp}}</th>
                <th class="sub-info"><a href="{{url('detailsProspect/'.$prospect->id)}}" data-toggle="popover" data-trigger="hover"  title="{{$prospect->societe}}" data-content="{{substr($prospect->description,0,50)}}">{{$prospect->societe}}</a> <span><br/> {{$prospect->adresse}} <br/> {{$prospect->codePostal}} {{$prospect->wilaya}}</span></th>
                <th style="background-color:{{$infosProsp[$i]["couleur"]}};" > <span class="text-white">{{$infosProsp[$i]["score"]}}</span> <i class="fa fa-info score-info" data-toggle="popover" data-trigger="hover"  title="{{$infosProsp[$i]["date"]}}" data-content="{{substr($infosProsp[$i]["remarque"],0,60)}}"></i></th>
                <th class="sub-info">{{$prospect->genre}}.{{$prospect->nom}} {{$prospect->prenom}} <span><br/> {{$prospect->email}} <br/> {{$prospect->tele1}}</span></th>
                <th>{{$infosProsp[$i]["champActiv"]}}</th>
                <th>

                     @if ($infosProsp[$i]["cntct_user"] != "")
                       <a href="" title="Details & Mettre à joure"
                          onclick="chargeUpdateContact( {{$infosProsp[$i]["idDernierCntct"]}},
                                                        '{{$infosProsp[$i]["typeDernierCntct"]}}',
                                                        '{{str_replace("'","\'",$infosProsp[$i]["remarqueDernierCntct"])}}',
                                                        '{{$infosProsp[$i]["date"]}}',
                                                        '{{str_replace("'","\'",$prospect->societe)}}',
                                                        {{$prospect->id}},
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
                  <a class="btn btn-info col" title="Nouveau contact" onclick="chargeNouveauContact('{{str_replace("'","\'",$prospect->societe)}}',{{$prospect->id}},0,{{str_replace('"',"'",$produitsPropose)}}, {{str_replace('"',"'",$tousLesProduits)}})" data-toggle="modal" data-target="#nouveauContact"><i class="fa fa-plus-square"></i></a>
                  <a class="btn btn-info col" title="Programmer une Tache" onclick="chargeNouvelleTache('{{str_replace("'","\'",$prospect->societe)}}',{{$prospect->id}} , {{$tousLesProduits}} , {{$produitsPropose}})"  data-toggle="modal" data-target="#nouvelleTache"><i class="fa fa-calendar"></i></a>
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

<!--Nouveau Prospect-->
@include('layouts.modals.createProspect')

<!--Nouveau Contact-->
@include('layouts.modals.createContact')

<!--Lire et Modifier Contact-->
@include('layouts.modals.updateContact')

<!--Nouvelle taches-->
@include('layouts.modals.createTache')

<script>


    $(document).ready(function(){
        var allSelected = false;
        $('[data-toggle="popover"]').popover({ trigger: "hover" , html: true }); // and now my popover accept hmtl text ^^

        $( "#btn-filtrer" ).click(function() {
          $('input[aria-controls="example1"]').val("hotel");
          //alert( "Handler for .click() called." );
        });

        $("#checkAll").click(function() {
          if(allSelected == true ){
            //alert('helo');
            $('.check').each(function(){
              //alert(this.value);
                  this.checked = false;
            });
            allSelected = false;
          }else{
            //alert('kldsjflf');
            $('.check').each(function(){
                this.checked = true;
            });
            allSelected = true;
          }

        });



    });


</script>



@endsection
