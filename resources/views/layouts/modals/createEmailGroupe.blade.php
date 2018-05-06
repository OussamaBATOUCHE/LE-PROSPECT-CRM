
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
                    <form  action="GrpEmail" method="post">
                      @csrf
                    <table id="step1" class="table table-bordered table-striped">

                      <div class="form-group">
                        <select id="idGrp" class="form-control select2 select2-hidden-accessible" name="idGrp[]" multiple="" data-placeholder="Groupes" style="width: 100%;" tabindex="-1" aria-hidden="true">
                          @foreach ($tousLesGroupes as $groupe)
                            <option value="{{$groupe->id}}" >{{$groupe->LibGrp}}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="form-group">
                        <select id="idChampAct" class="form-control select2 select2-hidden-accessible" name="idChampAct[]" multiple="" data-placeholder="Champs d'activitées" style="width: 100%;" tabindex="-1" aria-hidden="true">
                          @foreach ($tousLesChampActiv as $champActiv)
                            <option value="{{$champActiv->id}}" >{{$champActiv->LibChampAct}}</option>
                          @endforeach
                        </select>
                      </div>

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

                      <div id="step2">

                          <div id="cntntStep2">

                          </div>

                          <div class="form-group">
                            <input type="text" class="form-control" name="titre" value="" placeholder="Objet" required>
                          </div>
                          <div class="form-group">
                           <textarea class="textarea form-control" name="remarque" rows="8" cols="80" required></textarea>
                          </div>
                      </div>
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

var b=false ;
$('#step2').hide();

 prev = function(){

   $('#previeusStp').attr('disabled','true');
   $('#step2').hide();
   $('#step1').show();
   $('#step1_length').show();
   $('#step1_filter').show();
   $('#step1_info').show();
   $('#step1_paginate').show();
   $('#nextStp').html('Suivant >>');

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
        if( b != false){

          var listProspect = `
                             <select class="form-control" name="prospects[]" multiple="" style="display:  none;">`;
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
     b=false ;
    var prospectCheck = [] ;

    $(".check").each(function(){
      if(this.checked == true ){
          b = true ;
          prospectCheck.push(this.value) ;
      }

    });
    if($("#idGrp").val() != "" || $("#idChampAct").val() != "" ){
      b = true;
    }
    //alert(b);
    if (b==false) {
      $('#NoProspectSelected').modal('show');
      return false;
    }
    else {

     return prospectCheck;
    }

   }


</script>
