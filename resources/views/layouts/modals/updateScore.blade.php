@if(!$scores->isEmpty())
<div class="modal fade" id="updateScoreModal">
  <div class="modal-dialog modal-lg ">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h3 class="modal-title" style="color:white" >Modifier un Score</h3>
      </div>
      <div class="modal-body">
        <form id="updateScore" method="post" action="#">
          @csrf
          {{ method_field('PATCH') }}
          <div class="form-group">
            <label class="form-control-label">Numero</label>
            <input id="num" type="text" class="form-control" name="num" required>
          </div>
          <div class="form-group">
            <label class="form-control-label">Libelle</label>
            <input id="lib" type="text" class="form-control" name="LibScore">
          </div>
          <div class="form-group">
            <label for="description" class="form-control-label">Description</label>
            <textarea id="desc" name="description" class="form-control" rows="3"  required></textarea>
          </div>
          <div class="form-group">
            <label  class="form-control-label">Action</label>
            <input id="act" type="text" class="form-control" name="action" required>
          </div>
          <div class="form-group">
            <label  class="form-control-label">Cycle</label>
            <input id="cycle" type="text" class="form-control" name="cycle" required>
          </div>
          <div class="form-group">
            <label  class="form-control-label">Observation</label>
            <input id="obs" type="text" class="form-control" name="obs" required>
          </div>
          <div class="form-group">
            <label  class="form-control-label">Couleur</label>
            <input id="color" type="color" class="form-control" name="couleur" required>
          </div>
          <button class="btn btn-primary" type="submit">Modifier</button>
        </form>
      </div>
      <div class="modal-footer">
        <button class="btn btn-danger" data-dismiss="modal">Fermer</button>
      </div>
    </div>
  </div>
</div>
@endif

<script>
function charge(id,num,lib,desc,act,cycle,obs,color) {

  document.getElementById('updateScore').action="updateScore/"+id;
  document.getElementById('num').value=num;
  document.getElementById('lib').value=lib;
  document.getElementById('desc').value=desc;
  document.getElementById('cycle').value=cycle;
  document.getElementById('act').value=act;
  document.getElementById('obs').value=obs;
  document.getElementById('color').value=color;

}
</script>
<script>
  $(function () {
    $('#example1').DataTable();
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
