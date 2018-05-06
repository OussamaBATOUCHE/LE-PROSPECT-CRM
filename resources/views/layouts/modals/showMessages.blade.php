<script>
  $(document).on('keydown','.send',function(e){
    var message = $(this).val();
    var user = $(this).attr('user');
    var element = $(this);
    if(!message == '' && e.keyCode == 13 && !e.shiftKey){
      $('.myContent').prepend('<div class="container darker"><img src="adminLTE/dist/img/user2-160x160.jpg" alt="Avatar"><p>'+message+'</p><span class="time-left">{{ Carbon\Carbon::now()->toDateTimeString() }}<span/></div>');
      $.ajax({
        url:'{{ url("messages/add") }}/'+user,
        type:'post',
        data:{_token:'{{ csrf_token() }}',message:message}
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
            if(data['message'] != 'ERROR'){
              $('.myContent').prepend('<div class="container"><img src="adminLTE/dist/img/user8-128x128.jpg" alt="Avatar"><p>'+data['message']+'</p><span class="time-right">{{ Carbon\Carbon::now()->toDateTimeString() }}<span/></div>');
            }
           setTimeout(liveChat,1000);
          },
          error:function(){
           setTimeout(liveChat,3000);
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
