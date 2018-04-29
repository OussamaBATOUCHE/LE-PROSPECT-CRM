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


<script type="text/javascript">
    $(document).ready(function(){
      //c'est pour le dater par interval
      $('#reservation').daterangepicker();

      var idP;
      chargeNouvelleTache = function(societe , idProsp) {
            $('#cr-tache-societe').html(societe);
            $('#tache-form').attr('action',"createTache/"+idProsp);
            idP = idProsp;
      };

      chargeNouvelleTachePlusieurProspect = function(){
         foreach ($("input") as $key => $value) {
           # code...
         }
      };



    });


</script>
