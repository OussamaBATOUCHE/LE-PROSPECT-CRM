
<div class="modal fade" id="updateprospectModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h3 class="modal-title" style="color:white" >Modification de : {{$prospect->societe}}</h3>
      </div>
      <div class="modal-body">
        <form method="post" action="{{url('updateProspect')}}/{{$prospect->id}}">
          @csrf

          <div class="row">
              <div class="col-md-12">
                <div class="col-md-4">

                  <div class="form-group-title">
                    <i class="fa fa-home"></i>Societe
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control" name="societe" placeholder="Société" required value="{{$prospect->societe}}">
                  </div>
                  <div class="form-group">
                    <textarea name="adresse" class="form-control" rows="4" style="width:100%; " placeholder="Adresse" required>{{$prospect->adresse}}</textarea>
                  </div>
                  <div class="form-group">
                    <input type="number" class="form-control" name="codePostal" placeholder="Code Postal" required value="{{$prospect->codePostal}}">
                  </div>
                  <div class="form-group" id="wilayas">

                  </div>
                  <div class="form-group">
                    <input type="number" class="form-control" name="nbreEmplyes" placeholder="Nombre d'employes" required value="{{$prospect->nbreEmplyes}}">
                  </div>

                </div>
                <div class="col-md-8">
                  <div class="form-group-title">
                    <i class="fa fa-user"></i>Contact
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <select class="form-control" name="genre" required>
                        <option value="" disabled>Genre</option>
                        <option value="M" @if($prospect->genre == "M") selected @endif>M</option>
                        <option value="Mme" @if($prospect->genre == "Mme") selected @endif>Mme</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control" name="nom" placeholder="Nom" required value="{{$prospect->nom}}">
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control" name="prenom" placeholder="Prenom" required value="{{$prospect->prenom}}">
                    </div>
                    <div class="form-group">
                      <input type="email" class="form-control" name="email" placeholder="Email" required value="{{$prospect->email}}">
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control" name="tele1" placeholder="Telephone " maxlength="10" required value="{{$prospect->tele1}}">
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control" name="tele2" placeholder="Telephone 2" maxlength="10" required value="{{$prospect->tele2}}">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <input type="text" class="form-control" name="tele3" placeholder="Telephone 3" maxlength="10" required value="{{$prospect->tele3}}">
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control" name="fax" placeholder="Fax " maxlength="10" required value="{{$prospect->fax}}">
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control" name="skype" placeholder="Skype " required value="{{$prospect->skype}}">
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control" name="siteWeb" placeholder="Site Web (url) " required value="{{$prospect->siteWeb}}">
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
                     <option disabled >Score (Qualification)</option>
                     @foreach ($scores as $scoreL)
                       <option value="{{$scoreL->id}}" @if ($score->id == $scoreL->id) selected @endif>{{$scoreL->LibScore}}</option>
                     @endforeach
                   </select>
                 </div>
                 <div class="form-group">
                   <select class="form-control" name="idGrp" required>
                     <option value="0" disabled selected>Groupe</option>
                     @foreach ($lesGroupes as $groupe)
                       <option value="{{$groupe->id}}" @if ($groupe->id == $monGroupe->id) selected @endif>{{$groupe->LibGrp}}</option>
                     @endforeach
                   </select>
                 </div>
                 <div class="form-group">
                   <select class="form-control" name="idChampAct" required>
                     <option value="0" disabled selected>Champ d'Activite</option>
                     @foreach ($lesChampActiv as $champActiv)
                       <option value="{{$champActiv->id}}" @if ($champActiv->id == $chamActiv->id) selected @endif>{{$champActiv->LibChampAct}}</option>
                     @endforeach
                   </select>
                 </div>
                 <div class="form-group">
                   <select class="form-control select2 select2-hidden-accessible" name="produits[]" required multiple="" data-placeholder="Produits/Services" style="width: 100%;" tabindex="-1" aria-hidden="true">
                     @php $b = ""; @endphp
                     @foreach ($lesProduits as $produitTous)
                       @foreach ($produits as $produit)
                         @if ($produit->id == $produitTous->id) @php $b ="selected"; @endphp @endif
                       @endforeach
                       <option value="{{$produitTous->id}}" @php echo $b ; @endphp >{{$produitTous->LibProd}}</option>
                        @php $b =""; @endphp
                     @endforeach

                   </select>
                 </div>
               </div>
               <div class="col-md-6">
                   <label for="">Remarque & Description</label>
                   <textarea class="form-control" placeholder=". . ." name="description" style="height: 154px;" required>{{$prospect->description}}</textarea>
               </div>
            </div>
          </div>

      </div>
      <div class="modal-footer">

        <button class="btn btn-danger" data-dismiss="modal">Fermer</button>
        <input class="btn btn-success col-md-3" type="submit" value="Modifier">
        </form>
        <button class="btn col-md-1" onclick="location.href='{{url('bloquerProspect/'.$prospect->id)}}'" ><i class="fa fa-trash"></i></button>
      </div>
    </div>
  </div>
