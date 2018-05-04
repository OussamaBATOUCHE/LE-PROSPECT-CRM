@include('layouts.modals.updateProfil')
@include('layouts.modals.showMessages')

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
            <span class="label label-success">2</span>
          </a>
          <ul class="dropdown-menu">
            <li class="header">Vous avez 2 messages</li>
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
                      <small><i class="fa fa-clock-o"></i> 24/03 23H30</small>
                    </h4>
                    <p>c terminer kho</p>
                  </a>
                </li>
                <!-- end message -->
                <li><!-- start message -->
                  <a href="#">
                    <div class="pull-left">
                      <img src="adminLTE/dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
                    </div>
                    <h4>
                      Bensaib Kamel
                      <small><i class="fa fa-clock-o"></i> 24/03 22H27</small>
                    </h4>
                    <p>Why not buy a new awesome theme?</p>
                  </a>
                </li>
                <!-- end message -->

              </ul>
            </li>
            <li class="footer"><a href="/messages" class="btn btn-success" data-toggle="modal" data-target="#showMessagesModal">Afficher tous les messages</a></li>
          </ul>
        </li>
        <!-- Notifications: mes taches a faire et qui non pas encore terminées -->
        <li class="dropdown notifications-menu" id="mesNotifications" >

        </li>
        <script>
           loadNotifications = function(){
              $('#mesNotifications').load("/mesNotifications");
          }
          loadNotifications();
        </script>
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
                    <a href="{{url('paramList')}}" id="c1a">
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
                {{ Auth::user()->name }} -
                @if (Auth::user()->type == 1)
                  Directeur Commercial
                @else
                  Commercial
                @endif
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
