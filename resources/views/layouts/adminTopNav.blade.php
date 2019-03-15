@include('layouts.modals.updateProfil')
@include('layouts.modals.showMessages')
@include('layouts.modals.listUsers')

<header class="main-header">
  <!-- Logo -->
  <span  class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><img style="width:80%" src="{{asset('logoS.png')}}" alt=""></span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"> <img src="{{asset('logoH.png')}}" alt=""> </span>
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
        <li class="dropdown messages-menu" id=mesMessages>

        </li>
        <script>
            loadMessages = function(){
            $('#mesMessages').load("/mesMessages");
          }
          loadMessages();
        </script>
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
                  @if (Auth::user()->type == 1)
                    <div class="col-md-6" id="c2">
                      <a id="c2a"   data-toggle="modal" data-target="#usersModal">
                        <i class="fa fa-user top-param"></i>
                        <p>Utilisateurs</p>
                      </a>
                    </div>
                  @endif

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
