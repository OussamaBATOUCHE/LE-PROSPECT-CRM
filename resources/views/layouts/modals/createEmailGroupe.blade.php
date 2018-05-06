
<div class="modal fade" id="emailGroupe">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h3 class="modal-title" style="color:white" >Emails en groupe</h3>
      </div>
      <div class="modal-body">
          <section class="content">
            <div class="row">
              <div class="col-xs-12">
                <div class="box">
                  <div class="box-header">
                    <a id="switchButton" onclick="nextStepMsgGrp()" class="btn btn-info pull-right" value="1"><i class="fa fa-envelope" style="color:white;font-size:20px;"></i>&nbsp; <span id="nextStp">Suivant >></span></a>
                    <a id="previeusStp" onclick="prev()" class="btn btn-info pull-right" disabled >&nbsp; <span id="nextStp"> << Precedent</span></a>
                  </div><!-- /.box-header -->
                    @if (session('status')){!! session('status') !!}@endif
                  <div class="box-body" id="contentMailGrp">
                    <table id="step1" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Societe</th>
                          <th>Email</th>
                          <th>Telephone</th>

                        </tr>
                      </thead>
                      <tbody id="prspcts">

                      </tbody>
                    </table>
                    <form id="step2" action="GrpEmail" method="post">
                      <div id="cntntStep2">

                      </div>
                      <input type="text" name="titre" value="" placeholder="Objet">
                      <textarea class="textarea" name="remarque" rows="8" cols="80"></textarea>
                    </form>
                  </div><!-- /.box-body -->
                </div><!-- /.box -->
              </div><!-- /.col -->
            </div><!-- /.row -->
          </section><!-- /.content -->
      </div>
      <div class="modal-footer">
        <button class="btn btn-danger" data-dismiss="modal">Fermer</button>
        </form>
      </div>
    </div>
  </div>
</div>
@include('layouts.modals.noProspectSelected')
<script>
$('#step2').hide();

 prev = function(){

   $('#previeusStp').attr('disabled','true');
   $('#step2').hide();
   $('#step1').show();
   $('#step1_length').show();
   $('#step1_filter').show();
   $('#step1_info').show();
   $('#step1_paginate').show();

 }

  loadPrspcts = function(){
   $('#prspcts').load('/prospectsGetList');
  }
  loadPrspcts();
  $(function () {
    $('#step1').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : false,//pour ne par trier le tableau automatiquement juste change this parameter to false
      'info'        : true,
      'autoWidth'   : true
    });
  });

     nextStepMsgGrp = function(){
        if($('#nextStp').html() == 'Envoyer'){
           $('#sbmtEmailGrp').click();
          //alert('hello');
        }
        prospectCheck = someChecked();
        if( prospectCheck != false){

          var listProspect = `@csrf
                             <select class="form-control" name="prospects[]" multiple="" required style="display:  none;">`;
           for(var i = 0 ; i < prospectCheck.length ; i++){
             listProspect += `<option value="`+prospectCheck[i]+`" selected></option>`;
           }
           listProspect += `</select>
                            <input type="submit" id="sbmtEmailGrp" value="" hidden>
                          `;

             $("#cntntStep2").html(listProspect);
             $('#step1').hide();
             $('#step1_length').hide();
             $('#step1_filter').hide();
             $('#step1_info').hide();
             $('#step1_paginate').hide();
             $('#nextStp').html('Envoyer');

             $('#step2').show();
             $('#previeusStp').removeAttr('disabled');
        }


      }

   someChecked = function(){
    var b=false ,i=1;
    var prospectCheck = [] ;

    $(".check").each(function(){
      if(this.checked == true ){
          b = true ;
          prospectCheck.push(this.value) ;
      }
    });
    if (b==false) {
      $('#NoProspectSelected').modal('show');
      return false;
    }
    else {

     return prospectCheck;
    }

   }


</script>
