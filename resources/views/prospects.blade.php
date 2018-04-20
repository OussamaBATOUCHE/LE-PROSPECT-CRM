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
      <a class="btn btn-warning" ><i class="fa fa-search"></i>&nbsp; Filtrer</a>
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
                <th>Comemrcial</th>
                <th>Code Prospect</th>
                <th>Societé</th>
                <th>Score</th>
                <th>Contact</th>
                <th>Categorie</th>
                <th>Echange</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th>12</th>
                <th>oussama BATOUCHE</th>
                <th>08.16.0380/17</th>
                <th><a href="#" data-toggle="popover" title="Koonouz Store" data-content="voici la toute dernier remarque sur ce prospect ... " title="Free Web tutorials">Koonouz Store</a> <span style="color:#848484;"><br/> 12 Rue mohamed fellah <br/> 16026 Alger</span></th>
                <th style="background-color:#60ce4c;font-size: 25px;color: white;">4</th>
                <th>BENOTHMAN Yasmin<span style="color:#848484;"><br/> administration@koonouz.com <br/> 06.65.67.49.43</span></th>
                <th>Marketing digital</th>
                <th>
                  <a class="btn btn-info col"><i class="fa fa-plus-square"></i></a>
                  <a class="btn btn-info col"><i class="fa fa-calendar"></i></a>
                </th>
              </tr>
              <tr>
                <th>34</th>
                <th>Kamel BENSAIB</th>
                <th>06.18.0706/18</th>
                <th><a href="#" data-toggle="popover" data-trigger="hover"  title="SULTAN Hotel" data-content="voici la toute dernier remarque sur ce prospect ... ">SULTAN Hotel</a> <span style="color:#848484;"><br/> 12 Rue salim merabet <br/> 16056 Alger</span></th>
                <th style="background-color:#ffc440; font-size: 25px;color: white;">2</th>
                <th>MALKI Amine<span style="color:#848484;"><br/> contact@sultanHotel.com <br/> 02.14.56.73.02</span></th>
                <th>Hotel & restauration</th>
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
                <th>#</th>
                <th>Kamel BENSAIB</th>
                <th>{{$prospect->codeProsp}}</th>
                <th><a href="#" data-toggle="popover" data-trigger="hover"  title="{{$prospect->societe}}" data-content="{{$prospect->description}}">{{$prospect->societe}}</a> <span style="color:#848484;"><br/> {{$prospect->adresse}} <br/> {{$prospect->codePostal}} {{$prospect->wilaya}}</span></th>
                <th style="background-color:{{$DerniersScores[$i]["couleur"]}}; font-size: 25px;color: white;" data-toggle="popover" data-trigger="hover"  title="{{$DerniersScores[$i]["date"]}}" data-content="{{$DerniersScores[$i]["remarque"]}}">{{$DerniersScores[$i]["score"]}}@php $i++; @endphp</th>
                <th>{{$prospect->genre}}.{{$prospect->nom}} {{$prospect->prenom}} <span style="color:#848484;"><br/> {{$prospect->email}} <br/> {{$prospect->tele1}}</span></th>
                <th>Hotel & restauration</th>
                <th>
                  <a class="btn btn-info col"><i class="fa fa-plus-square"></i></a>
                  <a class="btn btn-info col"><i class="fa fa-calendar"></i></a>
                </th>
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
        <h3 class="modal-title" id="addUserModalLabel" style="color:white" >Creation d'un nouveau Prospect</h3>
      </div>
      <div class="modal-body">
        <form method="post" action="createProspect">
          @csrf
          <div class="row">
              <div class="col-md-12">
                <div class="col-md-4">

                  <div class="form-group-title">
                    <i class="fa fa-home"></i>Societe
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control" name="societe" placeholder="Société" required>
                  </div>
                  <div class="form-group">
                    <textarea name="adresse" class="form-control" rows="4" style="width:100%; " placeholder="Adresse" required></textarea>
                  </div>
                  <div class="form-group">
                    <input type="number" class="form-control" name="codePostal" placeholder="Code Postal" required>
                  </div>
                  <div class="form-group" id="wilayas">

                  </div>
                  <div class="form-group">
                    <input type="number" class="form-control" name="nbreEmplyes" placeholder="Nombre d'employes" required>
                  </div>

                </div>
                <div class="col-md-8">
                  <div class="form-group-title">
                    <i class="fa fa-user"></i>Contact
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <select class="form-control" name="genre" required>
                        <option value="" disabled selected>Genre</option>
                        <option value="M">M</option>
                        <option value="Mme">Mme</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control" name="nom" placeholder="Nom" required>
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control" name="prenom" placeholder="Prenom" required>
                    </div>
                    <div class="form-group">
                      <input type="email" class="form-control" name="email" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control" name="tele1" placeholder="Telephone " maxlength="10" required>
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control" name="tele2" placeholder="Telephone 2" maxlength="10" required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <input type="text" class="form-control" name="tele3" placeholder="Telephone 3" maxlength="10" required>
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control" name="fax" placeholder="Fax " maxlength="10" required>
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control" name="skype" placeholder="Skype " required>
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control" name="siteWeb" placeholder="Site Web (url) " required>
                    </div>
                  </div>
                </div>
              </div>
          </div>
          <hr/>

          <div class="row">
            <div class="col-md-12">
               <div class="col-md-6">
                 <div class="form-group">
                   <select class="form-control" name="score" required>
                     <option disabled selected>Score (Qualification)</option>
                     @foreach ($tousLeScores as $score)
                       <option value="{{$score->id}}" >{{$score->LibScore}}</option>
                     @endforeach
                   </select>
                 </div>
                 <div class="form-group">
                   <select class="form-control" name="idGrp" required>
                     <option value="0" disabled selected>Groupe</option>
                     <option value="3">g1</option>
                   </select>
                 </div>
                 <div class="form-group">
                   <select class="form-control" name="idChampAct" required>
                     <option value="0" disabled selected>Champ d'Activite</option>
                     <option value="4">Hotel & restaurant</option>
                     <option value="5">Pharmaceutique</option>
                   </select>
                 </div>
                 <div class="form-group">
                   <select class="form-control" name="produits[]" multiple>
                     <option value="0" disabled selected>Produits</option>
                     <option value="4">Foundouk</option>
                     <option value="5">Kspersky</option>
                     <option value="5">LE PROSPECT</option>
                     <option value="5">Autre</option>
                   </select>
                 </div>
               </div>
               <div class="col-md-6">
                 <div>
                   <textarea class="textarea" placeholder="Remarque ..." name="description"
                       style="width: 100%; height: 150px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" required></textarea>
                 </div>
               </div>
            </div>
          </div>

      </div>
      <div class="modal-footer">
        <button class="btn btn-danger" data-dismiss="modal">Fermer</button>
        <input class="btn btn-success" type="submit" value="Ajouter"></form>
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


