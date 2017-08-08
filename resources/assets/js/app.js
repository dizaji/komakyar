
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
window.VueProgressBar  = require('vue-progressbar');
window.jmoment = require('moment-jalaali');
require('persian-date/dist/0.1.8b/persian-date-0.1.8b.min');
require('persian-datepicker/dist/js/persian-datepicker-0.4.5.min');
require('persian-datepicker/dist/css/persian-datepicker-0.4.5.min.css');

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
