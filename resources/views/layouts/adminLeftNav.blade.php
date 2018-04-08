<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="adminLTE/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>{{session('nom').session('prenom')}} </p>
        <a href="#"><i class="fa fa-circle text-success"></i> Enligne</a>
      </div>
    </div>
    <!-- search form -->
    <form action="#" method="get" class="sidebar-form">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Recherche...">
        <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
      </div>
    </form>
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">Menu de navigation</li>
      <li class="active treeview">
        <a href="#">
          <i class="fa fa-plane"></i> <span>Voles</span>
        </a>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-files-o"></i>
          <span>Reservations</span>
        </a>
      </li>
      <li>
        <a href="pages/widgets.html">
          <i class="fa fa-hotel"></i> <span>Hotel</span>
        </a>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-binoculars"></i>
          <span>Visite</span>
        </a>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-home"></i>
          <span>Chambre</span>
        </a>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-edit"></i> <span>Nouvelle</span>
        </a>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-envelope"></i> <span>Message</span>
        </a>
      </li>
      <li>
        <a href="/users">
          <i class="fa fa-user"></i> <span>Utilisateur</span>
        </a>
      </li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