</div>

<script>

    $(document).ready(function(){

        var wilayas  = `

        <select class="form-control" name="wilaya" required>
          <option value="0" disabled >Wilaya</option>
          <option value="1" @if ($prospect->wilaya == "0")selected @endif>Adrar</option>
          <option value="2" @if ($prospect->wilaya == "2")selected @endif>Chlef</option>
          <option value="3" @if ($prospect->wilaya == "3")selected @endif>Laghouat</option>
          <option value="4" @if ($prospect->wilaya == "4")selected @endif>Oum El Bouaghi</option>
          <option value="5" @if ($prospect->wilaya == "5")selected @endif>Batna</option>
          <option value="6" @if ($prospect->wilaya == "6")selected @endif>Béjaïa</option>
          <option value="7" @if ($prospect->wilaya == "7")selected @endif>Biskra</option>
          <option value="8" @if ($prospect->wilaya == "8")selected @endif>Béchar</option>
          <option value="9" @if ($prospect->wilaya == "9")selected @endif>Blida</option>
          <option value="10" @if ($prospect->wilaya == "10")selected @endif>Bouira</option>
          <option value="11" @if ($prospect->wilaya == "11")selected @endif>Tamanrasset</option>
          <option value="12" @if ($prospect->wilaya == "12")selected @endif>Tébessa</option>
          <option value="13" @if ($prospect->wilaya == "13")selected @endif>Tlemcen</option>
          <option value="14" @if ($prospect->wilaya == "14")selected @endif>Tiaret</option>
          <option value="15" @if ($prospect->wilaya == "15")selected @endif>Tizi Ouzou</option>
          <option value="16" @if ($prospect->wilaya == "16")selected @endif>Alger</option>
          <option value="17" @if ($prospect->wilaya == "17")selected @endif>Djelfa</option>
          <option value="18" @if ($prospect->wilaya == "18")selected @endif>Jijel</option>
          <option value="19" @if ($prospect->wilaya == "19")selected @endif>Sétif</option>
          <option value="20" @if ($prospect->wilaya == "20")selected @endif>Saïda</option>
          <option value="21" @if ($prospect->wilaya == "21")selected @endif>Skikda</option>
          <option value="22" @if ($prospect->wilaya == "22")selected @endif>Sidi Bel Abbès</option>
          <option value="23" @if ($prospect->wilaya == "23")selected @endif>Annaba</option>
          <option value="24" @if ($prospect->wilaya == "24")selected @endif>Guelma</option>
          <option value="25" @if ($prospect->wilaya == "25")selected @endif>Constantine</option>
          <option value="26" @if ($prospect->wilaya == "26")selected @endif>Médéa</option>
          <option value="27" @if ($prospect->wilaya == "27")selected @endif>Mostaganem</option>
          <option value="28" @if ($prospect->wilaya == "28")selected @endif>M'Sila</option>
          <option value="29" @if ($prospect->wilaya == "29")selected @endif>Mascara</option>
          <option value="30" @if ($prospect->wilaya == "30")selected @endif>Ouargla</option>
          <option value="31" @if ($prospect->wilaya == "31")selected @endif>Oran</option>
          <option value="32" @if ($prospect->wilaya == "32")selected @endif>El Bayadh</option>
          <option value="33" @if ($prospect->wilaya == "33")selected @endif>Illizi</option>
          <option value="34" @if ($prospect->wilaya == "34")selected @endif>Bordj Bou Arreridj</option>
          <option value="35" @if ($prospect->wilaya == "35")selected @endif>Boumerdès</option>
          <option value="36" @if ($prospect->wilaya == "36")selected @endif>El Tarf</option>
          <option value="37" @if ($prospect->wilaya == "37")selected @endif>Tindouf</option>
          <option value="38" @if ($prospect->wilaya == "38")selected @endif>Tissemsilt</option>
          <option value="39" @if ($prospect->wilaya == "39")selected @endif>El Oued</option>
          <option value="40" @if ($prospect->wilaya == "40")selected @endif>Khenchela</option>
          <option value="41" @if ($prospect->wilaya == "41")selected @endif>Souk Ahras</option>
          <option value="42" @if ($prospect->wilaya == "42")selected @endif>Tipaza</option>
          <option value="43" @if ($prospect->wilaya == "43")selected @endif>Mila</option>
          <option value="44" @if ($prospect->wilaya == "44")selected @endif>Aïn Defla</option>
          <option value="45" @if ($prospect->wilaya == "45")selected @endif>Naâma</option>
          <option value="46" @if ($prospect->wilaya == "46")selected @endif>Aïn Témouchent</option>
          <option value="47" @if ($prospect->wilaya == "47")selected @endif>Ghardaïa</option>
          <option value="48" @if ($prospect->wilaya == "48")selected @endif>Relizane</option>
        </select>

        `;
        $('#wilayas').append(wilayas);

        nomWilaya = function(num){
          switch (num) {
            case "1": return "Adrar"; break;
            case "2": return "Chlef"; break;
            case "3": return "Laghouat"; break;
            case "4": return "Oum El Bouaghi"; break;
            case "5": return "Batna"; break;
            case "6": return "Béjaïa"; break;
            case "7": return "Biskra"; break;
            case "8": return "Béchar"; break;
            case "9": return "Blida"; break;
            case "10": return "Bouira"; break;
            case "11": return "Tamanrasset"; break;
            case "12": return "Tébessa"; break;
            case "13": return "Tlemcen"; break;
            case "14": return "Tiaret"; break;
            case "15": return "Tizi Ouzou"; break;
            case "16": return "Alger"; break;
            case "17": return "Djelfa"; break;
            case "18": return "Jijel"; break;
            case "19": return "Sétif"; break;
            case "20": return "Saïda"; break;
            case "21": return "Skikda"; break;
            case "22": return "Sidi Bel Abbès"; break;
            case "23": return "Annaba"; break;
            case "24": return "Guelma"; break;
            case "25": return "Constantine"; break;
            case "26": return "Médéa"; break;
            case "27": return "Mostaganem"; break;
            case "28": return "M'Sila"; break;
            case "29": return "Mascara"; break;
            case "30": return "Ouargla"; break;
            case "31": return "Oran"; break;
            case "32": return "El Bayadh"; break;
            case "33": return "Illizi"; break;
            case "34": return "Bordj Bou Arreridj"; break;
            case "35": return "Boumerdès"; break;
            case "36": return "El Tarf"; break;
            case "37": return "Tindouf"; break;
            case "38": return "Tissemsilt"; break;
            case "39": return "El Oued"; break;
            case "40": return "Khenchela"; break;
            case "41": return "Souk Ahras"; break;
            case "42": return "Tipaza"; break;
            case "43": return "Mila"; break;
            case "44": return "Aïn Defla"; break;
            case "45": return "Naâma"; break;
            case "46": return "Aïn Témouchent"; break;
            case "47": return "Ghardaïa"; break;
            case "48": return "Relizane"; break;

          }
        };

        $('#r-prospect-wilaya').html(nomWilaya($('#r-prospect-wilaya').html()));

    });
</script>
