<template lang="html">

   <div v-if="message.user_id == 1">
	<div class="container">
        <img src="adminLTE/dist/img/user2-160x160.jpg" alt="Avatar">
        <p>{{ message.message }}</p>
        <span class="time-right">{{ message.user_id }}</span>
    </div>
</div>
    
<div v-else>
    
 	<div class="container darker">
        <img src="adminLTE/dist/img/user3-128x128.jpg" alt="Avatar">
        <p>{{ message.message }}</p>
        <span class="time-left">{{ message.user_id }}</span>
    </div>
    </div> 

</template>

<script>
	export default{
    props: ['message']
	}
</script>