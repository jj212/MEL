import Vue from 'vue';
import VueRouter from 'vue-router';
//import Vuex from 'vuex';

import axios from 'axios'
import VueAxios from 'vue-axios'
import VeeValidate from 'vee-validate'
import BootstrapVue from 'bootstrap-vue'
import CKEditor from '@ckeditor/ckeditor5-vue';
import VueToastr2 from 'vue-toastr-2'
import 'vue-toastr-2/dist/vue-toastr-2.min.css'



//import VueAuth from '@websanova/vue-auth'


//console.log(auth,'====Auth');

/* Setup Vue with plugins */
window.Vue = Vue;

Vue.use(VueRouter); //manages routing
//Vue.use(Vuex);
Vue.use(VueAxios, axios);

Vue.use(VeeValidate);
Vue.use(BootstrapVue);
Vue.use( CKEditor );

window.toastr = require('toastr')

Vue.use(VueToastr2)




window._ = require('lodash');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');

    require('bootstrap');
} catch (e) {}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo'

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     encrypted: true
// });


axios.defaults.baseURL = '/api/';