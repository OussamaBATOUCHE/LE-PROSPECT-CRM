@extends('admin')

@section('content')
<section class="content">
  <div style="text-align:right ">
    <a class="btn btn-success" data-toggle="modal" data-target="#addprospectModal" >+ Ajouter</a>
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
                <th>N° Groupe</th>
                <th>N° Champ Activité</th>
                <th>Societé</th>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Wilaya</th>
                <th>commune</th>
                <th>adresse</th>
                <th>email</th>
                <th>email2</th>
                <th>skype</th>
                <th>Tel1</th>
                <th>Tel2</th>
                <th>Tel3</th>
                <th>Fax</th>
                <th>Site Web</th>
                <th>Nombre Employés</th>
                <th>Description</th> 
                <th>Bloquer</th>
                <th>Modifier</th>
                <th>Supprimer</th>
              </tr>
            </thead>
            <tbody>
              @foreach($prospects as $prospect)
              <tr>
                <td>{{$prospect->id}}</td>
                <td>{{$prospect->codeProsp}}</td>
                <td>{{$prospect->idGrp}}</td>
                <td>{{$prospect->idChampAct}}</td>
                <td>{{$prospect->societe}}</td>
                <td>{{$prospect->nom}}</td>
                <td>{{$prospect->prenom}}</td>
                <td>{{$prospect->wilaya}}</td>
                <td>{{$prospect->commune}}</td>
                <td>{{$prospect->adresse}}</td>
                <td>{{$prospect->email}}</td>
                <td>{{$prospect->email2}}</td>
                <td>{{$prospect->skype}}</td>
                <td>{{$prospect->tele1}}</td>
                <td>{{$prospect->tele2}}</td>
                <td>{{$prospect->tele3}}</td>
                <td>{{$prospect->fax}}</td>
                <td>{{$prospect->siteWeb}}</td>
                <td>{{$prospect->nbreEmplyes}}</td>
                <td>{{$prospect->description}}</td>
                <td>{{$prospect->bloquer}}</td>
                @php
                  $codeProsp = str_replace("'",".",$prospect->codeProsp);
                  $idGrp = str_replace("'",".",$prospect->idGrp);
                  $idChampAct = str_replace("'",".",$prospect->idChampAct);
                  $societe = str_replace("'",".",$prospect->societe);
                  $nom = str_replace("'",".",$prospect->nom);
                  $prenom = str_replace("'",".",$prospect->prenom);
                  $wilaya = str_replace("'",".",$prospect->wilaya);
                  $commune = str_replace("'",".",$prospect->commune);
                  $adresse = str_replace("'",".",$prospect->adresse);
                  $email = str_replace("'",".",$prospect->email);
                  $email2 = str_replace("'",".",$prospect->email2);
                  $skype = str_replace("'",".",$prospect->skype);
                  $tele1 = str_replace("'",".",$prospect->tele1);
                  $tele2 = str_replace("'",".",$prospect->tele2);
                  $tele3 = str_replace("'",".",$prospect->tele3);
                  $fax = str_replace("'",".",$prospect->fax);
                  $siteWeb = str_replace("'",".",$prospect->siteWeb);
                  $nbreEmplyes = str_replace("'",".",$prospect->nbreEmplyes);
                  $description = str_replace("'",".",$prospect->description);
                  $bloquer = str_replace("'",".",$prospect->bloquer);
                @endphp
                <td><a class="btn btn-warning fa fa-pencil" onclick="chargeprospect('{{$codeProsp}}','{{$idGrp}}','{{$idChampAct}}','{{$societe}}','{{$nom}}','{{$prenom}}','{{$wilaya}}','{{$commune}}','{{$adresse}}','{{$email}}','{{$email2}}','{{$skype}}','{{$tele1}}','{{$tele2}}','{{$tele3}}','{{$fax}}','{{$siteWeb}}','{{$nbreEmplyes}}','{{$description}}','{{$bloquer}}')" data-toggle="modal" data-target="#updateprospectModal" ></a></td>
                <td><a class="btn btn-danger fa fa-trash" href="{{url('prospect_delete/'.$prospect->id)}}"></a></td>
              </tr>
              @endforeach
            </tbody>
            </tfoot>
          </table>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!-- /.col -->
  </div><!-- /.row -->
