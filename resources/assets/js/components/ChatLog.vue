<!--
<template lang="html">
	<div class="chat-log">
        <div class="myContent">
		    <chat-message v-for="message in messages" v-bind:message="message" v-bind:key="message.id"></chat-message>
		</div>
	</div>

</template>

<script>
	export default{
        props:['messages']
	}
</script>


<style lang="css">
	
</style>