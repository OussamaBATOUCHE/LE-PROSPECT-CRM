<div class="modal fade" id="nouvelleTache">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h3 class="modal-title" style="color:white" >Nouvelle tache - <span id="societe"></span></h3>
      </div>
      <div class="modal-body">


          <hr/>

                <form id="cntct-form" method="post" action="createTache/0/phone">
                  @csrf
                  <div class="row">
                    <div class="form-group col-md-8">
                      <input type="text" class="form-control" name="titre" placeholder="Object">
                    </div>

                    <div class="form-group col-md-4">
                      <select class="form-control" name="score" required>
                        <option disabled selected>Commercial</option>
                        @foreach ($tousLesUsers as $user)
                          <option value="{{$user->id}}" >{{$user->Name." ".$user->prenom}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="row">
                    <!-- Date range -->
                    <div class="form-group col-md-4">
                      <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" id="reservation">
                      </div>
                      <!-- /.input group -->
                    </div>
                    <div class="form-group col-md-4">
                      <select class="form-control select2 select2-hidden-accessible" name="produits[]" required multiple="" data-placeholder="Produits/Services" style="width: 100%;" tabindex="-1" aria-hidden="true">
                        @php $b = ""; @endphp
                        @foreach ($tousLesProduits as $produitTous)
                          @foreach ($produitsPropose as $produit)
                            @if ($produit->idPrd == $produitTous->id && $produit->idProsp == $prospect->id ) @php $b ="selected"; @endphp @endif
                          @endforeach
                          <option value="{{$produitTous->id}}" @php echo $b ; @endphp >{{$produitTous->LibProd}}</option>
                           @php $b =""; @endphp
                        @endforeach

                      </select>
                    </div>
                    <div class="form-group col-md-4 phone">
                      <select class="form-control" name="priorite" required>
                        <option disabled selected>Priorite</option>
                        @foreach ($tousLesPriorites as $priorite)
                          <option value="{{$priorite->id}}" >{{$priorite->libPrio}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                      <textarea class="textarea form-control" name="remarque" rows="8" style="width:100%; " placeholder="Remarque ..." required></textarea>
                  </div>
                  <input id="typeCntct" type="hidden" name="type" value="A">

      </div>
      <div class="modal-footer">
        <input id="submit" class="btn btn-primary col-md-4" type="submit" value="Affecter">
        <button class="btn btn-danger" data-dismiss="modal">Fermer</button>
        </form>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
    $(document).ready(function(){
      //c'est pour le dater par interval
      $('#reservation').daterangepicker();



      var idP;
      chargeNouveauTache = function(societe , idProsp) {
            $('#societe').html(societe);
            $('#cntct-form').attr('action',"createTache/0/phone/"+idProsp);
            idP = idProsp;
      };

      active = function(button){
          $("#"+button).addClass("btn-info");
          $("#"+button+"-form").show();
          $('#cntct-form').attr('action',"createTache/0/"+button+"/"+idP);
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
            $("#submit").attr('value','Ajouter');
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
