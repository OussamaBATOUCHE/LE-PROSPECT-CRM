<script>
  $(document).on('keydown','.send',function(e){
    var message = $(this).val();
    var element = $(this);
    if(!message == '' && e.keyCode == 13 && !e.shiftKey){
      console.log(10);
      //$('.myContent').append('<div class="container darker"><img src="adminLTE/dist/img/user2-160x160.jpg" alt="Avatar"><p>'+message+'</p><span class="time-left">{{ Carbon\Carbon::now()->toDateTimeString() }}<span/></div>');

      $.ajax({
        url:'{{ url("messages/add") }}',
        type:'post',
        data:{_token:'{{csrf_token()}}',message:message}
      });
      element.val('');
    }
  }); 

  $(function(){
      liveChat();
  });

  function liveChat(){
    $.ajax({
         url:'{{ url("messages/ajax") }}',
         data:{_token:'{{ csrf_token() }}'},
         success:function(data){
          $('.myContent').append('<div class="container darker"><img src="adminLTE/dist/img/user2-160x160.jpg" alt="Avatar"><p>'+data['message']+'</p><span class="time-left">{{ Carbon\Carbon::now()->toDateTimeString() }}<span/></div>');
          console.log("rah ndir set timeout");
          setTimeout(liveChat,2000);
          console.log("rani dart set timeout");
         },
         error:function(){
          setTimeout(liveChat,5000);
         }
    });
  }
</script>
<div class="modal fade" id="showMessagesModal">
  <div class="modal-dialog modal-lg modal-T1">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h3 class="modal-title" id="addUserModalLabel" style="color:white" >Descussion</h3>
      </div>
        <div id="listeMessage">
          
        </div>

    </div>
  </div>
</div>




              <script>
                $('#listeMessage').load('/messages');
                $('#listeMessage').append('<p> Connection ... </p>');
              </script>   
