
<div class="modal fade" id="updateetatModal">
  <div class="modal-dialog modal-lg modal-T1">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h3 class="modal-title" style="color:white" >Modifier une etat</h3>
      </div>
      <div class="modal-body">

        <form id="updateEtat" method="post" action="#">
          @csrf
          {{ method_field('PATCH') }}
          <div class="form-group">
            <label class="form-control-label">Numero</label>
            <input id="num" type="text" class="form-control" name="num">
          </div>
          <div class="form-group">
            <label class="form-control-label">Libelle</label>
            <input id="lib" type="text" class="form-control" name="LibEtat">
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


<script>
function charge(id,lib,num) {

  document.getElementById('updateEtat').action="updateEtat/"+id;
  document.getElementById('lib').value=lib;
  document.getElementById('num').value=num;

}
</script>
