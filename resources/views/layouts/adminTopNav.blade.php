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
          <form method="post" action="updateProfil">
            @csrf
            <input id="id" name="id" type="hidden" class="form-control" value="{{Auth::user()->id}}">
            <input id="type" name="type" type="hidden" class="form-control" value="{{Auth::user()->type}}">
            <div class="form-group">
              <label class="form-control-label">Nom</label>
              <input type="text" class="form-control" name="name" value="{{Auth::user()->name}}" >
            </div>
            <div class="form-group">
              <label class="form-control-label">E-Mail</label>
              <input id="email" type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="type" value="{{Auth::user()->email}}" required>
            </div>
            <div class="form-group">
              <label  class="form-control-label">Nouveau mot de passe</label>
              <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
              @if ($errors->has('password'))
                  <span class="invalid-feedback">
                      <strong>{{ $errors->first('password') }}</strong>
                  </span>
              @endif
            </div>
            <div class="form-group">
              <label  class="form-control-label">Confirmez le mot de passe</label>
              <input id="password-confirm" type="password" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" name="password_confirmation" required >
              @if ($errors->has('password_confirmation'))
                  <span class="invalid-feedback">
                      <strong>{{ $errors->first('password_confirmation') }}</strong>
                  </span>
              @endif
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
