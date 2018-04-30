<template lang="html">
	<div class="container">
        <img src="adminLTE/dist/img/user2-160x160.jpg" alt="Avatar">
        <p>{{ message.message }}</p>
        <span class="time-right">{{ message.time }}</span>
    </div>

</template>

<script>
	export default{
    props: ['message']
	}
</script>