<footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0 by BATOUCHE & BENSAIB
    </div>
    <strong>Copyright &copy; 2018 <a href="https://fecomit.com">FECOM IT</a> &nbsp; & &nbsp; <a href="https://usthb.dz">USTHB</a>.</strong> All rights
    reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- Chat -->
<script src="js/app.js"></script>

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
<!--  jquery.inputmask.js-->
<script src="{{asset('adminLTE/plugins/iCheck/icheck.js')}}"></script>
<script src="{{asset('adminLTE/plugins/iCheck/icheck.min.js')}}"></script>
<!--  jquery.inputmask.js-->
<script src="{{asset('adminLTE/plugins/input-mask/inputmask.js')}}"></script>
<script src="{{asset('adminLTE/plugins/input-mask/jquery.inputmask.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('adminLTE/bower_components/jquery-knob/dist/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{asset('adminLTE/bower_components/moment/min/moment.min.js')}}"></script>
<script src="{{asset('adminLTE/bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<!-- datepicker -->
<script src="{{asset('adminLTE/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<!-- timepicker -->
<script src="{{asset('adminLTE/plugins/timepicker/bootstrap-timepicker.min.js')}}"></script>

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
<!-- Select2 -->
<script src="{{asset('adminLTE/bower_components/select2/dist/js/select2.full.min.js')}}"></script>



<script>
  $(function () {
    $('#example1').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : false,//pour ne par trier le tableau automatiquement juste change this parameter to false
      'info'        : true,
      'autoWidth'   : true
    });
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

<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A' })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })


    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    })
  });

</script>



</body>
</html>
