<div class="modal fade" id="nouvelleTache">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h3 class="modal-title" style="color:white" >Nouvelle tache - <span id="cr-tache-societe"></span></h3>
      </div>
      <div class="modal-body">


          <hr/>

                <form id="tache-form" method="post" action="">
                  @csrf
                  <div class="row">
                    <div class="form-group col-md-8">
                      <input type="text" class="form-control" name="titre" placeholder="Object">
                    </div>

                    <div class="form-group col-md-4">
                      <select class="form-control" name="user" required>
                        <option value="" disabled selected>Commercial</option>
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
                        <input type="text" class="form-control pull-right" id="reservation" name="date" required>
                      </div>
                      <!-- /.input group -->
                    </div>
                    <div class="form-group col-md-4">
                      <select id="tchSlctPrd" class="form-control select2 select2-hidden-accessible " name="produits[]" required multiple="" data-placeholder="Produits/Services" style="width: 100%;" tabindex="-1" aria-hidden="true">

                      </select>
                    </div>
                    <div class="form-group col-md-4 phone">
                      <select class="form-control" name="prio" required>
                        <option value="" disabled selected>Priorite</option>
                        @foreach ($tousLesPriorites as $priorite)
                          <option value="{{$priorite->id}}" >{{$priorite->libPrio}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                      <textarea class="textarea form-control" name="remarque" rows="8" placeholder="Remarque ..." required></textarea>
                  </div>
      </div>
      <div class="modal-footer">
        <input id="submit" class="btn btn-primary col-md-4" type="submit" value="Affecter">
        <button class="btn btn-danger" data-dismiss="modal">Fermer</button>
        </form>
      </div>
    </div>
  </div>
</div>

@include('layouts.modals.noProspectSelected')


<script type="text/javascript">
    $(document).ready(function(){
      //c'est pour le dater par interval
      $('#reservation').daterangepicker();

      var idP;
      chargeNouvelleTache = function(societe , idProsp , tousLesProduits , produit_prospect) {
            $('#cr-tache-societe').html(societe);
            $('#tache-form').attr('action',"createTache/"+idProsp);
            idP = idProsp;
            var  i ,j;
            var b = "";
            var options="";
            for(i = 0 ; i < tousLesProduits.length ; i++){
              for( j = 0 ; j < produit_prospect.length ; j++){
                if (b != "selected" && produit_prospect[j]['idPrd'] == tousLesProduits[i]['id'] && produit_prospect[j]['idProsp'] ==  idProsp ) {
                  b = "selected";
                }
              }

              options += '<option value="'+tousLesProduits[i]["id"]+'" '+b+' > '+tousLesProduits[i]["LibProd"]+' </option>';
              b="";
            }

            $("#tchSlctPrd").html(options);

      };
      chargeNouvelleTachePlusieurProspect = function(){
        var b=false ;
        $(".check").each(function(){
          if(this.checked == true ){
              b = true ;
          }

        });
        if (b==false) {
          $('#NoProspectSelected').modal('show');
        }
        else {
          chargeNouvelleTache("Groupe",-1);
          $('#nouvelleTache').modal('show');
        }
      }



    });


</script>
