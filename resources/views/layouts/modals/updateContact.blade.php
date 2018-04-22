<div class="modal fade" id="updateContact">
  <div class="modal-dialog modal-lg modal-T1" >
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h3 class="modal-title" style="color:white" ><span id="up-cntct-dateDeCntct"></span> : <span id="up-cntct-societe"></span></h3>
      </div>
      <div class="modal-body">

          <div class="row">
              <span class="col-md-3">TYPE <span id="up-cntct-type"> </span></span>
              <span id="up-cntct-date" class="col-md-3">DATE <br/><b>12-12-2019 15:30</b></span>

          </div>
          <hr/>
          <div class="row">
              <span class="col-md-3">COMMERCIAL : <br/><b id="up-cntct-commercial"><i class="fa fa-user"></i> </b></span>
              <span class="col-md-3">SCORE : <br/><b id="up-cntct-score"></b></span>
          </div>
          <hr/>
          <div class="form-group">
            <label>Remarques :</label>
              <div class="textarea up-cntct-remarque" contenteditable style="background:#e8e8e8; padding:5px; width:100%; height:80px;" ></div>
          </div>

      </div>
      <div class="modal-footer">
        <button id="" class="btn  col-md-1" type="submit" ><i class="fa fa-trash"></i></button>
        <button id="" class="btn btn-success col-md-1" type="submit"><i class="fa fa-pencil"></i></button>
        <button class="btn btn-danger" data-dismiss="modal">Fermer</button>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
    $(document).ready(function(){

      var idP;
      chargeUpdateContact = function(typeContact , date , societe , idProsp , cntct_info , cntct_user , score ) {
            //alert(cntct_info["contenu"]);
            //les champs qui ne change pas
            $('#up-cntct-dateDeCntct').html(date);
            $('#up-cntct-societe').html(societe);
            $('#up-cntct-date > b').html(date);
            $('#up-cntct-commercial > i').html(" "+cntct_user);
            $('#up-cntct-score').html(" "+score);



            //si email donc on doit supprimer les champs de contact appel
            if(typeContact == "E"){
              alert("E");
              $('.up-cntct-remarque').html(cntct_info["contenu"]);//contenu pour les emails
              $(".up-cntct-phone").remove();

              $("#up-cntct-type").html(`<br/><b><i class="fa fa-envelope-o"></i> Email </b> `+cntct_info["envoye"]);

            }else if (typeContact == "A") {
              alert("A");
              $(".up-cntct-mail").remove();
              var typeAppel=" <- Entrant";
              if(cntct_info["entrantSortant"]==0) typeAppel = " -> Sortant";
              $("#up-cntct-type").html(`<br/><b><i class="fa fa-phone"></i> Appel </b> `+typeAppel);
              $("#up-cntct-date").after(`<span class="col-md-3 up-cntct-phone">DUREE <br/><b>0h15mn</b></span>`);
            }

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
            $("#mail").removeClass("btn-info");  $(".mail").remove();


          }
      };




    });
    $("#js").hide();
    $( "#js" ).click(function() {
      //$("#submit").attr('name','jsave');
      //$( "#submit" ).trigger( "click" );
    });


</script>
