@if(!$priorites->isEmpty())
<div class="modal fade" id="updateprioriteModal">
  <div class="modal-dialog modal-lg modal-T1">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h3 class="modal-title" style="color:white" >Modifier une priorite</h3>
      </div>
      <div class="modal-body">

        <form id="updatePriorite" method="post" action="#">
          @csrf
          {{ method_field('PATCH') }}
          <div class="form-group">
            <label class="form-control-label">Numero</label>
            <input id="num" type="number" class="form-control" name="num" required>
          </div>
          <div class="form-group">
            <label class="form-control-label">Libelle</label>
            <input id="lib" type="text" class="form-control" name="libPrio">
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
function charge(id,num,lib,color) {

  document.getElementById('updatePriorite').action="updatePriorite/"+id;
  document.getElementById('num').value=num;
  document.getElementById('lib').value=lib;
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
