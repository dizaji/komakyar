
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./group/group');
require('./student/student');
require('./lookup/lookup');

const staff_app = new Vue({
     el: '#staff-app'
});
