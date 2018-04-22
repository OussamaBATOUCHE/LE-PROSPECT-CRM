@extends('admin')

@section('content')
<section class="content">
  <div style="text-align:right;float: right">
  <a class="btn btn-info" data-toggle="modal" data-target="#addprospectModal" ><i class="fa fa-plus-square"></i>&nbsp; Taches en groupe</a>
  <a class="btn btn-success" data-toggle="modal" data-target="#addprospectModal" ><i class="fa fa-plus-square"></i>&nbsp; Ajouter un prospect</a>

  </div>
  <div style="float:left">
    <div class="form-group col" style="float:left;margin:5px 5px;">
      <label for="champActivite">Champ d'Activité</label>
      <select class="form-control" id="champActivite" name="champActivite">
        <option value=1"">1</option>
        <option>2</option>
        <option>3</option>
        <option>4</option>
        <option>5</option>
      </select>
    </div>
    <div class="form-group col" style="float:left;margin:5px 5px;">
      <label for="groupe">Groupe</label>
      <select class="form-control" id="group" name="group">
        <option value=1"">1</option>
        <option>heloooooooo</option>
        <option>3</option>
        <option>4</option>
        <option>5</option>
      </select>
    </div>
    <div class="form-group col" style="float:left;margin:5px 5px;">
      <label for="region">Region</label>
      <select class="form-control" id="region" name="region">
        <option value=1"">1</option>
        <option>2</option>
        <option>3</option>
        <option>4</option>
        <option>5</option>
      </select>
    </div>
    <div class="form-group col" style="float:left;margin:5px 5px;padding-top: 25px;">
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
                <th>#</th>
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
              <tr>
                <th><input type="checkbox"/></th>
                <th>08.16.0380/17</th>
                <th><a href="#" data-toggle="popover" title="Koonouz Store" data-content="voici la toute dernier remarque sur ce prospect ... " title="Free Web tutorials">Koonouz Store</a> <span style="color:#848484;"><br/> 12 Rue mohamed fellah <br/> 16026 Alger</span></th>
                <th style="background-color:#60ce4c;font-size: 25px;color: white;">4</th>
                <th>BENOTHMAN Yasmin<span style="color:#848484;"><br/> administration@koonouz.com <br/> 06.65.67.49.43</span></th>
                <th>Marketing digital</th>
                <th><a>03-04-2018</a></th>
                <th>
                  <a class="btn btn-info col"><i class="fa fa-plus-square"></i></a>
                  <a class="btn btn-info col"><i class="fa fa-calendar"></i></a>
                </th>
              </tr>
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
              </tr>
              @php
                $i = 0 ;
              @endphp
              @foreach($prospects as $prospect)
              <tr>
                <th><input type="checkbox"/></th>
                <th>{{$prospect->codeProsp}}</th>
                <th><a href="detailsProspect/{{$prospect->id}}" data-toggle="popover" data-trigger="hover"  title="{{$prospect->societe}}" data-content="{{$prospect->description}}">{{$prospect->societe}}</a> <span style="color:#848484;"><br/> {{$prospect->adresse}} <br/> {{$prospect->codePostal}} {{$prospect->wilaya}}</span></th>
                <th style="background-color:{{$infosProsp[$i]["couleur"]}};" >{{$infosProsp[$i]["score"]}} <i class="fa fa-info score-info" data-toggle="popover" data-trigger="hover"  title="{{$infosProsp[$i]["date"]}}" data-content="{{$infosProsp[$i]["remarque"]}}"></i></th>
                <th>{{$prospect->genre}}.{{$prospect->nom}} {{$prospect->prenom}} <span style="color:#848484;"><br/> {{$prospect->email}} <br/> {{$prospect->tele1}}</span></th>
                <th>{{$infosProsp[$i]["champActiv"]}}</th>
                <th>

                     @if ($infosProsp[$i]["cntct_user"] != "")
                       <a href="" title="Mettre à joure"
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
                  <a class="btn btn-info col" title="Nouveau contact" onclick="chargeNouveauContact('{{str_replace("'","\'",$prospect->societe)}}',{{$prospect->id}})" data-toggle="modal" data-target="#nouveauContact"><i class="fa fa-plus-square"></i></a>
                  <a class="btn btn-info col" title="Programmer une Tache"><i class="fa fa-calendar"></i></a>
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

<script>


    $(document).ready(function(){
        $('[data-toggle="popover"]').popover({ trigger: "hover" , html: true }); // and now my popover accept hmtl text ^^

        $( "#btn-filtrer" ).click(function() {
          $('input[aria-controls="example1"]').val("hotel");
          //alert( "Handler for .click() called." );
        });

    });


</script>



@endsection
