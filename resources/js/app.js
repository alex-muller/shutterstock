require('./bootstrap')

window.Vue = require('vue')

import App from './components/App'
import Status from './components/Status'

window.token = document.head.querySelector('meta[name="csrf-token"]').content;

import BootstrapVue from 'bootstrap-vue'
Vue.use(BootstrapVue)

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('app', App)
Vue.component('status', Status)

const app = new Vue({
  el: '#app'
})
