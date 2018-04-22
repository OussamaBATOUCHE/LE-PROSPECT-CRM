<footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0 by BATOUCHE & BENSAIB
    </div>
    <strong>Copyright &copy; 2018 <a href="https://fecomit.com">FECOM IT</a> &nbsp; & &nbsp; <a href="https://usthb.dz">USTHB</a>.</strong> All rights
    reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="{{asset('adminLTE/bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('adminLTE/bower_components/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('adminLTE/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- Morris.js charts -->
<script src="{{asset('adminLTE/bower_components/raphael/raphael.min.js')}}"></script>
<script src="{{asset('adminLTE/bower_components/morris.js/morris.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('adminLTE/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js')}}"></script>
<!-- jvectormap -->
<script src="{{asset('adminLTE/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
<script src="{{asset('adminLTE/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('adminLTE/bower_components/jquery-knob/dist/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{asset('adminLTE/bower_components/moment/min/moment.min.js')}}"></script>
<script src="{{asset('adminLTE/bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<!-- datepicker -->
<script src="{{asset('adminLTE/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{asset('adminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
<!-- Slimscroll -->
<script src="{{asset('adminLTE/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('adminLTE/bower_components/fastclick/lib/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('adminLTE/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('adminLTE/dist/js/pages/dashboard.js')}}"></script>
<!-- DataTables -->
<script src="{{asset('adminLTE/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('adminLTE/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>

<script>
  $(function () {
    $('#example1').DataTable();
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  });

  $(function() {
    $('#c1').hover(function() {
      $('#c1a').css('color', '#232e33');
    }, function() {
      // on mouseout, reset the background colour
      $('#c1a').css('color', 'white');
    });
  });
  $(function() {
    $('#c2').hover(function() {
      $('#c2a').css('color', '#232e33');
    }, function() {
      // on mouseout, reset the background colour
      $('#c2a').css('color', 'white');
    });
  });
  $(function() {
    $('#c3').hover(function() {
      $('#c3a').css('color', '#232e33');
    }, function() {
      // on mouseout, reset the background colour
      $('#c3a').css('color', 'white');
    });
  });
  $(function() {
    $('#c4').hover(function() {
      $('#c4a').css('color', '#232e33');
    }, function() {
      // on mouseout, reset the background colour
      $('#c4a').css('color', 'white');
    });
  });
</script>


</body>
</html>
