
<div class="modal fade" id="importprospectsModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h3 class="modal-title" style="color:white" >Importer des Prospects</h3>
      </div>
      <div class="modal-body">
        <form method="post" action="importProspects" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <select class="form-control" name="idChampAct" required>
              <option value="0" disabled selected>Champ d'Activite</option>
              @foreach ($tousLesChampActiv as $champActiv)
                <option value="{{$champActiv->id}}" >{{$champActiv->LibChampAct}}</option>
              @endforeach
            </select>
          </div>
          <div class="row">
              <div class="col-md-12">
                  @csrf
                  <input class="form-control" type="file" name="file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" >
               </div>
          </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-danger" data-dismiss="modal">Fermer</button>
        <input class="btn btn-success" type="submit" value="Importer"></form>
      </div>
    </div>
  </div>
</div>
