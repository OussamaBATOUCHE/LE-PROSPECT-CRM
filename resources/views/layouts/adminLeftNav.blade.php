<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <span class="img-circle">.{{strtoupper(Auth::user()->name[0])}}.</span>
      </div>
      <div class="pull-left info">
        <p>{{ Auth::user()->name }} </p>
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
      <li class="treeview">
        <a href="#">
          <i class="fa fa-tachometer"></i> <span>Principal</span>
        </a>
      </li>
      <li class="treeview">
        <a href="prospects">
          <i class="fa fa-fire"></i> <span>Prospects</span>
        </a>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-user"></i>
          <span>Commercial</span>
        </a>
      </li>
      <li>
        <a href="pages/widgets.html">
          <i class="fa fa-calendar"></i> <span>Tâches</span>
        </a>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-th"></i>
          <span>Produits & Services</span>
        </a>
        <ul class="treeview-menu">
          <li><a href="pages/charts/chartjs.html"><i class="fa fa-circle-o"></i> Produits</a></li>
          <li><a href="pages/charts/morris.html"><i class="fa fa-circle-o"></i> Service</a></li>
        </ul>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-phone"></i>
          <span>Contact</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="pages/charts/chartjs.html"><i class="fa fa-circle-o"></i> Visite</a></li>
          <li><a href="pages/charts/morris.html"><i class="fa fa-circle-o"></i> Email</a></li>
          <li><a href="pages/charts/flot.html"><i class="fa fa-circle-o"></i> Appel</a></li>
        </ul>
      </li>
      <li>
        <a href="paramList">
          <i class="fa fa-gears"></i> <span>Parametres</span>
        </a>
      </li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
