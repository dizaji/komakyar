
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
window.VueProgressBar  = require('vue-progressbar');
window.jmoment = require('moment-jalaali');

const options = {
    // color: '#00ff00',
    // failedColor: '#ff0000',
    // thickness: '5px',
    // transition: {
    //     speed: '0.2s',
    //     opacity: '0.6s',
    //     termination: 300
    // },
    // autoRevert: true,
    // location: 'top',
    // inverse: false
};

Vue.use(VueProgressBar, options);

Vue.component('validation-errors-alert', require('./components/common/validation_errors-alert.vue'));
Vue.component('confirm-delete-modal', require('./components/common/modals/confirm-delete-modal.vue'));
Vue.component('edit-update-delete-buttons', require('./components/common/edit-update-delete-buttons.vue'));
Vue.component('dropzone-uploader', require('./components/common/dropzone-uploader.vue'));
Vue.component('persian-date-picker', require('./components/common/persian-date-picker.vue'));
Vue.component('expandable-search', require('./components/common/expandaple-search.vue'));
Vue.component('pagination', require('laravel-vue-pagination'));

Vue.filter('persianDate', require('./filters/persian-date.js'));

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
//
// Vue.component('example', require('./components/Example.vue'));
//
// const app = new Vue({
//     el: '#app'
// });
