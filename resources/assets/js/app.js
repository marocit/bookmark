
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import Vue2Filters from 'vue2-filters'
Vue.use(Vue2Filters)

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Vue.component('example', require('./components/Example.vue'));
Vue.component('clock', require('./components/Clock.vue'));
Vue.component('deletebookmark', require('./components/Delete.vue'));
Vue.component('counter', require('./components/Counter.vue'));
Vue.component('crypto', require('./components/Crypto.vue'));

const app = new Vue({
    el: '#app'
});
