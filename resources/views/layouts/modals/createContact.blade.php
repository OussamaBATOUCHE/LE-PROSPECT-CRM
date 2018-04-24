<div class="modal fade" id="nouveauContact">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h3 class="modal-title"  style="color:white" >Nouveau contact - <span id="societe"></span></h3>
      </div>
      <div class="modal-body">

          <div class="row">

            <div class="col-md-12">

                <button id="phone" class=" btn  col-md-4 btn-info" type="button" name="button" onclick="active('phone')"><i class="fa fa-phone"></i> Appel</button>
                <button id="mail" class=" btn col-md-4" type="button" name="button" onclick="active('mail')"><i class="fa fa-envelope-o"></i> Email</button>
                <button id="map" class=" btn col-md-4" type="button" name="button" onclick="active('map')"><i class="fa fa-map"></i> Sur terain</button>

            </div>

          </div>
          <hr/>

                <form id="cntct-form" method="post" action="createContact/0/phone">
                  @csrf
                  <div class="row">
                    <div class="form-group col-md-8">
                      <input type="text" class="form-control" name="titre" placeholder="Titre">
                    </div>

                    <div class="form-group col-md-4">
                      <select class="form-control" name="score" required>
                        <option disabled selected>Score (Qualification)</option>
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
                        <option disabled selected>Appel</option>
                        <option value="1">Entrant</option>
                        <option value="0">Sortant</option>
                      </select>
                    </div>
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

      var idP;
      chargeNouveauContact = function(societe , idProsp) {
            $('#societe').html(societe);
            $('#cntct-form').attr('action',"createContact/0/phone/"+idProsp);
            idP = idProsp;
      };

      active = function(button){
          $("#"+button).addClass("btn-info");
          $("#"+button+"-form").show();
          $('#cntct-form').attr('action',"createContact/0/"+button+"/"+idP);
          if (button == "phone") {
            $("#map").removeClass("btn-info");  $(".terain").remove();
            $("#mail").removeClass("btn-info"); $(".mail").remove(); $("#js").hide();

            var phone_content = `
            <div class="form-group col-md-2 phone">
              <label for="">Duree - <a> <i class="fa fa-phone"></i> Simuler</a></label>
              <input class="form-control" type="time" name="" value="">
            </div>
            <div class="form-group col-md-4 phone">
              <select class="form-control" name="score" required>
                <option disabled selected>Appel</option>
                <option value="[object Object]">Entrant</option>
                <option value="[object Object]">Sortant</option>
              </select>
            </div>
                          `;
              if($(".phone").length == 0){ // if the DOM element don't exist
                $("#heure").after(phone_content);
              }

              $("#submit").attr('value','Ajouter');

          }else if (button == "mail") {
            $("#map").removeClass("btn-info");   $(".terain").remove();
            $("#phone").removeClass("btn-info"); $(".phone").remove();

            $("#submit").attr('value','Envoyer & Enregisrer');
            $("#js").show();

          }else {
            $("#phone").removeClass("btn-info"); $(".phone").remove();
            $("#mail").removeClass("btn-info");  $(".mail").remove(); $("#js").hide();

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
