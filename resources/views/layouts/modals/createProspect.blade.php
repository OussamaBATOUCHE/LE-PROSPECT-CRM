
<div class="modal fade" id="addprospectModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h3 class="modal-title" style="color:white" >Creation d'un nouveau Prospect</h3>
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
                    <input type="number" class="form-control" name="codePostal" placeholder="Code Postal" min="1000" >
                  </div>
                  <div class="form-group" id="wilayasP">

                  </div>
                  <div class="form-group">
                    <input type="number" class="form-control" name="nbreEmplyes" placeholder="Nombre d'employes" min="1" >
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
                      <input type="text" class="form-control" name="prenom" placeholder="Prenom" >
                    </div>
                    <div class="form-group">
                      <input type="email" class="form-control" name="email" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control" name="tele1" placeholder="Telephone " maxlength="10" required>
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control" name="tele2" placeholder="Telephone 2" maxlength="10" >
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <input type="text" class="form-control" name="tele3" placeholder="Telephone 3" maxlength="10" >
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control" name="fax" placeholder="Fax " maxlength="10" >
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control" name="skype" placeholder="Skype " >
                    </div>
                    <div class="form-group">
                      <input type="url" class="form-control" name="siteWeb" placeholder="Site Web (url) " >
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
                   <select class="form-control" name="idGrp" >
                     <option value="0" disabled selected>Groupe</option>
                     @foreach ($tousLesGroupes as $groupe)
                       <option value="{{$groupe->id}}" >{{$groupe->LibGrp}}</option>
                     @endforeach
                   </select>
                 </div>
                 <div class="form-group">
                   <select class="form-control" name="idChampAct" required>
                     <option value="0" disabled selected>Champ d'Activite</option>
                     @foreach ($tousLesChampActiv as $champActiv)
                       <option value="{{$champActiv->id}}" >{{$champActiv->LibChampAct}}</option>
                     @endforeach
                   </select>
                 </div>
                 <div class="form-group">
                   <select class="form-control select2 select2-hidden-accessible" name="produits[]" required multiple="" data-placeholder="Produits/Services" style="width: 100%;" tabindex="-1" aria-hidden="true">
                     @foreach ($tousLesProduits as $produit)
                       <option value="{{$produit->id}}" >{{$produit->LibProd}}</option>
                     @endforeach
                   </select>
                 </div>
               </div>
               <div class="col-md-6">
                   <label for="">Remarque & Description</label>
                   <textarea class="form-control" placeholder=". . ." name="description" style="height: 154px;" required></textarea>
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


<script>

    $(document).ready(function(){

        var wilayas  = `

        <select class="form-control" name="wilaya" required>
          <option disabled selected>Wilaya</option>
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
        $('#wilayasP').append(wilayas);
        $('#wilayaF').append(wilayas);
    });
</script>
