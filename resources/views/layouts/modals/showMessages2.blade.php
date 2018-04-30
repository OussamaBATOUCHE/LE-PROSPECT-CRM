<div class="modal fade" id="showMessagesModal2">
  <div class="modal-dialog modal-lg modal-T1">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h3 class="modal-title" id="addUserModalLabel" style="color:white" >Descussion</h3>
      </div>
      <div class="modal-body" style="padding: 0px;">
        <div id="app">

      	  <chat-log :messages="messages"></chat-log>
      	  <chat-composer v-on:messagesent="addMessage"></chat-composer>
        </div>
    
      </div>
    </div>
  </div>
</div>