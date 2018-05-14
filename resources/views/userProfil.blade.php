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
              <span class="profile-user-img img-responsive img-circle" >{{substr($me->name,0,1)."-".substr($me->prenom,0,1)}}</span>

              <h3 class="profile-username text-center">{{$me->name." ".$me->prenom}}</h3>

              <p class="text-muted text-center">{{$me->poste}}</p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Taches finis</b> <a class="pull-right" id="mes-taches-finis">N/A</a>
                </li>
                <li class="list-group-item">
                  <b>Appels envoyés</b> <a class="pull-right" id="mes-appels">N/A</a>
                </li>
                <li class="list-group-item">
                  <b>Emails envoyés</b> <a class="pull-right" id="mes-emails" key="{{$me->id}}">N/A</a>
                </li>
              </ul>
              @if ($me->bloque == 1)
              <a href="/debloquerUser/{{$me->id}}" class="btn btn-primary btn-block"><b>Debloquer le compte</b></a>
              @endif

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
                        <h3>La liste des taches.</h3>
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
                @if (session('status')){!! session('status') !!}@endif
                <div class="row">
                  <div class="col-xs-12">
                    <div class="box">
                      <div class="box-header ">
                        <h3>La liste des Contacts.</h3>
                      </div>
                      <div class="box-body">
                        <table id="example3" class="table table-bordered table-striped">
                          <thead>
                            <tr>
                              <th>Objet</th>
                              <th>Type</th>
                              <th>Date</th>
                            </tr>
                          </thead>
                          <tbody>
                            @php
                              $i = 0 ;
                            @endphp
                            @foreach($contacts as $contact)
                            <tr>
                              <th><span data-toggle="popover" data-trigger="hover"  title="Remarque" data-content="{{$contact->remarque}}">{{$contact->objet}}</span></th>
                              <th><span >
                                @if ($contact->type == "A")
                                   <i class="fa fa-phone"></i>  - Appel Telephonique
                                @else
                                   <i class="fa fa-envelope"></i>  - @if($detailsCntct[$i]->envoye == "Oui") <i class="fa fa-check-circle"></i> @endif Email
                                @endif </span>
                              </th>
                              <th>{{$contact->date}}</th>

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

              <div class="tab-pane" id="profil">
                <form  method="POST" action="{{ url('updateProfile') }}" class="form-horizontal">
                  @csrf
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Nom</label>

                    <div class="col-sm-10">
                      <input name="name" type="text" class="form-control" id="inputName" placeholder="Name" value="{{$me->name}}">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Prenom</label>

                    <div class="col-sm-10">
                      <input name="prenom" type="text" class="form-control" id="inputName" placeholder="Name" value="{{$me->prenom}}">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="poste" class="col-sm-2 control-label">Poste de travail</label>

                    <div class="col-sm-10">
                      <input name="poste" type="text" class="form-control" id="inputName" placeholder="Poste de travail" value="{{$me->poste}}">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Adresse</label>

                    <div class="col-sm-10">
                      <input name="adresse" type="text" class="form-control" id="inputName" placeholder="Name" value="{{$me->adresse}}">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputExperience" class="col-sm-2 control-label">Telephone</label>

                    <div class="col-sm-10">
                      <input name="telephone" type="number" class="form-control" id="inputExperience" placeholder="Experience" min="0" maxlength="10" value="{{$me->telephone}}">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                    <div class="col-sm-10">
                      <input name="email" type="email" class="form-control" id="inputEmail" placeholder="Email" value="{{$me->email}}">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <div class="checkbox">
                        <label>
                          <input name="type" type="checkbox" @if($me->type == 1) checked  @endif value="1"> Directeur Commercial <a href="#">(prévilèges)</a>
                        </label>
                      </div>
                    </div>
                  </div>
                  <input type="hidden" name="id" value="{{$me->id}}">
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

    <script>
    $(document).ready(function(){
      $('[data-toggle="popover"]').popover({ trigger: "hover" , html: true });
      $("#mes-taches-finis").load('mes_taches_finis/'+$("#mes-emails").attr('key'));
      $("#mes-emails").load('mes_emails/'+$("#mes-emails").attr('key'));
      $("#mes-appels").load('mes_appels/'+$("#mes-emails").attr('key'));
    });
    $(function () {
      $('#example3').DataTable({
        'paging'      : true,
        'lengthChange': true,
        'searching'   : true,
        'ordering'    : false,//pour ne par trier le tableau automatiquement juste change this parameter to false
        'info'        : true,
        'autoWidth'   : true
      });
    });
    </script>

@endsection
