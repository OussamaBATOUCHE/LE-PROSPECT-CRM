
<div class="modal fade" id="updateProfilModal">
  <div class="modal-dialog modal-lg modal-T1">
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h3 class="modal-title" id="addUserModalLabel" style="color:white" >Profile</h3>
        </div>
        <div class="modal-body">
          <form method="POST" action="{{ url('updateProfile') }}">
            @csrf

            <input id="id" name="id" type="hidden" class="form-control" value="{{Auth::user()->id}}">
            <input id="type" name="type" type="hidden" class="form-control" value="{{Auth::user()->type}}">
            <div class="form-group">
              <label class="form-control-label">Nom</label>
              <input type="text" class="form-control" name="name" value="{{Auth::user()->name}}" >
            </div>
            <div class="form-group">
              <label class="form-control-label">Prenom</label>
              <input type="text" class="form-control" name="prenom" value="{{Auth::user()->prenom}}" >
            </div>
            <div class="form-group">
              <label class="form-control-label">Poste de travaille</label>
              <input type="text" class="form-control" name="poste" value="{{Auth::user()->poste}}" >
            </div>
            <div class="form-group">
              <label class="form-control-label">Adresse</label>
              <input type="text" class="form-control" name="adresse" value="{{Auth::user()->adresse}}" >
            </div>
            <div class="form-group">
              <label class="form-control-label">Telephone</label>
              <input type="text" class="form-control" name="telephone" value="{{Auth::user()->telephone}}" >
            </div>
            <div class="form-group">
              <label class="form-control-label">E-Mail</label>
              <input id="email" type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{Auth::user()->email}}" required>
            </div>
            <div class="form-group" id="updtPass">
              <label for="changePass"><a onclick="showUpdatePassForm()">Modifer mot de passe</a></label>
            </div>
            {{-- <input type="hidden" name="type" value="{{Auth::user()->type}}"> j'ai cru que j'ai besoins de sa pour garder le type de user connecter et ne pas le craser dans la fonction update user--}}
            <input class="btn btn-primary" type="submit" value="Modifier">
          </form>
        </div>
        <div class="modal-footer">
          <button class="btn btn-danger" data-dismiss="modal">Fermer</button>
        </div>
      </div>
    </div>
</div>


<script type="text/javascript">
  var x = 0;
  function showUpdatePassForm() {
    var from =`
                                  <div class="form-group up-profil-rm">
                                     <label  class="form-control-label ">Nouveau mot de passe</label>
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" >

                                  </div>
                                  <div class="form-group up-profil-rm">
                                    <label  class="form-control-label">Confirmez le mot de passe</label>
                                    <input id="password-confirm" type="password" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" name="password_confirmation" required >

                                  </div>`;
    if (x == 0) {
        $( "#updtPass" ).after(from);
        $( "#updtPass>label>a" ).html('Je maintien mon mot de passe');
        x=1;
    }else {
         $(".up-profil-rm").remove();
         $( "#updtPass>label>a" ).html('Modifer mot de passe');
         x=0;
    }

  }
</script>