<script>
    $(document).ready(function(){
        $('[data-toggle="popover"]').popover({ trigger: "hover" });
    });
</script>

<script>
    $(document).ready(function(){
        var wilayas  = `

        <select class="form-control" name="wilaya">
          <option value="0" disabled selected>Wilaya</option>
          <option value="1">Adrar</option>
          <option value="2">Chlef</option>
          <option value="3">Laghouat</option>
          <option value="4">Oum El Bouaghi</option>
          <option value="5">Batna</option>
          <option value="6">Béjaïa</option>
          <option value="7">Biskra</option>
          <option value="8">Béchar</option>
          <option value="9">Blida</option>
          <option value="10">Bouira</option>
          <option value="11">Tamanrasset</option>
          <option value="12">Tébessa</option>
          <option value="13">Tlemcen</option>
          <option value="14">Tiaret</option>
          <option value="15">Tizi Ouzou</option>
          <option value="16">Alger</option>
          <option value="17">Djelfa</option>
          <option value="18">Jijel</option>
          <option value="19">Sétif</option>
          <option value="20">Saïda</option>
          <option value="21">Skikda</option>
          <option value="22">Sidi Bel Abbès</option>
          <option value="23">Annaba</option>
          <option value="24">Guelma</option>
          <option value="25">Constantine</option>
          <option value="26">Médéa</option>
          <option value="27">Mostaganem</option>
          <option value="28">M'Sila</option>
          <option value="29">Mascara</option>
          <option value="30">Ouargla</option>
          <option value="31">Oran</option>
          <option value="32">El Bayadh</option>
          <option value="33">Illizi</option>
          <option value="34">Bordj Bou Arreridj</option>
          <option value="35">Boumerdès</option>
          <option value="36">El Tarf</option>
          <option value="37">Tindouf</option>
          <option value="38">Tissemsilt</option>
          <option value="39">El Oued</option>
          <option value="40">Khenchela</option>
          <option value="41">Souk Ahras</option>
          <option value="42">Tipaza</option>
          <option value="43">Mila</option>
          <option value="44">Aïn Defla</option>
          <option value="45">Naâma</option>
          <option value="46">Aïn Témouchent</option>
          <option value="47">Ghardaïa</option>
          <option value="48">Relizane</option>
        </select>

        `;
        $('#wilayas').append(wilayas);
    });
</script>

@endsection
