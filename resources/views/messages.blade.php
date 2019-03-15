@extends('admin')

@section('content')
<section class="content">
<h3 class="box-title">Gestion des Messages</h3>
<div style="text-align:right;float: right">
<a class="btn btn-danger" onclick="supprimerPlusieurMsg()" ><i class="fa fa-times"></i>&nbsp;Supprimer la selection</a>
<form id="ls-msg" method="POST" action="{{url('/deleteMsgs')}}" >

</form>
</div>
  @if (session('status')){!! session('status') !!}@endif
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">

        </div><!-- /.box-header -->
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th><input id="checkAll" type="checkbox"  style="color:red"/></th>
                <th>Numero</th>
                <th>Envoyé par</th>
                <th>Recepteur</th>
                <th>Date d'envoi</th>
                <th>Contenu</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @php
                $i = 0 ;
              @endphp
              @foreach($messages as $message)
              <tr>
                <td> <input class="check" type="checkbox" value="{{$message->id}}"/> </td>
                <td>{{$message->id}}</td>
                <td>{{$detailsMessage[$i]["sender"]}}</td>
                <td>{{$detailsMessage[$i]["reciever"]}}</td>
                <td>{{$message->created_at}}</td>
                <td>{{$message->message}}</td>
                <td><a class="btn btn-danger fa fa-trash" href="{{url('message_delete/'.$message->id)}}"></a></td>
              </tr>
              @php
                $i++;
              @endphp
              @endforeach
            </tbody>
            </tfoot>
          </table>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!-- /.col -->
  </div><!-- /.row -->
</section><!-- /.content -->

@include('layouts.modals.noProspectSelected')

<script>

  supprimerPlusieurMsg = function(){
     messageCheck = someChecked();
     if( messageCheck != false){

       var listMessage = `@csrf
                          <select class="form-control" name="messages[]" multiple="" required style="display:  none;">`;
        for(var i = 0 ; i < messageCheck.length ; i++){
          listMessage += `<option value="`+messageCheck[i]+`" selected></option>`;
        }
        listMessage += `</select>
                       <input type="submit" id="msgDt" value="" hidden>
                       `;

        $("#ls-msg").html(listMessage);
     }
      $('#msgDt').click();

   }

someChecked = function(){
 var b=false ,i=1;
 var messageCheck = [] ;

 $(".check").each(function(){
   if(this.checked == true ){
       b = true ;
       messageCheck.push(this.value) ;
   }
 });
 if (b==false) {
   $('#NoProspectSelected').modal('show');
   return false;
 }
 else {
   
  return messageCheck;
 }

}


var allSelected = false;
$("#checkAll").click(function() {
  if(allSelected == true ){
    //alert('helo');
    $('.check').each(function(){
      //alert(this.value);
          this.checked = false;
    });
    allSelected = false;
  }else{
    //alert('kldsjflf');
    $('.check').each(function(){
        this.checked = true;
    });
    allSelected = true;
  }

});
</script>
@endsection