</section><!-- /.content -->


<div class="modal fade" id="addprospectModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h3 class="modal-title" id="addUserModalLabel" style="color:white" >Ajouter un prospect</h3>
      </div>
      <div class="modal-body">
        <form method="post" action="createProspect">
          @csrf
          <div class="form-group">
            <label for="codeProsp" class="form-control-label">Code Prospect</label>
            <input type="text" class="form-control" name="codeProsp" required="">
            <label for="idGrp" class="form-control-label">N° Groupe</label>
            <input type="number" name="idGrp" class="form-control" ></input>
            <label for="idChampAct" class="form-control-label">N° Champ Activité</label>
            <input type="number" name="idChampAct" class="form-control" ></input>
            <label for="societe" class="form-control-label">Societé</label>
            <input type="text" name="societe" class="form-control" required></input>
          </div>
          <div class="form-group">
            <label for="nom" class="form-control-label">Nom</label>
            <input type="text" name="nom" class="form-control"></input>
            <label  for="prenom" class="form-control-label">Prenom</label>
            <input type="text" class="form-control" name="prenom">
            <label for="wilaya" class="form-control-label">Wilaya</label>
            <input type="text" class="form-control" name="wilaya" required>
            <label for="commune" class="form-control-label">Comune</label>
            <input type="text" class="form-control" name="commune">
            <label for="adresse" class="form-control-label">Adresse</label>
            <input type="text" class="form-control" name="adresse">
          </div>
          <div class="form-group">
            <label for="email" class="form-control-label">E-Mail</label>
            <input type="text" class="form-control" name="email">
            <label for="email2" class="form-control-label">E-Mail2</label>
            <input type="text" class="form-control" name="email2">
            <label for="skype" class="form-control-label">Skype</label>
            <input type="text" class="form-control" name="skype">
            <label for="tele1" class="form-control-label">Tel1</label>
            <input type="number" class="form-control" name="tele1" required>
            <label for="tele2" class="form-control-label">Tel2</label>
            <input type="number" class="form-control" name="tele2">
            <label for="tele3" class="form-control-label">Tel3</label>
            <input type="number" class="form-control" name="tele3">
            <label for="fax" class="form-control-label">Fax</label>
            <input type="number" class="form-control" name="fax">
            <label for="siteWeb" class="form-control-label">Site Web </label>
            <input type="text" class="form-control" name="siteWeb">
          </div>
          <div class="form-group">
            <label for="nbreEmplyes" class="form-control-label">Nombre Employés</label>
            <input type="number" class="form-control" name="nbreEmplyes">
            <label for="description" class="form-control-label">Description</label>
            <textarea name="description" class="form-control" cols="8"></textarea>
            <input type="checkbox" name="bloquer" value="bloquer">Bloquer
          </div>
          <button class="btn btn-primary" type="submit">Ajouter</button>
        </form>
      </div>
      <div class="modal-footer">
        <button class="btn btn-danger" data-dismiss="modal">Fermer</button>
      </div>
    </div>
  </div>
</div>

