import 'es6-promise/auto'
import axios from 'axios'
import './bootstrap'
import Vue from 'vue'
import VueAuth from '@websanova/vue-auth'
import VueAxios from 'vue-axios'
import VueRouter from 'vue-router'
import Index from './Index'
import Pagination from './components/Pagination.vue'
import auth from './auth'
import router from './router'
require('axios-debug')(axios)
// Set Vue globally
window.Vue = Vue

// Set Vue router
Vue.router = router
Vue.use(VueRouter)

// Set Vue authentication

Vue.use(VueAxios, axios)

//var token = document.head.querySelector('meta[name="csrf-token"]'); //нове
//window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content; //нове
axios.defaults.baseURL = `${process.env.MIX_APP_URL}/api`
//axios.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded' //нове
//axios.defaults.headers.post['Content-Type'] = 'application/json' //нове
Vue.use(VueAuth, auth)

// Load Index
Vue.component('index', Index)
Vue.component('pagination', Pagination);
const app = new Vue({
  el: '#app',
  router
});
