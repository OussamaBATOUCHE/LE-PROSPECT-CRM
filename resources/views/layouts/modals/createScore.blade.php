<div class="modal fade" id="addScoreModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h3 class="modal-title" style="color:white" >Ajouter un Score</h3>
      </div>
      <div class="modal-body">
        <form method="post" action="createScore">
          @csrf
          <div class="form-group">
            <label class="form-control-label">Numero</label>
            <input type="number" min="0" class="form-control" name="num" required>
          </div>
          <div class="form-group">
            <label class="form-control-label">Libelle</label>
            <input type="text" class="form-control" name="LibScore" required>
          </div>
          <div class="form-group">
            <label for="description" class="form-control-label">Description</label>
            <textarea name="description" class="form-control" rows="3"  required></textarea>
          </div>
          <div class="form-group">
            <label  class="form-control-label">Action</label>
            <input type="text" class="form-control" name="action" required>
          </div>
          <div class="form-group">
            <label  class="form-control-label">Cycle</label>
            <input type="text" class="form-control" name="cycle" required>
          </div>
          <div class="form-group">
            <label  class="form-control-label">Observation</label>
            <input type="text" class="form-control" name="obs" required>
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
