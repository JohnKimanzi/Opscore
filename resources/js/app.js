/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import ElementUI from 'element-ui';
import locale from 'element-ui/lib/locale/lang/en'
import 'element-ui/lib/theme-chalk/index.css';

import flatpickr from "flatpickr";

//chat
import VueResource from "vue-resource"
import Echo from "laravel-echo"
import Pusher from "pusher-js"

//vue-phone-number-input
import VuePhoneNumberInput from 'vue-phone-number-input';
import 'vue-phone-number-input/dist/vue-phone-number-input.css';

import Vue from 'vue';

//APEX Charts
import VueApexCharts from 'vue-apexcharts';
import axios from 'axios';

//HighCharts
import HighchartsVue from 'highcharts-vue';

window.Vue = require('vue').default;
Vue.use(ElementUI,{ locale });
Vue.use(VueApexCharts);
Vue.use(VueResource);
Vue.use(HighchartsVue);

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: 'adba74bea688557ca' //Add your pusher key here
 });


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('vue-phone-number-input', VuePhoneNumberInput);
Vue.component('create-announce', require('./components/announce/create-announce').default);
Vue.component('create-channel', require('./components/channel/create-channel').default)
Vue.component('create-subscribe', require('./components/subscribe/create-subscribe').default)
Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('create-employee', require('./components/employee/create-employee').default);
Vue.component('user_roles', require('./components/employee/user_roles').default);
Vue.component('edit-employee', require('./components/employee/editEmployee').default);
Vue.component('create-appraisal', require('./components/appraisal/create-appraisal').default);
Vue.component('review-appraisal', require('./components/appraisal/review-appraisal').default);
Vue.component('leaves-attendance', require('./components/charts/leaves-attendance').default);
Vue.component('apexchart', VueApexCharts);
Vue.component('chat-messages', require('./components/chats/ChatMessages').default);
Vue.component('chat-form', require('./components/chats/ChatForm').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
 const app = new Vue({
    el: '#app',
    data: {
        messages: [],
        // chartOptions: {
        //     xAxis: {
        //         categories: ['Amina', 'Berny', 'Otiso']
        //     },
        //     series: [{
        //       type: "bar",
        //       data: [1,2,3],
        //       name: "Performance scale 0-5"
        //       // sample data
        //     }]
        //   }
    },
//Upon initialisation, run fetchMessages().
created() {
    this.fetchMessages();
},
methods: {
    fetchMessages() {
        //GET request to the messages route in our Laravel server to fetch all the messages
        axios.get('/messages').then(response => {
            //Save the response in the messages array to display on the chat view
            this.messages = response.data;
        });
    },
    //Receives the message that was emitted from the ChatForm Vue component
    addMessage(message) {
        //Pushes it to the messages array
        this.messages.push(message);
        //POST request to the messages route with the message data in order for our Laravel server to broadcast it.
        axios.post('/messages', message).then(response => {
            console.log(response.data);
        });
    }
}
 });
