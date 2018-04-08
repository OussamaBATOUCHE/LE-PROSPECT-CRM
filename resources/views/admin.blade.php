@include('layouts.adminHeader')

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  @include('layouts.adminTopNav')
  @include('layouts.adminLeftNav')



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    @if (session('status')){{ session('status') }} @endif

     @yield('content')
  </div>
  <!-- /.content-wrapper -->
  @include('layouts.adminFooter')
