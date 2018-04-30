@extends('admin')

@section('content')
<section class="content">
  <div style="text-align:right;float: right">
  <a class="btn btn-info" onclick="" ><i class="fa fa-plus-square"></i>&nbsp; Taches en groupe</a>


  </div>
  <div style="float:left">

  <h3>Taches en cours</h3>
  </div>
  @if (session('status')){!! session('status') !!}@endif
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header " style="clear:both">
          <a class="btn btn-success" data-toggle="modal" data-target="#chargeNouvelleTache" ><i class="fa "></i>&nbsp; Afficher les tache terminées</a>
        </div><!-- /.box-header -->
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Titre</th>
                <th>Priorite</th>
                <th>Prospect</th>
                <th>Deadline</th>
                <th>Etat</th>
                <th>Commrcial</th>
                <th>Contact</th>
              </tr>
            </thead>
            <tbody>
              @php
                $i = 0 ;
              @endphp
              @foreach($taches as $tache)
              <tr>
                <th><span data-toggle="popover" data-trigger="hover"  title="{{$tache->created_at}}" data-content="{{$tache->remarque}}">{{$tache->titre}}</span></th>
                <th style="background-color:{{$lesPrioritesTaches[$i]['couleur']}}" >{{$lesPrioritesTaches[$i]['num']}}-{{$lesPrioritesTaches[$i]['libPrio']}}</th>
                <th> <ul><?php
                  $j=0;
                  $arr2= array_column($lesProspects, $tache->id);//pour recuperer les object prospects
                  while ($j < sizeof($arr2) ) {
                      echo "<li><a title=\"Nouveau contact\" onclick=\"chargeNouveauContact('".$arr2[$j]->societe."',".$arr2[$j]->id.",{$tache->id})\" data-toggle=\"modal\" data-target=\"#nouveauContact\">".$arr2[$j]->societe."</a></li>";

                    $j++;
                  }
                ?>
                    </ul>
                </th>
                <th>{{$tache->dateDebut}} jusqu'a {{$tache->dateFin}}</th>
                <th id="etatTache" Etat="{{$dernierEtats[$i]->num}}">
                  @if ($dernierEtats[$i]->LibEtat == 'Terminé')<i class="fa fa-check-circle" color="green"></i> @endif{{$dernierEtats[$i]->LibEtat}}
                </th>
                <th>
                  {{$usersTaches[$i]->name." ".$usersTaches[$i]->prenom}}
                </th>
                {{--  ici c'est un peut compliquer , je doit faire un contacte pour un groupe de prospects ,
                ce qui fait que je doit cree une liste de prospects et la transmetre comme
                parametre a la fonction chargeNouvrauContact qui elle doit se changer un petit
                peut pour qu'elle puisse traiter une liste de prospect et une tache.--}}
                <?php
                $j=0;
                $arr2= array_column($lesProspects, $tache->id);//je peut envoyer cette list directement

                ?>
                {{-- pour ne pas trop changer sur la fonction(parametre d'entrer), je vais
                envoyé des valuer de base pour les parametre qui je ne pas besoins --}}
                <th><a class="btn btn-info col" ><i class="fa fa-plus-square"></i></a></th>
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

{{-- <!--Nouveau Tache-->
@include('layouts.modals.createTache') --}}

<!--Nouveau Contact-->
@include('layouts.modals.createContact')

<script>


    $(document).ready(function(){
        var allSelected = false;
        $('[data-toggle="popover"]').popover({ trigger: "hover" , html: true }); // and now my popover accept hmtl text ^^

    });


</script>



@endsection
