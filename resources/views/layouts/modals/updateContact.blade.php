<div class="modal fade" id="updateContact">
  <div class="modal-dialog modal-lg modal-T1" >
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h3 class="modal-title" style="color:white" ><span id="up-cntct-dateDeCntct"></span> : <span id="up-cntct-societe"></span></h3>
      </div>
      <div class="modal-body">

          <div class="row">
              <span class="col-md-3">TYPE <span id="up-cntct-type"> </span></span>
              <span class="col-md-3">Date <span id="up-cntct-date"> </span></span>
              <span id="up-cntct-duree" class="col-md-3 up-cntct-phone"></span>
              <span id="up-cntct-etatEmail" class="col-md-3 up-cntct-mail"></span>

          </div>
          <hr/>
          <div class="row">
              <span class="col-md-3">COMMERCIAL : <br/><b id="up-cntct-commercial"><i class="fa fa-user"></i> </b></span>
              <span class="col-md-3">SCORE : <br/><b id="up-cntct-score"></b></span>
              <span class="col-md-6">Prochaine Action : <br/><b id="up-cntct-pa"></b><br/>
                <div class=" up-cntct-notePA" contenteditable style="background:#e8e8e8; padding:5px; width:100%; height:80px;" ></div>
              </span>
          </div>
          <hr/>
          <div class="form-group">
            <label>Remarques :</label>
              <div class="textarea up-cntct-remarque" contenteditable style="background:#e8e8e8; padding:5px; width:100%; height:80px;" ></div>
          </div>

      </div>
      <div class="modal-footer">
        <span id="up-cntct-delete" ></span>

        <button id="" class="btn btn-success col-md-1" type="submit"><i class="fa fa-pencil"></i></button>
        <button class="btn btn-danger" data-dismiss="modal">Fermer</button>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
    $(document).ready(function(){

      var idP;
      chargeUpdateContact = function(idContact , typeContact , remarque , date , societe , idProsp , cntct_info , cntct_user , score , pa ) {
            //alert(cntct_info["contenu"]);
            //les champs qui ne change pas
            $('#up-cntct-dateDeCntct').html(date);
            $('#up-cntct-societe').html(societe);
            $('#up-cntct-commercial > i').html(" "+cntct_user);
            $('#up-cntct-score').html(" "+score);
            if (pa != null) {
              $('#up-cntct-pa').html(" "+pa["action"]+" "+pa["date"]);
              $('.up-cntct-notePA').html(" "+pa["note"]);
              $('.up-cntct-notePA').show();
            }else{
              $('#up-cntct-pa').html(" - ");
              $('.up-cntct-notePA').hide();
            }

            $('.up-cntct-remarque').html(remarque);
            $("#up-cntct-date").html(`<br/><b><i class="fa fa-calendar"></i> `+date+ `</b> `);

            //delete // si je l'ecrit pas ici ce button , je ne pouvrais pas le faire autrement .
            $("#up-cntct-delete").html(`<button class="btn col-md-1" onclick="location.href='{{url('deleteContact/`+idContact+`')}}'" ><i class="fa fa-trash"></i></button>`);

            //si email donc on doit supprimer les champs de contact appel(hide them)
            if(typeContact == "E"){
              $(".up-cntct-phone").hide();
              $(".up-cntct-mail").show();
              var etatEmail= cntct_info["envoye"];
              if(cntct_info["envoye"]=="Oui") etatEmail += ' <i class="fa fa-check-circle"></i>';
              $("#up-cntct-type").html(`<br/><b><i class="fa fa-envelope-o"></i> Email </b> `);
              $("#up-cntct-etatEmail").html(`ETAT <br/><b> Envoyé : `+etatEmail+` </b>`);

              //deletting


            }else if (typeContact == "A") {
              $(".up-cntct-mail").hide();
              $(".up-cntct-phone").show();
              var typeAppel=" <- Entrant";
              if(cntct_info["entrantSortant"]==0) typeAppel = " -> Sortant";
              $("#up-cntct-type").html(`<br/><b><i class="fa fa-phone"></i> Appel </b> `+typeAppel);
              $("#up-cntct-duree").html(`DUREE <br/><b>`+cntct_info["duree"].substring(0,2)+'h.'+cntct_info["duree"].substring(3,5)+`mn </b>`);

              //deletting


            }

      };

    });

</script>