@if(!$prospects->isEmpty()){
<div class="modal fade" id="updateprospectModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h3 class="modal-title" id="addUserModalLabel" style="color:white" >Modifier un prospect</h3>
      </div>
      <div class="modal-body">

        <form method="post" action="updateProspect/{{ $prospect->id }}">
          @csrf
          {{ method_field('PATCH') }}
          <div class="form-group">
            <label for="codeProsp" class="form-control-label">Code Prospect</label>
            <input type="text" class="form-control" name="codeProsp" id="codeProsp" required="">
            <label for="idGrp" class="form-control-label">N° Groupe</label>
            <input type="number" name="idGrp" id="idGrp" class="form-control" ></input>
            <label for="idChampAct" class="form-control-label">N° Champ Activité</label>
            <input type="number" name="idChampAct" id="idChampAct" class="form-control" ></input>
            <label for="societe" class="form-control-label">Societé</label>
            <input type="text" name="societe" id="societe" class="form-control" required></input>
          </div>
          <div class="form-group">
            <label for="nom" class="form-control-label">Nom</label>
            <input type="text" name="nom" id="nom" class="form-control"></input>
            <label  for="prenom" class="form-control-label">Prenom</label>
            <input type="text" class="form-control" name="prenom" id="prenom">
            <label for="wilaya" class="form-control-label">Wilaya</label>
            <input type="text" class="form-control" name="wilaya" id="wilaya" required>
            <label for="commune" class="form-control-label">Comune</label>
            <input type="text" class="form-control" name="commune" id="commune">
            <label for="adresse" class="form-control-label">Adresse</label>
            <input type="text" class="form-control" name="adresse" id="adresse">
          </div>
          <div class="form-group">
            <label for="email" class="form-control-label">E-Mail</label>
            <input type="text" class="form-control" name="email" id="email">
            <label for="email2" class="form-control-label">E-Mail2</label>
            <input type="text" class="form-control" name="email2" id="email2">
            <label for="skype" class="form-control-label">Skype</label>
            <input type="text" class="form-control" name="skype" id="skype">
            <label for="tele1" class="form-control-label">Tel1</label>
            <input type="number" class="form-control" name="tele1" id="tele1" required>
            <label for="tele2" class="form-control-label">Tel2</label>
            <input type="number" class="form-control" name="tele2" id="tele2">
            <label for="tele3" class="form-control-label">Tel3</label>
            <input type="number" class="form-control" name="tele3" id="tele3">
            <label for="fax" class="form-control-label">Fax</label>
            <input type="number" class="form-control" name="fax" id="fax">
            <label for="siteWeb" class="form-control-label">Site Web </label>
            <input type="text" class="form-control" name="siteWeb" id="siteWeb">
          </div>
          <div class="form-group">
            <label for="nbreEmplyes" class="form-control-label">Nombre Employés</label>
            <input type="number" class="form-control" name="nbreEmplyes" id="nbreEmplyes">
            <label for="description" class="form-control-label">Description</label>
            <textarea name="description" id="description" class="form-control" cols="8"></textarea>
            <input type="checkbox" name="bloquer" id="bloquer" value="bloquer">Bloquer
          </div>
          <button class="btn btn-primary" type="submit">Ajouter</button>
        </form>
      </div>
      <div class="modal-footer">
        <button class="btn btn-danger" data-dismiss="modal">Fermer</button>
      </div>
    </div>
  </div>
</div>
}@endif

<script>
function chargeprospect(codeProsp,idGrp,idChampAct,societe,nom,prenom,wilaya,commune,adresse,email,email2,skype,tele1,tele2,tele3,fax,siteWeb,nbreEmplyes,description,bloquer) {
  document.getElementById('codeProsp').value=codeProsp;
  document.getElementById('idGrp').value=idGrp;
  document.getElementById('idChampAct').value=idChampAct;
  document.getElementById('societe').value=societe;
  document.getElementById('nom').value=nom;
  document.getElementById('prenom').value=prenom;
  document.getElementById('wilaya').value=wilaya;
  document.getElementById('commune').value=commune;
  document.getElementById('adresse').value=adresse;
  document.getElementById('email').value=email;
  document.getElementById('email2').value=email2;
  document.getElementById('skype').value=skype;
  document.getElementById('tele1').value=tele1;
  document.getElementById('tele2').value=tele2;
  document.getElementById('tele3').value=tele3;
  document.getElementById('fax').value=fax;
  document.getElementById('siteWeb').value=siteWeb;
  document.getElementById('nbreEmplyes').value=nbreEmplyes;
  document.getElementById('description').value=description;
  document.getElementById('bloquer').value=bloquer;
}
</script>
@endsection
