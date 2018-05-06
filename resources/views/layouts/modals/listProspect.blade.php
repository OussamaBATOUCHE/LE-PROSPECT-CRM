

<div class="modal fade" id="">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h3 class="modal-title" style="color:white" >Emails en groupe</h3>
      </div>
      <div class="modal-body">
          <hr/>
          <section class="content">
            <div class="row">
              <div class="col-xs-12">
                <div class="box">
                  <div class="box-header">
                    <a id="switchButton" onclick="registerForm()" class="btn btn-info" value="1"><i class="fa fa-user" style="color:white;font-size:20px;"></i>&nbsp; Ajouter un utilisateur</a>
                  </div><!-- /.box-header -->
                    @if (session('status')){!! session('status') !!}@endif
                  <div class="box-body" id="contentUsers">
                    <table  class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Societe</th>
                          <th>Email</th>
                          <th>Telephone</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody id="prspcts">

                      </tbody>
                    </table>
                  </div><!-- /.box-body -->
                </div><!-- /.box -->
              </div><!-- /.col -->
            </div><!-- /.row -->
          </section><!-- /.content -->
      </div>
      <div class="modal-footer">
        <button class="btn btn-danger" data-dismiss="modal">Fermer</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>

  loadPrspcts = function(){
   $('#prspcts').load('/prospectsGetList');
  }
  loadPrspcts();



  registerForm = function (){
    var content;

    if($("#switchButton").html() == '<i class="fa fa-user" style="color:white;font-size:20px;"></i>&nbsp; Ajouter un utilisateur'){//register form
        $("#switchButton").html('<i class="fa fa-list" style="color:white;font-size:20px;"></i>&nbsp; Liste des Utilisateurs');
        content = `<div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8" style="margin-left:20%">
                    <div class="card">
                        <h2 class="card-header" style="padding-left: 20%;">{{ __('Nouveau Utilisateur') }}</h2>
                        <hr/>
                        <div class="card-body">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf

                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nom') }}</label>

                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="prenom" class="col-md-4 col-form-label text-md-right">{{ __('Prénom') }}</label>

                                    <div class="col-md-6">
                                        <input id="prenom" type="text" class="form-control{{ $errors->has('prenom') ? ' is-invalid' : '' }}" name="prenom" value="{{ old('prenom') }}" required >

                                        @if ($errors->has('prenom'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('prenom') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="poste" class="col-md-4 col-form-label text-md-right">{{ __('Poste de travaille') }}</label>

                                    <div class="col-md-6">
                                        <input id="poste" type="text" class="form-control{{ $errors->has('poste') ? ' is-invalid' : '' }}" name="poste" value="{{ old('poste') }}" required autofocus>

                                        @if ($errors->has('poste'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('poste') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="adresse" class="col-md-4 col-form-label text-md-right">{{ __('Adresse') }}</label>

                                    <div class="col-md-6">
                                        <input id="adresse" type="text" class="form-control{{ $errors->has('adresse') ? ' is-invalid' : '' }}" name="adresse" value="{{ old('adresse') }}" required>
                                        @if ($errors->has('adresse'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('adresse') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Telephone') }}</label>

                                    <div class="col-md-6">
                                        <input id="telephone" type="text" class="form-control{{ $errors->has('telephone') ? ' is-invalid' : '' }}" name="telephone" value="{{ old('telephone') }}" required autofocus>

                                        @if ($errors->has('telephone'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('telephone') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Adresse Email') }}</label>

                                    <div class="col-md-6">
                                        <input  type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Mot de passe') }}</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirmer le Mot de passe') }}</label>

                                    <div class="col-md-6">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('Responsabilite') }}</label>
                                    <select class="col-md-6" class="form-control" name="type" required>
                                      <option value="/"></option>
                                      <option value="1">Directeur commercial</option>
                                      <option value="0">Commercial</option>
                                    </select>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4" style="left:45%">
                                        <button type="submit" class="btn btn-info fa fa-user-plus" style="font-size:20px">
                                            Ajouter
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>`;

    }else{

      $("#switchButton").html('<i class="fa fa-user" style="color:white;font-size:20px;"></i>&nbsp; Ajouter un utilisateur');
      content = `
                          <table  class="table table-bordered table-striped">
                            <thead>
                              <tr>
                                <th>#</th>
                                <th>Nom</th>
                                <th>Email</th>
                                <th>Telephone</th>
                                <th></th>
                              </tr>
                            </thead>
                            <tbody id="usrs">

                            </tbody>
                          </table>
                      `;

    
    }
    $("#contentUsers").html(content);
    loadUsers();
  }

</script>
