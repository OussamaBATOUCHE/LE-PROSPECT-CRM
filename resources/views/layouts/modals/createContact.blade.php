<div class="modal fade" id="nouveauContact">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h3 class="modal-title" style="color:white" >Nouveau contact - <span id="societe"></span></h3>
      </div>
      <div class="modal-body">

          <div class="row">

            <div class="col-md-12">

                <button id="phone" class=" btn  col-md-6 btn-info" type="button" name="button" onclick="active('phone')"><i class="fa fa-phone"></i> Appel</button>
                <button id="mail" class=" btn col-md-6" type="button" name="button" onclick="active('mail')"><i class="fa fa-envelope-o"></i> Email</button>

            </div>

          </div>
          <hr/>

                <form id="cntct-form" method="post" action="{{url('createContact/0/phone')}}">
                  @csrf
                  <div class="row">
                    <div class="form-group col-md-8">
                      <input type="text" class="form-control" name="objet" placeholder="Titre">
                    </div>

                    <div class="form-group col-md-4">
                      <select class="form-control" name="score" required>
                        <option value="" disabled selected>Score (Qualification)</option>
                        @foreach ($tousLeScores as $score)
                          <option value="{{$score->id}}" >{{$score->LibScore}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-md-4">
                      <label for="">Date de contact</label>
                      <input class="form-control" type="date" name="date" min="2018-01-01"  required>
                    </div>
                    <div id="heure" class="form-group col-md-2">
                      <label for="">Heure</label>
                      <input class="form-control" type="time" name="heure" value="" required>
                    </div>
                    <div class="form-group col-md-2 phone">
                      <label for="">Duree - <a> <i class="fa fa-phone"></i> Simuler</a></label>
                      <input class="form-control" type="time" name="duree" value="" required>
                    </div>
                    <div class="form-group col-md-4 phone">
                      <select class="form-control" name="ES" required>
                        <option value="" disabled selected>Appel</option>
                        <option value="1">Entrant</option>
                        <option value="0">Sortant</option>
                      </select>
                    </div>
                  </div>

                    <div class="row etats"></div>
                    <div class="form-group ">
                      <select id="tchPrds" class="form-control select2 select2-hidden-accessible " name="produits[]" required multiple="" data-placeholder="Produits/Services" style="width: 100%;" tabindex="-1" aria-hidden="true">

                      </select>
                    </div>

                  <div class="form-group">
                      <textarea class="textarea form-control" name="remarque" rows="8" style="width:100%; " placeholder="Contenu ..." required></textarea>
                  </div>
                  <input id="typeCntct" type="hidden" name="type" value="A">

      </div>
      <div class="modal-footer">
        <input id="submit" class="btn btn-primary col-md-4" type="submit" value="Ajouter">
        <input id="js" class="btn btn-success col-md-2" type="submit" value="Enregistrer" name="jsave">
        <button class="btn btn-danger" data-dismiss="modal">Fermer</button>
        </form>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
    $(document).ready(function(){
      $("#js").hide();

      var idP,idT; //had les var c'est pour les utilisé dans les fonctions ou j'ai pas acces au param necessaire
      chargeNouveauContact = function(societe , idProsp , idTache , tach_produits , tousLesProduits) {
        //initialiser les button du top
             $("#phone").addClass("btn-info");
             $("#mail").removeClass("btn-info");
             $("#map").removeClass("btn-info");
        // END sinitialiser les button du top
            $('#societe').html(societe);
            $('#cntct-form').attr('action',"http://localhost:8000/createContact/"+idTache+"/phone/"+idProsp); // le 0 c'est pour le id de tache. je l'envoye auto , au moment de l'appel de fonction
            idP = idProsp;
            idT = idTache;
            //affichage des produits en question
           var b ='';
           var produits ='';

           for(var k=0 ; k < tousLesProduits.length ;k++){

              for(var l = 0 ; l < tach_produits.length ; l++){
              //  console.log(tach_produits[l]['idTach']);
                if (b != "selected" && tach_produits[l]['idPrd'] == tousLesProduits[k]['id'] && tach_produits[l]['idTach'] == idT) {
                  b = "selected";
                }
                produits += '<option value="'+tousLesProduits[k]['id']+'" '+b+'>'+tousLesProduits[k]['LibProd']+'</option>';
                b='';
              }
            }

            $("#tchPrds").html(produits);
            if (idTache != 0 ) {//donc sa concerne une tache

              //je cree une liste d'etat , et l'initialiser avec le dernier etat ->to the controller
              var tacheEtat = `<div class="form-group col-md-12 ">
                                <select class="form-control" name="etatTache" required style="background-color:#4bc1f0">
                                  <option value="" disabled selected>Etat de Tache</option>
                                  @foreach ($etats as $etat)
                                    <option value="{{$etat->num}}" >{{$etat->LibEtat}}</option>
                                  @endforeach
                                </select>
                              </div>`;
              if($(".etats").html() == ''){ // if the DOM element doasn't exist
                $(".etats").html(tacheEtat);
              }


            }
      };

      active = function(button){
          $("#"+button).addClass("btn-info");
          $("#"+button+"-form").show();
          $('#cntct-form').attr('action',"http://localhost:8000/createContact/"+idT+"/"+button+"/"+idP);
          if (button == "phone") {
            $("#map").removeClass("btn-info");  $(".terain").remove();
            $("#mail").removeClass("btn-info"); $(".mail").remove(); $("#js").hide();

            var phone_content = `
            <div class="form-group col-md-2 phone">
              <label for="">Duree - <a> <i class="fa fa-phone"></i> Simuler</a></label>
              <input class="form-control" type="time" name="" value="">
            </div>
            <div class="form-group col-md-4 phone">
              <select class="form-control" name="ES" required>
                <option value="" disabled selected>Appel</option>
                <option value="1">Entrant</option>
                <option value="0">Sortant</option>
              </select>
            </div>
                          `;
              if($(".phone").length == 0){ // if the DOM element don't exist
                $("#heure").after(phone_content);
              }

              $("#submit").attr('value','Ajouter');

          }else{
            $("#map").removeClass("btn-info");   $(".terain").remove();
            $("#phone").removeClass("btn-info"); $(".phone").remove();

            $("#submit").attr('value','Envoyer & Enregisrer');
            $("#js").show();

          }
      };


         $("#phone").click(function(){
             $("#typeCntct").val("A");
         });
         $("#mail").click(function(){
             $("#typeCntct").val("E");
         });

    });


</script>
