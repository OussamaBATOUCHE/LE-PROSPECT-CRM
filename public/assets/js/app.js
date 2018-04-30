
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('chat-message', require('./components/ChatMessage.vue'));
Vue.component('chat-log', require('./components/ChatLog.vue'));
Vue.component('chat-composer', require('./components/ChatComposer.vue'));

const app = new Vue({
    el: '#app',
    data:{

				messages: [
				{
				    message:"Hello. How are you today?",
				    time:"11:00"
                },
                {
                    message:"Hey! I'm fine. Thanks for asking!",
                    time:"11:01"
				}
				]

    },
    methods:{
    	addMessage(message){
    		// add to existing messages
        this.messages.push(message);
    		//persist to database
    		console.log('message added');
    	}
    }
});