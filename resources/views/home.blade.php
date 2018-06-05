@extends('admin')

@section('content')
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Principal
      <small>menu de controle</small>
    </h1>
  </section>
  @if (session('status')){!! session('status') !!} @endif
  <!-- Main content -->
  <section class="content">
    @if (Auth::user()->type == 0) {{--commercial--}}
      <div style="text-align:center">
        <img src="{{asset('logoV.jpg')}}" alt="" style=" width: 55%;height: 500px;">
      </div>

    @else {{--admin--}}
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3 id="rq-nbPrspct" class="connexion">N/A</h3>

              <p>Prospects</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a class="small-box-footer" title="Prospect ajoutés M:ce Mois , A:cette Annee , T: tous les prospects."><span onclick="location.href='prospects'" class="ouss-links">M.<span id="rq-nbPrspct-M" class="connexion"></span> / A.<span id="rq-nbPrspct-A" class="connexion"></span> / T.<span id="rq-nbPrspct-T" class="connexion"></span></span>
               <br/><span class="ouss-links" onclick="location.href = 'prospectsBloques/1'">Bloqués.<span id="rq-nbPrspct-B" class="connexion"></span></span>
            </a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><span id="rq-tachEnCour" class="connexion"></span> </h3>

              <p>Taches en cour</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="taches" class="small-box-footer" title="Taches terminées M:ce Mois , A:cette Année , T:Nombre totale des taches finis."> Terminé : M.<span id="rq-tachEnCourT-M" class="connexion"></span> / A.<span id="rq-tachEnCourT-A" class="connexion"></span> / T.<span id="rq-tachEnCourT-T" class="connexion"></span></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3 id="rq-nbCntct" class="connexion">N/A</h3>

              <p>Contacts effectués</p>
            </div>
            <div class="icon">
              <i class="fa fa-phone"></i>
            </div>
            <a href="contacts" class="small-box-footer" title="Contacts effectués M:ce Mois E: par Email A:par Appel.">M. <i class="fa fa-envelope"></i> <span id="rq-nbCntctE-M" class="connexion"></span> <i class="fa fa-phone"></i> <span id="rq-nbCntctA-M" class="connexion"></span> <br/>
                                                         A. <i class="fa fa-envelope"></i> <span id="rq-nbCntctE-A" class="connexion"></span> <i class="fa fa-phone"></i> <span id="rq-nbCntctA-A" class="connexion"></span> <br/>
                                                         T. <i class="fa fa-envelope"></i> <span id="rq-nbCntctE-T" class="connexion"></span> <i class="fa fa-phone"></i> <span id="rq-nbCntctA-T" class="connexion"></span>  </a>
          </div>
        </div>
        <!-- ./col -->
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3 id="rq-nbClient" class="connexion">N/A</h3>

              <p>Clients</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="prospectQue/0/2" class="small-box-footer">M.<span id="rq-nbClient-M" class="connexion"></span> / A.<span id="rq-nbClient-A" class="connexion"></span> / T.<span id="rq-nbClient-T" class="connexion"></span></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
      <div class="row">
      <div class="col-md-4">
        <div class="box box-default">
          <div class="box-header with-border">
            <h3 class="box-title">Scores</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="row">
              <div class="col-md-4">
                <div class="chart-responsive">
                  <canvas id="pieChart" height="150"></canvas>
                </div>
                <div id="rq-prsptc"></div>
                <!-- ./chart-responsive -->
              </div>
              <!-- /.col -->
              <div class="col-md-4" style="margin-left: 30%;">
                <ul class="chart-legend clearfix">
                  @foreach ($tousLesScores as $score)
                    <li><i class="fa fa-circle-o" style="color:{{$score->couleur}}"></i> {{$score->LibScore}}</li>
                  @endforeach
                </ul>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.box-body -->
          <div class="box-footer no-padding">
            <ul class="nav nav-pills nav-stacked">
              @foreach ($scorePourcentage as $sp)
                <li><a href="#">{{$sp[0]->LibScore}}
                  <span class="pull-right " style="color:{{$sp[0]->couleur}}"><i class="fa fa-angle-right"></i> {{substr($sp[1],0,5)}}%</span></a>
                </li>
              @endforeach
              <li><a href="#">TOTAL
                <span class="pull-right " style="color:Gray"><i class="fa fa-angle-right"></i> 100% = <span id="totalProsp"></span></span></a>
              </li>
            </ul>
          </div>
          <!-- /.footer -->
        </div>
      </div>
      <div class="col-md-8">

            <!-- TABLE: Commercials Stat -->
            <div class="box box-info">
              <div class="box-header with-border">
                <h3 class="box-title">Commercials</h3>

                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <div class="table-responsive">
                  <table class="table no-margin">
                    <thead>
                    <tr>
                      <th>Nom</th>
                      <th>Prenom</th>
                      <th>Tâches (Terminées)</th>
                      <th>Contacts (Appel - Email)</th>
                    </tr>
                    </thead>
                    <tbody>
                      @foreach ($commercialsStat as $comm)
                        <tr>
                          <td><a href="profil/{{$comm[0]->id}}">{{$comm[0]->name}}</a></td>
                          <td>{{$comm[0]->prenom}}</td>
                          <td>{{$comm[1]}} <span class="label label-success">{{$comm[2]}}</span></td>
                          <td>
                            {{$comm[3]}} -> {{$comm[4]}} - {{$comm[5]}}
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
                <!-- /.table-responsive -->
              </div>
              <!-- /.box-body -->
              <div class="box-footer clearfix">
                <a href="taches" class="btn btn-sm btn-info btn-flat pull-left">Liste des Taches non terminées</a>
                <a href="contacts" class="btn btn-sm btn-default btn-flat pull-right">Liste des Contacts</a>
              </div>
              <!-- /.box-footer -->
            </div>
            <!-- /.box -->
      </div>

    </div>
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-7 connectedSortable">

          <!-- quick email widget -->
          <div class="box box-info">
            <div class="box-header">
              <i class="fa fa-envelope"></i>

              <h3 class="box-title">Email rapide</h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
                <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip"
                        title="Remove">
                  <i class="fa fa-times"></i></button>
              </div>
              <!-- /. tools -->
            </div>
            <div class="box-body">
              <form action="{{url('directEmail')}}" method="POST">
                @csrf
                <div class="form-group">
                  <input type="email" class="form-control" name="email" placeholder="Destinataire :" required>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="subject" placeholder="Sujet">
                </div>
                <div>
                  <textarea class="textarea" name="msg" placeholder="Message"
                      style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" required></textarea>
                </div>

            </div>
            <div class="box-footer clearfix">
              <button type="submit" class="pull-right btn btn-default"  id="sendEmail">Envoyer
                <i class="fa fa-arrow-circle-right"></i></button>
            </div>
            </form>
          </div>

        </section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <section class="col-lg-5 connectedSortable">



          <!-- Calendar -->
          <div class="box box-solid bg-green-gradient">
            <div class="box-header">
              <i class="fa fa-calendar"></i>

              <h3 class="box-title">Calendrier</h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
                <!-- button with a dropdown -->
                <div class="btn-group">
                  <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-bars"></i></button>
                  <ul class="dropdown-menu pull-right" role="menu">
                  <li><a href="#">Ajouter un RDV</a></li>
                    <li><a href="#">Annuler un RDV</a></li>
                    <li class="divider"></li>
                    <li><a href="#">Afficher la version tabulaire</a></li>
                  </ul>
                </div>
                <button type="button" class="btn btn-success btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-success btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                </button>
              </div>
              <!-- /. tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <!--The calendar -->
              <div id="calendar" style="width: 100%"></div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </section>
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

    @endif

  </section>
  <!-- /.content -->

  <script>
  //stat scores
  $("#rq-prsptc").load("scoresStat");
  $("#totalProsp").load('getAllFromProspectTable');

     // top stikers
     //prospects
    $("#rq-nbPrspct").load("nbPrspct");
    $("#rq-nbPrspct-M").load("nbPrspctM");
    $("#rq-nbPrspct-A").load("nbPrspctA");
    $("#rq-nbPrspct-T").load("nbPrspctT");
    $("#rq-nbPrspct-B").load("nbPrspctB");

    //taches
    $("#rq-tachEnCour").load("tachEnCour");
    $("#rq-tachEnCourT-M").load("tachEnCourT_M");
    $("#rq-tachEnCourT-A").load("tachEnCourT_A");
    $("#rq-tachEnCourT-T").load("tachEnCourT_T");

    //contacts
    $("#rq-nbCntct").load("nbCntct");
    $("#rq-nbCntctE-M").load("nbCntctE_M");
    $("#rq-nbCntctA-M").load("nbCntctA_M");
    $("#rq-nbCntctE-A").load("nbCntctE_A");
    $("#rq-nbCntctA-A").load("nbCntctA_A");
    $("#rq-nbCntctE-T").load("nbCntctE_T");
    $("#rq-nbCntctA-T").load("nbCntctA_T");

    //clients
    $("#rq-nbClient").load("nbClient");
    $("#rq-nbClient-M").load("nbClient_M");
    $("#rq-nbClient-A").load("nbClient_A");
    $("#rq-nbClient-T").load("nbClient_T");

    $('.connexion').html("N/A");


  </script>

@endsection
