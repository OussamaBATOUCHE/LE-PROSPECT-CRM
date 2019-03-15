@include('layouts.adminHeader')

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  @include('layouts.adminTopNav')
  @include('layouts.adminLeftNav')



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"  style="box-shadow: inset -1px 1px 10px 0px #312828;">

     @yield('content')

  </div>
  <!-- /.content-wrapper -->
  @include('layouts.adminFooter')
