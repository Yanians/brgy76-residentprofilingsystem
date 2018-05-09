
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

Vue.component('socialpension-dataviewer', require('./components/SocialPensionDataViewer.vue'));
Vue.component('businesspermit-dataviewer', require('./components/BusinessPermitDataViewer.vue'));
Vue.component('certification-dataviewer', require('./components/CertificationDataViewer.vue'));
Vue.component('schedule-dataviewer', require('./components/ScheduleDataViewer.vue'));
Vue.component('message-room', require('./components/MessageSender.vue'));


const app = new Vue({
    el: '#app'
});

