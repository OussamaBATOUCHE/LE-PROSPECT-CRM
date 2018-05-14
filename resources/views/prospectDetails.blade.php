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
    <div class="col-md-6">
            <!-- LINE CHART -->
            <div class="box box-info">
              <div class="box-header with-border">
                <h3 class="box-title">Progression du Score</h3>

                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
              </div>
              <div class="box-body">
                <div class="chart">
                  <canvas id="lineChart" style="height: 249px; width: 555px;" width="555" height="249"></canvas>
                </div>
                <span id="infoprsp" numprosp="{{$prospect->id}}"></span>
                <div id="rq-prospect-details-scores" ></div>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->


    </div>
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
  <script>
  //stat scores
  $("#rq-prospect-details-scores").load("scoresStat_prosp/"+$("#infoprsp").attr('numprosp'));
    // $(function () {
    //   var areaChartData = {
    //     labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
    //     datasets: [
    //       {
    //         label               : 'Electronics',
    //         fillColor           : 'rgba(210, 214, 222, 1)',
    //         strokeColor         : 'rgba(210, 214, 222, 1)',
    //         pointColor          : 'rgba(210, 214, 222, 1)',
    //         pointStrokeColor    : '#c1c7d1',
    //         pointHighlightFill  : '#fff',
    //         pointHighlightStroke: 'rgba(220,220,220,1)',
    //         data                : [65, 59, 80, 81, 56, 55, 40]
    //       },
    //       {
    //         label               : 'Digital Goods',
    //         fillColor           : 'rgba(60,141,188,0.9)',
    //         strokeColor         : 'rgba(60,141,188,0.8)',
    //         pointColor          : '#3b8bba',
    //         pointStrokeColor    : 'rgba(60,141,188,1)',
    //         pointHighlightFill  : '#fff',
    //         pointHighlightStroke: 'rgba(60,141,188,1)',
    //         data                : [28, 48, 40, 19, 86, 27, 90]
    //       }
    //     ]
    //   }
    //
    //   var areaChartOptions = {
    //     //Boolean - If we should show the scale at all
    //     showScale               : true,
    //     //Boolean - Whether grid lines are shown across the chart
    //     scaleShowGridLines      : false,
    //     //String - Colour of the grid lines
    //     scaleGridLineColor      : 'rgba(0,0,0,.05)',
    //     //Number - Width of the grid lines
    //     scaleGridLineWidth      : 1,
    //     //Boolean - Whether to show horizontal lines (except X axis)
    //     scaleShowHorizontalLines: true,
    //     //Boolean - Whether to show vertical lines (except Y axis)
    //     scaleShowVerticalLines  : true,
    //     //Boolean - Whether the line is curved between points
    //     bezierCurve             : true,
    //     //Number - Tension of the bezier curve between points
    //     bezierCurveTension      : 0.3,
    //     //Boolean - Whether to show a dot for each point
    //     pointDot                : false,
    //     //Number - Radius of each point dot in pixels
    //     pointDotRadius          : 4,
    //     //Number - Pixel width of point dot stroke
    //     pointDotStrokeWidth     : 1,
    //     //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
    //     pointHitDetectionRadius : 20,
    //     //Boolean - Whether to show a stroke for datasets
    //     datasetStroke           : true,
    //     //Number - Pixel width of dataset stroke
    //     datasetStrokeWidth      : 2,
    //     //Boolean - Whether to fill the dataset with a color
    //     datasetFill             : true,
    //     //String - A legend template
    //     legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].lineColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
    //     //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
    //     maintainAspectRatio     : true,
    //     //Boolean - whether to make the chart responsive to window resizing
    //     responsive              : true
    //   }
    //
    //
    //   //-------------
    //   //- LINE CHART -
    //   //--------------
    //   var lineChartCanvas          = $('#lineChart').get(0).getContext('2d')
    //   var lineChart                = new Chart(lineChartCanvas)
    //   var lineChartOptions         = areaChartOptions
    //   lineChartOptions.datasetFill = false
    //   lineChart.Line(areaChartData, lineChartOptions)
    //
    // })
  </script>

@endsection
