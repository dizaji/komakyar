
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./group/group');
require('./student/student');
require('./lookup/lookup');
require('./teacher/teacher');

Vue.component('degree-level-dropdownlist', require('./common/degree-level-dropdownlist.vue'));

const staff_app = new Vue({
     el: '#staff-app'
});
