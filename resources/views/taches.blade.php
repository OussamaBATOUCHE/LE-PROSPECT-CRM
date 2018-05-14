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
        <div class="box-header ">
          <a href="{{url('tachesTermine/1')}}" class="btn "><i class="fa fa-check-circle" style="color:blue;font-size:20px;"></i>&nbsp; Afficher les taches terminées</a>
          <a href="{{url('taches')}}" class="btn "><i class="fa fa-fire" style="color:blue;font-size:20px;"></i>&nbsp; Toutes les taches</a>
        </div>
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
              </tr>
            </thead>
            <tbody>
              @php
                $i = 0 ;
              @endphp
              @foreach($taches as $tache)
              <tr>
                <th><span data-toggle="popover" data-trigger="hover"  title="{{$tache->created_at}}" data-content="{{$tache->remarque}}">{{$tache->titre}}</span>  <a href="{{url('tache/'.$tache->id)}}" title="Details">>></a></th>
                <th><span class="label" style="background-color:{{$lesPrioritesTaches[$i]['couleur']}}">{{$lesPrioritesTaches[$i]['num']}} - {{$lesPrioritesTaches[$i]['libPrio']}}</span></th>
                <th> <ul>
                  <?php
                  $j=0;
                  $arr2= array_column($lesProspects, $tache->id);//pour recuperer les object prospects
                  $arr3= array();

                  while ($j < sizeof($arr2) ) {
                     $arr3 = $tache_produits[$i];
                      echo "<li><a title=\"Nouveau contact\" onclick=\"chargeNouveauContact('".$arr2[$j]->societe."',".$arr2[$j]->id.",{$tache->id},".str_replace('"',"'",$arr3).",".str_replace('"',"'",$tousLesProduits).")\" data-toggle=\"modal\" data-target=\"#nouveauContact\">".$arr2[$j]->societe."</a></li>";
                    $j++;
                  }
                ?>
                    </ul>
                </th>
                <th>{{$tache->dateDebut}} jusqu'a {{$tache->dateFin}}</th>
                <th>
                  @if ($dernierEtats[$i]->LibEtat == 'Terminé')<i class="fa fa-check-circle" ></i> @endif{{$dernierEtats[$i]->LibEtat}}
                </th>
                <th><a href="profil/{{$usersTaches[$i]->id}}">
                  {{$usersTaches[$i]->name." ".$usersTaches[$i]->prenom}}
                    </a>
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

<!--Nouveau Contact-->
@include('layouts.modals.createContact')

<script>


    $(document).ready(function(){
        var allSelected = false;
        $('[data-toggle="popover"]').popover({ trigger: "hover" , html: true }); // and now my popover accept hmtl text ^^

    });


</script>



@endsection
