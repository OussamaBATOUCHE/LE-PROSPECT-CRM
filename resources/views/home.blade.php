@extends('admin')

@section('content')
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Principal
      <small>menu de controle</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> principal</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>
  @if (session('status')){!! session('status') !!} @endif
  <!-- Main content -->
  <section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
          <div class="inner">
            <h3 id="rq-nbPrspct">N/A</h3>

            <p>Prospects</p>
          </div>
          <div class="icon">
            <i class="ion ion-bag"></i>
          </div>
          <a href="#" class="small-box-footer">M.12 / A.100 / T.234 <br/>Bloqués.12</a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
          <div class="inner">
            <h3><span id="rq-tachEnCour"></span> </h3>

            <p>Taches en cour</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <a href="#" class="small-box-footer"> Terminé : M.10 / Y.34 / T.120</a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
          <div class="inner">
            <h3 id="rq-nbCntct">N/A</h3>

            <p>Contacts effectués</p>
          </div>
          <div class="icon">
            <i class="fa fa-phone"></i>
          </div>
          <a href="#" class="small-box-footer">M. <i class="fa fa-envelope"></i> 12 <i class="fa fa-phone"></i> 8 <br/>
                                               A. <i class="fa fa-envelope"></i> 12 <i class="fa fa-phone"></i> 8 <br/>
                                               T. <i class="fa fa-envelope"></i> 12 <i class="fa fa-phone"></i> 8  </a>
        </div>
      </div>
      <!-- ./col -->
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
          <div class="inner">
            <h3 id="rq-nbClient">N/A</h3>

            <p>Clients</p>
          </div>
          <div class="icon">
            <i class="ion ion-pie-graph"></i>
          </div>
          <a href="#" class="small-box-footer">M.8 / A.20 / T.210</a>
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
                <span class="pull-right " style="color:{{$sp[0]->couleur}}"><i class="fa fa-angle-down"></i> {{$sp[1]}}%</span></a>
              </li>
            @endforeach
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
              <a href="javascript:void(0)" class="btn btn-sm btn-info btn-flat pull-left">Liste des Taches non terminées</a>
              <a href="javascript:void(0)" class="btn btn-sm btn-default btn-flat pull-right">Liste des Contacts</a>
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
            <form action="#" method="post">
              <div class="form-group">
                <input type="email" class="form-control" name="emailto" placeholder="Destinataire :">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="subject" placeholder="Sujet">
              </div>
              <div>
                <textarea class="textarea" placeholder="Message"
                    style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
              </div>
            </form>
          </div>
          <div class="box-footer clearfix">
            <button type="button" class="pull-right btn btn-default" id="sendEmail">Envoyer
              <i class="fa fa-arrow-circle-right"></i></button>
          </div>
        </div>

      </section>
      <!-- /.Left col -->
      <!-- right col (We are only adding the ID to make the widgets sortable)-->
      <section class="col-lg-5 connectedSortable">



        <!-- Calendar -->
        <div class="box box-solid bg-green-gradient">
          <div class="box-header">
            <i class="fa fa-calendar"></i>

            <h3 class="box-title">Calendar</h3>
            <!-- tools box -->
            <div class="pull-right box-tools">
              <!-- button with a dropdown -->
              <div class="btn-group">
                <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-bars"></i></button>
                <ul class="dropdown-menu pull-right" role="menu">
                  <li><a href="#">Add new event</a></li>
                  <li><a href="#">Clear events</a></li>
                  <li class="divider"></li>
                  <li><a href="#">View calendar</a></li>
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
          <div class="box-footer text-black">
            <div class="row">
              <div class="col-sm-6">
                <!-- Progress bars -->
                <div class="clearfix">
                  <span class="pull-left">Task #1</span>
                  <small class="pull-right">90%</small>
                </div>
                <div class="progress xs">
                  <div class="progress-bar progress-bar-green" style="width: 90%;"></div>
                </div>

                <div class="clearfix">
                  <span class="pull-left">Task #2</span>
                  <small class="pull-right">70%</small>
                </div>
                <div class="progress xs">
                  <div class="progress-bar progress-bar-green" style="width: 70%;"></div>
                </div>
              </div>
              <!-- /.col -->
              <div class="col-sm-6">
                <div class="clearfix">
                  <span class="pull-left">Task #3</span>
                  <small class="pull-right">60%</small>
                </div>
                <div class="progress xs">
                  <div class="progress-bar progress-bar-green" style="width: 60%;"></div>
                </div>

                <div class="clearfix">
                  <span class="pull-left">Task #4</span>
                  <small class="pull-right">40%</small>
                </div>
                <div class="progress xs">
                  <div class="progress-bar progress-bar-green" style="width: 40%;"></div>
                </div>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
        </div>
        <!-- /.box -->

      </section>
      <!-- right col -->
    </div>
    <!-- /.row (main row) -->

  </section>
  <!-- /.content -->

  <script>
     // top stikers
    $("#rq-nbPrspct").load("nbPrspct");
    $("#rq-nbPrspct").html('N/A');
    $("#rq-tachEnCour").load("tachEnCour");
    $("#rq-tachEnCour").html('N/A');
    $("#rq-nbClient").load("nbClient");
    $("#rq-nbClient").html('N/A');
    $("#rq-nbCntct").load("nbCntct");
    $("#rq-nbCntct").html('N/A');
    $("#rq-tachFini").load("tachFini");
    $("#rq-tachFini").html('N/A');


    //stat scores
    $("#rq-prsptc").load("scoresStat");
  </script>

@endsection
