
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import Notifications from 'vue-notification';
import VueVideoPlayer from 'vue-video-player';
import 'video.js/dist/video-js.css'

import VueStripeCheckout from 'vue-stripe-checkout';

Vue.use(VueStripeCheckout, 'pk_test_hrnFfxX5E0AWQ2yczbNP2FZH');

import VModal from 'vue-js-modal'

Vue.use(VModal)





Vue.use(VueVideoPlayer);
Vue.use(Notifications);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('coupons-component', require('./components/admin/coupons').default);
Vue.component('users-component', require('./components/admin/users').default);
Vue.component('stripe-component', require('./components/users/stripe').default);
Vue.component('table-component', require('./components/users/table').default);
Vue.component('video-component', require('./components/users/video').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app'
});
