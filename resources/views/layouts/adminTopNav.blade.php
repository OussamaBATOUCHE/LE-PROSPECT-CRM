<header class="main-header">
  <!-- Logo -->
  <span  class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b>L-P</b></span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b>LE PROSPECT</b></span>
  </span>
  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>

    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <!-- Messages: style can be found in dropdown.less-->
        <li class="dropdown messages-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-envelope-o"></i>
            <span class="label label-success">4</span>
          </a>
          <ul class="dropdown-menu">
            <li class="header">Vous avez 4 messages</li>
            <li>
              <!-- inner menu: contains the actual data -->
              <ul class="menu">
                <li><!-- start message -->
                  <a href="#">
                    <div class="pull-left">
                      <img src="adminLTE/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                    </div>
                    <h4>
                      Support Team
                      <small><i class="fa fa-clock-o"></i> 5 mins</small>
                    </h4>
                    <p>Why not buy a new awesome theme?</p>
                  </a>
                </li>
                <!-- end message -->

              </ul>
            </li>
            <li class="footer"><a href="#">Afficher tous les messages</a></li>
          </ul>
        </li>
        <!-- Notifications: style can be found in dropdown.less -->
        <li class="dropdown notifications-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-bell-o"></i>
            <span class="label label-warning">10</span>
          </a>
          <ul class="dropdown-menu">
            <li class="header">Vous avez 10 notifications</li>
            <li>
              <!-- inner menu: contains the actual data -->
              <ul class="menu">
                <li>
                  <a href="#">
                    <i class="fa fa-users text-aqua"></i> 5 reservations
                  </a>
                </li>
              </ul>
            </li>
            <li class="footer"><a href="#">Afficher tous</a></li>
          </ul>
        </li>
        <!-- parametres -->
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-gears"></i>
          </a>
          <ul class="dropdown-menu">
            <li class="param-header">
              PARAMETRES
            </li>
            <li class="user-header user-header-oussama">
              <div class="row">
                <div class="col-md-12">
                  <div class="col-md-6" id="c1">
                    <a href="paramList" id="c1a">
                      <i class="fa fa-gears top-param"></i>
                      <p>Configurations</p>
                    </a>
                  </div>
                  <div class="col-md-6" id="c2">
                    <a href="#" id="c2a">
                      <i class="fa fa-user top-param"></i>
                      <p>Utilisateurs</p>
                    </a>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="col-md-6" id="c3">
                    <a href="#" id="c3a">
                      <i class="fa fa-pied-piper top-param"></i>
                      <p>Modeles</p>
                    </a>
                  </div>
                  <div class="col-md-6" id="c4">
                    <a href="#" id="c4a">
                      <i class="fa fa-mobile top-param"></i>
                      <p>Application</p>
                    </a>
                  </div>
                </div>
              </div>
            </li>
          </ul>
        </li>

        <!-- User Account: style can be found in dropdown.less -->
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="{{asset('Icon-user.png')}}" class="user-image" alt="User Image">
            <span class="hidden-xs">{{ Auth::user()->email }} </span>
          </a>
          <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header">
              <img src="{{asset('Icon-user.png')}}" class="img-circle" alt="User Image">

              <p>
                {{ Auth::user()->name }} - Admin principal
              </p>
            </li>
            <!-- Menu Footer-->
            <li class="user-footer">
              <div class="pull-left">
                <a class="btn btn-default btn-flat" data-toggle="modal" data-target="#updateProfilModal">Profile</a>
              </div>
              <div class="pull-right">
                <a href="{{ route('logout') }}" class="btn btn-default btn-flat" onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">Deconnecter</a>
              </div>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
              </form>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</header>

<div class="modal fade" id="updateProfilModal">
  <div class="modal-dialog modal-lg">
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
                                  <div class="form-group">
                                     <label  class="form-control-label">Nouveau mot de passe</label>
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" >

                                  </div>
                                  <div class="form-group">
                                    <label  class="form-control-label">Confirmez le mot de passe</label>
                                    <input id="password-confirm" type="password" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" name="password_confirmation" required >

                                  </div>`;
    if (x == 0) {
        $( "#updtPass" ).after(from);
        x=1;
    }

  }
</script>
