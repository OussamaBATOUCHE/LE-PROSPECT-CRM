<div class="modal fade" id="addprioriteModal">
  <div class="modal-dialog modal-lg modal-T1">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h3 class="modal-title" style="color:white" >Ajouter une priorite</h3>
      </div>
      <div class="modal-body">
        <form method="post" action="createPriorite">
          @csrf
          <div class="form-group">
            <label class="form-control-label">Numero</label>
            <input type="number" class="form-control" name="num" required>
          </div>
          <div class="form-group">
            <label class="form-control-label">Libelle</label>
            <input type="text" class="form-control" name="libPrio" required>
          </div>
          <div class="form-group">
            <label  class="form-control-label">Couleur</label>
            <input type="color" class="form-control" name="couleur" required>
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
