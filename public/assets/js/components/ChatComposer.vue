<template lang="html">
	<div class="chat-composer">
	  <div class="modal-footer" style="padding-left: 0px;margin-left: auto; width: 95%;">
		<input type="text" class="col-md-10" name="message" placeholder="Votre Message" required v-model="messageText" v-on:keyup.enter="sendMessage"  style="    margin-top: 5px;    width: 90.333333%;">
        <img class="btn-send" src="adminLTE/dist/img/sendSemiCircle.png" title="Envoyer" @click="sendMessage" style="width:9%">
      </div>
	</div>

</template>

<script>
	export default{
    data() {
    	return{
    	   messageText:''	
    	}
    },
    	methods:{

    	    sendMessage(){
                this.$emit('messagesent',{
                	message: this.messageText,
                	time: "00:20"
                });
                this.messageText='';
            } 
        }

	}
</script>


<style lang="css">
	
</style>