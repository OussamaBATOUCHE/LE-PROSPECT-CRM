@extends('admin')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Fiche Commercial
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <span class="profile-user-img img-responsive img-circle" >A</span>

              <h3 class="profile-username text-center">{{$me->name." ".$me->prenom}}</h3>

              <p class="text-muted text-center">{{$me->poste}}</p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Taches finis</b> <a class="pull-right">134</a>
                </li>
                <li class="list-group-item">
                  <b>Appels envoyés</b> <a class="pull-right">543</a>
                </li>
                <li class="list-group-item">
                  <b>Emails envoyés</b> <a class="pull-right">13</a>
                </li>
              </ul>

              <a href="#" class="btn btn-primary btn-block"><b>Affecter une tache</b></a>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Informations</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <strong><i class="fa fa-envelope margin-r-5"></i> Email</strong>

              <p class="text-muted">
                {{$me->email}}
              </p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i> Adresse</strong>

              <p class="text-muted">{{$me->adresse}}</p>

              <hr>

              <strong><i class="fa fa-phone margin-r-5"></i> Telephone</strong>

              <p>

                <span class="label label-success">{{$me->telephone}}</span>
              </p>

              <hr>

              <strong><i class="fa fa-file-text-o margin-r-5"></i> Notes</strong>

              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tache" data-toggle="tab" aria-expanded="true">Tâches</a></li>
              <li class=""><a href="#contact" data-toggle="tab" aria-expanded="false">Contacts</a></li>
              <li class=""><a href="#profil" data-toggle="tab" aria-expanded="false">Profile</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tache">
                @if (session('status')){!! session('status') !!}@endif
                <div class="row">
                  <div class="col-xs-12">
                    <div class="box">
                      <div class="box-header ">
                        <a href="{{url('tachesTermine/1')}}" class="btn btn-success"><i class="fa fa-check-circle" style="color:white"></i>&nbsp; Afficher les taches terminées</a>
                        <a href="{{url('taches')}}" class="btn "><i class="fa fa-fire" style="color:blue;font-size:20px;"></i>&nbsp; Toutes les taches</a>
                      </div>
                      <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                          <thead>
                            <tr>
                              <th>Titre</th>
                              <th>Prospect</th>
                              <th>Deadline</th>
                              <th>Etat</th>
                            </tr>
                          </thead>
                          <tbody>
                            @php
                              $i = 0 ;
                            @endphp
                            @foreach($taches as $tache)
                            <tr>
                              <th><span data-toggle="popover" data-trigger="hover"  title="{{$tache->created_at}}" data-content="{{$tache->remarque}}">{{$tache->titre}}</span></th>

                              <th> <ul>
                                <?php
                                $j=0;
                                $arr2= array_column($lesProspects, $tache->id);//pour recuperer les object prospects
                                $arr3= array();
                                $t = 0;

                                while ($j < sizeof($arr2) ) {
                                   //je doit sauvgarder le id de tache afin de bien recuperer les produits.
                                   if ($tache->id != $t) {
                                     $t = $tache->id;

                                   }
                                    echo "<li><a>".$arr2[$j]->societe."</a></li>";

                                  $j++;
                                }
                              ?>
                                  </ul>
                              </th>
                              <th>{{$tache->dateDebut}} jusqu'a {{$tache->dateFin}}</th>
                              <th id="etatTache" Etat="{{$dernierEtats[$i]->num}}">
                                @if ($dernierEtats[$i]->LibEtat == 'Terminé')<i class="fa fa-check-circle" ></i> @endif{{$dernierEtats[$i]->LibEtat}}
                              </th>
                              <?php
                              $j=0;
                              $arr2= array_column($lesProspects, $tache->id);//je peut envoyer cette list directement

                              ?>
                            @php $i++; @endphp
                            @endforeach
                          </tbody>
                          </tfoot>
                        </table>
                      </div><!-- /.box-body -->
                    </div><!-- /.box -->
                  </div><!-- /.col -->
                </div><!-- /.row -->

              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="contact">

              </div>
              <!-- /.tab-pane -->

              <div class="tab-pane" id="profil">
                <form class="form-horizontal">
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Nom</label>

                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="inputName" placeholder="Name">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Prenom</label>

                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="inputName" placeholder="Name">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Adresse</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputName" placeholder="Name">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputExperience" class="col-sm-2 control-label">Telephone</label>

                    <div class="col-sm-10">
                      <input type="number" class="form-control" id="inputExperience" placeholder="Experience">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputSkills" class="col-sm-2 control-label">Skills</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputSkills" placeholder="Skills">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <div class="checkbox">
                        <label>
                          <input type="checkbox"> Directeur Commercial <a href="#">terms and conditions</a>
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-danger">Enregistrer</button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->

@endsection
