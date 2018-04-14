@extends('admin')

@section('content')
  <!-- Content Header (Page header) -->


<div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h3 class="modal-title" id="addUserModalLabel" style="color:white" >Ajouter un Score</h3>
      </div>
      <div class="modal-body">
        <form method="post" action="createChambre">
          @csrf
          <div class="form-group">
            <label class="form-control-label">Nom</label>
            <input type="text" class="form-control" name="type" placeholder="{{Auth::user()->name}}" >
          </div>
          <div class="form-group">
            <label class="form-control-label">E-Mail</label>
            <input type="email" class="form-control" name="type" placeholder="{{Auth::user()->email}}" >
          </div>
          <div class="form-group">
            <label class="form-control-label">Mot de passe</label>
            <input type="password" class="form-control" name="type">
          </div>
          <div class="form-group">
            <label  class="form-control-label">Confirmer mot de passe</label>
            <input type="password" class="form-control" name="type">
          </div>
          <br><br><hr>
          <div class="form-group">
            <label  class="form-control-label">Tappez votre mot de passe</label>
            <input type="password" class="form-control" name="type" required>
          </div>
          <button class="btn btn-primary" type="submit">Valider</button>
        </form>
      </div>
      <div class="modal-footer">
        <button class="btn btn-danger" data-dismiss="modal">Fermer</button>
      </div>
    </div>
  </div>

  <!-- /.content -->
@endsection
