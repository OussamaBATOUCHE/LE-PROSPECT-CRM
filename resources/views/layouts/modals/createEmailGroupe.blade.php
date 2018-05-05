
<div class="modal fade" id="emailGroupe">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h3 class="modal-title" style="color:white" >Emails en groupe</h3>
      </div>
      <div class="modal-body">
          <hr/>
          <section class="content">
            <div class="row">
              <div class="col-xs-12">
                <div class="box">
                  <div class="box-header">
                    <a id="switchButton" onclick="nextStepMsgGrp()" class="btn btn-info pull-right" value="1"><i class="fa fa-envelope" style="color:white;font-size:20px;"></i>&nbsp; Suivant >></a>
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
                    <form id="step2" action="index.html" method="post">
                      <textarea class="textarea" name="name" rows="8" cols="80"></textarea>
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
        prospectCheck = someChecked();
        if( prospectCheck != false){

          var listProspect = `@csrf
                             <select class="form-control" name="prospects[]" multiple="" required style="display:  none;">`;
           for(var i = 0 ; i < prospectCheck.length ; i++){
             listProspect += `<option value="`+prospectCheck[i]+`" selected></option>`;
           }
           listProspect += `</select>
                            <input type="submit" id="msgDt" value="" hidden>
                          `;

             $("#step2").append(listProspect);
             $('#step1').hide();
             $('#step2').show();
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
